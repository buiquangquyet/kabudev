{{-- @foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) --}}
@foreach (app('Kabu\Category\Repositories\CategoryRepository')->getCategoryLevel1() as $category)
@php
    $Products = app('Kabu\Product\Repositories\ProductFlatRepository')->getHomeProductByCategory($category->id);
@endphp
@if ($Products->count())
    <section class="featured-products">

        <div class="featured-heading">
            {{ $category->name }}<br/>

            <span class="featured-seperator" style="color: #d7dfe2;">_____</span>
        </div>

        <div class="featured-grid product-grid-4">

            @foreach ($Products as $productFlat)

                @if (core()->getConfigData('catalog.products.homepage.out_of_stock_items'))
                    @include ('shop::products.list.card', ['product' => $productFlat])
                @else
                    @if ($productFlat->isSaleable())
                        @include ('shop::products.list.card', ['product' => $productFlat])
                    @endif
                @endif

            @endforeach

        </div>
        <div class="text-center"><a href="{{ route('shop.productOrCategory.index', $category->slug) }}">Xem tất cả</a></div>
    </section>
@endif
@endforeach