@extends('layouts.master')
@section('content')

    <!-- ----------------------- forgot password start ----------------------- -->
    <section id="forgot_password">
        <div class="container">
            <div class="row">
                <div class="col-xxl-7 col-xl-8 col-lg-8 col-md-12 col-sm-12 d_center">
                    <div class="forgot_password_main">
                        <h1 class="heading_two text_center mb-1">DIU Parent Portal</h1>
                        <p class="paragraph text_center mb-4">Please enter your email address below and then press "Reset Password".</p>
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form_groups m_group mb-2">
                                <div class="input_group full_width">
                                    <label for="email" class="paragraph sign_input_text mb-1">Email Address</label>
                                    <input id="email" type="email" class="input_field mb-2 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form_groups m_group mb-1">
                                <div class="input_group">
                                    <input type="submit" value="Reset Password" class="btn btn regular_btn submit_btn">
                                </div>
                                <p><a href="{{route('login')}}" class="paragraph s_text">Back to Sign In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ----------------------- forgot password end ----------------------- -->



{{--    <div class="row justify-content-center">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="card mx-4">--}}
{{--            <div class="card-body p-4">--}}
{{--                <h1>{{ trans('panel.site_title') }}</h1>--}}

{{--                <p class="text-muted">{{ trans('global.reset_password') }}</p>--}}

{{--                @if(session('status'))--}}
{{--                    <div class="alert alert-success" role="alert">--}}
{{--                        {{ session('status') }}--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <form method="POST" action="{{ route('password.email') }}">--}}
{{--                    @csrf--}}

{{--                    <div class="form-group">--}}
{{--                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">--}}

{{--                        @if($errors->has('email'))--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                {{ $errors->first('email') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-12">--}}
{{--                            <button type="submit" class="btn btn-primary btn-flat btn-block">--}}
{{--                                {{ trans('global.send_password') }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
