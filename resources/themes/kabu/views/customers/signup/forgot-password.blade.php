@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.forgot-password.page_title') }}
@stop
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/themes/kabu/assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
@endsection

@push('css')
    <style>
        .button-group {
            margin-bottom: 25px;
        }

        .primary-back-icon {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content-wrapper')

    <div class="kabu container">
        <div class="auth-content">
            <div class="row">
                <div class="col-md-6">
                    <img class="image-login" src="/themes/kabu/assets/images/forgotpaswords.png" alt="">
                </div>
                <div class="col-md-6">
                    {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}
                    <h3 class="login-text">Lấy lại mật khẩu</h3>
                    <form method="post" action="{{ route('customer.forgot-password.store') }}" @submit.prevent="onSubmit">
                        {{ csrf_field() }}
                        <div class="login-form">
                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                            <div class="control-group input-login" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required"></label>
                                <input type="text" class="control" name="email" placeholder="Tên tài khoản" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>

                            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                            <div class="button-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block submit-btn">
                                    Tiếp Tục
                                </button>
                            </div>

                            <div class="control-group forgot-password-link float-right p-3" style="margin-bottom: 0px;">
                                <a href="{{ route('customer.session.index') }}">
                                    <i class="icon primary-back-icon"></i>
                                    Quay lại đăng nhập
                                </a>
                            </div>

                        </div>
                    </form>

                    {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}
                </div>
            </div>
        </div>


    </div>
@endsection