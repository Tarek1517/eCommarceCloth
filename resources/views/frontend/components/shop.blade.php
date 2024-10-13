@extends('layouts.weblayout')
@section('content')
    <main class="pt-90">
        <section class="shop-main container d-flex pt-4 pt-xl-5">
            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <div class="aside-header d-flex d-lg-none align-items-center">
                    <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
                </div>

                <div class="pt-4 pt-lg-0"></div>

                <div class="accordion" id="categories-list">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                                aria-controls="accordion-filter-1">
                                Categories
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
                            <div class="accordion-body px-0 pb-0 pt-3">
                                <ul class="list list-inline mb-0">
                                    @foreach ($categories as $category)
                                        <li class="list-item">
                                            <span class="menu-link py-1"> <input type="checkbox" name="categories"
                                                    value="{{ $category->id }}" class="chk-brand"
                                                    @if (in_array($category->id, explode(',', $filter_categories))) checked="checked" @endif />
                                                {{ $category->name }}</span>
                                            <span class="text-right float-end">{{ $category->product()->count() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="brand-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-brand">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                                aria-controls="accordion-filter-brand">
                                Brands
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                            <div class="search-field multi-select accordion-body px-0 pb-0">
                                <ul class="list list-inline mb-0 brand-list">
                                    @foreach ($brands as $brand)
                                        <li class="list-item">
                                            <span class="menu-link py-1"> <input type="checkbox" name="brands"
                                                    value="{{ $brand->id }}" class="chk-brand"
                                                    @if (in_array($brand->id, explode(',', $filter_brands))) checked="checked" @endif />
                                                {{ $brand->name }}</span>
                                            <span class="text-right float-end">{{ $brand->product()->count() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="size-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-size">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-size" aria-expanded="true"
                                aria-controls="accordion-filter-size">
                                Sizes
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-size" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-wrap">
                                    @foreach ($sizes as $size)
                                        <a href="#" data-size-id="{{ $size->id }}"
                                            class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 {{ $filter_sizes == $size->id ? 'active' : '' }}
                                       ">{{ $size->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="color-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-2" aria-expanded="true"
                                aria-controls="accordion-filter-2">
                                Color
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-2" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-wrap">
                                    @foreach ($colors as $color)
                                        <a href="#" data-color-id="{{ $color->id }}"
                                            class="swatch-color js-filter {{ $filter_colors == $color->id ? 'active' : '' }}"
                                            style="color: {{ $color->Code }};"></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="price-filters">
                    <div class="accordion-item mb-4">
                        <h5 class="accordion-header mb-2" id="accordion-heading-price">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true"
                                aria-controls="accordion-filter-price">
                                Price
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                            <input class="price-range-slider" type="text" name="price_range" value=""
                                data-slider-min="1" data-slider-max="500" data-slider-step="5"
                                data-slider-value="[{{ $min_price }},{{ $max_price }}]" data-currency="$" />
                            <div class="price-range__info d-flex align-items-center mt-2">
                                <div class="me-auto">
                                    <span class="text-secondary">Min Price: </span>
                                    <span class="price-range__min">$1</span>
                                </div>
                                <div>
                                    <span class="text-secondary">Max Price: </span>
                                    <span class="price-range__max">$1000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-list flex-grow-1">
                <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split"
                    data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true,
            "pagination": {
              "el": ".slideshow-pagination",
              "type": "bullets",
              "clickable": true
            }
          }'>
                    <div class="swiper-wrapper">

                        @php
                            $colors = ['#f5e6e0', '#e0f7fa', '#ffecb3', '#d1c4e9', '#ffe0b2'];
                        @endphp

                        @foreach ($shopSlidesCon as $index => $shopSlides)
                            <div class="swiper-slide">
                                <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                    <div class="slide-split_text position-relative d-flex align-items-center"
                                        style="background-color: {{ $colors[$index % count($colors)] }};">
                                        <div class="slideshow-text container p-3 p-xl-5">
                                            <h2
                                                class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                                {{ $shopSlides->title }} <br /><strong>{{ $shopSlides->btitle }}</strong>
                                            </h2>
                                            <p class="mb-0 animate animate_fade animate_btt animate_delay-5">
                                                {{ $shopSlides->description }}</p>
                                        </div>
                                    </div>
                                    <div class="slide-split_media position-relative">
                                        <div class="slideshow-bg"
                                            style="background-color: {{ $colors[$index % count($colors)] }};">
                                            <img loading="lazy"
                                                src="{{ asset('/storage/img/') }}/{{ $shopSlides->image }}"
                                                width="630" height="450" alt="Women's accessories"
                                                class="slideshow-bg__img object-fit-cover" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>

                    <div class="container p-3 p-xl-5">
                        <div
                            class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-4 pb-xl-2">
                        </div>

                    </div>
                </div>

                <div class="mb-3 pb-2 pb-xl-3"></div>

                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                    </div>

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        <select class="shop-acs__select form-select w-auto border-0 py-1 px-2 order-1 order-md-0"
                            aria-label="Sort Items" name="orderby" id="orderby">
                            <option value="-1" {{ $order == -1 ? 'selected' : '' }}>Default</option>
                            <option value="1" {{ $order == 1 ? 'selected' : '' }}>Date, New to old</option>
                            <option value="2" {{ $order == 2 ? 'selected' : '' }}>Date, Old to new</option>
                            <option value="3" {{ $order == 3 ? 'selected' : '' }}>Price, High to low</option>
                            <option value="4" {{ $order == 4 ? 'selected' : '' }}>Price, Low to high</option>
                        </select>

                        <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div>

                        <div class="col-size align-items-center order-1 d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2">View</span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="3">3</button>
                            <button class="btn-link fw-medium js-cols-size" data-target="products-grid"
                                data-cols="4">4</button>
                        </div>

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                                data-aside="shopFilter">
                                <svg class="d-inline-block align-middle me-2" width="14" height="10"
                                    viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">

                    @foreach ($shopProducts as $Product)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a
                                                    href="{{ route('shop.product.details', ['product_slug' => $Product->slug]) }}">
                                                    @foreach ($Product->galleryImages as $image)
                                                        <img loading="lazy"
                                                            src="{{ asset('/storage/img/') }}/{{ $image->path }}"
                                                            class="pc__img" alt="Cropped Faux leather Jacket"
                                                            width="330" height="400">
                                                    @endforeach
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a
                                                    href="{{ route('shop.product.details', ['product_slug' => $Product->slug]) }}">

                                                    @if ($Product->galleryImages->isNotEmpty())
                                                        @foreach ($Product->galleryImages as $image)
                                                            @if ($image->images)
                                                                @php
                                                                    $imagesArray = explode(',', $image->images);
                                                                @endphp

                                                                @foreach ($imagesArray as $imgPath)
                                                                    <img src="{{ asset('/storage/img/') }}/{{ $imgPath }}"
                                                                        class="pc__img" alt="Cropped Faux leather Jacket"
                                                                        width="330" height="400">
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <p>No gallery images available for this product.</p>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_prev_sm" />
                                            </svg></span>
                                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_next_sm" />
                                            </svg></span>
                                    </div>
                                    <a href="#"
                                        class="btn pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"
                                        data-id="{{ $Product->id }}" data-name="{{ $Product->name }}"
                                        data-price="{{ $Product->sale_price ?: $Product->regular_price }}"
                                        data-sizes='@json($Product->size)'
                                        data-colors='@json($Product->color)' data-bs-toggle="modal"
                                        data-bs-target="#addToCartModal">
                                        Add to Cart
                                    </a>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $Product->category->name }}</p>
                                    <h6 class="pc__title"><a
                                            href="{{ route('shop.product.details', ['product_slug' => $Product->slug]) }}">{{ $Product->name }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if ($Product->regular_price)
                                                <s
                                                    class="text-danger">${{ $Product->regular_price }}</s>${{ $Product->sale_price }}
                                            @else
                                                ${{ $Product->sale_price }}
                                            @endif
                                        </span>
                                    </div>

                                    <div class="product-card__review d-flex align-items-center">
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                                    </div>
                                    @if (Cart::instance('wishlist')->content()->where('id', $Product->id)->count() > 0)
                                        <!-- Form to remove from wishlist -->
                                        <form action="{{ route('wishlist.remove') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $Product->id }}">
                                            <button
                                                class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-remove-wishlist filled-heart"
                                                title="Remove From Wishlist">
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_heart" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Form to add to wishlist -->
                                        <form action="{{ route('wishlist.add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $Product->id }}">
                                            <input type="hidden" name="name" value="{{ $Product->name }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="price"
                                                value="{{ $Product->sale_price == '' ? $Product->regular_price : $Product->sale_price }}">
                                            <button
                                                class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                                title="Add To Wishlist">
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_heart" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                <!-- Modal -->
                <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addToCartLabel">Select Color and Size</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form inside the modal -->
                                <form name="addtocart-form" id="addToCartForm" method="post"
                                    action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="name">
                                    <input type="hidden" name="price">

                                    <div class="meta-item">
                                        <label>Size:</label>
                                        <select id="sizeSelect" class="mt-2 border border-1 form-control" name="size_id">
                                            <option value="">Select Size</option>
                                        </select>
                                    </div>

                                    <div class="meta-item mt-3">
                                        <label>Color:</label>
                                        <select id="colorSelect" class="mt-2 border border-1 form-control"
                                            name="color_id">
                                            <option value="">Select Color</option>
                                        </select>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap-10 wg-pagination">
                    {{ $shopProducts->links('pagination::bootstrap-5') }}
                </div>

            </div>
            </div>
        </section>
    </main>
    <form action="{{ route('index.shop') }}" method="get" id="frmFilter">
        {{-- @csrf --}}
        <input type="hidden" name="page" value="{{ $shopProducts->currentPage() }}">
        <input type="hidden" name="order" id="order" value="{{ $order }}">
        <input type="hidden" name="brands" id="brands">
        <input type="hidden" name="categories" id="categories">
        <input type="hidden" name="sizes" id="sizes">
        <input type="hidden" id="colors" name="colors" value="{{ request('colors') }}">
        <input type="hidden" id="selectedColor" name="selectedColor" value="{{ request('selectedColor') }}">
        <input type="hidden" name="min" id="min" value="{{ $min_price }}">
        <input type="hidden" name="max" id="max" value="{{ $max_price }}">

    </form>
@endsection
