@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/kabu/assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
@endsection
@section('content-wrapper')
    <div class="kabu container">
        <div class="auth-content">
            <div class="sign-up-text">

            </div>

            {!! view_render_event('bagisto.shop.customers.login.before') !!}



            {!! view_render_event('bagisto.shop.customers.login.after') !!}

            <div class="row">
                <div class="col-md-6">
                    <img class="image-login" src="/themes/kabu/assets/images/login.png" alt="">
                </div>
                <div class="col-md-6">
                    <h3 class="login-text">
                        Đăng nhập
                    </h3>
                    <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
                        {{ csrf_field() }}
                        <div class="login-form">


                            <div class="control-group input-login" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required"></label>
                                <input type="text" class="control" name="email" placeholder="Tên tài khoản" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>

                            <div class="control-group input-login" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password" class="required"></label>
                                <input type="password" v-validate="'required|min:6'" placeholder="Mật khẩu" class="control" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;" value=""/>
                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                            </div>

                            <div class="forgot-password-link">
                                <a class="forgot-link" href="{{ route('customer.forgot-password.create') }}">Quên mật khẩu</a>

                                <div class="mt-10">
                                    @if (Cookie::has('enable-resend'))
                                        @if (Cookie::get('enable-resend') == true)
                                            <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <input class="btn btn-primary btn-lg btn-block submit-btn" type="submit" value="Tiếp Tục">

{{--                            {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}--}}
{{--                            {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}--}}
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>






































@stop

