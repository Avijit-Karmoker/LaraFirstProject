@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Login/Register</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
<!-- register_section - start
================================================== -->
<section class="register_section section_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <ul class="nav register_tabnav ul_li_center" role="tablist">
                    <li role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Vendor Login</button>
                    </li>
                </ul>

                @if (session('account_created'))
                    <div class="text-center">
                        <span class="alert alert-success">{{ session('account_created') }}</span>
                    </div>
                @endif

                {{-- Sign in  --}}
                <div class="register_wrap tab-content" style="margin-top: 35px;">

                    {{-- registration --}}
                    <div class="tab-pane fade show active" id="signup_tab" role="tabpanel">
                        <form action="{{ route('vendor.login.post') }}" method="POST">
                            @csrf

                            <div class="form_item_wrap">
                                <h3 class="input_title">Email <span class="text-danger">*</span></h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-envelope"></i></label>
                                    <input id="email_input" type="email" name="email" value="futepar@mailinator.com">
                                    @error('email')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password <span class="text-danger">*</span></h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password" value="Pa$$w0rd!">
                                    @error('password')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form_item_wrap mt-3">
                                <button type="submit" class="btn btn_secondary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- register_section - end
================================================== -->
@endsection
