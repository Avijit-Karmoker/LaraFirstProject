@extends('layouts.dashboardmaster');

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">App</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('coupon.index') }}">Coupon</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Coupon</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <div class="basic-form">
                                <div class="mb-4">
                                    <label class="form-label">Coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control borders" value="{{ Str::upper(Str::random(4)) }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Coupon Minimum Value</label>
                                    <input type="number" name="coupon_minimum_value" class="form-control borders">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Coupon Type</label>
                                    <select name="discount_type" class="form-control borders">
                                        <option value="percentage">Percentage (%)</option>
                                        <option value="flat">Flat Discount</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Coupon Discount Amount</label>
                                    <input type="number" name="coupon_discount_amount" class="form-control borders">
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-info btn-sm">Add Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
