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
            <form method="post" action="{{ route('calculator.fr.search') }}" id="calculateFeesForm">
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

                            <div class="col-lg-6" id="sales_price_container">
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
                                    <label for="shipping_cost">Shipping cost</label>
                                    <input
                                        id="shipping_cost"
                                        name="shipping_cost"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>

                            <div class="col-lg-4" id="item_cost_container">
                                <div class="form-group">
                                    <label for="item_cost">Item Cost</label>
                                    <input
                                        id="item_cost"
                                        name="item_cost"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>


                            <div class="col-lg-4" id="shipping_cost2_container">
                                <div class="form-group">
                                    <label for="shipping_cost2">Shipping cost</label>
                                    <input
                                        id="shipping_cost2"
                                        name="shipping_cost2"
                                        step="1"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                            </div>





                            <div class="col-lg-4" id="sold_quantity_container">
                                <div class="form-group">
                                    <label for="sold_quantity">Quantity Sold</label>
                                    <input
                                        id="sold_quantity"
                                        name="sold_quantity"
                                        step="1"
                                        class="form-control"
                                        type="number"
                                        value="1"
                                    />
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

                            <div class="col-lg-4" id="payment_method_container">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select
                                        id="payment_method"
                                        name="payment_method"
                                        class="form-control"
                                    >
                                        <option selected value="PayPal">PayPal</option>
                                        <option value="Paypal Micropayments">Paypal Micropayments</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4" id="international_sales_container">
                                <div class="form-group">
                                    <label for="international_sales">International Sales?</label>
                                    <select
                                        id="international_sales"
                                        name="international_sales"
                                        class="form-control"
                                    >
                                        <option selected value="No">No</option>
                                        <option value="Northern Europe">Northern Europe</option>
                                        <option value="Europe I">Europe I</option>
                                        <option value="Other Countries">Other Countries</option>
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
                                        type="text"
                                        value="20"
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
    $("#international_sales").change ( function() {
        if ( $(this).val() != 'Private' )  {
            $("#vat_container").removeClass('collapse');
        }else{
            $("#vat_container").addClass('collapse');
        }
    } );
</script>
@endsection
