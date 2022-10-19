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
                                    <th>Product Photo</th>
                                    <th>Product Name</th>
                                    <th>Product Regular Price</th>
                                    <th>Product Discounted Price</th>
                                    <th>Category Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>
                                            {{-- {{ $product->thumbnail }} --}}
                                            {{-- <img src="{{ Avatar::create($product->product_name)->setShape('square') }}" /> --}}
                                            @if ($product->thumbnail)
                                                <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product->thumbnail }}" alt="Photo not found" width="100">
                                            @else
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png" alt="Photo not found" width="100">
                                            @endif
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td><span style="font-weight: 700">৳</span>{{ $product->regular_price }}</td>
                                        <td><span style="font-weight: 700">৳</span>{{ $product->discounted_price }}</td>
                                        <td>
                                             <span class="badge" style="background: {{ $product->relationshipwithcategory->category_color }};
                                                @if($product->relationshipwithcategory->category_color == '#000000' ) color: #fff @endif">
                                                {{ $product->relationshipwithcategory->category_name }}
                                                {{-- {{ App\Models\Category::find($product->category_id)->category_name }} --}}
                                             </span>
                                        </td>

                                        {{-- <td>
                                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-secondary">Details</a>
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mt-2">Delete</button>
                                            </form>
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('product.add.inventory', $product->id) }}" class="btn btn-sm btn-info">
                                                Add inventory
                                            </a>
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
@endsection
@endsection
