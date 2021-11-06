@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">


            <div class="page-inner">
                <div class="page-header">

                    <h4 class="page-title">Seller Detail</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="/">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('managesellers.index') }}">Seller</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-primary card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Products</p>
                                            <h4 class="card-title">{{ sizeof($all_product) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-info card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-interface-6"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Requests</p>
                                            <h4 class="card-title">{{ sizeof($all_request) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-success card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-analytics"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Quotations</p>
                                            <h4 class="card-title">{{ sizeof($all_quote) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-secondary card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Purchase Orders</p>
                                            <h4 class="card-title">{{ sizeof($all_purchase) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-with-nav">
                            <div class="card-header">
                                <div class="card-title">
                                    Profile Details
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Name</label>
                                            <span class="form-control">
                                                {{ $user_detail->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label>Email</label>
                                            <span class="form-control">
                                                {{ $user_detail->email }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Phone</label>
                                            <span class="form-control">
                                                {{ $user_detail->phone_number }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Country</label>
                                            <span class="form-control">
                                                {{ $user_detail->country_name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label>Currency</label>
                                            <span class="form-control">
                                                {{ $user_detail->currency_name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Company Address</label>
                                            <span class="form-control">
                                                {{ $user_detail->company_address }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>About Company</label>
                                            <span class="form-control">
                                                {{ $user_detail->company_about }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-profile">
                            @if (isset($user_detail->company_logo))
                                <div class="card-header"
                                    style="background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('uploads/') }}/{{ $user_detail->company_logo }}')">
                                @else
                                    <div class="card-header"
                                        style="background-image: url('{{ asset('uploads/No-image-available.png') }}')">
                            @endif

                            {{-- <div class="profile-picture">
                                    <div class="avatar avatar-xl">
                                        <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="user-profile text-center">
                                <div class="name">{{ $user_detail->company_name }}</div>
                                <div class="job">Since {!! htmlspecialchars_decode(date('F j Y', strtotime($user_detail->year_of_establishment))) !!}</div>
                                <div class="desc">MamboDubai Seller</div>
                                @if (!empty($user_detail->company_license))
                                    <div class="view-profile">
                                        <a href="{{ asset('uploads/company_license/') }}/{{ $user_detail->company_license }}"
                                            class="btn btn-secondary btn-block" download>Company License</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row user-stats text-center">
                                <div class="col">
                                    <div class="number">{{ sizeof($all_product) }}</div>
                                    <div class="title">Product</div>
                                </div>
                                <div class="col">
                                    <div class="number">{{ sizeof($all_quote) }}</div>
                                    <div class="title">Quotation</div>
                                </div>
                                <div class="col">
                                    <div class="number">{{ sizeof($all_purchase) }}</div>
                                    <div class="title">Order</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab-products" data-toggle="pill"
                                        href="#pills-home-products" role="tab" aria-controls="pills-home-products"
                                        aria-selected="true">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab-requests" data-toggle="pill"
                                        href="#pills-profile-requests" role="tab" aria-controls="pills-profile-requests"
                                        aria-selected="false">Requests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab-quotation" data-toggle="pill"
                                        href="#pills-contact-quotation" role="tab" aria-controls="pills-contact-quotation"
                                        aria-selected="false">Quotation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab-purchase" data-toggle="pill"
                                        href="#pills-contact-purchase" role="tab" aria-controls="pills-contact-purchase"
                                        aria-selected="false">Purchase Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab-completes" data-toggle="pill"
                                        href="#pills-contact-completes" role="tab" aria-controls="pills-contact-completes"
                                        aria-selected="false">Completes Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab-archived" data-toggle="pill"
                                        href="#pills-contact-archived" role="tab" aria-controls="pills-contact-archived"
                                        aria-selected="false">Archived</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-contact-tab-callback" data-toggle="pill"
                                        href="#pills-contact-callback" role="tab" aria-controls="pills-contact-callback"
                                        aria-selected="false">Request Callback</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                <div class="tab-pane fade show active" id="pills-home-products" role="tabpanel"
                                    aria-labelledby="pills-home-tab-products">
                                    <div class="card-title mb-3">
                                        List of Products
                                    </div>
                                    <div class="table-responsive">
                                        <table id="products-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">No</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_product as $product)

                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ str_limit($product->name, 30, '...') }}</td>
                                                        <td>{{ $product->getCategoryname($product->category_id) }}
                                                        </td>
                                                        <td>
                                                            <?php if (@$product->images->first()->url) { ?>
                                                            <img class="img-fluid" width="100"
                                                                src="{{ asset('uploads/') }}/{{ $product->images->first()->url }}"
                                                                alt="">
                                                            <?php } else {} ?>
                                                        </td>

                                                        @if ($product->status == 1 || $product->status == null)
                                                            <td>Pending</td>
                                                        @endif
                                                        @if ($product->status == 2)
                                                            <td>Approved</td>
                                                        @endif
                                                        @if ($product->status == 3)
                                                            <td>Deleted</td>
                                                        @endif

                                                        <td>{{ $product->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile-requests" role="tabpanel"
                                    aria-labelledby="pills-profile-tab-requests">
                                    <div class="card-title mb-3">
                                        List of Requests
                                    </div>
                                    <div class="table-responsive">
                                        <table id="requests-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">ID</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Currency</th>
                                                    <th>Request Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_request as $request)

                                                    <tr>
                                                        <td>{{ $request->id }}</td>
                                                        <td>{{ str_limit($request->product_name, 30, '...') }}</td>
                                                        <td>{{ $request->volume }}</td>
                                                        <td>{{ $request->unit_name }}</td>
                                                        <td>{{ $request->currency_name }}</td>
                                                        <td>{{ $request->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact-quotation" role="tabpanel"
                                    aria-labelledby="pills-contact-tab-quotation">
                                    <div class="card-title mb-3">
                                        List of Quote
                                    </div>
                                    <div class="table-responsive">
                                        <table id="quotation-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">ID</th>
                                                    <th>Buyer Company</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Total Price</th>
                                                    <th>Quote Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_quote as $quote)

                                                    <tr>
                                                        <td>{{ $quote->id }}</td>
                                                        <td>{{ $quote->buyer_name }}</td>
                                                        <td>{{ str_limit($quote->product_name, 30, '...') }}</td>
                                                        <td>{{ $quote->product_price }} {{ $quote->currency_name }}
                                                        </td>
                                                        <td>{{ $quote->total_price }} {{ $quote->currency_name }}</td>
                                                        <td>{{ $quote->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact-purchase" role="tabpanel"
                                    aria-labelledby="pills-contact-tab-purchase">
                                    <div class="card-title mb-3">
                                        List of Purchase Order
                                    </div>
                                    <div class="table-responsive">
                                        <table id="purchase-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">ID</th>
                                                    <th>Product Name</th>
                                                    <th>Delivery Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <th>Total Price</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_purchase as $purchase)
                                                    <?php
                                                    switch ($purchase->payment_status) {
                                                    case '0':
                                                    $payment_status = 'Disputed';
                                                    break;
                                                    case '1':
                                                    $payment_status = 'Pending';
                                                    break;
                                                    case '2':
                                                    $payment_status = 'Payment Released';
                                                    break;
                                                    case '3':
                                                    $payment_status = 'Paid';
                                                    break;
                                                    default:
                                                    break;
                                                    }
                                                    switch ($purchase->delivery_status) {
                                                    case '0':
                                                    $delivery_status = 'Disputed';
                                                    break;
                                                    case '1':
                                                    $delivery_status = 'Pending';
                                                    break;
                                                    case '2':
                                                    $delivery_status = 'Shipped';
                                                    break;
                                                    case '3':
                                                    $delivery_status = 'Delivered';
                                                    break;
                                                    default:
                                                    break;
                                                    }
                                                    if ($payment_status == 'Paid' && $delivery_status == 'Delivered') {
                                                    $order_status = 'Completed';
                                                    } else {
                                                    $order_status = 'Processed';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>{{ $purchase->id }}</td>
                                                        <td>{{ str_limit($purchase->product_name, 30, '...') }}</td>
                                                        <td>{{ $delivery_status }}</td>
                                                        <td>{{ $payment_status }}</td>
                                                        <td>{{ $order_status }}</td>
                                                        <td>{{ $purchase->total_price }}
                                                            {{ $purchase->currency_name }}
                                                        </td>
                                                        <td>{{ $purchase->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact-completes" role="tabpanel"
                                    aria-labelledby="pills-contact-tab-completes">
                                    <div class="card-title mb-3">
                                        List of Complete Order
                                    </div>
                                    <div class="table-responsive">
                                        <table id="completes-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">ID</th>
                                                    <th>Buyer Company</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Total Price</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_complete as $complete)

                                                    <tr>
                                                        <td>{{ $complete->id }}</td>
                                                        <td>{{ $complete->buyer_name }}</td>
                                                        <td>{{ str_limit($complete->product_name, 30, '...') }}</td>
                                                        <td>{{ $complete->product_price }}
                                                            {{ $complete->currency_name }}</td>
                                                        <td>{{ $complete->total_price }}
                                                            {{ $complete->currency_name }}
                                                        </td>
                                                        <td>{{ $complete->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact-archived" role="tabpanel"
                                    aria-labelledby="pills-contact-tab-archived">
                                    <div class="card-title mb-3">
                                        List of Archived
                                    </div>
                                    <div class="table-responsive">
                                        <table id="archived-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">ID</th>
                                                    <th>Product Name</th>
                                                    <th>Product Price</th>
                                                    <th>Total Price</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_archived as $archived)

                                                    <tr>
                                                        <td>{{ $archived->id }}</td>
                                                        <td>{{ str_limit($archived->product_name, 30, '...') }}</td>
                                                        <td>{{ $archived->product_price }}
                                                            {{ $archived->currency_name }}</td>
                                                        <td>{{ $archived->total_price }}
                                                            {{ $archived->currency_name }}
                                                        </td>
                                                        <td>{{ $archived->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact-callback" role="tabpanel"
                                    aria-labelledby="pills-contact-tab-callback">
                                    <div class="card-title mb-3">
                                        List of Request Callback
                                    </div>
                                    <div class="table-responsive">
                                        <table id="callback-datatables" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th width="50px">ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Product Name</th>
                                                    <th>Message</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($all_callback as $callback)

                                                    <tr>
                                                        <td>{{ $callback->id }}</td>
                                                        <td>{{ $callback->name }}</td>
                                                        <td>{{ $callback->email_add }}</td>
                                                        <td>{{ $callback->mobile }}</td>
                                                        <td>{{ str_limit($callback->product_name, 30, '...') }}</td>
                                                        <td>{{ $callback->message }}</td>
                                                        <td>{{ $callback->sign_date }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
