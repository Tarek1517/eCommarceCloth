@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Customer Users</h3>
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
                        <div class="text-tiny">Customer User</div>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($CustomerUsers as $Cusers)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $Cusers->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $Cusers->email }}</td>
                                        <td>{{ $Cusers->mobile }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('delete.customer', $Cusers->id) }}"
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

                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>
@endsection
