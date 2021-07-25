@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')

{!! view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]) !!}

@if ($total = $reviewHelper->getTotalReviews($product))
<div class="rating-reviews">
    <div class="rating-header">
        {{ __('shop::app.products.reviews-title') }}
    </div>

    <div class="overall">
        <div class="review-info">
            <span class="number">
                {{ $reviewHelper->getAverageRating($product) }}
            </span>

            <span class="stars">
                @for ($i = 1; $i <= 5; $i++) @if($i <=round($reviewHelper->getAverageRating($product)))
                    <span class="fa fa-star"></span>
                    @else
                    <span class="fa fa-star-o"></span>
                    @endif

                    @endfor
            </span>

            <div class="total-reviews">
                {{ __('shop::app.products.total-reviews', ['total' => $total]) }}
            </div>

        </div>

        @if (core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check())
        <a href="{{ route('shop.reviews.create', $product->url_key) }}" class="btn btn-lg btn-outline-primary">
            {{ __('shop::app.products.write-review-btn') }}
        </a>
        @endif
        <hr class="my-4" />


    </div>

    <div class="reviews">

        @foreach ($reviewHelper->getReviews($product)->paginate(10) as $review)
        <div class="d-flex">
            <div class="flex-shrink-0">
                <img src="{{ bagisto_asset('images/Ellipse 9.png') }}" alt="...">
            </div>
            <div class="review flex-grow-1 ms-5">
                <div class="reviewer-details">
                    <span class="by">
                        {{ __('shop::app.products.by', ['name' => $review->name]) }},
                    </span>

                    <span class="when">
                        {{ core()->formatDate($review->created_at, 'F d, Y') }}
                    </span>
                </div>
                {{-- <div class="title">{{ $review->title }}</div> --}}

                <span class="stars">
                    @for ($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                        <span class="fa fa-star"></span>
                        @else
                        <span class="fa fa-star-o"></span>
                        @endif

                    @endfor
                </span>

                <div class="message">
                    {{ $review->comment }}
                </div>
            </div>
        </div>
        <hr class="my-5"/>
        @endforeach

        <a href="{{ route('shop.reviews.index', $product->url_key) }}" class="view-all">
            {{ __('shop::app.products.view-all') }}
        </a>

    </div>
</div>
@else
@if (core()->getConfigData('catalog.products.review.guest_review') || auth()->guard('customer')->check())
<div class="rating-reviews">
    <div class="rating-header">
        <a href="{{ route('shop.reviews.create', $product->url_key) }}" class="btn btn-lg btn-primary">
            {{ __('shop::app.products.write-review-btn') }}
        </a>
    </div>
</div>
@endif
@endif

{!! view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]) !!}