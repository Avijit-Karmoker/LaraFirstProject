<?php

use App\Models\Cart;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Review;
use App\Models\Size;
use Illuminate\Support\Str;

function cart_count() {
    return Cart::where('user_id', auth()->id())->count();
}

function cart_total($product_id, $quantity) {
    $product = Product::find($product_id);
    if($product->discounted_price){
        $price = $product->discounted_price;
    }
    else {
        $price = $product->regular_price;
    }
    return $price * $quantity;
}

function inventory_size($inventory) {
    return Size::find($inventory->size_id)->size;
}

function size_measure($inventory) {
    return Size::find($inventory->size_id)->measure;
}

function inventory_color($inventory) {
    return Str::title(Color::find($inventory->color_id)->color_name);
}

function color_code($inventory) {
    return Color::find($inventory->color_id)->color_code;
}

function get_inventory($product_id, $size_id, $color_id,) {
    return Inventory::where([
        'product_id' => $product_id,
        'size_id' => $size_id,
        'color_id' => $color_id,
    ])->first()->quantity;
}

function get_coupon_price($coupon){
    return Coupon::where([
        'coupon_name' => $coupon
    ])->first()->coupon_minimum_value;
}

function has_reviews($invoice_details_id){
    return Review::where('invoice_details_id', $invoice_details_id)->exists();
}

function average_fuction($product_id){
    if(Review::where('product_id', $product_id)->exists()){
        return Review::where('product_id', $product_id)->average('rating');
    }
    else{
        return 0;
    }
}
