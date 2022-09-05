@extends('layouts.dashboardmaster');

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.create') }}">Add Product</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Upload</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="basic-form">
                            <div class="mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="product_name" class="form-control" placeholder="product name">
                                @error('product_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Select Category</label>
                                <select name="category_id" class="form-control" id="category_dropdown">
                                    <option value="">-Select One-</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('categroy_photo')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Purchase Price</label>
                                <input type="number" name="purchase_price" class="form-control" placeholder="add category photo">
                                @error('purchase_price')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Regular Price</label>
                                <input type="number" name="regular_price" class="form-control" placeholder="Regular Price">
                                @error('regular_price')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Discounted Price</label>
                                <input type="number" name="discounted_price" class="form-control" placeholder="discounted price">
                                @error('discounted_price')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="a" class="form-control"  placeholder="Description"> </textarea>
                                @error('description')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea rows="4" name="short_description" class="form-control" placeholder="Short description"></textarea>
                                @error('short_description')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Additional Discription</label>
                                <textarea rows="4" name="additional_discription" class="form-control" placeholder="additional discription"></textarea>
                                @error('additional_discription')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control">
                                @error('thumbnail')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-info">Add Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
    Content body end
***********************************-->

@endsection

@section('footer-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#category_dropdown').select2();
        });
    </script>
@endsection
