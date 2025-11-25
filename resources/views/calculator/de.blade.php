@extends('layouts.master')
@section('title','ebay fees calcaulator')

@section('styles')
    <link
        rel="stylesheet"
        href="{{ asset('public/css/ebay-calculator.css') }}" />
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

        <!-- Display Result if available -->
        @isset($result)
            @include('calculator.result')
        @endisset

        <div class="form-container">
            <form method="post" action="{{ route('calculator.de.search') }}" id="calculateFeesForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <!-- Sold Price -->
                            <div class="col-lg-4" id="sales_price_container">
                                <div class="form-group">
                                    <label for="sales_price">Sales Price</label>
                                    <input
                                        id="sales_price"
                                        name="sales_price"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>

                            <div class="col-lg-4" id="shipping_cost_container">
                                <div class="form-group">
                                    <label for="shipping_cost">Shipping Costs</label>
                                    <input
                                        id="shipping_cost"
                                        name="shipping_cost"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                    <small>The amount you charge your buyer for shipping</small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="item_cost_container">
                                <div class="form-group">
                                    <label for="item_cost">Item Costs</label>
                                    <input
                                        id="item_cost"
                                        name="item_cost"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                    <small>Includes VAT that you paid for the item</small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="shipping_cost_paid_container">
                                <div class="form-group">
                                    <label for="shipping_cost">Shipping Costs</label>
                                    <input
                                        id="shipping_cost"
                                        name="shipping_cost"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                    <small>Includes VAT that you paid for shipping</small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="seller_type_container">
                                <div class="form-group">
                                    <label for="seller_type">Seller Type</label>
                                    <select
                                        id="seller_type"
                                        name="seller_type"
                                        class="form-control"
                                    >
                                        <option selected value="Private">Private</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4" id="order_count_container">
                                <div class="form-group">
                                    <label for="order_count">Number of Orders</label>
                                    <input
                                        id="order_count"
                                        name="order_count"
                                        step="1"
                                        class="form-control"
                                        type="number"
                                        value="1"
                                    />
                                </div>
                            </div>

                            <div class="col-lg-4 collapse collapsed" id="sold_items_count_container">
                                <div class="form-group">
                                    <label for="sold_items_count">Number of Sold Items</label>
                                    <input
                                        id="sold_items_count"
                                        name="sold_items_count"
                                        step="1"
                                        class="form-control"
                                        type="number"
                                        value="1"
                                    />
                                    <small>Number of sold items per order</small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="international_distribution_container">
                                <div class="form-group">
                                    <label for="international_distribution">International Sales?</label>
                                    <select
                                        id="international_distribution"
                                        name="international_distribution"
                                        class="form-control"
                                    >
                                        <option selected value="Eurozone and Sweden">Eurozone and Sweden</option>
                                        <option value="Europe, USA and Canada">Europe, USA and Canada</option>
                                        <option value="UK">UK</option>
                                        <option value="Alle anderen Länder">Other Countries</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-log-4 collapse collpased" id="ebay_business_container">
                                <div class="form-group">
                                    <label for="">
                                        eBay business?
                                    </label>
                                    <select id="ebay_business" name="ebay_business" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Basic">Basic</option>
                                        <option value="Top">Top</option>
                                        <option value="Premium">Premium</option>
                                        <option value="Platinum">Platinum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="promotions">Promotions?</label>
                                    <select name="promotions" id="promotions" class="form-control">
                                        <option value="No">No</option>
                                        <option value="% off sales commission">% Sales commission</option>
                                    </select>
                                </div>
                            </div>





                            <div class="col-lg-4" id="discount_percentage_container" style="display: none;">
                                <div class="form-group">
                                    <label for="discount_percentage">Discount Percentage (%)</label>
                                    <input
                                        id="discount_percentage"
                                        name="discount_percentage"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>


                            <div class="col-lg-4 collapse collapsed" id="service_status_container">
                                <div class="form-group">
                                    <label for="service_status">Service Status</label>
                                    <select
                                        id="service_status"
                                        name="service_status"
                                        class="form-control"
                                    >
                                        <option value="Top Rating">Top Rating</option>
                                        <option selected value="Above Average">Above Average</option>
                                        <option value="Below Average">Below Average</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4" id="vat_percentage_container">
                                <div class="form-group">
                                    <label for="vat_percentage">VAT (%)</label>
                                    <input
                                        id="vat_percentage"
                                        name="vat_percentage"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                        value="19"
                                    />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @include('calculator/categories')
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mt-1">Calculate Fees</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    const clps= 'collapse';
    const classes= "#sold_items_count_container,"+
            "#service_status_container,"+
            "#vat_percentage_container"
        ;
$("#seller_type") . change ( function ( e ) {
    if( $(this).val() == 'Private' ) {
        $("#ebay_business"). removeClass( clps )
        $(classes). addClass( clps )
    }else{
        $("#ebay_business"). addClass( clps )
        $(classes). removeClass( clps )
    }
} );

$("#promotions"). change( function( e ) {
    if( $(this) . val() == 'No' ) $("#discount_percentage_container").hide();
    else $("#discount_percentage_container").show();
});
</script>
@endsection
