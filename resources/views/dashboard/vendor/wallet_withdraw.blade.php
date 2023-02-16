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
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_withdraw = 0;
                                @endphp
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td>#{{ $invoice->id }}</td>
                                        <td>{{ Str::title($invoice->customer_name) }}</td>
                                        <td>{{ Str::title($invoice->payment_status) }}</td>
                                        <td>{{ Str::title($invoice->order_status) }}</td>
                                        <td>৳{{ $invoice->order_total }}</td>
                                        <td>৳{{ floor(($invoice->order_total * 10)/100) }}</td>
                                        <td>৳{{ $invoice->order_total - floor(($invoice->order_total * 10)/100) }}</td>
                                        @php
                                            $total_withdraw += $invoice->order_total - floor(($invoice->order_total * 10)/100)
                                        @endphp
                                        <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50" class="text-center">
                                            <strong class="text-danger">No data to show</strong>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="50" class="text-center">
                                        <h5>Total: ৳{{ $total_withdraw }}</h1>
                                        <form action="{{ route('vendor.wallet.withdraw.request') }}" method="POST">
                                            @csrf
                                            <input class="d-none" type="text" value="{{ $invoices->pluck('id') }}" name="withdraw_ids">
                                            <button type="submit" class="btn btn-sm btn-success text-light">Send Withdraw Request</button>
                                        </form>
                                    </td>
                                </tr>
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
@endsection
