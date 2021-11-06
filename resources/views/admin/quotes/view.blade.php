@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">

                    <h4 class="page-title">Quotation Detail</h4>
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
                            <a href="{{ route('quotes.index') }}">Quotations</a>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="invoice-detail">
                                            <div class="invoice-top">
                                                <h3 class="title"><strong>Quotation
                                                        summary(QN{{ $records->requests_id }})</strong></h3>
                                            </div>
                                            <div class="invoice-item">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
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
                                                                        {{ $records->currency_name }}</strong></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
