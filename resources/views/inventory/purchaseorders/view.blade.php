@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">

                    <h4 class="page-title">Purchase Order Detail</h4>
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
                            <a href="{{ route('purchaseorder.index') }}">Purchase Order</a>
                        </li>
                    </ul>
                </div>


                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-invoice">
                            <div class="card-header">
                                <div class="invoice-header">
                                    <h3 class="invoice-title">
                                        Overview
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="separator-solid"></div>
                                <div class="row">
                                    <div class="col-md-6 info-invoice">
                                        <h5 class="sub">Seller Information</h5>
                                        <div class="invoice-logo">
                                            @if (!empty($seller_detail->company_logo))
                                                <img width="100"
                                                    src="{{ asset('uploads/') }}/{{ $seller_detail->company_logo }}"
                                                    alt="company logo">
                                            @else
                                                <img width="100" src="{{ asset('uploads/No-image-available.png') }}"
                                                    alt="company logo">
                                            @endif
                                        </div>
                                        <p>
                                            {{ $seller_detail->company_name }},
                                            {{ $seller_detail->company_address }}
                                            <br>
                                            {!! htmlspecialchars_decode(date('F j Y', strtotime($seller_detail->year_of_establishment))) !!}
                                        </p>
                                    </div>
                                    <div class="col-md-6 info-invoice">
                                        <h5 class="sub">Buyer Information</h5>
                                        <div class="invoice-logo">

                                            @if (!empty($buyer_detail->company_logo))
                                                <img width="100"
                                                    src="{{ asset('uploads/') }}/{{ $buyer_detail->company_logo }}"
                                                    alt="company logo">
                                            @else
                                                <img width="100" src="{{ asset('uploads/No-image-available.png') }}"
                                                    alt="company logo">
                                            @endif
                                        </div>
                                        <p>
                                            @if (!empty($buyer_detail->company_name))
                                                {{ $buyer_detail->company_name }}
                                            @endif

                                            @if (!empty($buyer_detail->company_address))

                                                , {{ $buyer_detail->company_address }}
                                            @endif
                                            @if (!empty($buyer_detail->year_of_establishment))
                                                <br>
                                                {!! htmlspecialchars_decode(date('F j Y', strtotime($buyer_detail->year_of_establishment))) !!}
                                            @endif
                                        </p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="invoice-detail">
                                            <div class="invoice-top">
                                                <h3 class="title"><strong>Order summary (PO{{ $records->id }})</strong>
                                                </h3>
                                            </div>
                                            <div class="invoice-item">
                                                <div class="table-responsive">
                                                    <table class="table table-typo">
                                                        <thead>
                                                            <tr>
                                                                <td><strong>Particulars</strong></td>
                                                                <td class="text-center"><strong>Detail</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Product Name</td>
                                                                <td class="text-center">
                                                                    <a target="_blank"
                                                                        href=" {{ route('product.show', $records->product_slug) }}">
                                                                        {{ $records->product_name }}
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Product Unit</td>
                                                                <td class="text-center">{{ $records->unitname }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Product Quantity</td>
                                                                <td class="text-center">{{ $records->volume }}
                                                                    {{ $records->unitname }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Product Unit Price</td>
                                                                <td class="text-center">{{ $records->product_price }}
                                                                    {{ $records->currency_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td class="text-center">
                                                                    {{ $records->volume * $records->product_price }}
                                                                    {{ $records->currency_name }}</td>
                                                            </tr>
                                                            @if ($records->vat > 0)
                                                                <tr>
                                                                    <td>VAT</td>
                                                                    <td class="text-center">{{ $records->vat }}
                                                                        {{ $records->currency_name }}</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td><strong>Total</strong></td>
                                                                <td class="text-center">
                                                                    <strong>{{ $records->total_price }}
                                                                        {{ $records->currency_name }}</strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Request Posted On</td>
                                                                <td class="text-center">{{ $records->request_date }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Quotation Submitted On</td>
                                                                <td class="text-center">{{ $records->sign_date }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator-solid  mb-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    switch ($records->payment_status) {
                    case '0':
                    $status = 'Disputed';
                    break;
                    case '1':
                    $status = 'Pending';
                    break;
                    case '2':
                    $status = 'Payment Released';
                    break;
                    case '3':
                    $status = 'Paid';
                    break;
                    default:
                    break;
                    }
                    switch ($records->delivery_status) {
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
                    ?>
                    <div class="col-sm-4 col-lg-4">
                        <div class="card">
                            <div class="p-2">
                                <img class="card-img-top rounded"
                                    src="{{ asset('uploads/') }}/{{ $records->product_image_url }}" alt="Product 1">
                            </div>
                            <div class="card-body pt-2">
                                <h4 class="mb-1 fw-bold">{{ $records->product_name }}</h4>
                                @if ($records->price_show == 1)
                                    @if ($records->price_fixed == 1)
                                        <p class="text-muted small mb-2"> {{ $records->price_to }}
                                            {{ $records->currency_name }}</p>
                                    @else
                                        <p class="text-muted small mb-2">
                                            {{ $records->price_from }}
                                            {{ $records->currency_name }}
                                            ~{{ $records->price_to }}
                                            {{ $records->currency_name }}</p>
                                    @endif
                                @else
                                    <span class="priceprtTxt">
                                        Ask For Price

                                    </span>
                                @endif

                                <p class="text-muted small mb-2">{{ $records->MOQ }} {{ $records->unitname }} min
                                    order</p>
                                <div class="view-profile">
                                    <a href="{{ route('product.show', $records->product_slug) }}" target="_blank"
                                        class="btn btn-secondary btn-block">View Product</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-home-tab-products" data-toggle="pill"
                                            href="#pills-home-delivery" role="tab" aria-controls="pills-home-delivery"
                                            aria-selected="true">Delivery</a>

                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-payment" data-toggle="pill"
                                            href="#pills-profile-payment" role="tab" aria-controls="pills-profile-payment"
                                            aria-selected="false">Payment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-messages" data-toggle="pill"
                                            href="#pills-profile-messages" role="tab" aria-controls="pills-profile-messages"
                                            aria-selected="false">Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-profile-tab-review" data-toggle="pill"
                                            href="#pills-profile-review" role="tab" aria-controls="pills-profile-review"
                                            aria-selected="false">Review</a>
                                    </li>


                                </ul>
                                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home-delivery" role="tabpanel"
                                        aria-labelledby="pills-home-tab-delivery">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Delivery Status</td>
                                                        <td>{{ $delivery_status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Delivery Document</td>
                                                        @if (!empty($records->delivery_document))
                                                            <td>
                                                                <a
                                                                    href="{{ asset('uploads/delivery_document/') }}/{{ $records->delivery_document }}"><i
                                                                        class="fa fa-download" aria-hidden="true"></i></a>
                                                            </td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif

                                                    </tr>
                                                </tbody>
                                            </table>
                                            @if (!empty($records->delivery_information))
                                                <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                                                    Delivery Information
                                                    <p class="text-muted mb-0">
                                                        {{ $records->delivery_information }}
                                                    </p>
                                                </h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-payment" role="tabpanel"
                                        aria-labelledby="pills-profile-tab-payment">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Payment Status</strong></td>
                                                        <td>{{ $status }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Payment Document</strong></td>
                                                        @if (!empty($records->payment_document))
                                                            <td><a
                                                                    href="{{ asset('uploads/payment_document/') }}/{{ $records->payment_document }}"><i
                                                                        class="fa fa-download" aria-hidden="true"></i></a>
                                                            </td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @if (!empty($records->buyer_payment_information))
                                                <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                                                    Payment Information
                                                    <p class="text-muted mb-0">
                                                        {{ $records->buyer_payment_information }}
                                                    </p>
                                                </h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-messages" role="tabpanel"
                                        aria-labelledby="pills-home-tab-messages">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <tbody>
                                                    @if (sizeof($comments) > 0)
                                                        @foreach ($comments as $comment)

                                                            <div class="media-body">
                                                                <i class="fa fa-user"></i>
                                                                {{ $comment->getUsername($comment->writer) }}
                                                                ({{ $comment->sign_date }})
                                                                <p class="mb-0 text-muted">
                                                                    {{ nl2br($comment->description) }}
                                                                </p>
                                                            </div>


                                                        @endforeach
                                                    @else
                                                        <p>There is no conversation yet.</p>
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile-review" role="tabpanel"
                                        aria-labelledby="pills-home-tab-review">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <tbody>
                                                    @if (isset($buyer_review->mark) || isset($seller_review->mark))



                                                        <div class="col-md-12">
                                                            @if (!empty($buyer_review->mark))
                                                                <div class="form-group">
                                                                    @csrf
                                                                    <h3>Buyer review</h3><br>
                                                                    <label>Rating</label>
                                                                    <?php if (round($buyer_review->mark) ==
                                                                    0) { ?>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($buyer_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($buyer_review->mark) == 1) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($buyer_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($buyer_review->mark) == 2) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($buyer_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($buyer_review->mark) == 3) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($buyer_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($buyer_review->mark) == 4) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($buyer_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($buyer_review->mark) == 5) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span> ( <?php echo number_format($buyer_review->mark,
                                                                    1); ?> )
                                                                    <?php } ?>
                                                                </div>
                                                            @endif
                                                            @if (!empty($buyer_review->description))
                                                                <div class="form-group">
                                                                    <label>Remarks</label>

                                                                    {{-- <textarea rows="6" class="form-control description" name="description" id="description" disabled>{{ $record->description }}</textarea> --}}
                                                                    <p>{{ $buyer_review->description }}</p>
                                                                </div>
                                                            @endif
                                                        </div>


                                                        <hr>

                                                        <div class="col-md-12">
                                                            @if (!empty($seller_review->mark))
                                                                <div class="form-group">
                                                                    @csrf
                                                                    <h3>Seller review</h3><br>
                                                                    <label>Rating</label>
                                                                    <?php if (@$seller_review) {
                                                                    if (round($seller_review->mark) == 0) { ?>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($seller_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($seller_review->mark) == 1) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($seller_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($seller_review->mark) == 2) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($seller_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($seller_review->mark) == 3) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($seller_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($seller_review->mark) == 4) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star"></span> ( <?php
                                                                    echo number_format($seller_review->mark, 1); ?> )
                                                                    <?php } elseif
                                                                    (round($seller_review->mark) == 5) { ?>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span> ( <?php echo
                                                                    number_format($seller_review->mark, 1); ?>
                                                                    )
                                                                    <?php }
                                                                    } ?>
                                                                </div>
                                                            @endif
                                                            @if (!empty($seller_review->description))
                                                                <div class="form-group">
                                                                    <label>Remarks</label>
                                                                    <p>{{ $seller_review->description }}</p>
                                                                    {{-- <textarea rows="6" class="form-control description" name="description" id="description" disabled>{{ $receiver_record->description }}</textarea> --}}

                                                                </div>
                                                            @endif

                                                        </div>
                                                    @else
                                                        <p>There is no review yet</p>
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-invoice">
                            <div class="card-header">
                                <div class="invoice-header">
                                    <h3 class="invoice-title">
                                        Invoice
                                    </h3>
                                    <button id="makePdf" class="btn btn-success mb-3 pull-right">
                                        <span class="btn-label">
                                            <i class="fa fa-download"></i>
                                        </span>
                                        PDF
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="separator-solid"></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row" id="sideview5">

                                            <div class="" style="width: 100%;">
                                                <div class="aHl"></div>
                                                <div id=":1c0" tabindex="-1"></div>
                                                <div id=":1cb" class="ii gt">
                                                    <div id=":1cc" class="a3s aiL ">
                                                        <u></u>
                                                        <div
                                                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000000; margin:30px;">
                                                            <div>
                                                                <table
                                                                    style="border-collapse:collapse;width:44%;margin-bottom:20px; margin-right: 12%; float: left;">
                                                                    <thead>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td
                                                                                style="font-size:12px;text-align:left;padding:7px">
                                                                                @if ($seller_detail->company_logo != '')
                                                                                    <img style="width: 200px;"
                                                                                        src="{{ asset('uploads/') }}/{{ $seller_detail->company_logo }}">
                                                                                @else
                                                                                    <img style="width: 200px;"
                                                                                        src="{{ asset('uploads/') }}/No-image-available.png">
                                                                                @endif
                                                                            </td>

                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <table
                                                                    style="border-collapse:collapse;width:44%;margin-bottom:20px">
                                                                    <thead>
                                                                        <tr>

                                                                            <td
                                                                                style="font-size:29px;font-weight:bold;text-align:left;padding:7px;color:#d9534f">
                                                                                PURCHASE ORDER</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>

                                                                            <td
                                                                                style="font-size:12px;text-align:left;padding:7px">
                                                                                Date : {{ $records->created_at }} <br>
                                                                                Purchase Order:
                                                                                PO{{ $records->request_id }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>


                                                                <br><br><br>




                                                                <table
                                                                    style="border-collapse:collapse;width:44%;border-top:1px solid #264b72;margin-bottom:20px; margin-right: 12%; float: left;">
                                                                    <thead>
                                                                        <tr>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                                                                Vendor</td>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td
                                                                                style="font-size:12px;text-align:left;padding:7px">
                                                                                {{ $seller_detail->company_name }}<br>
                                                                                {{ $seller_detail->company_address }}<br>
                                                                                {{ $seller_detail->sellercountry }}<br>
                                                                                {{ $seller_detail->phone_number }}<br>

                                                                            </td>

                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <table
                                                                    style="border-collapse:collapse;width:44%;border-top:1px solid #264b72;margin-bottom:20px">
                                                                    <thead>
                                                                        <tr>

                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                                                                Ship To
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>

                                                                            <td
                                                                                style="font-size:12px;text-align:left;padding:7px">
                                                                                {{ $buyer_detail->name }}<br>
                                                                                {{ $buyer_detail->company_name }}<br>
                                                                                {{ $buyer_detail->company_address }}<br>
                                                                                {{ $buyer_detail->sellercountry }}<br>
                                                                                {{ $buyer_detail->phone_number }}<br>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>


                                                                <table
                                                                    style="border-collapse:collapse;width:100%;border-top:1px solid #264b72;border-left:1px solid #264b72;margin-bottom:20px">
                                                                    <thead>
                                                                        <tr>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                                                                ITEM</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                                                                DESCRIPTION</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:right;padding:7px;color:#FFFF">
                                                                                QTY</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:right;padding:7px;color:#FFFF">
                                                                                UNIT PRICE</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:right;padding:7px;color:#FFFF">
                                                                                TOTAL</td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        <tr>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:left;padding:7px">
                                                                                1
                                                                            </td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:left;padding:7px">
                                                                                {{ $records->product_name }}</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                                                {{ $records->volume }}
                                                                                {{ $records->unitname }}</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                                                {{ number_format($records->product_price, 2, '.', ',') }}
                                                                                {{ $records->currency_name }}</td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                                                {{ number_format($records->product_price * $records->volume, 2, '.', ',') }}
                                                                                {{ $records->currency_name }}</td>
                                                                        </tr>
                                                                    </tbody>

                                                                    <tfoot>

                                                                        <tr>
                                                                            <td style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                                                                colspan="4"><b>SUBTOTAL:</b></td>
                                                                            <td
                                                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                                                {{ number_format($records->product_price * $records->volume, 2, '.', ',') }}
                                                                                {{ $records->currency_name }}</td>
                                                                        </tr>
                                                                        @if ($records->vat > 0)
                                                                            <tr>
                                                                                <td style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                                                                    colspan="4"><b>VAT:</b></td>
                                                                                <td
                                                                                    style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                                                    {{ number_format($records->vat, 2, '.', ',') }}
                                                                                    {{ $records->currency_name }}</td>
                                                                            </tr>
                                                                        @endif
                                                                        <tr>
                                                                            <td style="font-size:16px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                                                                colspan="4"><b>TOTAL:</b></td>
                                                                            <td
                                                                                style="font-size:16px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;">
                                                                                {{ number_format($records->total_price, 2, '.', ',') }}
                                                                                {{ $records->currency_name }}</td>
                                                                        </tr>
                                                                    </tfoot>

                                                                </table>

                                                                <p
                                                                    style="margin-top:0px;margin-bottom:0px; text-align:center">
                                                                    Powered by <img width="90" height="40"
                                                                        src="{{ asset('newdesign/images/logo.png') }}">
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator-solid  mb-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <input type="hidden" value="{{ $records->request_id }}" id="PO_order" />


        </div>
    </div>

@endsection
