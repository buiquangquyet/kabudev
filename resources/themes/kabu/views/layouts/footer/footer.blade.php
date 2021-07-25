<footer>
    <div class="container">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Trang chủ</a></li>
            <li class="dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategoryFooter"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sản phẩm
                </a>
                <?php
                $categories = [];

                foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category){
                    if ($category->slug)
                        array_push($categories, $category);
                }
            ?>
                @if (count($categories))
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownCategoryFooter">
                    @foreach ($categories as $key => $category)
                    <li>
                        <a href="{{ route('shop.productOrCategory.index', $category->slug) }}"
                            class="dropdown-item">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            <li><a href="#" class="nav-link px-2 link-dark">Về chúng tôi</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Liên hệ</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Blog</a></li>
        </ul>
    </div>

    <div class="section-devider"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                {!! DbView::make(core()->getCurrentChannel())->field('footer_content')->render() !!}
            </div>
            <div class="col-md-5">
                @if(core()->getConfigData('customer.settings.newsletter.subscription'))
                <label class="list-heading"
                    for="subscribe-field">{{ __('shop::app.footer.subscribe-newsletter') }}</label>
                <div class="form-container">
                    <form action="{{ route('shop.subscribe') }}">
                        <div class="control-group" :class="[errors.has('subscriber_email') ? 'has-error' : '']">
                            <input type="email" id="subscribe-field" class="control subscribe-field"
                                name="subscriber_email" placeholder="Email Address" required><br />

                            <button class="btn btn-md btn-primary">{{ __('shop::app.subscription.subscribe') }}</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>


        </div>
    </div>
</footer>