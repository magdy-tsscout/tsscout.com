<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactsController extends Controller
{
    private string $send_to;
    public function __construct() {
        $this->send_to = config('mail.send_to');
    }
    public function store(Request $request)  {

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://app.tsscout.com/api/support?email=Megane%40gmail.com&subject=test-api&message=this+is+message+body+1791806885&name=Megane+Schneider",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
return $response;
        $api_url = config('services.api.url').'support/';
        $payload = [
            'name' => $request->input('name'),
            'subject' => $request->input('subject')??'',
            'email' => $request->input('email')??'',
            'message' => $request->input('message')??'',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Content-Type: application/json"
            ],
            CURLOPT_FOLLOWLOCATION => false,
        ]);

        $response = curl_exec($curl);
        dd($response);
        $err = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($err) {
            return response()->json([
                'message' => 'cURL Error: ' . $err,
            ], 500);
        } elseif ($httpCode >= 400) {
            $responseData = json_decode($response, true);
            return response()->json([
                'message' => 'Failed to submit contact form.',
                'request'=> $request->all(),
                'errors' => $responseData ?? [],
                'url' => $api_url,
            ], 500);
        }
        return response()->json([
            'message' => 'Contact form submitted successfully.',
        ]);
    }
}
