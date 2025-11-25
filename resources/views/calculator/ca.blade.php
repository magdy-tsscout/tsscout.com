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


        <!-- Display Result if available -->
        @isset($result)
            @include('calculator.result')
        @endisset
        <div class="form-container">
            <form method="post" action="{{ route('calculator.ca.search') }}" id="calculateFeesForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Category -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @include('calculator/categories')
                                </div>
                            </div>

                            <!-- Sold Price -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="sold_price">Sold Price</label>
                                    <input type="text" name="sold_price" id="sold_price" class="form-control" value="{{ old('sold_price', '100') }}">
                                </div>
                            </div>

                            <!-- Shipping Charged -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="shipping_charged">Shipping Charged (the amount you charge your buyer for shipping)</label>
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

                            <!-- Quantity sold -->
                            <div class="col-lg-4" id="quantity_sold_container">
                                <div class="form-group">
                                    <label for="quantity_sold">Quantity sold</label>
                                    <input
                                        type="number"
                                        name="quantity_sold"
                                        id="quantity_sold"
                                        class="form-control"
                                        step="1"
                                        value="1"
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <!-- eBay store? -->
                            <div class="col-lg-4" id="ebay_store_container">
                                <div class="form-group">
                                    <label for="ebay_store">eBay store?</label>
                                    <select
                                        name="ebay_store"
                                        id="ebay_store"
                                        class="form-control">
                                        <option value="No">
                                            No
                                        </option>
                                        <option value="Basic">
                                            Basic
                                        </option>
                                        <option value="Premium">
                                            Premium
                                        </option>
                                        <option value="Anchor">
                                            Anchor
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Seller performance -->
                            <div class="col-lg-4" id="seller_performance_container">
                                <div class="form-group">
                                    <label for="seller_performance">Seller performance</label>
                                    <select
                                        name="seller_performance"
                                        id="seller_performance"
                                        class="form-control">
                                        <option value="0.9">
                                            Top-rated
                                        </option>
                                        <option value="1" selected>
                                            Above Standard
                                        </option>
                                        <option value="1.05">
                                            Below Standard
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- International sales? -->
                            <div class="col-lg-4" id="international_sales_container">
                                <div class="form-group">
                                    <label for="international_sales">International sales?</label>
                                    <select
                                        name="international_sales"
                                        id="international_sales"
                                        class="form-control">
                                        <option value="No" selected>
                                            No
                                        </option>
                                        <option value="USA">
                                            USA
                                        </option>
                                        <option value="Other countries">
                                            Other countries
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Where are you based in? -->
                        <div class="col-lg-4 collapse collapsed" id="based_in_container">
                            <div class="form-group">
                                <label for="based_in">Where are you based in?</label>
                                <select
                                    name="based_in"
                                    id="based_in"
                                    class="form-control">
                                    <option value="Alberta">
                                        Alberta
                                    </option>
                                    <option value="British Columbia">
                                        British Columbia
                                    </option>
                                    <option value="Manitoba">
                                        Manitoba
                                    </option>
                                    <option value="New Brunswick">
                                        New Brunswick
                                    </option>
                                    <option value="Newfoundland and Labrador">
                                        Newfoundland and Labrador
                                    </option>
                                    <option value="Northwest Territories">
                                        Northwest Territories
                                    </option>
                                    <option value="Nova Scotia">
                                        Nova Scotia
                                    </option>
                                    <option value="Nunavut">
                                        Nunavut
                                    </option>
                                    <option selected="" value="Ontario">
                                        Ontario
                                    </option>
                                    <option value="Prince Edward Island">
                                        Prince Edward Island
                                    </option>
                                    <option value="Quebec">
                                        Quebec
                                    </option>
                                    <option value="Saskatchewan">
                                        Saskatchewan
                                    </option>
                                    <option value="Yukon">
                                        Yukon
                                    </option>
                                </select>
                            </div>
                        </div>



                            <!-- Where you sold to? -->
                            <div class="col-lg-4" id="where_you_sold_to_container">
                                <div class="form-group">
                                    <label for="where_you_sold_to">Where you sold to?</label>
                                    <select
                                        name="where_you_sold_to"
                                        id="where_you_sold_to"
                                        class="form-control">
                                        <option value="Alberta">
                                            Alberta
                                        </option>
                                        <option value="British Columbia">
                                            British Columbia
                                        </option>
                                        <option value="Manitoba">
                                            Manitoba
                                        </option>
                                        <option value="New Brunswick">
                                            New Brunswick
                                        </option>
                                        <option value="Newfoundland and Labrador">
                                            Newfoundland and Labrador
                                        </option>
                                        <option value="Northwest Territories">
                                            Northwest Territories
                                        </option>
                                        <option value="Nova Scotia">
                                            Nova Scotia
                                        </option>
                                        <option value="Nunavut">
                                            Nunavut
                                        </option>
                                        <option value="Ontario" selected>
                                            Ontario
                                        </option>
                                        <option value="Prince Edward Island">
                                            Prince Edward Island
                                        </option>
                                        <option value="Quebec">
                                            Quebec
                                        </option>
                                        <option value="Saskatchewan">
                                            Saskatchewan
                                        </option>
                                        <option value="Yukon">
                                            Yukon
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Promoted ad rate (%) -->
                            <div class="col-lg-4" id="promoted_ad_rate_container">
                                <div class="form-group">
                                    <label for="promoted_ad_rate">Promoted ad rate (%)</label>
                                    <input
                                        type="number"
                                        name="promoted_ad_rate"
                                        id="promoted_ad_rate"
                                        class="form-control"
                                        step="1"
                                        value=""
                                        aria-label="Promoted ad rate (%)"
                                    />
                                </div>
                            </div>

                            <!-- Sold in Canadian dollar? -->
                            <div class="col-lg-4" id="sold_in_cad_container">
                                <div class="form-group">
                                    <label for="sold_in_cad">Sold in Canadian dollar?</label>
                                    <select
                                        name="sold_in_cad"
                                        id="sold_in_cad"
                                        class="form-control"
                                        aria-label="Sold in Canadian dollar?"
                                    >
                                        <option value="No">
                                            No
                                        </option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                    </select>
                                </div>
                            </div>































                            <div class="col-12">
                                <div class="row collapse collapsed" id="sales_tax_container">
                                    <div class="col-12 mb-4">
                                        <span class="badge badge-info">Sales tax</span>
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

                                    <div class="col-lg-4 collapse collpased" id="sales_tax_includes_shipping_continer">
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
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mt-1">Calculate Fees</button>
                    </div>
                </div>

                <!-- Display Result if available -->

            </form>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    const clps= 'collapse';
    $("#international_sales_container"). change( function( e ) {
        var v = $(this).val();
        var target= $("#sales_tax_container");
        console.log(v, target);

        if(
            v == 'USA' ||
            v == 'Other countries'
        ){
            target.removeClass(clps);
        }else{
            target.addClass(clps);
        }

        if( v == 'Other countries' ) {
            $("#sales_tax_includes_shipping_continer") .removeClass(clps);
        }else{
            $("#sales_tax_includes_shipping_continer") .addClass(clps);
        }


        if( v == 'No' ) {
            $("#based_in_container") .removeClass(clps);
        }else{
            $("#based_in_container") .addClass(clps);
        }



    } );


</script>
@endsection
