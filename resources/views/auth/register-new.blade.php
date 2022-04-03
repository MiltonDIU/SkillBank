@extends('layouts.master')

@section('content')

    <!-- ----------------------- sign up start ----------------------- -->
    <section id="sign_up" class="mg_top">
        <div class="container">
            <div class="row column_change">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="sign_img">
                        <img src="{{url('assets/theme/images/sign-up.jpg')}}" alt="Sign up">
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                    <div class="sign_form">
                            <h1 class="heading_two mb-3">DIU Parent Portal</h1>

                            <div class="form_groups">
                                <div class="input_group full_width">
                                    <label for="firstName" class="paragraph sign_input_text mb-1">Name</label>
                                    <input id="name" type="text" class="input_field mb-2 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form_groups">
                                <div class="input_group full_width">
                                    <label for="email" class="paragraph sign_input_text mb-1">Email Address</label>

                                <input id="email" type="email" class="input_field mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>

                            <div class="form_groups">
                                <div class="input_group">
                                    <label for="password" class="paragraph sign_input_text mb-1">Password</label>
                                    <input id="password" type="password" class="input_field mb-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="input_group">
                                    <label for="confirmPassword" class="paragraph sign_input_text mb-1">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="input_field mb-3" name="password_confirmation" required autocomplete="new-password">

                                    </div>
                                </div>

                                <div class="form_groups">
                                    <div class="input_group">
                                        <input type="submit" value="Sign Up" class="btn btn regular_btn submit_btn mb-3">
                                    </div>
                                </div>

                                <p class="paragraph mb-2">Already have an account? <span><a href="{{route('login')}}" class="s_text">Sign in</a></span></p>
                            </div>
                        </form>

                        <div class="ahead_text">
                            <p class="paragraph text_bold a_text">You are one step ahead for:
                            </p>

                            <ul>
                                <li class="paragraph a_text">- Getting access to our campus updates and important news</li>
                                <li class="paragraph a_text">- Having insights into your student’s progress and financial records</li>
                                <li class="paragraph a_text">- Receiving our monthly e-newsletter</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ----------------------- sign up end ----------------------- -->




        {{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--    --}}
{{--    --}}

@endsection
