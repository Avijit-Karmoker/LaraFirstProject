@extends('layouts.dashboardmaster');

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Image</th>
                                <th>Add Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brand_images as $brand_image)
                                <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/brand_images') }}/{{ $brand_image->brand_images }}" alt="no image to show">
                                        </td>
                                        <td>{{ $brand_image->created_at->format('d-m-Y h:i:s A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan='50' style="font-weight: bold;" class="text-danger text-center">
                                        No image to show
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
@endsection
