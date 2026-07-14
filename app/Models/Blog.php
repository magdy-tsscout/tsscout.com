<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Log;

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
                $author = Auth::user();
                if ($author) {
                    $blog->author_id = $author->id;
                }
            }
            if( empty($blog->scheduled_at) ) {
                $blog->scheduled_at = now();
            }
            if( isset($blog->id) ) {
                $author = Auth::user();
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


    function blogMedia() {
        if( isset($this->image) && !empty($this->image) ) {
            return '<a href="'. $this->blogUrl .'"><img src="'. 'https://tsscout.com/storage/app/public/' .$this->image .'" alt="'. $this->title .'"></a>';
        }
        if( $this->blog_type === 'tutorial' && !empty($this->video_url) ) {
            return '<iframe width="100%" height="315" src="'. $this->youtubeVideoEmbeddedUrl() .'" frameborder="0" allowfullscreen></iframe>';
        }else if( $this->blog_type === 'podcast' && !empty($this->image) ) {
            return '<img src="'. $this->podcast_url .'" alt="'. $this->title .'">';
        }
        return '<a href="'. $this->blogUrl .'"><img src="https://tsscout.com/public/images/logo.svg" alt="'. $this->title .'" height=196></a>';
    }

    /**
     * Strip FAQs from content and return them as an array.
     *
     * @return array
     */
    public function stripFAQs(string $content='')
    {
        // dd($content);
        $content = $content;
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(
            mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $keywords = ['faq', 'faqs', 'frequently asked questions', 'common questions', 'quick answers'];

        $beforeContent = '';
        $matchedElement = null;

        foreach ($xpath->query('//h2') as $h2) {
            foreach ($keywords as $keyword) {
                if (str_contains(strtolower(trim($h2->textContent)), $keyword)) {
                    $matchedElement = $h2;
                    break 2;
                }
            }
        }

        if (!$matchedElement) {
            return "";
        }

        $isAfter = false;

        foreach ($dom->documentElement->childNodes as $node) {
            if ($node === $matchedElement) {
                $isAfter = true;
                continue;
            }

            if (!$isAfter) {
                $beforeContent .= $dom->saveHTML($node);
            }
        }


        $beforeContent = strip_tags(trim($beforeContent??''));
        $beforeContent = str_replace('&nbsp;', ' ', $beforeContent);
        $beforeContent = preg_replace('/[ \t]+/', ' ', $beforeContent);
        $beforeContent = preg_replace('/\n+/', "\n", $beforeContent);
        $beforeContent = preg_replace('/\s+/', ' ', $beforeContent);
        $beforeContent = trim($beforeContent);
        return ($beforeContent );
    }


    function youtubeVideoEmbeddedUrl() {
        if( !empty($this->video_url) || !empty($this->podcast_url) ) {
            $url= !empty($this->video_url) ? $this->video_url : $this->podcast_url;
            return 'https://www.youtube.com/embed/'. $this->getYouTubeVideoId($url);
        }
        return null;
    }

    private function getYouTubeVideoId($url) {
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=|live/)|youtu\.be/)([^"&?/]{11})%i';

        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }

        return null;
    }


}
