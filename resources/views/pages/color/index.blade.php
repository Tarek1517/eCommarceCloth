@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Color</h3>
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
                        <div class="text-tiny">Color</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('add.category') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Show Color</th>
                                    <th>Color Code</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($colorContents as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td class="pname pb-4 pt-4">
                                            <div class="name">
                                                <div class="body-title-2 pb-4 pt-4">{{ $item->name }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $item->slug }}</td>

                                        <td>
                                            <div>
                                                <span
                                                    style="display: inline-block; width: 30px; height: 30px; background-color: {{ $item->Code }}">
                                                </span>
                                            </div>
                                        </td>
                                        <td>{{ $item->Code }}</td>
                                        <td><a href="#" target="_blank">1</a></td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('edit.color', $item->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <a href="{{ route('color.delete', $item->id) }}"
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
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
