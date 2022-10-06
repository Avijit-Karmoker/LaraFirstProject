@extends('layouts.dashboardmaster');

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.create') }}">Add Inventory</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Inventory - ({{ $product->product_name }})</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.add.inventory.post', $product->id) }}" method="POST">
                        @csrf
                        <div class="basic-form">
                            <div class="mb-3">
                                <label for="" class="form-label">Choose Size</label>
                                <select name="size_id" class="selectpicker w-100">
                                    <option value="">-Select One Size-</option>
                                    @foreach ($sizes as $size)
                                        <option class="" value="{{ $size->id }}">{{$size->size}} {{ $size->measure }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Choose Colour</label>
                                <select name="color_id" class="selectpicker w-100">
                                    <option value="">-Select One Colour-</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{Str::title($color->color_name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="text" class="form-control" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Colour Extra Charge</label>
                                <input type="text" class="form-control" name="color_extra_charge">
                                <small class="form-text text-muted">*Write the extra charge if you want to add with colour variation</small>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-info">Add Inventory</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Inventory - ({{ $product->product_name }})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-info align-middle">
                            <thead class="table-light">
                                <caption></caption>
                                <tr>
                                    <th>Sizes</th>
                                    <th>Colours</th>
                                    <th>Colour variation charge</th>
                                    <th>Quantity</th>
                                    <th>Resale Value</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @php
                                    $total_resale_value = 0;
                                @endphp
                                @foreach ($inventories as $inventory)
                                    <tr class="table-primary">
                                        <td>{{ App\Models\Size::find($inventory->size_id)->size }} {{ App\Models\Size::find($inventory->size_id)->measure }}</td>
                                        <td>{{ Str::title(App\Models\Color::find($inventory->color_id)->color_name) }} ({{ App\Models\Color::find($inventory->color_id)->color_code }})</td>
                                        <td>৳{{ $inventory->color_extra_charge }}</td>
                                        <td>{{ $inventory->quantity }}</td>
                                        <td>৳{{ $inventory->quantity * $product->purchase_price }}</td>
                                        @php
                                            $total_resale_value += ($inventory->quantity * $product->purchase_price);
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th>৳{{ $total_resale_value }}</th>
                                </tr>
                            </tfoot>
                        </table>
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
