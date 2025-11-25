{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Add blogs index page --}}
    <url>
        <loc>{{ url('/blogs') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Add tutorial page --}}
    <url>
        <loc>{{ url('/tutorial') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/blogs') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Add individual blog posts --}}
    @foreach ($blogs as $blog)
    <url>
        <loc>{{ url('/blogs/' . $blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->format('Y-m-d\TH:i:s\Z') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
