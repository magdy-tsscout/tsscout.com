@php
    $currentUrl = url()->current();
    $currentPath = trim(request()->path(), '/');
    $segments = request()->segments();
    $pageTitle = trim($__env->yieldContent('title', ''));
    $pageDescription = trim($__env->yieldContent('meta_description', ''));
    $schemaText = trim(preg_replace('/\s+/', ' ', strip_tags($__env->yieldContent('schema_text', ''))));
    $isHomePage = $currentPath === '';
    $segmentLabels = [
        'ai-tool' => 'AI Tool',
        'affiliate' => 'Affiliate',
        'affiliate-program' => 'Affiliate Program',
        'author' => 'Author',
        'blogs' => 'Blogs',
        'calculator' => 'Calculator',
        'competitor-monitoring' => 'Competitor Monitoring',
        'contact-us' => 'Contact Us',
        'ebay-calculator' => 'eBay Calculator',
        'faqs' => 'FAQs',
        'landing-pages' => 'Landing Pages',
        'privacy-policy' => 'Privacy Policy',
        'product-scouting' => 'Product Scouting',
        'refund-policy' => 'Refund Policy',
        'sellers-dictionary' => 'Sellers Dictionary',
        'shopify-detector' => 'Shopify Detector',
        'suppliers-scouting' => 'Suppliers Scouting',
        'terms-conditions' => 'Terms & Conditions',
        'tutorial' => 'Tutorial',
    ];

    $breadcrumbItems = [
        [
            'name' => 'Home',
            'url' => url('/'),
        ],
    ];

    $runningPath = '';

    foreach ($segments as $index => $segment) {
        $runningPath .= '/' . $segment;
        $isLast = $index === array_key_last($segments);
        $fallbackLabel = (string) \Illuminate\Support\Str::of($segment)->replace('-', ' ')->title();
        $label = $segmentLabels[$segment] ?? $fallbackLabel;

        if ($isLast && $pageTitle !== '') {
            $label = $pageTitle;
        }

        $breadcrumbItems[] = [
            'name' => $label,
            'url' => url($runningPath),
        ];
    }

    $shouldShowBreadcrumbs = !$isHomePage && count($breadcrumbItems) > 1;

    $webPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => $currentUrl . '#webpage',
        'url' => $currentUrl,
        'name' => $pageTitle !== '' ? $pageTitle : config('app.name', 'TSSCOUT'),
        'description' => $pageDescription,
        'isPartOf' => [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => config('app.name', 'TSSCOUT'),
        ],
    ];

    if ($schemaText !== '') {
        $webPageSchema['text'] = $schemaText;
    }

    $breadcrumbSchema = null;

    if ($shouldShowBreadcrumbs) {
        $webPageSchema['breadcrumb'] = [
            '@id' => $currentUrl . '#breadcrumb',
        ];

        $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            '@id' => $currentUrl . '#breadcrumb',
            'itemListElement' => collect($breadcrumbItems)->values()->map(function ($item, $index) {
                return [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $item['name'],
                    'item' => $item['url'],
                ];
            })->all(),
        ];
    }
@endphp

<script type="application/ld+json">{!! json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@if ($breadcrumbSchema)
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif

@if ($shouldShowBreadcrumbs)
    <style>
        .site-breadcrumbs {
            padding: 18px 0 10px;
        }

        .site-breadcrumbs__list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
            color: #4f6478;
            font-size: 14px;
        }

        .site-breadcrumbs__item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .site-breadcrumbs__item + .site-breadcrumbs__item::before {
            content: '/';
            color: #91a0af;
        }

        .site-breadcrumbs__item a {
            color: #1d3f5b;
            text-decoration: none;
        }

        .site-breadcrumbs__item a:hover {
            text-decoration: underline;
        }

        .site-breadcrumbs__item span {
            color: #6f7f8f;
        }
    </style>

    <nav class="site-breadcrumbs" aria-label="Breadcrumb">
        <div class="container">
            <ol class="site-breadcrumbs__list">
                @foreach ($breadcrumbItems as $item)
                    <li class="site-breadcrumbs__item">
                        @if ($loop->last)
                            <span aria-current="page">{{ $item['name'] }}</span>
                        @else
                            <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </nav>
@endif
