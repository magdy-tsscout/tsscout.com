<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Analyze eBay, Shopify, Walmart &amp; TikTok Shop data to discover trending products, track competitors, compare supplier prices, and build better listings faster.">
  <meta name="keywords" content="product research, competitor analysis, supplier finder, TikTok trends, Shopify analysis, eBay tools, ecommerce tools">
  <meta name="author" content="TSScout">
  <meta property="og:title" content="TSScout – Find Winning Products Before Your Competitors">
  <meta property="og:description" content="Analyze eBay, Shopify, Walmart &amp; TikTok Shop data to discover trending products, track competitors, compare supplier prices, and build better listings faster.">
  <meta property="og:image" content="{{ asset('images/landing/reengage/dashboard.jpg') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="tsscout">
  <title>TSScout – Find Winning Products Before Your Competitors</title>
  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Scout-Logo%2020x20-01.svg') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,700&display=swap" rel="stylesheet">
<style type="text/css">
    /* ── RESET & BASE ── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Poppins', 'Segoe UI', Tahoma, sans-serif; color: #1d2a4f; background: #fff; line-height: 1.5; }
    img { max-width: 100%; height: auto; display: block; }
    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }

    /* ── TOKENS ── */
    :root {
    --blue:       #2f57f6;
    --blue-grd:   linear-gradient(94deg, #3b69ff 0%, #2144ea 100%);
    --blue-dark:  #0f1f4c;
    --blue-mid:   #1d2a4f;
    --blue-light: #e8efff;
    --blue-bg:    #f6f9ff;
    --green:      #35b64b;
    --red:        #e74c3c;
    --muted:      #5e6b8a;
    --border:     #dfe8f6;
    --shadow:     0 8px 32px rgba(24,41,93,.10);
    }

    /* ── SHELL ── */
    .lp-shell {
    width: min(1160px, calc(100% - 2.5rem));
    margin-inline: auto;
    }

    /* ── BUTTONS ── */
    .lp-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .6rem;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-family: inherit;
    font-weight: 600;
    font-size: 1rem;
    transition: transform .18s ease, box-shadow .18s ease;
    text-decoration: none;
    white-space: nowrap;
    }
    .lp-btn:hover { transform: translateY(-2px); }

    .lp-btn-primary {
    background: var(--blue-grd);
    color: #fff;
    padding: .58rem 1.75rem;
    box-shadow: 0 8px 22px rgba(47,87,246,.28);
    }
    .lp-btn-primary:hover { box-shadow: 0 14px 28px rgba(47,87,246,.36); color: #fff; }

    .lp-btn-outline {
    background: transparent;
    border: 2px solid rgba(47,87,246,.25);
    color: #2a3a5e;
    padding: .54rem 1.5rem;
    }
    .lp-btn-outline:hover { border-color: var(--blue); color: var(--blue); }

    .lp-btn-sm { padding: .52rem 1.1rem; font-size: .88rem; border-radius: 8px; }

    .lp-btn-white {
    background: #fff;
    color: var(--blue-dark);
    padding: .58rem 2.2rem;
    box-shadow: 0 8px 28px rgba(0,0,0,.14);
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 700;
    }
    .lp-btn-white:hover { box-shadow: 0 12px 32px rgba(0,0,0,.2); }

    /* ── SECTION LABELS ── */
    .lp-pill {
    display: inline-block;
    background: var(--blue-light);
    color: var(--blue);
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    border-radius: 999px;
    padding: .32rem 1rem;
    margin-bottom: .8rem;
    }

    .lp-h2 {
    font-size: clamp(1.6rem, 3.5vw, 2.25rem);
    font-weight: 700;
    color: #3545D6;
    line-height: 1.14;
    }

    /* ════════════════════════════════════════
    NAVIGATION
    ════════════════════════════════════════ */
    .lp-nav {
    position: sticky;
    top: 0;
    z-index: 900;
    background: #010D33;
    box-shadow: 0 1px 0 var(--border);
    }
    .lp-nav-inner {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-block: .85rem;
    }
    .lp-nav-logo img { height: 34px; }

    .lp-nav-links {
    display: none;
    gap: .1rem;
    margin-inline-start: 1.25rem;
    }
    .lp-nav-link {
    display: block;
    padding: .44rem .8rem;
    font-size: .9rem;
    font-weight: 500;
    color: #fff;
    border-radius: 7px;
    transition: background .15s, color .15s;
    background: none;
    border: 0;
    cursor: pointer;
    font-family: inherit;
    }
    .lp-nav-link:hover { background: var(--blue-light); color: var(--blue); }

    /* dropdown */
    .lp-nav-dd { position: relative; }
    .lp-nav-dd-menu {
    display: none;
    position: absolute;
    top: calc(100% + .5rem);
    left: 0;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 10px;
    box-shadow: var(--shadow);
    min-width: 155px;
    padding: .4rem;
    }
    .lp-nav-dd:hover .lp-nav-dd-menu { display: block; }
    .lp-nav-dd-link {
    display: block;
    padding: .5rem .85rem;
    font-size: .87rem;
    color: #fff;
    border-radius: 6px;
    transition: background .14s;
    }
    .lp-nav-dd-link:hover { background: var(--blue-light); color: var(--blue); }

    .lp-nav-actions {
    display: none;
    align-items: center;
    gap: .8rem;
    margin-inline-start: auto;
    }
    .lp-login {
    font-size: .9rem;
    font-weight: 500;
    color: #fff;
    padding: .44rem .8rem;
    border-radius: 7px;
    transition: color .15s;
    }
    .lp-login:hover { color: var(--blue); }

    @media (min-width: 960px) {
    .lp-nav-links { display: flex; }
    .lp-nav-actions { display: flex; }
    }

    /* ════════════════════════════════════════
    HERO
    ════════════════════════════════════════ */
    .lp-hero {
    background:
        radial-gradient(ellipse 65% 55% at 98% 48%, #eef3ff 0%, transparent 68%),
        radial-gradient(ellipse 45% 45% at 4% 82%, #f0f5ff 0%, transparent 62%),
        #fff;
    padding: 3.5rem 0 4rem;
    overflow: hidden;
    position: relative;
    }
    .lp-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, #b8ccf7 1.2px, transparent 1.2px);
    background-size: 26px 26px;
    opacity: .16;
    pointer-events: none;
    }
    .lp-hero-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.5rem;
    align-items: center;
    position: relative;
    }
    @media (min-width: 1024px) {
    .lp-hero-grid { grid-template-columns: 1fr 1.08fr; gap: 3rem; }
    }

    .lp-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: var(--blue-light);
    color: var(--blue);
    font-size: .69rem;
    font-weight: 700;
    letter-spacing: .1em;
    border-radius: 999px;
    padding: .36rem 1rem;
    margin-bottom: 1rem;
    }
    .lp-hero-badge svg { flex-shrink: 0; }

    .lp-hero h1 {
    font-size: clamp(1.4rem, 2vw, 2.8rem);
    font-weight: 700;
    color: var(--blue-dark);
    line-height: 1.09;
    margin-bottom: 1.2rem;
    }
    .lp-hero h1 em {
    font-style: italic;
    color: var(--blue);
    }

    .lp-hero-desc {
    color: #42567d;
    font-size: .98rem;
    line-height: 1.2;
    max-width: 44ch;
    margin-bottom: 1.5rem;
    }

    .lp-hero-bullets {
    display: flex;
    flex-direction: column;
    gap: .62rem;
    margin-bottom: 1rem;
    }
    .lp-hero-bullets li {
    display: flex;
    align-items: center;
    gap: .75rem;
    font-size: .93rem;
    color: #2a3a5e;
    }
    .lp-bullet-dot {
    flex-shrink: 0;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    }
    .lp-bullet-dot svg { width: 11px; height: 11px; color: #fff; }

    .lp-hero-ctas {
    display: flex;
    flex-wrap: wrap;
    gap: .85rem;
    align-items: center;
    margin-bottom: 1.25rem;
    }
    .lp-play-circle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    }
    .lp-play-circle svg { width: 10px; height: 10px; color: #fff; }

    .lp-hero-sub {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: .45rem .85rem;
    color: #677494;
    font-size: .85rem;
    }
    .lp-hero-sub-item {
    display: flex;
    align-items: center;
    gap: .32rem;
    }
    .lp-hero-sub-item svg { color: var(--green); width: 14px; height: 14px; flex-shrink: 0; }

    .lp-hero-img {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 22px 64px rgba(24,41,93,.15);
    border: 1px solid #e0eaf7;
    }
    .lp-hero-img img { width: 100%; height: auto; }

    /* ════════════════════════════════════════
    TRUST BAR
    ════════════════════════════════════════ */
    .lp-trust {
    padding: 2.25rem 0;
    background: #fff;
    }
    .lp-trust-inner {
    border: 1.5px dashed #c8d8f0;
    border-radius: 16px;
    padding: 1.6rem 2rem;
    }
    .lp-trust-label {
    text-align: center;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .07em;
    color: var(--muted);
    text-transform: uppercase;
    margin-bottom: 1.3rem;
    }
    .lp-trust-logos {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 1.2rem 2.5rem;
    }
    .lp-trust-logos img {
    height: 32px;
    width: auto;
    max-width: 145px;
    object-fit: contain;
    opacity: 1;
    filter: none;
    transition: transform .2s ease;
    }
    .lp-trust-logos img:hover { transform: translateY(-1px); }
    .tiktok-shop { height: 80px !important; max-width: 150px !important;}

    /* ════════════════════════════════════════
    PROBLEM SECTION
    ════════════════════════════════════════ */
    .lp-problems {
    padding: 4.5rem 0;
    background: #fff;
    }
    .lp-center { text-align: center; }
    .lp-problems-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.15rem;
    margin-top: 2.5rem;
    }
    .lp-problem-card {
    text-align: center;
    padding: 1.8rem 1.25rem 1.6rem;
    border: 1px solid var(--border);
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 4px 16px rgba(24,41,93,.05);
    transition: transform .22s, box-shadow .22s;
    }
    .lp-problem-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(24,41,93,.10); }
    .lp-icon-circle {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.1rem;
    box-shadow: 0 10px 22px rgba(47,87,246,.26);
    }
    .lp-icon-circle svg { width: 26px; height: 26px; color: #fff; }
    .lp-problem-card h3 {
    font-size: .96rem;
    font-weight: 700;
    color: var(--blue-dark);
    margin-bottom: .45rem;
    }
    .lp-problem-card p { color: var(--muted); font-size: .86rem; line-height: 1.65; }

    .lp-problems-note {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    margin-top: 2.25rem;
    background: var(--blue-light);
    border: 1px solid #c5d5f5;
    border-radius: 999px;
    padding: .55rem 1.4rem;
    color: var(--blue-mid);
    font-size: .9rem;
    font-weight: 600;
    }
    .lp-problems-note svg { width: 16px; height: 16px; color: #f5a623; flex-shrink: 0; }

    /* ════════════════════════════════════════
    FEATURES
    ════════════════════════════════════════ */
    .lp-features {
    padding: 4.5rem 0;
    background: var(--blue-bg);
    }
    .lp-features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
    gap: 1.2rem;
    margin-top: 2.5rem;
    }
    @media (min-width: 1280px) {
    .lp-features-grid {
      grid-template-columns: repeat(6, minmax(0, 1fr));
      gap: .85rem;
    }
    }
    .lp-feat-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.75rem 1.5rem;
    text-align: center;
    box-shadow: 0 4px 16px rgba(24,41,93,.05);
    transition: transform .22s, box-shadow .22s;
    }
    @media (min-width: 1280px) {
    .lp-feat-card {
      padding: 1.2rem .85rem 1.1rem;
    }
    }
    .lp-feat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(24,41,93,.10); }
    .lp-feat-icon {
    width: 50px;
    height: 50px;
    border-radius: 999px;
    background: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.1rem;
    box-shadow: 0 8px 20px rgba(47,87,246,.24);
    }
    .lp-feat-icon svg { width: 24px; height: 24px; color: #fff; }
    .lp-feat-icon-shopify { background: #22a15b; box-shadow: 0 8px 20px rgba(34,161,91,.26); }
    .lp-feat-card h3 { font-size: .98rem; font-weight: 700; color: var(--blue-dark); margin-bottom: .45rem; }
    .lp-feat-card p { color: var(--muted); font-size: .87rem; line-height: 1.65; }
    @media (min-width: 1280px) {
    .lp-feat-card h3 { font-size: .88rem; }
    .lp-feat-card p { font-size: .76rem; line-height: 1.5; }
    }

    /* ════════════════════════════════════════
    HOW IT WORKS
    ════════════════════════════════════════ */
    .lp-how {
    padding: 4.5rem 0;
    background: #fff;
    }
    .lp-how-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 2.8rem;
    position: relative;
    }
    @media (min-width: 768px) {
    .lp-how-steps {
        display: flex;
        align-items: flex-start;
        gap: 0;
    }
    }
    .lp-how-step {
    text-align: center;
    flex: 1;
    padding: 0 .5rem;
    }
    .lp-step-wrap {
    position: relative;
    display: inline-flex;
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: var(--blue-light);
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    }
    .lp-step-wrap svg { width: 28px; height: 28px; color: var(--blue); }
    .lp-step-num {
    position: absolute;
    top: -4px;
    right: -4px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--blue);
    color: #fff;
    font-size: .68rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    }
    .lp-how-step h3 {
    font-size: .93rem;
    font-weight: 700;
    color: var(--blue-dark);
    margin-bottom: .45rem;
    }
    .lp-how-step p { color: var(--muted); font-size: .84rem; line-height: 1.6; }

    .lp-how-arrow {
    display: none;
    color: #c5d4f5;
    font-size: 1.6rem;
    padding-top: 1.75rem;
    flex-shrink: 0;
    }
    @media (min-width: 768px) { .lp-how-arrow { display: block; } }

    /* ════════════════════════════════════════
    ANALYZE
    ════════════════════════════════════════ */
    .lp-analyze {
    padding: 4.5rem 0;
    background: var(--blue-bg);
    }
    .lp-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(195px, 1fr));
    gap: 1rem;
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
    }
    .lp-metric {
    display: flex;
    align-items: center;
    gap: .85rem;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 1.1rem 1rem;
    box-shadow: 0 3px 12px rgba(24,41,93,.06);
    }
    .lp-metric-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--blue-light);
    display: flex;
    align-items: center;
    justify-content: center;
    }
    .lp-metric-icon svg { width: 18px; height: 18px; color: var(--blue); }
    .lp-metric-lbl { font-size: .7rem; font-weight: 600; color: var(--muted); margin-bottom: .18rem; }
    .lp-metric-val { font-size: .98rem; font-weight: 700; color: var(--blue-dark); white-space: nowrap; }

    .lp-analyze-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    color: var(--muted);
    font-size: .9rem;
    font-style: italic;
    }
    .lp-analyze-note svg { color: var(--blue); }

    /* ════════════════════════════════════════
    COMPARISON
    ════════════════════════════════════════ */
    .lp-compare {
    padding: 4.5rem 0;
    background: #fff;
    }
    .lp-compare-wrap { overflow-x: auto; margin-top: 2.5rem; }
    .lp-compare-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow);
    min-width: 480px;
    }
    .lp-compare-table th,
    .lp-compare-table td {
    padding: 1rem 1.5rem;
    text-align: left;
    border-bottom: 1px solid var(--border);
    }
    .lp-compare-table thead th {
    background: var(--blue-bg);
    font-size: .84rem;
    font-weight: 700;
    color: var(--muted);
    letter-spacing: .04em;
    }
    .lp-compare-table thead th.lp-col-ts {
    background: var(--blue-light);
    color: var(--blue);
    }
    .lp-compare-table tbody tr:last-child td { border-bottom: none; }
    .lp-compare-table tbody tr:hover td { background: #fafcff; }
    .lp-compare-table td { font-size: .9rem; color: var(--blue-mid); }

    .lp-tick {
    display: inline-flex;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #e6f8ea;
    color: var(--green);
    align-items: center;
    justify-content: center;
    }
    .lp-tick svg { width: 13px; height: 13px; }
    .lp-cross {
    display: inline-flex;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #fde8e8;
    color: var(--red);
    align-items: center;
    justify-content: center;
    }
    .lp-cross svg { width: 12px; height: 12px; }

    /* ════════════════════════════════════════
    PRICING
    ════════════════════════════════════════ */
    .lp-pricing {
    padding: 4.5rem 0;
    background: var(--blue-bg);
    }
    .lp-pricing-box {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: var(--shadow);
    max-width: 840px;
    margin: 2.5rem auto 0;
    }
    @media (min-width: 600px) {
    .lp-pricing-box { grid-template-columns: auto 1fr; align-items: center; }
    }
    .lp-price-card {
    border: 2px solid var(--blue);
    border-radius: 14px;
    padding: 2rem 1.75rem;
    text-align: center;
    background: linear-gradient(138deg, #f0f5ff, #fff);
    min-width: 180px;
    }
    .lp-price-lbl {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: .6rem;
    }
    .lp-price-amt {
    font-size: 4.2rem;
    font-weight: 700;
    color: var(--blue-dark);
    line-height: 1;
    margin-bottom: .2rem;
    }
    .lp-price-tag {
    font-size: .88rem;
    font-weight: 700;
    color: var(--blue);
    margin-bottom: .5rem;
    }
    .lp-price-note { font-size: .76rem; color: var(--muted); line-height: 1.55; }

    .lp-pricing-feats { display: flex; flex-direction: column; gap: .9rem; }
    .lp-pricing-list { display: flex; flex-direction: column; gap: .5rem; }
    .lp-pricing-list li {
    display: flex;
    align-items: center;
    gap: .7rem;
    font-size: .9rem;
    color: var(--blue-mid);
    }
    .lp-pricing-list li svg { width: 15px; height: 15px; color: var(--green); flex-shrink: 0; }
    .lp-pricing-sub {
    text-align: center;
    font-size: .82rem;
    color: var(--muted);
    margin-top: .6rem;
    }

    /* ════════════════════════════════════════
    TESTIMONIALS
    ════════════════════════════════════════ */
    .lp-testimonials {
    padding: 4.5rem 0;
    background: #fff;
    }
    .lp-testi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
    gap: 1.2rem;
    margin-top: 2.5rem;
    }
    .lp-testi-card {
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 1.75rem 1.5rem;
    background: #fafcff;
    box-shadow: 0 4px 16px rgba(24,41,93,.05);
    }
    .lp-stars { display: flex; gap: .18rem; margin-bottom: .85rem; }
    .lp-stars svg { width: 15px; height: 15px; color: #f5a623; }
    .lp-testi-text {
    font-size: .92rem;
    color: #374162;
    line-height: 1.7;
    font-style: italic;
    margin-bottom: 1.2rem;
    }
    .lp-testi-author { display: flex; align-items: center; gap: .7rem; }
    .lp-avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: var(--border);
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    color: var(--muted);
    }
    .lp-avatar svg { width: 20px; height: 20px; }
    .lp-author-name { font-weight: 700; font-size: .88rem; color: var(--blue-dark); }
    .lp-author-role { font-size: .77rem; color: var(--muted); }

    /* ════════════════════════════════════════
    FAQ
    ════════════════════════════════════════ */
    .lp-faq {
    padding: 4.5rem 0;
    background: var(--blue-bg);
    }
    .lp-faq-list {
    max-width: 720px;
    margin: 2.5rem auto 0;
    display: flex;
    flex-direction: column;
    gap: .8rem;
    }
    .lp-faq-item {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    }
    .lp-faq-btn {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding: 1.1rem 1.3rem;
    background: none;
    border: none;
    cursor: pointer;
    font-family: inherit;
    font-size: .94rem;
    font-weight: 600;
    color: var(--blue-dark);
    text-align: left;
    }
    .lp-faq-chevron {
    flex-shrink: 0;
    width: 24px; height: 24px;
    border-radius: 50%;
    background: var(--blue-light);
    display: flex; align-items: center; justify-content: center;
    transition: transform .25s ease;
    }
    .lp-faq-chevron svg { width: 11px; height: 11px; color: var(--blue); }
    .lp-faq-item.is-open .lp-faq-chevron { transform: rotate(180deg); }
    .lp-faq-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height .32s ease;
    }
    .lp-faq-body p {
    padding: 0 1.3rem 1.1rem;
    font-size: .9rem;
    color: var(--muted);
    line-height: 1.72;
    }

    /* ════════════════════════════════════════
    FINAL CTA
    ════════════════════════════════════════ */
    .lp-cta {
    background: var(--blue-dark);
    padding: 5rem 0;
    position: relative;
    overflow: hidden;
    }
    .lp-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,.055) 1px, transparent 1px);
    background-size: 26px 26px;
    pointer-events: none;
    }
    .lp-cta-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2.5rem;
    align-items: center;
    position: relative;
    }
    @media (min-width: 768px) {
    .lp-cta-grid { grid-template-columns: 1fr auto; }
    }
    .lp-cta h2 {
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    font-weight: 700;
    color: #fff;
    line-height: 1.1;
    margin-bottom: .9rem;
    }
    .lp-cta h2 em { font-style: normal; color: #7da8ff; }
    .lp-cta-sub-p {
    color: #a3b8e0;
    font-size: 1rem;
    margin-bottom: 1.8rem;
    }
    .lp-cta-note {
    margin-top: 1rem;
    display: flex;
    align-items: center;
    gap: .5rem;
    color: #8aabda;
    font-size: .85rem;
    }
    .lp-cta-note svg { width: 14px; height: 14px; color: #6a8bc0; }
    .lp-cta-rocket {
    display: none;
    }
    @media (min-width: 768px) { .lp-cta-rocket { display: flex; justify-content: center; } }
    .lp-cta-rocket svg { width: 190px; height: 190px; }

    /* ════════════════════════════════════════
    FOOTER
    ════════════════════════════════════════ */
    .lp-footer {
    background: #090f24;
    padding: 3.5rem 0 2rem;
    }
    .lp-footer-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem 2.5rem;
    margin-bottom: 2.5rem;
    }
    @media (min-width: 640px) {
    .lp-footer-grid { grid-template-columns: 1.6fr repeat(4, 1fr); }
    }
    .lp-footer-brand img { height: 32px; margin-bottom: .75rem; }
    .lp-footer-brand p { color: #7a8aad; font-size: .84rem; line-height: 1.65; max-width: 24ch; }
    .lp-footer-col h4 {
    color: #fff;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    margin-bottom: .9rem;
    }
    .lp-footer-col ul { display: flex; flex-direction: column; gap: .5rem; }
    .lp-footer-col a { color: #7a8aad; font-size: .87rem; transition: color .14s; }
    .lp-footer-col a:hover { color: #fff; }
    .lp-footer-bottom {
    border-top: 1px solid rgba(255,255,255,.08);
    padding-top: 1.5rem;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    }
    .lp-footer-copy { color: #56677e; font-size: .82rem; }
    .lp-socials { display: flex; gap: .6rem; }
    .lp-social {
    width: 34px; height: 34px;
    border-radius: 8px;
    background: rgba(255,255,255,.06);
    display: flex; align-items: center; justify-content: center;
    color: #7a8aad;
    transition: background .18s, color .18s;
    }
    .lp-social:hover { background: rgba(255,255,255,.14); color: #fff; }
    .lp-social svg { width: 15px; height: 15px; }

    /* ════════════════════════════════════════
    DASHBOARD MOCKUP
    ════════════════════════════════════════ */
    .dm-mock {
    display: flex;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 22px 64px rgba(24,41,93,.15);
    border: 1px solid #e0eaf7;
    overflow: hidden;
    font-size: clamp(7px, 1vw, 10px);
    user-select: none;
    }
    .dm-side {
    width: 14em;
    flex-shrink: 0;
    background: #f7f9ff;
    border-right: 1px solid #e4ecf8;
    padding: 1.2em 0;
    display: flex;
    flex-direction: column;
    }
    .dm-logo {
    display: flex;
    align-items: center;
    gap: .55em;
    padding: 0 1.1em 1em;
    border-bottom: 1px solid #e4ecf8;
    margin-bottom: .75em;
    font-weight: 700;
    font-size: 1.05em;
    color: #1d2a4f;
    }
    .dm-logo svg { width: 1.6em; height: 1.6em; flex-shrink: 0; }
    .dm-nav { padding: 0 .55em; display: flex; flex-direction: column; gap: .12em; }
    .dm-item {
    display: flex;
    align-items: center;
    gap: .6em;
    padding: .52em .7em;
    border-radius: .6em;
    font-size: .88em;
    color: #6b7b99;
    white-space: nowrap;
    overflow: hidden;
    }
    .dm-item svg { width: 1.2em; height: 1.2em; flex-shrink: 0; }
    .dm-item.on { background: #e8efff; color: #2f57f6; font-weight: 600; }
    .dm-main {
    flex: 1;
    padding: 1em 1.15em;
    display: flex;
    flex-direction: column;
    gap: .8em;
    min-width: 0;
    overflow: hidden;
    }
    .dm-head { font-size: 1em; font-weight: 700; color: #1d2a4f; }
    .dm-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: .6em; }
    .dm-s {
    background: #f8faff;
    border: 1px solid #e8f0fc;
    border-radius: .75em;
    padding: .65em .7em;
    }
    .dm-s-lbl { font-size: .68em; color: #8a9bbf; margin-bottom: .18em; line-height: 1.3; }
    .dm-s-val { font-size: 1.1em; font-weight: 700; color: #1d2a4f; line-height: 1; margin-bottom: .18em; }
    .dm-s-chg { font-size: .62em; font-weight: 600; line-height: 1.3; }
    .dm-g { color: #35b64b; }
    .dm-r { color: #e74c3c; }
    .dm-chart {
    background: #f8faff;
    border: 1px solid #e8f0fc;
    border-radius: .75em;
    padding: .75em .9em;
    }
    .dm-chart-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: .5em; }
    .dm-ct { font-size: .82em; font-weight: 700; color: #1d2a4f; }
    .dm-cp { font-size: .68em; color: #8a9bbf; }
    .dm-chart-svg { width: 100%; height: auto; display: block; }
    .dm-tbls { display: grid; grid-template-columns: 1fr 1fr; gap: .7em; }
    .dm-tbl {
    background: #f8faff;
    border: 1px solid #e8f0fc;
    border-radius: .75em;
    padding: .7em .85em;
    }
    .dm-tbl-h {
    font-size: .78em;
    font-weight: 700;
    color: #1d2a4f;
    padding-bottom: .38em;
    border-bottom: 1px solid #e8f0fc;
    margin-bottom: .45em;
    }
    .dm-pr {
    display: flex;
    align-items: center;
    gap: .45em;
    padding: .3em 0;
    border-bottom: 1px solid #f0f4fc;
    }
    .dm-pr:last-child { border: none; padding-bottom: 0; }
    .dm-pi {
    width: 1.9em; height: 1.9em;
    border-radius: .4em;
    background: #e8efff;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    }
    .dm-pi svg { width: 1.1em; height: 1.1em; }
    .dm-pn { flex: 1; min-width: 0; }
    .dm-pn p:first-child { font-size: .73em; font-weight: 600; color: #1d2a4f; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .dm-pn p:last-child  { font-size: .62em; color: #8a9bbf; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .dm-pp { font-size: .73em; font-weight: 600; color: #1d2a4f; flex-shrink: 0; }
    .dm-ps { font-size: .73em; font-weight: 700; color: #e74c3c; flex-shrink: 0; margin-left: .25em; }
    .dm-cr {
    display: flex;
    align-items: center;
    gap: .5em;
    padding: .38em 0;
    border-bottom: 1px solid #f0f4fc;
    }
    .dm-cr:last-child { border: none; padding-bottom: 0; }
    .dm-cd { width: .65em; height: .65em; border-radius: 50%; background: #2f57f6; flex-shrink: 0; }
    .dm-cn { font-size: .73em; color: #374162; flex: 1; min-width: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .dm-cv { font-size: .73em; font-weight: 700; color: #1d2a4f; flex-shrink: 0; }
    .dashed-border { border: 2px dashed var(--blue) !important;border-radius: 10px; }
</style>
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KV3N43LJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

{{-- ════ NAVIGATION ════ --}}
<nav class="lp-nav" aria-label="Main navigation">
  <div class="lp-shell lp-nav-inner">
    <a href="/" class="lp-nav-logo" aria-label="TSScout home">
      <img src="{{ asset('images/logo.svg') }}" alt="TSScout" height="34">
    </a>

    <ul class="lp-nav-links" role="list">
      <li><a href="#features" class="lp-nav-link">Features</a></li>
      <li><a href="#how-it-works" class="lp-nav-link">How it Works</a></li>
      <li><a href="#pricing" class="lp-nav-link">Pricing</a></li>
      <li class="lp-nav-dd">
        <button class="lp-nav-link" type="button" aria-haspopup="true">
          Resources
          <svg width="11" height="7" viewBox="0 0 11 7" fill="none" style="vertical-align:middle;margin-left:.2rem" aria-hidden="true">
            <path d="M1 1l4.5 4.5L10 1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
        <ul class="lp-nav-dd-menu" role="list">
          <li><a href="/blog" class="lp-nav-dd-link">Blog</a></li>
          <li><a href="/guides" class="lp-nav-dd-link">Guides</a></li>
          <li><a href="/api" class="lp-nav-dd-link">API</a></li>
        </ul>
      </li>
    </ul>

    <div class="lp-nav-actions">
      <a href="https://app.tsscout.com/login" class="lp-login">Log In</a>
      <a href="https://app.tsscout.com/pricing" class="lp-btn lp-btn-primary lp-btn-sm">Start $1 Trial</a>
    </div>
  </div>
</nav>

{{-- ════ HERO ════ --}}
<section class="lp-hero" aria-label="Find Winning Products">
  <div class="lp-shell">
    <div class="lp-hero-grid">

      {{-- Left --}}
      <div>
        <span class="lp-hero-badge" aria-label="Platform category">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/>
          </svg>
          ALL-IN-ONE PRODUCT RESEARCH PLATFORM
        </span>

        <h1>Find Winning <em>Products</em><br>Before Your Competitors</h1>

        <p class="lp-hero-desc">
          Analyze eBay, Shopify, Walmart &amp; TikTok Shop data to discover trending products, track competitors, compare supplier prices, and build better listings faster.
        </p>

        <ul class="lp-hero-bullets">
          @foreach([
            'Discover trending products faster',
            'Track competitors in real time',
            'Compare eBay &amp; AliExpress prices',
            'Find trusted suppliers instantly',
            'Generate optimized product titles',
          ] as $bullet)
          <li>
            <span class="lp-bullet-dot" aria-hidden="true">
              <svg viewBox="0 0 11 9" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 4.5l3 3L10 1"/>
              </svg>
            </span>
            {!! $bullet !!}
          </li>
          @endforeach
        </ul>

        <div class="lp-hero-ctas">
          <a href="https://app.tsscout.com/pricing" class="lp-btn lp-btn-primary">Start Your $1 Trial</a>
          <a href="#how-it-works" class="lp-btn lp-btn-outline">
            <span class="lp-play-circle" aria-hidden="true">
              <svg viewBox="0 0 10 12" fill="currentColor"><path d="M1 1l8 5-8 5V1z"/></svg>
            </span>
            Watch Demo
          </a>
        </div>

        <div class="lp-hero-sub">
          @foreach(['No commitment', 'Cancel anytime', 'Full premium access'] as $note)
          <span class="lp-hero-sub-item">
            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
              <circle cx="8" cy="8" r="8"/>
              <path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ $note }}
          </span>
          @if(!$loop->last)<span aria-hidden="true" style="color:#c5d0e8">•</span>@endif
          @endforeach
        </div>
      </div>

      {{-- Right – dashboard preview --}}
      <div class="lp-hero-img dashed-border">
        <img
          src="{{ asset('images/landing/reengage/dashboard-preview.png') }}"
          alt="TSScout Dashboard Preview"
          width="957"
          height="441"
          loading="eager"
          fetchpriority="high"
          style="max-width:100%;border-radius:12px;box-shadow:0 20px 60px rgba(47,87,246,.2);"
        >
      </div>

    </div>
  </div>
</section>

{{-- ════ TRUST BAR ════ --}}
<section class="lp-trust" aria-label="Trusted by eCommerce sellers">
  <div class="lp-shell">
    <div class="lp-trust-inner">
      <p class="lp-trust-label">Trusted By eCommerce Sellers Worldwide</p>
      <div class="lp-trust-logos">
        <img src="{{ asset('images/amazon-logo.jpg') }}"     alt="Amazon"      height="26" loading="lazy">
        <img src="{{ asset('images/ebay.jpg') }}"            alt="eBay"         height="26" loading="lazy">
        <img src="{{ asset('images/shopify-logo-black.png') }}" alt="Shopify"   height="26" class="tiktok-shop" loading="lazy">
        <img src="{{ asset('images/tiktok_shop_logo.png') }}" class="tiktok-shop" alt="TikTok Shop" height="26" loading="lazy">
        <img src="{{ asset('images/aliexpress-logo.jpg') }}" alt="AliExpress"   height="26" loading="lazy">
        <img src="{{ asset('images/walmart.jpg') }}"         alt="Walmart"      height="26" loading="lazy">
      </div>
    </div>
  </div>
</section>

{{-- ════ WHY MOST SELLERS LOSE MONEY ════ --}}
<section class="lp-problems" aria-labelledby="problems-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="problems-h" class="lp-h2">Why Most Sellers Lose Money</h2>
    </div>
    <div class="lp-problems-grid">

      <div class="lp-problem-card">
        <div class="lp-icon-circle" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <h3>Choosing saturated products</h3>
        <p>Most sellers enter crowded markets too late.</p>
      </div>

      <div class="lp-problem-card">
        <div class="lp-icon-circle" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65">
            <path d="M6 7h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2z"/>
            <path d="M9 7V6a3 3 0 0 1 6 0v1"/>
            <path d="M4 11h16"/>
          </svg>
        </div>
        <h3>Running stores without real data</h3>
        <p>Guessing products leads to wasted time and poor sales.</p>
      </div>

      <div class="lp-problem-card">
        <div class="lp-icon-circle" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </div>
        <h3>Copying competitors blindly</h3>
        <p>Without competitor insights, sellers stay behind.</p>
      </div>

      <div class="lp-problem-card">
        <div class="lp-icon-circle" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <h3>Spending hours finding suppliers</h3>
        <p>Manual supplier research wastes valuable time.</p>
      </div>

    </div>

    <div class="lp-center">
      <p class="lp-problems-note">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <polygon points="13,2 3,14 12,14 11,22 21,10 12,10"/>
        </svg>
        Smart sellers use data — not guesswork.
      </p>
    </div>
  </div>
</section>

{{-- ════ FEATURES ════ --}}
<section class="lp-features" id="features" aria-labelledby="features-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="features-h" class="lp-h2">Everything You Need To Research Winning Products</h2>
    </div>
    <div class="lp-features-grid">

      <div class="lp-feat-card">
        <div class="lp-feat-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
        </div>
        <h3>Product Research</h3>
        <p>Analyze best-selling products by category, timeframe, demand, and sales history.</p>
      </div>

      <div class="lp-feat-card">
        <div class="lp-feat-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <h3>Competitor Analysis</h3>
        <p>Track seller performance, ratings, listings, and product activity.</p>
      </div>

      <div class="lp-feat-card">
        <div class="lp-feat-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round">
            <path d="M12 3l8 4.5-8 4.5-8-4.5L12 3z"/>
            <path d="M4 7.5V16.5L12 21l8-4.5V7.5"/>
            <path d="M12 12v9"/>
          </svg>
        </div>
        <h3>Supplier Finder</h3>
        <p>Compare eBay product prices with AliExpress supplier prices instantly.</p>
      </div>

      <div class="lp-feat-card">
        <div class="lp-feat-icon" aria-hidden="true">
          {{-- TikTok logo --}}
          <svg viewBox="0 0 24 24" fill="currentColor" stroke="none">
            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.3 6.3 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.72a8.19 8.19 0 0 0 4.79 1.52V6.77a4.85 4.85 0 0 1-1.02-.08z"/>
          </svg>
        </div>
        <h3>TikTok Trend Scanner</h3>
        <p>Discover trending TikTok Shop products before they become saturated.</p>
      </div>

      <div class="lp-feat-card">
        <div class="lp-feat-icon lp-feat-icon-shopify" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M6.5 8h11l-1 11.5H7.5L6.5 8z"/>
            <path d="M9 8V6.5a3 3 0 0 1 6 0V8"/>
            <path d="M11 16.8c.45.45 1.3.75 2.1.48.57-.19.9-.69.86-1.16-.04-.5-.5-.89-1.22-1.06l-.9-.2c-.79-.18-1.27-.66-1.3-1.26-.03-.66.48-1.28 1.3-1.48.8-.2 1.63.07 2.13.52"/>
          </svg>
        </div>
        <h3>Shopify Store Analysis</h3>
        <p>Analyze Shopify stores and uncover top-performing products.</p>
      </div>

      <div class="lp-feat-card">
        <div class="lp-feat-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
            <rect x="4" y="5" width="16" height="14" rx="2"/>
            <path d="M8 15l2.4-3 2.2 2 2.4-3 3 4"/>
            <circle cx="9" cy="9" r="1"/>
          </svg>
        </div>
        <h3>SmartTitles</h3>
        <p>Generate optimized listing titles to improve visibility and clicks.</p>
      </div>

    </div>
  </div>
</section>

{{-- ════ HOW IT WORKS ════ --}}
<section class="lp-how" id="how-it-works" aria-labelledby="how-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="how-h" class="lp-h2">How TSScout Works</h2>
    </div>
    <div class="lp-how-steps">

      <div class="lp-how-step">
        <div class="lp-step-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <span class="lp-step-num" aria-hidden="true">1</span>
        </div>
        <h3>Choose a category or keyword</h3>
        <p>Start your research with any product or niche.</p>
      </div>

      <div class="lp-how-arrow" aria-hidden="true">→</div>

      <div class="lp-how-step">
        <div class="lp-step-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <line x1="18" y1="20" x2="18" y2="10"/>
            <line x1="12" y1="20" x2="12" y2="4"/>
            <line x1="6"  y1="20" x2="6"  y2="14"/>
          </svg>
          <span class="lp-step-num" aria-hidden="true">2</span>
        </div>
        <h3>Analyze best-selling products &amp; competitors</h3>
        <p>See sales data, seller ratings, and competitor performance.</p>
      </div>

      <div class="lp-how-arrow" aria-hidden="true">→</div>

      <div class="lp-how-step">
        <div class="lp-step-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
            <polyline points="17 6 23 6 23 12"/>
          </svg>
          <span class="lp-step-num" aria-hidden="true">3</span>
        </div>
        <h3>Compare supplier prices on AliExpress</h3>
        <p>Find the same products on AliExpress and compare prices.</p>
      </div>

      <div class="lp-how-arrow" aria-hidden="true">→</div>

      <div class="lp-how-step">
        <div class="lp-step-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
            <path d="M12 2c0 0 5 2.5 5 10 0 5-3.3 7.5-5 7.5S7 17 7 12C7 4.5 12 2 12 2z"/>
            <line x1="12" y1="19.5" x2="12" y2="22"/>
            <path d="M8.5 15.5C7 17 5 18 4 20"/>
            <path d="M15.5 15.5C17 17 19 18 20 20"/>
          </svg>
          <span class="lp-step-num" aria-hidden="true">4</span>
        </div>
        <h3>Launch products using real market data</h3>
        <p>Make smarter decisions and increase your profits.</p>
      </div>

    </div>
  </div>
</section>

{{-- ════ WHAT YOU CAN ANALYZE ════ --}}
<section class="lp-analyze" aria-labelledby="analyze-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="analyze-h" class="lp-h2">What You Can Analyze With TSScout</h2>
    </div>
    <div class="lp-metrics">

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Sales Count</p>
          <p class="lp-metric-val">8,210</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8"  y1="2" x2="8"  y2="6"/>
            <line x1="3"  y1="10" x2="21" y2="10"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Last Sold Date</p>
          <p class="lp-metric-val">4 hours ago</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Seller Name</p>
          <p class="lp-metric-val">bestshop_store</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true" style="background:#fff8e6">
          <svg viewBox="0 0 24 24" fill="#f5a623" stroke="none">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Product Rating</p>
          <p class="lp-metric-val" style="color:#f5a623">★★★★★ 4.8</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
            <polyline points="17 6 23 6 23 12"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Estimated Demand</p>
          <p class="lp-metric-val" style="color:var(--green)">High</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <line x1="12" y1="1" x2="12" y2="23"/>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Supplier Price</p>
          <p class="lp-metric-val">$8.45</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true" style="background:#e6f8ea">
          <svg viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="1.75">
            <line x1="12" y1="1" x2="12" y2="23"/>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Profit Opportunity</p>
          <p class="lp-metric-val" style="color:var(--green)">$15.55</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Competitor Activity</p>
          <p class="lp-metric-val" style="color:var(--blue)">Active</p>
        </div>
      </div>

      <div class="lp-metric">
        <div class="lp-metric-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
            <line x1="18" y1="20" x2="18" y2="10"/>
            <line x1="12" y1="20" x2="12" y2="4"/>
            <line x1="6"  y1="20" x2="6"  y2="14"/>
          </svg>
        </div>
        <div>
          <p class="lp-metric-lbl">Trending Score</p>
          <p class="lp-metric-val">92<span style="font-size:.65em;color:var(--muted)">/100</span></p>
        </div>
      </div>

    </div>

    <p class="lp-analyze-note">
      Stop guessing, start Trending
      <svg viewBox="0 0 20 12" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="12" aria-hidden="true">
        <path d="M1 6h16M12 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </p>

  </div>
</section>

{{-- ════ COMPARISON TABLE ════ --}}
<section class="lp-compare" aria-labelledby="compare-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="compare-h" class="lp-h2">Why Sellers Choose TSScout</h2>
    </div>
    <div class="lp-compare-wrap">
      <table class="lp-compare-table" aria-label="Feature comparison between TSScout and other tools">
        <thead>
          <tr>
            <th scope="col">Feature</th>
            <th scope="col" class="lp-col-ts">TSScout</th>
            <th scope="col">Other Tools</th>
          </tr>
        </thead>
        <tbody>
          @foreach([
            'Multi-platform research',
            'Competitor analysis',
            'Supplier comparison (eBay vs AliExpress)',
            'TikTok trend scanner',
            'Shopify store insights',
            'Smart title generation',
            '$1 trial',
          ] as $row)
          <tr>
            <td>{{ $row }}</td>
            <td>
              <span class="lp-tick" aria-label="Available in TSScout">
                <svg viewBox="0 0 13 11" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 5.5l3.5 3.5L12 1"/>
                </svg>
              </span>
            </td>
            <td>
              <span class="lp-cross" aria-label="Not available in other tools">
                <svg viewBox="0 0 11 11" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                  <path d="M1 1l9 9M10 1L1 10"/>
                </svg>
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

{{-- ════ PRICING ════ --}}
<section class="lp-pricing" id="pricing" aria-labelledby="pricing-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="pricing-h" class="lp-h2">Start Today For Only $1</h2>
    </div>
    <div class="lp-pricing-box">

      <div class="lp-price-card">
        <p class="lp-price-lbl">Premium Plan</p>
        <p class="lp-price-amt">$1</p>
        <p class="lp-price-tag">Trial</p>
        <p class="lp-price-note">Then continues at regular premium pricing.</p>
      </div>

      <div class="lp-pricing-feats">
        <ul class="lp-pricing-list">
          @foreach([
            'Full access to all premium tools',
            'Product research',
            'Competitor analysis',
            'Supplier comparison',
            'TikTok trends',
            'Shopify Insights',
            'SmartTitles',
            'Priority support',
          ] as $feat)
          <li>
            <svg viewBox="0 0 15 13" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M1 6.5l4 4L14 1"/>
            </svg>
            {{ $feat }}
          </li>
          @endforeach
        </ul>

        <a href="https://app.tsscout.com/pricing" class="lp-btn lp-btn-primary" style="width:100%;justify-content:center">
          Start My $1 Trial
        </a>
        <p class="lp-pricing-sub">Cancel anytime &nbsp;•&nbsp; No hidden fees</p>
      </div>

    </div>
  </div>
</section>

{{-- ════ TESTIMONIALS ════ --}}
<section class="lp-testimonials" aria-labelledby="testi-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="testi-h" class="lp-h2">What Sellers Are Saying</h2>
    </div>
    <div class="lp-testi-grid">

      @php
      $testimonials = [
        ['quote' => '"TSScout helped me find my first winning product in less than a week."',    'name' => 'Sarah M.',  'role' => 'eBay Seller'],
        ['quote' => '"This tool saved me hours of product research every week."',                'name' => 'James R.',  'role' => 'Shopify Store Owner'],
        ['quote' => '"Competitor tracking alone makes TSScout worth it."',                      'name' => 'Emily T.',  'role' => 'Amazon Seller'],
      ];
      @endphp

      @foreach($testimonials as $t)
      <div class="lp-testi-card">
        <div class="lp-stars" aria-label="5 out of 5 stars">
          @for($i = 0; $i < 5; $i++)
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01z"/>
          </svg>
          @endfor
        </div>
        <p class="lp-testi-text">{{ $t['quote'] }}</p>
        <div class="lp-testi-author">
          <div class="lp-avatar" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="currentColor" style="color:var(--muted)">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </div>
          <div>
            <p class="lp-author-name">{{ $t['name'] }}</p>
            <p class="lp-author-role">{{ $t['role'] }}</p>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

{{-- ════ FAQ ════ --}}
<section class="lp-faq" aria-labelledby="faq-h">
  <div class="lp-shell">
    <div class="lp-center">
      <h2 id="faq-h" class="lp-h2">Frequently Asked Questions</h2>
    </div>
    <div class="lp-faq-list">

      @php
      $faqs = [
        [
          'q' => 'How does the $1 trial work?',
          'a' => 'Start your full-access trial for just $1. After the trial period, your subscription continues at the regular premium price. Cancel anytime before the trial ends and you won\'t be charged anything more.',
        ],
        [
          'q' => 'Can I cancel anytime?',
          'a' => 'Yes, you can cancel your subscription at any time with no questions asked. There are no long-term contracts or hidden fees.',
        ],
        [
          'q' => 'Which marketplaces does TSScout support?',
          'a' => 'TSScout supports eBay, Shopify, Walmart, TikTok Shop, and AliExpress — giving you a complete view of the eCommerce landscape.',
        ],
        [
          'q' => 'Is TSScout beginner friendly?',
          'a' => 'Absolutely! TSScout is designed for sellers of all experience levels. Whether you\'re just starting out or scaling an existing store, our tools are intuitive and easy to use.',
        ],
      ];
      @endphp

      @foreach($faqs as $idx => $faq)
      <div class="lp-faq-item" id="faq-{{ $idx }}">
        <button
          class="lp-faq-btn"
          type="button"
          aria-expanded="false"
          aria-controls="faq-body-{{ $idx }}"
        >
          <span>{{ $faq['q'] }}</span>
          <span class="lp-faq-chevron" aria-hidden="true">
            <svg viewBox="0 0 11 7" fill="none">
              <path d="M1 1l4.5 4.5L10 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </button>
        <div class="lp-faq-body" id="faq-body-{{ $idx }}" role="region" aria-labelledby="faq-{{ $idx }}">
          <p>{{ $faq['a'] }}</p>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>

{{-- ════ FINAL CTA ════ --}}
<section class="lp-cta" aria-labelledby="cta-h">
  <div class="lp-shell">
    <div class="lp-cta-grid">

      <div class="lp-final-cta-text">
        <h2 id="cta-h">Ready To Find Your<br><em>Next Winning Product?</em></h2>
        <p class="lp-cta-sub-p">Stop guessing.<br>Start selling with real market data.</p>
        <a href="https://app.tsscout.com/pricing" class="lp-btn lp-btn-white">Start Your $1 Trial</a>
        <div class="lp-cta-note">
          <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
            <circle cx="8" cy="8" r="8"/>
            <path d="M5 8l2 2 4-4" fill="none" stroke="#fff" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Full premium access &nbsp;•&nbsp; Cancel anytime
        </div>
      </div>

      <div class="lp-cta-rocket" aria-hidden="true">
        {{-- Rocket SVG illustration --}}
        <svg viewBox="0 0 200 220" fill="none" xmlns="http://www.w3.org/2000/svg">
          {{-- Glow circle --}}
          <circle cx="100" cy="108" r="88" fill="rgba(59,105,255,.07)" stroke="rgba(59,105,255,.12)" stroke-width="1.5"/>
          {{-- Body --}}
          <ellipse cx="100" cy="108" rx="30" ry="48" fill="#3b69ff"/>
          {{-- Nose --}}
          <path d="M70 92 Q100 22 130 92 Z" fill="#5c88ff"/>
          {{-- Window --}}
          <circle cx="100" cy="94" r="11" fill="#c8dbff" stroke="rgba(255,255,255,.5)" stroke-width="1.5"/>
          <circle cx="100" cy="94" r="6"  fill="#e8efff"/>
          {{-- Left fin --}}
          <path d="M70 120 L48 150 L75 138 Z" fill="#2144ea"/>
          {{-- Right fin --}}
          <path d="M130 120 L152 150 L125 138 Z" fill="#2144ea"/>
          {{-- Exhaust glow --}}
          <ellipse cx="100" cy="158" rx="14" ry="22" fill="#f5a623" opacity=".8"/>
          <ellipse cx="100" cy="162" rx="8"  ry="14" fill="#ffd280" opacity=".65"/>
          <ellipse cx="100" cy="165" rx="4"  ry="8"  fill="#fff"    opacity=".55"/>
          {{-- Stars --}}
          <circle cx="36" cy="44"  r="2" fill="rgba(255,255,255,.5)"/>
          <circle cx="162" cy="58" r="1.5" fill="rgba(255,255,255,.4)"/>
          <circle cx="28" cy="140" r="1.5" fill="rgba(255,255,255,.3)"/>
          <circle cx="170" cy="130" r="2" fill="rgba(255,255,255,.4)"/>
          <circle cx="50" cy="190" r="1.5" fill="rgba(255,255,255,.25)"/>
        </svg>
      </div>

    </div>
  </div>
</section>

{{-- ════ FOOTER ════ --}}
<footer class="lp-footer" aria-label="Site footer">
  <div class="lp-shell">
    <div class="lp-footer-grid">

      <div class="lp-footer-brand">
        <img src="{{ asset('images/footer-logo.svg') }}" alt="TSScout" height="32" loading="lazy">
        <p>Product &amp; competitor research platform for eCommerce sellers.</p>
      </div>

      <div class="lp-footer-col">
        <h4>Product</h4>
        <ul>
          <li><a href="/product-research">Product Research</a></li>
          <li><a href="/competitor-analysis">Competitor Analysis</a></li>
          <li><a href="/supplier-finder">Supplier Finder</a></li>
          <li><a href="/tiktok-trends">TikTok Trends</a></li>
          <li><a href="/smart-titles">SmartTitles</a></li>
        </ul>
      </div>

      <div class="lp-footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="/about">About Us</a></li>
          <li><a href="/pricing">Pricing</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </div>

      <div class="lp-footer-col">
        <h4>Resources</h4>
        <ul>
          <li><a href="/help">Help Center</a></li>
          <li><a href="/guides">Guides</a></li>
          <li><a href="/api">API</a></li>
        </ul>
      </div>

      <div class="lp-footer-col">
        <h4>Legal</h4>
        <ul>
          <li><a href="/terms">Terms of Service</a></li>
          <li><a href="/privacy">Privacy Policy</a></li>
          <li><a href="/refund">Refund Policy</a></li>
        </ul>
      </div>

    </div>

    <div class="lp-footer-bottom">
      <p class="lp-footer-copy">© 2024 TSScout. All rights reserved.</p>
      <div class="lp-socials">
        <a href="#" class="lp-social" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
          </svg>
        </a>
        <a href="#" class="lp-social" aria-label="Twitter / X">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
        </a>
        <a href="#" class="lp-social" aria-label="YouTube">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.95C5.12 20 12 20 12 20s6.88 0 8.59-.47a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/>
            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="#090f24"/>
          </svg>
        </a>
        <a href="#" class="lp-social" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>

<script>
(function () {
  // FAQ accordion
  document.querySelectorAll('.lp-faq-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var item   = this.closest('.lp-faq-item');
      var isOpen = item.classList.contains('is-open');

      // Close all
      document.querySelectorAll('.lp-faq-item').forEach(function (el) {
        el.classList.remove('is-open');
        el.querySelector('.lp-faq-btn').setAttribute('aria-expanded', 'false');
        el.querySelector('.lp-faq-body').style.maxHeight = null;
      });

      // Toggle this one
      if (!isOpen) {
        item.classList.add('is-open');
        btn.setAttribute('aria-expanded', 'true');
        var body = item.querySelector('.lp-faq-body');
        body.style.maxHeight = body.scrollHeight + 'px';
      }
    });
  });
})();
</script>
<x-refgrow />
</body>
</html>
