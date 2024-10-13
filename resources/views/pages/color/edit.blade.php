@extends('layouts.layout')
@section('dashboardContent')

<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Colors update</h3>
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
                        <div class="text-tiny">Color</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">New Color</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            @include('alert.masseges')
            <form class="form-new-product form-style-1" action="{{ route('update.color', $editColor->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Color Name <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Color Name" name="name" id="name"
                        tabindex="0" value="{{$editColor->name}}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Color Code <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Color Code" name="Code" id="Code"
                        tabindex="0" value="{{$editColor->Code}}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Code Slug <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Code Slug" name="slug" id="slug"
                        tabindex="0" value="{{$editColor->slug}}" aria-required="true" required="">
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