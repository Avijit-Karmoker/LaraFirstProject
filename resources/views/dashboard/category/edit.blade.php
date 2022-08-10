@extends('layouts.dashboardmaster')

@section('content')
<!--**********************************
    Content body start
***********************************-->
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('category.edit', $category->id) }}">Category Edit</a></li>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category Edit</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="basic-form">
                            <div class="mb-3">
                                <label for="" class="form-label text-success" style="font-size: 20px; font-weight: bold;">Category Name</label>
                                <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                                @error('category_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label text-success" style="font-size: 20px; font-weight: bold;">Category Slug</label>
                                <input type="text" name="category_slug" class="form-control" value="{{ $category->category_slug }}">
                                <small class="text-info">Type here if you want to change the category link</small>
                                @error('category_slug')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-success" style="font-size: 20px; font-weight: bold;">Current Category Photo</label><br>
                                <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="No photo to show">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-success" style="font-size: 20px; font-weight: bold;">Update Category Photo</label>
                                <input type="file" name="category_photo" class="form-control" placeholder="add category photo">
                                @if (session('image_error'))
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ session('image_error') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-info">Update Category</button>
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

