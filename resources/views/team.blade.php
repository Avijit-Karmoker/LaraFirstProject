<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-8 m-auto">
                <div class="card mb-5">
                    <div class="card-header">
                        Add Team Member
                    </div>
                    <div class="card-body">
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        <form action="{{ url('team/insert') }}" method="POST">
                            @csrf
                            {{-- name field  --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Team Member Name</label>
                                <input type="text" class="form-control @if(session('name_error')) is-invalid @endif" name="name" placeholder="">
                                {{-- name error message --}}
                                @if(session('name_error'))
                                    <small class="text-danger">{{session('name_error')}}</small>
                                @endif
                            </div>

                            {{-- email field  --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Team Member Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="" value="{{ old('email') }}">
                                {{-- email error message --}}
                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            {{-- phone number field --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Team Member Phone Number</label>
                                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="" value="{{ old('phone_number') }}">
                                {{-- phone number error message --}}
                                @error('phone_number')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            {{-- password field  --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Team Member Password</label>
                                <input type="password" class="form-control @if(session('password_error')) is-invalid @endif" name="password" placeholder="">
                                {{-- password error message --}}
                                @if(session('password_error'))
                                    <small class="text-danger">{{session('password_error')}}</small>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Add Team Member</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Team Members Lists
                        <span class="badge bg-success ms-2">{{$teams->count()}}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                {{-- class="@if ($loop->odd) bg-success @else bg-info @endif " --}}
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->email}}</td>
                                        <td>{{$team->phone_number}}</td>
                                        <td>{{$team->created_at->diffForHumans()}}</td>
                                        <td>{{$team->updated_at}}</td>
                                        <td><a href="{{ url('team/delete') }}/{{ $team->id }}" class="btn btn-danger btn-sm">Delete</a></td>
                                    </tr>
                                @endforeach
                                @if ($teams->count() == 0)
                                <tr class="text-center">
                                    <td colspan="50" class="text-danger fw-bold">No data found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ url('team/delete') }}/all" class="btn btn-warning">Delete All</a>
                        <div style="width: 170px;" class="m-auto mt-3">
                            {{ $teams->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
