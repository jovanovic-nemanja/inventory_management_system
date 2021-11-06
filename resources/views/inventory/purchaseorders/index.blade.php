@extends('layouts.admin')

@section('content')



    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Purchase Order</h4>
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
                            <a href="#">Purchase Order </a>
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
                                                <th>Delivery Status</th>
                                                <th>Payment Status</th>
                                                <th>Order Status</th>
                                                <th>Product Name</th>
                                                <th>Total Price</th>
                                                @if ($user_status == 0)
                                                    <th>Actions</th>
                                                @endif

                                                @if ($user_status == 1)
                                                @endif
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($quotes as $quote)

                                                <?php
                                                $date = date_create($quote->sign_date);
                                                $dt = date_format($date, 'Y-m-d');

                                                if ($quote->available == 0) {
                                                $str = 'Available';
                                                $total_price = $quote->total_price;
                                                } else {
                                                $str = 'Not Available';
                                                $total_price = $quote->total_price;
                                                }

                                                switch ($quote->payment_status) {
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
                                                switch ($quote->delivery_status) {
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

                                                <tr>
                                                    <td>{{ $quote->request_id }}</td>
                                                    <td style="vertical-align: middle;">{{ $dt }}</td>
                                                    <td>{{ $quote->sellerDetail($quote->seller) }}</td>
                                                    <td>{{ $quote->buyer_company_name }}</td>
                                                    <td style="vertical-align: middle;">{{ $delivery_status }}</td>
                                                    <td style="vertical-align: middle;">{{ $status }}</td>
                                                    @if ($quote->buyer_delivery_status == 3 && $quote->buyer_payment_status == 3)
                                                        <td style="vertical-align: middle;">Completed</td>
                                                    @else
                                                        <td style="vertical-align: middle;">Proccessed</td>
                                                    @endif

                                                    <td style="vertical-align: middle;">{{ $quote->product_name }}</td>
                                                    <td style="vertical-align: middle;">
                                                        {{ number_format(round($total_price, 3, PHP_ROUND_HALF_UP), 2) }}{{ $quote->currency_name }}
                                                    </td>

                                                    @if ($user_status == 0)
                                                        <td style="white-space: nowrap">
                                                            <a href="{{ route('purchaseorder.details', $quote->purchase_orders_id) }}"
                                                                class="btn btn-success btn-sm btn-flat" title="Detail">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    @endif
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
