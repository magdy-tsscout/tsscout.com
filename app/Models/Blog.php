<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'author_id',
        'scheduled_at',
        'updated_by',
        'meta_title',
        'blog_type',
        'podcast_url',
    ];

    protected $casts = [
        'published' => 'boolean',
        'scheduled_at' => 'datetime',
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
            }else {
                if(isset($blog->id) ) {
                    // don't update old blogs
                    // $blog->slug = Str::slug($blog->slug);
                }
            }

            if( empty($blog->meta_title) ) {
                $blog->meta_title = $blog->title;
            }

            if( empty($blog->author_id) ) {
                $author = auth()->user();
                if ($author) {
                    $blog->author_id = $author->id;
                }
            }
            if( empty($blog->scheduled_at) ) {
                $blog->scheduled_at = now();
            }
            if( isset($blog->id) ) {
                $author = auth()->user();
                if ($author) {
                    $blog->updated_by = $author->id;
                }
            }

            if( empty($blog->blog_type) ) {
                if( !empty($blog->video_url) ) {
                    $blog->blog_type = 'tutorial';
                }else if( !empty($blog->podcast_url) ) {
                    $blog->blog_type = 'podcast';
                }else {
                    $blog->blog_type = 'blog';
                }
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnPublished($query)
    {
        return $query->where('published', false);
    }

    public function scopeScheduled7Days($query)
    {
        return $query
            ->where('scheduled_at', '>=', now())
            ->where('scheduled_at', '<=', now()->addDays(7));
    }

    public function scopeScheduled30Days($query)
    {
        return $query
            ->where('scheduled_at', '>=', now())
            ->where('scheduled_at', '<=', now()->addDays(30));
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

    public function updated_by_data() {
        return $this->hasOne(User::class, 'id', 'updated_by')->select( 'author_name', 'author_card', 'author_slug', 'author_img');
    }

    public function faqs() {
        return $this->hasMany(BlogFaq::class, 'blog_id');
    }

    public function faqs_count() {
        return $this->faqs()->count();
    }

    public static function blogByType(string|null $blog_type) {
        if( $blog_type === null ) {
            return self::get();
        }
        return self::where('blog_type', $blog_type)->get();
    }

    public function blogUrl() : Attribute{
        return Attribute::get(function () {
            $type = $this->blog_type;

            switch ($type) {
                case 'blog':
                    return route('blogs.show', ['slug' => $this->slug]);
                case 'tutorial':
                    return route('tutorial.show', ['slug' => $this->slug]);
                case 'podcast':
                    return route('podcast.show', ['slug' => $this->slug]);
                default:
                    return '#';
            }
        });
    }
}
