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
            <form method="post" action="{{ route('calculator.it.search') }}" id="calculateFeesForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @include('calculator/categories')
                                </div>
                            </div>


                            <div class="col-lg-4" id="selling_price_container">
                                <div class="form-group">
                                    <label for="selling_price">Selling Price</label>
                                    <input
                                        id="selling_price"
                                        name="selling_price"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                        value=""
                                        autocomplete="new-password"
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
                                        value=""
                                        autocomplete="new-password"
                                    />
                                    <small class="form-text text-muted">
                                        The amount charged to the buyer for shipping
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="item_cost_container">
                                <div class="form-group">
                                    <label for="item_cost">Item cost</label>
                                    <input
                                        id="item_cost"
                                        name="item_cost"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                        value=""
                                        autocomplete="new-password"
                                    />
                                    <small class="form-text text-muted">
                                        Includes the VAT you paid for the item
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="shipping_cost2_container">
                                <div class="form-group">
                                    <label for="shipping_cost2">Shipping Costs (VAT Included)</label>
                                    <input
                                        id="shipping_cost2"
                                        name="shipping_cost2"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                        value=""
                                        autocomplete="new-password"
                                    />
                                    <small class="form-text text-muted">
                                        Includes the VAT you paid for shipping
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-4" id="order_no_container">
                                <div class="form-group">
                                    <label for="order_no"> No. of Orders </label>
                                    <input
                                        id="order_no"
                                        name="order_no"
                                        step="1"
                                        class="form-control"
                                        type="number"
                                        value="1"
                                        autocomplete="new-password"
                                    />
                                </div>
                            </div>

                            <div class="col-lg-4" id="seller_type_container">
                                <div class="form-group">
                                    <label for="seller_type">Type of Seller</label>
                                    <select
                                        id="seller_type"
                                        name="seller_type"
                                        class="form-control"
                                    >
                                        <option value="Private">Private</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4" id="international_sales_container">
                                <div class="form-group">
                                    <label for="international_sales">International Sales</label>
                                    <select
                                        id="international_sales"
                                        name="international_sales"
                                        class="form-control"
                                    >
                                        <option value="No" selected>No</option>
                                        <option value="Eurozone and Sweden">Eurozone and Sweden</option>
                                        <option value="Europe, USA and Canada">Europe, USA, and Canada</option>
                                        <option value="GB">GB</option>
                                        <option value="Other Countries">All other countries</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4" id="fvf_promotion_container">
                                <div class="form-group">
                                    <label for="fvf_promotion">FVF Promotion</label>
                                    <select
                                        id="fvf_promotion"
                                        name="fvf_promotion"
                                        class="form-control"
                                    >
                                        <option value="No" selected>No</option>
                                        <option value="Max of 1 € FVF">Max of €1 FVF</option>
                                        <option value="Max of 2 € FVF">Max of €2 FVF</option>
                                        <option value="5% FVF">5% FVF</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 collapse collapsed" id="vat_container">
                                <div class="form-group">
                                    <label for="vat">VAT (%)</label>
                                    <input
                                        id="vat"
                                        name="vat"
                                        step="1"
                                        class="form-control"
                                        type="number"
                                        value="22"
                                        autocomplete="new-password"
                                    />
                                </div>
                            </div>


                            <div class="col-lg-4" id="sponsored_listing_rate_container">
                                <div class="form-group">
                                    <label for="sponsored_listing_rate">Sponsored Listing Rate (%)</label>
                                    <input
                                        id="sponsored_listing_rate"
                                        name="sponsored_listing_rate"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                        value=""
                                        autocomplete="new-password"
                                    />
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
    $("#seller_type") . change ( function( e ) {
        if( $(this).val() == 'Commercial' ) {
            $("#vat_container"). removeClass( clps )
            $("#fvf_promotion_container"). addClass( clps )
        }else {
            $("#vat_container"). addClass( clps )
            $("#fvf_promotion_container"). removeClass( clps )
        }
    } )
</script>
@endsection
