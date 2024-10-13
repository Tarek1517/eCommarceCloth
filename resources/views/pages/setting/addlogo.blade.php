@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Change Logo</h3>
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
                        <div class="text-tiny">Change Logo</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                @include('alert.masseges')
                <div class="col-lg-12">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form name="account_edit_form" action="{{ route('update.logo') }}" method="POST"
                                class="form-new-product form-style-1 needs-validation" novalidate=""
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="upload-image flex-grow">
                                        <div class="item" id="imgpreview" style=" border-radius: 10px;">
                                            <img src="{{ asset('/storage/img/') }}/{{ $changeLogo->image }}" class="effect8" alt="">
                                        </div>
                                        <div class="item up-load">
                                            <label class="uploadfile" for="myFile">
                                                <span class="icon">
                                                    <i class="icon-upload-cloud"></i>
                                                </span>
                                                <span class="body-text">Drop your images here or select <span
                                                        class="tf-color">click to
                                                        browse</span></span>
                                                <input type="file" id="myFile" name="image">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="my-3">
                                    <button type="submit" class="btn btn-primary tf-button w208">Change Logo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
