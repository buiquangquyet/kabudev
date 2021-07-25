<?php
    $term = request()->input('term');
    $image_search = request()->input('image-search');

    if (! is_null($term)) {
        $serachQuery = 'term='.request()->input('term');
    }
       $categories = [];

    foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category){
        if ($category->slug)
            array_push($categories, $category);
    }
?>
<header class="header p-3 mb-3">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand pe-5" href="{{ route('shop.home.index') }}">
                    @if ($logo = core()->getCurrentChannel()->logo_url)
                    <img class="logo" src="{{ $logo }}" alt="" />
                    @else
                    <img class="logo" src="{{ bagisto_asset('images/logo.svg') }}" alt="" />
                    @endif
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 main-navbar">
                        <li class="nav-item dropdown px-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sản phẩm
                            </a>
                            @if (count($categories))
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($categories as $key => $category)
                                <li>
                                    <a href="{{ route('shop.productOrCategory.index', $category->slug) }}"
                                        class="dropdown-item">{{ $category->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif

                        <li class="nav-item px-2">
                            <a class="nav-link" aria-current="page" href="#">Về chúng tôi</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Blog</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="{{ route('shop.search.index') }}">
                        <input class="form-control me-2" required name="term" type="search"
                            value="{{ ! $image_search ? $term : '' }}" id="search-bar"
                            placeholder="{{ __('shop::app.header.search-text') }}">
                    </form>
                    
                    {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}
                    <div class="px-3">@include('shop::checkout.cart.mini-cart')</div>
                    {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}
                    
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{bagisto_asset('images/profile.png') }}">
                        </a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            {!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}

                            <li>
                                <span class="dropdown-toggle">
                                    <i class="icon account-icon"></i>

                                    <span class="name">{{ __('shop::app.header.account') }}</span>

                                    <i class="icon arrow-down-icon"></i>
                                </span>

                                @guest('customer')
                                <ul class="dropdown-list account guest">
                                    <li>
                                        <div>
                                            <label
                                                style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">
                                                {{ __('shop::app.header.title') }}
                                            </label>
                                        </div>

                                        <div style="margin-top: 5px;">
                                            <span
                                                style="font-size: 12px;">{{ __('shop::app.header.dropdown-text') }}</span>
                                        </div>

                                        <div style="margin-top: 15px;">
                                            <a class="btn btn-primary btn-md"
                                                href="{{ route('customer.session.index') }}" style="color: #ffffff">
                                                {{ __('shop::app.header.sign-in') }}
                                            </a>

                                            <a class="btn btn-primary btn-md"
                                                href="{{ route('customer.register.index') }}"
                                                style="float: right; color: #ffffff">
                                                {{ __('shop::app.header.sign-up') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                @endguest

                                @auth('customer')
                                @php
                                $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ?
                                true :
                                false;
                                @endphp

                                <ul class="dropdown-list account customer">
                                    <li>
                                        <div>
                                            <label
                                                style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">
                                                {{ auth()->guard('customer')->user()->first_name }}
                                            </label>
                                        </div>

                                        <ul>
                                            <li>
                                                <a
                                                    href="{{ route('customer.profile.index') }}">{{ __('shop::app.header.profile') }}</a>
                                            </li>

                                            @if ($showWishlist)
                                            <li>
                                                <a
                                                    href="{{ route('customer.wishlist.index') }}">{{ __('shop::app.header.wishlist') }}</a>
                                            </li>
                                            @endif

                                            <li>
                                                <a
                                                    href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.header.cart') }}</a>
                                            </li>

                                            <li>
                                                <a
                                                    href="{{ route('customer.session.destroy') }}">{{ __('shop::app.header.logout') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                @endauth
                            </li>

                            {!! view_render_event('bagisto.shop.layout.header.account-item.after') !!}



                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>