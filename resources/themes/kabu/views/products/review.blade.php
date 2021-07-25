@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')

{!! view_render_event('bagisto.shop.products.review.before', ['product' => $product]) !!}

@if ($total = $reviewHelper->getTotalReviews($product))
    <div class="product-ratings mb-10">
        <span class="stars">
            @for ($i = 1; $i <= 5; $i++)
              @if($i <= round($reviewHelper->getAverageRating($product)))
              <span class="fa fa-star"></span>
              @else
              <span class="fa fa-star-o"></span>
              @endif
            @endfor
        </span>
        ({{ $total }} đánh giá) | xxx đã bán

        <div class="total-reviews">
            {{
                __('shop::app.products.total-rating', [
                        'total_rating' => $reviewHelper->getAverageRating($product),
                        'total_reviews' => $total,
                    ])
            }}
        </div>
    </div>
@endif

{!! view_render_event('bagisto.shop.products.review.after', ['product' => $product]) !!}
