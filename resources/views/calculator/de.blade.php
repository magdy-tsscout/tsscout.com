@extends('layouts.master')
@section('title','DE eBay Fee Calculator')

@section('styles')
<style>
:root { --calc-blue:#1a6fc4; --calc-green:#22a06b; --calc-orange:#e07b00; --calc-purple:#7b5ea7; --calc-bg:#f4f6fb; --calc-border:#dde2ee; --calc-radius:12px; --calc-shadow:0 2px 12px rgba(0,0,0,.08); }
.flags a { display:inline !important; }
#calculateFeesForm .card { border:none; border-radius:var(--calc-radius); box-shadow:var(--calc-shadow); background:#fff; }
#calculateFeesForm .card-body { padding:1.75rem; }
#calculateFeesForm .card-footer { background:var(--calc-bg); border-top:1px solid var(--calc-border); border-radius:0 0 var(--calc-radius) var(--calc-radius); padding:.9rem 1.75rem; }
#calculateFeesForm label { font-weight:600; font-size:.82rem; letter-spacing:.4px; text-transform:uppercase; color:#5a6480; margin-bottom:.3rem; }
#calculateFeesForm .form-control { border-radius:8px; border-color:var(--calc-border); font-size:.95rem; transition:border-color .2s,box-shadow .2s; }
#calculateFeesForm .form-control:focus { border-color:var(--calc-blue); box-shadow:0 0 0 3px rgba(26,111,196,.15); }
#calculateFeesForm .border-bottom { border-color:var(--calc-border) !important; margin-top:.4rem; }
#calculateFeesForm button[type=submit] { background:var(--calc-blue); border:none; border-radius:8px; padding:.55rem 1.8rem; font-weight:600; letter-spacing:.4px; font-size:.95rem; transition:background .2s,transform .1s; }
#calculateFeesForm button[type=submit]:hover { background:#155fa0; transform:translateY(-1px); }
#calculateFeesForm button[type=submit]:active { transform:translateY(0); }
.calc-results { margin-top:1.75rem; animation:fadeUp .35s ease; }
@keyframes fadeUp { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
.calc-results__title { font-weight:700; color:#3a4060; font-size:1rem; letter-spacing:.5px; text-transform:uppercase; margin-bottom:1rem; padding-left:2px; }
.calc-results__grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1rem; }
@media(max-width:768px){ .calc-results__grid{ grid-template-columns:1fr; } }
.calc-card { background:#fff; border-radius:var(--calc-radius); box-shadow:var(--calc-shadow); padding:1.4rem 1.5rem; border-top:4px solid var(--calc-border); transition:transform .2s; }
.calc-card:hover { transform:translateY(-3px); }
.calc-card--fee { border-top-color:var(--calc-orange); } .calc-card--tax { border-top-color:var(--calc-purple); } .calc-card--profit { border-top-color:var(--calc-green); }
.calc-card__icon { font-size:1.6rem; margin-bottom:.4rem; }
.calc-card__label { font-size:.78rem; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#7a82a0; margin-bottom:.2rem; }
.calc-card__value { font-size:1.9rem; font-weight:700; color:#1e2540; margin-bottom:.8rem; }
.calc-card--fee .calc-card__value { color:var(--calc-orange); } .calc-card--tax .calc-card__value { color:var(--calc-purple); } .calc-card--profit .calc-card__value { color:var(--calc-green); }
.calc-card__breakdown { list-style:none; padding:0; margin:0; border-top:1px solid var(--calc-border); padding-top:.7rem; }
.calc-card__breakdown li { display:flex; justify-content:space-between; font-size:.85rem; color:#5a6480; padding:.2rem 0; }
.calc-card__breakdown li strong { color:#1e2540; }
.calc-card__note { font-size:.83rem; color:#7a82a0; margin:0; border-top:1px solid var(--calc-border); padding-top:.6rem; }
.calc-card__note strong { color:#1e2540; }
.ebay-calc-container { display:flex; flex-direction:column; gap:5px; }
.flags-container { flex-shrink:1; justify-content:center; align-items:center; display:flex; }
.flags { background-image:linear-gradient(#fff,#efefef); border:1px solid #ccc; padding:3px 10px; border-radius:10px; width:fit-content; margin-bottom:15px; }
.flags a { border-radius:10px; margin-right:5px; padding-right:5px; padding-left:5px; }
.flags a:last-child { margin-right:0 !important; }
.flags a.active { border:1px solid rgba(61,82,14,.4); color:#3c520e; }
.flags a img { position:relative; top:-2px; }
.form-container { flex-grow:1; }
@media(max-width:992px){
    .ebay-calc-container{ flex-direction:row; } .flags-container{ align-items:start; }
    .flags{ background-image:linear-gradient(to bottom,#fff,#efefef); display:flex; flex-direction:column; margin-bottom:15px; }
    .flags a{ display:block !important; margin-right:0; margin-bottom:15px; padding:0; position:relative; opacity:.5; }
    .flags a.active{ border-top:0; border-right:0; border-left:0; border-bottom-width:3px; border-bottom-color:#333; border-radius:0; opacity:1; }
    .flags a.active::after{ content:''; width:0; height:0; border-top:5px solid transparent; border-left:10px solid #555; border-bottom:5px solid transparent; position:absolute; margin-left:47px; z-index:9; margin-top:-21px; }
    .flags a img{ width:36px; height:36px; top:0; } .flags a span{ display:none; }
}
</style>
@endsection

@section('content')
<header class="mt-2"></header>
<div class="container mb-4">

    <div class="ebay-calc-container">
        <h2 class="text-center mb-2">{{ $ebay_title }}</h2>
        <div class="flags-container">
            <div class="flags">
                @include('calculator/flag-btns')
            </div>
        </div>

        <div class="form-container">
            <form id="calculateFeesForm" onsubmit="calculateFees(event)">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <!-- Sold Price -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sales_price">Sold Price (€)</label>
                                    <input type="text" id="sales_price" name="sales_price" class="form-control" value="100">
                                </div>
                            </div>

                            <!-- Shipping Charged to Buyer -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_charged">Shipping Charged to Buyer (€)</label>
                                    <input type="text" id="shipping_charged" name="shipping_charged" class="form-control" value="0">
                                    <small>The amount you charge your buyer for shipping</small>
                                </div>
                            </div>

                            <!-- Item Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost incl. VAT (€)</label>
                                    <input type="text" id="item_cost" name="item_cost" class="form-control" value="">
                                    <small>Includes VAT that you paid for the item</small>
                                </div>
                            </div>

                            <!-- Shipping Cost Paid -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_cost_paid">Shipping Cost Paid incl. VAT (€)</label>
                                    <input type="text" id="shipping_cost_paid" name="shipping_cost_paid" class="form-control" value="">
                                    <small>Includes VAT that you paid for shipping</small>
                                </div>
                            </div>

                            <!-- Seller Type -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="seller_type">Seller Type</label>
                                    <select id="seller_type" name="seller_type" class="form-control">
                                        <option value="Private" selected>Private (Privatverkäufer)</option>
                                        <option value="Commercial">Commercial (Gewerblicher Verkäufer)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Number of Orders -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_count">Number of Orders</label>
                                    <input type="number" id="order_count" name="order_count" class="form-control" value="1" min="1">
                                </div>
                            </div>

                            <!-- eBay Shop (commercial only) -->
                            <div class="col-lg-4" id="ebay_shop_container" style="display:none;">
                                <div class="form-group">
                                    <label for="ebay_shop">eBay Shop Subscription?</label>
                                    <select id="ebay_shop" name="ebay_shop" class="form-control">
                                        <option value="No">No Shop</option>
                                        <option value="Yes">Yes (Basic / Top / Premium / Platinum)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Category (commercial only) -->
                            <div class="col-lg-12" id="category_container" style="display:none;">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @include('calculator/de-categories')
                                </div>
                            </div>

                            <!-- International Distribution -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="international_distribution">International Sales?</label>
                                    <select id="international_distribution" name="international_distribution" class="form-control">
                                        <option value="Eurozone and Sweden" selected>Eurozone &amp; Sweden (domestic — 0% intl. fee)</option>
                                        <option value="Europe, USA and Canada">Europe, USA &amp; Canada</option>
                                        <option value="UK">UK</option>
                                        <option value="Other">Other Countries</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Promotions -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="promotions">Promotions?</label>
                                    <select id="promotions" name="promotions" class="form-control">
                                        <option value="No">No</option>
                                        <option value="discount">% Discount on Sales Commission</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Discount % (conditional) -->
                            <div class="col-lg-4" id="discount_percentage_container" style="display:none;">
                                <div class="form-group">
                                    <label for="discount_percentage">Discount Percentage (%)</label>
                                    <input type="number" id="discount_percentage" name="discount_percentage" class="form-control" min="0" max="100" step="0.1">
                                </div>
                            </div>

                            <!-- VAT % (commercial only) -->
                            <div class="col-lg-4" id="vat_percentage_container" style="display:none;">
                                <div class="form-group">
                                    <label for="vat_percentage">VAT Rate on Items Sold (%)</label>
                                    <input type="number" id="vat_percentage" name="vat_percentage" class="form-control" value="19" min="0" step="0.01">
                                    <small>Used for VAT breakdown in profit calculation</small>
                                </div>
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.card-body -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mt-1">Calculate Fees</button>
                        <button type="button" class="btn btn-outline-secondary mt-1 ml-2" onclick="var el=document.getElementById('how-it-works');el.classList.toggle('d-none');if(!el.classList.contains('d-none'))el.scrollIntoView({behavior:'smooth',block:'start'});" title="How is this calculated?">
                            &#63; How it works
                        </button>
                    </div>

                    <!-- How it works explanation -->
                    <div id="how-it-works" class="d-none px-4 py-3" style="background:#fff;border-top:1px solid #dee2e6;font-size:.9rem;">
                        <h6 class="font-weight-bold mb-3">How eBay Germany Fees Are Calculated</h6>

                        <p class="mb-2"><strong>Final Value Fee (FVF)</strong> &mdash; the main eBay fee, charged as a percentage of the total sale amount (selling price + shipping charged to buyer). Rates are tiered and vary by category. All rates include 19% German VAT (MwSt) already. Example rates:</p>
                        <ul class="mb-3">
                            <li><strong>Most categories:</strong> 11% up to &euro;990, then 2% above</li>
                            <li><strong>Clothing (fashion):</strong> 12% up to &euro;990, then 2%</li>
                            <li><strong>Garden (no store):</strong> 12% up to &euro;200, then 2%</li>
                            <li><strong>Home appliances / Phones / Cameras / Games consoles:</strong> 6.5% up to &euro;200&ndash;&euro;300, then 2%</li>
                            <li><strong>Jewellery:</strong> 14% up to &euro;400, then 2%</li>
                            <li><strong>Tickets / Movies / Music / Games:</strong> 9% up to &euro;990, then 2%</li>
                            <li><strong>NFTs / Digital collectibles:</strong> 5% flat</li>
                            <li>Having an eBay Shop raises the tier ceiling to &euro;990 for most categories.</li>
                        </ul>

                        <p class="mb-2"><strong>Private sellers</strong> &mdash; pay 0% FVF when selling within the Eurozone. For international sales, the standard 11%/&euro;990 + 2% tiers apply.</p>

                        <p class="mb-2"><strong>FVF Promotions</strong> &mdash; eBay Germany occasionally offers a % discount off your FVF. Enter the discount % when shown in your account. The discounted amount is shown as a saving in results.</p>

                        <p class="mb-2"><strong>International Fee</strong> &mdash; extra % on the total sale when selling to buyers outside Germany:</p>
                        <ul class="mb-3">
                            <li>Eurozone &amp; Sweden: 0%</li>
                            <li>Europe, USA &amp; Canada: 1.91% (private) / 1.6% (commercial)</li>
                            <li>UK: 1.43% (private) / 1.2% (commercial)</li>
                            <li>Other countries: 3.93% (private) / 3.3% (commercial)</li>
                        </ul>

                        <p class="mb-2"><strong>VAT on Selling Price</strong> (commercial sellers only) &mdash; shows how much of your selling price is VAT collected on behalf of the tax authority. Calculated as: <code>Price &times; VAT% &divide; (100 + VAT%)</code>. This is already included in what the buyer pays &mdash; it is not an extra charge.</p>

                        <p class="mb-0"><strong>Profit</strong> = Total Revenue &minus; All eBay Fees &minus; Item Cost &minus; Shipping Paid. The margin % is profit as a share of total revenue.</p>
                    </div>
                </div><!-- /.card -->

                <!-- Results -->
                <div id="results-section" class="calc-results" style="display:none;">
                    <h5 class="calc-results__title">Results <small class="text-muted" style="font-size:.75rem;font-weight:400;">In EUR</small></h5>
                    <div class="calc-results__grid">

                        <div class="calc-card calc-card--fee">
                            <div class="calc-card__icon">&#128722;</div>
                            <div class="calc-card__label">Total eBay Fee (incl. MwSt.)</div>
                            <div class="calc-card__value" id="result-ebay-fee">-</div>
                            <ul class="calc-card__breakdown">
                                <li><span>FVF (incl. 19% MwSt.)</span><strong id="result-fvf">-</strong></li>
                                <li><span>FVF rate</span><strong id="result-fvf-rate">-</strong></li>
                                <li id="result-intl-row" style="display:none;"><span>International fee</span><strong id="result-intl-fee">-</strong></li>
                                <li id="result-promo-row" style="display:none;"><span>Promotion discount saved</span><strong id="result-promo-saving">-</strong></li>
                            </ul>
                        </div>

                        <div class="calc-card calc-card--tax">
                            <div class="calc-card__icon">&#128196;</div>
                            <div class="calc-card__label">VAT on Selling Price</div>
                            <div class="calc-card__value" id="result-vat">-</div>
                            <p class="calc-card__note" id="result-vat-note">Collected from buyer</p>
                        </div>

                        <div class="calc-card calc-card--profit">
                            <div class="calc-card__icon">&#128200;</div>
                            <div class="calc-card__label">Total Profit</div>
                            <div class="calc-card__value" id="result-total-profit">-</div>
                            <p class="calc-card__note">Margin: <strong id="result-profit-margin">-</strong></p>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
// ─── DE FVF rate table (commercial sellers) ───────────────────────────────────
// Rates already include 19% MwSt. per eBay.de
// Structure: { noShop: [[rate, upTo?], …], shop: [[rate, upTo?], …] }
const DE_RATES = {
    de_default:           { noShop: [[0.11, 990], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_antiques:          { noShop: [[0.11, 990], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_nft:               { noShop: [[0.05]],              shop: [[0.05]] },
    de_clothing:          { noShop: [[0.12, 990], [0.02]], shop: [[0.12, 990], [0.02]] },
    de_garden:            { noShop: [[0.12, 200], [0.02]], shop: [[0.12, 990], [0.02]] },
    de_home_appliances:   { noShop: [[0.065, 200],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_tickets:           { noShop: [[0.09, 990], [0.02]], shop: [[0.09, 990], [0.02]] },
    de_music_instruments: { noShop: [[0.11, 300], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_motors_elec:       { noShop: [[0.065, 300],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_motors_tires:      { noShop: [[0.065, 990],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_motors_clothing:   { noShop: [[0.11, 990], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_motors_wallbox:    { noShop: [[0.12, 300], [0.02]], shop: [[0.065, 990],[0.02]] },
    de_motors_other:      { noShop: [[0.12, 990], [0.02]], shop: [[0.12, 990], [0.02]] },
    de_beauty_elec:       { noShop: [[0.065, 300],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_beauty_devices:    { noShop: [[0.11, 200], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_beauty_other:      { noShop: [[0.11, 990], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_computer_acc:      { noShop: [[0.11, 200], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_computer_main:     { noShop: [[0.065, 200],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_movies_nft:        { noShop: [[0.05]],              shop: [[0.05]] },
    de_movies:            { noShop: [[0.09, 990], [0.02]], shop: [[0.09, 990], [0.02]] },
    de_photo_cameras:     { noShop: [[0.11, 200], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_photo_other:       { noShop: [[0.065, 300],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_phones_acc:        { noShop: [[0.11, 300], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_phones_main:       { noShop: [[0.065, 300],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_music_nft:         { noShop: [[0.05]],              shop: [[0.05]] },
    de_music:             { noShop: [[0.09, 990], [0.02]], shop: [[0.09, 990], [0.02]] },
    de_games_acc:         { noShop: [[0.11, 300], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_games_consoles:    { noShop: [[0.065, 300],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_games_games:       { noShop: [[0.09, 990], [0.02]], shop: [[0.09, 990], [0.02]] },
    de_collectibles_nft:  { noShop: [[0.05]],              shop: [[0.05]] },
    de_collectibles:      { noShop: [[0.11, 990], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_tv_acc:            { noShop: [[0.11, 200], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_tv_main:           { noShop: [[0.065, 300],[0.02]], shop: [[0.065, 990],[0.02]] },
    de_watches:           { noShop: [[0.11, 400], [0.02]], shop: [[0.11, 990], [0.02]] },
    de_jewelry:           { noShop: [[0.14, 400], [0.02]], shop: [[0.14, 990], [0.02]] },
};

// ─── International fee rates ──────────────────────────────────────────────────
const INTL_RATES = {
    'Eurozone and Sweden':    { Private: 0,      Commercial: 0 },
    'Europe, USA and Canada': { Private: 0.0191, Commercial: 0.016 },
    'UK':                     { Private: 0.0143, Commercial: 0.012 },
    'Other':                  { Private: 0.0393, Commercial: 0.033 },
};

// ─── Dynamic field visibility ─────────────────────────────────────────────────
(function () {
    const sellerTypeEl = document.getElementById('seller_type');
    const promotionsEl = document.getElementById('promotions');
    const shopWrap     = document.getElementById('ebay_shop_container');
    const catWrap      = document.getElementById('category_container');
    const vatWrap      = document.getElementById('vat_percentage_container');
    const discountWrap = document.getElementById('discount_percentage_container');

    function syncSellerType() {
        const isCommercial = sellerTypeEl.value === 'Commercial';
        shopWrap.style.display = isCommercial ? '' : 'none';
        catWrap.style.display  = isCommercial ? '' : 'none';
        vatWrap.style.display  = isCommercial ? '' : 'none';
    }

    function syncPromotions() {
        discountWrap.style.display = promotionsEl.value !== 'No' ? '' : 'none';
    }

    sellerTypeEl.addEventListener('change', syncSellerType);
    promotionsEl.addEventListener('change', syncPromotions);
    syncSellerType();
    syncPromotions();
})();

// ─── Tiered fee helper ────────────────────────────────────────────────────────
function tieredFee(amount, tiers) {
    let fee = 0, prev = 0;
    for (const tier of tiers) {
        const [rate, upTo] = tier;
        if (upTo !== undefined) {
            const portion = Math.max(0, Math.min(amount, upTo) - prev);
            fee += portion * rate;
            prev = upTo;
        } else {
            fee += Math.max(0, amount - prev) * rate;
        }
    }
    return fee;
}

// ─── Main calculate function ──────────────────────────────────────────────────
function calculateFees(event) {
    event.preventDefault();

    const soldPrice        = parseFloat(document.getElementById('sales_price').value)           || 0;
    const shippingCharged  = parseFloat(document.getElementById('shipping_charged').value)      || 0;
    const itemCost         = parseFloat(document.getElementById('item_cost').value)             || 0;
    const shippingCostPaid = parseFloat(document.getElementById('shipping_cost_paid').value)    || 0;
    const sellerType       = document.getElementById('seller_type').value;
    const orderCount       = Math.max(1, parseInt(document.getElementById('order_count').value) || 1);
    const hasShop          = document.getElementById('ebay_shop').value === 'Yes';
    const category         = document.getElementById('category').value;
    const intlKey          = document.getElementById('international_distribution').value;
    const promotions       = document.getElementById('promotions').value;
    const discountPct      = parseFloat(document.getElementById('discount_percentage').value)   || 0;
    const vatPct           = parseFloat(document.getElementById('vat_percentage').value)        || 19;

    const totalSaleAmount  = soldPrice + shippingCharged;
    const isCommercial     = sellerType === 'Commercial';

    // ── FVF ───────────────────────────────────────────────────────────────────
    let rawFVF = 0;
    if (!isCommercial) {
        // Private: 0% for Eurozone/Sweden; 11%/€990 + 2% for others
        if (intlKey !== 'Eurozone and Sweden') {
            rawFVF = tieredFee(totalSaleAmount, [[0.11, 990], [0.02]]);
        }
    } else {
        const catRates = DE_RATES[category] || DE_RATES['de_default'];
        const tiers    = hasShop ? catRates.shop : catRates.noShop;
        rawFVF = tieredFee(totalSaleAmount, tiers);
    }

    // ── Promotion discount ────────────────────────────────────────────────────
    const promoSaving   = promotions !== 'No' ? rawFVF * (discountPct / 100) : 0;
    const fvfAfterPromo = rawFVF - promoSaving;

    // ── International fee ─────────────────────────────────────────────────────
    const intlRates = INTL_RATES[intlKey] || { Private: 0, Commercial: 0 };
    const intlRate  = isCommercial ? intlRates.Commercial : intlRates.Private;
    const intlFee   = totalSaleAmount * intlRate;

    // ── Totals ────────────────────────────────────────────────────────────────
    const totalFVFAllOrders = fvfAfterPromo * orderCount;
    const totalIntlFee      = intlFee * orderCount;
    const totalEbayFee      = totalFVFAllOrders + totalIntlFee;

    // ── VAT on selling price (commercial accounting) ──────────────────────────
    const vatAmount = isCommercial
        ? (soldPrice * orderCount) * (vatPct / (100 + vatPct))
        : 0;

    // ── Profit ────────────────────────────────────────────────────────────────
    const totalRevenue = totalSaleAmount * orderCount;
    const totalCosts   = (itemCost + shippingCostPaid) * orderCount;
    const totalProfit  = totalRevenue - totalEbayFee - totalCosts;
    const profitMargin = totalRevenue > 0 ? (totalProfit / totalRevenue) * 100 : 0;
    const fvfRate      = totalSaleAmount > 0 ? (fvfAfterPromo / totalSaleAmount) * 100 : 0;

    // ── Render ────────────────────────────────────────────────────────────────
    const fmt = n => '€' + n.toFixed(2);

    document.getElementById('result-ebay-fee').textContent      = fmt(totalEbayFee);
    document.getElementById('result-fvf').textContent           = fmt(totalFVFAllOrders);
    document.getElementById('result-fvf-rate').textContent      = fvfRate.toFixed(2) + '%';
    document.getElementById('result-vat').textContent           = isCommercial ? fmt(vatAmount) : '—';
    document.getElementById('result-vat-note').textContent      = isCommercial
        ? 'VAT component of gross selling price'
        : 'N/A for private sellers';
    document.getElementById('result-total-profit').textContent   = fmt(totalProfit);
    document.getElementById('result-profit-margin').textContent  = profitMargin.toFixed(2) + '% of revenue';

    function setRow(rowId, valId, val, show) {
        document.getElementById(rowId).style.display = show ? '' : 'none';
        if (show) document.getElementById(valId).textContent = fmt(val);
    }

    setRow('result-intl-row',  'result-intl-fee',     totalIntlFee,             totalIntlFee > 0);
    setRow('result-promo-row', 'result-promo-saving',  promoSaving * orderCount, promoSaving  > 0);

    const resultsEl = document.getElementById('results-section');
    resultsEl.style.display = '';
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
@endsection
