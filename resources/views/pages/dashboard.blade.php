@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Total Orders</div>
                                        <h4>{{ $dashOrderData[0]->Total }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Total Amount</div>
                                        <h4>{{ $dashOrderData[0]->TotalAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders</div>
                                        <h4>{{ $dashOrderData[0]->TotalOrdered }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Pending Orders Amount</div>
                                        <h4>{{ $dashOrderData[0]->TotalOrderedAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders</div>
                                        <h4>{{ $dashOrderData[0]->TotalDelivered }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Delivered Orders Amount</div>
                                        <h4>{{ $dashOrderData[0]->TotalDeliveredAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders</div>
                                        <h4>{{ $dashOrderData[0]->TotalCanceled }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Canceled Orders Amount</div>
                                        <h4>{{ $dashOrderData[0]->TotalCanceledAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="wg-box2 justify-content-center px-6">
                    <div class="row text-center mb-4"> <!-- Add margin-bottom to the row -->
                        <div class="col-12 col-md-4 mb-4">
                            <a href="{{ route('add.product') }}"
                                class="d-flex flex-column justify-content-center align-items-center hover-bg-primary-light box-padding">
                                <dotlottie-player
                                    src="https://lottie.host/0ee41426-9e25-4de6-b44f-f73315753c0e/mEANrrBRsj.json"
                                    background="transparent" speed="1" style="width: 120px; height: 120px"
                                    direction="1" playMode="normal" loop autoplay>
                                </dotlottie-player>
                                <h6>Add Product</h6>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                            <a href="{{ route('add.category') }}"
                                class="d-flex flex-column justify-content-center align-items-center hover-bg-primary-light box-padding">
                                <dotlottie-player
                                    src="https://lottie.host/fbd757a3-6b04-4bb8-9b86-2442d23a9dff/lCDk41zjBP.json"
                                    background="transparent" speed="1" style="width: 120px; height: 120px"
                                    direction="1" playMode="normal" loop autoplay>
                                </dotlottie-player>
                                <h6>Add Category</h6>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                            <a href="{{ route('add.brand') }}"
                                class="d-flex flex-column justify-content-center align-items-center hover-bg-primary-light box-padding">
                                <dotlottie-player
                                    src="https://lottie.host/c61b44f2-579c-4354-8fec-76962eae18b2/mILcZSGzwL.json"
                                    background="transparent" speed="1" style="width: 120px; height: 120px"
                                    direction="1" playMode="normal" loop autoplay>
                                </dotlottie-player>
                                <h6>Add Brand</h6>
                            </a>
                        </div>
                    </div>
                    <div class="row text-center"> <!-- This row will inherit the mb-4 from above -->
                        <div class="col-12 col-md-4 mb-4">
                            <a href="{{ route('add.color') }}"
                                class="d-flex flex-column justify-content-center align-items-center hover-bg-primary-light box-padding">
                                <dotlottie-player
                                    src="https://lottie.host/27bf1ce6-d40d-4ef8-87e5-ac860882a19a/qMzOhlDf4K.json"
                                    background="transparent" speed="1" style="width: 120px; height: 120px"
                                    direction="1" playMode="normal" loop autoplay>
                                </dotlottie-player>
                                <h6>Add Color</h6>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                            <a href="{{ route('add.size') }}"
                                class="d-flex flex-column justify-content-center align-items-center hover-bg-primary-light box-padding">
                                <dotlottie-player
                                    src="https://lottie.host/ae0ba3ca-f207-4393-8e9d-9ada598b56bb/kOxLVGTQNl.json"
                                    background="transparent" speed="1" style="width: 120px; height: 120px"
                                    direction="1" playMode="normal" loop autoplay>
                                </dotlottie-player>
                                <h6>Add Size</h6>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                            <a href="{{ route('add.coupons') }}"
                                class="d-flex flex-column justify-content-center align-items-center hover-bg-primary-light box-padding">
                                <dotlottie-player
                                    src="https://lottie.host/8cb6281c-36f3-4970-89eb-6be7ff552517/1PWr6gAzYX.json"
                                    background="transparent" speed="1" style="width: 120px; height: 120px"
                                    direction="1" playMode="normal" loop autoplay>
                                </dotlottie-player>
                                <h6>Add Coupon</h6>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="tf-section mb-30">

            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Recent orders</h5>
                    <div class="dropdown default">
                        <a class="btn btn-secondary dropdown-toggle" href="#">
                            <span class="view-all">View all</span>
                        </a>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
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
                                    <th class="text-center">Total Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $orders)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center">{{ $orders->name }}</td>
                                        <td class="text-center">{{ $orders->phone }}</td>
                                        <td class="text-center">${{ $orders->subtotal }}</td>
                                        <td class="text-center">${{ $orders->tax }}</td>
                                        <td class="text-center">${{ $orders->total }}</td>

                                        <td class="text-center">
                                            @if ($orders->status == 'ordered')
                                                <span class="badge bg-warning">ordered</span>
                                            @elseif($orders->status == 'delivered')
                                                <span class="badge bg-success">delivered</span>
                                            @else
                                                <span class="badge bg-danger">canceled</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $orders->created_at }}</td>
                                        <td class="text-center">{{ $orders->orderItems->count() }}</td>
                                        <td>{{ $orders->delivered_date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('order.details', ['order_id' => $orders->id]) }}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
