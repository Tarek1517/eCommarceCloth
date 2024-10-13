@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupon infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                @include('alert.masseges')

                <form class="form-new-product form-style-1" method="POST"
                    action="{{ route('update.coupons', $editCoupons->id) }}">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Code" name="code" tabindex="0"
                            value="{{ $editCoupons->code }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="category">
                        <div class="body-title">Coupon Type</div>
                        <div class="select flex-grow">
                            <select class="" name="type">
                                <option value="fixed" {{ $editCoupons->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percent" {{ $editCoupons->type == 'percent' ? 'selected' : '' }}>Percent
                                </option>

                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Value" name="value" tabindex="0"
                            value="{{ $editCoupons->value }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Cart Value" name="cart_value" tabindex="0"
                            value="{{ $editCoupons->cart_value }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="date" placeholder="Expiry Date" name="expiry_date" tabindex="0"
                            value="{{ $editCoupons->expiry_date ? \Carbon\Carbon::parse($editCoupons->expiry_date)->format('Y-m-d') : '' }}"
                            aria-required="true" required="">
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
