<?php

namespace App\Http\Controllers;

use App\Models\PageRedir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PageRedirController extends Controller
{
    private function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public function index()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $pageRedirs = PageRedir::latest()->paginate(20);

        return view('page-redir.index', compact('pageRedirs'));
    }

    public function create()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $statusCodes = $this->statusCodes();

        return view('page-redir.create', compact('statusCodes'));
    }

    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $validated = $this->validateRedirectRequest($request);

        PageRedir::create($validated);

        return redirect()->route('admin.page-redir.index')->with('success', 'Redirect created successfully.');
    }

    public function show(PageRedir $pageRedir)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        return view('page-redir.show', compact('pageRedir'));
    }

    public function edit(PageRedir $pageRedir)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $statusCodes = $this->statusCodes();

        return view('page-redir.edit', compact('pageRedir', 'statusCodes'));
    }

    public function update(Request $request, PageRedir $pageRedir)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $validated = $this->validateRedirectRequest($request, $pageRedir);

        $pageRedir->update($validated);

        return redirect()->route('admin.page-redir.index')->with('success', 'Redirect updated successfully.');
    }

    public function destroy(PageRedir $pageRedir)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('Adminlogin')->with('error', 'Access denied.');
        }

        $pageRedir->delete();

        return redirect()->route('admin.page-redir.index')->with('success', 'Redirect deleted successfully.');
    }

    private function validateRedirectRequest(Request $request, ?PageRedir $pageRedir = null): array
    {
        $statusCodes = array_keys($this->statusCodes());

        $validator = Validator::make($request->all(), [
            'url_type' => ['required', Rule::in(['full', 'relative'])],
            'old_url' => [
                'required',
                'string',
                'max:2048',
                Rule::unique('page_redirs', 'old_url')->ignore($pageRedir?->id),
            ],
            'new_url' => ['required', 'string', 'max:2048'],
            'status_code' => ['required', 'integer', Rule::in($statusCodes)],
        ]);

        $validator->after(function ($validator) use ($request): void {
            $urlType = $request->input('url_type');

            foreach (['old_url', 'new_url'] as $field) {
                $value = (string) $request->input($field, '');

                if (!$this->isValidUrlByType($value, $urlType)) {
                    $validator->errors()->add(
                        $field,
                        $urlType === 'full'
                            ? 'The ' . str_replace('_', ' ', $field) . ' must be a valid full URL (http/https).'
                            : 'The ' . str_replace('_', ' ', $field) . ' must be a valid relative URL starting with /.'
                    );
                }
            }
        });

        return $validator->validate();
    }

    private function isValidUrlByType(string $url, ?string $urlType): bool
    {
        if ($urlType === 'full') {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return false;
            }

            $parsed = parse_url($url);
            $scheme = $parsed['scheme'] ?? '';
            $host = $parsed['host'] ?? '';

            return in_array($scheme, ['http', 'https'], true) && $host !== '';
        }

        if ($urlType === 'relative') {
            return (bool) preg_match('#^/(?!/)\S*$#', $url);
        }

        return false;
    }

    private function statusCodes(): array
    {
        return [
            301 => '301 - Moved Permanently',
            302 => '302 - Found',
            307 => '307 - Temporary Redirect',
            308 => '308 - Permanent Redirect',
        ];
    }
}
