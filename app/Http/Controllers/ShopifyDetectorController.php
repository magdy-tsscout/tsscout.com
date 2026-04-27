<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ShopifyDetectorController extends Controller
{
    /**
     * Display the Shopify detector page.
     */
    public function index()
    {
        return view('tools.shopify-detector');
    }

    /**
     * Run detection against the provided URL.
     * All HTTP requests are made server-side — no API keys exposed to frontend.
     */
    public function detect(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url', 'max:255'],
        ]);

        $url = $this->normalizeUrl($request->input('url'));

        // Cache results for 30 minutes per URL to avoid hammering targets
        $cacheKey = 'shopify_detect_' . md5($url);

        $result = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($url) {
            return $this->performDetection($url);
        });

        if ($result['error']) {
            return response()->json([
                'success' => false,
                'message' => $result['error'],
            ], 422);
        }

        return response()->json([
            'success'   => true,
            'url'       => $url,
            'is_shopify' => $result['is_shopify'],
            'theme'     => $result['theme'],
            'apps'      => $result['apps'],
            'meta'      => $result['meta'],
            'scanned_at' => now()->toIso8601String(),
        ]);
    }

    /**
     * Generate and download a plain-text report.
     */
    public function download(Request $request)
    {
        $request->validate([
            'url'  => ['required', 'url'],
            'data' => ['required', 'json'],
        ]);

        $data    = json_decode($request->input('data'), true);
        $domain  = parse_url($request->input('url'), PHP_URL_HOST);
        $report  = $this->buildReport($data, $domain);
        $filename = 'tsscout-report-' . $domain . '-' . now()->format('Ymd') . '.txt';

        return response($report, 200, [
            'Content-Type'        => 'text/plain',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function normalizeUrl(string $url): string
    {
        if (!str_starts_with($url, 'http')) {
            $url = 'https://' . $url;
        }
        return rtrim($url, '/');
    }

    private function performDetection(string $url): array
    {
        try {
            // Fetch the page HTML (server-side, no key needed for public pages)
            $response = Http::timeout(15)
                ->withHeaders(['User-Agent' => 'TSScout/1.0 (+https://tsscout.com)'])
                ->get($url);

            if (!$response->successful()) {
                return $this->errorResult("Could not reach {$url} (HTTP {$response->status()}).");
            }

            $html = $response->body();

            // Shopify fingerprinting
            $isShopify = $this->isShopify($html, $response->headers());

            if (!$isShopify) {
                return [
                    'error'      => null,
                    'is_shopify' => false,
                    'theme'      => null,
                    'apps'       => [],
                    'meta'       => $this->extractMeta($html),
                ];
            }

            $theme = $this->detectTheme($html);
            $apps  = $this->detectApps($html);
            $meta  = $this->extractMeta($html);

            return [
                'error'      => null,
                'is_shopify' => true,
                'theme'      => $theme,
                'apps'       => $apps,
                'meta'       => $meta,
            ];
        } catch (\Exception $e) {
            Log::warning('ShopifyDetector error', ['url' => $url, 'error' => $e->getMessage()]);
            return $this->errorResult('Failed to scan the URL. Please check it is publicly accessible.');
        }
    }

    private function isShopify(string $html, array $headers): bool
    {
        // Shopify stores expose several reliable signals
        $signals = [
            str_contains($html, 'cdn.shopify.com'),
            str_contains($html, 'Shopify.shop'),
            str_contains($html, '/cdn/shop/'),
            str_contains($html, 'shopify-section'),
            isset($headers['x-shopid']) || isset($headers['X-ShopId']),
        ];

        return count(array_filter($signals)) >= 1;
    }

    private function detectTheme(string $html): ?array
    {
        // Theme name is embedded in HTML comments or script tags by Shopify
        $theme = null;

        // Pattern: Shopify theme name in HTML
        if (preg_match('/Shopify\.theme\s*=\s*\{[^}]*"name"\s*:\s*"([^"]+)"/i', $html, $m)) {
            $theme = ['name' => $m[1], 'source' => 'script'];
        } elseif (preg_match('/cdn\.shopify\.com\/s\/files\/[^"\']+\/assets\/([a-z0-9_\-]+)\.(css|js)/i', $html, $m)) {
            $theme = ['name' => ucwords(str_replace(['-', '_'], ' ', $m[1])), 'source' => 'asset'];
        }

        // Try fetching theme info from Shopify's public endpoint
        $themePage = $this->fetchShopifyThemeInfo($html);
        if ($themePage) {
            $theme = array_merge($theme ?? [], $themePage);
        }

        return $theme;
    }

    private function fetchShopifyThemeInfo(string $html): ?array
    {
        // Extract shop domain from HTML to query meta endpoint
        if (!preg_match('/Shopify\.shop\s*=\s*["\']([\w\-]+\.myshopify\.com)["\']/', $html, $m)) {
            return null;
        }

        try {
            $response = Http::timeout(8)
                ->withHeaders(['User-Agent' => 'TSScout/1.0'])
                ->get("https://{$m[1]}/meta.json");

            if ($response->successful()) {
                $meta = $response->json();
                return [
                    'name'       => $meta['theme']['name'] ?? null,
                    'role'       => $meta['theme']['role'] ?? null,
                    'myshopify'  => $m[1],
                ];
            }
        } catch (\Exception) {
            // Silently ignore – meta.json may be private
        }

        return null;
    }

    private function detectApps(string $html): array
    {
        $apps = [];

        // Known Shopify app fingerprints (script src patterns / data attributes)
        $knownApps = [
            'Klaviyo'          => ['klaviyo.com', 'kl-private-reset-css'],
            'Yotpo'            => ['yotpo.com', 'yotpoWidgetsContainer'],
            'Privy'            => ['privy.com', 'PrivyContainer'],
            'Gorgias'          => ['gorgias.io', 'gorgias-chat'],
            'Loox'             => ['loox.io', 'looxReviews'],
            'Recharge'         => ['rechargepayments.com', 'recharge_'],
            'LimeSpot'         => ['limespot.com'],
            'Tidio'            => ['tidiochat.com', 'tidio-chat'],
            'Judge.me'         => ['judge.me'],
            'Smile.io'         => ['smile.io', 'swell-redemption'],
            'Okendo'           => ['okendo.io'],
            'Shogun'           => ['getshogun.com', 'shogun-root'],
            'PageFly'          => ['pagefly.io'],
            'Lucky Orange'     => ['luckyorange.com'],
            'HotJar'           => ['hotjar.com'],
            'Omnisend'         => ['omnisend.com'],
            'Postscript'       => ['postscript.io'],
            'Attentive'        => ['attn.tv', 'attentive_overlay'],
            'Stamped.io'       => ['stamped.io', 'stamped-rewards'],
            'Conversio'        => ['conversio.com'],
            'Bold Commerce'    => ['boldapps.net', 'boldsubscriptions'],
            'Sezzle'           => ['sezzle.com'],
            'Afterpay'         => ['afterpay.com'],
            'Klarna'           => ['klarna.com'],
            'Affirm'           => ['affirm.com'],
            'ShipBob'          => ['shipbob.com'],
            'Zendesk'          => ['zendesk.com', 'zE('],
            'Intercom'         => ['intercom.io', 'Intercom('],
            'Trustpilot'       => ['trustpilot.com'],
        ];

        foreach ($knownApps as $name => $patterns) {
            foreach ($patterns as $pattern) {
                if (str_contains($html, $pattern)) {
                    $apps[] = ['name' => $name, 'confidence' => 'high'];
                    break;
                }
            }
        }

        // Deduplicate by name
        $seen = [];
        return array_values(array_filter($apps, function ($app) use (&$seen) {
            if (in_array($app['name'], $seen)) return false;
            $seen[] = $app['name'];
            return true;
        }));
    }

    private function extractMeta(string $html): array
    {
        $meta = [];

        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m)) {
            $meta['title'] = trim(strip_tags($m[1]));
        }

        if (preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\'](.*?)["\']/is', $html, $m)) {
            $meta['description'] = trim($m[1]);
        }

        if (preg_match('/<meta[^>]+property=["\']og:image["\'][^>]+content=["\'](.*?)["\']/is', $html, $m)) {
            $meta['og_image'] = trim($m[1]);
        }

        return $meta;
    }

    private function buildReport(array $data, string $domain): string
    {
        $lines = [];
        $lines[] = str_repeat('=', 60);
        $lines[] = 'TSScout — Shopify Detection Report';
        $lines[] = str_repeat('=', 60);
        $lines[] = 'Domain    : ' . $domain;
        $lines[] = 'Scanned   : ' . ($data['scanned_at'] ?? now()->toIso8601String());
        $lines[] = 'Is Shopify: ' . ($data['is_shopify'] ? 'Yes' : 'No');
        $lines[] = '';

        if (!empty($data['theme'])) {
            $lines[] = str_repeat('-', 40);
            $lines[] = 'ACTIVE THEME';
            $lines[] = str_repeat('-', 40);
            $lines[] = 'Name   : ' . ($data['theme']['name'] ?? 'Unknown');
            if (!empty($data['theme']['role'])) {
                $lines[] = 'Role   : ' . $data['theme']['role'];
            }
            $lines[] = '';
        }

        if (!empty($data['apps'])) {
            $lines[] = str_repeat('-', 40);
            $lines[] = 'DETECTED APPS / PLUGINS (' . count($data['apps']) . ')';
            $lines[] = str_repeat('-', 40);
            foreach ($data['apps'] as $app) {
                $lines[] = '  • ' . $app['name'] . ' [' . $app['confidence'] . ']';
            }
            $lines[] = '';
        }

        if (!empty($data['meta'])) {
            $lines[] = str_repeat('-', 40);
            $lines[] = 'PAGE META';
            $lines[] = str_repeat('-', 40);
            foreach ($data['meta'] as $key => $value) {
                $lines[] = ucfirst($key) . ': ' . $value;
            }
            $lines[] = '';
        }

        $lines[] = str_repeat('=', 60);
        $lines[] = 'Generated by TSScout.com — All rights reserved.';
        $lines[] = str_repeat('=', 60);

        return implode("\n", $lines);
    }

    private function errorResult(string $message): array
    {
        return [
            'error'      => $message,
            'is_shopify' => false,
            'theme'      => null,
            'apps'       => [],
            'meta'       => [],
        ];
    }
}
