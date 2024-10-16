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
                <h3>Order Details</h3>
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
                        <div class="text-tiny">Order Items</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">

                @if (Session::has('status'))
                    <p class="alert alert-success">{{ Session::get('status') }}</p>
                @endif
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Ordered Details</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('order.lists') }}">Back</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-striped table-transaction">
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
                                            <a href="#" target="_blank"
                                                class="body-title-2">{{ $item->product->name }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="image">
                                            @foreach ($item->galleryImages as $img)
                                                <img src="{{ url('/storage/img/' . $img->path) }}" alt=""
                                                    class="image">
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
                        <p><b class="fst-italic">Name :</b> {{ $order->name }}</p>
                        <p><b class="fst-italic">Address :</b> {{ $order->address }}</p>
                        <p><b class="fst-italic">Locality :</b> {{ $order->locality }}</p>
                        <p><b class="fst-italic">City :</b> {{ $order->city }}</p>
                        <p><b class="fst-italic">Country :</b> {{ $order->country }}</p>
                        <p><b class="fst-italic">Land Mark :</b> {{ $order->landmark }}</p>
                        <p><b class="fst-italic">Zip :</b> {{ $order->zip }}</p>
                        <p><b class="fst-italic">State :</b> {{ $order->state }}</p>
                        <br>
                        <p><b class="fst-italic">Mobile :</b> {{ $order->phone }}</p>
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
                            <th>Total</th>
                            <td>${{ $transactions->order->total }}</td>
                            <th>Payment Mode</th>
                            <td>{{ $transactions->mode }}</td>
                            <th>Status</th>
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
            <div class="wg-box mt-5">
                <h5>Update order status</h5>
                <form action="{{ route('order.update.status') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_id" value="{{ $transactions->order->id }}" />
                    <div class="row">
                        <div class="col-md-3">
                            <div class="select">
                                <select id="order_status" name="order_status">
                                    <option value="ordered"
                                        {{ $transactions->order->status == 'ordered' ? 'selected' : '' }}>
                                        Ordered</option>
                                    <option value="delivered"
                                        {{ $transactions->order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                    </option>
                                    <option value="canceled"
                                        {{ $transactions->order->status == 'canceled' ? 'selected' : '' }}>
                                        Canceled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary tf-button w208">Update Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
