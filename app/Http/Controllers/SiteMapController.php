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
            $this->addToSitemap($sitemap, $route, Carbon::yesterday(), Url::CHANGE_FREQUENCY_WEEKLY, 0.9);
        }

        foreach ($this->BlogByType('blog') as $blog) {
            $this->addToSitemap($sitemap, "/blogs/{$blog->slug}", $blog->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.8);
        }

        foreach ($this->BlogByType('tutorial') as $blog) {
            $this->addToSitemap($sitemap, "/tutorial/{$blog->slug}", $blog->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.8);
        }

        foreach ($this->BlogByType('podcast') as $blog) {
            $this->addToSitemap($sitemap, "/podcast/{$blog->slug}", $blog->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.8);
        }

        // Dynamic Pages based on {slug} route
        $pages = Page::all(); // Assuming your dynamic pages have a Page model
        foreach ($pages as $page) {
            $this->addToSitemap($sitemap, "/{$page->slug}", $page->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.6);
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
    # ##########################################################

    /**
     * Add an entry to the sitemap
     *
     * Creates and adds a URL entry to the sitemap with specified metadata
     *
     * @param \Spatie\Sitemap\Sitemap $sitemap The sitemap object to add the entry to
     * @param string $url The URL to add to the sitemap
     * @param \Carbon\Carbon $lastModDate The last modification date of the URL
     * @param string $changeFreq The change frequency (weekly, daily, monthly, yearly, never)
     * @param float $priority The priority of the URL (0.0 to 1.0)
     */
    private function addToSitemap($sitemap, $url, $lastModDate, $changeFreq, $priority)
    {
        $sitemap->add(Url::create($url)
            ->setLastModificationDate($lastModDate)
            ->setChangeFrequency($changeFreq)
            ->setPriority($priority));
    }
    # ##########################################################

}
