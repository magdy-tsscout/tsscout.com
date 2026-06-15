@extends('layouts.master')
@section('title','UK eBay Fee Calculator')

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
#calculateFeesForm .card { border:none; border-radius:var(--calc-radius); box-shadow:var(--calc-shadow); background:#fff; }
#calculateFeesForm .card-body { padding: 1.75rem; }
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
.calc-card--fee    { border-top-color:var(--calc-orange); }
.calc-card--tax    { border-top-color:var(--calc-purple); }
.calc-card--profit { border-top-color:var(--calc-green); }
.calc-card__icon  { font-size:1.6rem; margin-bottom:.4rem; }
.calc-card__label { font-size:.78rem; font-weight:600; letter-spacing:.5px; text-transform:uppercase; color:#7a82a0; margin-bottom:.2rem; }
.calc-card__value { font-size:1.9rem; font-weight:700; color:#1e2540; margin-bottom:.8rem; }
.calc-card--fee    .calc-card__value { color:var(--calc-orange); }
.calc-card--tax    .calc-card__value { color:var(--calc-purple); }
.calc-card--profit .calc-card__value { color:var(--calc-green); }
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
    .ebay-calc-container{ flex-direction:row; }
    .flags-container{ align-items:start; }
    .flags{ background-image:linear-gradient(to bottom,#fff,#efefef); display:flex; flex-direction:column; margin-bottom:15px; }
    .flags a{ display:block !important; margin-right:0; margin-bottom:15px; padding:0; position:relative; opacity:.5; }
    .flags a.active{ border-top:0; border-right:0; border-left:0; border-bottom-width:3px; border-bottom-color:#333; border-radius:0; opacity:1; }
    .flags a.active::after{ content:''; width:0; height:0; border-top:5px solid transparent; border-left:10px solid #555; border-bottom:5px solid transparent; position:absolute; margin-left:47px; z-index:9; margin-top:-21px; }
    .flags a img{ width:36px; height:36px; top:0; }
    .flags a span{ display:none; }
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
                                    <label for="sold_price">Sold Price (£)</label>
                                    <input type="text" name="sold_price" id="sold_price" class="form-control" value="100">
                                </div>
                            </div>

                            <!-- Shipping Charged -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_charged">Shipping Charged (£)</label>
                                    <input type="text" name="shipping_charged" id="shipping_charged" class="form-control" value="1">
                                </div>
                            </div>

                            <!-- Item Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost (£)</label>
                                    <input type="text" name="item_cost" id="item_cost" class="form-control" value="">
                                </div>
                            </div>

                            <!-- Shipping Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_cost">Shipping Cost (£)</label>
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

                            <!-- Seller Type -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="seller_type">Seller Type</label>
                                    <select id="seller_type" name="seller_type" class="form-control">
                                        <option value="Private">Private</option>
                                        <option value="Business">Business</option>
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

                            <!-- FVF Promotion -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="fvf_promotion">FVF Promotion?</label>
                                    <select name="fvf_promotion" id="fvf_promotion" class="form-control">
                                        <option value="No">No</option>
                                        <option value="pct_off">% Off FVF</option>
                                        <option value="max_fvf">Max FVF (£ cap)</option>
                                        <option value="2pct">2% FVF</option>
                                    </select>
                                </div>
                            </div>

                            <!-- FVF Promotion Amount (conditional) -->
                            <div class="col-lg-4" id="fvf_promo_pct_wrapper" style="display:none;">
                                <div class="form-group">
                                    <label for="fvf_promo_pct">FVF Discount (%)</label>
                                    <input type="number" name="fvf_promo_pct" id="fvf_promo_pct" class="form-control" value="" min="0" max="100" step="0.1">
                                </div>
                            </div>
                            <div class="col-lg-4" id="fvf_promo_max_wrapper" style="display:none;">
                                <div class="form-group">
                                    <label for="fvf_promo_max">Max FVF Cap (£)</label>
                                    <input type="number" name="fvf_promo_max" id="fvf_promo_max" class="form-control" value="" min="0" step="0.01">
                                </div>
                            </div>

                            <!-- Overseas Sales -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="oversea_sales">Overseas Sales?</label>
                                    <select name="oversea_sales" id="oversea_sales" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Germany">Germany</option>
                                        <option value="France">France</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Other Eurozone & Northern Europe">Other Eurozone &amp; Northern Europe</option>
                                        <option value="United States">United States</option>
                                        <option value="Canada">Canada</option>
                                        <option value="All other countries">All other countries</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sold in British Pound (shown when overseas) -->
                            <div class="col-lg-4" id="sold_in_pound_container">
                                <div class="form-group">
                                    <label for="sold_in_pound">Sold in British Pound (£)?</label>
                                    <select name="sold_in_pound" id="sold_in_pound" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Residing in UK (conditional) -->
                            <div class="col-lg-4" id="residing_in_uk_container" style="display:none;">
                                <div class="form-group">
                                    <label for="residing_in_uk">Residing Inside the UK?</label>
                                    <select name="residing_in_uk" id="residing_in_uk" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- International Sales Tax (always visible) -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <span class="badge bg-info">International Sales Tax</span>
                                        <div class="border-bottom"></div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sales_tax_method">Calculation Method</label>
                                            <select name="sales_tax_method" id="sales_tax_method" class="form-control">
                                                <option value="percentage">Percentage (%)</option>
                                                <option value="fixed">Fixed Amount (£)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sales_tax_amount">Amount</label>
                                            <input type="number" name="sales_tax_amount" id="sales_tax_amount" class="form-control" value="" min="0" step="0.01">
                                        </div>
                                    </div>

                                    <!-- Shown only when overseas = US AND method = percentage -->
                                    <div class="col-lg-4" id="tax_includes_shipping_wrapper" style="display:none;">
                                        <div class="form-group">
                                            <label for="sales_tax_includes_shipping">Sales Tax Includes Shipping?</label>
                                            <select id="sales_tax_includes_shipping" name="sales_tax_includes_shipping" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
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
                        <h6 class="font-weight-bold mb-3">How eBay UK Fees Are Calculated</h6>

                        <p class="mb-2"><strong>Final Value Fee (FVF)</strong> &mdash; the main eBay fee, charged as a percentage of the total sale amount (selling price + shipping charged to buyer). Rates vary by category:</p>
                        <ul class="mb-3">
                            <li><strong>Most categories:</strong> 14.35% up to &pound;2,500, then 2.5% above (no store)</li>
                            <li><strong>Electronics (phones, computers, consumer electronics):</strong> 9% up to &pound;2,500, then 2.5%</li>
                            <li><strong>High-end computers:</strong> 7% up to &pound;2,500, then 2.5%</li>
                            <li><strong>Guitars:</strong> 6.35% up to &pound;2,500, then 2.5%</li>
                            <li><strong>Athletic clothing &ge;&pound;150 sold price:</strong> 8% flat (no transaction fee)</li>
                            <li><strong>Heavy machinery (business &amp; industrial):</strong> 3% up to &pound;15,000, then 0.5%</li>
                        </ul>

                        <p class="mb-2"><strong>Transaction Fee</strong> &mdash; &pound;0.30 per order (waived for high-value athletic clothing). Multiply by number of orders.</p>

                        <p class="mb-2"><strong>Top Rated Seller discount</strong> &mdash; Top Rated sellers receive a 10% discount off their FVF.</p>

                        <p class="mb-2"><strong>FVF Promotion</strong> &mdash; eBay occasionally offers promotional rates: a % discount off FVF, or a maximum FVF cap. Enter the discount % or max &pound; amount as offered by eBay.</p>

                        <p class="mb-2"><strong>International Fee</strong> &mdash; extra % when selling to overseas buyers:</p>
                        <ul class="mb-3">
                            <li>Germany, France, Italy, Other Eurozone &amp; Northern Europe: +1.35%</li>
                            <li>United States, Canada, All other countries: +1.65%</li>
                        </ul>

                        <p class="mb-2"><strong>Promoted Listings</strong> &mdash; optional sponsored ad rate (%) charged on the total sale amount when the item sells via the ad.</p>

                        <p class="mb-2"><strong>Charity donation</strong> &mdash; if you donate a % of the final sale to charity, that amount is subtracted from your profit (eBay waives their FVF portion of donated sales).</p>

                        <p class="mb-0"><strong>Profit</strong> = Total Revenue &minus; All eBay Fees &minus; Item Cost &minus; Shipping Paid. The margin % is profit as a share of total revenue.</p>
                    </div>
                </div><!-- /.card -->

                <!-- Results -->
                <div id="results-section" class="calc-results" style="display:none;">
                    <h5 class="calc-results__title">Results</h5>
                    <div class="calc-results__grid">

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
                                <li id="result-international-row" style="display:none;"><span>International fee</span><strong id="result-international-fee">-</strong></li>
                            </ul>
                        </div>

                        <div class="calc-card calc-card--tax">
                            <div class="calc-card__icon">&#128196;</div>
                            <div class="calc-card__label">Sales Tax</div>
                            <div class="calc-card__value" id="result-sales-tax">-</div>
                            <p class="calc-card__note">Charged to buyer only</p>
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
    // ─── Dynamic field visibility ────────────────────────────────────────────────
    (function () {
        const oversea       = document.getElementById('oversea_sales');
        const residingWrap  = document.getElementById('residing_in_uk_container');
        const taxShipWrap   = document.getElementById('tax_includes_shipping_wrapper');
        const methodEl      = document.getElementById('sales_tax_method');
        const fvfPromo      = document.getElementById('fvf_promotion');
        const fvfPctWrap    = document.getElementById('fvf_promo_pct_wrapper');
        const fvfMaxWrap    = document.getElementById('fvf_promo_max_wrapper');

        function syncOverseas() {
            const v = oversea.value;
            const needsResiding = ['Other Eurozone & Northern Europe', 'United States', 'All other countries'].includes(v);
            const isUS          = v === 'United States';

            residingWrap.style.display = needsResiding ? '' : 'none';
            syncTaxShipping(); // re-evaluate combined condition
        }

        function syncTaxShipping() {
            const isUS         = oversea.value === 'United States';
            const isPct        = methodEl.value === 'percentage';
            taxShipWrap.style.display = (isUS && isPct) ? '' : 'none';
        }

        function syncFvfPromo() {
            const v = fvfPromo.value;
            fvfPctWrap.style.display = (v === 'pct_off') ? '' : 'none';
            fvfMaxWrap.style.display = (v === 'max_fvf') ? '' : 'none';
        }

        oversea.addEventListener('change', syncOverseas);
        methodEl.addEventListener('change', syncTaxShipping);
        fvfPromo.addEventListener('change', syncFvfPromo);

        syncOverseas();
        syncFvfPromo();
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

    // ─── UK FVF calculator ───────────────────────────────────────────────────────
    // Returns { fvf, noTransactionFee }
    function calcFVF(category, totalSaleAmount, soldPrice, isBusiness) {
        let fvf = 0;
        let noTransactionFee = false;

        // UK rates are the same for Private & Business (no store distinction in this form).
        // Key rate tables (GBP, as of 2025/2026):
        switch (category) {
            case 'books':
            case 'movies_tv':
            case 'music_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.1435}, {rate: 0.025}]);
                break;
            case 'biz_heavy':
                fvf = tieredFee(totalSaleAmount, [{upTo: 15000, rate: 0.03}, {rate: 0.005}]);
                break;
            case 'clothing_athletic':
                if (soldPrice < 150) {
                    fvf = totalSaleAmount * 0.128;
                } else {
                    fvf = totalSaleAmount * 0.075;
                    noTransactionFee = true;
                }
                break;
            case 'clothing_handbags':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2000, rate: 0.1435}, {rate: 0.075}]);
                break;
            case 'coins_bullion':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.128}, {rate: 0.07}]);
                break;
            case 'coins_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.128}, {rate: 0.025}]);
                break;
            case 'cell_phones':
            case 'computers_default':
            case 'consumer_elec':
            case 'musical_dj':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.09}, {rate: 0.025}]);
                break;
            case 'computers_highend':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.07}, {rate: 0.025}]);
                break;
            case 'guitars':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.0535}, {rate: 0.025}]);
                break;
            case 'musical_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.10}, {rate: 0.025}]);
                break;
            case 'jewelry_watches':
                fvf = tieredFee(totalSaleAmount, [
                    {upTo: 1000, rate: 0.15},
                    {upTo: 7500, rate: 0.065},
                    {rate: 0.03}
                ]);
                break;
            case 'jewelry_default':
                fvf = tieredFee(totalSaleAmount, [{upTo: 5000, rate: 0.15}, {rate: 0.09}]);
                break;
            case 'music_vinyl':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.128}, {rate: 0.025}]);
                break;
            case 'nft':
                fvf = totalSaleAmount * 0.05;
                break;
            case 'video_consoles':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.07}, {rate: 0.025}]);
                break;
            case 'video_games':
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.128}, {rate: 0.025}]);
                break;
            default:
                fvf = tieredFee(totalSaleAmount, [{upTo: 2500, rate: 0.128}, {rate: 0.025}]);
        }

        return { fvf, noTransactionFee };
    }

    // ─── International fee rate by country ──────────────────────────────────────
    function intlRate(country) {
        switch (country) {
            case 'Germany':
            case 'France':
            case 'Italy':
            case 'Other Eurozone & Northern Europe':
                return 0.0135;
            case 'United States':
            case 'Canada':
            case 'All other countries':
                return 0.0165;
            default:
                return 0;
        }
    }

    // ─── Main calculate function ─────────────────────────────────────────────────
    function calculateFees(event) {
        event.preventDefault();

        const soldPrice       = parseFloat(document.getElementById('sold_price').value)       || 0;
        const shippingCharged = parseFloat(document.getElementById('shipping_charged').value) || 0;
        const itemCost        = parseFloat(document.getElementById('item_cost').value)        || 0;
        const shippingCost    = parseFloat(document.getElementById('shipping_cost').value)    || 0;
        const noOfOrders      = Math.max(1, parseInt(document.getElementById('no_of_orders').value) || 1);
        const sellerType      = document.getElementById('seller_type').value;
        const sellerLevel     = document.getElementById('seller_level').value;
        const promotedAdRate  = parseFloat(document.getElementById('promoted_ad_rate').value)  || 0;
        const charityPct      = parseFloat(document.getElementById('donated_to_charity').value) || 0;
        const fvfPromoVal     = document.getElementById('fvf_promotion').value;
        const fvfPromoPct     = parseFloat(document.getElementById('fvf_promo_pct').value)     || 0;
        const fvfPromoMax     = parseFloat(document.getElementById('fvf_promo_max').value)     || Infinity;
        const overseaVal      = document.getElementById('oversea_sales').value;
        const salesTaxMethod  = document.getElementById('sales_tax_method').value;
        const salesTaxAmount  = parseFloat(document.getElementById('sales_tax_amount').value)  || 0;
        const taxInclShipping = document.getElementById('sales_tax_includes_shipping').value === 'Yes';
        const category        = document.getElementById('category').value;
        const isBusiness      = sellerType === 'Business';

        const totalSaleAmount = soldPrice + shippingCharged;

        // ── FVF ──────────────────────────────────────────────────────────────────
        let { fvf: rawFVF, noTransactionFee } = calcFVF(category, totalSaleAmount, soldPrice, isBusiness);

        // FVF Promotion adjustments
        if (fvfPromoVal === 'pct_off') {
            rawFVF = rawFVF * (1 - fvfPromoPct / 100);
        } else if (fvfPromoVal === 'max_fvf') {
            rawFVF = Math.min(rawFVF, isFinite(fvfPromoMax) ? fvfPromoMax : rawFVF);
        } else if (fvfPromoVal === '2pct') {
            rawFVF = totalSaleAmount * 0.02;
            noTransactionFee = false;
        }

        // Top Rated Seller: 10% discount off FVF
        const fvfDiscount = sellerLevel === 'Top Rated' ? rawFVF * 0.10 : 0;
        const totalFVF    = rawFVF - fvfDiscount;

        // ── Transaction fee (£0.30 / order) ──────────────────────────────────────
        const transactionFee = noTransactionFee ? 0 : 0.30 * noOfOrders;

        // ── Promoted listings ─────────────────────────────────────────────────────
        const promotedFee = (promotedAdRate / 100) * totalSaleAmount * noOfOrders;

        // ── Charity ───────────────────────────────────────────────────────────────
        const charityFee = (charityPct / 100) * soldPrice * noOfOrders;

        // ── International fee ──────────────────────────────────────────────────────
        const rate = intlRate(overseaVal);
        const internationalFee = rate > 0 ? totalSaleAmount * rate * noOfOrders : 0;

        // ── Per-all-orders FVF ────────────────────────────────────────────────────
        const totalFVFAllOrders = totalFVF * noOfOrders;

        // ── Total eBay fee ────────────────────────────────────────────────────────
        const totalEbayFee = totalFVFAllOrders + transactionFee + promotedFee + charityFee + internationalFee;

        // ── Sales tax ─────────────────────────────────────────────────────────────
        const taxBase = taxInclShipping ? totalSaleAmount : soldPrice;
        let salesTax = 0;
        if (salesTaxMethod === 'percentage') {
            salesTax = (salesTaxAmount / 100) * taxBase * noOfOrders;
        } else {
            salesTax = salesTaxAmount * noOfOrders;
        }

        // ── Profit ────────────────────────────────────────────────────────────────
        const totalRevenue = totalSaleAmount * noOfOrders;
        const totalCosts   = (itemCost + shippingCost) * noOfOrders;
        const totalProfit  = totalRevenue - totalEbayFee - totalCosts;
        const profitMargin = totalRevenue > 0 ? (totalProfit / totalRevenue) * 100 : 0;
        const fvfRate      = totalSaleAmount > 0 ? (totalFVF / totalSaleAmount) * 100 : 0;

        // ── Render ────────────────────────────────────────────────────────────────
        const fmt = n => '£' + n.toFixed(2);

        document.getElementById('result-ebay-fee').textContent        = fmt(totalEbayFee);
        document.getElementById('result-total-fvf').textContent       = fmt(totalFVFAllOrders);
        document.getElementById('result-fvf-rate').textContent        = fvfRate.toFixed(2) + '%';
        document.getElementById('result-transaction-fee').textContent  = fmt(transactionFee);
        document.getElementById('result-sales-tax').textContent       = fmt(salesTax);
        document.getElementById('result-total-profit').textContent    = fmt(totalProfit);
        document.getElementById('result-profit-margin').textContent   = profitMargin.toFixed(2) + '% of sold price';

        const promotedRow = document.getElementById('result-promoted-row');
        const charityRow  = document.getElementById('result-charity-row');
        const intlRow     = document.getElementById('result-international-row');

        if (promotedFee > 0) {
            document.getElementById('result-promoted-fee').textContent = fmt(promotedFee);
            promotedRow.style.display = '';
        } else { promotedRow.style.display = 'none'; }

        if (charityFee > 0) {
            document.getElementById('result-charity-fee').textContent = fmt(charityFee);
            charityRow.style.display = '';
        } else { charityRow.style.display = 'none'; }

        if (internationalFee > 0) {
            document.getElementById('result-international-fee').textContent = fmt(internationalFee);
            intlRow.style.display = '';
        } else { intlRow.style.display = 'none'; }

        const resultsEl = document.getElementById('results-section');
        resultsEl.style.display = '';
        resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>
@endsection
