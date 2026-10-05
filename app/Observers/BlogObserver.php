<?php

namespace App\Observers;

use App\Models\Blog;
use App\Models\PageRedir;
class BlogObserver
{
    public function updating(Blog $blog)
    {
        $request= request()->all();
        $blogOriginal= Blog::find($blog->id);
        if($request['slug'] !== $blogOriginal->slug) {
            PageRedir::create([
                'old_url' => "/blogs/{$blogOriginal->slug}",
                'new_url' => "/blogs/{$request['slug']}",
                'status_code' => 301,
                'url_type'=> 'relative'
            ]);
        }
    }
}
