<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TSScout – One Login. Six Marketplaces. Every Winning Product.</title>
<meta name="description" content="Research eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop from one dashboard. No store connection required.">
 <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KV3N43LJ');
  </script>
<style>

/* ============ FONTS ============ */
@font-face{
  font-family:"Pontiac";
  src:url('{{ asset("assets/reengage2/reengage2-font-1.otf") }}') format("opentype");
  font-weight:700;
  font-display:swap;
}
@font-face{
  font-family:"Pontiac";
  src:url('{{ asset("assets/reengage2/reengage2-font-2.otf") }}') format("opentype");
  font-weight:900;
  font-display:swap;
}

/* ============ TOKENS ============ */
:root{
  --navy-deep:#0f2536;
  --navy:#1d3f5b;
  --navy-soft:#2c5678;
  --lime:#c2f750;
  --lime-deep:#9fd82c;
  --blue:#3545d6;
  --bg:#f5f7fa;
  --card:#ffffff;
  --line:#e1e7ee;
  --muted:#5c7186;
  --ink:#0f2331;
  --radius:16px;
  --wrap:1160px;
  --mono:"IBM Plex Mono", ui-monospace, SFMono-Regular, Menlo, monospace;
  --body:"Plus Jakarta Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  --display:"Pontiac", var(--body);
}

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@500;600&display=swap');

*{box-sizing:border-box; margin:0; padding:0;}
html{scroll-behavior:smooth;}
body{
  font-family:var(--body);
  background:var(--bg);
  color:var(--ink);
  line-height:1.5;
  -webkit-font-smoothing:antialiased;
}
img{max-width:100%; display:block;}
a{color:inherit; text-decoration:none;}
ul{list-style:none;}
.wrap{max-width:var(--wrap); margin:0 auto; padding:0 24px;}
section{position:relative;}

:focus-visible{outline:3px solid var(--blue); outline-offset:3px; border-radius:4px;}

@media (prefers-reduced-motion: reduce){
  *{animation-duration:0.001ms !important; animation-iteration-count:1 !important; transition-duration:0.001ms !important; scroll-behavior:auto !important;}
}

h1,h2,h3,h4{font-family:var(--display); font-weight:900; letter-spacing:-0.01em; color:var(--navy);}
.eyebrow{
  font-family:var(--mono);
  font-size:12.5px;
  font-weight:600;
  letter-spacing:0.14em;
  text-transform:uppercase;
  color:var(--blue);
  display:inline-flex;
  align-items:center;
  gap:8px;
}
.eyebrow::before{
  content:"";
  width:7px; height:7px; border-radius:50%;
  background:var(--lime);
  box-shadow:0 0 0 3px rgba(194,247,80,0.25);
}

.btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  font-family:var(--body);
  font-weight:700;
  font-size:15.5px;
  padding:15px 28px;
  border-radius:999px;
  border:none;
  cursor:pointer;
  transition:transform .15s ease, box-shadow .15s ease;
  white-space:nowrap;
}
.btn:hover{transform:translateY(-2px);}
.btn-primary{
  background:var(--lime);
  color:var(--navy-deep);
  box-shadow:0 10px 24px -8px rgba(194,247,80,0.55);
}
.btn-primary:hover{box-shadow:0 14px 28px -8px rgba(194,247,80,0.7);}
.btn-ghost{
  background:transparent;
  color:var(--card);
  border:1.5px solid rgba(255,255,255,0.35);
}
.btn-outline-navy{
  background:transparent;
  color:var(--navy);
  border:1.5px solid var(--line);
}
.btn-outline-navy:hover{border-color:var(--navy);}

/* ============ NAV ============ */
header.site-nav{
  position:sticky; top:0; z-index:50;
  background:rgba(245,247,250,0.88);
  backdrop-filter:blur(10px);
  border-bottom:1px solid var(--line);
}
.nav-inner{
  display:flex; align-items:center; justify-content:space-between;
  padding:14px 24px;
  max-width:var(--wrap); margin:0 auto;
}
.nav-logo img{height:34px; width:auto;}
.nav-links{display:flex; align-items:center; gap:32px;}
.nav-links a{
  font-size:14.5px; font-weight:600; color:var(--navy);
  opacity:0.75;
}
.nav-links a:hover{opacity:1;}
.nav-cta{display:flex; align-items:center; gap:14px;}
.nav-cta .btn{padding:11px 22px; font-size:14px;}
.nav-toggle{display:none;}

@media (max-width:880px){
  .nav-links{display:none;}
}

/* ============ HERO ============ */
.hero{
  background:radial-gradient(ellipse 120% 90% at 20% 0%, #163350 0%, var(--navy-deep) 55%, #0a1b28 100%);
  color:#fff;
  padding:64px 0 0;
  overflow:hidden;
}
.hero-grid{
  display:grid;
  grid-template-columns:1.05fr 0.95fr;
  gap:40px;
  align-items:center;
  padding-bottom:56px;
}
.hero-copy .eyebrow{color:var(--lime);}
.hero-copy .eyebrow::before{background:var(--lime);}
.hero-copy h1{
  color:#fff;
  font-size:clamp(34px, 4.4vw, 54px);
  line-height:1.06;
  margin:18px 0 20px;
}
.hero-copy h1 em{
  font-style:normal;
  background:linear-gradient(92deg, #7f8cf0 0%, var(--lime) 100%);
  -webkit-background-clip:text;
  background-clip:text;
  color:transparent;
}
.hero-copy p.lead{
  font-size:17.5px;
  color:#c4d2df;
  max-width:520px;
  margin-bottom:30px;
}
.hero-cta-row{display:flex; flex-direction:column; align-items:flex-start; gap:12px;}
.hero-cta-row .btn-primary{font-size:16.5px; padding:17px 32px;}
.trial-terms{
  font-family:var(--mono);
  font-size:12.5px;
  color:#93a9bb;
  display:flex; align-items:center; gap:8px; flex-wrap:wrap;
}
.trial-terms b{color:#dce8f0; font-weight:600;}
.trial-terms .dot{opacity:.5;}

/* platform convergence strip */
.convergence{
  margin-top:44px;
  padding-top:28px;
  border-top:1px solid rgba(255,255,255,0.12);
}
.convergence-label{
  font-family:var(--mono);
  font-size:11.5px;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:#7d93a5;
  margin-bottom:16px;
}
.platform-row{
  display:flex; align-items:center; flex-wrap:wrap; gap:0;
}
.platform-chip{
  font-family:var(--mono);
  font-size:14px; font-weight:600;
  color:#e7edf2;
  padding:6px 0;
}
.infinity-dot{
  width:16px; height:16px; margin:0 14px;
  flex:none;
}

/* hero visual */
.hero-visual{position:relative;}
.hero-visual .glow{
  position:absolute; inset:-60px -30px;
  background:radial-gradient(circle at 60% 30%, rgba(53,69,214,0.55), transparent 60%),
             radial-gradient(circle at 20% 80%, rgba(194,247,80,0.35), transparent 55%);
  filter:blur(30px);
  z-index:0;
}
.device-frame{
  position:relative; z-index:1;
  background:var(--card);
  border-radius:18px;
  padding:10px;
  box-shadow:0 40px 80px -20px rgba(0,0,0,0.5), 0 0 0 1px rgba(255,255,255,0.06);
  transform:rotate(1.2deg);
}
.device-frame img{border-radius:11px; display:block;}
.device-tag{
  position:absolute; z-index:2;
  bottom:-18px; left:-18px;
  background:var(--lime);
  color:var(--navy-deep);
  font-family:var(--mono);
  font-weight:600; font-size:12.5px;
  padding:10px 16px;
  border-radius:10px;
  box-shadow:0 12px 24px -8px rgba(0,0,0,0.4);
  transform:rotate(-2deg);
}
.device-tag2{
  position:absolute; z-index:2;
  top:-16px; right:8px;
  background:var(--navy);
  border:1px solid rgba(255,255,255,0.15);
  color:#fff;
  font-family:var(--mono);
  font-weight:600; font-size:12px;
  padding:9px 14px;
  border-radius:10px;
}

@media (max-width:960px){
  .hero-grid{grid-template-columns:1fr; padding-bottom:40px;}
  .hero-visual{order:-1; max-width:480px; margin:0 auto 12px;}
  .device-frame{transform:none;}
}

/* ============ SECTION GENERIC ============ */
.section{padding:88px 0;}
.section-head{max-width:640px; margin-bottom:52px;}
.section-head h2{font-size:clamp(28px,3.2vw,38px); margin:16px 0 14px; line-height:1.12;}
.section-head p{color:var(--muted); font-size:16.5px;}
.section-head.center{margin-left:auto; margin-right:auto; text-align:center;}

/* divider motif using infinity mark */
.motif-divider{
  display:flex; align-items:center; justify-content:center;
  gap:14px; margin:0 auto 18px;
  opacity:0.5;
}
.motif-divider span{height:1px; width:52px; background:var(--line);}

/* ============ PROBLEM ============ */
.problem{background:var(--card);}
.problem-grid{
  display:grid; grid-template-columns:repeat(4,1fr); gap:20px;
}
.problem-card{
  border:1px solid var(--line);
  border-radius:var(--radius);
  padding:26px 22px;
  background:#fbfcfd;
}
.problem-card .num{
  font-family:var(--mono); font-weight:600; font-size:13px;
  color:var(--blue); margin-bottom:14px; display:block;
}
.problem-card h3{font-size:17px; color:var(--navy); margin-bottom:8px; font-weight:800;}
.problem-card p{color:var(--muted); font-size:14.5px;}

@media (max-width:920px){ .problem-grid{grid-template-columns:1fr 1fr;} }
@media (max-width:560px){ .problem-grid{grid-template-columns:1fr;} }

/* ============ TOOLS / PLATFORM TABS ============ */
.tools{background:var(--bg);}
.platform-tabs{
  display:flex; flex-wrap:wrap; gap:10px; margin-bottom:36px;
}
.ptab{
  font-family:var(--mono);
  font-size:13.5px; font-weight:600;
  padding:10px 18px;
  border-radius:999px;
  border:1px solid var(--line);
  background:var(--card);
  color:var(--navy);
  cursor:pointer;
}
.ptab-input{position:absolute; opacity:0; pointer-events:none;}
.ptab-input:checked + label{
  background:var(--navy); color:#fff; border-color:var(--navy);
}
.panels{display:grid; gap:16px; grid-template-columns:repeat(3,1fr);}
.tool-card{
  background:var(--card);
  border:1px solid var(--line);
  border-radius:var(--radius);
  padding:22px;
}
.tool-card .plat{
  font-family:var(--mono); font-size:11px; letter-spacing:.08em; text-transform:uppercase;
  color:var(--muted); margin-bottom:10px; display:block;
}
.tool-card h4{font-size:16.5px; color:var(--navy); margin-bottom:8px; font-family:var(--body); font-weight:800;}
.tool-card p{font-size:14px; color:var(--muted);}

.panel-group{display:none;}
.panel-group.active{display:grid;}

@media (max-width:900px){ .panels{grid-template-columns:1fr 1fr;} }
@media (max-width:600px){ .panels{grid-template-columns:1fr;} }

/* ============ PROOF SCREENSHOT ============ */
.proof{background:var(--card);}
.proof-grid{
  display:grid; grid-template-columns:0.85fr 1.15fr; gap:48px; align-items:center;
}
.proof-shot{
  border-radius:var(--radius);
  overflow:hidden;
  border:1px solid var(--line);
  box-shadow:0 30px 60px -30px rgba(15,37,54,0.25);
}
.proof-copy .check-list{margin-top:24px; display:flex; flex-direction:column; gap:14px;}
.check-list li{display:flex; gap:12px; align-items:flex-start; font-size:15px; color:var(--navy); font-weight:600;}
.check-list li svg{flex:none; margin-top:2px;}

@media (max-width:920px){
  .proof-grid{grid-template-columns:1fr;}
  .proof-shot{order:2;}
}

.proof-mosaic{margin-top:56px; padding-top:48px; border-top:1px solid var(--line);}
.proof-mosaic-head{max-width:520px; margin-bottom:26px;}
.proof-mosaic-head h3{font-family:var(--body); font-weight:800; font-size:20px; color:var(--navy); margin-top:12px;}
.proof-mosaic-grid{display:grid; grid-template-columns:1fr 1fr; gap:24px;}
.mosaic-shot{border:1px solid var(--line); border-radius:var(--radius); overflow:hidden; background:var(--card); box-shadow:0 20px 40px -26px rgba(15,37,54,0.2);}
.mosaic-shot img{display:block; width:100%;}
.mosaic-shot figcaption{
  padding:14px 16px; font-family:var(--mono); font-size:12.5px; color:var(--muted); border-top:1px solid var(--line);
}
@media (max-width:760px){ .proof-mosaic-grid{grid-template-columns:1fr;} }

/* ============ NO CONNECTION BANNER ============ */
.privacy-banner{
  background:var(--navy);
  color:#fff;
  border-radius:24px;
  padding:52px;
  display:grid;
  grid-template-columns:auto 1fr auto;
  gap:36px;
  align-items:center;
  margin:0 auto;
}
.privacy-icon{
  width:64px; height:64px; border-radius:16px;
  background:rgba(194,247,80,0.14);
  display:flex; align-items:center; justify-content:center;
  flex:none;
}
.privacy-banner h3{color:#fff; font-size:23px; margin-bottom:8px;}
.privacy-banner p{color:#c4d2df; font-size:15px; max-width:560px;}
.privacy-cta{flex:none;}

@media (max-width:820px){
  .privacy-banner{grid-template-columns:1fr; text-align:center; padding:38px 26px;}
  .privacy-icon{margin:0 auto;}
}

/* ============ COMPARISON ============ */
.compare{background:var(--bg);}
.compare-table-wrap{
  overflow-x:auto;
  border-radius:var(--radius);
  border:1px solid var(--line);
  background:var(--card);
}
table.compare-table{
  width:100%; border-collapse:collapse; min-width:680px;
}
.compare-table th, .compare-table td{
  padding:16px 18px;
  text-align:center;
  border-bottom:1px solid var(--line);
  font-size:14.5px;
}
.compare-table th{
  font-family:var(--mono); font-weight:600; font-size:12.5px;
  letter-spacing:.04em; text-transform:uppercase;
  color:var(--muted);
  background:#fbfcfd;
}
.compare-table td:first-child, .compare-table th:first-child{
  text-align:left; font-weight:700; color:var(--navy);
  position:sticky; left:0; background:inherit;
}
.compare-table th.brand-col{color:var(--navy); background:#eef7d9;}
td.brand-col{background:#f7fced;}
.yes{color:#1a8f4c; font-weight:700;}
.partial{color:#b07e00; font-weight:600; font-size:13px;}
.no{color:#b5bfc9;}
.compare-note{font-size:13px; color:var(--muted); margin-top:14px;}

@media (max-width:600px){
  .compare-table th, .compare-table td{padding:12px;}
}

/* ============ PRICING ============ */
.pricing{background:var(--card);}
.price-card{
  max-width:900px; margin:0 auto;
  background:linear-gradient(160deg, var(--navy-deep), var(--navy));
  border-radius:26px;
  padding:52px;
  color:#fff;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:44px;
  position:relative;
  overflow:hidden;
}
.price-card::before{
  content:"";
  position:absolute; top:-140px; right:-140px;
  width:320px; height:320px; border-radius:50%;
  background:radial-gradient(circle, rgba(194,247,80,0.25), transparent 70%);
}
.price-left{position:relative; z-index:1;}
.price-badge{
  display:inline-block; font-family:var(--mono); font-size:11.5px; font-weight:600;
  letter-spacing:.08em; text-transform:uppercase;
  background:rgba(194,247,80,0.15); color:var(--lime);
  padding:6px 14px; border-radius:999px; margin-bottom:18px;
}
.price-left h3{color:#fff; font-size:26px; margin-bottom:6px;}
.price-tag{display:flex; align-items:baseline; gap:10px; margin:18px 0 6px;}
.price-tag .amt{font-family:var(--mono); font-size:52px; font-weight:600;}
.price-tag .cur{font-family:var(--mono); font-size:20px; opacity:.8;}
.price-sub{font-size:13.5px; color:#a9bccb; margin-bottom:26px; line-height:1.6;}
.price-sub b{color:#fff;}
.price-left .btn-primary{width:100%; font-size:16px; padding:16px;}
.price-fine{font-family:var(--mono); font-size:11.5px; color:#7d93a5; margin-top:12px; text-align:center;}

.price-right{position:relative; z-index:1;}
.price-right p.group-label{
  font-family:var(--mono); font-size:11px; letter-spacing:.08em; text-transform:uppercase;
  color:#7d93a5; margin:16px 0 8px;
}
.price-right p.group-label:first-child{margin-top:0;}
.tool-pill-row{display:flex; flex-wrap:wrap; gap:7px; margin-bottom:6px;}
.tool-pill{
  font-size:12.5px; font-weight:600;
  background:rgba(255,255,255,0.07);
  border:1px solid rgba(255,255,255,0.1);
  padding:6px 11px; border-radius:8px; color:#dce8f0;
}

@media (max-width:820px){
  .price-card{grid-template-columns:1fr; padding:32px 26px;}
}

/* ============ TESTIMONIAL PLACEHOLDER ============ */
.social-proof{background:var(--bg);}
.proof-placeholder{
  border:1.5px dashed #c7d3dc;
  border-radius:var(--radius);
  padding:44px 30px;
  text-align:center;
  background:#fbfcfd;
}
.proof-placeholder h4{color:var(--navy); font-size:18px; margin-bottom:10px;}
.proof-placeholder p{color:var(--muted); font-size:14.5px; max-width:480px; margin:0 auto;}
.proof-placeholder .tag{
  display:inline-block; margin-bottom:16px;
  font-family:var(--mono); font-size:11px; letter-spacing:.08em; text-transform:uppercase;
  color:#b07e00; background:#fff3d6; padding:5px 12px; border-radius:999px;
}

/* real review card */
.review-card{
  max-width:640px; margin:0 auto;
  background:var(--card);
  border:1px solid var(--line);
  border-radius:var(--radius);
  padding:30px 32px;
  box-shadow:0 24px 50px -30px rgba(15,37,54,0.25);
}
.review-top{display:flex; align-items:center; gap:14px; margin-bottom:14px;}
.review-avatar{
  width:44px; height:44px; border-radius:50%; flex:none;
  background:linear-gradient(135deg, var(--blue), var(--lime));
  color:#fff; font-weight:800; font-family:var(--body);
  display:flex; align-items:center; justify-content:center; font-size:17px;
}
.review-who{display:flex; flex-direction:column; flex:1;}
.review-who strong{color:var(--navy); font-size:15.5px;}
.review-who span{font-size:12.5px; color:var(--muted);}
.review-date{font-family:var(--mono); font-size:12px; color:var(--muted);}
.review-stars{color:#1a8f4c; letter-spacing:3px; font-size:15px; margin-bottom:14px;}
.review-body{color:var(--navy); font-size:15px; line-height:1.7;}
.review-tags{display:flex; gap:10px; margin-top:20px; flex-wrap:wrap;}
.review-tag{
  font-family:var(--mono); font-size:11.5px; font-weight:600;
  background:#eef3f2; color:var(--muted);
  padding:6px 12px; border-radius:999px;
}
.review-tag-tp{background:#e8f7d9; color:#4c8a13;}

/* ============ FAQ ============ */
.faq{background:var(--card);}
.faq-list{max-width:820px; margin:0 auto;}
.faq-item{border-bottom:1px solid var(--line);}
.faq-item summary{
  list-style:none; cursor:pointer;
  display:flex; align-items:center; justify-content:space-between;
  padding:22px 4px; font-weight:700; color:var(--navy); font-size:16px;
}
.faq-item summary::-webkit-details-marker{display:none;}
.faq-item summary .plus{
  font-family:var(--mono); font-size:20px; color:var(--blue); flex:none; margin-left:20px;
  transition:transform .2s ease;
}
.faq-item[open] summary .plus{transform:rotate(45deg);}
.faq-item p{padding:0 4px 22px; color:var(--muted); font-size:15px; max-width:680px;}

/* ============ FINAL CTA ============ */
.final-cta{
  background:radial-gradient(ellipse 100% 100% at 50% 0%, #163350, var(--navy-deep) 70%);
  color:#fff; text-align:center; padding:96px 0;
}
.final-cta h2{color:#fff; font-size:clamp(28px,4vw,44px); margin-bottom:16px;}
.final-cta p{color:#c4d2df; font-size:16.5px; margin-bottom:34px;}
.final-cta .trial-terms{justify-content:center; margin-top:16px;}

/* ============ FOOTER ============ */
footer{background:var(--navy-deep); color:#8fa3b3; padding:56px 0 28px;}
.footer-top{
  display:flex; justify-content:space-between; gap:40px; flex-wrap:wrap;
  padding-bottom:36px; border-bottom:1px solid rgba(255,255,255,0.08);
}
.footer-brand img{height:30px; margin-bottom:14px;}
.footer-brand p{font-size:13.5px; max-width:280px; color:#7d93a5;}
.footer-cols{display:flex; gap:56px; flex-wrap:wrap;}
.footer-col h5{
  font-family:var(--mono); font-size:11.5px; letter-spacing:.08em; text-transform:uppercase;
  color:#647c8d; margin-bottom:14px;
}
.footer-col a{display:block; font-size:14px; color:#b4c4d0; margin-bottom:10px;}
.footer-col a:hover{color:#fff;}
.footer-bottom{
  display:flex; justify-content:space-between; flex-wrap:wrap; gap:12px;
  padding-top:24px; font-size:12.5px; color:#5f7688;
}

/* ============ ANNOTATIONS FOR DEV (visible ribbon) ============ */
.dev-note{
  background:#fff3d6; border:1px dashed #d6a400; color:#7a5c00;
  font-family:var(--mono); font-size:12px; padding:8px 12px; border-radius:8px;
  margin-top:10px; display:inline-block;
}
</style>
</head>
<body>

<!-- ============ NAV ============ -->
<header class="site-nav">
  <div class="nav-inner">
    <a href="#" class="nav-logo"><img src="{{ asset('assets/reengage2/reengage2-image-1.png') }}" alt="TSScout"></a>
    <nav class="nav-links">
      <a href="#tools">Tools</a>
      <a href="#compare">Compare</a>
      <a href="#pricing">Pricing</a>
      <a href="#faq">FAQ</a>
    </nav>
    <div class="nav-cta">
      <a href="https://app.tsscout.com/create-account/premium/2" class="btn btn-primary">Start for $1</a>
    </div>
  </div>
</header>

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-copy">
        <span class="eyebrow">All-in-one marketplace intelligence</span>
        <h1>One login.<br>Six marketplaces.<br><em>Every winning product.</em></h1>
        <p class="lead">Research eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop from a single dashboard — sales history, competitor pricing, and supplier costs, without ever connecting your store.</p>
        <div class="hero-cta-row">
          <a href="https://app.tsscout.com/create-account/premium/2" class="btn btn-primary">Start for $1 →</a>
          <div class="trial-terms">
            <b>$1 today</b><span class="dot">·</span>then <b>$79.98/mo</b> after your 14-day trial<span class="dot">·</span>cancel anytime
          </div>
        </div>

        <div class="convergence">
          <div class="convergence-label">Research every one of these from a single account</div>
          <div class="platform-row">
            <span class="platform-chip">eBay</span>
            <svg class="infinity-dot" viewBox="0 0 24 24" fill="none"><path d="M7 8C4.2 8 2 10.2 2 12s2.2 4 5 4c2.8 0 5-4 7-4s4.2 4 7 4c2.8 0 5-2.2 5-4s-2.2-4-5-4c-2.8 0-4.2 4-7 4S9.8 8 7 8Z" stroke="url(#g1)" stroke-width="1.6"/><defs><linearGradient id="g1" x1="2" y1="12" x2="22" y2="12"><stop stop-color="#3545d6"/><stop offset="1" stop-color="#c2f750"/></linearGradient></defs></svg>
            <span class="platform-chip">AliExpress</span>
            <svg class="infinity-dot" viewBox="0 0 24 24" fill="none"><path d="M7 8C4.2 8 2 10.2 2 12s2.2 4 5 4c2.8 0 5-4 7-4s4.2 4 7 4c2.8 0 5-2.2 5-4s-2.2-4-5-4c-2.8 0-4.2 4-7 4S9.8 8 7 8Z" stroke="url(#g2)" stroke-width="1.6"/><defs><linearGradient id="g2" x1="2" y1="12" x2="22" y2="12"><stop stop-color="#3545d6"/><stop offset="1" stop-color="#c2f750"/></linearGradient></defs></svg>
            <span class="platform-chip">Amazon</span>
            <svg class="infinity-dot" viewBox="0 0 24 24" fill="none"><path d="M7 8C4.2 8 2 10.2 2 12s2.2 4 5 4c2.8 0 5-4 7-4s4.2 4 7 4c2.8 0 5-2.2 5-4s-2.2-4-5-4c-2.8 0-4.2 4-7 4S9.8 8 7 8Z" stroke="url(#g3)" stroke-width="1.6"/><defs><linearGradient id="g3" x1="2" y1="12" x2="22" y2="12"><stop stop-color="#3545d6"/><stop offset="1" stop-color="#c2f750"/></linearGradient></defs></svg>
            <span class="platform-chip">Walmart</span>
            <svg class="infinity-dot" viewBox="0 0 24 24" fill="none"><path d="M7 8C4.2 8 2 10.2 2 12s2.2 4 5 4c2.8 0 5-4 7-4s4.2 4 7 4c2.8 0 5-2.2 5-4s-2.2-4-5-4c-2.8 0-4.2 4-7 4S9.8 8 7 8Z" stroke="url(#g4)" stroke-width="1.6"/><defs><linearGradient id="g4" x1="2" y1="12" x2="22" y2="12"><stop stop-color="#3545d6"/><stop offset="1" stop-color="#c2f750"/></linearGradient></defs></svg>
            <span class="platform-chip">Shopify</span>
            <svg class="infinity-dot" viewBox="0 0 24 24" fill="none"><path d="M7 8C4.2 8 2 10.2 2 12s2.2 4 5 4c2.8 0 5-4 7-4s4.2 4 7 4c2.8 0 5-2.2 5-4s-2.2-4-5-4c-2.8 0-4.2 4-7 4S9.8 8 7 8Z" stroke="url(#g5)" stroke-width="1.6"/><defs><linearGradient id="g5" x1="2" y1="12" x2="22" y2="12"><stop stop-color="#3545d6"/><stop offset="1" stop-color="#c2f750"/></linearGradient></defs></svg>
            <span class="platform-chip">TikTok Shop</span>
          </div>
        </div>
      </div>

      <div class="hero-visual">
        <div class="glow"></div>
        <div class="device-frame">
          <img src="{{ asset('assets/reengage2/reengage2-image-2.png') }}" alt="TSScout product research dashboard showing sell-through rate, listings and average price">
        </div>
        <div class="device-tag">Sell Through: 3,439%</div>
        <div class="device-tag2">Live eBay data</div>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROBLEM ============ -->
<section class="section problem" id="problem">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow" style="color:var(--blue)">The real cost of guessing</span>
      <h2>Why sellers lose money without data</h2>
      <p>Every one of these is a data problem, not a hustle problem.</p>
    </div>
    <div class="problem-grid">
      <div class="problem-card">
        <span class="num">01</span>
        <h3>Saturated products</h3>
        <p>Entering a niche because it looked promising — not because the numbers backed it up.</p>
      </div>
      <div class="problem-card">
        <span class="num">02</span>
        <h3>Listing blind</h3>
        <p>No visibility into how a product has actually sold, or at what price it converts.</p>
      </div>
      <div class="problem-card">
        <span class="num">03</span>
        <h3>Copying without context</h3>
        <p>Copying a competitor's listing without knowing if they're still profitable on it today.</p>
      </div>
      <div class="problem-card">
        <span class="num">04</span>
        <h3>Hours lost to manual checks</h3>
        <p>Tab-switching between six sites by hand just to validate one product idea.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ TOOLS BY PLATFORM ============ -->
<section class="section tools" id="tools">
  <div class="wrap">
    <div class="section-head">
      <span class="eyebrow">The premium toolkit</span>
      <h2>16 tools. Six marketplaces. One plan.</h2>
      <p>Every research tool TSScout offers, grouped by the platform it covers. No add-ons, no separate subscriptions.</p>
    </div>

    <div class="platform-tabs">
      <input class="ptab-input" type="radio" name="ptab" id="tab-ebay" checked>
      <label class="ptab" for="tab-ebay" onclick="showPanel('ebay')">eBay (6)</label>

      <input class="ptab-input" type="radio" name="ptab" id="tab-ali">
      <label class="ptab" for="tab-ali" onclick="showPanel('ali')">AliExpress (4)</label>

      <input class="ptab-input" type="radio" name="ptab" id="tab-amz">
      <label class="ptab" for="tab-amz" onclick="showPanel('amz')">Amazon (1)</label>

      <input class="ptab-input" type="radio" name="ptab" id="tab-wmt">
      <label class="ptab" for="tab-wmt" onclick="showPanel('wmt')">Walmart (1)</label>

      <input class="ptab-input" type="radio" name="ptab" id="tab-shop">
      <label class="ptab" for="tab-shop" onclick="showPanel('shop')">Shopify (3)</label>

      <input class="ptab-input" type="radio" name="ptab" id="tab-tt">
      <label class="ptab" for="tab-tt" onclick="showPanel('tt')">TikTok Shop (1)</label>
    </div>

    <div class="panels panel-group active" data-panel="ebay">
      <div class="tool-card"><span class="plat">eBay</span><h4>Product Insight</h4><p>See sales history, price bands and demand for any eBay product before you list it.</p></div>
      <div class="tool-card"><span class="plat">eBay</span><h4>RivalView</h4><p>Track what competing sellers are listing, pricing and moving right now.</p></div>
      <div class="tool-card"><span class="plat">eBay</span><h4>NicheFinder</h4><p>Surface categories with rising demand and room left to enter.</p></div>
      <div class="tool-card"><span class="plat">eBay</span><h4>TitleMaster</h4><p>Build keyword-rich titles from real buyer search terms.</p></div>
      <div class="tool-card"><span class="plat">eBay</span><h4>TopBay Picks</h4><p>A daily shortlist of eBay's best-selling items, refreshed automatically.</p></div>
      <div class="tool-card"><span class="plat">eBay</span><h4>BayTrends</h4><p>Follow seasonality and category trends before they peak.</p></div>
    </div>

    <div class="panels panel-group" data-panel="ali">
      <div class="tool-card"><span class="plat">AliExpress</span><h4>Express Insight</h4><p>Compare AliExpress supplier prices against what the product actually sells for.</p></div>
      <div class="tool-card"><span class="plat">AliExpress</span><h4>Supplier Scout</h4><p>Find and vet AliExpress suppliers by price, shipping time and rating.</p></div>
      <div class="tool-card"><span class="plat">AliExpress</span><h4>Express-Scan</h4><p>Bulk-check AliExpress listings against live marketplace demand.</p></div>
      <div class="tool-card"><span class="plat">AliExpress</span><h4>Express-Finder</h4><p>Match any product to its AliExpress source in one search.</p></div>
    </div>

    <div class="panels panel-group" data-panel="amz">
      <div class="tool-card"><span class="plat">Amazon</span><h4>Amazon Scanner</h4><p>Pull sales trends, ratings and supplier data for any Amazon listing before you decide to sell it.</p></div>
    </div>

    <div class="panels panel-group" data-panel="wmt">
      <div class="tool-card"><span class="plat">Walmart</span><h4>Walmart Scanner</h4><p>Track best-selling Walmart items and competitor activity in one view.</p></div>
    </div>


    <div class="panels panel-group" data-panel="shop">
      <div class="tool-card"><span class="plat">Shopify</span><h4>Shopify Insight</h4><p>Analyze any Shopify store's top products and estimated sales.</p></div>
      <div class="tool-card"><span class="plat">Shopify</span><h4>Shopify Spy</h4><p>See what independent Shopify stores are running, and how they're performing.</p></div>
      <div class="tool-card"><span class="plat">Shopify</span><h4>Shopify Store Finder</h4><p>Discover new and growing Shopify stores by niche.</p></div>
    </div>

    <div class="panels panel-group" data-panel="tt">
      <div class="tool-card"><span class="plat">TikTok Shop</span><h4>TikTrend Scan</h4><p>Catch TikTok Shop products trending before they saturate.</p></div>
    </div>
  </div>
</section>

<!-- ============ PROOF SCREENSHOT ============ -->
<section class="section proof">
  <div class="wrap">
    <div class="proof-grid">
      <div class="proof-shot">
        <img src="{{ asset('assets/reengage2/reengage2-image-1.jpg') }}" alt="TSScout eBay product research results for the keyword toys, showing seller, sales and price data">
      </div>
      <div class="proof-copy">
        <span class="eyebrow">Real product research, not mock-ups</span>
        <h2>See the exact numbers before you list</h2>
        <p style="color:var(--muted); font-size:16px; margin-top:12px;">Every search returns real sell-through rate, unit sales, price and seller location — so a listing decision takes minutes, not a spreadsheet.</p>
        <ul class="check-list">
          <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#e8f7d9"/><path d="M6 10.5l2.5 2.5L14 7" stroke="#4c8a13" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>Sell-through rate and units sold, by keyword or category</li>
          <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#e8f7d9"/><path d="M6 10.5l2.5 2.5L14 7" stroke="#4c8a13" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>Seller name, rating and country for every result</li>
          <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#e8f7d9"/><path d="M6 10.5l2.5 2.5L14 7" stroke="#4c8a13" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>Filterable, sortable tables you can export</li>
        </ul>
      </div>
    </div>

    <div class="proof-mosaic">
      <div class="proof-mosaic-head">
        <span class="eyebrow">Same depth, every platform</span>
        <h3>Not just eBay — the same real data on Amazon and Walmart too</h3>
      </div>
      <div class="proof-mosaic-grid">
        <figure class="mosaic-shot">
          <img src="{{ asset('assets/reengage2/reengage2-image-3.png') }}" alt="TSScout Amazon Scanner results for the keyword iphone, showing price, rating and reviews">
          <figcaption>Amazon Scanner — price, rating and review count for any keyword</figcaption>
        </figure>
        <figure class="mosaic-shot">
          <img src="{{ asset('assets/reengage2/reengage2-image-4.png') }}" alt="TSScout Walmart results for the keyword bags, showing price, rating and reviews">
          <figcaption>Walmart Scanner — best-selling items with live pricing</figcaption>
        </figure>
      </div>
    </div>
  </div>
</section>

<!-- ============ NO STORE CONNECTION ============ -->
<section class="section" style="padding-top:0;">
  <div class="wrap">
    <div class="privacy-banner">
      <div class="privacy-icon">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none"><path d="M12 2l8 3.5v6c0 5-3.4 8.7-8 10.5-4.6-1.8-8-5.5-8-10.5v-6L12 2Z" stroke="#c2f750" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 12l2 2 4-4.5" stroke="#c2f750" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div>
        <h3>We never touch your store</h3>
        <p>TSScout reads public marketplace data — listings, prices, sales signals. We never ask for your eBay, Amazon, Walmart, Shopify or TikTok Shop login, and nothing gets connected, synced, or given access to your orders or customer data. Nothing to revoke, ever.</p>
      </div>
      <div class="privacy-cta">
        <a href="https://app.tsscout.com/create-account/premium/2" class="btn btn-primary">Start for $1</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ COMPARISON ============ -->
<section class="section compare" id="compare">
  <div class="wrap">
    <div class="section-head center">
      <span class="eyebrow">How TSScout compares</span>
      <h2>One plan. Six marketplaces. No one else bundles them.</h2>
      <p>Every research tool sellers use today specializes in a slice of the market. TSScout is the only one built to cover all six in a single tier.</p>
    </div>
    <div class="compare-table-wrap">
      <table class="compare-table">
        <thead>
          <tr>
            <th style="background-color: #fff">Platform coverage</th>
            <th class="brand-col">TSScout</th>
            <th>ZIK Analytics</th>
            <th>Dropship.io</th>
            <th>Jungle Scout</th>
          </tr>
        </thead>
        <tbody>
          <tr><td style="background-color: #fff">eBay</td><td class="brand-col yes">✓ Full suite</td><td class="yes">✓ Full suite</td><td class="no">—</td><td class="no">—</td></tr>
          <tr><td style="background-color: #fff">AliExpress</td><td class="brand-col yes">✓ Full suite</td><td class="partial">Sourcing only</td><td class="no">—</td><td class="no">—</td></tr>
          <tr><td style="background-color: #fff">Amazon</td><td class="brand-col yes">✓ Full suite</td><td class="partial">Coming soon</td><td class="no">—</td><td class="yes">✓ Core focus</td></tr>
          <tr><td style="background-color: #fff">Walmart</td><td class="brand-col yes">✓ Full suite</td><td class="partial">Sourcing only</td><td class="no">—</td><td class="no">—</td></tr>
          <tr><td style="background-color: #fff">Shopify</td><td class="brand-col yes">✓ Full suite</td><td class="yes">✓ Full suite</td><td class="partial">Theme detector only</td><td class="no">—</td></tr>
          <tr><td style="background-color: #fff">TikTok Shop</td><td class="brand-col yes">✓ Full suite</td><td class="no">—</td><td class="yes">✓ Core focus</td><td class="no">—</td></tr>
          <tr><td style="background-color: #fff">Single-tier pricing</td><td class="brand-col yes">✓ $79.98/mo, everything included</td><td class="partial">Tiered by feature</td><td class="partial">Tiered by feature</td><td class="partial">Enterprise / quote-based</td></tr>
        </tbody>
      </table>
    </div>
    <p class="compare-note">Based on each provider's publicly listed features as of July 2026. "Sourcing only" means supplier price-matching, not full product/competitor research on that platform. </p>
  </div>
</section>

<!-- ============ PRICING ============ -->
<section class="section pricing" id="pricing">
  <div class="wrap">
    <div class="section-head center">
      <span class="eyebrow">Simple, single-tier pricing</span>
      <h2>Everything in one plan</h2>
    </div>

    <div class="price-card">
      <div class="price-left">
        <span class="price-badge">Premium Plan</span>
        <h3>Full platform access</h3>
        <div class="price-tag">
          <span class="cur">$</span><span class="amt">1</span>
          <span style="font-family:var(--mono); font-size:14px; color:#93a9bb;">today</span>
        </div>
        <p class="price-sub">then <b>$79.98/month</b> after a <b>14-day trial</b> — cancel anytime, no long-term contract.</p>
        <a href="https://app.tsscout.com/create-account/premium/2" class="btn btn-primary">Start for $1 →</a>
        <p class="price-fine">Full terms shown again before you enter payment details</p>
      </div>
      <div class="price-right">
        <p class="group-label">eBay</p>
        <div class="tool-pill-row">
          <span class="tool-pill">Product Insight</span><span class="tool-pill">RivalView</span><span class="tool-pill">NicheFinder</span><span class="tool-pill">TitleMaster</span><span class="tool-pill">TopBay Picks</span><span class="tool-pill">BayTrends</span>
        </div>
        <p class="group-label">AliExpress</p>
        <div class="tool-pill-row">
          <span class="tool-pill">Express Insight</span><span class="tool-pill">Supplier Scout</span><span class="tool-pill">Express-Scan</span><span class="tool-pill">Express-Finder</span>
        </div>
        <p class="group-label">Amazon · Walmart</p>
        <div class="tool-pill-row">
          <span class="tool-pill">Amazon Scanner</span><span class="tool-pill">Walmart Scanner</span>
        </div>
        <p class="group-label">Shopify</p>
        <div class="tool-pill-row">
          <span class="tool-pill">Shopify Insight</span><span class="tool-pill">Shopify Spy</span><span class="tool-pill">Shopify Store Finder</span>
        </div>
        <p class="group-label">TikTok Shop</p>
        <div class="tool-pill-row">
          <span class="tool-pill">TikTrend Scan</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SOCIAL PROOF (real, verified review) ============ -->
<section class="section social-proof">
  <div class="wrap">
    <div class="section-head center">
      <span class="eyebrow">Verified customer review</span>
      <h2>What one seller said, unprompted</h2>
      <p>We're a young platform — this is our first Trustpilot review, shown in full and unedited. <span class="dev-note">DEV: replace this single-card layout with a multi-review grid once 3+ verified reviews are in</span></p>
    </div>


    <div class="review-card">
      <div class="review-top">
        <div class="review-avatar">J</div>
        <div class="review-who">
          <strong>Jony David</strong>
          <span>EG · 1 review</span>
        </div>
        <div class="review-date">Jun 21, 2026</div>
      </div>
      <div class="review-stars" aria-label="5 out of 5 stars">★★★★★</div>
      <p class="review-body">"I had a very positive experience with TS Scout. Their product research service is professional, accurate, and very helpful for making informed business decisions. The team is responsive, knowledgeable, and always willing to provide support when needed. The information and insights provided were clear and valuable, helping me save time and improve my decision-making process. Communication was smooth, and the overall experience exceeded my expectations. I highly recommend TS Scout to anyone looking for reliable product research and excellent customer service."</p>
      <div class="review-tags">
        <span class="review-tag">Unprompted review</span>
        <span class="review-tag review-tag-tp">★ Trustpilot</span>
      </div>
    </div>

  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section faq" id="faq">
  <div class="wrap">
    <div class="section-head center">
      <span class="eyebrow">Questions</span>
      <h2>Frequently asked questions</h2>
    </div>
    <div class="faq-list">
      <details class="faq-item" open>
        <summary>Do I need to connect my store or give TSScout access to my accounts?<span class="plus">+</span></summary>
        <p>No. TSScout only reads public marketplace and storefront data. We never ask for logins to your eBay, Amazon, Walmart, Shopify or TikTok Shop accounts, and we never need access to your orders, customers or payment details.</p>
      </details>
      <details class="faq-item">
        <summary>What happens after my $1 trial?<span class="plus">+</span></summary>
        <p>Your $1 trial runs for 14 days with full access to every tool. After that, your plan continues at $79.98/month unless you cancel before the trial ends. You can cancel anytime from your account settings — no phone calls required.</p>
      </details>
      <details class="faq-item">
        <summary>Which marketplaces does the Premium plan cover?<span class="plus">+</span></summary>
        <p>All six: eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop — with all 16 tools included. There's no add-on tier or separate purchase for any platform.</p>
      </details>
      <details class="faq-item">
        <summary>Is there one plan, or several tiers?<span class="plus">+</span></summary>
        <p>TSScout Premium is a single plan with everything included. </p>
      </details>
      <details class="faq-item">
        <summary>Can I cancel anytime?<span class="plus">+</span></summary>
        <p>Yes. Cancel anytime from your account settings, effective at the end of your current billing period. No cancellation fees.</p>
      </details>
      <details class="faq-item">
        <summary>How current is the sales data?<span class="plus">+</span></summary>
        <p><span class="dev-note">DEV: confirm actual refresh cadence per tool (real-time / daily / etc.) before publishing — placeholder removed intentionally to avoid an inaccurate claim</span></p>
      </details>
    </div>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="final-cta">
  <div class="wrap">
    <span class="eyebrow" style="color:var(--lime)">Ready when you are</span>
    <h2>Stop guessing. Start with the data.</h2>
    <p>Six marketplaces, sixteen tools, one login — for $1 today.</p>
    <a href="https://app.tsscout.com/create-account/premium/2" class="btn btn-primary">Start for $1 →</a>
    <div class="trial-terms">
      <b>$1 today</b><span class="dot">·</span>then <b>$79.98/mo</b> after 14 days<span class="dot">·</span>cancel anytime
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('assets/reengage2/reengage2-image-5.png') }}" alt="TSScout">
        <p>Cross-marketplace product and competitor research for eBay, AliExpress, Amazon, Walmart, Shopify and TikTok Shop sellers.</p>
      </div>
      <div class="footer-cols">
        <div class="footer-col">
          <h5>Product</h5>
          <a href="#tools">Tools</a>
          <a href="#compare">Compare</a>
          <a href="#pricing">Pricing</a>
        </div>
        <div class="footer-col">
          <h5>Company</h5>
          <a href="#">About</a>
          <a href="#">Contact</a>
          <a href="#">Affiliate program</a>
        </div>
        <div class="footer-col">
          <h5>Legal</h5>
          <a href="#">Terms of use</a>
          <a href="#">Privacy policy</a>
          <a href="#">Refund policy</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 TSScout. All rights reserved.</span>
      <span>$1 today, then $79.98/month after a 14-day trial. Cancel anytime.</span>
    </div>
  </div>
</footer>

<script>
function showPanel(name){
  document.querySelectorAll('.panel-group').forEach(function(p){
    p.classList.toggle('active', p.getAttribute('data-panel') === name);
  });
}
</script>

</body>
</html>
