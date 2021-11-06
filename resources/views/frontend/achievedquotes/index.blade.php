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
                        <th>Purchase Date</th>
                        <th>Product Name</th>
                        @if (auth()->user()->hasRole('seller'))

                            <th> Buyer Name</th>
                        @else
                            <th> Seller Name</th>
                        @endif

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

                        if ($quote->available == 0) {
                        $str = 'Available';
                        $total_price = $quote->product_price * $quote->volume + $quote->shipping_price +
                        $quote->other_price;
                        } else {
                        $str = 'Not Available';
                        $total_price = $quote->alternative_product_price * $quote->volume + $quote->shipping_price +
                        $quote->other_price;
                        }
                        ?>
                        <tr>
                            <td style="vertical-align: middle;">{{ $dt }}</td>
                            <td style="vertical-align: middle;">{{ $quote->product_name }}</td>
                            <td style="vertical-align: middle;">{{ $quote->company_name }}</td>
                            <td style="vertical-align: middle;">{{ $quote->product_price }} {{ $quote->currency_name }}
                            </td>
                            <td style="vertical-align: middle;">{{ $quote->total_price }} {{ $quote->currency_name }}
                            </td>
                            <td style="vertical-align: middle;">
                                <a class="btn btn-success" href="{{ url('/achieved/detailview', $quote->id) }}"
                                    id="{{ $quote->id }}" style="color: #fff;">Detail</a>
                                <a class="btn btn-success" target="_blank"
                                    href="{{ route('achieved.downloadpdf', $quote->id) }}"
                                    style="color: #fff;">Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- End Map and From Area -->
@stop
