<?php

namespace App\Http\Middleware;

use App\Models\PageRedir;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyPageRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isMethod('GET') && !$request->isMethod('HEAD')) {
            return $next($request);
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        $relativeRedirect = PageRedir::query()
            ->where('url_type', 'relative')
            ->whereIn('old_url', $this->relativeCandidates($request))
            ->latest('id')
            ->first();

        if ($relativeRedirect !== null) {
            $target = $relativeRedirect->new_url;

            if (in_array($target, $this->relativeCandidates($request), true)) {
                return $next($request);
            }

            return redirect($target, (int) $relativeRedirect->status_code);
        }

        $fullRedirect = PageRedir::query()
            ->where('url_type', 'full')
            ->whereIn('old_url', $this->fullCandidates($request))
            ->latest('id')
            ->first();

        if ($fullRedirect !== null) {
            $target = $fullRedirect->new_url;

            if (in_array($target, $this->fullCandidates($request), true)) {
                return $next($request);
            }

            return redirect($target, (int) $fullRedirect->status_code);
        }

        return $next($request);
    }

    private function relativeCandidates(Request $request): array
    {
        $pathOnly = '/' . ltrim($request->path(), '/');
        $pathOnly = $pathOnly === '//' ? '/' : $pathOnly;

        $normalizedPath = rtrim($pathOnly, '/');
        if ($normalizedPath === '') {
            $normalizedPath = '/';
        }

        return array_values(array_unique([
            $request->getRequestUri(),
            $pathOnly,
            $normalizedPath,
        ]));
    }

    private function fullCandidates(Request $request): array
    {
        $url = $request->url();
        $fullUrl = $request->fullUrl();

        $normalizedUrl = rtrim($url, '/');
        if ($normalizedUrl === '') {
            $normalizedUrl = $url;
        }

        $normalizedFullUrl = rtrim($fullUrl, '/');
        if ($normalizedFullUrl === '') {
            $normalizedFullUrl = $fullUrl;
        }

        return array_values(array_unique([
            $url,
            $fullUrl,
            $normalizedUrl,
            $normalizedFullUrl,
        ]));
    }
}
