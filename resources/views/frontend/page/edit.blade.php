@extends('layouts.cdashboard')
@section('CustomerDashboard')
    <div class="wg-box">
        <div class="flex items-center justify-between gap-2 flex-nowrap mb-3 mt-1">

            <div class="row">
                <div class="col-6">
                    <h5>Edit Address</h5>
                </div>
            </div>

        </div>

        <div class="my-account__address-list row">

            <form action="{{ route('update.address', $editAddress->id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="name" required=""
                                value="{{ $editAddress->name }}">
                            <label for="name">Full Name *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="phone" required=""
                                value="{{ $editAddress->phone }}">
                            <label for="phone">Phone Number *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="zip" required=""
                                value="{{ $editAddress->zip }}">
                            <label for="zip">Pincode *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" name="state" required=""
                                value="{{ $editAddress->state }}">
                            <label for="state">State *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="city" required=""
                                value="{{ $editAddress->city }}">
                            <label for="city">Town / City *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="address" required=""
                                value="{{ $editAddress->address }}">
                            <label for="address">House no, Building Name *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="locality" required=""
                                value="{{ $editAddress->locality }}">
                            <label for="locality">Road Name, Area, Colony *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="country" required=""
                                value="{{ $editAddress->country }}">
                            <label for="country">Country *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating my-3">
                            <input type="text" class="form-control" name="landmark" required=""
                                value="{{ $editAddress->landmark }}">
                            <label for="landmark">Landmark *</label>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating my-3">
                            <button class="btn btn-primary btn-checkout">UPDATE ADDRESS</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection
