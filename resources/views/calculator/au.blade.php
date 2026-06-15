@extends('layouts.master')
@section('title','AU eBay Fee Calculator')

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

                            <!-- Category -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @include('calculator/au-categories')
                                </div>
                            </div>

                            <!-- Sold Price -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sold_price">Sold Price (A$)</label>
                                    <input type="text" name="sold_price" id="sold_price" class="form-control" value="100">
                                </div>
                            </div>

                            <!-- Shipping Charged -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_charged">Shipping Charged (A$)</label>
                                    <input type="text" name="shipping_charged" id="shipping_charged" class="form-control" value="1">
                                </div>
                            </div>

                            <!-- Item Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost (A$)</label>
                                    <input type="text" name="item_cost" id="item_cost" class="form-control" value="">
                                </div>
                            </div>

                            <!-- Shipping Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_cost">Shipping Cost (A$)</label>
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
                                        <option value="No">No Store</option>
                                        <option value="Basic">Basic</option>
                                        <option value="Featured">Featured</option>
                                        <option value="Anchor">Anchor</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Has ABN? (conditional — shown when store != No) -->
                            <div class="col-lg-4" id="has_abn_container" style="display:none;">
                                <div class="form-group">
                                    <label for="has_abn">Has an ABN?</label>
                                    <select name="has_abn" id="has_abn" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No (+10% GST on fees)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Seller Level -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="seller_level">Seller Level</label>
                                    <select name="seller_level" id="seller_level" class="form-control">
                                        <option value="Top Rated">Top Rated (−20% FVF)</option>
                                        <option value="Standard">Standard</option>
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

                            <!-- Oversea Sales -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="oversea_sales">Overseas Sales?</label>
                                    <select name="oversea_sales" id="oversea_sales" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Germany">Germany</option>
                                        <option value="France">France</option>
                                        <option value="Italy">Italy</option>
                                        <option value="UK">UK</option>
                                        <option value="USA">USA</option>
                                        <option value="Other country">All other countries</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sold in AUD? (conditional — shown when overseas != No) -->
                            <div class="col-lg-4" id="sold_in_aud_container" style="display:none;">
                                <div class="form-group">
                                    <label for="sold_in_aud">Sold in Australian Dollar (A$)?</label>
                                    <select name="sold_in_aud" id="sold_in_aud" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No (+currency conversion fee)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- International Sales Tax (shown when overseas = USA or Other country) -->
                            <div class="col-12" id="sales_tax_container" style="display:none;">
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
                                                <option value="fixed">Fixed Amount (A$)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sales_tax_amount">Amount</label>
                                            <input type="number" name="sales_tax_amount" id="sales_tax_amount" class="form-control" value="" min="0" step="0.01">
                                        </div>
                                    </div>

                                    <!-- Shown only when overseas = Other country AND method = percentage -->
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
                        <h6 class="font-weight-bold mb-3">How eBay Australia Fees Are Calculated</h6>

                        <p class="mb-2"><strong>Final Value Fee (FVF)</strong> &mdash; the main eBay fee, charged as a percentage of the total sale amount (selling price + shipping charged to buyer). Rates are tiered: one rate up to A$4,000, then 2.5% above that. Rates vary by store subscription and category:</p>
                        <ul class="mb-3">
                            <li><strong>No Store:</strong> 13.4% up to A$4,000 (most categories)</li>
                            <li><strong>Basic Store:</strong> 11.9% (most); lower for tech (7.3% for main devices, 10.4% for other tech)</li>
                            <li><strong>Featured Store:</strong> 10.7% (most); 6.6% for tech devices</li>
                            <li><strong>Anchor Store:</strong> 10.1% (most); 6.2% for tech devices</li>
                            <li><strong>NFTs:</strong> flat rate (5.5% no store / 5% with store)</li>
                            <li><strong>Video game consoles:</strong> 13.4% (no store) / 7.3% (Basic) / 6.6% (Featured) / 6.2% (Anchor)</li>
                        </ul>

                        <p class="mb-2"><strong>Top Rated Seller discount</strong> &mdash; Top Rated sellers receive a 20% discount off their FVF.</p>

                        <p class="mb-2"><strong>Transaction Fee</strong> &mdash; A$0.30 per order. Multiply by number of orders.</p>

                        <p class="mb-2"><strong>Promoted Listings</strong> &mdash; optional ad rate (%) charged on the total sale amount when the item sells via the promoted listing.</p>

                        <p class="mb-2"><strong>International &amp; Currency Fees</strong> &mdash; when selling overseas, eBay charges an international fee (1% with store / 1.1% without) on the total sale amount. If the buyer pays in a foreign currency, a currency conversion fee also applies (3% with store / 3.3% without).</p>

                        <p class="mb-2"><strong>GST on eBay Fees</strong> &mdash; store subscribers who do <em>not</em> have an ABN (Australian Business Number) are charged an extra 10% GST on top of all eBay fees.</p>

                        <p class="mb-2"><strong>Sales Tax</strong> &mdash; collected from the buyer; does not reduce your payout but shown for reference. Enter as a fixed amount or a percentage of the sale (optionally including shipping).</p>

                        <p class="mb-0"><strong>Profit</strong> = Total Revenue &minus; All eBay Fees &minus; Item Cost &minus; Shipping Paid. The margin % is profit as a share of total revenue.</p>
                    </div>
                </div><!-- /.card -->

                <!-- Results -->
                <div id="results-section" class="calc-results" style="display:none;">
                    <h5 class="calc-results__title">Results <small class="text-muted" style="font-size:.75rem;font-weight:400;">In AUD</small></h5>
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
                                <li id="result-international-row" style="display:none;"><span>International fee</span><strong id="result-international-fee">-</strong></li>
                                <li id="result-currency-row" style="display:none;"><span>Currency conversion</span><strong id="result-currency-fee">-</strong></li>
                                <li id="result-gst-row" style="display:none;"><span>Extra GST (no ABN)</span><strong id="result-gst-fee">-</strong></li>
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
    // ─── AU rate table ────────────────────────────────────────────────────────────
    // Each entry: [rate_up_to_4000, rate_above_4000]  (NFTs: flat rate)
    const AU_RATES = {
        No: {
            au_nft:           [0.055, 0],
            au_video_consoles:[0.134, 0.025],
            default:          [0.134, 0.025],
        },
        Basic: {
            au_nft:              [0.05,  0],
            au_home_appliances:  [0.073, 0.025],
            au_vehicle_parts:    [0.113, 0.025],
            au_tech_main:        [0.073, 0.025],
            au_tech_acc:         [0.119, 0.025],
            au_tech_else:        [0.104, 0.025],
            au_video_consoles:   [0.073, 0.025],
            default:             [0.119, 0.025],
        },
        Featured: {
            au_nft:              [0.05,  0],
            au_home_appliances:  [0.066, 0.025],
            au_vehicle_parts:    [0.102, 0.025],
            au_tech_main:        [0.066, 0.025],
            au_tech_acc:         [0.107, 0.025],
            au_tech_else:        [0.094, 0.025],
            au_video_consoles:   [0.066, 0.025],
            default:             [0.107, 0.025],
        },
        Anchor: {
            au_nft:              [0.05,  0],
            au_home_appliances:  [0.062, 0.025],
            au_vehicle_parts:    [0.096, 0.025],
            au_tech_main:        [0.062, 0.025],
            au_tech_acc:         [0.101, 0.025],
            au_tech_else:        [0.088, 0.025],
            au_video_consoles:   [0.062, 0.025],
            default:             [0.101, 0.025],
        },
    };

    // ─── Dynamic field visibility ────────────────────────────────────────────────
    (function () {
        const storeEl     = document.getElementById('ebay_store');
        const overseaEl   = document.getElementById('oversea_sales');
        const methodEl    = document.getElementById('sales_tax_method');

        const abnWrap     = document.getElementById('has_abn_container');
        const audWrap     = document.getElementById('sold_in_aud_container');
        const taxWrap     = document.getElementById('sales_tax_container');
        const taxShipWrap = document.getElementById('tax_includes_shipping_wrapper');

        function syncStore() {
            abnWrap.style.display = storeEl.value !== 'No' ? '' : 'none';
        }

        function syncOverseas() {
            const v = overseaEl.value;
            const isOverseas  = v !== 'No';
            const showTax     = v === 'USA' || v === 'Other country';

            audWrap.style.display = isOverseas  ? '' : 'none';
            taxWrap.style.display = showTax     ? '' : 'none';
            syncTaxShip();
        }

        function syncTaxShip() {
            const v      = overseaEl.value;
            const isPct  = methodEl.value === 'percentage';
            taxShipWrap.style.display = (v === 'Other country' && isPct) ? '' : 'none';
        }

        storeEl.addEventListener('change', syncStore);
        overseaEl.addEventListener('change', syncOverseas);
        methodEl.addEventListener('change', syncTaxShip);

        syncStore();
        syncOverseas();
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

    // ─── Main calculate function ─────────────────────────────────────────────────
    function calculateFees(event) {
        event.preventDefault();

        const soldPrice       = parseFloat(document.getElementById('sold_price').value)       || 0;
        const shippingCharged = parseFloat(document.getElementById('shipping_charged').value) || 0;
        const itemCost        = parseFloat(document.getElementById('item_cost').value)        || 0;
        const shippingCost    = parseFloat(document.getElementById('shipping_cost').value)    || 0;
        const noOfOrders      = Math.max(1, parseInt(document.getElementById('no_of_orders').value) || 1);
        const store           = document.getElementById('ebay_store').value;
        const hasAbn          = document.getElementById('has_abn').value === 'Yes';
        const sellerLevel     = document.getElementById('seller_level').value;
        const promotedAdRate  = parseFloat(document.getElementById('promoted_ad_rate').value)  || 0;
        const overseaVal      = document.getElementById('oversea_sales').value;
        const soldInAud       = document.getElementById('sold_in_aud').value === 'Yes';
        const salesTaxMethod  = document.getElementById('sales_tax_method').value;
        const salesTaxAmount  = parseFloat(document.getElementById('sales_tax_amount').value)  || 0;
        const taxInclShipping = document.getElementById('sales_tax_includes_shipping').value === 'Yes';
        const category        = document.getElementById('category').value;

        const totalSaleAmount = soldPrice + shippingCharged;
        const isStore         = store !== 'No';

        // ── FVF ──────────────────────────────────────────────────────────────────
        const storeRates = AU_RATES[store] || AU_RATES['No'];
        const [rate1, rate2] = storeRates[category] || storeRates['default'];

        let rawFVF;
        if (category === 'au_nft') {
            rawFVF = totalSaleAmount * rate1; // flat NFT rate
        } else {
            rawFVF = tieredFee(totalSaleAmount, [
                { upTo: 4000, rate: rate1 },
                { rate: rate2 }
            ]);
        }

        // Top Rated Seller: 20% off FVF (AU uses 20%)
        if (sellerLevel === 'Top Rated') rawFVF *= 0.80;

        const totalFVF = rawFVF;

        // ── Transaction fee (A$0.30 / order) ────────────────────────────────────
        const transactionFee = 0.30 * noOfOrders;

        // ── Promoted listings ─────────────────────────────────────────────────────
        const promotedFee = (promotedAdRate / 100) * totalSaleAmount * noOfOrders;

        // ── International + currency conversion fees ──────────────────────────────
        const intlRate  = isStore ? 0.01  : 0.011;
        const convRate  = isStore ? 0.03  : 0.033;

        const internationalFee  = overseaVal !== 'No' ? totalSaleAmount * intlRate * noOfOrders : 0;
        const currencyFee       = (overseaVal !== 'No' && !soldInAud) ? totalSaleAmount * convRate * noOfOrders : 0;

        // ── GST on fees (store subscribers without ABN: +10%) ────────────────────
        const baseFeeBeforeGst  = (totalFVF * noOfOrders) + transactionFee + promotedFee + internationalFee + currencyFee;
        const gstFee            = (isStore && !hasAbn) ? baseFeeBeforeGst * 0.10 : 0;

        const totalEbayFee = baseFeeBeforeGst + gstFee;

        // ── Sales tax (buyer only) ─────────────────────────────────────────────────
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
        const fmt = n => 'A$' + n.toFixed(2);

        document.getElementById('result-ebay-fee').textContent        = fmt(totalEbayFee);
        document.getElementById('result-total-fvf').textContent       = fmt(totalFVF * noOfOrders);
        document.getElementById('result-fvf-rate').textContent        = fvfRate.toFixed(2) + '%';
        document.getElementById('result-transaction-fee').textContent  = fmt(transactionFee);
        document.getElementById('result-sales-tax').textContent       = fmt(salesTax);
        document.getElementById('result-total-profit').textContent    = fmt(totalProfit);
        document.getElementById('result-profit-margin').textContent   = profitMargin.toFixed(2) + '% of sold price';

        function setRow(rowId, valueId, value, showWhen) {
            const row = document.getElementById(rowId);
            if (showWhen) {
                document.getElementById(valueId).textContent = fmt(value);
                row.style.display = '';
            } else { row.style.display = 'none'; }
        }

        setRow('result-promoted-row',     'result-promoted-fee',     promotedFee,     promotedFee > 0);
        setRow('result-international-row','result-international-fee', internationalFee, internationalFee > 0);
        setRow('result-currency-row',     'result-currency-fee',     currencyFee,     currencyFee > 0);
        setRow('result-gst-row',          'result-gst-fee',          gstFee,          gstFee > 0);

        const resultsEl = document.getElementById('results-section');
        resultsEl.style.display = '';
        resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>
@endsection
