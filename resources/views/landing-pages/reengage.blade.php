@extends('layouts.landing')

@section('title', isset($page) ? $page->title : 'TSSCOUT | Reengage')
@section('meta_description', isset($page) ? $page->meta_description : 'Find winning products before your competitors with TSSCOUT. Product research, competitor tracking, supplier comparison, and trend analysis in one platform.')
@section('meta_keywords', isset($page) ? $page->meta_keywords : 'TSSCOUT, product research, competitor tracking, TikTok trends, supplier finder, Shopify analysis')
@section('meta_author', isset($page) ? $page->meta_author : 'TSSCOUT')

@section('og_title', isset($page) ? $page->title : 'Find Winning Products Before Your Competitors')
@section('og_description', isset($page) ? $page->meta_description : 'Analyze eBay, Shopify, Walmart and TikTok Shop data to discover trends and profitable products faster.')
@section('og_image', asset('images/logo.svg'))

@section('styles')
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap');

		:root {
			--rg-bg: #f3f7ff;
			--rg-panel: #ffffff;
			--rg-primary: #2563ff;
			--rg-primary-dark: #0f2e87;
			--rg-ink: #0f1f42;
			--rg-muted: #51648f;
			--rg-border: #d9e4ff;
			--rg-soft: #eaf1ff;
			--rg-good: #1aa963;
			--rg-bad: #df3a3a;
			--rg-night: #081a4a;
			--rg-shadow: 0 16px 40px rgba(16, 39, 103, 0.11);
		}

		.reengage-page {
			background:
				radial-gradient(circle at 8% 6%, #e8f0ff 0, rgba(232, 240, 255, 0) 38%),
				radial-gradient(circle at 94% 14%, #dde9ff 0, rgba(221, 233, 255, 0) 36%),
				linear-gradient(180deg, #f9fbff 0%, #f1f6ff 100%);
			color: var(--rg-ink);
			font-family: 'Manrope', 'Segoe UI', sans-serif;
			overflow: hidden;
		}

		.rg-shell {
			width: min(1140px, calc(100% - 1.2rem));
			margin: 0 auto;
		}

		.rg-topbar {
			position: sticky;
			top: 0;
			z-index: 25;
			background: linear-gradient(120deg, #08194a 0%, #0f2f86 70%, #1744bc 100%);
			border-bottom: 1px solid rgba(129, 164, 255, 0.33);
			box-shadow: 0 8px 18px rgba(5, 15, 44, 0.3);
		}

		.rg-nav {
			min-height: 62px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 0.9rem;
		}

		.rg-brand {
			display: inline-flex;
			align-items: center;
			gap: 0.52rem;
			text-decoration: none;
			color: #ffffff;
			font-family: 'Outfit', 'Manrope', sans-serif;
			font-weight: 700;
			letter-spacing: 0.015em;
			font-size: 1.08rem;
		}

		.rg-logo {
			width: 28px;
			height: 28px;
			border-radius: 7px;
			background: linear-gradient(145deg, #25adff 0%, #2563ff 70%);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.18);
		}

		.rg-links {
			display: none;
			align-items: center;
			gap: 0.95rem;
		}

		.rg-links a {
			color: #dce6ff;
			text-decoration: none;
			font-size: 0.88rem;
			font-weight: 600;
			transition: color 0.2s ease;
		}

		.rg-links a:hover {
			color: #ffffff;
		}

		.rg-actions {
			display: inline-flex;
			align-items: center;
			gap: 0.42rem;
		}

		.rg-btn {
			border: 0;
			border-radius: 10px;
			padding: 0.58rem 0.82rem;
			font-family: inherit;
			font-size: 0.78rem;
			font-weight: 700;
			text-decoration: none;
			line-height: 1;
			transition: transform 0.2s ease, box-shadow 0.2s ease;
			white-space: nowrap;
		}

		.rg-btn:hover {
			transform: translateY(-1px);
		}

		.rg-btn-outline {
			color: #dce6ff;
			border: 1px solid rgba(175, 197, 255, 0.48);
			background: rgba(11, 27, 78, 0.44);
		}

		.rg-btn-primary {
			color: #ffffff;
			background: linear-gradient(90deg, #3271ff 0%, #1950e2 100%);
			box-shadow: 0 9px 18px rgba(25, 80, 226, 0.4);
		}

		.rg-hero {
			padding: 1rem 0 1.5rem;
		}

		.rg-panel {
			border: 1px solid var(--rg-border);
			border-radius: 18px;
			background: var(--rg-panel);
			padding: 1.1rem;
			box-shadow: var(--rg-shadow);
		}

		.rg-hero-grid {
			display: grid;
			grid-template-columns: 1fr;
			gap: 1rem;
		}

		.rg-pill {
			width: fit-content;
			display: inline-flex;
			align-items: center;
			gap: 0.4rem;
			border: 1px solid #d2e1ff;
			background: #edf3ff;
			color: #264fa8;
			border-radius: 999px;
			font-size: 0.68rem;
			letter-spacing: 0.09em;
			font-weight: 800;
			text-transform: uppercase;
			padding: 0.36rem 0.6rem;
		}

		.rg-hero h1 {
			margin: 0.8rem 0 0;
			font-family: 'Outfit', 'Manrope', sans-serif;
			font-size: 1.85rem;
			line-height: 1.09;
			color: #0c2156;
			max-width: 18ch;
		}

		.rg-hero h1 span {
			color: var(--rg-primary);
		}

		.rg-hero p {
			margin: 0.8rem 0 0;
			color: #405581;
			font-size: 0.95rem;
			line-height: 1.66;
			max-width: 52ch;
		}

		.rg-list {
			margin: 0.9rem 0 0;
			padding: 0;
			list-style: none;
			display: grid;
			gap: 0.38rem;
		}

		.rg-list li {
			display: flex;
			align-items: center;
			gap: 0.45rem;
			color: #233c71;
			font-size: 0.84rem;
			font-weight: 600;
		}

		.rg-hero-cta {
			margin-top: 1rem;
			display: grid;
			grid-template-columns: 1fr;
			gap: 0.5rem;
		}

		.rg-primary-cta,
		.rg-ghost-cta {
			text-align: center;
			border-radius: 11px;
			text-decoration: none;
			font-size: 0.92rem;
			font-weight: 800;
			padding: 0.72rem 0.9rem;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 0.44rem;
		}

		.rg-primary-cta {
			color: #ffffff;
			background: linear-gradient(90deg, #2f6bff 0%, #1347d1 100%);
			box-shadow: 0 12px 20px rgba(35, 88, 227, 0.24);
		}

		.rg-ghost-cta {
			color: #173f9f;
			border: 1px solid #bdd0ff;
			background: #f4f8ff;
		}

		.rg-trustline {
			margin-top: 0.65rem;
			color: #60729a;
			font-size: 0.74rem;
			display: flex;
			align-items: center;
			flex-wrap: wrap;
			gap: 0.45rem;
		}

		.rg-dashboard {
			border: 1px solid #d7e4ff;
			border-radius: 15px;
			background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
			padding: 0.52rem;
			position: relative;
			overflow: hidden;
		}

		.rg-dashboard::before {
			content: "";
			position: absolute;
			inset: 0;
			background: linear-gradient(180deg, rgba(255, 255, 255, 0.02) 0%, rgba(255, 255, 255, 0.15) 100%);
			pointer-events: none;
			z-index: 2;
		}

		.rg-dashboard-image {
			display: block;
			width: 100%;
			aspect-ratio: 16 / 11;
			border-radius: 11px;
			object-fit: cover;
			object-position: top left;
			transform: scale(1.02);
			transform-origin: top left;
		}

		.rg-dashboard-chip {
			position: absolute;
			top: 0.86rem;
			left: 0.86rem;
			z-index: 3;
			background: rgba(16, 41, 108, 0.85);
			color: #ffffff;
			font-size: 0.64rem;
			font-weight: 800;
			letter-spacing: 0.06em;
			text-transform: uppercase;
			padding: 0.3rem 0.46rem;
			border-radius: 999px;
			border: 1px solid rgba(175, 201, 255, 0.5);
		}

		.rg-dashboard-crop {
			position: absolute;
			right: 0.82rem;
			bottom: 0.8rem;
			z-index: 3;
			background: rgba(255, 255, 255, 0.9);
			color: #1b418f;
			font-size: 0.67rem;
			font-weight: 700;
			padding: 0.28rem 0.45rem;
			border-radius: 7px;
			border: 1px solid #d4e2ff;
		}

		.rg-kpis {
			margin-top: 0.5rem;
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 0.42rem;
		}

		.rg-kpi {
			border: 1px solid #dfe8ff;
			border-radius: 9px;
			background: #ffffff;
			padding: 0.38rem;
		}

		.rg-kpi p {
			margin: 0;
			font-size: 0.62rem;
			color: #63739a;
			font-weight: 600;
			line-height: 1.2;
		}

		.rg-kpi strong {
			display: block;
			margin-top: 0.22rem;
			color: #182f61;
			font-size: 0.72rem;
		}

		.rg-chart {
			margin-top: 0.5rem;
			border: 1px solid #e1eaff;
			border-radius: 10px;
			background: #fcfdff;
			padding: 0.36rem;
		}

		.rg-chart svg {
			display: block;
			width: 100%;
			height: 72px;
		}

		.rg-logo-strip {
			margin-top: 0.8rem;
			border: 1px solid var(--rg-border);
			border-radius: 16px;
			background: var(--rg-panel);
			padding: 0.85rem;
			text-align: center;
		}

		.rg-logo-strip p {
			margin: 0;
			color: #1e3770;
			font-size: 0.89rem;
			font-weight: 800;
		}

		.rg-logos {
			margin-top: 0.72rem;
			display: grid;
			grid-template-columns: repeat(3, minmax(0, 1fr));
			gap: 0.44rem;
		}

		.rg-logo-item {
			border: 1px dashed #ccd9fa;
			border-radius: 10px;
			background: #f9fbff;
			padding: 0.42rem;
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 42px;
		}

		.rg-logo-item img {
			display: block;
			max-height: 22px;
			width: auto;
			max-width: 96%;
			object-fit: contain;
		}

		.rg-logo-item img.rg-logo-amazon {
			max-height: 17px;
		}

		.rg-logo-item img.rg-logo-ebay,
		.rg-logo-item img.rg-logo-shopify,
		.rg-logo-item img.rg-logo-aliexpress,
		.rg-logo-item img.rg-logo-walmart {
			max-height: 24px;
		}

		.rg-logo-item img.rg-logo-tiktok {
			max-height: 19px;
		}

		.rg-card-icon-img {
			display: block;
			width: 28px;
			height: 28px;
		}

		.rg-section {
			margin-top: 0.92rem;
			border: 1px solid var(--rg-border);
			border-radius: 16px;
			background: var(--rg-panel);
			padding: 0.95rem;
		}

		.rg-section h2 {
			margin: 0;
			font-family: 'Outfit', 'Manrope', sans-serif;
			font-size: 1.3rem;
			text-align: center;
			color: #0f2e80;
		}

		.rg-grid-4,
		.rg-grid-6,
		.rg-grid-3 {
			margin-top: 0.78rem;
			display: grid;
			grid-template-columns: 1fr;
			gap: 0.58rem;
		}

		.rg-card {
			border: 1px solid #e0e9ff;
			border-radius: 13px;
			background: #fbfdff;
			padding: 0.75rem;
			text-align: center;
		}

		.rg-card-icon {
			width: 62px;
			height: 62px;
			border-radius: 50%;
			margin: 0 auto 0.7rem;
			background: linear-gradient(145deg, #4785ff 0%, #1d4ed8 52%, #1231a6 100%);
			box-shadow: 0 8px 22px rgba(18, 49, 166, 0.42);
			color: #ffffff;
			display: inline-flex;
			align-items: center;
			justify-content: center;
		}

		.rg-card h3 {
			margin: 0;
			font-size: 0.87rem;
			color: #16347f;
			font-weight: 800;
			line-height: 1.28;
		}

		.rg-card p {
			margin: 0.42rem 0 0;
			color: #506492;
			font-size: 0.79rem;
			line-height: 1.42;
		}

		.rg-line-note {
			margin-top: 0.7rem;
			border-radius: 999px;
			border: 1px solid #d6e4ff;
			background: #f3f8ff;
			color: #1d448f;
			font-size: 0.8rem;
			font-weight: 700;
			text-align: center;
			padding: 0.55rem 0.65rem;
		}

		.rg-steps {
			margin-top: 0.72rem;
			display: grid;
			grid-template-columns: 1fr;
			gap: 0.52rem;
		}

		.rg-step {
			border: 1px solid #dee8ff;
			border-radius: 12px;
			background: #fcfdff;
			padding: 0.72rem;
			text-align: left;
			display: grid;
			grid-template-columns: 32px 1fr;
			gap: 0.62rem;
			align-items: start;
		}

		.rg-step-num {
			width: 32px;
			height: 32px;
			border-radius: 99px;
			background: #225de8;
			color: #ffffff;
			font-size: 0.82rem;
			font-weight: 800;
			display: inline-flex;
			align-items: center;
			justify-content: center;
		}

		.rg-step h3 {
			margin: 0;
			color: #12367f;
			font-size: 0.84rem;
			font-weight: 800;
		}

		.rg-step p {
			margin: 0.28rem 0 0;
			color: #546998;
			font-size: 0.76rem;
			line-height: 1.4;
		}

		.rg-metrics {
			margin-top: 0.8rem;
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 0.52rem;
		}

		.rg-metric {
			border: 1px solid #dbe6ff;
			border-radius: 12px;
			background: #f9fbff;
			padding: 0.62rem;
		}

		.rg-metric h3 {
			margin: 0;
			color: #50638f;
			font-size: 0.68rem;
			font-weight: 700;
		}

		.rg-metric p {
			margin: 0.36rem 0 0;
			color: #14387f;
			font-size: 0.85rem;
			font-weight: 800;
		}

		.rg-compare {
			margin-top: 0.76rem;
			overflow-x: auto;
			border: 1px solid #dae5ff;
			border-radius: 12px;
		}

		.rg-compare table {
			width: 100%;
			min-width: 560px;
			border-collapse: collapse;
			font-size: 0.79rem;
		}

		.rg-compare th,
		.rg-compare td {
			border-bottom: 1px solid #e7efff;
			padding: 0.55rem 0.6rem;
			text-align: left;
		}

		.rg-compare th {
			color: #1b3e8f;
			background: #f3f7ff;
			font-weight: 800;
		}

		.rg-compare td:nth-child(2),
		.rg-compare td:nth-child(3),
		.rg-compare th:nth-child(2),
		.rg-compare th:nth-child(3) {
			text-align: center;
			width: 26%;
		}

		.rg-ok,
		.rg-no {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 20px;
			height: 20px;
			border-radius: 99px;
			font-size: 0.72rem;
			font-weight: 900;
		}

		.rg-ok {
			color: var(--rg-good);
			background: #e7faef;
		}

		.rg-no {
			color: var(--rg-bad);
			background: #fdecec;
		}

		.rg-pricing {
			margin-top: 0.92rem;
			border: 1px solid var(--rg-border);
			border-radius: 16px;
			background: var(--rg-panel);
			padding: 0.96rem;
			text-align: center;
		}

		.rg-price-grid {
			margin-top: 0.8rem;
			display: grid;
			grid-template-columns: 1fr;
			gap: 0.62rem;
			text-align: left;
		}

		.rg-price-card,
		.rg-price-list,
		.rg-price-action {
			border: 1px solid #dbe6ff;
			border-radius: 12px;
			background: #f9fbff;
			padding: 0.72rem;
		}

		.rg-price-card p {
			margin: 0;
			color: #5a6d98;
			font-size: 0.74rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			text-transform: uppercase;
		}

		.rg-price-card strong {
			display: block;
			margin-top: 0.2rem;
			font-size: 2.2rem;
			line-height: 1;
			color: #1642a8;
			font-family: 'Outfit', 'Manrope', sans-serif;
		}

		.rg-price-card span {
			color: #66799f;
			font-size: 0.79rem;
		}

		.rg-price-list ul {
			margin: 0;
			padding: 0;
			list-style: none;
			display: grid;
			gap: 0.34rem;
		}

		.rg-price-list li {
			display: flex;
			align-items: center;
			gap: 0.45rem;
			color: #29457d;
			font-size: 0.8rem;
			font-weight: 600;
		}

		.rg-price-action {
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			gap: 0.5rem;
			text-align: center;
		}

		.rg-price-action p {
			margin: 0;
			color: #6478a0;
			font-size: 0.78rem;
		}

		.rg-testimonials,
		.rg-faq {
			margin-top: 0.92rem;
			border: 1px solid var(--rg-border);
			border-radius: 16px;
			background: var(--rg-panel);
			padding: 0.95rem;
		}

		.rg-quote {
			border: 1px solid #dfe9ff;
			border-radius: 12px;
			background: #fbfdff;
			padding: 0.76rem;
		}

		.rg-quote p {
			margin: 0;
			color: #243f76;
			font-size: 0.83rem;
			line-height: 1.45;
			font-weight: 600;
		}

		.rg-quote small {
			margin-top: 0.4rem;
			display: block;
			color: #6578a0;
			font-size: 0.74rem;
		}

		.rg-stars {
			color: #f59e0b;
			font-size: 0.9rem;
			letter-spacing: 0.05em;
			display: block;
			margin-bottom: 0.42rem;
		}

		.rg-faq-item {
			border: 1px solid #dce7ff;
			border-radius: 12px;
			background: #fcfdff;
			padding: 0.08rem 0.65rem;
		}

		.rg-faq-item + .rg-faq-item {
			margin-top: 0.45rem;
		}

		.rg-faq summary {
			list-style: none;
			cursor: pointer;
			padding: 0.7rem 0;
			color: #1a3b84;
			font-size: 0.83rem;
			font-weight: 700;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 0.5rem;
		}

		.rg-faq summary::-webkit-details-marker {
			display: none;
		}

		.rg-faq summary svg {
			flex-shrink: 0;
			transition: transform 0.2s ease;
		}

		.rg-faq details[open] summary svg {
			transform: rotate(180deg);
		}

		.rg-faq details p {
			margin: 0 0 0.72rem;
			color: #5a6d98;
			font-size: 0.78rem;
			line-height: 1.46;
		}

		.rg-bottom-cta {
			margin: 0.92rem 0 1.2rem;
			border: 1px solid rgba(130, 164, 255, 0.42);
			border-radius: 18px;
			background: linear-gradient(115deg, #071b52 0%, #0d2c80 48%, #1645b8 100%);
			color: #ffffff;
			padding: 1rem;
			position: relative;
			overflow: hidden;
		}

		.rg-bottom-cta::after {
			content: "";
			position: absolute;
			width: 180px;
			height: 180px;
			border-radius: 999px;
			right: -90px;
			bottom: -110px;
			border: 1px solid rgba(188, 213, 255, 0.34);
		}

		.rg-bottom-cta h2 {
			margin: 0;
			font-family: 'Outfit', 'Manrope', sans-serif;
			font-size: 1.45rem;
			line-height: 1.2;
			max-width: 15ch;
		}

		.rg-bottom-cta p {
			margin: 0.62rem 0 0;
			color: #d9e7ff;
			font-size: 0.86rem;
		}

		.rg-bottom-cta .rg-primary-cta {
			display: inline-block;
			margin-top: 0.75rem;
			min-width: 180px;
		}

		.rg-cta-right {
			display: flex;
			flex-direction: column;
			align-items: flex-start;
			gap: 0.3rem;
		}

		.rg-cta-trust {
			margin: 0;
			color: rgba(217, 231, 255, 0.8);
			font-size: 0.76rem;
		}

		.rg-footer {
			border-top: 1px solid #d6e3ff;
			padding: 1.4rem 0 0;
			color: #6378a4;
			font-size: 0.74rem;
			background: #f8fbff;
		}

		.rg-footer-main {
			display: grid;
			grid-template-columns: 1fr;
			gap: 1.4rem;
			padding-bottom: 1.2rem;
		}

		.rg-footer-brand {
			display: flex;
			flex-direction: column;
			gap: 0.4rem;
		}

		.rg-footer-brand-name {
			display: inline-flex;
			align-items: center;
			gap: 0.42rem;
			color: #0f2e80;
			font-weight: 800;
			font-size: 0.96rem;
			text-decoration: none;
		}

		.rg-footer-brand-name .rg-logo {
			width: 24px;
			height: 24px;
		}

		.rg-footer-brand p {
			margin: 0.22rem 0 0;
			color: #6378a4;
			font-size: 0.74rem;
			line-height: 1.55;
			max-width: 26ch;
		}

		.rg-footer-cols {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 1rem 1.2rem;
		}

		.rg-footer-col h4 {
			margin: 0 0 0.5rem;
			color: #0f2e80;
			font-size: 0.69rem;
			font-weight: 800;
			letter-spacing: 0.08em;
			text-transform: uppercase;
		}

		.rg-footer-col ul {
			margin: 0;
			padding: 0;
			list-style: none;
			display: grid;
			gap: 0.3rem;
		}

		.rg-footer-col li a {
			color: #506492;
			text-decoration: none;
			font-size: 0.76rem;
			font-weight: 600;
			transition: color 0.2s;
		}

		.rg-footer-col li a:hover {
			color: #1642a8;
		}

		.rg-footer-bottom {
			border-top: 1px solid #dde8ff;
			padding: 0.7rem 0 1rem;
			display: flex;
			align-items: center;
			justify-content: space-between;
			flex-wrap: wrap;
			gap: 0.5rem;
		}

		.rg-footer-social {
			display: flex;
			align-items: center;
			gap: 0.42rem;
		}

		.rg-footer-social a {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 28px;
			height: 28px;
			border-radius: 7px;
			background: #edf3ff;
			color: #4d6394;
			text-decoration: none;
			transition: background 0.2s, color 0.2s;
		}

		.rg-footer-social a:hover {
			background: #1642a8;
			color: #ffffff;
		}

		@media (min-width: 680px) {
			.rg-hero-cta {
				grid-template-columns: auto auto;
				justify-content: start;
			}

			.rg-logos {
				grid-template-columns: repeat(6, minmax(0, 1fr));
			}

			.rg-grid-4,
			.rg-grid-3 {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}

			.rg-grid-6 {
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}

			.rg-steps {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}

			.rg-price-grid {
				grid-template-columns: 0.92fr 1.12fr;
			}

			.rg-price-action {
				grid-column: span 2;
			}

			.rg-metrics {
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}

			.rg-footer-cols {
				grid-template-columns: repeat(4, 1fr);
			}
		}

		@media (min-width: 900px) {
			.rg-links {
				display: inline-flex;
			}

			.rg-btn {
				padding-inline: 0.96rem;
			}

			.rg-hero {
				padding-top: 1.25rem;
			}

			.rg-hero-grid {
				grid-template-columns: 1fr 1.06fr;
				align-items: stretch;
			}

			.rg-panel {
				padding: 1.25rem;
			}

			.rg-hero h1 {
				font-size: clamp(2.05rem, 3vw, 2.75rem);
			}

			.rg-section h2,
			.rg-pricing h2,
			.rg-testimonials h2,
			.rg-faq h2 {
				font-size: 1.6rem;
			}

			.rg-grid-4 {
				grid-template-columns: repeat(4, minmax(0, 1fr));
			}

			.rg-grid-3 {
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}

			.rg-steps {
				grid-template-columns: repeat(4, minmax(0, 1fr));
			}

			.rg-metrics {
				grid-template-columns: repeat(5, minmax(0, 1fr));
			}

			.rg-footer-main {
				grid-template-columns: 1.1fr 2fr;
				align-items: start;
			}

			.rg-price-grid {
				grid-template-columns: 0.85fr 1fr 0.9fr;
				align-items: stretch;
			}

			.rg-price-action {
				grid-column: auto;
			}

			.rg-bottom-cta {
				display: flex;
				align-items: center;
				justify-content: space-between;
				gap: 1rem;
				padding: 1.3rem;
			}

			.rg-bottom-cta .rg-primary-cta {
				margin-top: 0;
			}
		}
	</style>
@endsection

@section('content')
	<main class="reengage-page">
		<header class="rg-topbar">
			<div class="rg-shell rg-nav">
				<a class="rg-brand" href="{{ url('/') }}">
					<span class="rg-logo" aria-hidden="true">
						<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6 8h12M6 12h9M6 16h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
						</svg>
					</span>
					<span>TSScout</span>
				</a>

				<nav class="rg-links" aria-label="Primary">
					<a href="#features">Features</a>
					<a href="#how-it-works">How It Works</a>
					<a href="#pricing">Pricing</a>
					<a href="#faq">Resources</a>
				</nav>

				<div class="rg-actions">
					<a class="rg-btn rg-btn-outline" href="https://app.tsscout.com/login" rel="noopener">Log In</a>
					<a class="rg-btn rg-btn-primary" href="https://app.tsscout.com/pricing" rel="noopener">Start $1 Trial</a>
				</div>
			</div>
		</header>

		<section class="rg-hero">
			<div class="rg-shell rg-panel">
				<div class="rg-hero-grid">
					<div>
						<p class="rg-pill">All in one product research platform</p>
						<h1>Find Winning <span>Products</span> Before Your Competitors</h1>
						<p>Analyze eBay, Shopify, Walmart and TikTok Shop data to discover trending products, track competitors, compare supplier prices, and build better listings faster.</p>

						<ul class="rg-list" aria-label="Key benefits">
							<li>
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#dff0ff"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1d5ce5" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Discover trending product niches
							</li>
							<li>
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#dff0ff"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1d5ce5" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Track competitors in real time
							</li>
							<li>
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#dff0ff"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1d5ce5" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Compare eBay and AliExpress prices
							</li>
							<li>
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#dff0ff"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1d5ce5" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Find trusted suppliers instantly
							</li>
							<li>
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#dff0ff"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1d5ce5" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg>
								Generate optimized product titles
							</li>
						</ul>

						<div class="rg-hero-cta">
							<a class="rg-primary-cta" href="https://app.tsscout.com/pricing" rel="noopener">Start Your $1 Trial</a>
							<a class="rg-ghost-cta" href="https://tsscout.com" rel="noopener">
								<svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><circle cx="12" cy="12" r="11" stroke="#1e4bb8" stroke-width="1.8"/><path d="M10 8.6 16 12l-6 3.4V8.6Z" fill="#1e4bb8"/></svg>
								<span>Watch Demo</span>
							</a>
						</div>

						<p class="rg-trustline">
							<span>No commitment</span>
							<span aria-hidden="true">•</span>
							<span>Cancel anytime</span>
							<span aria-hidden="true">•</span>
							<span>Full premium access</span>
						</p>
					</div>

					<div class="rg-dashboard" aria-label="Dashboard preview">
						<span class="rg-dashboard-chip">Dashboard Preview</span>
						<img class="rg-dashboard-image" src="{{ asset('images/landing/reengage/dashboard.jpg') }}" alt="TSScout dashboard preview" loading="eager" decoding="async" fetchpriority="high">
						<span class="rg-dashboard-crop">Live metrics</span>
					</div>
				</div>
			</div>

			<div class="rg-shell rg-logo-strip">
				<p>Trusted By eCommerce Sellers Worldwide</p>
				<div class="rg-logos" aria-label="Marketplace logos">
					<span class="rg-logo-item"><img class="rg-logo-amazon" src="{{ asset('images/Registration/amazon.svg') }}" alt="Amazon logo" loading="lazy" decoding="async"></span>
					<span class="rg-logo-item"><img class="rg-logo-ebay" src="{{ asset('images/ebay.jpg') }}" alt="eBay logo" loading="lazy" decoding="async"></span>
					<span class="rg-logo-item"><img class="rg-logo-shopify" src="{{ asset('images/shopify.jpg') }}" alt="Shopify logo" loading="lazy" decoding="async"></span>
					<span class="rg-logo-item"><img class="rg-logo-tiktok" src="{{ asset('images/tiktok_shop_logo.png') }}" alt="TikTok Shop logo" loading="lazy" decoding="async"></span>
					<span class="rg-logo-item"><img class="rg-logo-aliexpress" src="{{ asset('images/aliexpress-logo.jpg') }}" alt="AliExpress logo" loading="lazy" decoding="async"></span>
					<span class="rg-logo-item"><img class="rg-logo-walmart" src="{{ asset('images/walmart.jpg') }}" alt="Walmart logo" loading="lazy" decoding="async"></span>
				</div>
			</div>
		</section>

		<section id="features" class="rg-shell rg-section" aria-label="Challenges and research tools">
			<h2>Why Most Sellers Lose Money</h2>
			<div class="rg-grid-4">
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Person + magnifying glass: searching a saturated market -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9" cy="6" r="3.5"/>
							<path d="M1.5 20c0-4.14 3.36-7.5 7.5-7.5"/>
							<circle cx="17.5" cy="16.5" r="3.5"/>
							<line x1="20" y1="19" x2="22.5" y2="21.5"/>
						</svg>
					</span>
					<h3>Choosing saturated products</h3>
					<p>Most sellers enter crowded markets too late.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Table with full-width header + 3-column cell rows below -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<rect x="2" y="3" width="20" height="18" rx="2"/>
							<path d="M2 9h20"/>
							<path d="M2 15h20"/>
							<path d="M9 9v12"/>
							<path d="M16 9v12"/>
						</svg>
					</span>
					<h3>Running stores without real data</h3>
					<p>Guessing products leads to wasted time and poor sales.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Eye: copying / watching competitors blindly -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
							<circle cx="12" cy="12" r="3"/>
						</svg>
					</span>
					<h3>Copying competitors blindly</h3>
					<p>Without competitor insight, sellers stay behind.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Clock: hours wasted finding suppliers -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<circle cx="12" cy="12" r="10"/>
							<polyline points="12 6 12 12 16 14"/>
							<line x1="12" y1="2" x2="12" y2="3"/>
							<line x1="12" y1="21" x2="12" y2="22"/>
							<line x1="2" y1="12" x2="3" y2="12"/>
							<line x1="21" y1="12" x2="22" y2="12"/>
						</svg>
					</span>
					<h3>Spending hours finding suppliers</h3>
					<p>Manual supplier research wastes valuable time.</p>
				</article>
			</div>
			<p class="rg-line-note">Smart sellers use data, not guesswork.</p>

			<h2 style="margin-top: 1rem;" aria-label="Research capabilities">Everything You Need To Research Winning Products</h2>
			<div class="rg-grid-6">
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Product Research: magnifying glass over product box -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<circle cx="11" cy="11" r="7"/>
							<line x1="21" y1="21" x2="16.65" y2="16.65"/>
							<path d="M8 11h6M11 8v6"/>
						</svg>
					</span>
					<h3>Product Research</h3>
					<p>Analyze best-selling products by category, timeframe, and sales history.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Competitor Analysis: bar chart with trend arrow -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<line x1="18" y1="20" x2="18" y2="10"/>
							<line x1="12" y1="20" x2="12" y2="4"/>
							<line x1="6" y1="20" x2="6" y2="14"/>
							<line x1="2" y1="20" x2="22" y2="20"/>
							<polyline points="4 9 8 5 12 9 16 5 20 5"/>
							<polyline points="17 5 20 5 20 8"/>
						</svg>
					</span>
					<h3>Competitor Analysis</h3>
					<p>Track seller performance, ratings, history, and product activity.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Supplier Finder: chain link -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
							<path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
						</svg>
					</span>
					<h3>Supplier Finder</h3>
					<p>Compare eBay listings with AliExpress supplier prices.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- TikTok Trend Scanner: flame icon -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>
						</svg>
					</span>
					<h3>TikTok Trend Scanner</h3>
					<p>Discover trending TikTok Shop products before they become saturated.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- Shopify Store Analysis: storefront / shopping bag -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
							<line x1="3" y1="6" x2="21" y2="6"/>
							<path d="M16 10a4 4 0 0 1-8 0"/>
						</svg>
					</span>
					<h3>Shopify Store Analysis</h3>
					<p>Analyze Shopify stores and spot under-performing product lists.</p>
				</article>
				<article class="rg-card">
					<span class="rg-card-icon" aria-hidden="true">
						<!-- SmartTitles: document with AI sparkle -->
						<svg class="rg-card-icon-img" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
							<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
							<polyline points="14 2 14 8 20 8"/>
							<line x1="8" y1="13" x2="14" y2="13"/>
							<line x1="8" y1="17" x2="12" y2="17"/>
							<path d="M18 13l.67 1.33L20 15l-1.33.67L18 17l-.67-1.33L16 15l1.33-.67L18 13z"/>
						</svg>
					</span>
					<h3>SmartTitles</h3>
					<p>Generate optimized listing titles to improve visibility and clicks.</p>
				</article>
			</div>
		</section>

		<section id="how-it-works" class="rg-shell rg-section" aria-label="How TSScout works">
			<h2>How TSScout Works</h2>
			<div class="rg-steps">
				<article class="rg-step">
					<span class="rg-step-num">1</span>
					<div>
						<h3>Choose category or keyword</h3>
						<p>Start your research with any product or niche.</p>
					</div>
				</article>
				<article class="rg-step">
					<span class="rg-step-num">2</span>
					<div>
						<h3>Analyze best-selling products</h3>
						<p>See sales data, seller rating, and competitor performance.</p>
					</div>
				</article>
				<article class="rg-step">
					<span class="rg-step-num">3</span>
					<div>
						<h3>Compare supplier prices</h3>
						<p>Find the same products on AliExpress and compare costs.</p>
					</div>
				</article>
				<article class="rg-step">
					<span class="rg-step-num">4</span>
					<div>
						<h3>Launch products with real data</h3>
						<p>Make smarter decisions and increase your profits.</p>
					</div>
				</article>
			</div>

			<h2 style="margin-top: 0.96rem;">What You Can Analyze With TSScout</h2>
			<div class="rg-metrics" aria-label="Metric highlights">
				<article class="rg-metric"><h3>Sales Count</h3><p>8,210</p></article>
				<article class="rg-metric"><h3>Last Sold Date</h3><p>2 hours ago</p></article>
				<article class="rg-metric"><h3>Seller Name</h3><p>bestshop.store</p></article>
				<article class="rg-metric"><h3>Product Rating</h3><p>4.8 / 5</p></article>
				<article class="rg-metric"><h3>Estimated Demand</h3><p>High</p></article>
				<article class="rg-metric"><h3>Supplier Price</h3><p>$8.45</p></article>
				<article class="rg-metric"><h3>Profit Opportunity</h3><p>$15.55</p></article>
				<article class="rg-metric"><h3>Competitor Activity</h3><p>Active</p></article>
				<article class="rg-metric"><h3>Trending Score</h3><p>92 / 100</p></article>
			</div>
			<p class="rg-line-note">Stop guessing. Start selling with real market data.</p>
		</section>

		<section class="rg-shell rg-section" aria-label="Feature comparison">
			<h2>Why Sellers Choose TSScout</h2>
			<div class="rg-compare" role="region" aria-label="Comparison table" tabindex="0">
				<table>
					<thead>
						<tr>
							<th>Feature</th>
							<th>TSScout</th>
							<th>Other Tools</th>
						</tr>
					</thead>
					<tbody>
						<tr><td>Multi-platform research</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
						<tr><td>Competitor analysis</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
						<tr><td>Supplier comparison (eBay vs AliExpress)</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
						<tr><td>TikTok trend scanner</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
						<tr><td>Shopify store insights</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
						<tr><td>Smart title generation</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
						<tr><td>$1 trial</td><td><span class="rg-ok">✓</span></td><td><span class="rg-no">✕</span></td></tr>
					</tbody>
				</table>
			</div>
		</section>

		<section id="pricing" class="rg-shell rg-pricing" aria-label="Pricing">
			<h2>Start Today For Only $1</h2>
			<div class="rg-price-grid">
				<article class="rg-price-card">
					<p>Premium Plan</p>
					<strong>$1</strong>
					<span>trial. Then continues at regular premium pricing.</span>
				</article>

				<article class="rg-price-list">
					<ul>
						<li><svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#e7f9ef"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1aa963" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg> Full access to all premium tools</li>
						<li><svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#e7f9ef"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1aa963" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg> Product research and competitor analysis</li>
						<li><svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#e7f9ef"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1aa963" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg> TikTok trend scanner and Shopify insights</li>
						<li><svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="11" fill="#e7f9ef"/><path d="m7 12.1 3.2 3.2L17 8.5" stroke="#1aa963" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/></svg> SmartTitles and priority support</li>
					</ul>
				</article>

				<article class="rg-price-action">
					<a class="rg-primary-cta" href="https://app.tsscout.com/pricing" rel="noopener">Start My $1 Trial</a>
					<p>Cancel anytime • No hidden fees</p>
				</article>
			</div>
		</section>

		<section class="rg-shell rg-testimonials" aria-label="Seller testimonials">
			<h2>What Sellers Are Saying</h2>
			<div class="rg-grid-3">
				<article class="rg-quote">
					<span class="rg-stars" aria-label="5 out of 5 stars">★★★★★</span>
					<p>TSScout helped me find my first winning product in less than a week.</p>
					<small>Sarah M. • eBay Seller</small>
				</article>
				<article class="rg-quote">
					<span class="rg-stars" aria-label="5 out of 5 stars">★★★★★</span>
					<p>This tool saved me hours of product research every week.</p>
					<small>James R. • Shopify Store Owner</small>
				</article>
				<article class="rg-quote">
					<span class="rg-stars" aria-label="5 out of 5 stars">★★★★★</span>
					<p>Competitor tracking alone makes TSScout worth it.</p>
					<small>Emily T. • Amazon Seller</small>
				</article>
			</div>
		</section>

		<section id="faq" class="rg-shell rg-faq" aria-label="Frequently asked questions">
			<h2>Frequently Asked Questions</h2>
			<div style="margin-top: 0.72rem;">
				<details class="rg-faq-item" open>
					<summary>
						How does the $1 trial work?
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m6 9 6 6 6-6" stroke="#1c3e8f" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</summary>
					<p>You get full premium access for $1 during the trial period. After that, your plan continues at regular pricing unless canceled.</p>
				</details>

				<details class="rg-faq-item">
					<summary>
						Can I cancel anytime?
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m6 9 6 6 6-6" stroke="#1c3e8f" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</summary>
					<p>Yes. You can cancel from your account dashboard at any time, and there are no hidden cancellation fees.</p>
				</details>

				<details class="rg-faq-item">
					<summary>
						Which marketplaces does TSScout support?
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m6 9 6 6 6-6" stroke="#1c3e8f" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</summary>
					<p>TSScout covers eBay, Shopify, TikTok Shop, Walmart, and supplier-side checks with AliExpress data.</p>
				</details>

				<details class="rg-faq-item">
					<summary>
						Is TSScout beginner-friendly?
						<svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m6 9 6 6 6-6" stroke="#1c3e8f" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</summary>
					<p>Yes. The workflow is designed for both beginners and experienced sellers, with clear metrics and guided research steps.</p>
				</details>
			</div>
		</section>

		<section class="rg-shell rg-bottom-cta" aria-label="Final call to action">
			<div>
				<h2>Ready To Find Your Next Winning Product?</h2>
				<p>Stop guessing. Start selling with real market data.</p>
			</div>
			<div class="rg-cta-right">
				<a class="rg-primary-cta" href="https://app.tsscout.com/pricing" rel="noopener">Start Your $1 Trial</a>
				<p class="rg-cta-trust">Full premium access • Cancel anytime</p>
			</div>
		</section>

		<footer class="rg-footer">
			<div class="rg-shell rg-footer-main">
				<div class="rg-footer-brand">
					<a class="rg-footer-brand-name" href="{{ url('/') }}">
						<span class="rg-logo" aria-hidden="true">
							<svg viewBox="0 0 24 24" width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 8h12M6 12h9M6 16h6" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
						</span>
						TSScout
					</a>
					<p>Product &amp; competitor research platform for eCommerce sellers.</p>
				</div>
				<div class="rg-footer-cols">
					<div class="rg-footer-col">
						<h4>Product</h4>
						<ul>
							<li><a href="https://app.tsscout.com" rel="noopener">Product Research</a></li>
							<li><a href="https://app.tsscout.com" rel="noopener">Competitor Analysis</a></li>
							<li><a href="https://app.tsscout.com" rel="noopener">Supplier Finder</a></li>
							<li><a href="https://app.tsscout.com" rel="noopener">TikTok Trends</a></li>
							<li><a href="https://app.tsscout.com" rel="noopener">SmartTitles</a></li>
						</ul>
					</div>
					<div class="rg-footer-col">
						<h4>Company</h4>
						<ul>
							<li><a href="https://tsscout.com/about" rel="noopener">About Us</a></li>
							<li><a href="{{ url('/blog') }}">Blog</a></li>
							<li><a href="https://tsscout.com/contact" rel="noopener">Contact</a></li>
						</ul>
					</div>
					<div class="rg-footer-col">
						<h4>Resources</h4>
						<ul>
							<li><a href="https://tsscout.com/help" rel="noopener">Help Center</a></li>
							<li><a href="https://tsscout.com/guides" rel="noopener">Guides</a></li>
							<li><a href="https://tsscout.com/api" rel="noopener">API</a></li>
						</ul>
					</div>
					<div class="rg-footer-col">
						<h4>Legal</h4>
						<ul>
							<li><a href="https://tsscout.com/terms" rel="noopener">Terms of Service</a></li>
							<li><a href="https://tsscout.com/privacy" rel="noopener">Privacy Policy</a></li>
							<li><a href="https://tsscout.com/refund" rel="noopener">Refund Policy</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="rg-shell rg-footer-bottom">
				<div>© {{ date('Y') }} TSScout. All rights reserved.</div>
				<nav class="rg-footer-social" aria-label="Social media">
					<a href="https://facebook.com" rel="noopener noreferrer" aria-label="Facebook">
						<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
					</a>
					<a href="https://twitter.com" rel="noopener noreferrer" aria-label="Twitter / X">
						<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
					</a>
					<a href="https://youtube.com" rel="noopener noreferrer" aria-label="YouTube">
						<svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42 29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58zM9.75 15.02V8.98L15.5 12z"/></svg>
					</a>
					<a href="https://instagram.com" rel="noopener noreferrer" aria-label="Instagram">
						<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
					</a>
				</nav>
			</div>
		</footer>
	</main>
@endsection
