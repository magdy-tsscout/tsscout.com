<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('header', function(Request $request) {
    $apiKey = $request->header('X-API-KEY');
    $validKey = env('APP_KEY');

    if (!$apiKey || $apiKey !== $validKey) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return view('header')->render();
});
