@extends('layouts.cdashboard')
@section('CustomerDashboard')
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #080807 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: gray;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }
    </style>
    <h4><strong class="text-primary">{{ Auth::guard('customer')->user()->name }}'s</strong> Order Lists</h4>
    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th style="width: 80px">OrderNo</th>
                <th>Name</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Subtotal</th>
                <th class="text-center">Tax</th>
                <th class="text-center">Total</th>

                <th class="text-center">Status</th>
                <th class="text-center">Order Date</th>
                <th class="text-center">Items</th>
                <th class="text-center">Delivered On</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($CustomerOrders as $order)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="text-center">{{ $order->name }}</td>
                    <td class="text-center">{{ $order->phone }}</td>
                    <td class="text-center">${{ $order->subtotal }}</td>
                    <td class="text-center">${{ $order->tax }}</td>
                    <td class="text-center">${{ $order->total }}</td>
                    <td class="text-center">
                        @if ($order->status == 'delivered')
                            <span class="badge bg-success">Delivered</span>
                        @elseif($order->status == 'canceled')
                            <span class="badge bg-danger">Canceled</span>
                        @else
                            <span class="badge bg-warning">Ordered</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $order->created_at }}</td>
                    <td class="text-center">{{ $order->orderItems->count() }}</td>
                    <td class="text-center">{{ $order->delivered_date }}</td>
                    <td class="text-center">
                        <a href="{{ route('customer.order.details', ['order_id' => $order->id]) }}">
                            <div class="list-icon-function view-icon">
                                <div class="item eye">
                                    <i class="fa fa-eye"></i>
                                </div>
                            </div>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="divider"></div>
    <div class="flex items-center justify-between flex-wrap gap-10 wg-pagination">
        {{ $CustomerOrders->links('pagination::bootstrap-5') }}
    </div>
@endsection
