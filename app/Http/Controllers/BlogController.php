<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Blog;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\IOFactory;

class BlogController extends Controller
{

    private function isAdmin()
    {
        // return true;
        return Auth::check() && Auth::user()->is_admin; // Ensure user is authenticated and is an admin
    }
    public function create()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        return view('blogs.create');


    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            // return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }





        //Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'author' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'media_type' => 'required|string|in:image,video,podcast',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_author' => 'nullable|string|max:255',
            'slug' => 'required|string|max:60|unique:blogs',
            'category' => 'required|string|max:255',
            'content' => 'required_without:word_file',
            'word_file' => 'nullable|file|mimes:doc,docx|max:10240',
            'published' => 'boolean',
            'scheduled_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'podcast_url' => 'nullable|url',
        ]);

        if ($request->hasFile('word_file')) {
            try {
                $validatedData['content'] = $this->convertWordToHtml($request->file('word_file'));
            } catch (\Throwable $exception) {
                return back()->withErrors(['word_file' => 'Unable to convert the uploaded Word file. Please verify the file and try again.'])->withInput();
            }
        }

        unset($validatedData['word_file']);



        if( $request->input('published') === null ) {
            $validatedData['published'] = false;
        }



        if ($validatedData['media_type'] === 'image') {
            // Handle image upload
            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('images', 'public');

            } else {
                return back()->withErrors(['image' => 'Image is required if media type is set to image.'])->withInput();
            }
            $validatedData['video_url'] = null; // No video for this blog
        } elseif ($validatedData['media_type'] === 'video') {
            // Ensure video URL is present
            if (empty($request->video_url)) {
                return back()->withErrors(['video_url' => 'Video URL is required if media type is set to video.'])->withInput();
            }
            $validatedData['image'] = null; // No image for this blog
            $validatedData['video_url'] = $request->input('video_url'); // Set the video URL
        } elseif ($validatedData['media_type'] === 'podcast') {
            // Ensure podcast URL is present
            if (empty($request->podcast_url)) {
                return back()->withErrors(['podcast_url' => 'Podcast URL is required if media type is set to podcast.'])->withInput();
            }
            $validatedData['image'] = null; // No image for this blog
            $validatedData['video_url'] = null; // No video for this blog
            $validatedData['podcast_url'] = $request->input('podcast_url'); // Set the podcast URL
        }


        // Create a new blog entry
        $blog=Blog::create($validatedData);

        return redirect()->route('blogs.index', ['slug'=>$blog->slug,'id'=>$blog->id, 'saved'=>1, 'draft'=>$validatedData['published'] ? 0 : 1])->with('success', "Blog \"{$blog->title}\" created successfully.");
    }




    public function index(Request $request, $blog_type = null)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $search = trim((string) request('search', ''));
        $category = trim((string) request('category', ''));

        $blogsQuery = Blog::query();

        if( $blog_type !== null ) {
            $blogsQuery->where('blog_type', $blog_type);
        }


        if ($search !== '') {
            $blogsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $published = trim((string) request('published', ''));
        if ($published !== '') {
            $blogsQuery->where('published', $published);
        }

        // Retrieve blogs for display
        $blogs = $blogsQuery->orderByDesc('publish_date')->paginate(20)->appends(request()->query());


        $categories = Blog::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function edit(Blog $blog)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }
        // Return the edit view with the blog data
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {


        $blog = Blog::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'author' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'media_type' => 'required|string|in:image,video,podcast',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'slug' => 'required|string|max:60|unique:blogs,slug,' . $blog->id,
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_author' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required_without:word_file',
            'word_file' => 'nullable|file|mimes:doc,docx|max:10240',
            'published'=> 'boolean',
            'scheduled_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'podcast_url' => 'nullable|url',
        ]);

        if ($request->hasFile('word_file')) {
            try {
                $validatedData['content'] = $this->convertWordToHtml($request->file('word_file'));
            } catch (\Throwable $exception) {
                return back()->withErrors(['word_file' => 'Unable to convert the uploaded Word file. Please verify the file and try again.'])->withInput();
            }
        }

        unset($validatedData['word_file']);



        if ($validatedData['media_type'] === 'image') {
            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')->store('images', 'public');
            }
            $validatedData['video_url'] = null; // No video for this blog
            $validatedData['podcast_url'] = null; // No podcast for this blog
        } elseif ($validatedData['media_type'] === 'video') {
            $validatedData['image'] = null; // No image for this blog
            $validatedData['video_url'] = $request->input('video_url'); // Set the video URL
            $validatedData['podcast_url'] = null; // No podcast for this blog
        } elseif ($validatedData['media_type'] === 'podcast') {
            $validatedData['image'] = null; // No image for this blog
            $validatedData['video_url'] = null; // No video for this blog
            $validatedData['podcast_url'] = $request->input('podcast_url'); // Set the podcast URL
        }

        if( $request->input('published') === null ) {
            $validatedData['published'] = false;
        }


        // Update the blog entry with the validated data
        $blog->update($validatedData);

        return redirect()->route('blogs.index', ['slug'=>$blog->slug,'id'=>$blog->id, 'saved'=>1, 'draft'=>$validatedData['published'] ? 0 : 1])->with('success', "Blog \"{$blog->title}\" updated successfully.");
    }


    public function like($id)
    {
       $blog = Blog::findOrFail($id);
       $blog->increment('likes'); // Increment the likes count
       return response()->json(['likes' => $blog->likes]); // Return the updated likes count
     }



    public function destroy(Blog $blog)
    {
        // Delete the blog entry
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function userIndex()
     {
        // Retrieve all blogs
        $blogsQuery = Blog::where('blog_type', 'blog')
            ->where('published', true)
            ->where('scheduled_at', '<=', \Carbon\Carbon::now())
            ->orderBy('publish_date', 'desc');
            // @dd($blogsQuery->toRawSql());
            $blogs=  $blogsQuery->get();


        // Retrieve the page data where 'view_name' equals 'blogs'
        $page = Page::where('view_name', 'blogs')->first();

        // Check if the page data exists to avoid errors
        if (!$page) {
            return response()->view('404', [], 404);
        }


        $schemaBlogs = $blogs->map(function ($blog) {
            return [
                "@context" => "https://schema.org",
                "@type" => "BlogPosting",
                "headline" => $blog->title,
                "image" => $blog->image ? asset('storage/' . $blog->image) : null,
                "author" => [
                    "@type" => "Person",
                    "name" => $blog->author,
                ],
                "datePublished" => \Carbon\Carbon::parse($blog->publish_date)->toIso8601String(),
                "dateModified" => \Carbon\Carbon::parse($blog->updated_at)->toIso8601String(),
                "description" => $blog->excerpt,
                "url" => route('blogs.show', ['slug' => $blog->slug]),
            ];
        });

        // Pass both blogs and page data to the view
        return view('blogs', compact('blogs', 'page', 'schemaBlogs'));
    }

    public function userTutorial() {
    // Retrieve blogs where video_url is not null and image is null
    $blogs = Blog::whereNotNull('video_url')
                 ->whereNull('image')
                 ->where('blog_type', 'tutorial')
                 ->where('published', true)
                 ->where('scheduled_at', '<=', \Carbon\Carbon::now())
                 ->get();
    // Retrieve the page data where 'view_name' equals 'blogs'
    $page = Page::where('view_name', 'blogs')->first();

    // Pass both blogs and page data to the view
    $schemaBlogs = $blogs->map(function ($blog) {
        return [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $blog->title,
            "image" => $blog->image ? asset('storage/' . $blog->image) : null,
            "author" => [
                "@type" => "Person",
                "name" => $blog->author,
            ],
            "datePublished" => \Carbon\Carbon::parse($blog->publish_date)->toIso8601String(),
            "dateModified" => \Carbon\Carbon::parse($blog->updated_at)->toIso8601String(),
            "description" => $blog->excerpt,
            "url" => route('blogs.show', ['slug' => $blog->slug]),
        ];
    });
    $page_title = 'Tutorials';
    return view('blogs', compact('blogs', 'page', 'schemaBlogs', 'page_title'));
   }

    public function userPodcast() {
    // Retrieve blogs where video_url is not null and image is null
        $blogs = Blog
                 ::where('blog_type', 'podcast')
                 ->where('published', true)
                 ->where('scheduled_at', '<=', \Carbon\Carbon::now());
        $blogs= $blogs->get();
        // Retrieve the page data where 'view_name' equals 'blogs'
        $page = Page::where('view_name', 'blogs')->first();

        // Pass both blogs and page data to the view
        $schemaBlogs = $blogs->map(function ($blog) {
            return [
                "@context" => "https://schema.org",
                "@type" => "BlogPosting",
                "headline" => $blog->title,
                "image" => $blog->image ? asset('storage/' . $blog->image) : null,
                "author" => [
                    "@type" => "Person",
                    "name" => $blog->author,
                ],
                "datePublished" => \Carbon\Carbon::parse($blog->publish_date)->toIso8601String(),
                "dateModified" => \Carbon\Carbon::parse($blog->updated_at)->toIso8601String(),
                "description" => $blog->excerpt,
                "url" => route('blogs.show', ['slug' => $blog->slug]),
            ];
        });
        $page_title = 'Podcasts';

        return view('blogs', compact('blogs', 'page', 'schemaBlogs', 'page_title'));
   }



   public function show(string $slug): \Illuminate\Contracts\View\View|\Illuminate\Http\Response| \Illuminate\Http\RedirectResponse

   {
        // Find the blog by slug
        $blog = Blog::where('slug', $slug);

        if( !Auth::check() ) {
            $blog->where('published', true);
        }
        $blog= $blog->first();
        dd( response()->route()->getName());;
        if( $blog->blog_type == 'tutorial' ) {
            return redirect(route('tutorial.show', ['slug'=>$slug]), 301);
        }

        // If the blog does not exist, return the custom 404 view
        if (!$blog) {
            return response()->view('404', [], 404);
        }

        // Read headings for TOC without mutating stored HTML content.
        $headings = [];
        $dom = new \DOMDocument();
        if (@$dom->loadHTML('<?xml encoding="utf-8" ?>' . $blog->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)) {
            $tags = $dom->getElementsByTagName('h2');
            foreach ($tags as $index => $tag) {
                $text = $this->normalizeTitles($tag->textContent);
                if ($text) {
                    $headingId = trim((string) $tag->getAttribute('id'));
                    if ($headingId === '') {
                        $headingId = 'header' . $index;
                    }

                    $headings[] = [
                        'level' => 2,
                        'text' => $text,
                        'id' => $headingId,
                    ];
                }
            }
        }

        // Retrieve the page data
        $page = Page::where('view_name', 'blogs')->first();

        if (!$page) {
            return response()->view('404', [], 404);
        }

        // Related blogs
        $relatedBlogs = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->where('published', true)
            ->where('scheduled_at', '<=', \Carbon\Carbon::now())
            ->get();
        $display_author_card = request()->route() !== null && request()->route()->getName() !== 'podcast.show';

        $faqsAll = $blog->faqs()->get();
        $faqs = [];
        if (!empty($faqsAll)) {
            foreach ( $faqsAll as $faq) {
                $faqs[] = [
                    'title' => $faq->title,
                    'content' => $faq->content,
                ];
            }
        }

       return view('blog-details', compact('blog', 'headings', 'page', 'relatedBlogs', 'display_author_card', 'faqs'));
   }

   public function sitemap()
   {
       // Get all blogs
       $blogs = Blog::orderBy('updated_at', 'desc')->get();

       return response()->view('sitemaps.blog-sitemap', compact('blogs'))
           ->header('Content-Type', 'application/xml')
           ->header('Cache-Control', 'public, max-age=3600');
   }

   # ##########################################################
   private function normalizeTitles( string $text='') : string {
        $text = trim($text);
        $text= preg_replace('/\s+/', ' ', $text);
        $text= preg_replace('/\r|\n|\t/', '', $text);
        return $text;
   }

   private function convertWordToHtml(UploadedFile $wordFile): string
   {
       $phpWord = IOFactory::load($wordFile->getRealPath());
       $tempHtmlPath = tempnam(sys_get_temp_dir(), 'blog_word_');

       if ($tempHtmlPath === false) {
           throw new \RuntimeException('Failed to prepare temporary file for Word conversion.');
       }

       IOFactory::createWriter($phpWord, 'HTML')->save($tempHtmlPath);
       $fullHtml = (string) file_get_contents($tempHtmlPath);
       @unlink($tempHtmlPath);

       if ($fullHtml === '') {
           throw new \RuntimeException('Converted Word document is empty.');
       }

       if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $fullHtml, $matches) === 1) {
           return trim($matches[1]);
       }

       return trim($fullHtml);
   }




}
