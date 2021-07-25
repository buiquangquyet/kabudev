{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}
<div class="col">
    <div class="card h-100">
        <?php $productBaseImage = productimage()->getProductBaseImage($product); ?>

        @if ($product->new)
        <div class="sticker new">
            {{ __('shop::app.products.new') }}
        </div>
        @endif

        <div class="product-image">
            <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                <img 
                {{-- src="{{ $productBaseImage['medium_image_url'] }}" --}}
                src="{{ bagisto_asset('images/product.png') }}"
                class="card-img-top"
                onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"
                alt="" height="207" />
            </a>
        </div>

        <div class="card-body">

            <div class="card-title">
                <a href="{{ route('shop.productOrCategory.index', $product->url_key) }}" title="{{ $product->name }}">
                    <span>
                        {{ $product->id }}{{ $product->name }}search-to-delete
                    </span>
                </a>
            </div>

            @include ('shop::products.price', ['product' => $product])

            @include('shop::products.add-buttons', ['product' => $product])
        </div>
    </div>
</div>

{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}