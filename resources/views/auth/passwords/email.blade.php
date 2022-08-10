@extends('layouts.frontendmaster')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto my-5">
            <fieldset style="border: 1px solid #d4cac9;" class=" p-5">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="" style="margin: 50px 0;">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Your email">

                        <button type="submit" class="btn btn-secondary mt-3 btn-sm">Send Password Reset Link</button>
                    </form>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection
