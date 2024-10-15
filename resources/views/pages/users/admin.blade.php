@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Users</h3>
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
                        <div class="text-tiny">All User</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('add.admin') }}"><i class="icon-plus"></i>Add New
                        Admin</a>
                </div>
                <div class="wg-table table-all-user">

                    <div class="table-responsive">
                        @if (Auth::user()->u_type === 'administrator')
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AdminUsers as $Admusers)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{ url('/storage/img/' . $Admusers->image) }}" alt=""
                                                        class="image">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="name">
                                                    <a href="#" class="body-title-2">{{ $Admusers->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $Admusers->email }}</td>
                                            <td>
                                                @if ($Admusers->u_type === 'admin')
                                                    <div class="list-icon-function">
                                                        <a href="#" data-id="{{ $Admusers->id }}"
                                                            data-bs-toggle="modal" data-bs-target="#deleteAdmin"
                                                            class="open-delete-modal">
                                                            <div class="item text-danger delete">
                                                                <i class="icon-trash-2"></i>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @else
                                                <span class="bg-success text-white p-2">Administrator</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AdminUsers as $Ausers)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td class="pname">
                                                <div class="image">
                                                    <img src="{{ url('/storage/img/' . $Ausers->image) }}" alt=""
                                                        class="image">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="name">
                                                    <a href="#" class="body-title-2">{{ $Ausers->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $Ausers->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div class="modal fade" id="deleteAdmin" tabindex="-1" aria-labelledby="deleteAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal vertically -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAdminLabel" style="padding:11px 17px;">Please Type Password</h5>
                    <button type="button" class="btn-close px-5" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5"> <!-- Added padding here -->
                    <!-- Form inside the modal -->
                    <form name="delete-admin-form" id="deleteAdminForm" method="post">
                        @csrf
                        <!-- Password field -->
                        <div class="mb-3" style="padding-bottom:25px;">
                            <label for="old_password" class="form-label pb-2 fs-4">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="old_password" name="old_password"
                                placeholder="Type password" required>
                        </div>

                        <!-- Confirm Password field -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label pt-8 pb-2 fs-4">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="new_password_confirmation_model"
                                name="new_password_confirmation" placeholder="Confirm password" required>
                            <!-- Error message for mismatch -->
                            <span id="confirm_password_model" class="py-3" style="display: ;"></span>
                        </div>

                        <!-- Submit Button with spacing -->
                        <div class="mt-4" style="padding-top:25px;">
                            <button type="submit" class="btn btn-danger btn-lg w-100 pt-3 pb-3">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
