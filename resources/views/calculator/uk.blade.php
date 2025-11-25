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
            <form
                method="post"
                action="{{ route('calculator.uk.search') }}"
                id="calculateFeesForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">


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

                            <div class="col-lg-4">
                                <label for="seller_type">Seller type</label>
                                <select
                                    id="seller_type"
                                    name="seller_type" class="form-control"
                                >
                                    <option
                                        value="Private"
                                    >
                                        Private
                                    </option>
                                    <option
                                        value="Business"
                                    >
                                        Business
                                    </option>
                                </select>
                            </div>


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

                            <!-- FVF promotion? -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="fvf_promotion">FVF promotion?</label>
                                    <select name="fvf_promotion" id="fvf_promotion" class="form-control">
                                        <option
                                            value="No"
                                        >
                                            No
                                        </option>
                                        <option
                                            value="% off FVF"
                                        >
                                            % off FVF
                                        </option>
                                        <option
                                            value="Max FVF"
                                        >
                                            Max FVF
                                        </option>
                                        <option
                                            value="2% FVF"
                                        >
                                            2% FVF
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Oversea sales? -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="oversea_sales">Oversea sales?</label>
                                    <select
                                        name="oversea_sales"
                                        id="oversea_sales"
                                        class="form-control">
                                        <option
                                            value="No"
                                        >
                                            No
                                        </option>
                                        <option
                                            value="Germany"
                                        >
                                            Germany
                                        </option>
                                        <option
                                            value="France"
                                        >
                                            France
                                        </option>
                                        <option
                                            value="Italy"
                                        >
                                            Italy
                                        </option>
                                        <option
                                            value="Other Eurozone &amp; Northern Europe"
                                        >
                                            Other Eurozone &amp; Northern Europe
                                        </option>
                                        <option
                                            value="United States"
                                        >
                                            United States
                                        </option>
                                        <option
                                            value="Canada"
                                        >
                                            Canada
                                        </option>
                                        <option
                                            value="All other countries"
                                        >
                                            All other countries
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="sold_in_pound_container">
                                <div class="form-group">
                                    <label for="sold_in_pound">Sold in British Pound?</label>
                                    <select
                                        name="sold_in_pound"
                                        id="sold_in_pound"
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
                            <div class="col-lg-3 collapse collapsed" id="residing_in_uk_container">
                                <div class="form-group">
                                    <label for="residing_in_uk">Residing inside the UK?</label>
                                    <select
                                        name="residing_in_uk"
                                        id="residing_in_uk"
                                        class="form-control">
                                        <option value="Yes">
                                            Yes
                                        </option>
                                        <option value="No">
                                            No
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row" id="sales_tax_container">
                                    <div class="col-12 mb-4">
                                        <span class="badge badge-info">International sales tax</span>
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

                            <!-- Category -->
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


                </div>
            </form>
        </div>

</div>
@endsection

@section('script')
<script>

    $("#oversea_sales"). change( function( e ) {
        var v = $(this).val();
        var target= $("#residing_in_uk_container");
        var shipping= $("#sales_tax_includes_shipping_continer");
        var clps= 'collapse';
        if(
            v == 'Other Eurozone & Northern Europe' ||
            v == 'United States' ||
            v == 'All other countries'
        ){
            target.removeClass(clps);
        }else{
            target.addClass(clps);
        }

        if( v == 'United States'){
            shipping.removeClass(clps);
        }else{
            shipping.addClass(clps);
        }
    } );
</script>
@endsection
