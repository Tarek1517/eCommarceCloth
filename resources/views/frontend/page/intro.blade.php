@extends('layouts.cdashboard')
@section('CustomerDashboard')
    <p>Welcome <strong class="text-primary">{{ Auth::guard('customer')->user()->name }}</strong></p>
    <p>From your account dashboard you can view your <a class="unerline-link " href="{{ route('customer.orders') }}">recent
            orders</a>, manage your <a class="unerline-link" href="{{ route('customer.address') }}">shipping
            addresses</a>, and <a class="unerline-link"
            href="{{ route('account.details', Auth::guard('customer')->user()->id) }}">edit your password and account
            details.</a></p>
@endsection
