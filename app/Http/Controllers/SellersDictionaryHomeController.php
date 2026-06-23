<?php

namespace App\Http\Controllers;

use App\Models\SellersDictionaryHome;
use Illuminate\Http\Request;

class SellersDictionaryHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SellersDictionaryHome $sellersDictionaryHome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $sellersDictionaryHome = SellersDictionaryHome::first();
        return view('sellers-dictionary.home.edit', compact('sellersDictionaryHome'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $sellersDictionaryHome = SellersDictionaryHome::first();
        $sellersDictionaryHome->update($request->only('title', 'content'));

        return redirect()->back()->with('success', 'Sellers Dictionary Home content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SellersDictionaryHome $sellersDictionaryHome)
    {
        //
    }


}
