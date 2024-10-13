@extends('layouts.weblayout')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="cart.html" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="checkout.html" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="order-confirmation.html" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>
            <form name="checkout-form" action="{{ route('place.order') }}" method="POST">
                @csrf

                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        @if ($address)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-account__address-list">
                                        <div class="my-account__address-item">
                                            <div class="my-account__address-item__detail">
                                                <p><b class="fst-italic">Name :</b> {{ $address->name }}</p>
                                                <p><b class="fst-italic">Phone :</b> {{ $address->phone }}</p>
                                                <p><b class="fst-italic">House :</b> {{ $address->address }}</p>
                                                <p><b class="fst-italic">Land mark :</b> {{ $address->landmark }}</p>
                                                <p><b class="fst-italic">Locality :</b> {{ $address->locality }}</p>
                                                <p><b class="fst-italic">City :</b> {{ $address->city }}</p>
                                                <p><b class="fst-italic">State :</b> {{ $address->state }}</p>
                                                <p><b class="fst-italic">ZipCode :</b> {{ $address->zip }}</p>
                                                <p><b class="fst-italic">Country :</b> {{ $address->country }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="name" required="">
                                        <label for="name">Full Name *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="phone" required="">
                                        <label for="phone">Phone Number *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="zip" required="">
                                        <label for="zip">Pincode *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" name="state" required="">
                                        <label for="state">State *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="city" required="">
                                        <label for="city">Town / City *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="address" required="">
                                        <label for="address">House no, Building Name *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="locality" required="">
                                        <label for="locality">Road Name, Area, Colony *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="country" required="">
                                        <label for="country">Country *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="landmark" required="">
                                        <label for="landmark">Landmark *</label>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @include('alert.masseges')
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th align="right">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->name }} x {{ $item->qty }}
                                                </td>
                                                <td align="right">
                                                    ${{ $item->subtotal }}
                                                </td>
                                            </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                @if (Session::has('discounts'))
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td class="text-right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount {{ Session('coupon')['code'] }}</th>
                                                <td class="text-right">-${{ Session('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Subtotal After Discount</th>
                                                <td class="text-right">${{ Session('discounts')['subtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td class="text-right">Free</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td class="text-right">${{ Session('discounts')['tax'] }}</td>
                                            </tr>
                                            <tr class="cart-total">
                                                <th>Total</th>
                                                <td class="text-right">${{ Session('discounts')['total'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>SUBTOTAL</th>
                                                <td class="text-right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>SHIPPING</th>
                                                <td class="text-right">Free</td>
                                            </tr>
                                            <tr>
                                                <th>VAT</th>
                                                <td class="text-right">${{ Cart::instance('cart')->tax() }}</td>
                                            </tr>
                                            <tr class="cart-total">
                                                <th>TOTAL</th>
                                                <td class="text-right">${{ Cart::instance('cart')->total() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="checkout__payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio"
                                        name="mode" id="mode1" checked value="card">
                                    <label class="form-check-label" for="checkout_payment_method_1">
                                        Debit or Cradit Card
                                        
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio"
                                        name="mode" id="mode2" value="paypal">
                                    <label class="form-check-label" for="checkout_payment_method_4">
                                        Paypal
                                       
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio"
                                        name="mode" id="mode3" value="cod">
                                    <label class="form-check-label" for="checkout_payment_method_3">
                                        Cash on delivery
                                        
                                    </label>
                                </div>
                                
                                <div class="policy-text">
                                    Your personal data will be used to process your order, support your experience
                                    throughout this
                                    website, and for other purposes described in our <a href="terms.html"
                                        target="_blank">privacy
                                        policy</a>.
                                </div>
                            </div>
                            <button class="btn btn-primary btn-checkout">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
