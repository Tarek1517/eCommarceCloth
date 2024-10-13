@extends('layouts.weblayout')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Cart</h2>
            <div class="checkout-steps">
                <a href="javaScript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javaScript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javaScript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>
            <div class="shopping-cart">
                @if ($items->count() > 0)
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $cart)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                @foreach ($cart->options->galleryImages as $cartProductImg)
                                                    <img loading="lazy"
                                                        src="{{ asset('/storage/img/') }}/{{ $cartProductImg }}"
                                                        width="120" height="120" alt="" />
                                                @endforeach
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{ $cart->name }}</h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>
                                                        <span class="text-dark">Color:</span>
                                                        <span class="text-muted">
                                                            @if ($cart->options->color_id)
                                                                {{ \App\Models\Color::find($cart->options->color_id)->name ?? 'N/A' }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span class="text-dark">Size:</span>
                                                        <span class="text-muted">
                                                            @if ($cart->options->size_id)
                                                                {{ \App\Models\Size::find($cart->options->size_id)->name ?? 'N/A' }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="shopping-cart__product-price">${{ $cart->price }}</span>
                                        </td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <input type="number" name="quantity" value="{{ $cart->qty }}"
                                                    min="1" class="qty-control__number text-center">
                                                <form action="{{ route('cart.qty.decrease', $cart->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__reduce">-</div>
                                                </form>
                                                <form action="{{ route('cart.qty.increase', $cart->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__increase">+</div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal">${{ $cart->subtotal() }}</span>
                                        </td>

                                        <td>
                                            <form action="{{ route('cart.destroy.item', $cart->rowId) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javaScript:void(0)" class="remove-cart">
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
                        <div class="cart-table-footer">
                            @if (!Session::has('coupon'))
                                <form class="position-relative bg-body" method="POST"
                                    action="{{ route('cart.apply.coupon') }}">
                                    @csrf
                                    <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                                    <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4"
                                        type="submit" value="APPLY COUPON">
                                </form>
                            @else
                                <form class="position-relative bg-body" method="POST"
                                    action="{{ route('clear.coupon') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                                    <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4"
                                        type="submit" value="REMOVE COUPON">
                                </form>
                            @endif
                            <form action="{{ route('clear.cart') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">CLEAR CART</button>
                            </form>
                        </div>
                        <div class="coupon-massege">
                            @if (Session::has('success'))
                                <p class="text-success">{{ Session::get('success') }}</p>
                            @else
                                <p class="text-danger">{{ Session::get('error') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Cart Totals</h3>
                                @if (Session::has('discounts'))
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount {{ Session('coupon')['code'] }}</th>
                                                <td>-${{ Session('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal After Discount</th>
                                                <td>${{ Session('discounts')['subtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td class="text-left">Free</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td>${{ Session('discounts')['tax'] }}</td>
                                            </tr>
                                            <tr class="cart-total">
                                                <th>Total</th>
                                                <td>${{ Session('discounts')['total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="cart-totals">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td class="text-left">Free</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td>${{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr class="cart-total">
                                                <th>Total</th>
                                                <td>${{ Cart::instance('cart')->total() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="button-wrapper container">
                                    <a href="{{ route('show.checkout') }}" class="btn btn-primary">PROCEED TO
                                        CHECKOUT-T</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12 text-center pt-5 bp-5">
                            <p>No items Added in the Cart List</p>
                            <a href="{{ route('index.shop') }}" class="btn btn-primary">Shop Now</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

@endsection
