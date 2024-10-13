@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Deals</h3>
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
                            <div class="text-tiny">Deals</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Deals</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                @include('alert.masseges')
                <form class="form-new-product form-style-1" action="{{ route('update.deals', $editDeals->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Main Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Main Title" name="mtitle" tabindex="0"
                            value="{{ $editDeals->mtitle }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Title 1<span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title 1" name="title1" tabindex="0"
                            value="{{ $editDeals->title1 }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Title 2<span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title 2" name="title2" tabindex="0"
                            value="{{ $editDeals->title2 }}" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Link <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Link" name="link" tabindex="0"
                            value="{{ $editDeals->link }}" aria-required="true" required="">
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
