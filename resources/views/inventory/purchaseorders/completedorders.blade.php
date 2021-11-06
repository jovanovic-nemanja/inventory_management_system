@extends('layouts.admin')

@section('content')



    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Completed Order</h4>
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
                            <a href="#">Completed Order </a>
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
                                                <th>Purchase Date</th>
                                                <th>Seller Name</th>
                                                <th>Buyer Name</th>
                                                <th>Total Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($quotes as $quote)

                                                <?php
                                                $date = date_create($quote->purchase_date);
                                                $dt = date_format($date, 'Y-m-d');

                                                if ($quote->available == 0) {
                                                $str = 'Available';
                                                $total_price = $quote->total_price;
                                                } else {
                                                $str = 'Not Available';
                                                $total_price = $quote->total_price;
                                                }
                                                ?>

                                                <tr>
                                                    <td>{{ $quote->request_id }}</td>
                                                    <td style="vertical-align: middle;">{{ $dt }}</td>
                                                    <td>{{ $quote->sellerDetail($quote->seller) }}</td>
                                                    <td>{{ $quote->buyer_company_name }}</td>
                                                    <td style="vertical-align: middle;">
                                                        {{ number_format(round($total_price, 3, PHP_ROUND_HALF_UP), 2) }}{{ $quote->currency_name }}
                                                    </td>
                                                    <td style="white-space: nowrap">
                                                        <a href="{{ route('completedorders.details', $quote->purchase_orders_id) }}"
                                                            class="btn btn-success btn-sm btn-flat" title="Detail">
                                                            <i class="fa fa-eye"></i>
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
            </div>
        </div>
    </div>

    </div>
@stop
