{{-- @foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category) --}}
@foreach (app('Kabu\Category\Repositories\CategoryRepository')->getCategoryLevel1() as $category)
@php
    $Products = app('Kabu\Product\Repositories\ProductFlatRepository')->getHomeProductByCategory($category->id);
@endphp
@if ($Products->count())
<div class="container">
    <section class="categories-products pt-4">
        <div class="card text-white">
            <img src="{{ $category->image_url }}" class="card-img" alt="{{ $category->name }}">
            <div class="card-img-overlay">
              <h5 class="card-title">{{ $category->name }}</h5>
            </div>
          </div>

          <div class="row row-cols-1 row-cols-md-4 g-4 pt-3">
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
        <div class="text-center pt-2"><a href="{{ route('shop.productOrCategory.index', $category->slug) }}">Xem tất cả</a></div>
    </section>
</div>
@endif
@endforeach