<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class EbayCalculatorController extends Controller
{
    public function index()
    {
        return view('calculator.index', [
            'ebay_title'=> 'USA eBay Fee Calculator'
        ]);
    }


    public function uk() {
        return view('calculator.uk', [
            'ebay_title'=> 'UK eBay Fee Calculator'
        ]);
    }
    public function au() {
        return view('calculator.au', [
            'ebay_title'=> 'AU eBay Fee Calculator'
        ]);
    }

    public function ca() {
        return view('calculator.ca', [
            'ebay_title'=> 'CA eBay Fee Calculator'
        ]);
    }

    public function de() {
        return view('calculator.de', [
            'ebay_title'=> 'DE eBay Fee Calculator'
        ]);
    }


    public function fr() {
        return view('calculator.fr', [
            'ebay_title'=> 'fr eBay Fee Calculator'
        ]);
    }

    public function it() {
        return view('calculator.it', [
            'ebay_title'=> 'it eBay Fee Calculator'
        ]);
    }

    # ##########################################################
    public function calculateFees(Request $request)
    {
        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";

        $url="164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/usa?".implode("&",$ar);
        // dd($url);
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post($url);
       $result=  $response->json() ;


       $requestData = (object) $request->all();
       return view('calculator.index', [
            'result' => $result,
            'request'=>$requestData,
            'ebay_title'=> 'USA eBay Fee Calculator'
       ]);
    }
    # ##########################################################

    public function ukFees(Request $request)
    {
        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post("164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/uk?".implode("&",$ar));
       $result=  $response->json() ;


       // $request->all() to object
       $requestData = (object) $request->all();

       return view('calculator.au', [
            'ebay_title'=> 'au eBay Fee Calculator Result',
            'request'=>$requestData,
            'result' => $result,
        ]);
    }
    # ##########################################################
    public function auFees(Request $request)
    {
        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post("164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/au?".implode("&",$ar));
       $result=  $response->json() ;


       // $request->all() to object
       $requestData = (object) $request->all();

       return view('calculator.au', [
            'ebay_title'=> 'AU eBay Fee Calculator Result',
            'request'=>$requestData,
            'result' => $result,
        ]);
    }
    # ##########################################################
    function caFees( Request $request ) {

        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post("http://164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/ca?".implode("&",$ar));
       $result=  $response->json() ;

       // $request->all() to object
       $requestData = (object) $request->all();

       return view('calculator.ca', [
            'ebay_title'=> 'CA eBay Fee Calculator Result',
            'request'=>$requestData,
            'result' => $result,
        ]);
    }
    # ##########################################################
    function deFees( Request $request ) {

        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post("http://164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/de?".implode("&",$ar));
       $result=  $response->json() ;

       // $request->all() to object
       $requestData = (object) $request->all();

       return view('calculator.ca', [
            'ebay_title'=> 'CA eBay Fee Calculator Result',
            'request'=>$requestData,
            'result' => $result,
        ]);
    }
    # ##########################################################
    function frFees( Request $request ) {

        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post("http://164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/fr?".implode("&",$ar));
       $result=  $response->json() ;

       // $request->all() to object
       $requestData = (object) $request->all();

       return view('calculator.fr', [
            'ebay_title'=> 'FR eBay Fee Calculator Result',
            'request'=>$requestData,
            'result' => $result,
        ]);
    }
    # ##########################################################

    function itFees( Request $request ) {

        $ar=[]; foreach ( $request->all() as $k=>$v ) $ar[]="{$k}={$v}";
        $response = Http::withHeaders([
            'api-key' => '1d95bfb7-b38a-50e4-b5f9-cb348deb4021'
       ])->post("http://164.90.165.80/shopify-api/public/index.php/api/ebay-calculator/it?".implode("&",$ar));
       $result=  $response->json() ;

       // $request->all() to object
       $requestData = (object) $request->all();

       return view('calculator.fr', [
            'ebay_title'=> 'IT eBay Fee Calculator Result',
            'request'=>$requestData,
            'result' => $result,
        ]);
    }

}
