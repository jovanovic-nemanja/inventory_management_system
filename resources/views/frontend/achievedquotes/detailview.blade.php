@extends('layouts.appseller')

@section('content')

    <!-- Map and From Area -->
    <div class="col-md-9">
        <?php echo displayAlert(); ?>
        <h2> Archived Quotation Details </h2> <br />
        <div class="row">
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Particulars</th>
                            <th scope="col">Value</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td>Product Name</td>

                            <td><a href="{{ route('product.show', $product_detail[0]->slug) }}"
                                    target="_blank">{{ $product_detail[0]->name }}</a></td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>Product Unit</td>

                            <td>{{ $product_detail[0]->product_unit_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Product Quantity</td>

                            <td>{{ $result['volume'] }} {{ $product_detail[0]->product_unit_name }}</td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>Product Unit Price</td>
                            @if ($result['alternative_product'] != '')
                                <td>{{ number_format(round($result['alternative_product_price'], 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $product_detail[0]->currency_name }}</td>
                            @else
                                <td>{{ number_format(round($result['product_price'], 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $product_detail[0]->currency_name }}</td>
                            @endif
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>Subtotal</td>

                            @if ($result['alternative_product'] != '')
                                <td>{{ number_format(round($result['volume'] * $result['alternative_product_price'], 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $product_detail[0]->currency_name }}</td>
                            @else
                                <td>{{ number_format(round($result['volume'] * $result['product_price'], 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $product_detail[0]->currency_name }}</td>
                            @endif
                        </tr>
                        @if ($result['vat'] != 0)
                            <tr>
                                <th scope="row"></th>
                                <td>VAT (5%)</td>

                                <td>{{ number_format(round($result['vat'], 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $product_detail[0]->currency_name }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th scope="row"></th>
                            <td style="font-size:20px;"><strong>Total</strong></td>

                            <td style="font-size:20px;"><strong>
                                    {{ number_format(round($result['total_price'], 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $product_detail[0]->currency_name }}</strong></td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>Request Posted On</td>

                            <td>{{ $result['request_post_on'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Quotation Submitted On</td>

                            <td>{{ $result['sign_date'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Archived On</td>

                            <td>{{ $result['achieved_date'] }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="bulk-dealpanel">
                    <div class="topimgsection">
                        <a href="{{ route('product.show', $product_detail[0]->slug) }}" target="_blank">
                            <img src="{{ asset('uploads/') }}/{{ $imagesUrl->url }}" alt="img">
                        </a>
                    </div>
                    <div class="lowerTxtprt">
                        <h4></h4>
                        <h3><a href="{{ route('product.show', $product_detail[0]->slug) }}"
                                target="_blank">{{ $product_detail[0]->name }}</a></h3>
                        <span> {{ $product_detail[0]->price_from }} {{ $product_detail[0]->currency_name }}/
                            <sub>{{ $product_detail[0]->product_unit_name }}</sub></span>
                        <small>{{ $product_detail[0]->MOQ }} {{ $product_detail[0]->product_unit_name }} min
                            order</small>
                        <a href="{{ route('product.show', $product_detail[0]->slug) }}" target="_blank"> <button
                                class="viewbtn">VIEW</button> </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Map and From Area -->
@stop
