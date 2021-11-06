@extends('layouts.appseller')

@section('content')

    <!-- Map and From Area -->

    <div class="col-md-9">
        <?php echo displayAlert(); ?>
        <div class="datatablestructure">
            <h3>{{ $page }}</h3><br />
            @if ($user_status == 1)
                <p style="color: red;">Your account was blocked by admin!</p>
            @endif
            <br>
            <table id="example" class="table dt-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Purchase Date</th>
                        @auth
                            @if (auth()->user()->hasRole('buyer'))
                                <th>Seller Name</th>
                            @endif
                        @endauth
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
                        @auth
                            @if (auth()->user()->hasRole('seller'))
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
                            @endif

                            @if (auth()->user()->hasRole('buyer'))
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
                                switch ($quote->buyer_payment_status) {
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

                                switch ($quote->buyer_delivery_status) {
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
                            @endif
                        @endauth
                        <tr>
                            <td>{{ $quote->request_id }}</td>
                            <td style="vertical-align: middle;">{{ $dt }}</td>

                            @if (auth()->user()->hasRole('seller'))
                            @elseif(auth()->user()->hasRole('buyer'))
                                <td style="vertical-align: middle;"><a
                                        href="{{ url('/purchaseorders/userreview', $quote->sender) }}"
                                        id="{{ $quote->sender }}">{{ $quote->username }}</a></td>
                            @endif

                            <td style="vertical-align: middle;">{{ $delivery_status }}</td>
                            <td style="vertical-align: middle;">{{ $status }}</td>
                            @if ($quote->buyer_delivery_status == 3 && $quote->buyer_payment_status == 3)
                                <td style="vertical-align: middle;">Completed</td>
                            @else
                                <td style="vertical-align: middle;">Proccessed</td>
                            @endif
                            <td style="vertical-align: middle;">{{ $quote->product_name }}</td>
                            <td style="vertical-align: middle;">
                                <?= number_format(round($total_price, 3, PHP_ROUND_HALF_UP), 2) ?> {{ $quote->currency_name }} </td>

                                    @if ($user_status == 0)
                                    <td style="white-space: nowrap">

                                        <a class="btn btn-success" href="{{ url('/purchaseorders/deliverychange', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Delivery</a>

                                        <a class="btn btn-success" href="{{ url('/purchaseorders/paymentchange', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Payment</a>
                                         @if (auth()->user()->hasRole('seller'))
                                        @if ($quote->delivery_status == 3 && $quote->payment_status == 3)
                                        <a class="btn btn-success" href="{{ url('/purchaseorders/addreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Add Review</a>
                                        @endif
                                        @endif
                                         @if (auth()->user()->hasRole('buyer'))
                                        @if ($quote->buyer_delivery_status == 3 && $quote->buyer_payment_status == 3)
                                        <a class="btn btn-success" href="{{ url('/purchaseorders/addreview', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Add Review</a>
                                        @endif
                                        @endif
                                        <a class="btn btn-primary" href="{{ url('/purchaseorders/comments', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Message</a>
                                        <a class="btn btn-success" target="_blank" href="{{ url('/purchaseorders/downloadpdf', $quote->p_id) }}" id="{{ $quote->p_id }}" style="color: #fff;">Download</a>
                                    </td>
                                    @endif

                                    @if ($user_status == 1)
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- End Map and From Area -->
@stop
