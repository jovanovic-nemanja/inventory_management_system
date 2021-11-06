@extends('layouts.appseller')

@section('content')

    <!-- Map and From Area -->
    <div class="col-md-9">
        <?php echo displayAlert(); ?>
        <div class="datatablestructure">
            @if (auth()->user()->hasRole('buyer'))
                <h3>My Received Quotes</h3><br />
                @if ($user_status == 1)
                    <p style="color: red;">Your account was blocked by admin!</p>
                @endif
                <br>

                <table id="example" class="table dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Received Date</th>
                            <th>Seller Company</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            @if ($user_status == 0)
                                <th>Actions</th>
                            @endif

                            @if ($user_status == 1)
                            @endif
                        </tr>
                    </thead>

                    @foreach ($total as $quote)
                        <?php
                        $date = date_create($quote[0]->sign_date);
                        $dt = date_format($date, 'Y-m-d');
                        ?>
                        @foreach ($quote as $qu)
                            <?php switch ($quote[0]->status) {
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
                            } ?>
                            <tbody>
                                <tr>
                                    <td>{{ $qu->request_id }}</td>
                                    <td>{{ $dt }}</td>
                                    <td>
                                        <a target="_blank"
                                            href="{{ route('home.sellerdetail', Crypt::encrypt($qu->company_id)) }}">{{ $qu->company_name }}</a>
                                    </td>
                                    <td>{{ $qu->product_name }}</td>

                                    <td>
                                        {{ number_format(round($qu->product_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                        {{ $qu->currency_name }}
                                    </td>
                                    <td>{{ number_format(round($qu->total_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                        {{ $qu->currency_name }}</td>

                                    <td>{{ $status }}</td>
                                    @if ($user_status == 0)

                                        <td style="white-space: nowrap">
                                            {{-- <a class="btn btn-success buyerQuickView" href="#" data-toggle="modal" data-target="#buyerQuickView" id="{{ $qu->main_id }}"
                        style="color: #fff;">QuickView</a> --}}
                                            <a class="btn btn-success"
                                                href="{{ url('/quote/detailview', $qu->main_id) }}"
                                                id="{{ $qu->main_id }}" style="color: #fff;">Detail</a>
                                            <a class="btn btn-success" target="_blank"
                                                href="{{ route('quote.downloadpdf', $qu->main_id) }}"
                                                style="color: #fff;">Download</a>
                                        </td>

                                    @endif

                                    @if ($user_status == 1)
                                    @endif
                                </tr>
                            </tbody>

                        @endforeach

                    @endforeach

                </table>
            @endif
            @if (auth()->user()->hasRole('seller'))
                <h3>My Sent Quotes</h3><br />
                @if ($user_status == 1)
                    <p style="color: red;">Your account was blocked by admin!</p>
                @endif
                <br>
                <table id="example" class="table dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Request ID </th>
                            <th>Date</th>
                            <th>Buyer Company</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            @if ($user_status == 0)
                                <th>Actions</th>
                            @endif

                            @if ($user_status == 1)
                            @endif
                        </tr>
                    </thead>
                    @foreach ($total as $quote)
                        <?php
                        $date = date_create($quote[0]->sign_date);
                        $dt = date_format($date, 'Y-m-d');
                        ?>
                        @foreach ($quote as $qu)
                            <?php
                            switch ($quote[0]->status) {
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
                            } ?>


                            <tbody>
                                <tr>
                                    <td>{{ $qu->request_id }}</td>
                                    <td>{{ $dt }}</td>
                                    <td>
                                        <a target="_blank"
                                            href="{{ route('home.sellerdetail', Crypt::encrypt($qu->company_id)) }}">{{ $qu->company_name }}</a>
                                    </td>
                                    <td>{{ $qu->product_name }}</td>
                                    @if ($qu->alternative_product != '')
                                        <td>
                                            {{ number_format(round($qu->alternative_product_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                            {{ $qu->currency_name }}
                                        </td>
                                    @else
                                        <td>{{ number_format(round($qu->product_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                            {{ $qu->currency_name }}</td>
                                    @endif
                                    <td>{{ number_format(round($qu->total_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                        {{ $qu->currency_name }}</td>
                                    <td> {{ $status }}</td>
                                    @if ($user_status == 0)
                                        <td style="white-space: nowrap; border-top: none;">
                                            {{-- <a class="btn btn-success sellerQuickView" href="#" data-toggle="modal" data-target="#sellerQuickView" id="{{ $qu->main_id }}"
                        style="color: #fff;">QuickView</a> --}}
                                            @if ($qu->status == 1)
                                                <a class="btn btn-success"
                                                    href="{{ url('/quote/edit', $qu->request_id) }}"
                                                    id="{{ $qu->main_id }}" style="color: #fff;">Edit</a>
                                                <a class="btn btn-danger delete"
                                                    href="{{ url('/quote/destroy', $qu->main_id) }}"
                                                    style="color: #fff;">Delete</a>
                                            @endif
                                            @if ($qu->status == 2 || $qu->status == 3)
                                                <a class="btn btn-success"
                                                    href="{{ url('/quote/detailview', $qu->main_id) }}"
                                                    id="{{ $qu->main_id }}" style="color: #fff;">Detail</a>
                                                <a class="btn btn-success" target="_blank"
                                                    href="{{ route('quote.downloadpdf', $qu->main_id) }}"
                                                    style="color: #fff;">Download</a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                @if ($user_status == 1)
                                @endif
                            </tbody>
                        @endforeach

                    @endforeach
                </table>
            @endif
        </div>

    </div>

    <!-- End Map and From Area -->
@stop
