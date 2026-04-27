{{-- resources/views/tools/shopify-detector.blade.php --}}
@extends('layouts.master')

@section('title', 'Shopify Theme & Plugin Detector — TSScout')

@section('head')
<meta name="description" content="Instantly detect the Shopify theme and installed apps on any store. Free tool by TSScout.">
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&family=dm-mono:400,500" rel="stylesheet">
@endsection

@section('content')

{{-- ================================================================
     PAGE WRAPPER
     ================================================================ --}}
<div class="min-h-screen bg-[#0B0F1A] text-white" x-data="shopifyDetector()" x-init="init()">

    {{-- ── HERO / INPUT SECTION ──────────────────────────────────────── --}}
    <section class="relative overflow-hidden border-b border-white/5">

        {{-- Subtle grid background --}}
        <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
            <div class="absolute inset-0"
                 style="background-image:linear-gradient(rgba(99,179,237,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(99,179,237,0.03) 1px,transparent 1px);background-size:40px 40px;">
            </div>
            {{-- Glow orb --}}
            <div class="absolute top-[-120px] left-1/2 -translate-x-1/2 w-[700px] h-[400px] rounded-full"
                 style="background:radial-gradient(ellipse,rgba(56,189,248,0.07) 0%,transparent 70%);"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-6 pt-20 pb-24">

            {{-- Badge --}}
            <div class="flex justify-center mb-6">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium
                             bg-sky-500/10 text-sky-400 border border-sky-500/20 tracking-wide uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-400 animate-pulse"></span>
                    Free Tool
                </span>
            </div>

            {{-- Heading --}}
            <h1 class="text-center text-4xl sm:text-5xl font-semibold leading-tight tracking-tight mb-4"
                style="font-family:'Instrument Sans',sans-serif;">
                Shopify Theme &amp;
                <span class="text-transparent bg-clip-text"
                      style="background-image:linear-gradient(135deg,#38bdf8,#818cf8);">
                    Plugin Detector
                </span>
            </h1>

            <p class="text-center text-[#8A95A3] text-lg max-w-2xl mx-auto mb-12 leading-relaxed">
                Enter any Shopify store URL to instantly reveal the active theme and every installed app —
                no account required.
            </p>

            {{-- ── URL INPUT FORM ──────────────────────────────────────── --}}
            <form @submit.prevent="detect()"
                  class="max-w-2xl mx-auto">

                <div class="relative flex items-stretch rounded-2xl overflow-hidden
                            ring-1 ring-white/10 focus-within:ring-sky-500/50
                            transition-all duration-200 bg-white/[0.04]">

                    {{-- URL icon --}}
                    <div class="flex items-center pl-4 pr-2 text-[#8A95A3]">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>

                    {{-- Input --}}
                    <input
                        type="url"
                        x-model="url"
                        id="store-url"
                        name="url"
                        autocomplete="off"
                        placeholder="https://yourstore.myshopify.com"
                        required
                        class="flex-1 bg-transparent py-4 pr-2 text-white placeholder-[#4A5568]
                               text-base focus:outline-none"
                        style="font-family:'DM Mono',monospace;"
                        :disabled="loading"
                    >

                    {{-- Detect button --}}
                    <button
                        type="submit"
                        :disabled="loading || !url"
                        class="flex items-center gap-2 px-6 py-4 m-1.5 rounded-xl font-semibold text-sm
                               text-white transition-all duration-200 shrink-0
                               disabled:opacity-40 disabled:cursor-not-allowed"
                        style="background:linear-gradient(135deg,#0ea5e9,#6366f1);"
                        :class="{ 'opacity-90 scale-[0.98]': loading }"
                    >
                        {{-- Spinner --}}
                        <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                        </svg>
                        {{-- Icon --}}
                        <svg x-show="!loading" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 115 11a6 6 0 0112 0z"/>
                        </svg>
                        <span x-text="loading ? 'Scanning…' : 'Detect'"></span>
                    </button>
                </div>

                {{-- Error message --}}
                <div x-show="error" x-cloak
                     class="mt-3 flex items-center gap-2 text-red-400 text-sm px-1">
                    <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span x-text="error"></span>
                </div>

                {{-- Example URLs --}}
                <div class="flex flex-wrap justify-center gap-2 mt-5">
                    <span class="text-[#4A5568] text-xs">Try:</span>
                    @foreach(['allbirds.com', 'gymshark.com', 'fashionnova.com'] as $demo)
                        <button type="button"
                                @click="url='https://{{ $demo }}'"
                                class="text-xs text-sky-500/70 hover:text-sky-400 transition-colors underline underline-offset-2">
                            {{ $demo }}
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </section>

    {{-- ================================================================
         RESULTS SECTION
         ================================================================ --}}
    <section class="max-w-4xl mx-auto px-6 py-16" x-show="result" x-cloak>

        {{-- Not a Shopify store notice --}}
        <template x-if="result && !result.is_shopify">
            <div class="flex items-start gap-4 p-6 rounded-2xl bg-amber-500/5 border border-amber-500/20">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-amber-300 mb-1">Not a Shopify store</h3>
                    <p class="text-[#8A95A3] text-sm">
                        No Shopify fingerprints were found on <span class="text-white font-medium" x-text="result.url"></span>.
                        The site may use a different platform, or have its storefront hidden behind a CDN.
                    </p>
                </div>
            </div>
        </template>

        {{-- Shopify store results --}}
        <template x-if="result && result.is_shopify">
            <div>
                {{-- ── RESULT HEADER ─────────────────────────────────────── --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span class="text-emerald-400 text-sm font-medium">Shopify Confirmed</span>
                        </div>
                        <h2 class="text-xl font-semibold" x-text="result.url" style="font-family:'DM Mono',monospace;"></h2>
                        <p class="text-[#8A95A3] text-xs mt-1">
                            Scanned <span x-text="formatTime(result.scanned_at)"></span>
                        </p>
                    </div>

                    {{-- Download button --}}
                    <button @click="downloadReport()"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium
                                   bg-white/5 hover:bg-white/10 border border-white/10
                                   transition-colors text-[#CBD5E0] hover:text-white shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                        Download Report
                    </button>
                </div>

                {{-- ── STATS ROW ─────────────────────────────────────────── --}}
                <div class="grid grid-cols-3 gap-3 mb-8">
                    @foreach([
                        ['label' => 'Platform', 'icon' => 'shopify', 'value_key' => 'platform'],
                        ['label' => 'Apps Found', 'icon' => 'apps', 'value_key' => 'apps_count'],
                        ['label' => 'Theme', 'icon' => 'theme', 'value_key' => 'theme_name'],
                    ] as $stat)
                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-4">
                        <p class="text-[#4A5568] text-xs mb-2 uppercase tracking-widest">{{ $stat['label'] }}</p>
                        @if($stat['value_key'] === 'platform')
                            <p class="text-white font-semibold text-lg">Shopify</p>
                        @elseif($stat['value_key'] === 'apps_count')
                            <p class="text-white font-semibold text-lg" x-text="result.apps.length"></p>
                        @elseif($stat['value_key'] === 'theme_name')
                            <p class="text-white font-semibold text-lg truncate"
                               x-text="result.theme?.name ?? 'Unknown'"></p>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- ── RESULTS GRID ──────────────────────────────────────── --}}
                <div class="grid md:grid-cols-2 gap-6">

                    {{-- THEME CARD --}}
                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 overflow-hidden">
                        {{-- Card header --}}
                        <div class="flex items-center gap-3 px-5 py-4 border-b border-white/5">
                            <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-violet-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-white">Active Theme</h3>
                        </div>

                        <div class="p-5">
                            <template x-if="result.theme">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[#8A95A3] text-sm">Name</span>
                                        <span class="text-white font-medium" x-text="result.theme.name ?? '—'"></span>
                                    </div>
                                    <div x-show="result.theme.role" class="flex items-center justify-between">
                                        <span class="text-[#8A95A3] text-sm">Role</span>
                                        <span class="px-2 py-0.5 rounded text-xs font-medium bg-emerald-500/10 text-emerald-400 capitalize"
                                              x-text="result.theme.role"></span>
                                    </div>
                                    <div x-show="result.theme.myshopify" class="flex items-center justify-between">
                                        <span class="text-[#8A95A3] text-sm">Store domain</span>
                                        <span class="text-sky-400 text-xs font-mono" x-text="result.theme.myshopify"></span>
                                    </div>
                                    <div x-show="result.theme.source" class="flex items-center justify-between">
                                        <span class="text-[#8A95A3] text-sm">Detected via</span>
                                        <span class="text-[#8A95A3] text-xs capitalize" x-text="result.theme.source"></span>
                                    </div>
                                </div>
                            </template>
                            <template x-if="!result.theme">
                                <p class="text-[#4A5568] text-sm italic">Theme details could not be determined.</p>
                            </template>
                        </div>
                    </div>

                    {{-- APPS CARD --}}
                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 overflow-hidden">
                        {{-- Card header --}}
                        <div class="flex items-center justify-between px-5 py-4 border-b border-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 01-.657.643 48.39 48.39 0 01-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 01-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 00-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 01-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 00.657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 01-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 005.427-.63 48.05 48.05 0 00.582-4.717.532.532 0 00-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.959.401v0a.656.656 0 00.658-.663 48.422 48.422 0 00-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 01-.61-.58v0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-sm text-white">Installed Apps</h3>
                            </div>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-sky-500/10 text-sky-400"
                                  x-text="result.apps.length + ' found'"></span>
                        </div>

                        <div class="p-5">
                            <template x-if="result.apps.length > 0">
                                <ul class="space-y-2 max-h-64 overflow-y-auto pr-1 custom-scroll">
                                    <template x-for="(app, i) in result.apps" :key="i">
                                        <li class="flex items-center justify-between py-2 border-b border-white/[0.04] last:border-0">
                                            <div class="flex items-center gap-2.5">
                                                {{-- App initial avatar --}}
                                                <div class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold shrink-0"
                                                     :style="'background:' + appColor(app.name, 0.12) + '; color:' + appColor(app.name, 1)">
                                                    <span x-text="app.name.charAt(0)"></span>
                                                </div>
                                                <span class="text-sm text-[#CBD5E0]" x-text="app.name"></span>
                                            </div>
                                            <span class="text-xs px-2 py-0.5 rounded-full"
                                                  :class="app.confidence === 'high'
                                                      ? 'bg-emerald-500/10 text-emerald-400'
                                                      : 'bg-amber-500/10 text-amber-400'"
                                                  x-text="app.confidence"></span>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                            <template x-if="result.apps.length === 0">
                                <p class="text-[#4A5568] text-sm italic">No known apps were detected.</p>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- ── META CARD ─────────────────────────────────────────── --}}
                <template x-if="result.meta && Object.keys(result.meta).length">
                    <div class="mt-6 rounded-2xl bg-white/[0.03] border border-white/5 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4 border-b border-white/5">
                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-white">Page Metadata</h3>
                        </div>
                        <div class="p-5 space-y-3">
                            <template x-if="result.meta.title">
                                <div class="flex items-start gap-4">
                                    <span class="text-[#8A95A3] text-sm w-24 shrink-0 pt-0.5">Title</span>
                                    <span class="text-[#CBD5E0] text-sm" x-text="result.meta.title"></span>
                                </div>
                            </template>
                            <template x-if="result.meta.description">
                                <div class="flex items-start gap-4">
                                    <span class="text-[#8A95A3] text-sm w-24 shrink-0 pt-0.5">Description</span>
                                    <span class="text-[#CBD5E0] text-sm line-clamp-2" x-text="result.meta.description"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

            </div>
        </template>
    </section>

    {{-- ================================================================
         HOW IT WORKS
         ================================================================ --}}
    <section class="border-t border-white/5 max-w-4xl mx-auto px-6 py-16">
        <h2 class="text-center text-2xl font-semibold mb-12"
            style="font-family:'Instrument Sans',sans-serif;">
            How it works
        </h2>
        <div class="grid sm:grid-cols-3 gap-6">
            @foreach([
                ['num' => '01', 'title' => 'Enter a URL', 'body' => 'Paste any store URL — myshopify.com or custom domain. HTTPS is handled automatically.'],
                ['num' => '02', 'title' => 'Server-side scan', 'body' => 'Our Laravel backend fetches and analyses the page HTML. No keys or credentials are ever exposed to the browser.'],
                ['num' => '03', 'title' => 'Instant report', 'body' => 'Review the detected theme and app stack inline, then download a clean text report for your records.'],
            ] as $step)
            <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-6">
                <span class="block text-3xl font-bold text-white/5 mb-3"
                      style="font-family:'Instrument Sans',sans-serif;">{{ $step['num'] }}</span>
                <h3 class="font-semibold text-white mb-2">{{ $step['title'] }}</h3>
                <p class="text-[#8A95A3] text-sm leading-relaxed">{{ $step['body'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

</div>{{-- end x-data --}}

{{-- ================================================================
     STYLES
     ================================================================ --}}
<style>
    body { background: #0B0F1A; }
    [x-cloak] { display: none !important; }
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }
</style>

{{-- ================================================================
     ALPINE.JS COMPONENT
     ================================================================ --}}
<script>
function shopifyDetector() {
    return {
        url: '',
        loading: false,
        result: null,
        error: null,

        init() {
            // Pre-fill from query param e.g. ?url=https://...
            const params = new URLSearchParams(window.location.search);
            if (params.get('url')) this.url = params.get('url');
        },

        async detect() {
            this.error  = null;
            this.result = null;
            this.loading = true;

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

                const res = await fetch('{{ route("tools.shopify-detector.detect") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept':       'application/json',
                        'X-CSRF-TOKEN': csrf,
                    },
                    body: JSON.stringify({ url: this.url }),
                });

                const data = await res.json();

                if (!res.ok || !data.success) {
                    this.error = data.message ?? 'An unexpected error occurred.';
                    return;
                }

                this.result = data;

                // Smooth-scroll to results
                this.$nextTick(() => {
                    document.querySelector('[x-show="result"]')
                        ?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            } catch (e) {
                this.error = 'Network error — please check your connection and try again.';
                console.error(e);
            } finally {
                this.loading = false;
            }
        },

        downloadReport() {
            if (!this.result) return;

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("tools.shopify-detector.download") }}';

            const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
            [
                ['_token', csrf],
                ['url',    this.result.url],
                ['data',   JSON.stringify(this.result)],
            ].forEach(([name, value]) => {
                const input = document.createElement('input');
                input.type  = 'hidden';
                input.name  = name;
                input.value = value;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        },

        formatTime(iso) {
            if (!iso) return '';
            return new Date(iso).toLocaleString(undefined, {
                dateStyle: 'medium', timeStyle: 'short',
            });
        },

        // Deterministic pastel colour per app name
        appColor(name, alpha) {
            const hues = [210, 260, 160, 30, 340, 190, 290, 60, 130, 0];
            let hash = 0;
            for (let i = 0; i < name.length; i++) hash = name.charCodeAt(i) + ((hash << 5) - hash);
            const hue = hues[Math.abs(hash) % hues.length];
            return `hsl(${hue}, 65%, ${alpha === 1 ? 70 : 30}%, ${alpha})`;
        },
    };
}
</script>

@endsection
