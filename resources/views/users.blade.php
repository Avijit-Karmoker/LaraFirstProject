@extends('layouts.dashboardmaster')

@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgb(173, 15, 15);
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #008000;
}

input:focus + .slider {
  box-shadow: 0 0 1px #008000;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="page-titles mt-2 ml-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users') }}">Category</a></li>
    </ol>
</div>
<div class="mt-3" style="padding-left: 10px; padding-right: 10px;">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-info" style="font-weight: 700; font-size: 20px;">{{ __('Admins') }}</div>

                        <div class="card-body" style="overflow-y: scroll; height: 400px;">
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
                                    @foreach ($users->where('role', 'admin') as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @empty($user->profile_photo)
                                                <img src="{{ Avatar::create(Str::title($user->name))->toBase64() }}"  class="w-100" />
                                                @else
                                                <img src="{{ asset('uploads/profile_photos') }}/{{ $user->profile_photo }}" alt="no photo found" class="w-100">
                                                @endempty
                                            </td>
                                            <td>{{ Str::title($user->name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>{{ Str::title($user->role) }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y h:i:s A')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="font-weight: 700; font-size: 20px; color: #4DD4AC">{{ __('Vendors') }}</div>
                        <div class="card-body" style="overflow-y: scroll; height: 400px;">
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
                                        <th>Details</th>
                                        <th>Action</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users->where('role', 'vendor') as $user)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @empty($user->profile_photo)
                                                    <img src="{{ Avatar::create(Str::title($user->name))->toBase64() }}"  class="w-100" />
                                                @else
                                                    <img src="{{ asset('uploads/profile_photos') }}/{{ $user->profile_photo }}" alt="no photo found" class="w-100">
                                                @endempty
                                            </td>
                                            <td>{{ Str::title($user->name) }}</td>
                                            <td>
                                                <p>{{ $user->email }}</p>
                                                <p>{{ $user->phone_number }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{-- @if ( $user->action == true) --}}
                                                    {{-- <span class="badge text-white bg-success">Active</span> --}}
                                                    <form action="{{ route('vendor.action.change', $user->id) }}" method="POST">
                                                        @csrf
                                                        <label class="switch">
                                                            <input onChange="this.form.submit()" type="checkbox" {{ ( $user->action == true) ? 'checked' : '' }}>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </form>
                                                {{-- @else --}}
                                                    {{-- <span class="badge text-white" style="background: red;">Deactive</span> --}}
                                                    {{-- <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="slider round"></span>
                                                    </label> --}}
                                                {{-- @endif --}}
                                            </td>
                                            <td>{{ Str::title($user->role) }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y h:i:s A')}}</td>
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
