@extends('layouts.dashboardmaster');

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("home") }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">List Product</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product List</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
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
                                            @if ($invoice->order_status != 'delivered')
                                                <form action="{{ route('vendor.order.status.change', $invoice->id) }}" method="POST">
                                                    @csrf
                                                    <select class="form-select" onchange="this.form.submit()" name="order_status">
                                                        <option value="">-Change Order Status-</option>
                                                        <option {{ ($invoice->order_status == 'packaging') ? 'selected' : '' }} value="packaging">Packaging</option>
                                                        <option {{ ($invoice->order_status == 'shipped') ? 'selected' : '' }} value="shipped">Shipped</option>
                                                        <option {{ ($invoice->order_status == 'delivered') ? 'selected' : '' }} value="delivered">Delivered</option>
                                                    </select>
                                                </form>
                                            @endif
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
                        {{-- @livewire('order.updateorderstatus') --}}  {{-- update order status by liveware --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
    Content body end
***********************************-->
@section('footer-script')
    <script>
        $(document).ready(function () {
            $('#category-table').DataTable();
        });
    </script>
    <script>
        windows.addEventListener('update_order_status', function(){
            alert('hello');
        })
    </script>
@endsection
@endsection
