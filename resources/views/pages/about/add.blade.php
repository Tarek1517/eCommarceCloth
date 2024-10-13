@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>About infomation</h3>
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
                            <div class="text-tiny">About</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New About</div>
                    </li>
                </ul>
            </div>


            <!-- new-category -->
            <div class="wg-box">
                @include('alert.masseges')
                <form class="form-new-product form-style-1" action="{{ route('store.about') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title" name="title" tabindex="0"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Bold Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10" name="bdescription" placeholder="Bold Description" tabindex="0" aria-required="true"
                            required=""></textarea>
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"
                            required=""></textarea>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="upload-1.html" class="effect8" alt="">
                            </div>
                            <div class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="image">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <h6 class="mt-5 mb-6 text-primary">About Sidebar</h6>


                    <fieldset class="name">
                        <div class="body-title">Sidebar Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Sidebar Title" name="stitle[]" tabindex="0"
                            value="" aria-required="true" required="">
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title">Sidebar Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="sdescription[]" placeholder="Sidebar Description" tabindex="0" aria-required="true"
                            required=""></textarea>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload Sidebar images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgprev" style="display:none">
                                <img src="upload-1.html" class="effect8" alt="">
                            </div>
                            <div class="item up-load">
                                <label class="uploadfile" for="myImg">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myImg" name="simage[]">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Select Side</div>
                        <div class="select flex-grow">
                            <select class="" name="side[]">
                                <option value="right">Right</option>
                                <option value="left">Left</option>
                            </select>
                        </div>
                    </fieldset>

                    <span id="moreFeatures" class="form-style-1 mt-5">

                    </span>

                    <div class="bot d-md-flex justify-content-md-end">
                        <div></div>
                        <button type="button" class="btn btn-outline-primary px-5 py-4 rounded-pill" data-toggle="modal"
                            id="btn-Features">Add About Sidebar</button>
                    </div>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection