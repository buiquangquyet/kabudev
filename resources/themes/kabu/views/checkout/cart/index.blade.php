@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
    <section class="cart container">
        @if ($cart)
            <div class="title">
                {{ __('shop::app.checkout.cart.title') }}
            </div>


            <div class="row">
                <div class="col col-md-8 left-side">
                    <div class="cart-content">
                    <form action="{{ route('shop.checkout.cart.update') }}" method="POST" @submit.prevent="onSubmit">
                        @csrf
                        <div class="item">
                            <div class="row">
                                <div class="item-title col-md-5">
                                    Tên sản phẩm
                                </div>
                                <div class="price col-md-2">
                                    Đơn giá
                                </div>
                                <div class="misc col-md-2">
                                    Số lượng
                                </div>
                                <div class="misc col-md-2">
                                    Thành tiền
                                </div>
                                <div class="misc col-md-1">
                                    <img src="{{ bagisto_asset('images/cart_remove.png') }}" />
                                </div>
                            </div>
                        </div>
                        
                        @foreach ($cart->items as $key => $item)
                        @php
                            $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);

                            if (is_null ($item->product->url_key)) {
                                if (! is_null($item->product->parent)) {
                                    $url_key = $item->product->parent->url_key;
                                }
                            } else {
                                $url_key = $item->product->url_key;
                            }
                        @endphp
                        <div class="item">
                            <div class="row">
                                <div class="d-flex col-md-5">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('shop.productOrCategory.index', $url_key) }}"><img
                                                src="{{ $productBaseImage['small_image_url'] }}" alt="" /></a>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        {!! view_render_event('bagisto.shop.checkout.cart.item.name.before', ['item' => $item]) !!}
                                        <div class="item-title">
                                            <a href="{{ route('shop.productOrCategory.index', $url_key) }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </div>
                                        {!! view_render_event('bagisto.shop.checkout.cart.item.name.after', ['item' => $item]) !!}
                                        {!! view_render_event('bagisto.shop.checkout.cart.item.options.before', ['item' => $item]) !!}
                                        @if (isset($item->additional['attributes']))
                                        <div class="item-options col-md-3">
                                            @foreach ($item->additional['attributes'] as $attribute)
                                            <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                            @endforeach
                            
                                        </div>
                                        @endif
                                        {!! view_render_event('bagisto.shop.checkout.cart.item.options.after', ['item' => $item]) !!}
                                    </div>
                            
                                </div>
                            
                                {!! view_render_event('bagisto.shop.checkout.cart.item.price.before', ['item' => $item]) !!}
                                <div class="price col-md-2">
                                    {{ core()->currency($item->base_price) }}
                                </div>
                                {!! view_render_event('bagisto.shop.checkout.cart.item.price.after', ['item' => $item]) !!}
                            
                                {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.before', ['item' => $item]) !!}
                                <div class="misc col-md-2">
                                    @if ($item->product->getTypeInstance()->showQuantityBox() === true)
                                    <quantity-changer :control-name="'qty[{{$item->id}}]'" quantity="{{$item->quantity}}">
                                    </quantity-changer>
                                    @endif
                                            
                                    @auth('customer')
                                    @php
                                    $showWishlist = core()->getConfigData('general.content.shop.wishlist_option') == "1" ? true : false;
                                    @endphp
                            
                                    @if ($showWishlist)
                                    <span class="towishlist">
                                        @if ($item->parent_id != 'null' ||$item->parent_id != null)
                                        <a href="{{ route('shop.movetowishlist', $item->id) }}"
                                            onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">{{ __('shop::app.checkout.cart.move-to-wishlist') }}</a>
                                        @else
                                        <a href="{{ route('shop.movetowishlist', $item->child->id) }}"
                                            onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">{{ __('shop::app.checkout.cart.move-to-wishlist') }}</a>
                                        @endif
                                    </span>
                                    @endif
                                    @endauth
                            
                                    @if (! cart()->isItemHaveQuantity($item))
                                    <div class="error-message mt-15">
                                        * {{ __('shop::app.checkout.cart.quantity-error') }}
                                    </div>
                                    @endif
                                </div>
                                {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.after', ['item' => $item]) !!}
                                <div class="price col-md-2">
                                    {{ core()->currency($item->base_price) }}
                                </div>
                                <div class="price col-md-1">
                                    <a href="{{ route('shop.checkout.cart.remove', $item->id) }}"
                                        onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')"><img src="{{ bagisto_asset('images/cart_remove.png') }}" /></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}

                        <div class="misc-controls">
                            <a href="{{ route('shop.home.index') }}" class="link">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>

                            <div>
                                @if ($cart->hasProductsWithQuantityBox())
                                <button type="submit" class="btn btn-lg btn-primary" id="update_cart_button">
                                    {{ __('shop::app.checkout.cart.update-cart') }}
                                </button>
                                @endif
                            </div>
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}
                    </form>
                    @include ('shop::products.view.cross-sells')
                    </div>
                </div>
                <div class="col col-md-4 right-side">
                    <div class="rounded-3 border border-3 border-primary"> 
                        <div class=" p-3">
                            <coupon-component></coupon-component>
                        </div>
                        <div class="section-devider"></div>
                        <div class=" p-3">
                        {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}
                        @include('shop::checkout.total.summary', ['cart' => $cart])
                        {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}

                        @if (! cart()->hasError())
                            @php
                                $minimumOrderAmount = (float) core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;
                            @endphp

                            <proceed-to-checkout
                                href="{{ route('shop.checkout.onepage.index') }}"
                                add-class="btn btn-lg btn-primary"
                                text="{{ __('shop::app.checkout.cart.proceed-to-checkout') }}"
                                is-minimum-order-completed="{{ $cart->checkMinimumOrder() }}"
                                minimum-order-message="{{ __('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]) }}">
                            </proceed-to-checkout>
                        @endif
                        </div>
                    </div>
                </div>
            </div>



           

        @else

            <div class="title">
                {{ __('shop::app.checkout.cart.title') }}
            </div>

            <div class="cart-content">
                <p>
                    {{ __('shop::app.checkout.cart.empty') }}
                </p>

                <p style="display: inline-block;">
                    <a style="display: inline-block;" href="{{ route('shop.home.index') }}" class="btn btn-lg btn-primary">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>
                </p>
            </div>

        @endif
    </section>

@endsection

@push('scripts')
    @include('shop::checkout.cart.coupon')

    <script type="text/x-template" id="quantity-changer-template">
        <div class="quantity">
            <div class="input-group mb-3" :class="[errors.has(controlName) ? 'has-error' : '']">
                <button class="btn btn-outline-secondary decrease" type="button" id="button-addon1"
                    @click="decreaseQty()">-</button>
                <input :name="controlName" class="form-control" :value="qty" v-validate="'required|numeric|min_value:1'"
                    data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" readonly>
                <button class="btn btn-outline-secondary increase" type="button" id="button-addon2"
                    @click="increaseQty()">+</button>
            </div>
            <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
        
        </div>
    </script>

    <script>
        Vue.component('quantity-changer', {
            template: '#quantity-changer-template',

            inject: ['$validator'],

            props: {
                controlName: {
                    type: String,
                    default: 'quantity'
                },

                quantity: {
                    type: [Number, String],
                    default: 1
                }
            },

            data: function() {
                return {
                    qty: this.quantity
                }
            },

            watch: {
                quantity: function (val) {
                    this.qty = val;

                    this.$emit('onQtyUpdated', this.qty)
                }
            },

            methods: {
                decreaseQty: function() {
                    if (this.qty > 1)
                        this.qty = parseInt(this.qty) - 1;

                    this.$emit('onQtyUpdated', this.qty)
                },

                increaseQty: function() {
                    this.qty = parseInt(this.qty) + 1;

                    this.$emit('onQtyUpdated', this.qty)
                }
            }
        });

        function removeLink(message) {
            if (!confirm(message))
            event.preventDefault();
        }

        function updateCartQunatity(operation, index) {
            var quantity = document.getElementById('cart-quantity'+index).value;

            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('{{ __('shop::app.products.less-quantity') }}');
                }
            }
            document.getElementById('cart-quantity'+index).value = quantity;
            event.preventDefault();
        }
    </script>
@endpush