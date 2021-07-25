<?php
/** 
 * @var Webkul\Product\Models\Product $product 
 * */

    $relatedProducts = $product->related_products(4)->get();
?>

@if ($relatedProducts->count())
<div class="attached-products-wrapper">

    <div class="title">
        {{ __('shop::app.products.related-product-title') }}
        <span class="border-bottom"></span>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 pt-3">
        @foreach ($relatedProducts as $related_product)
        @include ('shop::products.list.card', ['product' => $related_product])
        @endforeach
    </div>
</div>
@endif