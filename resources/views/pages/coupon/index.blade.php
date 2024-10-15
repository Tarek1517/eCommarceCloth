@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupons</h3>
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
                        <div class="text-tiny">Coupons</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('add.coupons') }}"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Cart Value</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($couponContents as $coupons)
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $coupons->code }}</td>
                                        <td>{{ $coupons->type }}</td>
                                        <td>{{ $coupons->value }}</td>
                                        <td>{{ $coupons->cart_value }}</td>
                                        <td>{{ $coupons->expiry_date }}</td>
                                        <td class="align-middle"> <span
                                                class="bg-{{ $coupons->status === 'active' ? 'success' : 'warning' }} px-2 py-1 rounded text-white text-[12px]">
                                                {{ ucfirst($coupons->status) }} </span></td>
                                        <td>
                                            <div class="list-icon-function">
                                                @if ($coupons->status === 'active')
                                                    <a href="{{ route('pending.coupons', $coupons->id) }}" title="Pending"
                                                        class="btn btn-warning"><i
                                                            class="fa-regular fa-thumbs-down"></i></a>
                                                @else
                                                    <a href="{{ route('active.coupons', $coupons->id) }}" title="Active"
                                                        class="btn btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                                                @endif
                                                <a href="{{ route('edit.coupons', $coupons->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <a href="{{ route('coupons.delete', $coupons->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                                    class="item text-danger delete"><i class="icon-trash-2"></i>
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
