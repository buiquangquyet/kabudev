@if (count(app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts()))
<div class="container">
    <section class="featured-products">

        <div class="featured-heading">
            Bán chạy nhất
        </div>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach (app('Webkul\Product\Repositories\ProductRepository')->getFeaturedProducts() as $productFlat)

            @if (core()->getConfigData('catalog.products.homepage.out_of_stock_items'))
            @include ('shop::products.list.card', ['product' => $productFlat])
            @else
            @if ($productFlat->isSaleable())
            @include ('shop::products.list.card', ['product' => $productFlat])
            @endif
            @endif

            @endforeach

        </div>

    </section>
</div>
@endif