<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TitleBuilderController extends Controller
{
    public function searchTitle(Request $request)
    {
        $validated = $request->validate([
            'search_term' => 'required|string',
            'country_id' => 'required|integer',
        ]);

        try {
            // Call the external API
            $response = Http::withHeaders([
                'api-key' => '0ecf050c-8668-45f2-844d-0a350b54625a',
            ])->post('http://164.90.165.80/shopify-api/public/index.php/api/title-builder', [
                'search_term' => $validated['search_term'],
                'country_id' => $validated['country_id'],
            ]);

            // Return the data to the frontend
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json(['message' => 'API Error'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server Error', 'error' => $e->getMessage()], 500);
        }
    }
}
