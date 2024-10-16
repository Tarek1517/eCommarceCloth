@extends('layouts.weblayout')
@section('content')
    <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow"
        data-settings='{
    "autoplay": {
      "delay": 5000
    },
    "slidesPerView": 1,
    "effect": "fade",
    "loop": true
  }'>
        <div class="swiper-wrapper">
            @foreach ($SlidesCon as $slide)
                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="{{ url('/storage/img/' . $slide->image) }}" width="542" height="733"
                                alt="Woman Fashion 1"
                                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                            <div class="character_markup type2">
                                <p
                                    class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                                    {{ $slide->tagline }}</p>
                            </div>
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6
                                class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                New Arrivals</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">
                                {{ $slide->title }}</h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">{{ $slide->subtitle }}
                            </h2>
                            <a href="{{ $slide->link }}"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="container">
            <div
                class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
            </div>
        </div>
    </section>
    <div class="container mw-1620 bg-white border-radius-10">
        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
        <section class="category-carousel container">
            <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4">You Might Like</h2>

            <div class="position-relative">
                <div class="swiper-container js-swiper-slider"
                    data-settings='{
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": 8,
          "slidesPerGroup": 1,
          "effect": "none",
          "loop": true,
          "navigation": {
            "nextEl": ".products-carousel__next-1",
            "prevEl": ".products-carousel__prev-1"
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 2,
              "slidesPerGroup": 2,
              "spaceBetween": 15
            },
            "768": {
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "spaceBetween": 30
            },
            "992": {
              "slidesPerView": 6,
              "slidesPerGroup": 1,
              "spaceBetween": 45,
              "pagination": false
            },
            "1200": {
              "slidesPerView": 8,
              "slidesPerGroup": 1,
              "spaceBetween": 60,
              "pagination": false
            }
          }
        }'>
                    <div class="swiper-wrapper">
                        @foreach ($categories as $category)
                            <div class="swiper-slide">
                                <img loading="lazy" class="w-100 h-auto mb-3"
                                    src="{{ url('/storage/img/' . $category->image) }}" width="124" height="124"
                                    alt="" />
                                <div class="text-center">
                                    <a href="{{ route('index.shop', ['categories' => $category->id]) }}"
                                        class="menu-link fw-medium">{{ $category->name }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->
            </div><!-- /.position-relative -->
        </section>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

        <section class="hot-deals container">
            @foreach ($dealsCon as $deals)
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">{{ $deals->mtitle }}</h2>
                <div class="row">
                    <div
                        class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
                        <h2>{{ $deals->title1 }}</h2>
                        <h2 class="fw-bold">{{ $deals->title2 }}</h2>

                        @foreach ($coupons as $coupon)
                            <div class="coupon-container">
                                @if ($coupon->status === 'active' && \Carbon\Carbon::now()->isBefore(\Carbon\Carbon::parse($coupon->expiry_date)))
                                    <h5><span class="text-muted">COUPON : </span><b>{{ $coupon->code }}</b></h5>
                                @endif
                                <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
                                    data-date="{{ \Carbon\Carbon::parse($coupon->expiry_date)->format('d-m-Y') }}"
                                    data-time="00:00">
                                    <div class="day countdown-unit">
                                        <span class="countdown-num d-block"></span>
                                        <span class="countdown-word text-uppercase text-secondary">Days</span>
                                    </div>

                                    <div class="hour countdown-unit">
                                        <span class="countdown-num d-block"></span>
                                        <span class="countdown-word text-uppercase text-secondary">Hours</span>
                                    </div>

                                    <div class="min countdown-unit">
                                        <span class="countdown-num d-block"></span>
                                        <span class="countdown-word text-uppercase text-secondary">Mins</span>
                                    </div>

                                    <div class="sec countdown-unit">
                                        <span class="countdown-num d-block"></span>
                                        <span class="countdown-word text-uppercase text-secondary">Sec</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                        <a href="{{ $deals->link }}" class="btn-link default-underline text-uppercase fw-medium mt-3">View
                            All</a>
                    </div>
                    <div class="col-md-6 col-lg-8 col-xl-80per">
                        <div class="position-relative">
                            <div class="swiper-container js-swiper-slider"
                                data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 4,
              "slidesPerGroup": 4,
              "effect": "none",
              "loop": false,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 14
                },
                "768": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 3,
                  "spaceBetween": 24
                },
                "992": {
                  "slidesPerView": 3,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                },
                "1200": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
            @endforeach
            <div class="swiper-wrapper">

                @foreach ($dealsProduct as $sProduct)
                    <div class="swiper-slide product-card product-card_style3">
                        <div class="pc__img-wrapper">
                            <a href="details.html">
                                @if ($sProduct->galleryImages->isNotEmpty())
                                    @php
                                        $firstImage = $sProduct->galleryImages->first();
                                    @endphp

                                    <img loading="lazy" src="{{ asset('/storage/img/') }}/{{ $firstImage->path }}"
                                        width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">


                                    @if ($firstImage->images)
                                        @php
                                            $imagesArray = explode(',', $firstImage->images);

                                            $secondImagePath = $imagesArray[0] ?? null;
                                        @endphp

                                        @if ($secondImagePath)
                                            <img loading="lazy" src="{{ asset('/storage/img/') }}/{{ $secondImagePath }}"
                                                width="330" height="400" alt="Cropped Faux leather Jacket"
                                                class="pc__img pc__img-second">
                                        @endif
                                    @endif
                                @else
                                    <p>No gallery images available for this product.</p>
                                @endif
                            </a>
                        </div>

                        <div class="pc__info position-relative">
                            <h6 class="pc__title"><a href="details.html">{{ $sProduct->name }}</a></h6>
                            <div class="product-card__price d-flex">
                                <span class="money price text-secondary">
                                    @if ($sProduct->regular_price)
                                        <s
                                            class="text-danger">${{ $sProduct->regular_price }}</s>${{ $sProduct->sale_price }}
                                    @else
                                        ${{ $sProduct->sale_price }}
                                    @endif
                                </span>
                            </div>

                            <div
                                class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">

                                <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                                    data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                                    <a href="{{ route('shop.product.details', ['product_slug' => $sProduct->slug]) }}"
                                        class="d-none d-xxl-block">Quick View</a>
                                    <span class="d-block d-xxl-none"><svg width="18" height="18"
                                            viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <use href="" />
                                        </svg></span>
                                </button>

                                @if (Cart::instance('wishlist')->content()->where('id', $sProduct->id)->count() > 0)
                                    <!-- Form to remove from wishlist -->
                                    <form action="{{ route('wishlist.remove') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $sProduct->id }}">
                                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist filled-heart"
                                            title="Add To Wishlist">
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
                                        <input type="hidden" name="id" value="{{ $sProduct->id }}">
                                        <input type="hidden" name="name" value="{{ $sProduct->name }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="price"
                                            value="{{ $sProduct->sale_price == '' ? $sProduct->regular_price : $sProduct->sale_price }}">
                                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
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

            </div><!-- /.swiper-wrapper -->
    </div><!-- /.swiper-container js-swiper-slider -->
    </div><!-- /.position-relative -->
    </div>
    </div>
    </section>

    <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

    <section class="category-banner container">
        <div class="row">
            @foreach ($TypeCon as $type)
                <div class="col-md-6">
                    <div class="category-banner__item border-radius-10 mb-5">
                        <img loading="lazy" class="h-auto" src="{{ asset('/storage/img/') }}/{{ $type->image }}"
                            width="690" height="665" alt="" />
                        <div class="category-banner__item-mark">
                            {{ $type->tagline }}
                        </div>
                        <div class="category-banner__item-content">
                            <h3 class="mb-0">{{ $type->title }}</h3>
                            <a href="{{ $type->link }}"
                                class="btn-link default-underline text-uppercase fw-medium">Shop Now</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

    <section class="products-grid container">
        <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Featured Products</h2>

        <div class="row">
            @foreach ($fproduct as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                        <div class="pc__img-wrapper">
                            <a href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}">
                                @foreach ($product->galleryImages as $image)
                                    <img loading="lazy" src="{{ asset('/storage/img/') }}/{{ $image->path }}"
                                        class="pc__img" alt="Cropped Faux leather Jacket" width="330" height="400">
                                @endforeach
                            </a>
                        </div>

                        <div class="pc__info position-relative">
                            <h6 class="pc__title"><a
                                    href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}">{{ $product->name }}</a>
                            </h6>
                            <div class="product-card__price d-flex align-items-center">
                                <span class="money price text-secondary">
                                    @if ($product->regular_price)
                                        <s
                                            class="text-danger">${{ $product->regular_price }}</s>${{ $product->sale_price }}
                                    @else
                                        ${{ $product->sale_price }}
                                    @endif
                                </span>
                            </div>

                            <div
                                class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                                <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view"
                                    data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                                    <a href="{{ route('shop.product.details', ['product_slug' => $product->slug]) }}"
                                        class="d-none d-xxl-block">Quick View</a>
                                    <span class="d-block d-xxl-none"><svg width="18" height="18"
                                            viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <use href="" />
                                        </svg></span>
                                </button>
                                @if (Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                    <!-- Form to remove from wishlist -->
                                    <form action="{{ route('wishlist.remove') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist filled-heart"
                                            title="Add To Wishlist">
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
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="price"
                                            value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                        <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist"
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
                </div>
            @endforeach
        </div><!-- /.row -->

        <div class="text-center mt-2">
            <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium"
                href="{{ route('index.shop') }}">Shop Now</a>
        </div>
    </section>
    </div>

    <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
@endsection
