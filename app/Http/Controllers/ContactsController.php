<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactsController extends Controller
{
    private string $send_to;
    public function __construct() {
        $this->send_to = config('mail.send_to');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $apiUrl = rtrim((string) config('services.api.url'), '/');

        if ($apiUrl === '') {
            return response()->json([
                'success' => false,
                'message' => 'Support service is not configured.',
            ], 500);
        }

        $response = Http::asForm()
            ->acceptJson()
            ->withHeaders([
                'X-Requested-With' => 'XMLHttpRequest',
                'API-KEY' => (string) env('API_KEY'),
                'API-SECRET' => (string) env('API_SECRET'),
            ])
            ->post($apiUrl . '/support', $validated);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => data_get($response->json(), 'message', 'Contact form submitted successfully.'),
            ]);
        }

        if ($response->status() === 422) {
            return response()->json([
                'success' => false,
                'errors' => data_get($response->json(), 'errors', []),
                'message' => data_get($response->json(), 'message', 'Validation failed.'),
            ], 422);
        }

        return response()->json([
            'success' => false,
            'message' => data_get($response->json(), 'message', 'Failed to submit contact form.'),
        ], $response->status() >= 400 ? $response->status() : 500);
    }
}
