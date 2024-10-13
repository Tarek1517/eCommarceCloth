@extends('layouts.layout')
@section('dashboardContent')

<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Slide</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="slider.html">
                        <div class="text-tiny">Slider</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">New Slide</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            @include('alert.masseges')
            <form class="form-new-product form-style-1" action="{{ route('update.Slide', $editSlides->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Taglines <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Taglines" name="tagline" tabindex="0"
                        value="{{ $editSlides->tagline }}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Title <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Title" name="title" tabindex="0"
                        value="{{ $editSlides->title }}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Subtitle <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Subtitle" name="subtitle" tabindex="0"
                        value="{{ $editSlides->subtitle }}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Link <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Link" name="link" tabindex="0"
                        value="{{ $editSlides->link }}" aria-required="true" required="">
                </fieldset>
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style=" border-radius: 10px;">
                            <img src="{{ asset('/storage/img/') }}/{{ $editSlides->image }}" class="effect8" alt="">
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
                <fieldset class="category">
                    <div class="body-title">Select Status</div>
                    <div class="select flex-grow">
                        <select class="" name="status">
                            <option value="active" {{ $editSlides->status == 'active' ? 'selected' : '' }}>active</option>
                            <option value="inactive" {{ $editSlides->status == 'inactive' ? 'selected' : '' }}>inactive</option>
                        </select>
                    </div>
                </fieldset>
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
        <!-- /new-category -->
    </div>
    <!-- /main-content-wrap -->
</div>

@endsection