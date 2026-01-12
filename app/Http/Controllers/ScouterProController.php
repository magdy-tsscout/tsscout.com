<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ScouterProController extends Controller
{
    protected $backendUrl;
    protected $apiKey;
    protected $timeout;

    public function __construct()
    {
        $this->backendUrl = env('BACKEND_API_URL', 'https://tsscout.ai/api');
        $this->apiKey = env('BACKEND_API_KEY', '1d95bfb7-b38a-50e4-b5f9-cb348deb4021');
        $this->timeout = env('BACKEND_API_TIMEOUT', 120);
    }

    public function index()
    {
        return view('ai-tool');
    }

    public function search(Request $request)
    {
        try {
            $validated = $request->validate([
                'keyword' => 'required|string|min:2|max:100',
                'profitMargin' => 'nullable|numeric|min:0.1|max:0.9',
                'salesThreshold' => 'nullable|integer|min:1|max:1000',
                'maxResults' => 'nullable|integer|min:1|max:100',
                'rating' => 'nullable|numeric|min:0|max:5',
                'avgSales' => 'nullable|numeric|min:0',
                'minProfit' => 'nullable|numeric|min:0',
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->timeout($this->timeout)
            ->post($this->backendUrl . '/research', [
                'keyword' => $validated['keyword'],
                'profitMargin' => $validated['profitMargin'] ?? 0.30,
                'salesThreshold' => $validated['salesThreshold'] ?? 10,
                'maxResults' => $validated['maxResults'] ?? 20,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $products = $data['results'] ?? [];
                
                if (isset($validated['rating']) && $validated['rating'] > 0) {
                    $products = array_filter($products, function($product) use ($validated) {
                        return isset($product['rating']) && $product['rating'] >= $validated['rating'];
                    });
                }
                
                if (isset($validated['avgSales']) && $validated['avgSales'] > 0) {
                    $products = array_filter($products, function($product) use ($validated) {
                        return isset($product['dailyAvg']) && $product['dailyAvg'] >= $validated['avgSales'];
                    });
                }
                
                if (isset($validated['minProfit']) && $validated['minProfit'] > 0) {
                    $products = array_filter($products, function($product) use ($validated) {
                        return isset($product['profit']) && $product['profit'] >= $validated['minProfit'];
                    });
                }
                
                $products = array_values($products);

                return response()->json([
                    'success' => true,
                    'data' => [
                        'results' => $products,
                        'metadata' => [
                            'total' => count($products),
                            'keyword' => $validated['keyword'],
                            'timestamp' => now()->toIso8601String()
                        ]
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $response->json()['message'] ?? 'Failed to fetch products',
                'error' => 'API request failed'
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('Scouter Pro Exception', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => 'Internal server error'
            ], 500);
        }
    }

    public function health()
    {
        try {
            $response = Http::timeout(10)->get($this->backendUrl . '/health');
            $isHealthy = $response->successful();

            return response()->json([
                'status' => $isHealthy ? 'healthy' : 'unhealthy',
                'backend_api' => $isHealthy,
                'timestamp' => now()->toIso8601String()
            ], $isHealthy ? 200 : 503);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'unhealthy',
                'backend_api' => false,
                'error' => $e->getMessage(),
                'timestamp' => now()->toIso8601String()
            ], 503);
        }
    }
}