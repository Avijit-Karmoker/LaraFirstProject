<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.product.index', [
            'products' => Product::where('vendor_id', auth()->id())->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.product.create', [
            'categories' => Category::get(['id', 'category_name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'image',
            'purchase_price' => 'integer',
            'regular_price' => 'integer',
        ]);

        // echo Product::insert($request->except('_token') + [
        //     'vendor_id' => auth()->id(),
        //     'thumbnail' => 'hudai',
        // ]);
        if($request->regular_price > $request->discounted_price){
            $product = Product::create($request->except('_token') + [
                'vendor_id' => auth()->id(),
            ]);

            if($request->hasfile('thumbnail')) {
                $extention = $request->file('thumbnail')->getClientOriginalExtension();
                $new_thumbnail = $product->id . "-" . Carbon::now()->format('Y_m_d') . "." . $extention;
                $img = Image::make($request->file('thumbnail'))->resize(800, 609);
                $img->save(base_path('public/uploads/product_thumbnail/' . $new_thumbnail), 80);

                Product::find($product->id)->update([
                    'thumbnail' => $new_thumbnail
                ]);
            }
            return back()->with('success', 'Product added successfully!');
        }
        else {
            return back()->withErrors('Discounted price is greater the regular price.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // return $request;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function addinventory(Product $product)
    {
        $sizes = Size::where('user_id', auth()->id())->latest()->get();
        $colors = Color::where('user_id', auth()->id())->latest()->get();
        $inventories = Inventory::where([
            'vendor_id' => auth()->id(),
            'product_id' => $product->id,
        ])->get();
        return view('dashboard.product.addinventory', compact('product', 'sizes', 'colors', 'inventories'));
    }

    public function addinventorypost(Product $product, Request $request)
    {
        $inventory = Inventory::where([
            'product_id' => $product->id,
            'vendor_id' => $product->vendor_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->first();

        if($inventory){
            $inventory->increment('quantity', $request->quantity);
            $inventory->save();
        }
        else{
            Inventory::insert([
                'product_id' => $product->id,
                'vendor_id' => $product->vendor_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'color_extra_charge' => $request->color_extra_charge,
                'created_at' => Carbon::now(),
            ]);
        }
        return back();
    }
}
