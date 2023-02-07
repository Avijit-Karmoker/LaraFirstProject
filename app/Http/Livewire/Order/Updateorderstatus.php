<?php

namespace App\Http\Livewire\Order;

use App\Models\Invoice;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class Updateorderstatus extends Component
{
    public $update_order_status;
    public $invoice_id;
    public $all;

    public function abc($id){
        $this->all = Invoice::find($id)->update([
            'order_status' => $this->update_order_status
        ]);
    }

    public function render()
    {
        $invoices = Invoice::with(['invoice_details' => function($q){
            $q->with('relationshipwithproduct');
        }])->where('vendor_id', auth()->id())->get();

        return view('livewire.order.updateorderstatus', compact('invoices'));
    }
}
