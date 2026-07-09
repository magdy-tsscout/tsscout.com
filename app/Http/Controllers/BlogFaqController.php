<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogFaq;
use Illuminate\Http\Request;

class BlogFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::findOrFail(request()->route('blog_id'));
        $blog_id = $blog->id;
        $faqs = BlogFaq::where('blog_id', $blog_id)->get();
        return view('admin.blog-faqs.index', compact('blog','faqs', 'blog_id'));
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
    public function store(Request $request, $blog_id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        BlogFaq::create([
            'blog_id' => $blog_id,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('admin.blog-faqs.index', $blog_id)
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogFaq $blogFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogFaq $blogFaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $blog_id)
    {
        if( $request->has('update') && $request->update == 'update') {
            return $this->bulkUpdate($request, $blog_id);
        }

        if( $request->has('delete') && $request->delete == 'delete') {

            return $this->buldDelete($request, $blog_id);
        }



        return $request->all();
    }



    private function bulkUpdate( Request $request, int $blog_id ) {
        BlogFaq::where('blog_id', $blog_id)->delete();

        for( $i = 0; $i < count($request->title); $i++ ) {
            BlogFaq::create([
                'blog_id' => $blog_id,
                'title' => $request->title[$i],
                'content' => $request->content[$i],
            ]);
        }

        return redirect()
            ->route('admin.blog-faqs.index', $blog_id)
            ->with('success', 'FAQs updated successfully.');
    }


    private function buldDelete( Request $request, int $blog_id ) {
       if(
            $request->has('delete_ids') &&
            is_array($request->delete_ids)
        ) {
            if(count($request->delete_ids) > 0) {
                BlogFaq::whereIn('id', $request->delete_ids)->delete();
                return redirect()
                    ->route('admin.blog-faqs.index', $blog_id)
                    ->with('success', 'Selected FAQs deleted successfully.');
            }elseif (count($request->delete_ids) == 0) {
                return redirect()
                    ->route('admin.blog-faqs.index', $blog_id)
                    ->with('error', 'No FAQs selected for deletion.');
            }
        }else{

            return redirect()
                ->route('admin.blog-faqs.index', $blog_id)
                ->with('error', 'No FAQs selected for deletion.');
        }
    }
}
