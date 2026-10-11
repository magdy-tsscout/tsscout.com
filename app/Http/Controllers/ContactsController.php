<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactsController extends Controller
{
    private string $send_to;
    public function __construct() {
        $this->send_to = config('mail.send_to');
    }
    public function store(Request $request)  {
        $api_url = config('services.api.url').'support/';
        $response = Http::post($api_url, $request->all());
        // dd($response);
        if ($response->failed()) {
            return response()->json([
                'message' => 'Failed to submit contact form.',
                'request'=> $request->all(),
                'errors' => $response->json(),
                'url' => $api_url,

            ], 500);
        }
        return response()->json([
            'message' => 'Contact form submitted successfully.',
        ]);
    }
}
