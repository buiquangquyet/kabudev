@if (core()->getConfigData('customer.settings.social_login.enable_facebook')
    || core()->getConfigData('customer.settings.social_login.enable_twitter')
    || core()->getConfigData('customer.settings.social_login.enable_google')
    || core()->getConfigData('customer.settings.social_login.enable_linkedin')
    || core()->getConfigData('customer.settings.social_login.enable_github')
)
@push('css')
    <link rel="stylesheet" href="{{ bagisto_asset('css/social-login.css') }}">
@endpush

<div class="social-login-links">
    <div class="content-list-item">
        @if (core()->getConfigData('customer.settings.social_login.enable_facebook'))
            <div class="control-group">
                <a href="{{ route('customer.social-login.index', 'facebook') }}" class="link-social">
                    <span class="icon icon-facebook-login"></span>
                </a>
            </div>
        @endif
            @if (core()->getConfigData('customer.settings.social_login.enable_google'))
                <div class="control-group">
                    <a href="{{ route('customer.social-login.index', 'google') }}" class="link-social">
                        <span class="icon icon-google-login"></span>
                    </a>
                </div>
            @endif
        <div class="clear"></div>
    </div>
    <div class="clear"></div>


{{--    @if (core()->getConfigData('customer.settings.social_login.enable_twitter'))--}}
{{--        <div class="control-group">--}}
{{--            <a href="{{ route('customer.social-login.index', 'twitter') }}" class="link twitter-link">--}}
{{--                <span class="icon icon-twitter-login"></span>--}}
{{--                {{ __('sociallogin::app.shop.customer.login-form.continue-with-twitter') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    @endif--}}



{{--    @if (core()->getConfigData('customer.settings.social_login.enable_linkedin'))--}}
{{--        <div class="control-group">--}}
{{--            <a href="{{ route('customer.social-login.index', 'linkedin') }}" class="link linkedin-link">--}}
{{--                <span class="icon icon-linkedin-login"></span>--}}
{{--                {{ __('sociallogin::app.shop.customer.login-form.continue-with-linkedin') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if (core()->getConfigData('customer.settings.social_login.enable_github'))--}}
{{--        <div class="control-group">--}}
{{--            <a href="{{ route('customer.social-login.index', 'github') }}" class="link github-link">--}}
{{--                <span class="icon icon-github-login"></span>--}}
{{--                {{ __('sociallogin::app.shop.customer.login-form.continue-with-github') }}--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    @endif--}}
</div>

{{--<div class="social-link-seperator">--}}
{{--    <span>{{ __('sociallogin::app.shop.customer.login-form.or') }}</span>--}}
{{--</div>--}}
@endif