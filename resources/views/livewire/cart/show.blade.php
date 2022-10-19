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
                        <form action="#">
                            <div class="coupon_form form_item mb-0">
                                <input type="text" name="coupon" placeholder="Coupon Code...">
                                <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                <div class="info_icon">
                                    <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col col-lg-6">
                        <ul class="btns_group ul_li_right">
                            {{-- <li><a class="btn border_black" href="#!">Update Cart</a></li> --}}
                            <li>
                                @if ($error)
                                    <button class="btn btn_dark" disabled>Prceed To Checkout</button>
                                @else
                                    <button class="btn btn_dark" href="">Prceed To Checkout</button>
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
                                <select class="form-select w-50">
                                    <option value="">Select Your Option</option>
                                    <option value="1">Inside City</option>
                                    <option value="2">Outside City</option>
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn_primary rounded-pill">Update Total</button>
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
                                <span>Delivery Charge</span>
                                <span>$5</span>
                            </li>
                            <li>
                                <span>Order Total</span>
                                <span class="total_price">$57.50</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
