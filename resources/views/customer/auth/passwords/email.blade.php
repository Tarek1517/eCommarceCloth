@extends('layouts.weblayout')
@section('content')
    <div class="mb-4 pb-4 pt-90"></div>
    <section class="login-register container">
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab" href="#tab-item-login"
                    role="tab" aria-controls="tab-item-login" aria-selected="true">Password Reset Link</a>
            </li>
        </ul>

        @include('alert.masseges')

        <div class="tab-content pt-2" id="login_register_tab_content">
            <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
                <div class="login-form">
                    <form method="POST" action="{{ route('customer.password.email') }}" name="login-form"
                        class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control form-control_gray " name="email" value=""
                                required="" autocomplete="email" autofocus="">
                            <label for="email">Email address *</label>
                        </div>

                        <div class="pb-3"></div>

                        <button type="submit" class="btn btn-primary w-100 text-uppercase" type="submit">Send Password
                            Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
