@extends('layouts.cdashboard')
@section('CustomerDashboard')
    <div class="wg-box">
        <div class="flex items-center justify-between gap-2 flex-nowrap mb-3 mt-1">

            <div class="row">
                <div class="col-6">
                    <h5>Account Details</h5>
                </div>
            </div>

        </div>
        <form name="account_edit_form" action="{{ route('update.details', $accountDetails->id) }}" method="POST"
            class="needs-validation" novalidate="">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="Full Name" name="name"
                            value="{{ $accountDetails->name }}" required="">
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile"
                            value="{{ $accountDetails->mobile }}" required="">
                        <label for="mobile">Mobile Number</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="email" class="form-control" placeholder="Email Address" name="email"
                            value="{{ $accountDetails->email }}" required="">
                        <label for="account_email">Email Address</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="my-3">
                        <h5 class="text-uppercase mb-0">Password Change</h5>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="Old password" required="">
                        <label for="old_password">Old password</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            placeholder="New password" required="">
                        <label for="account_new_password">New password</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating my-3">
                        <input type="password" class="form-control" cfpwd="" data-cf-pwd="#new_password"
                            id="new_password_confirmation" name="new_password_confirmation"
                            placeholder="Confirm new password" required="">
                        <label for="new_password_confirmation">Confirm new password</label>
                        <span id="confirm_password" class="" style="display: ;"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>

        @include('alert.masseges')
        
    </div>
@endsection
