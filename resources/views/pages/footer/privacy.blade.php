@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Privacy Data</h3>
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
                            <div class="text-tiny">Privacy</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Privacy Data</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                @include('alert.masseges')
                <form class="form-new-product gap-5" action="{{ route('store.Privacy', $editPrivacy->id) }}" method="POST"
                    enctype="multipart/form-data" id="career-form">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title mb-5">Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title" name="name" tabindex="0"
                            value="{{ $editPrivacy->name }}" aria-required="true" required="">
                    </fieldset>

                    <fieldset class="description1">
                        <div class="body-title2 mb-5">Description <span class="tf-color-1">*</span></div>
                        <div id="editor"></div> <!-- Quill editor container -->
                        <textarea name="description" id="description" style="display:none"></textarea> <!-- Hidden textarea -->
                    </fieldset>

                    <div class="bot py-5">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

<script>
    var description = {!! json_encode($editPrivacy->description) !!}; // Passing PHP data to a JS variable
</script>
