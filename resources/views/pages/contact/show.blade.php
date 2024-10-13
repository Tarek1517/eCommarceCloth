@extends('layouts.layout')
@section('dashboardContent')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Contact Details</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Contact Details</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box mt-5">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Details</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('contact.lists') }}">Back</a>
                </div>
                <table class="table table-striped table-bordered table-transaction custom-table">
                    <tbody>
                        <tr>
                            <th>Name :</th>
                            <td>{{ $contactDetails->name }}</td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td>{{ $contactDetails->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone No :</th>
                            <td>{{ $contactDetails->phone }}</td>
                        </tr>
                        <tr>
                            <th>Send at :</th>
                            <td>{{ $contactDetails->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Message :</th>
                            <td>{{ $contactDetails->comment }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
 
        </div>
    </div>
@endsection
