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
        <div class="row mt-5 mb-5">
            <div class="col-10 m-auto">
                <div class="card mb-5">
                    <div class="card-header">
                        Add Team Member
                    </div>
                    <div class="card-body m-5">
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
                                <input type="password" class="form-control @if(session('password_error')) is-invalid @endif" name="password" id="myInput">
                                {{-- password error message --}}
                                @if(session('password_error'))
                                    <small class="text-danger">{{session('password_error')}}</small>
                                @endif
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input"  onclick="myFunction()" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Show Password
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Team Member</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Team Members Lists
                        <span class="badge bg-success ms-2">Total: {{$teams_count}}</span>
                        <span class="badge bg-info ms-2">Total This Page: {{$teams->count()}}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
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
                                        <td>{{$teams->firstitem() + $loop->index}}</td>
                                        <td>{{$team->name}}</td>
                                        <td>{{$team->email}}</td>
                                        <td>{{$team->phone_number}}</td>
                                        <td>{{$team->created_at->diffForHumans()}}</td>
                                        <td>{{$team->updated_at}}</td>
                                        <td>
                                            <a href="{{ url('team/delete') }}/{{ $team->id }}" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="{{ url('team/edit') }}/{{ $team->id }}" class="btn btn-secondary btn-sm">Edit in new page</a>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#Modal{{ $team->id }}">Edit in modal</button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="Modal{{ $team->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row mt-5">
                                                        <div class="">
                                                            <div class="card mb-5">
                                                                <div class="card-header">
                                                                    Edit Team Member {{ $team->name }}
                                                                </div>
                                                                <div class="card-body">
                                                                    <form action="{{ url('team/edit/post') }}/{{ $team->id }}" method="POST">
                                                                        @csrf
                                                                    {{-- name field --}}
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Edit Team Member Name</label>
                                                                            <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                                                                        </div>
                                                                    {{-- phone number field --}}
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Edit Phone Number</label>
                                                                            <input type="tel" class="form-control" name="phone_number" value="{{ $team->phone_number }}">
                                                                        </div>
                                                                    {{-- password field --}}
                                                                    <div class="mb-2">
                                                                        <label for="" class="form-label">New Password</label>
                                                                        <input type="password" class="form-control" name="password" id="myInput2" placeholder="">
                                                                    </div>
                                                                    <div class="form-check mb-4">
                                                                        <input class="form-check-input"  onclick="myFunction2()" type="checkbox" value="" id="flexCheckDefault">
                                                                        <label class="form-check-label" for="flexCheckDefault">
                                                                            Show Password
                                                                        </label>
                                                                    </div>
                                                                        <button type="submit" class="btn btn-info">Edit Team Member</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    function myFunction2() {
                                                        var x = document.getElementById("myInput2");
                                                        if (x.type === "password") {
                                                            x.type = "text";
                                                        } else {
                                                            x.type = "password";
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($teams->count() == 0)
                                <tr class="text-center">
                                    <td colspan="50" class="text-danger fw-bold">No data found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ url('team/delete') }}/all" class="btn btn-warning">Delete All</a>
                        <div class="m-auto mt-3">
                            @if (count($teams))
                            {{-- {{ $teams->links('custom_pagination') }} --}}
                            {{ $teams->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
