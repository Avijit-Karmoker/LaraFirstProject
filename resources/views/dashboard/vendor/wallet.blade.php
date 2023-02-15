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
                                    <th>Payment status</th>
                                    <th>Order Status</th>
                                    <th>Order Total</th>
                                    <th>Commission(10%)</th>
                                    <th>Net Total</th>
                                    <th>Order Activity</th>
                                    <th>Withdraw Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <form action="{{ route('vendor.wallet.withdraw') }}" method="POST">
                                @csrf
                                <tbody>
                                    @forelse ($invoices as $invoice)
                                        <tr>
                                            <td>#{{ $invoice->id }}</td>
                                            <td>{{ Str::title($invoice->customer_name) }}</td>
                                            <td>{{ Str::title($invoice->payment_status) }}</td>
                                            <td>{{ Str::title($invoice->order_status) }}</td>
                                            <td>৳{{ $invoice->order_total }}</td>
                                            <td>৳{{ floor(($invoice->order_total * 10)/100) }}</td>
                                            <td>৳{{ $invoice->order_total - floor(($invoice->order_total * 10)/100) }}</td>
                                            <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($invoice->withdraw_status)
                                                    <span class="badge bg-success" style="color: #fff">Withdraw done!</span>
                                                @else
                                                    <span class="badge bg-info" style="color: #fff">Not withdraw yet!</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" name="invoice[]" value="{{ $invoice->id }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="50" class="text-right">
                                                <button type="submit" class="btn btn-sm btn-info">Get Paid</button>
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
                            </form>
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
@endsection
