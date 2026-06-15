@extends('layouts.master')
@section('title','eBay Fee Calculator — US')

@section('styles')
<style>
/* ── Reset / tokens ──────────────────────────────────────────── */
:root {
    --calc-blue:    #1a6fc4;
    --calc-green:   #22a06b;
    --calc-orange:  #e07b00;
    --calc-purple:  #7b5ea7;
    --calc-bg:      #f4f6fb;
    --calc-border:  #dde2ee;
    --calc-radius:  12px;
    --calc-shadow:  0 2px 12px rgba(0,0,0,.08);
}

.flags a { display: inline !important; }

/* ── Form card ───────────────────────────────────────────────── */
#calculateFeesForm .card {
    border: none;
    border-radius: var(--calc-radius);
    box-shadow: var(--calc-shadow);
    background: #fff;
}
#calculateFeesForm .card-body { padding: 1.75rem; }
#calculateFeesForm .card-footer {
    background: var(--calc-bg);
    border-top: 1px solid var(--calc-border);
    border-radius: 0 0 var(--calc-radius) var(--calc-radius);
    padding: .9rem 1.75rem;
}
#calculateFeesForm label {
    font-weight: 600;
    font-size: .82rem;
    letter-spacing: .4px;
    text-transform: uppercase;
    color: #5a6480;
    margin-bottom: .3rem;
}
#calculateFeesForm .form-control {
    border-radius: 8px;
    border-color: var(--calc-border);
    font-size: .95rem;
    transition: border-color .2s, box-shadow .2s;
}
#calculateFeesForm .form-control:focus {
    border-color: var(--calc-blue);
    box-shadow: 0 0 0 3px rgba(26,111,196,.15);
}
#calculateFeesForm .border-bottom { border-color: var(--calc-border) !important; margin-top: .4rem; }

#calculateFeesForm button[type=submit] {
    background: var(--calc-blue);
    border: none;
    border-radius: 8px;
    padding: .55rem 1.8rem;
    font-weight: 600;
    letter-spacing: .4px;
    font-size: .95rem;
    transition: background .2s, transform .1s;
}
#calculateFeesForm button[type=submit]:hover { background: #155fa0; transform: translateY(-1px); }
#calculateFeesForm button[type=submit]:active { transform: translateY(0); }

/* ── Results area ─────────────────────────────────────────────── */
.calc-results {
    margin-top: 1.75rem;
    animation: fadeUp .35s ease;
}
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
.calc-results__title {
    font-weight: 700;
    color: #3a4060;
    font-size: 1rem;
    letter-spacing: .5px;
    text-transform: uppercase;
    margin-bottom: 1rem;
    padding-left: 2px;
}
.calc-results__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
@media (max-width: 768px) { .calc-results__grid { grid-template-columns: 1fr; } }

/* Stat cards */
.calc-card {
    background: #fff;
    border-radius: var(--calc-radius);
    box-shadow: var(--calc-shadow);
    padding: 1.4rem 1.5rem;
    border-top: 4px solid var(--calc-border);
    transition: transform .2s;
}
.calc-card:hover { transform: translateY(-3px); }
.calc-card--fee    { border-top-color: var(--calc-orange); }
.calc-card--tax    { border-top-color: var(--calc-purple); }
.calc-card--profit { border-top-color: var(--calc-green); }

.calc-card__icon  { font-size: 1.6rem; margin-bottom: .4rem; }
.calc-card__label {
    font-size: .78rem;
    font-weight: 600;
    letter-spacing: .5px;
    text-transform: uppercase;
    color: #7a82a0;
    margin-bottom: .2rem;
}
.calc-card__value {
    font-size: 1.9rem;
    font-weight: 700;
    color: #1e2540;
    margin-bottom: .8rem;
}
.calc-card--fee    .calc-card__value { color: var(--calc-orange); }
.calc-card--tax    .calc-card__value { color: var(--calc-purple); }
.calc-card--profit .calc-card__value { color: var(--calc-green); }

.calc-card__breakdown {
    list-style: none;
    padding: 0;
    margin: 0;
    border-top: 1px solid var(--calc-border);
    padding-top: .7rem;
}
.calc-card__breakdown li {
    display: flex;
    justify-content: space-between;
    font-size: .85rem;
    color: #5a6480;
    padding: .2rem 0;
}
.calc-card__breakdown li strong { color: #1e2540; }
.calc-card__note {
    font-size: .83rem;
    color: #7a82a0;
    margin: 0;
    border-top: 1px solid var(--calc-border);
    padding-top: .6rem;
}
.calc-card__note strong { color: #1e2540; }

/* ── Layout ───────────────────────────────────────────────────── */
.ebay-calc-container { display: flex; flex-direction: column; gap: 5px; }
.flags-container { flex-shrink: 1; justify-content: center; align-items: center; display: flex; }
.flags {
    background-image: linear-gradient(#fff, #efefef);
    border: 1px solid #ccc;
    padding: 3px 10px;
    border-radius: 10px;
    width: fit-content;
    margin-bottom: 15px;
}
.flags a { border-radius: 10px; margin-right: 5px; padding-right: 5px; padding-left: 5px; }
.flags a:last-child { margin-right: 0 !important; }
.flags a.active { border: 1px solid rgba(61,82,14,.4); color: #3c520e; }
.flags a img { position: relative; top: -2px; }
.form-container { flex-grow: 1; }

@media (max-width: 992px) {
    .ebay-calc-container { flex-direction: row; }
    .flags-container { align-items: start; }
    .flags { background-image: linear-gradient(to bottom,#fff,#efefef); display: flex; flex-direction: column; margin-bottom: 15px; }
    .flags a { display: block !important; margin-right: 0; margin-bottom: 15px; padding: 0; position: relative; opacity: .5; }
    .flags a.active { border-top:0; border-right:0; border-left:0; border-bottom-width:3px; border-bottom-color:#333; border-radius:0; opacity:1; }
    .flags a.active::after { content:''; width:0; height:0; border-top:5px solid transparent; border-left:10px solid #555; border-bottom:5px solid transparent; position:absolute; margin-left:47px; z-index:9; margin-top:-21px; }
    .flags a img { width:36px; height:36px; top:0; }
    .flags a span { display: none; }
}
</style>
@endsection

@section('content')
<header class="mt-2">
</header>
<div class="container-fluid">

    <div class="container">
        <h2 class="text-center mb-3">{{ $ebay_title }}</h2>
        <div class="ebay-calc-container">
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
                                <!-- Category -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        @include('calculator/categories')
                                    </div>
                                </div>

                                <!-- Sold Price -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sold_price">Sold Price</label>
                                        <input type="text" name="sold_price" id="sold_price" class="form-control" value="100">
                                    </div>
                                </div>

                                <!-- Shipping Charged -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="shipping_charged">Shipping Charged</label>
                                        <input type="text" name="shipping_charged" id="shipping_charged" class="form-control" value="1">
                                    </div>
                                </div>

                                <!-- Item Cost -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="item_cost">Item Cost</label>
                                        <input type="text" name="item_cost" id="item_cost" class="form-control" value="">
                                    </div>
                                </div>

                                <!-- Shipping Cost -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="shipping_cost">Shipping Cost</label>
                                        <input type="text" name="shipping_cost" id="shipping_cost" class="form-control" value="">
                                    </div>
                                </div>

                                <!-- No. of Orders -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="no_of_orders">No. of Orders</label>
                                        <input type="number" name="no_of_orders" id="no_of_orders" class="form-control" value="1" min="1">
                                    </div>
                                </div>

                                <!-- eBay Store -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ebay_store">eBay Store?</label>
                                        <select name="ebay_store" id="ebay_store" class="form-control">
                                            <option value="NoStore">No Store</option>
                                            <option value="Starter">Starter</option>
                                            <option value="Basic">Basic</option>
                                            <option value="Premium">Premium</option>
                                            <option value="Anchor">Anchor</option>
                                            <option value="Enterprise">Enterprise</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Seller Level -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="seller_level">Seller Level</label>
                                        <select name="seller_level" id="seller_level" class="form-control">
                                            <option value="Top Rated">Top Rated</option>
                                            <option value="Above Standard">Above Standard</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Below Standard">Below Standard</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Overseas Sales -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="overseas_sales">Overseas Sales?</label>
                                        <select name="overseas_sales" id="overseas_sales" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes (+1.65%)</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Promoted Ad Rate -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="promoted_ad_rate">Promoted Ad Rate (%)</label>
                                        <input type="text" name="promoted_ad_rate" id="promoted_ad_rate" class="form-control" value="">
                                    </div>
                                </div>

                                <!-- Donated to Charity -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="donated_to_charity">Donated to Charity (%)</label>
                                        <input type="text" name="donated_to_charity" id="donated_to_charity" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <span class="badge bg-info">Sales tax</span>
                                    <div class="border-bottom"></div>
                                </div>

                                <!-- Sales Tax Calculation Method -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sales_tax_method">Sales Tax Calculation Method</label>
                                        <select name="sales_tax_method" id="sales_tax_method" class="form-control">
                                            <option value="percentage">Percentage (%)</option>
                                            <option value="fixed">Fixed amount ($)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sales_tax_amount">Amount</label>
                                        <input type="number" name="sales_tax_amount" id="sales_tax_amount" class="form-control" value="" min="0" step="0.01">
                                    </div>
                                </div>

                                <div class="col-lg-4" id="tax_includes_shipping_wrapper">
                                    <div class="form-group">
                                        <label for="sales_tax_includes_shipping">Sales tax includes shipping?</label>
                                        <select id="sales_tax_includes_shipping" name="sales_tax_includes_shipping" class="form-control">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary mt-1">Calculate Fees</button>
                            <button type="button" class="btn btn-outline-secondary mt-1 ml-2" onclick="var el=document.getElementById('how-it-works');el.classList.toggle('d-none');if(!el.classList.contains('d-none'))el.scrollIntoView({behavior:'smooth',block:'start'});" title="How is this calculated?">
                                &#63; How it works
                            </button>
                        </div>

                        <!-- How it works explanation -->
                        <div id="how-it-works" class="d-none px-4 py-3" style="background:#fff;border-top:1px solid #dee2e6;font-size:.9rem;">
                            <h6 class="font-weight-bold mb-3">How eBay US Fees Are Calculated</h6>

                            <p class="mb-2"><strong>Final Value Fee (FVF)</strong> &mdash; the main eBay fee, charged as a percentage of the total sale amount (selling price + shipping charged to buyer). Rates are tiered and vary by store subscription and category:</p>
                            <ul class="mb-3">
                                <li><strong>Most categories (no store):</strong> 13.25% up to $7,500, then 2.35% above</li>
                                <li><strong>Most categories (Basic/Premium/Anchor/Enterprise store):</strong> 12.35% up to $2,500, then 2.35%</li>
                                <li><strong>Electronics (phones, computers, consumer electronics, DJ equipment):</strong> 9% up to $2,500, then 2.35%</li>
                                <li><strong>High-end computers:</strong> 7% up to $2,500, then 2.35%</li>
                                <li><strong>Guitars:</strong> 6.35% up to $2,500 / $7,500 (store), then 2.35%</li>
                                <li><strong>Athletic clothing &ge;$150 sold price:</strong> 8% flat (no transaction fee)</li>
                                <li><strong>NFTs:</strong> 5% flat</li>
                                <li><strong>Heavy machinery (business &amp; industrial):</strong> 2.5% up to $15,000, then 0.5%</li>
                                <li><strong>Jewellery &amp; watches:</strong> tiered at 12.5% / 4% / 3% (store) or 15% / 6.5% / 3% (no store)</li>
                            </ul>

                            <p class="mb-2"><strong>Top Rated Seller discount</strong> &mdash; Top Rated sellers receive a 10% discount off their FVF.</p>

                            <p class="mb-2"><strong>Transaction Fee</strong> &mdash; $0.30 per order. Waived for high-value athletic clothing (&ge;$150). Multiply by number of orders.</p>

                            <p class="mb-2"><strong>Promoted Listings</strong> &mdash; optional ad rate (%) charged on the total sale amount when the item sells via the promoted listing.</p>

                            <p class="mb-2"><strong>Charity donation</strong> &mdash; if you donate a % of the final sale price to charity, that amount is deducted from your profit (eBay waives their FVF on the donated portion).</p>

                            <p class="mb-2"><strong>International Fee</strong> &mdash; an extra 1.65% on the total sale amount when selling to overseas buyers.</p>

                            <p class="mb-2"><strong>Sales Tax</strong> &mdash; collected from the buyer; does not reduce your payout but is shown for reference. Enter as a percentage of the sale (optionally including shipping) or a fixed dollar amount.</p>

                            <p class="mb-0"><strong>Profit</strong> = Total Revenue &minus; All eBay Fees &minus; Item Cost &minus; Shipping Paid. The margin % is profit as a share of total revenue.</p>
                        </div>
                    </div>

                    <!-- Results -->
                    <div id="results-section" class="calc-results" style="display:none;">
                        <h5 class="calc-results__title">Results</h5>
                        <div class="calc-results__grid">

                            <!-- eBay Fee card -->
                            <div class="calc-card calc-card--fee">
                                <div class="calc-card__icon">&#128722;</div>
                                <div class="calc-card__label">Total eBay Fee</div>
                                <div class="calc-card__value" id="result-ebay-fee">-</div>
                                <ul class="calc-card__breakdown">
                                    <li><span>FVF</span><strong id="result-total-fvf">-</strong></li>
                                    <li><span>FVF rate</span><strong id="result-fvf-rate">-</strong></li>
                                    <li><span>Transaction fee</span><strong id="result-transaction-fee">-</strong></li>
                                    <li id="result-promoted-row" style="display:none;"><span>Promoted listing</span><strong id="result-promoted-fee">-</strong></li>
                                    <li id="result-charity-row" style="display:none;"><span>Charity</span><strong id="result-charity-fee">-</strong></li>
                                    <li id="result-international-row" style="display:none;"><span>International (+1.65%)</span><strong id="result-international-fee">-</strong></li>
                                </ul>
                            </div>

                            <!-- Sales Tax card -->
                            <div class="calc-card calc-card--tax">
                                <div class="calc-card__icon">&#128196;</div>
                                <div class="calc-card__label">Sales Tax</div>
                                <div class="calc-card__value" id="result-sales-tax">-</div>
                                <p class="calc-card__note">Charged to buyer only</p>
                            </div>

                            <!-- Profit card -->
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

</div>
@endsection

@section('script')
<script>
// ─── Sales-tax field visibility ──────────────────────────────────────────────
(function () {
    const methodEl = document.getElementById('sales_tax_method');
    const wrapper  = document.getElementById('tax_includes_shipping_wrapper');

    function syncTaxFields() {
        wrapper.style.display = methodEl.value === 'percentage' ? '' : 'none';
    }

    methodEl.addEventListener('change', syncTaxFields);
    syncTaxFields();
})();

// ─── Tiered fee helper ───────────────────────────────────────────────────────
function tieredFee(amount, tiers) {
    let fee = 0, prev = 0;
    for (const tier of tiers) {
        if (tier.upTo !== undefined) {
            const portion = Math.max(0, Math.min(amount, tier.upTo) - prev);
            fee += portion * tier.rate;
            prev = tier.upTo;
        } else {
            fee += Math.max(0, amount - prev) * tier.rate;
        }
    }
    return fee;
}

// ─── FVF calculator ──────────────────────────────────────────────────────────
function calcFVF(category, totalSaleAmount, soldPrice, isStoreSub) {
    let fvf = 0;
    let noTransactionFee = false;

    if (isStoreSub) {
        switch (category) {
            case 'books':
            case 'movies_tv':
            case 'music_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.1495}, {rate: 0.0235}]); break;
            case 'biz_heavy':
                fvf = tieredFee(totalSaleAmount, [{upTo: 15000, rate: 0.025}, {rate: 0.005}]); break;
            case 'clothing_athletic':
                if (soldPrice < 150) { fvf = totalSaleAmount * 0.1235; }
                else { fvf = totalSaleAmount * 0.07; noTransactionFee = true; } break;
            case 'clothing_handbags':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2000, rate: 0.13}, {rate: 0.07}]); break;
            case 'coins_bullion':
                fvf = tieredFee(totalSaleAmount, [{upTo: 1500, rate: 0.0735}, {upTo: 10000, rate: 0.05}, {rate: 0.045}]); break;
            case 'coins_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 4000, rate: 0.09}, {rate: 0.0235}]); break;
            case 'cell_phones':
            case 'computers_default':
            case 'consumer_elec':
            case 'musical_dj':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.09}, {rate: 0.0235}]); break;
            case 'computers_highend':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.07}, {rate: 0.0235}]); break;
            case 'guitars':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.0635}, {rate: 0.0235}]); break;
            case 'musical_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.10}, {rate: 0.0235}]); break;
            case 'jewelry_watches':
                fvf = tieredFee(totalSaleAmount, [{upTo: 1000, rate: 0.125}, {upTo: 5000, rate: 0.04}, {rate: 0.03}]); break;
            case 'jewelry_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 5000, rate: 0.13}, {rate: 0.07}]); break;
            case 'motors_tires':
                fvf = tieredFee(totalSaleAmount, [{upTo: 1000, rate: 0.0935}, {rate: 0.0235}]); break;
            case 'motors_parts':
                fvf = tieredFee(totalSaleAmount, [{upTo: 1000, rate: 0.1135}, {rate: 0.0235}]); break;
            case 'music_vinyl':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.1235}, {rate: 0.0235}]); break;
            case 'nft':
                fvf = totalSaleAmount * 0.05; break;
            case 'video_consoles':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.07}, {rate: 0.0235}]); break;
            case 'video_games':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.1235}, {rate: 0.0235}]); break;
            default:
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.1235}, {rate: 0.0235}]);
        }
    } else {
        switch (category) {
            case 'books':
            case 'movies_tv':
            case 'music_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 7500, rate: 0.1495}, {rate: 0.0235}]); break;
            case 'biz_heavy':
                fvf = tieredFee(totalSaleAmount, [{upTo: 15000, rate: 0.03}, {rate: 0.005}]); break;
            case 'clothing_athletic':
                if (soldPrice < 150) { fvf = totalSaleAmount * 0.1325; }
                else { fvf = totalSaleAmount * 0.08; noTransactionFee = true; } break;
            case 'clothing_handbags':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2000, rate: 0.15}, {rate: 0.09}]); break;
            case 'coins_bullion':
                fvf = tieredFee(totalSaleAmount, [{upTo: 7500, rate: 0.1325}, {rate: 0.07}]); break;
            case 'coins_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 7500, rate: 0.1325}, {rate: 0.0235}]); break;
            case 'guitars':
                fvf = tieredFee(totalSaleAmount, [{upTo: 7500, rate: 0.0635}, {rate: 0.0235}]); break;
            case 'jewelry_watches':
                fvf = tieredFee(totalSaleAmount, [{upTo: 1000, rate: 0.15}, {upTo: 7500, rate: 0.065}, {rate: 0.03}]); break;
            case 'jewelry_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 5000, rate: 0.15}, {rate: 0.09}]); break;
            case 'music_vinyl':
                fvf = tieredFee(totalSaleAmount, [{upTo: 7500, rate: 0.1325}, {rate: 0.0235}]); break;
            case 'nft':
                fvf = totalSaleAmount * 0.05; break;
            default:
                fvf = tieredFee(totalSaleAmount, [{upTo: 7500, rate: 0.1325}, {rate: 0.0235}]);
        }
    }

    return { fvf, noTransactionFee };
}

// ─── Main calculate function ──────────────────────────────────────────────────
function calculateFees(event) {
    event.preventDefault();

    const soldPrice       = parseFloat(document.getElementById('sold_price').value)        || 0;
    const shippingCharged = parseFloat(document.getElementById('shipping_charged').value)  || 0;
    const itemCost        = parseFloat(document.getElementById('item_cost').value)         || 0;
    const shippingCost    = parseFloat(document.getElementById('shipping_cost').value)     || 0;
    const noOfOrders      = Math.max(1, parseInt(document.getElementById('no_of_orders').value) || 1);
    const ebayStore       = document.getElementById('ebay_store').value;
    const sellerLevel     = document.getElementById('seller_level').value;
    const overseasSales   = document.getElementById('overseas_sales').value === 'Yes';
    const promotedAdRate  = parseFloat(document.getElementById('promoted_ad_rate').value)   || 0;
    const charityPct      = parseFloat(document.getElementById('donated_to_charity').value) || 0;
    const salesTaxMethod  = document.getElementById('sales_tax_method').value;
    const salesTaxAmount  = parseFloat(document.getElementById('sales_tax_amount').value)   || 0;
    const taxInclShipping = document.getElementById('sales_tax_includes_shipping').value === 'Yes';
    const category        = document.getElementById('category').value;

    const isStoreSub      = ['Basic', 'Premium', 'Anchor', 'Enterprise'].includes(ebayStore);
    const totalSaleAmount = soldPrice + shippingCharged;

    // ── FVF ───────────────────────────────────────────────────────────────────
    const { fvf: rawFVF, noTransactionFee } = calcFVF(category, totalSaleAmount, soldPrice, isStoreSub);

    const fvfDiscount       = sellerLevel === 'Top Rated' ? rawFVF * 0.10 : 0;
    const totalFVF          = rawFVF - fvfDiscount;
    const totalFVFAllOrders = totalFVF * noOfOrders;

    // ── Other fees ────────────────────────────────────────────────────────────
    const transactionFee   = noTransactionFee ? 0 : 0.30 * noOfOrders;
    const promotedFee      = (promotedAdRate / 100) * totalSaleAmount * noOfOrders;
    const charityFee       = (charityPct / 100) * soldPrice * noOfOrders;
    const internationalFee = overseasSales ? totalSaleAmount * 0.0165 * noOfOrders : 0;
    const totalEbayFee     = totalFVFAllOrders + transactionFee + promotedFee + charityFee + internationalFee;

    // ── Sales tax ─────────────────────────────────────────────────────────────
    const taxBase = taxInclShipping ? totalSaleAmount : soldPrice;
    const salesTax = salesTaxMethod === 'percentage'
        ? (salesTaxAmount / 100) * taxBase * noOfOrders
        : salesTaxAmount * noOfOrders;

    // ── Profit ────────────────────────────────────────────────────────────────
    const totalRevenue = totalSaleAmount * noOfOrders;
    const totalCosts   = (itemCost + shippingCost) * noOfOrders;
    const totalProfit  = totalRevenue - totalEbayFee - totalCosts;
    const profitMargin = totalRevenue > 0 ? (totalProfit / totalRevenue) * 100 : 0;
    const fvfRate      = totalSaleAmount > 0 ? (totalFVF / totalSaleAmount) * 100 : 0;

    // ── Render ────────────────────────────────────────────────────────────────
    const fmt = n => '$' + n.toFixed(2);

    document.getElementById('result-ebay-fee').textContent        = fmt(totalEbayFee);
    document.getElementById('result-total-fvf').textContent       = fmt(totalFVFAllOrders);
    document.getElementById('result-fvf-rate').textContent        = fvfRate.toFixed(2) + '%';
    document.getElementById('result-transaction-fee').textContent  = fmt(transactionFee);
    document.getElementById('result-sales-tax').textContent       = fmt(salesTax);
    document.getElementById('result-total-profit').textContent    = fmt(totalProfit);
    document.getElementById('result-profit-margin').textContent   = profitMargin.toFixed(2) + '% of sold price';

    function setRow(rowId, valId, val, show) {
        document.getElementById(rowId).style.display = show ? '' : 'none';
        if (show) document.getElementById(valId).textContent = fmt(val);
    }

    setRow('result-promoted-row',     'result-promoted-fee',     promotedFee,     promotedFee > 0);
    setRow('result-charity-row',      'result-charity-fee',      charityFee,      charityFee > 0);
    setRow('result-international-row','result-international-fee', internationalFee, internationalFee > 0);

    const resultsEl = document.getElementById('results-section');
    resultsEl.style.display = '';
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
@endsection
