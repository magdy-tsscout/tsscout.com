<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorDataController extends Controller
{

   public static function show($slug){
        $authorData = \App\Models\AuthorData::where('author_slug', $slug)->first();
        if (!$authorData) {
            abort(404);
        }
        $blogs = \App\Models\Blog::where('author_id', $authorData->id)->where("published", true)->orderBy('publish_date', 'desc')->limit(6);
        $blogs= $blogs->get();
        return view('author-data.show', compact('authorData', 'blogs'));
   }
   public static function edit() {
        $authorData = \App\Models\AuthorData::first();
        return view('author-data.edit', compact('authorData'));
    }

    public static function update(Request $request) {
        $authorData = \App\Models\AuthorData::first();
        $validatedData = $request->validate([
            'author_name' => 'nullable|string|max:255',
            'author_card' => 'nullable|string|max:255',
            'author_slug' => 'nullable|string|max:255',
            'author_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('author_img')) {
            $image = $request->file('author_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['author_img'] = $imageName;
        }

        $authorData->update($validatedData);

        return redirect()->back()->with('success', 'Author data updated successfully.');
    }
}
