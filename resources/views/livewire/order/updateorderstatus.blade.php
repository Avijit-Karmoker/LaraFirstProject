<div>
    <table class="table table-bordered" id="category-table" style="border-top: none; border-bottom: none;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Order Total</th>
                <th>Order Activity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>#{{ Str::title($invoice->id) }}</td>
                    <td>{{ Str::title($invoice->customer_name) }}</td>
                    <td>{{ Str::title($invoice->payment_method) }}</td>
                    <td>{{ Str::title($invoice->payment_status) }}</td>
                    <td>{{ Str::title($invoice->order_status) }}</td>
                    <td>৳{{ Str::title($invoice->order_total) }}</td>
                    <td>{{ $invoice->created_at->diffForHumans() }}</td>
                    <td>
                        <form action="" wire:submit.prevent="abc({{ $invoice->id }})">
                            @csrf
                            <div class="d-flex">
                                <select class="form-control" wire:model="update_order_status">
                                    <option value="">-Change Order Status-</option>
                                    <option value="packaging">Packaging</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                                <button type="submit" class="btn-sm btn-success ml-2">Set</button>
                            </div>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="50">
                        Order Details
                        @foreach ($invoice->invoice_details as $single_product)
                            <h6>{{ $single_product->relationshipwithproduct->product_name }}</h6>
                        @endforeach
                        {{-- {{ App\Models\Invoice::where('invoice_id' $invoice->id) }} --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="50" class="text-center">
                        <strong class="text-danger">No data to show</strong>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
