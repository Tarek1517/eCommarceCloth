@extends('layouts.cdashboard')
@section('CustomerDashboard')
    <div class="wg-box">
        @if (is_null($CustomerAddress))
            <h2>You did not add your Details Yet!!</h2>
        @else
            <div class="flex items-center justify-between gap-2 flex-nowrap mb-3 mt-1">

                <div class="row">
                    <div class="col-6">
                        <h5>Shipping Address</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-sm btn-primary" href="{{ route('edit.customer', $CustomerAddress->id) }}">Edit</a>
                    </div>
                </div>

            </div>

            <div class="my-account__address-list row">
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__title">
                        <h5>{{ $CustomerAddress->name }} <i class="fa fa-check-circle text-success"></i></h5>
                    </div>
                    <div class="my-account__address-item__detail">
                        <p><b class="fst-italic">Phone :</b> {{ $CustomerAddress->phone }}</p>
                        <p><b class="fst-italic">House :</b> {{ $CustomerAddress->address }}</p>
                        <p><b class="fst-italic">Land mark :</b> {{ $CustomerAddress->landmark }}</p>
                        <p><b class="fst-italic">Locality :</b> {{ $CustomerAddress->locality }}</p>
                        <p><b class="fst-italic">City :</b> {{ $CustomerAddress->city }}</p>
                        <p><b class="fst-italic">State :</b> {{ $CustomerAddress->state }}</p>
                        <p><b class="fst-italic">ZipCode :</b> {{ $CustomerAddress->zip }}</p>
                        <p><b class="fst-italic">Country :</b> {{ $CustomerAddress->country }}</p>
                    </div>
                </div>
            </div>
        @endif

        @include('alert.masseges')

    </div>
@endsection
