@extends('layouts.layout')
@section('dashboardContent')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Footer Address</h3>
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
                        <div class="text-tiny">Footer Address</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Add Footer Address</div>
                </li>
            </ul>
        </div>


        <!-- new-category -->
        <div class="wg-box">
            @include('alert.masseges')
            <div class="col-lg-12">
                <div class="page-content my-account__edit">
                    <div class="my-account__edit-form">
                        <form name="account_edit_form" action="{{route('store.faddress')}}"
                            method="POST" class="form-new-product form-style-1 needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <fieldset class="name">
                                <div class="body-title">Phone Number<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="number" placeholder="Phone Number" name="phone"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Email<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="email" placeholder="Email Address" name="email"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <fieldset class="description">
                                <div class="body-title">Address<span class="tf-color-1">*</span>
                                </div>
                                <textarea class="mb-10" name="address" placeholder="address" tabindex="0" aria-required="true"
                                    required=""></textarea>
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">FaceBook<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="url" placeholder="Facebook Link" name="f_link"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Twetter<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="url" placeholder="Twetter Link" name="t_link"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Instagram<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="url" placeholder="Instagram Link" name="I_link"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Youtube<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="url" placeholder="Youtube Link" name="Y_link"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <fieldset class="name">
                                <div class="body-title">Pinterest<span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="url" placeholder="Pinterest Link" name="p_link"
                                    tabindex="0" value="" aria-required="true" required="">
                            </fieldset>

                            <div class="bot">
                                <div></div>
                                <button class="tf-button w208" type="submit">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection