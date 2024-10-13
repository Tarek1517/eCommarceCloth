@extends('layouts.layout')
@section('dashboardContent')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Update Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index-2.html">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="all-product.html">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit product</div>
                    </li>
                </ul>
            </div>
            @include('alert.masseges')
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" action="{{ route('update.product', $editProduct->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="_token" value="8LNRTO4LPXHvbK2vgRcXqMeLgqtqNGjzWSNru7Xx" autocomplete="off"> --}}
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                            value="{{ $editProduct->name }}" aria-required="true" required="" id="name">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>

                        <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0"
                            value="{{ $editProduct->slug }}" aria-required="true" required="" id="slug">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>

                    </fieldset>

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $editProduct->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $editProduct->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    <div class="gap22 cols">
                        <fieldset class="brand">
                            <div class="body-title mb-10">Size <span class="tf-color-1">*</span></div>
                            <div class="select ">

                                <select class="form-control js-example-basic-multiple" name="size_id[]" multiple>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}"
                                            {{ in_array($size->id, $editProduct->size->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="category">
                            <div class="body-title mb-10">color <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">

                                <select class="form-control js-example-basic-multiple" name="color_id[]" multiple>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ in_array($color->id, $editProduct->color->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
                            aria-required="true" required="">{{ $editProduct->short_description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"
                            required="">{{ $editProduct->description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title mb-10">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview">

                                <div class="gallery">

                                    @foreach ($editProduct->galleryImages as $image)
                                        <img src="{{ asset('/storage/img/') }}/{{ $image->path }}" class="effect8"
                                            alt="Gallery Image">
                                    @endforeach
                                </div>


                            </div>

                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="myFile" name="path" accept="path/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>



                    <fieldset>
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="upload-image mb-16">

                            <div id="galUpload" class="item up-load">
                                @if ($editProduct->galleryImages->isNotEmpty())
                                    @foreach ($editProduct->galleryImages as $image)
                                        @if ($image->images)
                                            @php
                                                $imagesArray = explode(',', $image->images);
                                            @endphp

                                            @foreach ($imagesArray as $imgPath)
                                                <div class="item gitems">
                                                    <img src="{{ asset('/storage/img/') }}/{{ $imgPath }}"
                                                        class="effect8" alt="Gallery Image">
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @else
                                    <p>No gallery images available for this product.</p>
                                @endif
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="images/*"
                                        multiple="">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                                value="{{ $editProduct->regular_price }}">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price"
                                value="{{ $editProduct->sale_price }}">
                        </fieldset>
                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0"
                                value="{{ $editProduct->SKU }}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="number" placeholder="Enter quantity" name="quantity"
                                tabindex="0" value="{{ $editProduct->quantity }}" aria-required="true"
                                required="">
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="instock"
                                        {{ $editProduct->stock_status == 'instock' ? 'selected' : '' }}>InStock</option>
                                    <option value="outofstock"
                                        {{ $editProduct->stock_status == 'outofstock' ? 'selected' : '' }}>Out of Stock
                                    </option>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Featured</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    @foreach ($editProduct->galleryImages as $item)
                                        <option value="0" {{ $item->featured == '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $item->featured == '1' ? 'selected' : '' }}>Yes</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>

                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Update product</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
