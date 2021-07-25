{!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}
<?php
// $getProductPrices = $product->getTypeInstance()->getProductPrices();
?>
<div class="product-price">

        {{-- <span class="regular-price">{{$getProductPrices['final_price']['formated_price']}}</span>
        <span class="final-price">{{$getProductPrices['regular_price']['formated_price']}}</span> --}}

    
    {!! $product->getTypeInstance()->getPriceHtml() !!}

</div>

{!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}