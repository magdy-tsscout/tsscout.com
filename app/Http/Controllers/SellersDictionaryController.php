<?php

namespace App\Http\Controllers;

use App\Models\SellersDictionary;
use App\Models\SellersDictionaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellersDictionaryController extends Controller
{

    public function webIndex($categorySlug = null)
    {
        $categories = SellersDictionaryCategory::with('entries')->orderBy('name')->get();
        if( $categorySlug ) {
            $category = SellersDictionaryCategory::where('slug', $categorySlug)->firstOrFail();
            $entries = $category->entries()->orderBy('title')->get();
        } else {
            $category=null;
            $entries = SellersDictionary::with('category')->orderBy('title')->get();
        }
        return view('sellers-dictionary.web-index', compact('categories', 'categorySlug', 'category', 'entries'));
    }

    private function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $entries = SellersDictionary::with('category')->latest()->paginate(20);
        return view('sellers-dictionary.index', compact('entries'));
    }

    public function create()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $categories = SellersDictionaryCategory::orderBy('name')->get();
        return view('sellers-dictionary.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $request->validate([
            'category_id' => 'required|exists:sellers_dictionary_categories,id',
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
        ]);

        SellersDictionary::create($request->only('category_id', 'title', 'content'));

        return redirect()->route('admin.sellers-dictionary.index')->with('success', 'Entry created successfully.');
    }

    public function edit(SellersDictionary $sellersDictionary)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $categories = SellersDictionaryCategory::orderBy('name')->get();
        return view('sellers-dictionary.edit', compact('sellersDictionary', 'categories'));
    }

    public function update(Request $request, SellersDictionary $sellersDictionary)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $request->validate([
            'category_id' => 'required|exists:sellers_dictionary_categories,id',
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
        ]);

        $sellersDictionary->update($request->only('category_id', 'title', 'content'));

        return redirect()->route('admin.sellers-dictionary.index')->with('success', 'Entry updated successfully.');
    }

    public function destroy(SellersDictionary $sellersDictionary)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $sellersDictionary->delete();
        return redirect()->route('admin.sellers-dictionary.index')->with('success', 'Entry deleted successfully.');
    }
}
