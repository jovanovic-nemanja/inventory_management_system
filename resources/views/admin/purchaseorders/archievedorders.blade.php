@extends('layouts.admin')

@section('content')

    @if (session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
    @endif
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Archived Order</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>

                        <li class="nav-item">
                            <a href="#">Archived Order</a>
                        </li>
                    </ul>
                </div>
                <table id="archived-datatables" class="table dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Purchase Date</th>
                            <th>Buyer Company</th>
                            <th>Seller Company</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($quotes as $quote)
                            <?php
                            $date = date_create($quote->sign_date);
                            $dt = date_format($date, 'Y-m-d');
                            ?>
                            <tr>
                                <td style="vertical-align: middle;">{{ $dt }}</td>
                                <td>{{ $quote->buyer }}</td>
                                <td>{{ $quote->sellerDetail($quote->receiver) }}</td>
                                <td style="vertical-align: middle;">{{ $quote->product_name }}</td>
                                <td style="vertical-align: middle;">{{ $quote->product_price }}
                                    {{ $quote->currency_name }}</td>
                                <td style="vertical-align: middle;">{{ $quote->total_price }}
                                    {{ $quote->currency_name }}
                                </td>
                                <td>
                                    <a href="{{ route('archievedorders.view', $quote->id) }}"
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

    <!-- End Map and From Area -->
@stop
