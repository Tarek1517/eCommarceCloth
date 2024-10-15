@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Admin</h3>
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
                            <div class="text-tiny">Admin</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add Admin</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                @include('alert.masseges')
                <form class="form-new-product form-style-1" action="{{ route('store.admin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Name <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="Full Name" name="name" tabindex="0"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Email Address <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Email Address" name="email" tabindex="0"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title pb-3">New password <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="password" placeholder="New password" id="new_password"
                            name="password" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name w-100">
                        <div class="body-title pb-3">Confirm new password <span class="tf-color-1">*</span></div>
                        <div class="form-group w-100">
                            <input class="form-control w-100" type="password" placeholder="Confirm new password"
                                cfpwd="" data-cf-pwd="#new_password" id="new_password_confirmation"
                                name="new_password_confirmation" aria-required="true" required>
                            <!-- Error message directly below the input -->
                            <span id="confirm_password" class="px-3" style="display: ;"></span>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="upload-1.html" class="effect8" alt="">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
