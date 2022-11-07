@extends('layouts.frontendmaster')

@section('content')
 <!-- breadcrumb_section - start
    ================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Check Out</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
    ================================================== -->


<!-- checkout-section - start
    ================================================== -->
<div class="container">
    <form action="{{ route('checkout.post') }}" method="POST">
        @csrf
        <div class="row my-5">
            <div class="col-8">
                <div class="card text-start">
                    <div class="card-header">
                        <h4>Billing Address</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="customer_name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="customer_email" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="customer_phone_number" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Country</label>
                                    <select class="form-select" name="customer_country_id" id="country_dropdown">
                                        <option value="">--Select Country--</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">City</label>
                                    <select class="form-select" name="customer_city_id" id="city_dropdown">
                                        <option value="">--Select City--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <textarea name="customer_address" class="form-control"rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Other Notes</label>
                            <textarea name="customer_notes" class="form-control"rows="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Your Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>৳{{ session('subtotal') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>
                                            @if (session('coupon_info'))
                                                @if (session('coupon_info')->discount_type == 'percentage')
                                                    -{{ session('coupon_info')->coupon_discount_amount }}%
                                                @else
                                                    -৳{{ session('coupon_info')->coupon_discount_amount }}
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charge</td>
                                        <td>+৳{{ session('shipping_charge') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>৳{{ session('order_total') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr style="height: 2px; color: rgb(219, 219, 219)">
                        <div>
                            <div class="mb-3">
                                <label for="" class="form-label">Payment Option</label>
                                <select class="form-select" name="payment" id="">
                                    <option value="">--Select Payment Option--</option>
                                    <option value="cod">Cash On Delivery (COD)</option>
                                    <option value="online">Online Payment</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- checkout-section - end
    ================================================== -->
@endsection
@section('footer_scripts')
    <script>
        $(document).ready(function(){
            $('#country_dropdown').change(function(){
                var country_code = $(this).val();
                if(country_code != 0){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:'POST',
                        url:'/getcitylist',
                        data: {country_code: country_code},
                        success: function (data) {
                            $("#city_dropdown").html(data);
                        }
                    });
                }
                else{
                    alert("Please select a country!");
                }
            })
        })
    </script>
@endsection
