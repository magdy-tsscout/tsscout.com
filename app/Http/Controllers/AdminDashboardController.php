<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Faq;
use App\Models\Page;
use App\Models\tool;

class AdminDashboardController extends Controller
{
    public static function index()
    {
        $data = [
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::where('published', true)->count(),
            'draft_blogs' => Blog::where('published', false)->count(),
            'total_faqs' => Faq::count(),
            'total_pages' => Page::count(),
            'total_tools' => tool::count(),
            'recent_blogs' => Blog::orderBy('created_at', 'desc')->take(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
