@extends('layouts.dashboardmaster')

@section('content')
<div class="row m-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th class="text-success">Category Name</th>
                            <td>{{ $category->category_name }}</td>
                        </tr>

                        <tr>
                            <th class="text-success">Category Slug/Link</th>
                            <td>{{ $category->category_slug }}</td>
                        </tr>

                        <tr>
                            <th class="text-success">Category Photo</th>
                            <td>
                                <img style="width: 110px; height: 140px;" src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt="not found">
                            </td>
                        </tr>

                        <tr>
                            <th class="text-success">Created At</th>
                            <td>{{ $category->created_at->format('d-m-Y h:i:s A') }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

