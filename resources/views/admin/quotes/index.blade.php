@extends('layouts.admin')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Quote</h4>
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
                        <a href="#">Quote </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="products-datatables" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Date</th>
                                            <th>Product Name</th>
                                            <th>Buyer Company</th>
                                            <th>Seller Company</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @foreach ($quotes as $quote)
                                    @php
                                    switch ($quote->status) {
                                    case '1':
                                    $status = 'Pending';
                                    break;
                                    case '2':
                                    $status = 'Accepted';
                                    break;
                                    case '3':
                                    $status = 'Archived';
                                    break;
                                    case '4':
                                    $status = 'Deleted';
                                    break;

                                    default:
                                    break;
                                    }
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ $quote->id }}
                                        </td>

                                        <td>
                                            {{ $quote->created_at }}
                                        </td>

                                        <td>
                                            {{ $quote->product_name }}
                                        </td>
                                        <td>
                                            {{ $quote->buyer_company_name }}
                                        </td>
                                        <td>
                                            {{ $quote->sellerDetail($quote->seller) }}
                                        </td>
                                        <td>
                                            {{ $quote->total_price }} {{ $quote->currency_name }}
                                        </td>
                                        <td>
                                            {{ $status }}
                                        </td>
                                        <td>
                                            <a href="{{ route('quotes.view', $quote->id) }}"
                                                class="btn btn-success btn-sm btn-flat" title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach
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
@stop