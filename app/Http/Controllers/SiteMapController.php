<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Page;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;


class SiteMapController extends Controller
{

    public function pages() {
        $sitemap = Sitemap::create();
        $pages = Page::all();
        $this->addToSitemap($sitemap, "https://app.tsscout.com/pricing", Carbon::yesterday(), Url::CHANGE_FREQUENCY_MONTHLY, 0.6);
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
            $this->addToSitemap($sitemap, $route, Carbon::yesterday(), Url::CHANGE_FREQUENCY_MONTHLY, 0.6);
        }

        foreach ($pages as $page) {
            $this->addToSitemap($sitemap, "/{$page->slug}", $page->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.6);
        }
        return $sitemap;
    }

    # ##########################################################


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
        $domain = parse_url(config('app.url'), PHP_URL_HOST) ?: request()->getHost();
        $stylesheetHref = '//' . $domain . '/main-sitemap.xsl';

        $entries = [
            [
                'loc' => route('sitemap.pages'),
                'lastmod' => $this->latestPageLastMod(),
            ],
            [
                'loc' => route('sitemap.blog', ['slug' => 'blog']),
                'lastmod' => $this->latestBlogTypeLastMod('blog'),
            ],
            [
                'loc' => route('sitemap.blog', ['slug' => 'tutorial']),
                'lastmod' => $this->latestBlogTypeLastMod('tutorial'),
            ],
            [
                'loc' => route('sitemap.blog', ['slug' => 'podcast']),
                'lastmod' => $this->latestBlogTypeLastMod('podcast'),
            ],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<?xml-stylesheet type="text/xsl" href="' . e($stylesheetHref) . '"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as $entry) {
            $xml .= '    <sitemap>' . "\n";
            $xml .= '        <loc>' . e($entry['loc']) . '</loc>' . "\n";
            $xml .= '        <lastmod>' . $entry['lastmod'] . '</lastmod>' . "\n";
            $xml .= '    </sitemap>' . "\n";
        }

        $xml .= '</sitemapindex>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    # ##########################################################
    /**
     * Generate sitemap for a specific blog type
     *
     * Creates a sitemap containing published blogs of a specific type (blog, tutorial, podcast)
     *
     * @param string $blog_type The blog type to generate sitemap for (e.g., 'blog', 'tutorial', 'podcast')
     * @return \Spatie\Sitemap\Sitemap The sitemap object containing blog URLs for the specified type
     */
    public function blog(string $blog_type) {
        if( !in_array($blog_type,['blog', 'tutorial', 'podcast'] ) ) return abort(404);
        $sitemap = Sitemap::create();
        foreach ($this->BlogByType($blog_type) as $blog) {
            $this->addToSitemap($sitemap, "/{$blog_type}/{$blog->slug}", $blog->updated_at, Url::CHANGE_FREQUENCY_WEEKLY, 0.8);
        }
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

    private function latestBlogTypeLastMod(string $type): string
    {
        $lastModified = Blog::query()
            ->where('published', true)
            ->where('publish_date', '<=', now())
            ->where('blog_type', $type)
            ->max('updated_at');

        return Carbon::parse($lastModified ?? now())->toAtomString();
    }

    private function latestPageLastMod(): string
    {
        $lastModified = Page::query()->max('updated_at');

        return Carbon::parse($lastModified ?? now())->toAtomString();
    }
    # ##########################################################

}
