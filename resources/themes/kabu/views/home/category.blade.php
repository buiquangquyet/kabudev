<div class="container"><?php
$categories = app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
?>
  <div class="categories-title">Danh mục sản phẩm</div>
  <div class="card-group">
    @foreach ($categories as $category)
    <div class="col px-2">
      <div class="card">
        @if (!is_null($category->image))
        <a href="{{ route('shop.productOrCategory.index', $category->slug) }}"><img class="card-img"
            src="{{ $category->image_url }}" alt="" /></a>
        @endif

        <div class="card-body">
          <h5 class="card-title"><a
              href="{{ route('shop.productOrCategory.index', $category->slug) }}">{{ $category->name }}</a></h5>
        </div>
      </div>
    </div>
    @endforeach

  </div>
</div>