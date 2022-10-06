<?php

namespace App\Http\Livewire\Productdetails;

use App\Models\Inventory;
use Livewire\Component;

class Addtocart extends Component
{
    public $product_id;
    public $available_colors;
    public $size_dropdown;

    public function updatedSizeDropdown($size_id){
        $this->available_colors = Inventory::where('product_id', $this->product_id)->where('size_id', $size_id)->get();
    }

    public function render()
    {
        $available_sizes = Inventory::select('size_id')->where('product_id', $this->product_id)->groupBy('size_id')->get();
        return view('livewire.productdetails.addtocart', compact('available_sizes'));
    }
}