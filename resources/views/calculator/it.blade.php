@extends('layouts.master')
@section('title','IT eBay Fee Calculator')

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

                            <!-- Category (commercial only) -->
                            <div class="col-lg-12" id="category_container" style="display:none;">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @include('calculator/it-categories')
                                </div>
                            </div>

                            <!-- Selling Price -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="selling_price">Selling Price (€)</label>
                                    <input type="text" id="selling_price" name="selling_price" class="form-control" value="100">
                                </div>
                            </div>

                            <!-- Shipping Cost charged -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_cost">Shipping Charged to Buyer (€)</label>
                                    <input type="text" id="shipping_cost" name="shipping_cost" class="form-control" value="0">
                                    <small class="form-text text-muted">The amount charged to the buyer for shipping</small>
                                </div>
                            </div>

                            <!-- Item Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost incl. VAT (€)</label>
                                    <input type="text" id="item_cost" name="item_cost" class="form-control" value="">
                                    <small class="form-text text-muted">Includes the VAT you paid for the item</small>
                                </div>
                            </div>

                            <!-- Shipping Cost Paid -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_cost_paid">Shipping Cost Paid incl. VAT (€)</label>
                                    <input type="text" id="shipping_cost_paid" name="shipping_cost_paid" class="form-control" value="">
                                    <small class="form-text text-muted">Includes the VAT you paid for shipping</small>
                                </div>
                            </div>

                            <!-- Number of Orders -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_no">No. of Orders</label>
                                    <input type="number" id="order_no" name="order_no" class="form-control" value="1" min="1">
                                </div>
                            </div>

                            <!-- Seller Type -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="seller_type">Type of Seller</label>
                                    <select id="seller_type" name="seller_type" class="form-control">
                                        <option value="Private" selected>Private (5% flat rate)</option>
                                        <option value="Commercial">Commercial (Pro / Business)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- International Sales -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="international_sales">International Sales</label>
                                    <select id="international_sales" name="international_sales" class="form-control">
                                        <option value="No" selected>No (Domestic)</option>
                                        <option value="Eurozone and Sweden">Eurozone &amp; Sweden (0%)</option>
                                        <option value="Europe, USA and Canada">Europe, USA &amp; Canada</option>
                                        <option value="GB">GB (United Kingdom)</option>
                                        <option value="Other Countries">All other countries</option>
                                    </select>
                                </div>
                            </div>

                            <!-- FVF Promotion (private only) -->
                            <div class="col-lg-4" id="fvf_promotion_container">
                                <div class="form-group">
                                    <label for="fvf_promotion">FVF Promotion</label>
                                    <select id="fvf_promotion" name="fvf_promotion" class="form-control">
                                        <option value="No" selected>No</option>
                                        <option value="max1">Max of €1 FVF</option>
                                        <option value="max2">Max of €2 FVF</option>
                                        <option value="pct5">5% FVF</option>
                                    </select>
                                </div>
                            </div>

                            <!-- VAT % (commercial only) -->
                            <div class="col-lg-4" id="vat_container" style="display:none;">
                                <div class="form-group">
                                    <label for="vat">VAT Rate on Items Sold (%)</label>
                                    <input type="number" id="vat" name="vat" class="form-control" value="22" min="0" step="0.01">
                                    <small>Used for VAT breakdown in profit calculation</small>
                                </div>
                            </div>

                            <!-- Sponsored Listing Rate -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sponsored_listing_rate">Sponsored Listing Rate (%)</label>
                                    <input type="number" id="sponsored_listing_rate" name="sponsored_listing_rate" class="form-control" value="" min="0" step="0.1">
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
                        <h6 class="font-weight-bold mb-3">How eBay Italy Fees Are Calculated</h6>

                        <p class="mb-2"><strong>Final Value Fee (FVF)</strong> — the main eBay fee, charged as a percentage of the total sale amount (selling price + shipping charged to buyer):</p>
                        <ul class="mb-3">
                            <li><strong>Private seller:</strong> 5% on everything. Optional promotions let you cap your FVF at €1 or €2 per item.</li>
                            <li><strong>Commercial seller:</strong> rate depends on category — e.g. 6.5% for phones &amp; laptops, 8.5% for tech accessories, 12% for vehicle clothing, 11% for everything else. Tires use a tiered rate: 6.5% up to €500, then 2% above.</li>
                            <li>All rates already include 22% Italian VAT (IVA) charged by eBay on their fees.</li>
                        </ul>

                        <p class="mb-2"><strong>Transaction Fee</strong> — eBay charges €0.35 per order placed (fixed, regardless of sale value). Multiply by number of orders.</p>

                        <p class="mb-2"><strong>International Fee</strong> — an extra % applied when you sell to buyers outside Italy:</p>
                        <ul class="mb-3">
                            <li>Eurozone &amp; Sweden: 0% (no extra charge)</li>
                            <li>Europe, USA &amp; Canada: 1.95% (private) / 1.6% (commercial)</li>
                            <li>United Kingdom: 1.46% (private) / 1.2% (commercial)</li>
                            <li>All other countries: 4.03% (private) / 3.3% (commercial)</li>
                        </ul>

                        <p class="mb-2"><strong>Sponsored Listing Rate</strong> — if you use eBay Promoted Listings, enter the ad rate (%) you selected. This is charged as a % of the total sale amount when the item sells via the ad.</p>

                        <p class="mb-2"><strong>VAT on Selling Price</strong> (commercial sellers only) — shows how much of your selling price is VAT collected on behalf of the tax authority. Calculated as: <code>Price × VAT% ÷ (100 + VAT%)</code>. This is not an extra charge — it is already included in what the buyer pays.</p>

                        <p class="mb-0"><strong>Profit</strong> = Total Revenue (selling price + shipping charged) − All eBay Fees − Item Cost − Shipping You Paid. The margin % is profit as a share of total revenue.</p>
                    </div>
                </div><!-- /.card -->

                <!-- Results -->
                <div id="results-section" class="calc-results" style="display:none;">
                    <h5 class="calc-results__title">Results <small class="text-muted" style="font-size:.75rem;font-weight:400;">In EUR (incl. 22% VAT on fees)</small></h5>
                    <div class="calc-results__grid">

                        <div class="calc-card calc-card--fee">
                            <div class="calc-card__icon">&#128722;</div>
                            <div class="calc-card__label">Total eBay Fee (incl. VAT)</div>
                            <div class="calc-card__value" id="result-ebay-fee">-</div>
                            <ul class="calc-card__breakdown">
                                <li><span>FVF (incl. 22% VAT)</span><strong id="result-fvf">-</strong></li>
                                <li><span>FVF rate</span><strong id="result-fvf-rate">-</strong></li>
                                <li><span>Transaction fee (€0.35/order)</span><strong id="result-txn-fee">-</strong></li>
                                <li id="result-sponsored-row" style="display:none;"><span>Sponsored listing</span><strong id="result-sponsored-fee">-</strong></li>
                                <li id="result-intl-row" style="display:none;"><span>International fee</span><strong id="result-intl-fee">-</strong></li>
                            </ul>
                        </div>

                        <div class="calc-card calc-card--tax">
                            <div class="calc-card__icon">&#128196;</div>
                            <div class="calc-card__label">VAT on Selling Price</div>
                            <div class="calc-card__value" id="result-iva">-</div>
                            <p class="calc-card__note" id="result-iva-note">Collected from buyer</p>
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
// ─── IT FVF rate table (commercial sellers, incl. 22% IVA) ────────────────────
// Structure: [[rate, upTo?], …]
const IT_RATES = {
    it_default:          [[0.11]],
    it_tech_devices:     [[0.065]],
    it_tech_acc:         [[0.085]],
    it_tires:            [[0.065, 500], [0.02]],
    it_vehicle_clothing: [[0.12]],
    it_vehicle_parts:    [[0.11]],
    it_home_fmcg:        [[0.11]],
};

// ─── International fee rates ──────────────────────────────────────────────────
const INTL_RATES = {
    Private: {
        'No':                    0,
        'Eurozone and Sweden':   0,
        'Europe, USA and Canada':0.0195,
        'GB':                    0.0146,
        'Other Countries':       0.0403,
    },
    Commercial: {
        'No':                    0,
        'Eurozone and Sweden':   0,
        'Europe, USA and Canada':0.016,
        'GB':                    0.012,
        'Other Countries':       0.033,
    },
};

// ─── Dynamic field visibility ─────────────────────────────────────────────────
(function () {
    const sellerTypeEl = document.getElementById('seller_type');
    const catWrap      = document.getElementById('category_container');
    const fvfWrap      = document.getElementById('fvf_promotion_container');
    const vatWrap      = document.getElementById('vat_container');

    function sync() {
        const isCommercial = sellerTypeEl.value === 'Commercial';
        catWrap.style.display = isCommercial ? '' : 'none';
        fvfWrap.style.display = isCommercial ? 'none' : '';
        vatWrap.style.display = isCommercial ? '' : 'none';
    }

    sellerTypeEl.addEventListener('change', sync);
    sync();
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

    const soldPrice        = parseFloat(document.getElementById('selling_price').value)          || 0;
    const shippingCharged  = parseFloat(document.getElementById('shipping_cost').value)          || 0;
    const itemCost         = parseFloat(document.getElementById('item_cost').value)              || 0;
    const shippingCostPaid = parseFloat(document.getElementById('shipping_cost_paid').value)     || 0;
    const orderCount       = Math.max(1, parseInt(document.getElementById('order_no').value)     || 1);
    const sellerType       = document.getElementById('seller_type').value;
    const category         = document.getElementById('category').value;
    const intlKey          = document.getElementById('international_sales').value;
    const fvfPromo         = document.getElementById('fvf_promotion').value;
    const vatPct           = parseFloat(document.getElementById('vat').value) || 22;
    const sponsoredRate    = parseFloat(document.getElementById('sponsored_listing_rate').value) || 0;

    const totalSaleAmount  = soldPrice + shippingCharged;
    const isCommercial     = sellerType === 'Commercial';

    // ── FVF ───────────────────────────────────────────────────────────────────
    let rawFVF;
    if (isCommercial) {
        const tiers = IT_RATES[category] || IT_RATES.it_default;
        rawFVF = tieredFee(totalSaleAmount, tiers);
    } else {
        // Private: 5% flat (managed payments)
        rawFVF = totalSaleAmount * 0.05;
        // Apply FVF promotion
        if (fvfPromo === 'max1') rawFVF = Math.min(rawFVF, 1);
        else if (fvfPromo === 'max2') rawFVF = Math.min(rawFVF, 2);
        else if (fvfPromo === 'pct5') rawFVF = totalSaleAmount * 0.05; // already 5%
    }

    // ── Transaction fee: €0.35 per order (incl. 22% IVA) ────────────────────
    const txnFee = 0.35 * orderCount;

    // ── Sponsored listing fee ─────────────────────────────────────────────────
    const sponsoredFee = (sponsoredRate / 100) * totalSaleAmount * orderCount;

    // ── International fee ─────────────────────────────────────────────────────
    const intlRates = INTL_RATES[isCommercial ? 'Commercial' : 'Private'];
    const intlRate  = intlRates[intlKey] || 0;
    const intlFee   = totalSaleAmount * intlRate * orderCount;

    // ── Totals ────────────────────────────────────────────────────────────────
    const totalFVFAll  = rawFVF * orderCount;
    const totalEbayFee = totalFVFAll + txnFee + sponsoredFee + intlFee;

    // ── IVA on selling price (commercial accounting) ──────────────────────────
    const ivaAmount = isCommercial
        ? (soldPrice * orderCount) * (vatPct / (100 + vatPct))
        : 0;

    // ── Profit ────────────────────────────────────────────────────────────────
    const totalRevenue = totalSaleAmount * orderCount;
    const totalCosts   = (itemCost + shippingCostPaid) * orderCount;
    const totalProfit  = totalRevenue - totalEbayFee - totalCosts;
    const profitMargin = totalRevenue > 0 ? (totalProfit / totalRevenue) * 100 : 0;
    const fvfRate      = totalSaleAmount > 0 ? (rawFVF / totalSaleAmount) * 100 : 0;

    // ── Render ────────────────────────────────────────────────────────────────
    const fmt = n => '€' + n.toFixed(2);

    document.getElementById('result-ebay-fee').textContent      = fmt(totalEbayFee);
    document.getElementById('result-fvf').textContent           = fmt(totalFVFAll);
    document.getElementById('result-fvf-rate').textContent      = fvfRate.toFixed(2) + '%';
    document.getElementById('result-txn-fee').textContent       = fmt(txnFee);
    document.getElementById('result-iva').textContent           = isCommercial ? fmt(ivaAmount) : '—';
    document.getElementById('result-iva-note').textContent      = isCommercial
        ? 'VAT component of gross selling price'
        : 'N/A for private sellers';
    document.getElementById('result-total-profit').textContent  = fmt(totalProfit);
    document.getElementById('result-profit-margin').textContent = profitMargin.toFixed(2) + '% of revenue';

    function setRow(rowId, valId, val, show) {
        document.getElementById(rowId).style.display = show ? '' : 'none';
        if (show) document.getElementById(valId).textContent = fmt(val);
    }

    setRow('result-sponsored-row', 'result-sponsored-fee', sponsoredFee, sponsoredFee > 0);
    setRow('result-intl-row',      'result-intl-fee',      intlFee,       intlFee > 0);

    const resultsEl = document.getElementById('results-section');
    resultsEl.style.display = '';
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
@endsection
