@extends('layouts.landing')

@section('title', isset($page) ? $page->title : 'TSSCOUT')
@section('meta_description', isset($page) ? $page->meta_description : 'You checked out TSSCOUT before - here is what is new.')
@section('meta_keywords', isset($page) ? $page->meta_keywords : 'TSSCOUT, product research, track competitors, spot trends')
@section('meta_author', isset($page) ? $page->meta_author : 'TSSCOUT')

@section('og_title', isset($page) ? $page->title : 'TSSCOUT')
@section('og_description', isset($page) ? $page->meta_description : 'You checked out TSSCOUT before - here is what is new.')
@section('og_image', asset('images/logo.svg'))

@section('styles')
	<link rel="preload" as="image" href="{{ asset('images/landing/home/icon-cart.svg') }}" type="image/svg+xml">
	<link rel="preload" as="image" href="{{ asset('images/landing/home/feature-search.svg') }}" type="image/svg+xml">
	<style>
		:root {
			--home-blue: #2f57f6;
			--home-blue-dark: #0f1f4c;
			--home-text: #1d2a4f;
			--home-muted: #5e6b8a;
			--home-bg: #f6f9ff;
			--home-border: #dfe8f6;
			--home-green: #35b64b;
			--home-panel: #ffffff;
			--home-shadow: 0 14px 40px rgba(24, 41, 93, 0.08);
		}

		.return-home {
			background:
				radial-gradient(120px 120px at 8% 84%, #e9f1ff 0, rgba(233, 241, 255, 0) 72%),
				radial-gradient(180px 180px at 92% 66%, #ebf2ff 0, rgba(235, 242, 255, 0) 78%),
				linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
			color: var(--home-text);
			font-family: "Poppins", "Segoe UI", Tahoma, sans-serif;
			padding-bottom: 2.5rem;
			overflow: hidden;
		}

		@keyframes fadeSlideUp {
			from {
				opacity: 0;
				transform: translateY(14px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		@keyframes floatSoft {
			0%,
			100% {
				transform: translateY(0);
			}

			50% {
				transform: translateY(-5px);
			}
		}

		.home-shell {
			width: min(1120px, calc(100% - 2rem));
			margin: 0 auto;
		}

		.hero {
			padding: 2rem 0 1.6rem;
			position: relative;
		}

		.hero-grid > div {
			opacity: 0;
			animation: fadeSlideUp 0.6s ease forwards;
		}

		.hero-grid > div:nth-child(2) {
			animation-delay: 0.12s;
		}

		.hero::after {
			content: "";
			position: absolute;
			right: 0.2rem;
			top: 0.2rem;
			width: 70px;
			height: 70px;
			background-image: radial-gradient(circle, #7aa0ff 1.4px, transparent 1.4px);
			background-size: 11px 11px;
			opacity: 0.55;
			pointer-events: none;
		}

		.welcome-pill {
			display: inline-flex;
			align-items: center;
			gap: 0.35rem;
			border-radius: 999px;
			background: #e9f0ff;
			color: var(--home-blue);
			font-size: 0.77rem;
			font-weight: 700;
			padding: 0.35rem 0.7rem;
			letter-spacing: 0.02em;
		}

		.hero h1 {
			color: var(--home-blue-dark);
			font-size: 2rem;
			line-height: 1.12;
			margin: 1rem 0 0;
			max-width: 22ch;
			font-weight: 700;
		}

		.hero-copy {
			color: #42557e;
			font-size: 1rem;
			line-height: 1.72;
			max-width: 36ch;
			margin: 1rem 0 0;
		}

		.cta-button {
			margin-top: 1.35rem;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 0.9rem;
			border: 0;
			border-radius: 12px;
			background: linear-gradient(94deg, #3b69ff 0%, #2144ea 100%);
			color: #ffffff;
			font-size: 1.15rem;
			font-weight: 600;
			line-height: 1;
			text-decoration: none;
			padding: 1rem 1.3rem;
			box-shadow: 0 12px 24px rgba(47, 87, 246, 0.26);
			transition: transform 0.2s ease, box-shadow 0.2s ease;
		}

		.cta-button:hover {
			transform: translateY(-2px);
			box-shadow: 0 16px 28px rgba(47, 87, 246, 0.32);
		}

		.cta-button-icon {
			width: 30px;
			height: 30px;
			border-radius: 999px;
			background: #ffffff;
			color: var(--home-blue);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-size: 1rem;
			font-weight: 700;
		}

		.sub-note {
			margin-top: 1rem;
			display: inline-flex;
			align-items: center;
			gap: 0.4rem;
			color: #5f6f90;
			font-size: 0.97rem;
		}

		.sub-note img {
			width: 18px;
			height: 18px;
			display: block;
		}

		.dashboard {
			margin-top: 1.8rem;
			background: var(--home-panel);
			border: 1px solid #e4edf9;
			border-radius: 16px;
			box-shadow: var(--home-shadow);
			padding: 1rem;
			transition: transform 0.25s ease, box-shadow 0.25s ease;
		}

		.dashboard:hover {
			transform: translateY(-2px);
			box-shadow: 0 18px 44px rgba(24, 41, 93, 0.13);
		}

		.dash-head {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 0.7rem;
			margin-bottom: 0.85rem;
		}

		.dash-title {
			margin: 0;
			font-size: 1.15rem;
			color: var(--home-blue-dark);
			font-weight: 700;
		}

		.dash-icons {
			display: flex;
			align-items: center;
			gap: 0.6rem;
			color: #2f57f6;
			font-weight: 700;
			font-size: 0.86rem;
		}

		.dash-icon-button {
			width: 26px;
			height: 26px;
			border: 1px solid #c8d7f4;
			border-radius: 8px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			color: #2648df;
			background: #f5f8ff;
			font-size: 0.72rem;
			line-height: 1;
		}

		.search-label {
			display: block;
			color: #415278;
			font-size: 0.8rem;
			font-weight: 600;
			margin-bottom: 0.4rem;
		}

		.search-row {
			display: flex;
			align-items: stretch;
			gap: 0.45rem;
			margin-bottom: 0.85rem;
		}

		.search-field {
			flex: 1;
			border-radius: 10px;
			border: 1px solid #e1e9f8;
			background: #f7f9ff;
			display: flex;
			align-items: center;
			gap: 0.45rem;
			padding: 0.58rem 0.58rem 0.58rem 0.65rem;
			color: #66799f;
			font-size: 0.89rem;
		}

		.search-field strong {
			color: #243762;
			font-size: 0.93rem;
			font-weight: 500;
		}

		.search-btn {
			border: 0;
			border-radius: 10px;
			background: #2d57f5;
			color: #ffffff;
			font-size: 0.93rem;
			font-weight: 600;
			padding: 0 0.95rem;
		}

		.stats-grid {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 0.6rem;
		}

		.stat-card {
			border: 1px solid #e5ecf8;
			border-radius: 12px;
			background: #ffffff;
			padding: 0.72rem;
			min-height: 112px;
			transition: transform 0.2s ease, box-shadow 0.2s ease;
		}

		.stat-card:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 22px rgba(20, 40, 94, 0.09);
		}

		.stat-card img {
			width: 22px;
			height: 22px;
			display: block;
			margin-bottom: 0.45rem;
		}

		.stat-label {
			color: #3f5278;
			font-size: 0.76rem;
			font-weight: 600;
			margin: 0;
			line-height: 1.25;
		}

		.stat-value {
			color: #122750;
			font-size: 1.16rem;
			line-height: 1.2;
			font-weight: 700;
			margin: 0.3rem 0 0;
		}

		.stat-change {
			color: var(--home-green);
			font-size: 0.76rem;
			font-weight: 600;
			margin: 0.25rem 0 0;
		}

		.features {
			margin-top: 2.25rem;
			padding: 2.2rem 0;
			border-top: 1px solid #edf2fc;
		}

		.feature-pill {
			margin: 0 auto;
			width: fit-content;
			border-radius: 999px;
			background: #edf2ff;
			color: #2f57f6;
			font-size: 0.72rem;
			font-weight: 700;
			letter-spacing: 0.08em;
			padding: 0.38rem 0.8rem;
		}

		.features h2 {
			margin: 0.82rem 0 0;
			font-size: 2rem;
			line-height: 1.17;
			color: var(--home-blue-dark);
			text-align: center;
			font-weight: 700;
		}

		.feature-grid {
			margin-top: 1.25rem;
			display: grid;
			grid-template-columns: 1fr;
			gap: 0.85rem;
		}

		.feature-card {
			text-align: center;
			border: 1px solid #e5ecf8;
			border-radius: 16px;
			background: #ffffff;
			padding: 1.15rem 1rem 1.25rem;
			box-shadow: 0 7px 20px rgba(23, 41, 84, 0.05);
			transition: transform 0.25s ease, box-shadow 0.25s ease;
		}

		.feature-card:hover {
			transform: translateY(-3px);
			box-shadow: 0 13px 28px rgba(23, 41, 84, 0.11);
		}

		.feature-card img {
			width: 68px;
			height: 68px;
			display: block;
			margin: 0 auto 0.7rem;
			animation: floatSoft 3.2s ease-in-out infinite;
		}

		.feature-card:nth-child(2) img {
			animation-delay: 0.25s;
		}

		.feature-card:nth-child(3) img {
			animation-delay: 0.5s;
		}

		.feature-card h3 {
			margin: 0;
			color: var(--home-blue-dark);
			font-size: 1.67rem;
			line-height: 1.2;
			font-weight: 700;
		}

		.feature-card p {
			margin: 0.72rem 0 0;
			color: #42557e;
			font-size: 1.03rem;
			line-height: 1.55;
		}

		.bottom-cta {
			margin-top: 1.6rem;
			border: 1px solid #e3ebf8;
			border-radius: 20px;
			background:
				radial-gradient(145px 145px at 6% 8%, #e8efff 0, rgba(232, 239, 255, 0) 72%),
				radial-gradient(180px 180px at 94% 92%, #e9f1ff 0, rgba(233, 241, 255, 0) 78%),
				#f8fbff;
			padding: 1.9rem 1rem;
			text-align: center;
			position: relative;
			overflow: hidden;
			opacity: 0;
			animation: fadeSlideUp 0.65s ease 0.16s forwards;
		}

		@media (prefers-reduced-motion: reduce) {
			.hero-grid > div,
			.bottom-cta,
			.feature-card img {
				animation: none;
				opacity: 1;
			}

			.cta-button,
			.dashboard,
			.stat-card,
			.feature-card {
				transition: none;
			}
		}

		.bottom-cta::after {
			content: "";
			position: absolute;
			left: 1rem;
			bottom: 1rem;
			width: 58px;
			height: 58px;
			background-image: radial-gradient(circle, #7aa0ff 1.3px, transparent 1.3px);
			background-size: 11px 11px;
			opacity: 0.5;
			pointer-events: none;
		}

		.bottom-cta h2 {
			margin: 0;
			color: var(--home-blue-dark);
			font-size: 2rem;
			line-height: 1.15;
			font-weight: 700;
		}

		.bottom-cta p {
			margin: 0.7rem 0 0;
			color: #405582;
			font-size: 1.04rem;
		}

		.bottom-cta .cta-button {
			margin-top: 1.2rem;
		}

		.bottom-cta .sub-note {
			margin-top: 0.9rem;
		}

		@media (min-width: 768px) {
			.hero h1,
			.bottom-cta h2,
			.features h2 {
				font-size: clamp(2.2rem, 3.9vw, 3.2rem);
			}

			.stats-grid {
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}

			.feature-grid {
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 1rem;
			}
		}

		@media (min-width: 1024px) {
			.hero {
				padding-top: 2.7rem;
			}

			.hero-grid {
				display: grid;
				grid-template-columns: minmax(0, 1fr) minmax(0, 1.06fr);
				gap: 2.05rem;
				align-items: start;
			}

			.dashboard {
				margin-top: 0;
			}

			.bottom-cta {
				padding-top: 2.4rem;
				padding-bottom: 2.4rem;
			}
		}
	</style>
@endsection

@section('content')
	<main class="return-home">
		<section class="hero" aria-label="Welcome back">
			<div class="home-shell hero-grid">
				<div>
					<p class="welcome-pill">Welcome Back! 👋</p>
					<h1>You checked out TSSCOUT before — here’s what’s new.</h1>
					<p class="hero-copy">We’ve upgraded our tools and data to help you find winning products, track competitors, and spot trends faster than ever.</p>

					<a class="cta-button" href="https://app.tsscout.com" rel="noopener">
						<span>Take Another Look</span>
						<span class="cta-button-icon" aria-hidden="true">➜</span>
					</a>

					<p class="sub-note">
						<img src="{{ asset('images/landing/home/icon-shield.svg') }}" alt="Shield icon" width="18" height="18">
						<span>No commitment</span>
						<span aria-hidden="true">•</span>
						<span>Cancel anytime</span>
					</p>
				</div>

				<div class="dashboard" aria-label="Product Research dashboard preview">
					<div class="dash-head">
						<h2 class="dash-title">Product Research</h2>
						<div class="dash-icons">
							<span class="dash-icon-button" aria-hidden="true">▶</span>
							<span class="dash-icon-button" aria-hidden="true">👤</span>
							<span>Hi, User</span>
						</div>
					</div>

					<label class="search-label" for="previewProduct">Product Name</label>
					<div class="search-row">
						<div class="search-field">
							<span aria-hidden="true">⌕</span>
							<strong id="previewProduct">baby toys</strong>
							<span style="margin-inline-start: auto;" aria-hidden="true">☷</span>
						</div>
						<button class="search-btn" type="button" aria-label="Search">Search</button>
					</div>

					<div class="stats-grid">
						<article class="stat-card">
							<img src="{{ asset('images/landing/home/icon-cart.svg') }}" alt="Sell Through icon" width="22" height="22">
							<p class="stat-label">Sell Through</p>
							<p class="stat-value">1813.4%</p>
							<p class="stat-change">↑ 24.6%</p>
						</article>

						<article class="stat-card">
							<img src="{{ asset('images/landing/home/icon-list.svg') }}" alt="Listing icon" width="22" height="22">
							<p class="stat-label">Listing</p>
							<p class="stat-value">97</p>
							<p class="stat-change">↑ 12</p>
						</article>

						<article class="stat-card">
							<img src="{{ asset('images/landing/home/icon-tag.svg') }}" alt="Sold Item icon" width="22" height="22">
							<p class="stat-label">Sold Item</p>
							<p class="stat-value">1759</p>
							<p class="stat-change">↑ 156</p>
						</article>

						<article class="stat-card">
							<img src="{{ asset('images/landing/home/icon-dollar.svg') }}" alt="Sale Earning icon" width="22" height="22">
							<p class="stat-label">Sale Earning</p>
							<p class="stat-value">25,822.86</p>
							<p class="stat-change">↑ 18.3%</p>
						</article>

						<article class="stat-card">
							<img src="{{ asset('images/landing/home/icon-target.svg') }}" alt="Successful Listings icon" width="22" height="22">
							<p class="stat-label">Successful Listings</p>
							<p class="stat-value">1813.4%</p>
							<p class="stat-change">↑ 24.6%</p>
						</article>

						<article class="stat-card">
							<img src="{{ asset('images/landing/home/icon-bars.svg') }}" alt="Average Price icon" width="22" height="22">
							<p class="stat-label">Average Price</p>
							<p class="stat-value">14.59</p>
							<p class="stat-change">↑ 2.1%</p>
						</article>
					</div>
				</div>
			</div>
		</section>

		<section class="features" aria-label="Powerful features">
			<div class="home-shell">
				<p class="feature-pill">POWERFUL FEATURES</p>
				<h2>Everything you need to stay ahead</h2>

				<div class="feature-grid">
					<article class="feature-card">
						<img src="{{ asset('images/landing/home/feature-search.svg') }}" alt="Find Winning Products" width="96" height="96" loading="lazy">
						<h3>Find Winning Products</h3>
						<p>Discover high-potential products faster with powerful research tools.</p>
					</article>

					<article class="feature-card">
						<img src="{{ asset('images/landing/home/feature-bars.svg') }}" alt="Track Competitors" width="96" height="96" loading="lazy">
						<h3>Track Competitors</h3>
						<p>Analyze competitors and their strategies in real time to stay ahead.</p>
					</article>

					<article class="feature-card">
						<img src="{{ asset('images/landing/home/feature-trend.svg') }}" alt="Spot Trends Faster" width="96" height="96" loading="lazy">
						<h3>Spot Trends Faster</h3>
						<p>Discover TikTok and marketplace trends early and act before others.</p>
					</article>
				</div>

				<div class="bottom-cta">
					<h2>Ready to Explore TSSCOUT Again?</h2>
					<p>Explore the updated platform.</p>

					<a class="cta-button" href="https://app.tsscout.com" rel="noopener">
						<span>Explore TSSCOUT</span>
						<span class="cta-button-icon" aria-hidden="true">➜</span>
					</a>

					<p class="sub-note">
						<img src="{{ asset('images/landing/home/icon-shield.svg') }}" alt="Shield icon" width="18" height="18" loading="lazy">
						<span>No commitment</span>
						<span aria-hidden="true">•</span>
						<span>Cancel anytime</span>
					</p>
				</div>
			</div>
		</section>
	</main>
@endsection
