@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>About Us</h3>
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
                        <div class="text-tiny">About Us</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('add.about') }}"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title </th>
                                    <th>Bold Desc</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>About Sidebar Data</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($aboutContents as $abouts)
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $abouts->title }}</td>
                                        <td>
                                            {{ \Illuminate\Support\str::limit(strip_tags($abouts->bdescription), 20) }}
                                        </td>
                                        <td>
                                            {{ \Illuminate\Support\str::limit(strip_tags($abouts->description), 20) }}
                                        </td>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{ url('/storage/img/' . $abouts->image) }}" alt=""
                                                    class="image">
                                            </div>
                                        </td>

                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-outline-success mt-2 btn-modal"
                                                    data-toggle="modal" data-target=".aboutSidebarModal"
                                                    data-aboutsidebar="{{ $abouts->aboutsidebar }}"
                                                    data-baseurl="{{ asset('storage/img/') }}">Features</button>

                                            </div>
                                        </td>
                                        <td class="align-middle"> <span
                                                class="bg-{{ $abouts->status === 'active' ? 'success' : 'warning' }} px-2 py-1 rounded text-white text-[12px]">
                                                {{ ucfirst($abouts->status) }} </span></td>
                                        <td>
                                            <div class="list-icon-function">
                                                @if ($abouts->status === 'active')
                                                    <a href="{{ route('pending.about', $abouts->id) }}" title="Pending"
                                                        class="btn btn-warning"><i
                                                            class="fa-regular fa-thumbs-down"></i></a>
                                                @else
                                                    <a href="{{ route('active.about', $abouts->id) }}" title="Active"
                                                        class="btn btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                                                @endif
                                                <a href="{{ route('edit.about', $abouts->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <a href="{{ route('about.delete', $abouts->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                                    id="delete" class="item text-danger delete"><i
                                                        class="icon-trash-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
        <div class="modal fade aboutSidebarModal" tabindex="-1" role="modal" aria-labelledby="modalLMedium"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <div class="modal-content p-5">

                    <table id="data-table">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>S Title</th>
                                <th>S Desc</th>
                                <th>S Image</th>
                                <th>S Side</th>
                            </tr>
                        </thead>
                        <tbody class="show-modal-data">

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
@endsection
