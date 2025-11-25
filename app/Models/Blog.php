<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title', 'excerpt', 'author', 'publish_date', 'image', 'category', 'content', 'slug','meta_description',
        'meta_keywords',
        'meta_author','video_url'
    ];

    // Automatically generate a slug from the title if not provided
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }
}
