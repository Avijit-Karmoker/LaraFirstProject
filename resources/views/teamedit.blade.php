<!doctype html>
<html lang="en">

<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Team</title>
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
								integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
	<div class="container">
		<div class="row mt-5">
			<div class="col-8 m-auto">
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
							<input type="password" class="form-control" name="password" id="myInput" placeholder="">
						</div>
                        <div class="form-check mb-4">
                            <input class="form-check-input"  onclick="myFunction()" type="checkbox" value="" id="flexCheckDefault">
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
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
	</script>
</body>

</html>
