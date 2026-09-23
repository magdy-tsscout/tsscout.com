<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Faq;
use Carbon\Carbon;


class SiteMapController extends Controller
{
    /**
     * Generate sitemap XML with static and dynamic routes
     *
     * Creates a sitemap containing:
     * - Static routes (home, login, register, pricing, blogs, tutorial, faqs)
     * - Dynamic blog routes based on published blogs
     * - Dynamic pages based on page slugs
     *
     * @return \Spatie\Sitemap\Sitemap The sitemap object to be output as XML
     */
    public function generate()
    {
        $sitemap = Sitemap::create();

        // Static Routes
        $staticRoutes = [
            url('/'),
            'https://app.tsscout.com/login',
            'https://app.tsscout.com/register',
            'https://app.tsscout.com/pricing',
            url('/blogs'),
            url('/tutorial'),
            url('/faqs'),
        ];

        foreach ($staticRoutes as $route) {
            $sitemap->add(Url::create($route)
                ->setLastModificationDate(Carbon::yesterday())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        // Dynamic Blog Routes
        foreach ($this->BlogByType('blog') as $blog) {
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

        // output the sitemap as XML response
        return $sitemap;
    }

    # ##########################################################
     /**
         * Get published blogs of a specific type
         *
         * Filters blogs by:
         * - Published status (true)
         * - Publish date (must be in the past)
         * - Blog type (default: 'blog')
         *
         * @param string $type The blog type to filter by (default: 'blog')
         * @return \Illuminate\Database\Eloquent\Collection Collection of Blog models
         */
    private function BlogByType($type='blog')
    {
        return Blog::
            where('published', true)
            ->where('publish_date','<=', now())
            ->where('blog_type',$type)
            ->get();
    }
}
