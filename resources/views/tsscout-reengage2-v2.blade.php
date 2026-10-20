<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TSScout – Know What to Sell Before You Invest</title>
<meta name="description" content="Research products, competitors and suppliers across eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop from one dashboard. Start a 14-day Premium trial for $1.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<meta name="robots" content="noindex, nofollow">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!--
  TSScout /landing-pages/reengage2 — v2 (17 Oct 2026)
  Built from the audit + verified against app.tsscout.com/pricing and the Premium registration page.
  Tool names = exact names used on the pricing page and registration screen.
  Before publishing, confirm the open items listed in the hand-off notes (renewal price $79.98 vs $79.99, etc.).
  CTA links carry data-cta attributes for GTM click tracking.
  NOTE: this page lists 18 Premium tools (incl. Shopify find stores and CJ Dropshipping Scanner). app.tsscout.com/pricing and the
  registration screen currently show 16 and mark those two as not included. Update both before sending ad traffic.
-->
<style>
:root{
  --navy:#0A1A3A; --navy-2:#13285A; --ink:#0F172A; --muted:#55607A;
  --lime:#B8F23A; --lime-ink:#1B2A05; --blue:#2563EB; --blue-soft:#EAF1FF;
  --bg:#FFFFFF; --bg-2:#F5F7FB; --line:#E3E8F2; --radius:16px;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:"Plus Jakarta Sans",system-ui,-apple-system,Segoe UI,Roboto,sans-serif;color:var(--ink);background:var(--bg);line-height:1.6;-webkit-font-smoothing:antialiased}
img{max-width:100%;display:block}
a{color:inherit}
.wrap{max-width:1160px;margin:0 auto;padding:0 20px}
section{padding:88px 0}
.eyebrow{display:inline-block;font-size:13px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--blue);margin-bottom:12px}
h1,h2,h3,h4{line-height:1.15;letter-spacing:-.02em}
h2{font-size:clamp(28px,4vw,42px);font-weight:800;margin-bottom:14px}
.lead{font-size:18px;color:var(--muted);max-width:640px}
.center{text-align:center}.center .lead{margin:0 auto}

/* Buttons */
.btn{display:inline-flex;align-items:center;gap:10px;font-weight:700;font-size:17px;padding:16px 28px;border-radius:12px;text-decoration:none;transition:transform .15s,box-shadow .15s}
.btn-lime{background:var(--lime);color:var(--lime-ink);box-shadow:0 8px 24px rgba(184,242,58,.35)}
.btn-lime:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(184,242,58,.45)}
.terms{font-size:14px;color:var(--muted);margin-top:12px}
.terms strong{color:var(--ink)}

/* Nav */
header{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.94);backdrop-filter:blur(10px);border-bottom:1px solid var(--line)}
.nav{display:flex;align-items:center;justify-content:space-between;height:68px;gap:16px}
.nav img{height:34px;width:auto}
.nav-links{display:flex;gap:28px;font-weight:600;font-size:15px}
.nav-links a{text-decoration:none;color:var(--muted)}
.nav-links a:hover{color:var(--ink)}
.nav-right{display:flex;align-items:center;gap:16px}
.nav-right .login{font-weight:600;font-size:15px;text-decoration:none;color:var(--muted)}
.nav-right .btn{padding:10px 18px;font-size:15px}

/* Hero */
.hero{background:radial-gradient(1200px 500px at 80% -10%,#1E3A8A 0%,transparent 60%),var(--navy);color:#fff;padding:80px 0 96px}
.hero-grid{display:grid;grid-template-columns:1.05fr 1fr;gap:56px;align-items:center}
.hero .eyebrow{color:var(--lime)}
.hero h1{font-size:clamp(38px,5.6vw,62px);font-weight:800;margin-bottom:20px}
.hero h1 em{font-style:normal;color:var(--lime)}
.hero p.sub{font-size:19px;color:#C9D4EE;max-width:540px;margin-bottom:30px}
.offer-box{margin-top:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);border-radius:12px;padding:14px 16px;font-size:14px;color:#D5DEF3;max-width:520px}
.offer-box strong{color:#fff}
.returning{margin-top:14px;font-size:14px;color:#AEBBDA}
.returning a{color:var(--lime);font-weight:600}
.chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:28px}
.chip{font-size:13px;font-weight:600;padding:6px 12px;border-radius:999px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:#E4EAF8}
.shot{background:#fff;border-radius:var(--radius);padding:10px;box-shadow:0 30px 80px rgba(0,0,0,.4)}
.shot img{border-radius:10px}
.shot-cap{font-size:13px;color:#AEBBDA;margin-top:12px;text-align:center}
.vid{position:relative;aspect-ratio:16/9;border-radius:10px;overflow:hidden;cursor:pointer;background:#000}
.vid img{width:100%;height:100%;object-fit:cover}
.vid iframe{position:absolute;inset:0;width:100%;height:100%;border:0}
.play{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:76px;height:76px;border-radius:50%;background:var(--lime);color:var(--lime-ink);display:grid;place-items:center;box-shadow:0 10px 30px rgba(0,0,0,.4);transition:transform .15s}
.vid:hover .play{transform:translate(-50%,-50%) scale(1.08)}
.vid-badge{position:absolute;left:12px;bottom:12px;background:rgba(10,26,58,.88);color:#fff;font-size:13px;font-weight:600;padding:6px 12px;border-radius:999px}

/* How it works */
.how{background:var(--bg-2)}
.how-grid{display:grid;grid-template-columns:1.2fr 1fr;gap:48px;align-items:center;margin-top:44px}
.frame{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:10px;box-shadow:0 14px 40px rgba(15,23,42,.08)}
.frame img{border-radius:10px}
.steps{list-style:none;display:grid;gap:18px}
.steps li{display:grid;grid-template-columns:44px 1fr;gap:16px;background:#fff;border:1px solid var(--line);border-radius:14px;padding:20px}
.num{width:44px;height:44px;border-radius:12px;background:var(--navy);color:var(--lime);display:grid;place-items:center;font-weight:800;font-size:18px}
.steps h4{font-size:18px;margin-bottom:4px}
.steps p{color:var(--muted);font-size:15px}

/* Benefits */
.ben-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-top:44px}
.ben{border:1px solid var(--line);border-radius:var(--radius);padding:26px;background:#fff}
.ben .prob{font-size:13px;font-weight:700;color:#B4233A;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px}
.ben h3{font-size:19px;margin-bottom:8px}
.ben p{color:var(--muted);font-size:15px}

/* Proof */
.proof{background:var(--navy);color:#fff}
.proof-card{max-width:760px;margin:36px auto 0;background:var(--navy-2);border:1px solid rgba(255,255,255,.12);border-radius:20px;padding:36px}
.stars{color:#00B67A;font-size:22px;letter-spacing:3px}
.proof blockquote{font-size:21px;line-height:1.5;margin:16px 0 22px;color:#F0F4FF}
.who{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;font-size:14px;color:#AEBBDA}
.who strong{color:#fff}
.who a{color:var(--lime);font-weight:600}
.proof .lead{color:#C9D4EE}

/* Tools */
.tabs{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;margin:40px 0 28px}
.tab{font:inherit;font-weight:700;font-size:15px;padding:10px 18px;border-radius:999px;border:1px solid var(--line);background:#fff;color:var(--muted);cursor:pointer}
.tab span{font-weight:600;opacity:.7;margin-left:4px}
.tab[aria-selected="true"]{background:var(--navy);color:#fff;border-color:var(--navy)}
.panel{display:none}
.panel.active{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.tool{border:1px solid var(--line);border-radius:14px;padding:22px;background:#fff}
.tool .plat{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--blue)}
.tool h4{font-size:18px;margin:6px 0}
.tool p{font-size:15px;color:var(--muted)}
.tools-note{text-align:center;font-size:14px;color:var(--muted);margin-top:22px}

/* Per-platform data */
.data{background:var(--bg)}
.data-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:20px;margin-top:40px}
.data-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);overflow:hidden}
.data-card img{border-bottom:1px solid var(--line);aspect-ratio:16/10;object-fit:cover;object-position:top}
.data-card .body{padding:20px}
.data-card h4{font-size:18px;margin-bottom:8px}
.data-card ul{list-style:none;display:grid;gap:6px}
.data-card li{font-size:15px;color:var(--muted);padding-left:22px;position:relative}
.data-card li::before{content:"";position:absolute;left:0;top:8px;width:10px;height:10px;border-radius:3px;background:var(--lime);box-shadow:inset 0 0 0 2px #8BC21F}

/* Safe */
.safe{display:grid;grid-template-columns:auto 1fr;gap:24px;align-items:center;max-width:860px;margin:0 auto;border:1px solid var(--line);border-radius:20px;padding:32px;background:#fff}
.shield{width:64px;height:64px;border-radius:16px;background:var(--blue-soft);display:grid;place-items:center}
.safe h3{font-size:22px;margin-bottom:6px}
.safe p{color:var(--muted)}

/* Pricing */
.pricing{background:var(--bg-2)}
.price-card{max-width:620px;margin:40px auto 0;background:#fff;border:2px solid var(--navy);border-radius:22px;overflow:hidden;box-shadow:0 20px 60px rgba(10,26,58,.12)}
.price-head{background:var(--navy);color:#fff;padding:28px 32px}
.price-head .tag{display:inline-block;background:var(--lime);color:var(--lime-ink);font-size:12px;font-weight:800;padding:4px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:.05em}
.price-head h3{font-size:26px;margin:10px 0 4px}
.price-head p{color:#C9D4EE;font-size:15px}
.price-body{padding:28px 32px}
.big{font-size:52px;font-weight:800;letter-spacing:-.03em}
.big small{font-size:18px;font-weight:600;color:var(--muted);letter-spacing:0}
.schedule{list-style:none;margin:18px 0 24px;border:1px solid var(--line);border-radius:12px}
.schedule li{display:flex;justify-content:space-between;gap:12px;padding:12px 16px;font-size:15px;border-bottom:1px solid var(--line)}
.schedule li:last-child{border-bottom:0}
.schedule li span:first-child{color:var(--muted)}
.schedule li span:last-child{font-weight:700;text-align:right}
.price-card .btn{width:100%;justify-content:center}
.incl{margin-top:26px}
.incl h5{font-size:13px;text-transform:uppercase;letter-spacing:.06em;color:var(--blue);margin:14px 0 6px}
.incl p{font-size:14px;color:var(--muted)}
.other-plans{text-align:center;font-size:15px;color:var(--muted);margin-top:22px}
.other-plans a{color:var(--blue);font-weight:700}

/* FAQ */
.faq{max-width:800px;margin:40px auto 0}
details{border-bottom:1px solid var(--line);padding:20px 0}
summary{cursor:pointer;font-weight:700;font-size:18px;list-style:none;display:flex;justify-content:space-between;gap:16px}
summary::-webkit-details-marker{display:none}
summary::after{content:"+";font-size:24px;line-height:1;color:var(--blue)}
details[open] summary::after{content:"–"}
details p{color:var(--muted);margin-top:10px}
details a{color:var(--blue);font-weight:600}

/* Final CTA */
.final{background:radial-gradient(900px 400px at 50% 0%,#1E3A8A 0%,transparent 70%),var(--navy);color:#fff;text-align:center}
.final h2{font-size:clamp(30px,4.5vw,48px)}
.final .lead{color:#C9D4EE;margin:0 auto 30px}
.final .terms{color:#AEBBDA}.final .terms strong{color:#fff}

/* Footer */
footer{background:#061127;color:#AEBBDA;padding:56px 0 32px;font-size:14px}
.foot-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:32px}
footer img{height:32px;width:auto;margin-bottom:14px}
footer h6{color:#fff;font-size:14px;margin-bottom:12px}
footer ul{list-style:none;display:grid;gap:8px}
footer a{text-decoration:none}
footer a:hover{color:#fff}
.legal{border-top:1px solid rgba(255,255,255,.1);margin-top:40px;padding-top:22px;font-size:13px}


/* One subscription */
.stack{max-width:900px;margin:44px auto 0;display:grid;gap:8px;justify-items:center}
.plats{display:grid;grid-template-columns:repeat(6,1fr);gap:12px;width:100%}
.plat-card{background:#fff;border:1px solid var(--line);border-radius:14px;padding:16px 10px;text-align:center;display:grid;gap:2px}
.plat-card strong{font-size:15px}
.plat-card span{font-size:13px;color:var(--muted)}
.converge{height:36px;display:grid;place-items:center}
.plan-card{width:100%;background:var(--navy);color:#fff;border-radius:18px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;box-shadow:0 20px 50px rgba(10,26,58,.18)}
.plan-card .tag{display:inline-block;background:var(--lime);color:var(--lime-ink);font-size:12px;font-weight:800;padding:4px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:.05em}
.plan-card h3{font-size:24px;margin-top:8px}
.plan-price{font-size:16px;color:#C9D4EE}
.plan-price strong{color:#fff;font-size:20px}
.sub-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-top:36px}
.sub{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:24px}
.sub h4{font-size:18px;margin-bottom:6px}
.sub p{color:var(--muted);font-size:15px}
.data-ph{aspect-ratio:16/10;border-bottom:1px solid var(--line);background:var(--blue-soft);display:grid;align-content:center;gap:10px;padding:18px}
.data-ph .th{display:grid;grid-template-columns:2fr 1.2fr 1fr .7fr;gap:6px;font-size:11px;font-weight:700;color:var(--navy);background:#fff;border:1px solid var(--line);border-radius:8px;padding:8px}
.data-ph .row{height:10px;border-radius:6px;background:#fff;border:1px solid var(--line)}
@media (max-width:960px){.plats{grid-template-columns:repeat(3,1fr)}.sub-grid{grid-template-columns:1fr}}
@media (max-width:620px){.plats{grid-template-columns:repeat(2,1fr)}.plan-card{padding:20px}}


/* Highlighted benefit + review card */
.ben.hl{background:var(--navy);border-color:var(--navy);color:#fff}
.ben.hl .prob{color:var(--lime)}
.ben.hl p{color:#C9D4EE}
.rev{max-width:760px;margin:36px auto 0;background:var(--bg-2);border:1px solid var(--line);border-radius:20px;padding:30px 32px}
.rev-top{display:flex;align-items:center;justify-content:space-between;gap:12px}
.rev-src{font-size:13px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}
.rev blockquote{font-size:20px;line-height:1.5;margin:14px 0 18px;color:var(--ink)}
.rev .who{color:var(--muted)}
.rev .who strong{color:var(--ink)}
.rev .who a{color:var(--blue)}
.toolsbg{background:var(--bg-2)}
.cancel-note{display:flex;gap:12px;align-items:flex-start;background:#F1FBD8;border:1px solid #CDEB8A;border-radius:12px;padding:14px 16px;margin:0 0 20px;font-size:15px;color:#2A3A0B}
.cancel-note svg{flex:none;margin-top:2px}
.cancel-note strong{color:var(--lime-ink)}
@media (max-width:620px){.rev{padding:22px 20px}.rev-top{flex-wrap:wrap}}

/* Mobile sticky CTA */
.mcta{display:none}

@media (max-width:960px){
  .hero-grid,.how-grid{grid-template-columns:1fr}
  .ben-grid{grid-template-columns:repeat(2,1fr)}
  .panel.active,.data-grid{grid-template-columns:1fr 1fr}
  .foot-grid{grid-template-columns:1fr 1fr}
  .nav-links{display:none}
}
@media (max-width:620px){
  section{padding:64px 0}
  .hero{padding:52px 0 64px}
  .ben-grid,.panel.active,.data-grid{grid-template-columns:1fr}
  .safe{grid-template-columns:1fr}
  .btn{width:100%;justify-content:center}
  .nav-right .login{display:none}
  .nav-right .btn{width:auto}
  .price-head,.price-body{padding:24px 20px}
  .mcta{display:block;position:fixed;left:0;right:0;bottom:0;z-index:60;background:#fff;border-top:1px solid var(--line);padding:10px 16px calc(10px + env(safe-area-inset-bottom))}
  .mcta .btn{padding:14px}
  .mcta small{display:block;text-align:center;font-size:12px;color:var(--muted);margin-top:4px}
  body{padding-bottom:86px}
}
</style>
</head>
<body>

<header>
  <div class="wrap nav">
    <a href="https://tsscout.com" aria-label="TSScout home"><img src="https://tsscout.com/public/assets/reengage2/reengage2-image-1.png" alt="TSScout"></a>
    <nav class="nav-links" aria-label="Page sections">
      <a href="#how">One subscription</a><a href="#tools">Tools</a><a href="#pricing">Pricing</a><a href="#faq">FAQ</a>
    </nav>
    <div class="nav-right">
      <a class="login" href="https://app.tsscout.com/login" data-cta="nav-login">Log in</a>
      <a class="btn btn-lime" href="https://app.tsscout.com/create-account/premium/2" data-cta="nav-start">Start for $1</a>
    </div>
  </div>
</header>

<!-- 1. OUTCOME + OFFER -->
<section class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Product research for marketplace sellers</span>
      <h1>Know what to sell <em>before you invest.</em></h1>
      <p class="sub">Explore product opportunities, compare competitors, and research suppliers across six platforms from one dashboard.</p>
      <a class="btn btn-lime" href="https://app.tsscout.com/create-account/premium/2" data-cta="hero-start">Start my 14-day trial for $1 →</a>
      <div class="offer-box">
        <strong>$1 today</strong> for 14 days of Premium. Unless you cancel before the trial ends, Premium renews automatically at <strong>$79.98/month</strong>. Cancel anytime.
      </div>
      <p class="returning">Already have a TSScout account? <a href="https://app.tsscout.com/login" data-cta="hero-login">Log in here</a></p>
      <div class="chips" aria-label="Supported platforms">
        <span class="chip">eBay</span><span class="chip">AliExpress</span><span class="chip">Amazon</span><span class="chip">Walmart</span><span class="chip">Shopify</span><span class="chip">TikTok Shop</span>
      </div>
    </div>
    <div>
      <div class="shot">
        <div class="vid" id="heroVideo" data-yt="EITusD0MU80" role="button" tabindex="0" aria-label="Play video: TS Scout walkthrough for beginners">
          <img src="https://img.youtube.com/vi/EITusD0MU80/maxresdefault.jpg" alt="TS Scout walkthrough video: getting started for beginners" loading="eager">
          <span class="play" aria-hidden="true"><svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <span class="vid-badge">Watch the 4-min walkthrough</span>
        </div>
      </div>
      <p class="shot-cap">See the dashboard, the tools and a real search before you sign up</p>
    </div>
  </div>
</section>

<!-- 2. ONE SUBSCRIPTION -->
<section class="how" id="how">
  <div class="wrap">
    <div class="center">
      <span class="eyebrow">One subscription</span>
      <h2>One subscription. Six marketplaces.</h2>
      <p class="lead">Premium covers eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop, plus a CJ Dropshipping scanner, in a single plan. No add-ons.</p>
    </div>

    <div class="stack" aria-label="What one Premium subscription covers">
      <div class="plats">
        <div class="plat-card"><strong>eBay</strong><span>6 tools</span></div>
        <div class="plat-card"><strong>AliExpress + CJ</strong><span>5 tools</span></div>
        <div class="plat-card"><strong>Shopify</strong><span>4 tools</span></div>
        <div class="plat-card"><strong>Amazon</strong><span>1 tool</span></div>
        <div class="plat-card"><strong>Walmart</strong><span>1 tool</span></div>
        <div class="plat-card"><strong>TikTok Shop</strong><span>1 tool</span></div>
      </div>
      <div class="converge" aria-hidden="true">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 4v14"/><path d="m6 13 6 6 6-6"/></svg>
      </div>
      <div class="plan-card">
        <div><span class="tag">TSScout Premium</span><h3>18 tools in one plan</h3></div>
        <div class="plan-price"><strong>$1</strong> for 14 days, then <strong>$79.98/month</strong></div>
      </div>
    </div>

    <div class="sub-grid">
      <div class="sub"><h4>One price</h4><p>One subscription covers every platform, so you don't pay for a separate research tool on each marketplace.</p></div>
      <div class="sub"><h4>No add-ons</h4><p>Every Premium tool is included. There are no add-ons or extra charges for any platform.</p></div>
      <div class="sub"><h4>One workflow</h4><p>Find a product, check demand and competitors, then source a supplier and price it, without leaving TSScout.</p></div>
    </div>

    <div class="center" style="margin-top:36px">
      <a class="btn btn-lime" href="https://app.tsscout.com/create-account/premium/2" data-cta="subscription-start">Start my 14-day trial for $1 →</a>
      <p class="terms">Then $79.98/month unless you cancel before the trial ends. <a href="#tools" style="color:var(--blue);font-weight:600">See all 18 tools</a></p>
    </div>
  </div>
</section>

<!-- 3. WHY TSSCOUT + CUSTOMER PROOF -->
<section>
  <div class="wrap">
    <div class="center">
      <span class="eyebrow">Why sellers use TSScout</span>
      <h2>Better product decisions, with every tool in one subscription</h2>
      <p class="lead">Most bad product choices start with missing data, not missing effort. One Premium plan puts the research for six marketplaces in one place.</p>
    </div>
    <div class="ben-grid">
      <div class="ben hl"><div class="prob">Included in Premium</div><h3>All tools, one subscription</h3><p>18 tools across six marketplaces, with no add-ons or extra charges.</p></div>
      <div class="ben"><div class="prob">Instead of</div><h3>Entering a crowded niche</h3><p>Compare listings, units sold and average price across a category before you pick a product.</p></div>
      <div class="ben"><div class="prob">Instead of</div><h3>Pricing blind</h3><p>See what competing sellers charge and how their listings are performing.</p></div>
      <div class="ben"><div class="prob">Instead of</div><h3>Six tabs open</h3><p>Research eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop with one subscription.</p></div>
    </div>

    <div class="rev">
      <div class="rev-top"><span class="stars" aria-label="5 out of 5 stars">★★★★★</span><span class="rev-src">From Trustpilot</span></div>
      <blockquote>“Their product research service is professional, accurate, and very helpful for making informed business decisions.”</blockquote>
      <div class="who">
        <span><strong>Jony David</strong> · Trustpilot review · Jun 21, 2026</span>
        <a href="https://www.trustpilot.com/review/tsscout.com" target="_blank" rel="noopener" data-cta="trustpilot">Read the full review on Trustpilot ↗</a>
      </div>
    </div>
  </div>
</section>

<!-- 5. PLATFORM CAPABILITIES (names = pricing page / registration) -->
<section id="tools" class="toolsbg">
  <div class="wrap">
    <div class="center">
      <span class="eyebrow">What's included in Premium</span>
      <h2>18 tools across six platforms</h2>
      <p class="lead">Every tool in the Premium plan, grouped by platform.</p>
    </div>

    <div class="tabs" role="tablist" aria-label="Tools by platform">
      <button class="tab" role="tab" aria-selected="true" data-tab="ebay">eBay<span>6</span></button>
      <button class="tab" role="tab" aria-selected="false" data-tab="ali">AliExpress &amp; CJ<span>5</span></button>
      <button class="tab" role="tab" aria-selected="false" data-tab="shop">Shopify<span>4</span></button>
      <button class="tab" role="tab" aria-selected="false" data-tab="amz">Amazon &amp; Walmart<span>2</span></button>
      <button class="tab" role="tab" aria-selected="false" data-tab="tt">TikTok Shop<span>1</span></button>
    </div>

    <div class="panel active" id="ebay" role="tabpanel">
      <div class="tool"><div class="plat">eBay</div><h4>eBay Product Research</h4><p>Search any product and see total listings, average selling price and units sold, with filters for price, marketplace and seller feedback.</p></div>
      <div class="tool"><div class="plat">eBay</div><h4>eBay Competitors Research</h4><p>Enter an eBay store and a sales period to see its products with total sales, selling price and performance indicators.</p></div>
      <div class="tool"><div class="plat">eBay</div><h4>eBay Segment Insight</h4><p>Search by category to compare listings, units sold and average price across niches.</p></div>
      <div class="tool"><div class="plat">eBay</div><h4>eBay smartTitles</h4><p>See which keywords eBay buyers search most, with search volume, and use them to build optimized titles.</p></div>
      <div class="tool"><div class="plat">eBay</div><h4>eBay best items</h4><p>Browse best-selling items on eBay for product ideas.</p></div>
      <div class="tool"><div class="plat">eBay</div><h4>eBay Fees calculator</h4><p>Estimate eBay fees before you set your selling price.</p></div>
    </div>

    <div class="panel" id="ali" role="tabpanel">
      <div class="tool"><div class="plat">AliExpress</div><h4>AliExpress Product Research</h4><p>Research AliExpress products before you decide what to source.</p></div>
      <div class="tool"><div class="plat">AliExpress</div><h4>AliExpress source finder</h4><p>Analyze any AliExpress store to see every product it lists, with ratings, total sales and current price.</p></div>
      <div class="tool"><div class="plat">AliExpress</div><h4>AliExpress Express Scanner</h4><p>Find trending, best-performing AliExpress products with seller ratings, sales volume and price. Filter by price, rating or sales.</p></div>
      <div class="tool"><div class="plat">AliExpress</div><h4>AliExpress Image Match</h4><p>Search AliExpress with a product image to find exact or similar items.</p></div>
      <div class="tool"><div class="plat">CJ Dropshipping</div><h4>CJ Dropshipping Scanner</h4><p>Scan CJ Dropshipping products by keyword and category. Results include product name, product ID/SKU, category and price.</p></div>
    </div>

    <div class="panel" id="shop" role="tabpanel">
      <div class="tool"><div class="plat">Shopify</div><h4>Shopify Insight</h4><p>Search by product name and filter by price range, shipping location, time period or category to see items sold, average price and active listings.</p></div>
      <div class="tool"><div class="plat">Shopify</div><h4>Shopify Product Research</h4><p>Research products being sold by Shopify stores.</p></div>
      <div class="tool"><div class="plat">Shopify</div><h4>Shopify Competitors Research</h4><p>Search a competing Shopify store to see its product listings and how they perform.</p></div>
      <div class="tool"><div class="plat">Shopify</div><h4>Shopify find stores</h4><p>Search by product name to find Shopify stores selling it, with orders, revenue and shipping location for your chosen period.</p></div>
    </div>

    <div class="panel" id="amz" role="tabpanel">
      <div class="tool"><div class="plat">Amazon</div><h4>Amazon Scanner</h4><p>See price, rating and review count for products matching any keyword on Amazon.</p></div>
      <div class="tool"><div class="plat">Walmart</div><h4>Walmart Scanner</h4><p>See price, rating and review count for products matching any keyword on Walmart.</p></div>
    </div>

    <div class="panel" id="tt" role="tabpanel">
      <div class="tool"><div class="plat">TikTok Shop</div><h4>TikTrend Scan</h4><p>Search any product to see units sold and price on TikTok Shop, sort by performance or price, and jump to the same product on AliExpress, Amazon, Walmart or Google.</p></div>
    </div>

    <p class="tools-note">Available data differs by platform — see what each one shows below.</p>
  </div>
</section>

<!-- Per-platform data (qualifies "same depth" claim) -->
<section class="data">
  <div class="wrap">
    <div class="center">
      <span class="eyebrow">What you'll see</span>
      <h2>The data each platform gives you</h2>
      <p class="lead">Metrics vary by marketplace because each one exposes different public data.</p>
    </div>
    <div class="data-grid">
      <div class="data-card">
        <img src="https://tsscout.com/public/assets/reengage2/reengage2-image-1.jpg" alt="eBay Product Research results" loading="lazy">
        <div class="body"><h4>eBay</h4><ul><li>Total listings and average price</li><li>Units sold</li><li>Seller name, price and location per listing</li></ul></div>
      </div>
      <div class="data-card">
        <img src="https://tsscout.com/public/assets/reengage2/reengage2-image-3.png" alt="Amazon Scanner results for the keyword iphone, showing price, rating and reviews" loading="lazy">
        <div class="body"><h4>Amazon</h4><ul><li>Price</li><li>Rating</li><li>Review count</li></ul></div>
      </div>
      <div class="data-card">
        <img src="https://tsscout.com/public/assets/reengage2/reengage2-image-4.png" alt="Walmart Scanner results for the keyword bags, showing price, rating and reviews" loading="lazy">
        <div class="body"><h4>Walmart</h4><ul><li>Price</li><li>Rating</li><li>Review count</li></ul></div>
      </div>
      <div class="data-card">
        <div class="data-ph" aria-hidden="true"><div class="th"><span>Product name</span><span>Product ID / SKU</span><span>Category</span><span>Price</span></div><div class="row"></div><div class="row"></div><div class="row"></div></div>
        <div class="body"><h4>CJ Dropshipping</h4><ul><li>Product name and image</li><li>Product ID / SKU</li><li>Category and price</li></ul></div>
      </div>
    </div>

    <div class="safe" style="margin-top:48px">
      <div class="shield" aria-hidden="true">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
      </div>
      <div>
        <h3>No store connection needed</h3>
        <p>TSScout researches public marketplace data. You don't need to connect your eBay, Amazon, Walmart, Shopify or TikTok Shop account, and we don't access your orders or customer data.</p>
      </div>
    </div>
  </div>
</section>

<!-- 6. PREMIUM PRICING -->
<section class="pricing" id="pricing">
  <div class="wrap">
    <div class="center">
      <span class="eyebrow">Premium plan</span>
      <h2>Try every Premium tool for $1</h2>
      <p class="lead">Full Premium access for 14 days. Here is exactly what you'll pay and when.</p>
    </div>
    <div class="price-card">
      <div class="price-head">
        <span class="tag">14-day trial</span>
        <h3>TSScout Premium</h3>
        <p>All 18 tools across six platforms</p>
      </div>
      <div class="price-body">
        <div class="big">$1 <small>today</small></div>
        <ul class="schedule">
          <li><span>Today</span><span>$1 for 14 days of Premium</span></li>
          <li><span>After day 14</span><span>$79.98/month, renews automatically</span></li>
          <li><span>To avoid the monthly charge</span><span>Cancel before your trial ends</span></li>
          <li><span>Unsubscribe</span><span>Anytime, during the 14 days or after</span></li>
        </ul>
        <div class="cancel-note">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3F6B06" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="m8 12 3 3 5-6"/></svg>
          <span><strong>Cancel anytime.</strong> You can unsubscribe during the 14-day trial or at any point after it. Cancel before the trial ends to avoid the first $79.98 charge.</span>
        </div>
        <a class="btn btn-lime" href="https://app.tsscout.com/create-account/premium/2" data-cta="pricing-start">Start my 14-day trial for $1 →</a>
        <p class="terms" style="text-align:center">You'll create your account first, then enter payment details. Full terms are shown again before payment.</p>
        <div class="incl">
          <h5>eBay</h5><p>Product Research · Competitors Research · Segment Insight · smartTitles · best items · Fees calculator</p>
          <h5>AliExpress</h5><p>Product Research · source finder · Express Scanner · Image Match · CJ Dropshipping Scanner</p>
          <h5>Shopify</h5><p>Shopify Insight · Shopify Product Research · Shopify Competitors Research · Shopify find stores</p>
          <h5>Amazon · Walmart · TikTok Shop</h5><p>Amazon Scanner · Walmart Scanner · TikTrend Scan</p>
        </div>
      </div>
    </div>
    <p class="other-plans">Need fewer tools? TSScout also offers Basic and Standard plans. <a href="https://app.tsscout.com/pricing" data-cta="all-plans">Compare all plans</a></p>
  </div>
</section>

<!-- 7. FAQ -->
<section id="faq">
  <div class="wrap">
    <div class="center">
      <span class="eyebrow">Questions</span>
      <h2>Frequently asked questions</h2>
    </div>
    <div class="faq">
      <details open>
        <summary>What happens after my $1 trial?</summary>
        <p>Your $1 trial gives you 14 days of Premium. If you don't cancel before the trial ends, Premium renews automatically at $79.98/month. You can cancel anytime.</p>
      </details>
      <details>
        <summary>Can I unsubscribe at any time?</summary>
        <p>Yes. You can unsubscribe at any time, during the 14-day trial or after it. To avoid the first $79.98 monthly charge, cancel before the trial ends.</p>
      </details>
      <details>
        <summary>Do I need to connect my store or give TSScout access to my accounts?</summary>
        <p>No. TSScout researches public marketplace data. You don't need to connect your eBay, Amazon, Walmart, Shopify or TikTok Shop account, and we don't need access to your orders, customers or payment details.</p>
      </details>
      <details>
        <summary>What does Premium include?</summary>
        <p>18 tools across eBay, AliExpress (including a CJ Dropshipping scanner), Amazon, Walmart, Shopify and TikTok Shop. The full list is in the <a href="#tools">tools section</a> above.</p>
      </details>
      <details>
        <summary>Are there any add-ons or extra fees?</summary>
        <p>No. Every Premium tool is included in the subscription, with no add-ons or extra charges for any platform.</p>
      </details>
      <details>
        <summary>Does TSScout have other plans?</summary>
        <p>Yes. Alongside Premium, TSScout offers Basic and Standard plans with fewer tools. <a href="https://app.tsscout.com/pricing">Compare all plans</a>.</p>
      </details>
      <details>
        <summary>Is the same data available on every platform?</summary>
        <p>No — each marketplace exposes different public data. For example, eBay results include units sold and seller details, while Amazon and Walmart results show price, rating and review count.</p>
      </details>
      <details>
        <summary>I've used TSScout before. Can I come back?</summary>
        <p>Yes. <a href="https://app.tsscout.com/login">Log in</a> with your existing account, or <a href="https://tsscout.com/contact-us">contact us</a> if you need help with your account.</p>
      </details>
      <details>
        <summary>Where can I read the refund and cancellation terms?</summary>
        <p>See our <a href="https://tsscout.com/refund-policy">Refund Policy</a> and <a href="https://tsscout.com/terms-conditions">Terms &amp; Conditions</a>.</p>
      </details>
    </div>
  </div>
</section>

<!-- 8. FINAL CTA -->
<section class="final">
  <div class="wrap">
    <h2>Know what to sell before you invest.</h2>
    <p class="lead">Six platforms, 18 tools, one subscription.</p>
    <a class="btn btn-lime" href="https://app.tsscout.com/create-account/premium/2" data-cta="final-start">Start my 14-day trial for $1 →</a>
    <p class="terms"><strong>$1 today</strong> · renews at <strong>$79.98/month</strong> after 14 days unless cancelled before the trial ends</p>
  </div>
</section>

<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <img src="https://tsscout.com/public/assets/reengage2/reengage2-image-5.png" alt="TSScout">
        <p>Product, competitor and supplier research for eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop sellers.</p>
      </div>
      <div><h6>Product</h6><ul><li><a href="#tools">Tools</a></li><li><a href="https://app.tsscout.com/pricing">All plans</a></li><li><a href="https://tsscout.com/faqs">Help center</a></li></ul></div>
      <div><h6>Company</h6><ul><li><a href="https://tsscout.com/about">About</a></li><li><a href="https://tsscout.com/contact-us">Contact</a></li><li><a href="https://tsscout.com/affiliate">Affiliate program</a></li></ul></div>
      <div><h6>Legal</h6><ul><li><a href="https://tsscout.com/terms-conditions">Terms &amp; Conditions</a></li><li><a href="https://tsscout.com/privacy-policy">Privacy Policy</a></li><li><a href="https://tsscout.com/refund-policy">Refund Policy</a></li></ul></div>
    </div>
    <div class="legal">© 2026 TSScout. All rights reserved. Premium trial: $1 for 14 days, then $79.98/month unless cancelled before the trial ends.</div>
  </div>
</footer>

<div class="mcta">
  <a class="btn btn-lime" href="https://app.tsscout.com/create-account/premium/2" data-cta="mobile-sticky">Start my 14-day trial for $1</a>
  <small>Then $79.98/month · cancel anytime</small>
</div>

<script>
(function(){
  var v=document.getElementById('heroVideo');
  if(!v)return;
  function play(){
    if(v.querySelector('iframe'))return;
    var f=document.createElement('iframe');
    f.src='https://www.youtube-nocookie.com/embed/'+v.dataset.yt+'?autoplay=1&rel=0&modestbranding=1&playsinline=1';
    f.allow='autoplay; encrypted-media; picture-in-picture; fullscreen';
    f.allowFullscreen=true;
    f.title='TS Scout walkthrough: getting started for beginners';
    v.innerHTML='';v.appendChild(f);
    window.dataLayer=window.dataLayer||[];
    window.dataLayer.push({event:'hero_video_play',video_id:v.dataset.yt});
  }
  v.addEventListener('click',play);
  v.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();play();}});
})();
document.querySelectorAll('.tab').forEach(function(tab){
  tab.addEventListener('click',function(){
    document.querySelectorAll('.tab').forEach(function(t){t.setAttribute('aria-selected','false')});
    document.querySelectorAll('.panel').forEach(function(p){p.classList.remove('active')});
    tab.setAttribute('aria-selected','true');
    document.getElementById(tab.dataset.tab).classList.add('active');
  });
});
</script>
</body>
</html>
