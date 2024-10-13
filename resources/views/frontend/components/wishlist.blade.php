@extends('layouts.weblayout')
@section('content')

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Wishlist</h2>

            <div class="shopping-cart">
                <div class="cart-table__wrapper">
                    @if ($items->count() > 0)
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $wishlist)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                @foreach ($wishlist->options->galleryImages as $wishlistProductImg)
                                                    <img loading="lazy"
                                                        src="{{ asset('/storage/img/') }}/{{ $wishlistProductImg['path'] }}"
                                                        width="120" height="120" alt="" />
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{ $wishlist->name }}</h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>
                                                        <span class="text-dark"> Color:</span>
                                                        @foreach ($wishlist->options->color_id as $color)
                                                            {{ $color->name . ', ' }}
                                                        @endforeach
                                                    </li>
                                                    <li>
                                                        <span class="text-dark"> Size:</span>
                                                        @foreach ($wishlist->options->size_id as $size)
                                                            {{ $size->name . ', ' }}
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">${{ $wishlist->price }}</span>
                                        </td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <span type="number" name="quantity" value="1">1</span>
                                            </div><!-- .qty-control -->
                                        </td>

                                        <td>
                                            <form action="{{ route('move.to.cart', $wishlist->rowId) }}" method="post">
                                                @csrf
                                                <button type="submit" class="remove-cart btn btn-sm btn-primary">Move to
                                                    Cart</button>
                                            </form>
                                        </td>

                                        <td>
                                            <form action="{{ route('wishlist.destroy.item', $wishlist->rowId) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="remove-wishlist">
                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                        <path
                                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                    </svg>
                                                </a>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <form action="{{ route('clear.wishlist') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary mt-5">CLEAR WISHLIST</button>
                        </form>
                    @else
                        <div class="row">
                            <div class="col-md-12 text-center pt-5 bp-5">
                                <p>No items Added in the wishlist List</p>
                                <a href="{{ route('index.shop') }}" class="btn btn-primary">Shop Now</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

@endsection
