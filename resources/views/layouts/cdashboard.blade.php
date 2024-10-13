@extends('layouts.weblayout')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title"><span>Hello {{ Auth::guard('customer')->user()->name }}</span></h2>
            <div class="row">
                <div class="col-lg-2">
                    <ul class="account-nav">
                        <li><a href="{{ route('customer.dashboard') }}"
                                class="menu-link menu-link_us-s {{ Route::currentRouteName() == 'customer.dashboard' ? 'menu-link_active' : '' }}">Dashboard</a>
                        </li>
                        <li><a href="{{ route('customer.orders') }}"
                                class="menu-link menu-link_us-s {{ Route::currentRouteName() == 'customer.orders' ? 'menu-link_active' : '' }}">Orders</a>
                        </li>
                        <li><a href="{{ route('customer.address') }}"
                                class="menu-link menu-link_us-s {{ Route::currentRouteName() == 'customer.address' ? 'menu-link_active' : '' }}">Addresses</a>
                        </li>
                        <li><a href="{{ route('account.details', Auth::guard('customer')->user()->id) }}"
                                class="menu-link menu-link_us-s {{ Route::currentRouteName() == 'account.details' ? 'menu-link_active' : '' }}">Account
                                Details</a></li>
                        <li><a href="{{ route('customer.wishlist') }}"
                                class="menu-link menu-link_us-s {{ Route::currentRouteName() == 'customer.wishlist' ? 'menu-link_active' : '' }}">Wishlist</a>
                        </li>
                        <li><a href="{{ route('customer.logout') }}" class="menu-link menu-link_us-s">Logout</a></li>
                    </ul>
                </div>
                <div class="col-lg-10">
                    <div class="page-content my-account__dashboard">
                        @yield('CustomerDashboard')
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
