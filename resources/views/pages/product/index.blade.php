@extends('layouts.layout')
@section('dashboardContent')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>All Products</h3>
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
                        <div class="text-tiny">All Products</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('add.product') }}"><i class="icon-plus"></i>Add new</a>
                </div>

                <div class="table-responsive">
                    <form action="{{ route('products.deleteSelected') }}" method="POST" id="deleteOrdersForm">
                        @csrf
                        @method('DELETE')
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px">
                                    <input type="checkbox" id="select_all_ids" class="checkbox_ids_header">
                                </th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>SalePrice</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Stock</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProducts as $Product)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $Product->id }}"
                                            class="checkbox_ids">
                                    </td>
                                    <td>#{{ $Product->id }}</td>
                                    <td class="pname pb-4 pt-4">
                                        <div class="name">
                                            <div class="body-title-2 pb-4 pt-4">{{ $Product->name }}</div>
                                        </div>
                                    </td>

                                    <td>{{ $Product->regular_price }}</td>
                                    <td>{{ $Product->sale_price }}</td>

                                    <td>
                                        @foreach ($Product->color as $color)
                                            {{ $color->name . ', ' }}
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach ($Product->size as $size)
                                            {{ $size->name . ', ' }}
                                        @endforeach
                                    </td>

                                    <td>{{ $Product->SKU }}</td>
                                    <td>{{ $Product->category ? $Product->category->name : 'No Category' }}</td>
                                    <td>{{ $Product->brand->name }}</td>
                                    <td>{{ $Product->stock_status }}</td>
                                    <td>{{ $Product->quantity }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('edit.product', $Product->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <a href="{{ route('product.delete', $Product->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this item?')"
                                                id="delete" class="item text-danger delete"><i class="icon-trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $allProducts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
