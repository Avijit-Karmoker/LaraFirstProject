<div>
    <section class="cart_section section_space">
        <div class="container">

            <div class="cart_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Color</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Remove</th>
                        </tr>
                    </thead>
                    <style>
                        .warning{
                            background-color: #f37a2a;
                        }
                    </style>
                    <tbody>
                        @php
                            $subtotal = 0;
                            $error = false;
                        @endphp
                        @foreach ($carts as $cart)
                        @php
                            if(get_inventory($cart->product_id, $cart->size_id, $cart->color_id) < $cart->quantity){
                                $error = true;
                            }
                        @endphp
                            <tr class="{{ (get_inventory($cart->product_id, $cart->size_id, $cart->color_id) < $cart->quantity) ? 'warning' : '' }}">
                                <td>
                                    <div class="cart_product">
                                        <img src="{{ asset('uploads/product_thumbnail') }}/{{ $cart->relationshipwithproduct->thumbnail }}" alt="image_not_found">
                                        <h3>
                                            <a href="{{ route('product.details', $cart->product_id) }}" target="_blank">
                                                {{ $cart->relationshipwithproduct->product_name }}
                                            </a>
                                            <span class="badge bg-info">{{ $cart->relationshipwithuser->name }}</span>
                                            <br>
                                            @if (get_inventory($cart->product_id, $cart->size_id, $cart->color_id) < $cart->quantity)
                                                <span class="badge bg-warning">Available Stock: {{ get_inventory($cart->product_id, $cart->size_id, $cart->color_id) }}</span>
                                            @endif
                                        </h3>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($cart->relationshipwithproduct->discounted_price)
                                        <span class="price_text pe-2">৳{{ $cart->relationshipwithproduct->discounted_price }} </span>
                                        <del class="price_text"> ৳{{ $cart->relationshipwithproduct->regular_price }}</del>
                                    @else
                                        <span class="price_text">৳{{ $cart->relationshipwithproduct->regular_price }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge"
                                        style="background: @if ($cart->relationshipwithcolor->color_name == 'White')
                                            #000000
                                        @else
                                            {{ $cart->relationshipwithcolor->color_code }}
                                        @endif">
                                        {{ Str::title($cart->relationshipwithcolor->color_name) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $cart->relationshipwithsize->size }}
                                </td>
                                <td class="text-center">
                                    <form action="#">
                                        <div class="quantity_input">
                                            @if (get_inventory($cart->product_id, $cart->size_id, $cart->color_id) > 1)
                                                <button wire:click="decrement({{ $cart->id }})" type="button" class="input_number_decrement">
                                                    <i class="fal fa-minus"></i>
                                                </button>
                                            @endif
                                            <input wire:keyup="input_cart_amount({{ $cart->id }}, $event.target.value)" type="text" value="{{ $cart->quantity }}" />
                                            @if (get_inventory($cart->product_id, $cart->size_id, $cart->color_id) > $cart->quantity)
                                                <button wire:click="increment({{ $cart->id }})" type="button" class="input_number_increment">
                                                    <i class="fal fa-plus"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <span class="price_text">
                                        ৳{{ cart_total($cart->product_id, $cart->quantity) }}
                                        @php
                                            $subtotal += cart_total($cart->product_id, $cart->quantity);
                                        @endphp
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="remove_btn" wire:click="delete({{ $cart->id }})">
                                        <i class="fal fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart_btns_wrap">
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="coupon_form form_item mb-0">
                            <input type="text" wire:model="coupon_name" placeholder=" @if (session('coupon_info'))৳{{ session('coupon_info')->coupon_discount_amount }} @else Enter your coupon here @endif ">
                            <button wire:click="apply_coupon({{ $carts->first()->vendor_id }},{{ $subtotal }})" type="submit" class="btn btn_dark">Apply Coupon</button>
                            <div class="info_icon">
                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                            </div>
                        </div>
                        <div>
                            @if ($coupon_error)
                                <div class="alert text-danger mb-0 pb-0">
                                    {{ $coupon_error }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            {{-- <li><a class="btn border_black" href="#!">Update Cart</a></li> --}}
                            <li>
                                @if ($error)
                                    <button class="btn btn_dark" disabled>Proceed To Checkout</button>
                                @else
                                    @if ($shipping_id != 0)
                                        <a class="btn btn_dark" href="{{ route('checkout') }}">Proceed To Checkout</a>
                                    @else
                                        <button class="btn bg-danger">Please select shipping</button>
                                    @endif
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col col-lg-6">
                    <div class="calculate_shipping">
                        <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="fas fa-arrow-up"></i></span></h3>
                        <form action="#">
                            <div class="select_option clearfix">
                                <select class="form-select w-50" wire:model="shipping_dropdown">
                                    <option value="0">Select Your Option</option>
                                    @foreach ($shippings as $shipping)
                                        <option value="{{ $shipping->id }}">{{ $shipping->shipping_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <br>
                            <button type="submit" class="btn btn_primary rounded-pill">Update Total</button> --}}
                        </form>
                    </div>
                </div>

                <div class="col col-lg-6">
                    <div class="cart_total_table">
                        <h3 class="wrap_title">Cart Totals</h3>
                        <ul class="ul_li_block">
                            <li>
                                <span>Cart Subtotal</span>
                                <span>৳{{ $subtotal }}</span>
                            </li>
                            <li>
                                <span>Discount Amount</span>
                                @if (session('coupon_info'))
                                    @if(session('coupon_info')->discount_type == 'flat')
                                        <span class="text-info">৳{{ session('coupon_info')->coupon_discount_amount }} ({{ session('coupon_info')->coupon_name }})</span>
                                    @else
                                        <span class="text-info">{{ session('coupon_info')->coupon_discount_amount }}% ({{ session('coupon_info')->coupon_name }})</span>
                                    @endif
                                @else
                                    <span class="text-info">৳0</span>
                                @endif
                                {{-- @if($after_discount_subtotal)
                                    <span>৳{{ $subtotal - $after_discount_subtotal }}</span>
                                @else
                                    <span>৳0</span>
                                @endif --}}
                            </li>
                            @if (session('coupon_info'))
                                <li>
                                    <span>After Discount</span>
                                    @if(session('coupon_info')->discount_type == 'flat')
                                        <span>৳{{ round($subtotal - session('coupon_info')->coupon_discount_amount) }}</span>
                                        @php
                                            session(['after_discount' => round($subtotal - session('coupon_info')->coupon_discount_amount)])
                                        @endphp
                                    @else
                                        <span>৳{{ round($subtotal - ((session('coupon_info')->coupon_discount_amount * $subtotal) / 100)) }}</span>
                                        @php
                                            session(['after_discount' => round($subtotal - ((session('coupon_info')->coupon_discount_amount * $subtotal) / 100))])
                                        @endphp
                                    @endif
                                </li>
                            @endif
                            <li>
                                <span>Delivery Charge</span>
                                <span>{{session('shipping_charge')}}</span>
                            </li>
                            <li>
                                <span>Order Total</span>
                                <span class="total_price">
                                    @if (session('after_discount'))
                                        {{ session('after_discount') + session('shipping_charge')}}
                                        @php
                                            session(['order_total' => session('after_discount') + session('shipping_charge')])
                                        @endphp
                                    @else
                                        {{ $subtotal + session('shipping_charge') }}
                                        @php
                                            session(['order_total' => $subtotal + session('shipping_charge')])
                                        @endphp
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- sessions
1. coupon_info
2. after_discount
3. shipping_charge
4. order_total
5. subtotal  --}}
