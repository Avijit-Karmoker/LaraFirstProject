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
                            <button data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">Customer Sign In</button>
                        </li>
                        <li role="presentation">
                            <button class="active" data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Customer Register</button>
                        </li>
                    </ul>

                    @if (session('account_created'))
                        <div class="text-center">
                            <span class="alert alert-success">{{ session('account_created') }}</span>
                        </div>
                    @endif

                    {{-- Sign in  --}}
                    <div class="register_wrap tab-content" style="margin-top: 35px;">
                        <div class="tab-pane fade" id="signin_tab" role="tabpanel">
                            <form action="{{ route('customer.login') }}" method='POST'>
                                @csrf
                                <div class="form_item_wrap">
                                    <h3 class="input_title">Email <span class="text-danger">*</span></h3>
                                    <div class="form_item">
                                        <label for="username_input">
                                            <i class="fas fa-user"></i>
                                        </label>
                                        <input id="username_input" type="email" name="email" value="ovijit@mailinator.com">
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Password <span class="text-danger">*</span></h3>
                                    <div class="form_item">
                                        <label for="password_input">
                                            <i class="fas fa-lock"></i>
                                        </label>
                                        <input id="password_input" type="password" name="password" value="Pa$$w0rd!">
                                    </div>
                                    <div class="checkbox_item">
                                        <input id="remember_checkbox" type="checkbox">
                                        <label for="remember_checkbox">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form_item_wrap mb-3">
                                    <a class="link-danger" href="{{ route('password.request') }}">Forgot your password?</a>
                                </div>

                                <div class="form_item_wrap">
                                    <button type="submit" class="btn btn_primary">Sign In</button>
                                </div>
                            </form>
                        </div>

                        {{-- registration --}}
                        <div class="tab-pane fade show active" id="signup_tab" role="tabpanel">
                            <form action="{{ route('customer.register') }}" method="POST">
                                @csrf
                                <div class="form_item_wrap">
                                    <h3 class="input_title">User Name <span class="text-danger">*</span></h3>
                                    <div class="form_item">
                                        <label for="username_input2">
                                            <i class="fas fa-user"></i>
                                        </label>
                                        <input id="username_input2" type="text" name="name" placeholder="Customer Name">
                                        @error('name')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Email <span class="text-danger">*</span></h3>
                                    <div class="form_item">
                                        <label for="email_input"><i class="fas fa-envelope"></i></label>
                                        <input id="email_input" type="email" name="email" placeholder="Customer Email">
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
                                        <input id="password_input2" type="password" name="password" placeholder="Customer Password">
                                        @error('password')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Confirm Password <span class="text-danger">*</span></h3>
                                    <div class="form_item">
                                        <label for="password_input2"><i class="fas fa-lock"></i></label>
                                        <input id="password_input2" type="password" name="password_confirmation" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    <h3 class="input_title">Phone number <span class="text-danger">*</span></h3>
                                    <div class="form_item">
                                        <label for="email_input"><i class="fas fa-phone"></i></label>
                                        <input id="email_input" type="tel" name="phone_number" placeholder="Customer Phone number">
                                        @error('phone_number')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form_item_wrap">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="form_item_wrap help-block">
                                        <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif

                                <div class="form_item_wrap mt-3">
                                    <button type="submit" class="btn btn_secondary">Register</button>
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
