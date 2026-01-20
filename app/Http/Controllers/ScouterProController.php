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

            // Log the request for debugging
            Log::info('Scouter Pro API Request', [
                'url' => $this->backendUrl . '/research',
                'keyword' => $validated['keyword'],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $products = $data['results'] ?? [];
                $fallbackMode = $data['fallbackMode'] ?? false;
                $fallbackReason = $data['fallbackReason'] ?? null;
                $dataProvenance = $data['dataProvenance'] ?? null;

                Log::info('Scouter Pro API Success', [
                    'products_count' => count($products),
                    'keyword' => $validated['keyword'],
                    'fallbackMode' => $fallbackMode,
                ]);

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
                    'fallbackMode' => $fallbackMode,
                    'fallbackReason' => $fallbackReason,
                    'data' => [
                        'results' => $products,
                        'dataProvenance' => $dataProvenance,
                        'metadata' => [
                            'total' => count($products),
                            'keyword' => $validated['keyword'],
                            'timestamp' => now()->toIso8601String()
                        ]
                    ]
                ]);
            }

            // Log detailed error info when API fails
            Log::error('Scouter Pro API Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
                'keyword' => $validated['keyword'],
                'url' => $this->backendUrl . '/research',
            ]);

            return response()->json([
                'success' => false,
                'message' => $response->json()['message'] ?? 'Failed to fetch products',
                'error' => 'API request failed',
                'debug_status' => $response->status()
            ], $response->status() ?: 500);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Scouter Pro Connection Error', [
                'message' => $e->getMessage(),
                'url' => $this->backendUrl . '/research',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to connect to product database. Please try again.',
                'error' => 'Connection timeout'
            ], 503);

        } catch (\Exception $e) {
            Log::error('Scouter Pro Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
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

    /**
     * Diagnostic endpoint to test backend API connection
     */
    public function diagnose()
    {
        $diagnostics = [
            'timestamp' => now()->toIso8601String(),
            'backend_url' => $this->backendUrl,
            'timeout' => $this->timeout,
            'tests' => []
        ];

        // Test 1: Health endpoint
        try {
            $healthResponse = Http::timeout(10)->get($this->backendUrl . '/health');
            $diagnostics['tests']['health'] = [
                'status' => $healthResponse->status(),
                'success' => $healthResponse->successful(),
                'body' => $healthResponse->json()
            ];
        } catch (\Exception $e) {
            $diagnostics['tests']['health'] = [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }

        // Test 2: Research endpoint with test keyword
        try {
            $researchResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->timeout(30)
            ->post($this->backendUrl . '/research', [
                'keyword' => 'phone case',
                'profitMargin' => 0.30,
                'salesThreshold' => 10,
                'maxResults' => 5,
            ]);

            $diagnostics['tests']['research'] = [
                'status' => $researchResponse->status(),
                'success' => $researchResponse->successful(),
                'body' => $researchResponse->json()
            ];
        } catch (\Exception $e) {
            $diagnostics['tests']['research'] = [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($diagnostics);
    }
}