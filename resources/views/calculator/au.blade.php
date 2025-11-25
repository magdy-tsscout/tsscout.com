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
            <form method="post" action="{{ route('calculator.au.search') }}" id="calculateFeesForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">


                            <!-- Sold Price -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="sold_price">Sold Price</label>
                                    <input
                                        type="text"
                                        name="sold_price"
                                        id="sold_price"
                                        class="form-control"
                                        value="{{ old('sold_price', '100') }}"
                                    >
                                </div>
                            </div>

                            <!-- Shipping Charged -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label
                                        for="shipping_charged"
                                    >
                                        Shipping Charged (the amount you charge your buyer for shipping)
                                    </label>
                                    <input
                                        type="text"
                                        name="shipping_charged"
                                        id="shipping_charged"
                                        class="form-control"
                                        value="{{ old('shipping_charged', '1') }}"
                                    >
                                </div>
                            </div>

                            <!-- Item Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost</label>
                                    <input
                                        type="text"
                                        name="item_cost"
                                        id="item_cost"
                                        class="form-control"
                                        value="{{ old('item_cost', '') }}"
                                    >
                                </div>
                            </div>

                            <!-- Shipping Cost -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label
                                        for="shipping_cost"
                                    >
                                        Shipping Cost
                                    </label>
                                    <input
                                        type="text"
                                        name="shipping_cost"
                                        id="shipping_cost"
                                        class="form-control"
                                        value="{{ old('shipping_cost', '') }}"
                                    >
                                </div>
                            </div>

                            <!-- No. of Orders -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="no_of_orders">No. of Orders</label>
                                    <input
                                        type="number"
                                        name="no_of_orders"
                                        id="no_of_orders"
                                        class="form-control"
                                        value="{{ old('no_of_orders', '1') }}"
                                    >
                                </div>
                            </div>

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
                                        <option value="Featured">
                                            Featured
                                        </option>
                                        <option value="Anchor">
                                            Anchor
                                        </option>
                                    </select>
                                </div>
                            </div>




                            <div class="col-lg-4" id="oversea_sales_container">
                                <div class="form-group">
                                    <label for="oversea_sales">Oversea sales?</label>
                                    <select
                                        name="oversea_sales"
                                        id="oversea_sales"
                                        class="form-control">
                                        <option value="No">
                                            No
                                        </option>
                                        <option value="Germany">
                                            Germany
                                        </option>
                                        <option value="France">
                                            France
                                        </option>
                                        <option value="Italy">
                                            Italy
                                        </option>
                                        <option value="UK">
                                            UK
                                        </option>
                                        <option value="USA">
                                            USA
                                        </option>
                                        <option value="Other country">
                                            All other countries
                                        </option>
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


                            <!-- Has an ABN? -->
                            <div class="col-lg-4 collapse collpased" id="has_abn_container">
                                <div class="form-group">
                                    <label for="has_abn">Has an ABN?</label>
                                    <select
                                        name="has_abn"
                                        id="has_abn"
                                        class="form-control">
                                        <option value="No">
                                            No
                                        </option>
                                        <option value="Yes">
                                            Yes
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Sold in AUD? -->
                            <div class="col-lg-4 collapse collpased" id="sold_in_aud_container">
                                <div class="form-group">
                                    <label for="sold_in_aud">Sold in AUD?</label>
                                    <select
                                        name="sold_in_aud"
                                        id="sold_in_aud"
                                        class="form-control">
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
                                        <span class="badge badge-info">International sales tax</span>
                                        <div class="border-bottom"></div>
                                    </div>
                                    <!-- Sales Tax Calculation Method -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sales_tax_method">Sales Tax Calculation Method</label>
                                            <select
                                                name="sales_tax_method"
                                                id="sales_tax_method"
                                                class="form-control"
                                            >
                                                <option
                                                    value="% Percentage"
                                                    {{ old('sales_tax_method') == '% Percentage' ?
                                                        'selected' : '' }}
                                                >
                                                    Percentage
                                                </option>
                                                <option
                                                    value="$ Fixed amount"
                                                    {{ old('sales_tax_method') == '$ Fixed amount' ?
                                                        'selected' : '' }}
                                                >
                                                    Fixed amount
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="sales_tax_amount">Amount</label>
                                            <input
                                                type="number"
                                                name="sales_tax_amount"
                                                id="sales_tax_amount"
                                                class="form-control"
                                                value="{{ old('donated_to_charity', '') }}"
                                            >
                                        </div>
                                    </div>

                                    <div
                                        class="col-lg-4 collapse collpased"
                                        id="sales_tax_includes_shipping_continer"
                                    >
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




                                    <!-- Category -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            @include('calculator/categories')
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


            </form>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>
    const clps= 'collapse';
    $("#oversea_sales"). change( function( e ) {
        var v = $(this).val();
        var target= $("#sales_tax_container");
        console.log(v, target);

        if(
            v == 'USA' ||
            v == 'Other country'
        ){
            target.removeClass(clps);
        }else{
            target.addClass(clps);
        }

        if( v == 'Other country' ) {
            $("#sales_tax_includes_shipping_continer") .removeClass(clps);
        }else{
            $("#sales_tax_includes_shipping_continer") .addClass(clps);
        }

        if( v== 'No' )  {
            $("#sold_in_aud_container").removeClass(clps);
        }else{
            $("#sold_in_aud_container").addClass(clps);
        }

    } );

    $("#ebay_store") . change ( function ( e ) {
        var v= $(this).val();
        if( v == 'No' ){
            $("#has_abn_container").addClass(clps);
        }else{
            $("#has_abn_container").removeClass(clps);
        }
    } )
</script>
@endsection
