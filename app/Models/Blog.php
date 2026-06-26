<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'author',
        'publish_date',
        'image',
        'category',
        'content',
        'slug',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'video_url',
        'published',
        'author_id'
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $attributes = [
        'published' => true,
    ];

    // Automatically generate a slug from the title if not provided
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            if( empty($blog->author_id) ) {
                $author = auth()->user();
                if ($author) {
                    $blog->author_id = $author->id;
                    // $blog->author = $author->name;
                }
            }
        });
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published'] = is_null($value) ? true : (bool) $value;
    }

    public static function blogsCountByCategory($category)
    {
        return self::where('category', $category)->count();
    }

    public function author_data() {
        return $this->hasOne(User::class, 'id', 'author_id')->select( 'author_name', 'author_card', 'author_slug', 'author_img');
    }
}
