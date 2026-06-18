<?php

namespace App\Http\Controllers;

use App\Models\SellersDictionaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SellersDictionaryCategoryController extends Controller
{
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $categories = SellersDictionaryCategory::withCount('entries')->latest()->paginate(20);
        return view('sellers-dictionary-categories.index', compact('categories'));
    }

    public function create()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        return view('sellers-dictionary-categories.create');
    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sellers_dictionary_categories,slug',
        ]);

        SellersDictionaryCategory::create([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
        ]);

        return redirect()->route('admin.sellers-dictionary-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(SellersDictionaryCategory $sellersDictionaryCategory)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        return view('sellers-dictionary-categories.edit', compact('sellersDictionaryCategory'));
    }

    public function update(Request $request, SellersDictionaryCategory $sellersDictionaryCategory)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sellers_dictionary_categories,slug,' . $sellersDictionaryCategory->id,
        ]);

        $sellersDictionaryCategory->update([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
        ]);

        return redirect()->route('admin.sellers-dictionary-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(SellersDictionaryCategory $sellersDictionaryCategory)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $sellersDictionaryCategory->delete();
        return redirect()->route('admin.sellers-dictionary-categories.index')->with('success', 'Category deleted successfully.');
    }
}
