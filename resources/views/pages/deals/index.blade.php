@extends('layouts.layout')
@section('dashboardContent')

<div class="main-content-inner">
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
                    <div class="text-tiny">Deals List</div>
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
                <a class="tf-button style-1 w208" href="{{ route('add.deals') }}"><i class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-all-user">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Main Title </th>
                            <th>Title 1</th>
                            <th>Title 2</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($DealsContents as $deals)
                            <tr>
                                <td>{{ $deals->id }}</td>
                                <td>{{ $deals->mtitle }}</td>
                                <td>{{ $deals->title1 }}</td>
                                <td>{{ $deals->title2 }}</td>
                                <td>{{ $deals->link }}</td>
                                <td>
                                    @if ($deals->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="list-icon-function">
                                        @if ($deals->status === 'active')
                                            <a href="{{ route('inactive.deals', $deals->id) }}" title="inActive"
                                                class="btn btn-warning"><i class="fa-regular fa-thumbs-down"></i></a>
                                        @else
                                            <a href="{{ route('active.deals', $deals->id) }}" title="Active"
                                                class="btn btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                                        @endif
                                        <a href="{{ route('edit.deals', $deals->id) }}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <a href="{{ route('deals.delete', $deals->id) }}"
                                            onclick="return confirm('Are you sure you want to delete this item?')"
                                            id="delete">
                                            <div class="item text-danger delete">
                                                <i class="icon-trash-2"></i>
                                            </div>
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

@endsection