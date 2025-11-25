<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Page; // Assuming you have a Page model for dynamic routes
use App\Models\Blog;
use App\Models\Faq;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate'; // Command signature
    protected $description = 'Generate a dynamic sitemap for the website';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Create a new Sitemap instance
        $sitemap = Sitemap::create();

        // Static Routes
        $staticRoutes = [
            '/',
            'https://app.dropshippingscout.com/login',
            'https://app.dropshippingscout.com/register',
            'https://app.dropshippingscout.com/pricing',
            '/blogs',
            '/tutorial',
            '/faqs'
        ];

        foreach ($staticRoutes as $route) {
            $sitemap->add(Url::create($route)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        // Dynamic Blog Routes
        $blogs = Blog::all();
        foreach ($blogs as $blog) {
            $sitemap->add(Url::create("/blogs/{$blog->slug}")
                ->setLastModificationDate($blog->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        }


        // Dynamic Pages based on {slug} route
        $pages = Page::all(); // Assuming your dynamic pages have a Page model
        foreach ($pages as $page) {
            $sitemap->add(Url::create("/{$page->slug}")
                ->setLastModificationDate($page->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.6));
        }

        // Save the sitemap to the public directory
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap has been generated successfully.');
    }
}
