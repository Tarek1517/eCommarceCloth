@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Orders</h3>
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
                        <div class="text-tiny">Orders</div>
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
                    <button type="button" class="tf-button style-1 w208" id="deleteAllselecteds">
                        <i class="fa-solid fa-trash"></i> Delete Selected
                    </button>

                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <form action="{{ route('orders.deleteSelected') }}" method="POST" id="deleteOrdersForm">
                            @csrf
                            @method('DELETE')
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:50px">
                                            <input type="checkbox" id="select_all_ids" class="checkbox_ids_header">
                                        </th>
                                        <th style="width:70px">OrderNo</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-center">Total</th>

                                        <th class="text-center">Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Total Items</th>
                                        <th class="text-center">Delivered On</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="ids[]" value="{{ $order->id }}"
                                                    class="checkbox_ids">
                                            </td>
                                            <td class="text-center">#{{ $order->id }}</td>
                                            <td class="text-center">{{ $order->name }}</td>
                                            <td class="text-center">{{ $order->phone }}</td>
                                            <td class="text-center">${{ $order->subtotal }}</td>
                                            <td class="text-center">${{ $order->tax }}</td>
                                            <td class="text-center">${{ $order->total }}</td>

                                            <td class="text-center">
                                                @if ($order->status == 'ordered')
                                                    <span class="badge bg-warning">ordered</span>
                                                @elseif($order->status == 'delivered')
                                                    <span class="badge bg-success">delivered</span>
                                                @else
                                                    <span class="badge bg-danger">canceled</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $order->created_at }}</td>
                                            <td class="text-center">{{ $order->orderItems->count() }}</td>
                                            <td class="text-center">{{ $order->delivered_date }}</td>
                                            <td class="text-center">
                                                <div class="icon-actions"
                                                    style="display: flex; justify-content: center; gap: 10px;">
                                                    <a href="{{ route('order.details', ['order_id' => $order->id]) }}">
                                                        <div class="list-icon-function view-icon">
                                                            <div class="item eye">
                                                                <i class="icon-eye"></i>
                                                            </div>
                                                        </div>
                                                    </a>

                                                    <a href="#" class="text-danger mt-4"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this order?')) { document.getElementById('delete-form-{{ $order->id }}').submit(); }">
                                                        <i class="icon-trash-2"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $order->id }}"
                                                        action="{{ route('order.delete', $order->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $Orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
