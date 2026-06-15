@extends('layouts.master')
@section('title','CA eBay Fee Calculator')

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
                                    @include('calculator/categories')
                                </div>
                            </div>

                            <!-- Sold Price -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sold_price">Sold Price (CA$)</label>
                                    <input type="text" name="sold_price" id="sold_price" class="form-control" value="100">
                                </div>
                            </div>

                            <!-- Shipping Charged -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_charged">Shipping Charged (CA$)</label>
                                    <input type="text" name="shipping_charged" id="shipping_charged" class="form-control" value="1">
                                </div>
                            </div>

                            <!-- Item Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost (CA$)</label>
                                    <input type="text" name="item_cost" id="item_cost" class="form-control" value="">
                                </div>
                            </div>

                            <!-- Shipping Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="shipping_cost">Shipping Cost (CA$)</label>
                                    <input type="text" name="shipping_cost" id="shipping_cost" class="form-control" value="">
                                </div>
                            </div>

                            <!-- Quantity Sold -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="quantity_sold">Quantity Sold</label>
                                    <input type="number" name="quantity_sold" id="quantity_sold" class="form-control" value="1" min="1">
                                </div>
                            </div>

                            <!-- eBay Store -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ebay_store">eBay Store?</label>
                                    <select name="ebay_store" id="ebay_store" class="form-control">
                                        <option value="No">No Store</option>
                                        <option value="Basic">Basic</option>
                                        <option value="Premium">Premium</option>
                                        <option value="Anchor">Anchor</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Seller Performance -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="seller_performance">Seller Performance</label>
                                    <select name="seller_performance" id="seller_performance" class="form-control">
                                        <option value="0.9">Top-rated (−10% FVF)</option>
                                        <option value="1" selected>Above Standard</option>
                                        <option value="1.05">Below Standard (+5% FVF)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- International Sales -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="international_sales">International Sales?</label>
                                    <select name="international_sales" id="international_sales" class="form-control">
                                        <option value="No">No (Domestic)</option>
                                        <option value="USA">USA (+0.4%)</option>
                                        <option value="Other countries">Other countries (+1%)</option>
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

                            <!-- Sold in Canadian Dollar? -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="sold_in_cad">Sold in Canadian Dollar (CA$)?</label>
                                    <select name="sold_in_cad" id="sold_in_cad" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Where Are You Based? (domestic only) -->
                            <div class="col-lg-4" id="based_in_container">
                                <div class="form-group">
                                    <label for="based_in">Where Are You Based? (eBay fee tax)</label>
                                    <select name="based_in" id="based_in" class="form-control">
                                        <option value="Alberta">Alberta (5%)</option>
                                        <option value="British Columbia">British Columbia (12%)</option>
                                        <option value="Manitoba">Manitoba (12%)</option>
                                        <option value="New Brunswick">New Brunswick (15%)</option>
                                        <option value="Newfoundland and Labrador">Newfoundland and Labrador (15%)</option>
                                        <option value="Northwest Territories">Northwest Territories (5%)</option>
                                        <option value="Nova Scotia">Nova Scotia (15%)</option>
                                        <option value="Nunavut">Nunavut (5%)</option>
                                        <option value="Ontario" selected>Ontario (13%)</option>
                                        <option value="Prince Edward Island">Prince Edward Island (15%)</option>
                                        <option value="Quebec">Quebec (14.975%)</option>
                                        <option value="Saskatchewan">Saskatchewan (11%)</option>
                                        <option value="Yukon">Yukon (5%)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Where You Sold To? (buyer province / sales tax) -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="where_you_sold_to">Where Did You Sell To? (buyer sales tax)</label>
                                    <select name="where_you_sold_to" id="where_you_sold_to" class="form-control">
                                        <option value="Alberta">Alberta (5%)</option>
                                        <option value="British Columbia">British Columbia (12%)</option>
                                        <option value="Manitoba">Manitoba (12%)</option>
                                        <option value="New Brunswick">New Brunswick (15%)</option>
                                        <option value="Newfoundland and Labrador">Newfoundland and Labrador (15%)</option>
                                        <option value="Northwest Territories">Northwest Territories (5%)</option>
                                        <option value="Nova Scotia">Nova Scotia (15%)</option>
                                        <option value="Nunavut">Nunavut (5%)</option>
                                        <option value="Ontario" selected>Ontario (13%)</option>
                                        <option value="Prince Edward Island">Prince Edward Island (15%)</option>
                                        <option value="Quebec">Quebec (14.975%)</option>
                                        <option value="Saskatchewan">Saskatchewan (11%)</option>
                                        <option value="Yukon">Yukon (5%)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- International Sales Tax (shown for USA / Other) -->
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
                                                <option value="fixed">Fixed Amount (CA$)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sales_tax_amount">Amount</label>
                                            <input type="number" name="sales_tax_amount" id="sales_tax_amount" class="form-control" value="" min="0" step="0.01">
                                        </div>
                                    </div>

                                    <!-- Shown only for Other countries + Percentage -->
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
                        <h6 class="font-weight-bold mb-3">How eBay Canada Fees Are Calculated</h6>

                        <p class="mb-2"><strong>Final Value Fee (FVF)</strong> &mdash; the main eBay fee, charged as a percentage of the total sale amount. Rates are tiered and vary by store subscription and category:</p>
                        <ul class="mb-3">
                            <li><strong>Most categories (no store):</strong> 13.25% up to CA$7,500, then 2.35% above</li>
                            <li><strong>Most categories (Basic/Premium/Anchor store):</strong> 12.35% up to CA$2,500, then 2.35%</li>
                            <li><strong>Electronics (phones, consumer electronics):</strong> 9% up to CA$2,500, then 2.35%</li>
                            <li><strong>High-end computers:</strong> 7% up to CA$2,500, then 2.35%</li>
                            <li><strong>Guitars:</strong> 6.35% up to CA$2,500 / CA$7,500 (store), then 2.35%</li>
                            <li><strong>Athletic clothing &ge;CA$150:</strong> 8% flat (no transaction fee)</li>
                            <li><strong>NFTs:</strong> 5% flat</li>
                            <li><strong>Heavy machinery:</strong> 3% up to CA$15,000, then 0.5%</li>
                        </ul>

                        <p class="mb-2"><strong>Seller Performance discount</strong> &mdash; apply a performance multiplier if your account qualifies for reduced fees (e.g. 0.9 for a 10% discount, 1.0 for standard).</p>

                        <p class="mb-2"><strong>Transaction Fee</strong> &mdash; CA$0.30 per order, plus the applicable provincial HST/GST on that fee. Waived for high-value athletic clothing.</p>

                        <p class="mb-2"><strong>Provincial Tax (HST/GST) on eBay Fees</strong> &mdash; eBay charges HST/GST on their FVF and transaction fee based on the province you are registered in. Rates range from 5% (Alberta, Northwest Territories, Nunavut, Yukon) to 15% (New Brunswick, Newfoundland, Nova Scotia, PEI). Quebec is 14.975%.</p>

                        <p class="mb-2"><strong>Promoted Listings</strong> &mdash; optional ad rate (%) charged on the total sale amount when the item sells via the promoted listing.</p>

                        <p class="mb-2"><strong>International Fee</strong> &mdash; extra charge when selling outside Canada: +0.4% for USA, +1% for all other countries.</p>

                        <p class="mb-2"><strong>Sales Tax (buyer-paid)</strong> &mdash; collected from the buyer; shown for reference only. For domestic sales this is the provincial rate in the buyer&apos;s province. For international sales, enter a fixed amount or percentage.</p>

                        <p class="mb-0"><strong>Profit</strong> = Total Revenue &minus; All eBay Fees &minus; Item Cost &minus; Shipping Paid. The margin % is profit as a share of total revenue.</p>
                    </div>
                </div><!-- /.card -->

                <!-- Results -->
                <div id="results-section" class="calc-results" style="display:none;">
                    <h5 class="calc-results__title">Results <small class="text-muted" style="font-size:.75rem;font-weight:400;">In CAD</small></h5>
                    <div class="calc-results__grid">

                        <div class="calc-card calc-card--fee">
                            <div class="calc-card__icon">&#128722;</div>
                            <div class="calc-card__label">Total eBay Fee</div>
                            <div class="calc-card__value" id="result-ebay-fee">-</div>
                            <ul class="calc-card__breakdown">
                                <li><span>FVF</span><strong id="result-total-fvf">-</strong></li>
                                <li><span>FVF rate</span><strong id="result-fvf-rate">-</strong></li>
                                <li><span>Transaction fee (incl. tax)</span><strong id="result-transaction-fee">-</strong></li>
                                <li id="result-promoted-row" style="display:none;"><span>Promoted listing</span><strong id="result-promoted-fee">-</strong></li>
                                <li id="result-international-row" style="display:none;"><span>International fee</span><strong id="result-international-fee">-</strong></li>
                                <li id="result-fee-tax-row" style="display:none;"><span>Fee tax (HST/GST)</span><strong id="result-fee-tax">-</strong></li>
                            </ul>
                        </div>

                        <div class="calc-card calc-card--tax">
                            <div class="calc-card__icon">&#128196;</div>
                            <div class="calc-card__label">Buyer Sales Tax</div>
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
// ─── Provincial tax rates (HST/GST applied to eBay fees) ─────────────────────
const PROV_TAX = {
    'Alberta':                   0.05,
    'British Columbia':          0.12,
    'Manitoba':                  0.12,
    'New Brunswick':             0.15,
    'Newfoundland and Labrador': 0.15,
    'Northwest Territories':     0.05,
    'Nova Scotia':               0.15,
    'Nunavut':                   0.05,
    'Ontario':                   0.13,
    'Prince Edward Island':      0.15,
    'Quebec':                    0.14975,
    'Saskatchewan':              0.11,
    'Yukon':                     0.05,
};

// ─── Dynamic field visibility ─────────────────────────────────────────────────
(function () {
    const intlEl      = document.getElementById('international_sales');
    const methodEl    = document.getElementById('sales_tax_method');
    const basedInWrap = document.getElementById('based_in_container');
    const taxWrap     = document.getElementById('sales_tax_container');
    const taxShipWrap = document.getElementById('tax_includes_shipping_wrapper');

    function syncIntl() {
        const v       = intlEl.value;
        const isDomestic   = v === 'No';
        const isIntl       = !isDomestic;
        const isOther      = v === 'Other countries';

        basedInWrap.style.display = isDomestic ? '' : 'none';
        taxWrap.style.display     = isIntl     ? '' : 'none';
        syncTaxShip();
    }

    function syncTaxShip() {
        const isOther = intlEl.value === 'Other countries';
        const isPct   = methodEl.value === 'percentage';
        taxShipWrap.style.display = (isOther && isPct) ? '' : 'none';
    }

    intlEl.addEventListener('change', syncIntl);
    methodEl.addEventListener('change', syncTaxShip);
    syncIntl();
})();

// ─── Tiered fee helper ────────────────────────────────────────────────────────
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

// ─── CA FVF calculator ────────────────────────────────────────────────────────
function calcFVF(category, totalSaleAmount, soldPrice, isStore) {
    let fvf = 0, noTransactionFee = false;

    if (isStore) {
        // Basic / Premium / Anchor
        switch (category) {
            case 'nft':              fvf = totalSaleAmount * 0.05; break;
            case 'books':            fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1325},{rate:0.0235}]); break;
            case 'movies_tv':        fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1325},{rate:0.0235}]); break;
            case 'music_default':    fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1325},{rate:0.0235}]); break;
            case 'music_vinyl':      fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1235},{rate:0.0235}]); break;
            case 'biz_heavy':        fvf = tieredFee(totalSaleAmount, [{upTo:15000,rate:0.025},{rate:0.005}]); break;
            case 'clothing_athletic':
                if (soldPrice < 150) { fvf = totalSaleAmount * 0.1235; }
                else                 { fvf = totalSaleAmount * 0.07; noTransactionFee = true; } break;
            case 'clothing_handbags': fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1235},{rate:0.0235}]); break;
            case 'coins_bullion':    fvf = tieredFee(totalSaleAmount, [{upTo:1500,rate:0.0735},{upTo:10000,rate:0.05},{rate:0.045}]); break;
            case 'coins_default':    fvf = tieredFee(totalSaleAmount, [{upTo:4000,rate:0.09},{rate:0.0235}]); break;
            case 'cell_phones':      fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.09},{rate:0.0235}]); break;
            case 'computers_highend':fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.07},{rate:0.0235}]); break;
            case 'computers_default':fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1235},{rate:0.0235}]); break;
            case 'consumer_elec':    fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.09},{rate:0.0235}]); break;
            case 'motors_tires':     fvf = tieredFee(totalSaleAmount, [{upTo:1000,rate:0.09},{rate:0.0235}]); break;
            case 'motors_parts':     fvf = tieredFee(totalSaleAmount, [{upTo:1000,rate:0.1135},{rate:0.0235}]); break;
            case 'guitars':          fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.0635},{rate:0.0235}]); break;
            case 'musical_dj':       fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.09},{rate:0.0235}]); break;
            case 'musical_default':  fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.10},{rate:0.0235}]); break;
            case 'video_consoles':   fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.07},{rate:0.0235}]); break;
            case 'video_games':      fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1235},{rate:0.0235}]); break;
            default:                 fvf = tieredFee(totalSaleAmount, [{upTo:2500,rate:0.1235},{rate:0.0235}]);
        }
    } else {
        // No store
        switch (category) {
            case 'nft':              fvf = totalSaleAmount * 0.05; break;
            case 'biz_heavy':        fvf = tieredFee(totalSaleAmount, [{upTo:15000,rate:0.03},{rate:0.005}]); break;
            case 'clothing_athletic':
                if (soldPrice < 150) { fvf = totalSaleAmount * 0.1325; }
                else                 { fvf = totalSaleAmount * 0.08; noTransactionFee = true; } break;
            case 'guitars':          fvf = tieredFee(totalSaleAmount, [{upTo:7500,rate:0.0635},{rate:0.0235}]); break;
            default:                 fvf = tieredFee(totalSaleAmount, [{upTo:7500,rate:0.1325},{rate:0.0235}]);
        }
    }
    return { fvf, noTransactionFee };
}

// ─── Main calculate function ──────────────────────────────────────────────────
function calculateFees(event) {
    event.preventDefault();

    const soldPrice      = parseFloat(document.getElementById('sold_price').value)       || 0;
    const shippingCharged= parseFloat(document.getElementById('shipping_charged').value) || 0;
    const itemCost       = parseFloat(document.getElementById('item_cost').value)        || 0;
    const shippingCost   = parseFloat(document.getElementById('shipping_cost').value)    || 0;
    const qty            = Math.max(1, parseInt(document.getElementById('quantity_sold').value) || 1);
    const store          = document.getElementById('ebay_store').value;
    const perfMult       = parseFloat(document.getElementById('seller_performance').value) || 1;
    const intlVal        = document.getElementById('international_sales').value;
    const promotedAdRate = parseFloat(document.getElementById('promoted_ad_rate').value)  || 0;
    const basedIn        = document.getElementById('based_in').value;
    const soldTo         = document.getElementById('where_you_sold_to').value;
    const salesTaxMethod = document.getElementById('sales_tax_method').value;
    const salesTaxAmount = parseFloat(document.getElementById('sales_tax_amount').value)  || 0;
    const taxInclShip    = document.getElementById('sales_tax_includes_shipping').value === 'Yes';
    const category       = document.getElementById('category').value;
    const isStore        = store !== 'No';

    const totalSaleAmount = soldPrice + shippingCharged;

    // ── FVF ───────────────────────────────────────────────────────────────────
    let { fvf: rawFVF, noTransactionFee } = calcFVF(category, totalSaleAmount, soldPrice, isStore);
    rawFVF *= perfMult; // apply seller performance multiplier
    const totalFVF = rawFVF;

    // ── Transaction fee + provincial tax on it ────────────────────────────────
    const baseTxFee     = noTransactionFee ? 0 : 0.30;
    const provTaxRateEbay = intlVal === 'No' ? (PROV_TAX[basedIn] || 0) : 0;
    const transactionFee  = baseTxFee * (1 + provTaxRateEbay) * qty;

    // ── Promoted listings ──────────────────────────────────────────────────────
    const promotedFee = (promotedAdRate / 100) * totalSaleAmount * qty;

    // ── International fee ──────────────────────────────────────────────────────
    const intlRate        = intlVal === 'USA' ? 0.004 : intlVal === 'Other countries' ? 0.01 : 0;
    const internationalFee = intlRate > 0 ? totalSaleAmount * intlRate * qty : 0;

    // ── Provincial tax on FVF ─────────────────────────────────────────────────
    const fvfTax    = (totalFVF * qty) * provTaxRateEbay;
    const totalFVFAllOrders = totalFVF * qty + fvfTax;

    // ── Total eBay fee ─────────────────────────────────────────────────────────
    const totalEbayFee = totalFVFAllOrders + transactionFee + promotedFee + internationalFee;

    // ── Buyer sales tax (charged on top, not deducted from profit) ────────────
    let buyerTax = 0;
    if (intlVal === 'No') {
        // domestic: buyer pays provincial tax
        buyerTax = totalSaleAmount * (PROV_TAX[soldTo] || 0) * qty;
    } else {
        // international manual override
        const taxBase = taxInclShip ? totalSaleAmount : soldPrice;
        buyerTax = salesTaxMethod === 'percentage'
            ? (salesTaxAmount / 100) * taxBase * qty
            : salesTaxAmount * qty;
    }

    // ── Profit ─────────────────────────────────────────────────────────────────
    const totalRevenue = totalSaleAmount * qty;
    const totalCosts   = (itemCost + shippingCost) * qty;
    const totalProfit  = totalRevenue - totalEbayFee - totalCosts;
    const profitMargin = totalRevenue > 0 ? (totalProfit / totalRevenue) * 100 : 0;
    const fvfRate      = totalSaleAmount > 0 ? (totalFVF / totalSaleAmount) * 100 : 0;

    // ── Render ─────────────────────────────────────────────────────────────────
    const fmt = n => 'CA$' + n.toFixed(2);

    document.getElementById('result-ebay-fee').textContent       = fmt(totalEbayFee);
    document.getElementById('result-total-fvf').textContent      = fmt(totalFVF * qty);
    document.getElementById('result-fvf-rate').textContent       = fvfRate.toFixed(2) + '%';
    document.getElementById('result-transaction-fee').textContent = fmt(transactionFee);
    document.getElementById('result-sales-tax').textContent      = fmt(buyerTax);
    document.getElementById('result-total-profit').textContent   = fmt(totalProfit);
    document.getElementById('result-profit-margin').textContent  = profitMargin.toFixed(2) + '% of sold price';

    function setRow(rowId, valId, val, show) {
        document.getElementById(rowId).style.display = show ? '' : 'none';
        if (show) document.getElementById(valId).textContent = fmt(val);
    }

    setRow('result-promoted-row',     'result-promoted-fee',     promotedFee,     promotedFee > 0);
    setRow('result-international-row','result-international-fee', internationalFee, internationalFee > 0);
    setRow('result-fee-tax-row',      'result-fee-tax',          fvfTax,          fvfTax > 0);

    const resultsEl = document.getElementById('results-section');
    resultsEl.style.display = '';
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
}
</script>
@endsection
