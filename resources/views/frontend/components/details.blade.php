@extends('layouts.weblayout')
@section('content')

    <main class="pt-90">
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        @foreach ($ProductDetails->galleryImages as $ProductImg)
                                            <img loading="lazy" class="h-auto"
                                                src="{{ asset('/storage/img/') }}/{{ $ProductImg->path }}" width="674"
                                                height="674" alt="" />

                                            <a data-fancybox="gallery"
                                                href="{{ asset('/storage/img/') }}/{{ $ProductImg->path }}"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        @endforeach
                                    </div>
                                    @if ($ProductDetails->galleryImages->isNotEmpty())
                                        @foreach ($ProductDetails->galleryImages as $image)
                                            @if ($image->images)
                                                @php
                                                    $imagesArray = explode(',', $image->images);
                                                @endphp

                                                @foreach ($imagesArray as $imgPath)
                                                    <div class="swiper-slide product-single__image-item">
                                                        <img loading="lazy" class="h-auto"
                                                            src="{{ asset('/storage/img/') }}/{{ $imgPath }}"
                                                            width="674" height="674" alt="" />
                                                        <a data-fancybox="gallery"
                                                            href="{{ asset('/storage/img/') }}/{{ $imgPath }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="Zoom">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <use href="#icon_zoom" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @else
                                        <p>No gallery images available for this product.</p>
                                    @endif

                                </div>
                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($ProductDetails->galleryImages as $ThumbImg)
                                        <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                class="h-auto" src="{{ asset('/storage/img/') }}/{{ $ThumbImg->path }}"
                                                width="104" height="104" alt="" /></div>
                                    @endforeach

                                    @if ($ProductDetails->galleryImages->isNotEmpty())
                                        @foreach ($ProductDetails->galleryImages as $thumbGallery)
                                            @if ($thumbGallery->images)
                                                @php
                                                    $imagesArray = explode(',', $thumbGallery->images);
                                                @endphp

                                                @foreach ($imagesArray as $imgPath)
                                                    <div class="swiper-slide product-single__image-item"><img loading="lazy"
                                                            class="h-auto"
                                                            src="{{ asset('/storage/img/') }}/{{ $imgPath }}"
                                                            width="104" height="104" alt="" /></div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @else
                                        <p>No gallery images available for this product.</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="{{ route('home') }}"
                                class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="{{ route('index.shop') }}"
                                class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                        </div><!-- /.breadcrumb -->

                        <div
                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                            <a href="#" class="text-uppercase fw-medium"><svg width="10" height="10"
                                    viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_md" />
                                </svg><span class="menu-link menu-link_us-s">Prev</span></a>
                            <a href="#" class="text-uppercase fw-medium"><span
                                    class="menu-link menu-link_us-s">Next</span><svg width="10" height="10"
                                    viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_md" />
                                </svg></a>
                        </div><!-- /.shop-acs -->
                    </div>
                    <h1 class="product-single__name">{{ $ProductDetails->name }}</h1>
                    @php
                        $review = App\Models\Review::where('product_id', $ProductDetails->id)->get();
                        $totalReviews = $review->count();
                    @endphp
                    @if ($totalReviews > 0)
                        <div class="product-single__rating">
                            <div class="reviews-group d-flex">
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                            </div>
                            <span class="reviews-note text-lowercase text-secondary ms-1">{{ $totalReviews }}
                                reviews</span>
                        </div>
                    @else
                        <div class="product-single__rating">
                            <div class="reviews-group d-flex">
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_star" />
                                </svg>
                            </div>
                            <span class="reviews-note text-lowercase text-secondary ms-1">0 reviews</span>
                        </div>
                    @endif
                    <div class="product-single__price">
                        <span class="current-price">
                            @if ($ProductDetails->regular_price)
                                <s>
                                    <h6 class="text-muted">${{ $ProductDetails->regular_price }}</h6>
                                </s>
                                <h3>${{ $ProductDetails->sale_price }}</h3>
                            @else
                                ${{ $ProductDetails->sale_price }}
                            @endif
                        </span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $ProductDetails->short_description }}</p>
                    </div>
                    @if ($isAddedCart > 0)
                        <a href="{{ route('index.shop') }}" class="btn btn-warning mb-5">Add New Products</a>
                    @else
                        <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                            @csrf
                            <div class="product-single__addtocart">
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="1" min="1"
                                        class="qty-control__number text-center">
                                    <div class="qty-control__reduce">-</div>
                                    <div class="qty-control__increase">+</div>
                                    <input type="hidden" name="id" value="{{ $ProductDetails->id }}">
                                    <input type="hidden" name="name" value="{{ $ProductDetails->name }}">
                                    <input type="hidden" name="price"
                                        value="{{ $ProductDetails->sale_price ?: $ProductDetails->regular_price }}">
                                    <!-- These hidden fields will be updated dynamically -->
                                    <input type="hidden" name="color_id" id="colorIdInput" value="">
                                    <input type="hidden" name="size_id" id="sizeIdInput" value="">
                                </div>
                                <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Add
                                    to Cart</button>
                            </div>
                        </form>
                    @endif
                    <div class="product-single__addtolinks">
                        @if (Cart::instance('wishlist')->content()->where('id', $ProductDetails->id)->count() > 0)
                            <a href="{{ route('index.wishlist') }}"
                                class="menu-link menu-link_us-s add-to-wishlist filled-heart"><svg width="16"
                                    height="16" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_heart" />
                                </svg><span>Added to Wishlist</span></a>
                        @else
                            <a href="#" class="menu-link menu-link_us-s" id="wishlist-link">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_heart" />
                                </svg>
                                <span>Add to Wishlist</span>
                            </a>
                        @endif
                        <share-button class="share-button">
                            <button
                                class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_sharing" />
                                </svg>
                                <span>Share</span>
                            </button>
                            <div class="social-share-buttons">
                                <a href="{!! Share::page(url()->current(), 'Share on Facebook')->facebook()->getRawLinks() !!}" target="_blank" class="social-button facebook">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="https://www.instagram.com/?url={{ urlencode(url()->current()) }}"
                                    target="_blank" class="social-button instagram">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=Share on Twitter"
                                    class="social-button twitter" target="_blank">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a href="https://www.youtube.com/results?search_query={{ urlencode('Watch this: ' . url()->current()) }}"
                                    class="social-button youtube" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a href="{!! Share::page(url()->current(), 'Share on Pinterest')->pinterest()->getRawLinks()['url'] ?? '#' !!}" class="social-button pinterest" target="_blank">
                                    <i class="fa-brands fa-pinterest"></i>
                                </a>
                            </div>
                        </share-button>


                        <script src="js/details-disclosure.html" defer="defer"></script>
                        <script src="js/share.html" defer="defer"></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>SKU:</label>
                            <span>{{ $ProductDetails->SKU }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Categories:</label>
                            <span>{{ $ProductDetails->category->name }}</span>
                        </div>
                        @if ($isAddedCart > 0)
                            <!-- Show selected size and color as plain text -->
                            <div class="meta-item">
                                <label>Size:</label>
                                <span
                                    class="mt-2">{{ $selectedSize ? $ProductDetails->size->firstWhere('id', $selectedSize)->name : 'N/A' }}</span>
                            </div>
                            <div class="meta-item">
                                <label>Color:</label>
                                <span
                                    class="mt-2">{{ $selectedColor ? $ProductDetails->color->firstWhere('id', $selectedColor)->name : 'N/A' }}</span>
                            </div>
                        @else
                            <!-- Show dropdowns for size and color if the product is not in the cart -->
                            <div class="meta-item">
                                <label>Sizes:</label>
                                <span>
                                    <select id="sizeSelect" class="mt-2 border border-1" name="size_id">
                                        <option>Select</option>
                                        @foreach ($ProductDetails->size as $size)
                                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                            <div class="meta-item">
                                <label>Colors:</label>
                                <span>
                                    <select id="colorSelect" class="mt-2 border border-1" name="color_id">
                                        <option>Select</option>
                                        @foreach ($ProductDetails->color as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </div>
                        @endif
                        <div class="mt-3">
                            @include('alert.masseges')
                        </div>

                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Additional Information</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            ( {{ $totalReviews }} )</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">

                            <p class="content">{{ $ProductDetails->description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                        aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">

                            <div class="item">
                                <label class="h6">Brand</label>
                                <span>{{ $ProductDetails->brand->name }}</span>
                            </div>
                            <div class="item">
                                <label class="h6">Size</label>
                                <span>
                                    @foreach ($ProductDetails->size as $size)
                                        {{ $size->name . ', ' }}
                                    @endforeach
                                </span>
                            </div>
                            <div class="item">
                                <label class="h6">Color</label>
                                <span>
                                    @foreach ($ProductDetails->color as $color)
                                        {{ $color->name . ', ' }}
                                    @endforeach
                                </span>
                            </div>
                            <div class="item">
                                <label class="h6">Storage</label>
                                <span>{{ $ProductDetails->stock_status }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            @php
                                $reviews = App\Models\Review::where('product_id', $ProductDetails->id)
                                    ->where('status', 'approved')
                                    ->get();
                            @endphp
                            @foreach ($reviews as $review)
                                <div class="product-single__reviews-item">
                                    <div class="customer-avatar">
                                        <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($review->email))) }}?s=50&d=identicon"
                                            alt="Avatar" class="review-avatar" width="50" height="50">
                                    </div>
                                    <div class="customer-review">
                                        <div class="customer-name">
                                            <h6>{{ $review->name }}</h6>
                                        </div>
                                        <div class="reviews-group mb-1">{{ $review->created_at->format('M d, Y') }}</div>
                                        <div class="review-date d-flex">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="review-star" viewBox="0 0 9 9"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_star"
                                                        fill="{{ $i <= $review->rating ? '#FFD700' : '#ccc' }}" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="review-text">
                                            <p>{{ $review->review }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="product-single__review-form">
                            <form method="POST" action="{{ route('reviews.store') }}">
                                @csrf
                                <h5>Give “{{ $ProductDetails->name }}” a review</h5>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <div class="select-star-rating">
                                    <label>Your rating *</label>
                                    <span class="star-rating">
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                        <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                            viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                                        </svg>
                                    </span>
                                    <input type="hidden" name="rating" id="form-input-rating" value="1" />
                                </div>
                                <div class="mb-4">
                                    <textarea name="review" class="form-control form-control_gray" placeholder="Your Review" cols="30"
                                        rows="8" required></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label">Name *</label>
                                    <input type="hidden" name="product_id" value="{{ $ProductDetails->id }}">
                                    <input name="name" id="form-input-name"
                                        class="form-control form-control-md form-control_gray" required>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">Email address *</label>
                                    <input name="email" id="form-input-email"
                                        class="form-control form-control-md form-control_gray" required>
                                </div>
                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider"
                    data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>


                    <div class="swiper-wrapper">
                        @foreach ($relatedProducts as $product)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}">
                                        @if ($product->galleryImages->isNotEmpty())
                                            @php
                                                $firstImage = $product->galleryImages->first();
                                            @endphp

                                            <img loading="lazy" src="{{ asset('storage/img/' . $firstImage->path) }}"
                                                width="330" height="400" alt="{{ $product->name }}"
                                                class="pc__img">

                                            @if ($firstImage->images)
                                                @php
                                                    $imagesArray = explode(',', $firstImage->images);
                                                    $secondImagePath = $imagesArray[0] ?? null;
                                                @endphp

                                                @if ($secondImagePath)
                                                    <img loading="lazy"
                                                        src="{{ asset('storage/img/' . $secondImagePath) }}"
                                                        width="330" height="400" alt="{{ $product->name }}"
                                                        class="pc__img pc__img-second">
                                                @endif
                                            @endif
                                        @else
                                            <p>No gallery images available for this product.</p>
                                        @endif
                                    </a>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $product->category->name }}</p>
                                    <h6 class="pc__title">
                                        <a
                                            href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if ($product->regular_price)
                                                <s class="text-danger">${{ $product->regular_price }}</s>
                                                ${{ $product->sale_price }}
                                            @else
                                                ${{ $product->sale_price }}
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

                                    <button
                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                        title="Add To Wishlist">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- /.swiper-wrapper -->

                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>

    <form action="{{ route('wishlist.add') }}" method="post" id="wishlist-form">
        @csrf
        <input type="hidden" name="id" value="{{ $ProductDetails->id }}">
        <input type="hidden" name="name" value="{{ $ProductDetails->name }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="price"
            value="{{ $ProductDetails->sale_price == '' ? $ProductDetails->regular_price : $ProductDetails->sale_price }}">
    </form>
@endsection
