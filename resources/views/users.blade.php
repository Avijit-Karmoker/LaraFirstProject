@extends('layouts.dashboardmaster')

@section('content')
<div class="page-titles mt-2 ml-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users') }}">Category</a></li>
    </ol>
</div>
<div class="mt-3" style="padding-left: 10px; padding-right: 10px;">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body" style="overflow-y: scroll; height: 750px;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Profile Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        @empty($user->profile_photo)
                                        <img src="{{ Avatar::create($user->name)->toBase64() }}"  class="w-100" />
                                        @else
                                        <img src="{{ asset('uploads/profile_photos') }}/{{ $user->profile_photo }}" alt="no photo found" class="w-100">
                                        @endempty
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->created_at->format('d-m-Y h:i:s A')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="height: 400px;">
            <div class="card">
                <div class="card-header">Users Add</div>
                @error('email_address')
                    <div class="alert text-white bg-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <div class="card-body">
                    <form action="{{ route('add_user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Admin Name</label>
                            <input type="text" class="form-control" name="name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin Email</label>
                            <input type="email" class="form-control" name="email_address" placeholder="">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Create New Admin</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
