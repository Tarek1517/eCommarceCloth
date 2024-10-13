@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brands</h3>
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
                        <div class="text-tiny">Brands</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">

                @include('alert.masseges')

                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Gallery</th>
                                    <th>featured</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($gallery as $image)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>

                                        <td>
                                            <div class="image">
                                                <img src="{{ url('/storage/img/' . $image->path) }}" alt=""
                                                    width="60" style="border-radius:10px;" class="image">
                                            </div>
                                        </td>

                                        <td>
                                            @if ($image->images)
                                                @php
                                                    $imagesArray = explode(',', $image->images);
                                                    $firstImage = $imagesArray[0];
                                                @endphp
                                                <img src="{{ asset('storage/img/' . $firstImage) }}" alt="Gallery Image"
                                                    width="60" data-bs-toggle="modal" style="border-radius:10px;"
                                                    data-bs-target="#galleryModal{{ $image->id }}">


                                                <!-- Modal -->
                                                <div class="modal fade" id="galleryModal{{ $image->id }}" tabindex="-1"
                                                    aria-labelledby="galleryModalLabel{{ $image->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="galleryModalLabel{{ $image->id }}">Gallery Images
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    @foreach ($imagesArray as $img)
                                                                        <div class="col-md-4">
                                                                            <img src="{{ asset('storage/img/' . $img) }}"
                                                                                alt="Gallery Image" class="img-fluid mb-3"
                                                                                style="border-radius:10px;">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>No gallery images</p>
                                            @endif
                                        </td>

                                        <td><a href="#" target="_blank">

                                                @if ($image->featured == 1)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-danger">No</span>
                                                @endif

                                            </a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
