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

    <div class="wg-box">
        <div class="flex items-center justify-between gap-2 flex-nowrap">

            <div class="row">
                <div class="col-6">
                    <h5>Ordered Details</h5>
                </div>
                <div class="col-6 text-right">
                    <a class="btn btn-sm btn-primary" href="{{ route('customer.orders') }}">Back</a>
                </div>
            </div>

        </div>

        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">order No</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Zip Code</th>
                        <th class="text-center">Ordered Date</th>
                        <th class="text-center">Delivered Date</th>
                        <th class="text-center">Canceled Date</th>
                        <th class="text-center">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $order->id }}</td>
                        <td class="text-center">{{ $order->phone }}</td>
                        <td class="text-center">{{ $order->zip }}</td>
                        <td class="text-center">{{ $order->created_at }}</td>
                        <td class="text-center">{{ $order->delivered_date }}</td>
                        <td class="text-center">{{ $order->canceled_date }}</td>
                        <td class="text-center">
                            @if ($order->status == 'delivered')
                                <span class="badge bg-success">Delivered</span>
                            @elseif($order->status == 'canceled')
                                <span class="badge bg-danger">Canceled</span>
                            @else
                                <span class="badge bg-warning">Ordered</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

        </div>
    </div>

    <div class="wg-box mt-5">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <h5>Ordered Items</h5>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Brand</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Return Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>
                                <div class="name">
                                    <a href="#" target="_blank" class="body-title-2">{{ $item->product->name }}</a>
                                </div>
                            </td>
                            <td>
                                <div class="image">
                                    @foreach ($item->galleryImages as $img)
                                        <img src="{{ url('/storage/img/' . $img->path) }}" alt="" class="image"
                                            width="50" style="border-radius:10px;">
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">${{ $item->price }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">{{ $item->product->SKU }}</td>
                            <td class="text-center">{{ $item->product->category->name }}</td>
                            <td class="text-center">{{ $item->product->brand->name }}</td>
                            @php
                                $options = json_decode($item->options); // Decode options from JSON
                            @endphp
                            <td class="text-center">
                                @if (isset($options->color_id))
                                    {{ \App\Models\Color::find($options->color_id)->name ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-center">
                                @if (isset($options->size_id))
                                    {{ \App\Models\Size::find($options->size_id)->name ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="text-center">{{ $item->rstatus == 0 ? 'NO' : 'YES' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $orderItems->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Shipping Address</h5>
        <div class="my-account__address-item col-md-6">
            <div class="my-account__address-item__detail">
                <p><b class="fst-italic text-primary">Name :</b> {{ $order->name }}</p>
                <p><b class="fst-italic text-primary">Address :</b> {{ $order->address }}</p>
                <p><b class="fst-italic text-primary">Locality :</b> {{ $order->locality }}</p>
                <p><b class="fst-italic text-primary">City :</b> {{ $order->city }}</p>
                <p><b class="fst-italic text-primary">Country :</b> {{ $order->country }}</p>
                <p><b class="fst-italic text-primary">Land Mark :</b> {{ $order->landmark }}</p>
                <p><b class="fst-italic text-primary">Zip :</b> {{ $order->zip }}</p>
                <p><b class="fst-italic text-primary">State :</b> {{ $order->state }}</p>
                <br>
                <p><b class="fst-italic text-primary">Mobile :</b> {{ $order->phone }}</p>
            </div>
        </div>
    </div>

    <div class="wg-box mt-5">
        <h5>Transactions</h5>
        <table class="table table-striped table-bordered table-transaction">
            <tbody>
                <tr>
                    <th>Subtotal</th>
                    <td>${{ $transactions->order->subtotal }}</td>
                    <th>Tax</th>
                    <td>${{ $transactions->order->tax }}</td>
                    <th>Discount</th>
                    <td>${{ $transactions->order->discount }}</td>
                </tr>
                <tr>
                    <th class="text-primary">Total</th>
                    <td>${{ $transactions->order->total }}</td>
                    <th class="text-primary">Payment Mode</th>
                    <td>{{ $transactions->mode }}</td>
                    <th class="text-primary">Status</th>
                    <td>
                        @if ($transactions->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($transactions->status == 'declined')
                            <span class="badge bg-danger">Declined</span>
                        @elseif($transactions->status == 'refunded')
                            <span class="badge bg-secondary">Refunded</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $transactions->order->created_at }}</td>
                    <th>Delivered Date</th>
                    <td>{{ $transactions->order->delivered_date }}</td>
                    <th>Canceled Date</th>
                    <td>{{ $transactions->order->canceled_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($order->status == 'ordered')
        <div class="row mt-5">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">
                <form action="{{ route('customer.cancel.order') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_id" value="{{ $order->id }}" />
                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this order?')"
                        id="delete" class="btn btn-primary">Cancel Order</button>
                </form>
            </div>
        </div>
    @endif
@endsection
