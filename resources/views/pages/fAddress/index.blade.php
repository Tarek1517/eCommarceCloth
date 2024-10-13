@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Footer Address</h3>
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
                        <div class="text-tiny">Footer Address</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('add.faddress') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Links</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($fAddressContents as $fAddress)
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $fAddress->phone }}</td>
                                        <td>{{ $fAddress->email }}</td>
                                        <td>{{ $fAddress->address }}</td>
                                        <td class="align-middle">
                                            @if ($fAddress->f_link)
                                                <a href="{{ $fAddress->f_link }}" class="mr-1"><i
                                                        class="fa-brands fa-square-facebook"></i></a>
                                            @endif
                                            @if ($fAddress->t_link)
                                                <a href="{{ $fAddress->t_link }}" class="mr-1"><i
                                                        class="fa-brands fa-square-x-twitter"></i></a>
                                            @endif
                                            @if ($fAddress->I_link)
                                                <a href="{{ $fAddress->I_link }}" class="mr-1"><i
                                                        class="fa-brands fa-instagram"></i></a>
                                            @endif
                                            @if ($fAddress->Y_link)
                                                <a href="{{ $fAddress->Y_link }}" class=""><i
                                                        class="fa-brands fa-youtube"></i></a>
                                            @endif
                                            @if ($fAddress->p_link)
                                                <a href="{{ $fAddress->p_link }}" class=""><i
                                                        class="fa-brands fa-square-pinterest"></i></a>
                                            @endif
                                        </td>
                                        <td class="align-middle"> <span
                                                class="bg-{{ $fAddress->status === 'active' ? 'success' : 'warning' }} px-2 py-1 rounded text-white text-[12px]">
                                                {{ ucfirst($fAddress->status) }} </span></td>
                                        <td>
                                            <div class="list-icon-function">
                                                @if ($fAddress->status === 'active')
                                                    <a href="{{ route('pending.faddress', $fAddress->id) }}" title="Pending"
                                                        class="btn btn-warning"><i
                                                            class="fa-regular fa-thumbs-down"></i></a>
                                                @else
                                                    <a href="{{ route('active.faddress', $fAddress->id) }}" title="Active"
                                                        class="btn btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                                                @endif
                                                <a href="">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <a href="{{ route('faddress.delete', $fAddress->id) }}"
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
    </div>
@endsection
