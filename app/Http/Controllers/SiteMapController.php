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
        // Initialize the sitemap object
        $sitemap = Sitemap::create();

        // Static Routes - Add predefined static URLs to the sitemap
        $staticRoutes = [
            url('/'),
            'https://app.tsscout.com/login',
            'https://app.tsscout.com/register',
            'https://app.tsscout.com/pricing',
            url('/blogs'),
            url('/tutorial'),
            url('/faqs'),
        ];

        // Add each static route to the sitemap with weekly change frequency and high priority
        foreach ($staticRoutes as $route) {
            $this->addToSitemap($sitemap, $route, Carbon::yesterday(), Url::CHANGE_FREQUENCY_WEEKLY, 0.9);
        }

        // Dynamic Blog Routes - Add published blogs for each blog type (blog, tutorial, podcast)
        $blog_types = ['blog', 'tutorial', 'podcast'];
        foreach ($blog_types as $blog_type) {
            // Get published blogs of the current type
            foreach ($this->BlogByType($blog_type) as $blog) {
                // Add blog route with weekly change frequency and medium priority
                $this->addToSitemap($sitemap, "/{$blog_type}/{$blog->slug}", $blog->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.8);
            }
        }

        // Dynamic Pages - Add all pages from the database
        $pages = Page::all();
        foreach ($pages as $page) {
            // Add page route with weekly change frequency and low priority
            $this->addToSitemap($sitemap, "/{$page->slug}", $page->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.6);
        }

        // Output the sitemap as XML response
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
        // Query published blogs of the specified type
        // Filter by published status, past publish date, and blog type
        return Blog::
            where('published', true)           // Only include published blogs
            ->where('publish_date','<=', now()) // Only include blogs published in the past
            ->where('blog_type',$type)         // Filter by blog type (blog, tutorial, podcast, etc.)
            ->get();                           // Execute the query and return results
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
        // Create a new URL entry and add it to the sitemap
        $sitemap->add(Url::create($url)
            ->setLastModificationDate($lastModDate)  // Set the last modification date
            ->setChangeFrequency($changeFreq)        // Set how frequently the URL changes
            ->setPriority($priority));               // Set the priority of this URL (0.0 to 1.0)
    }
    # ##########################################################

}
