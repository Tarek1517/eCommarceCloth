@extends('layouts.cdashboard')
@section('CustomerDashboard')
    <div class="col-lg-12">
        <div class="wg-box  my-account__wishlist">
            <div class="products-grid row row-cols-2 row-cols-lg-3 mx-4" id="products-grid">
                @if ($customerWishlist->count() > 0)
                    @foreach ($customerWishlist as $wishlist)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <!-- Loop through each gallery image -->
                                            @foreach ($wishlist->options->galleryImages as $wishlistProductImg)
                                                <!-- Main image from gallery -->
                                                <div class="swiper-slide">
                                                    <img loading="lazy"
                                                        src="{{ asset('/storage/img/') }}/{{ $wishlistProductImg['path'] }}"
                                                        width="330" height="400" alt="Product Image" class="pc__img" />
                                                </div>
                                            @endforeach

                                            <!-- If images is a comma-separated string, split it and loop through -->
                                            @php
                                                $imageArray = explode(',', $wishlistProductImg['images']);
                                            @endphp

                                            @foreach ($imageArray as $image)
                                                <div class="swiper-slide">
                                                    <img loading="lazy"
                                                        src="{{ asset('/storage/img/') }}/{{ trim($image) }}"
                                                        width="330" height="400" alt="Product Image" class="pc__img" />
                                                </div>
                                            @endforeach
                                        </div>

                                        <span class="pc__img-prev">
                                            <svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_prev_sm" />
                                            </svg>
                                        </span>
                                        <span class="pc__img-next">
                                            <svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_next_sm" />
                                            </svg>
                                        </span>
                                    </div>

                                    <form action="{{ route('wishlist.destroy.item', $wishlist->rowId) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-remove-from-wishlist">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_close" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">
                                        {{ $wishlist->options->category_id->name }}
                                    </p>
                                    <h6 class="pc__title">{{ $wishlist->name }}</h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">${{ $wishlist->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-md-12 ">
                            <p>No items Added in the wishlist List</p>
                            <a href="{{ route('index.shop') }}" class="btn btn-sm btn-primary">Shop Now</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
