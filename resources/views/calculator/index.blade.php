@extends('layouts.master')
@section('title','ebay fees calcaulator')

@section('styles')
    <link
        rel="stylesheet"
        href="{{ asset('public/css/ebay-calculator.css') }}" />
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
            <!-- Display Result if available -->
        @isset($result)
            @include('calculator.result')
        @endisset
            <div class="form-container">
                <form method="post" action="{{ route('calculator.calculateFees') }}" id="calculateFeesForm">
                    @csrf
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body row">
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
                                        <input type="text" name="sold_price" id="sold_price" class="form-control" value="{{ old('sold_price', '100') }}">
                                    </div>
                                </div>

                                <!-- Shipping Charged -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="shipping_charged">Shipping Charged</label>
                                        <input type="text" name="shipping_charged" id="shipping_charged" class="form-control" value="{{ old('shipping_charged', '1') }}">
                                    </div>
                                </div>

                                <!-- Item Cost -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="item_cost">Item Cost</label>
                                        <input type="text" name="item_cost" id="item_cost" class="form-control" value="{{ old('item_cost', '') }}">
                                    </div>
                                </div>

                                <!-- Shipping Cost -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="shipping_cost">Shipping Cost</label>
                                        <input type="text" name="shipping_cost" id="shipping_cost" class="form-control" value="{{ old('shipping_cost', '') }}">
                                    </div>
                                </div>

                                <!-- No. of Orders -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="no_of_orders">No. of Orders</label>
                                        <input type="number" name="no_of_orders" id="no_of_orders" class="form-control" value="{{ old('no_of_orders', '1') }}">
                                    </div>
                                </div>

                                <!-- eBay Store -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="ebay_store">eBay Store?</label>
                                        <select name="ebay_store" id="ebay_store" class="form-control">
                                            <option value="Starter" {{ old('ebay_store') == 'Starter' ? 'selected' : '' }}>Starter</option>
                                            <option value="Basic" {{ old('ebay_store') == 'Basic' ? 'selected' : '' }}>Basic</option>
                                            <option value="Premium" {{ old('ebay_store') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="Anchor" {{ old('ebay_store') == 'Anchor' ? 'selected' : '' }}>Anchor</option>
                                            <option value="Enterprise" {{ old('ebay_store') == 'Enterprise' ? 'selected' : '' }}>Enterprise</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Seller Level -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="seller_level">Seller Level</label>
                                        <select name="seller_level" id="seller_level" class="form-control">
                                            <option value="Top Rated" {{ old('seller_level') == 'Top Rated' ? 'selected' : '' }}>Top Rated</option>
                                            <option value="Above Standard" {{ old('seller_level') == 'Above Standard' ? 'selected' : '' }}>Above Standard</option>
                                            <option value="Standard" {{ old('seller_level') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                            <option value="Below Standard" {{ old('seller_level') == 'Below Standard' ? 'selected' : '' }}>Below Standard</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Promoted Ad Rate -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="promoted_ad_rate">Promoted Ad Rate (%)</label>
                                        <input type="text" name="promoted_ad_rate" id="promoted_ad_rate" class="form-control" value="{{ old('promoted_ad_rate', '') }}">
                                    </div>
                                </div>

                                <!-- Donated to Charity -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="donated_to_charity">Donated to Charity (%)</label>
                                        <input type="text" name="donated_to_charity" id="donated_to_charity" class="form-control" value="{{ old('donated_to_charity', '') }}">
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
                                            <option value="% Percentage" {{ old('sales_tax_method') == '% Percentage' ? 'selected' : '' }}>Percentage</option>
                                            <option value="$ Fixed amount" {{ old('sales_tax_method') == '$ Fixed amount' ? 'selected' : '' }}>Fixed amount</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="sales_tax_amount">Amount</label>
                                        <input type="number" name="sales_tax_amount" id="sales_tax_amount" class="form-control" value="{{ old('donated_to_charity', '') }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Sales tax includes shipping?</label>
                                        <select
                                            id="sales_tax_includes_shipping"
                                            name="sales_tax_includes_shipping"
                                            class="form-control"
                                        >
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary mt-1">Calculate Fees</button>
                            </div>
                        </div>

                    <!-- Display Result if available -->
                    @isset($result)
                    <div class="row text-center mt-4">
                        <div class="col-lg-4">
                            <h4 class="text-muted">eBay Fee: {{ $result['eBay Fee'] }}</h4>
                            <p>
                                Total FVF: {{ $result['Total FVF'] }} <br />
                                FVF rate: {{ $result['FVF rate'] }} <br />
                                Transaction fee: {{ $result['Transaction fee'] }} <br />
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="text-muted">Sales Tax: {{ $result['Sales Tax'] }}</h4>
                            <h5>Charged to buyer only</h5>
                        </div>
                        <div class="col-lg-4">
                            <h4 class="text-muted">Total Profit: {{ $result['Total Profit'] }}</h4>
                            <h5>Profit margin: {{ $result['Profit margin'] }}</h5>
                        </div>
                    </div>
                    @endisset
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
