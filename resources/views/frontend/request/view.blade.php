@extends('layouts.appseller')

@section('content')

    <div class="col-md-9">
        <?php echo displayAlert(); ?>
        <h3> Request Details</h3><br>

        <div class="row">
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Items</th>
                            <th scope="col">Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td>Product Name</td>

                            <td>{{ $request[0]['product_name'] }}</td>
                        </tr>
                        @if ($product != null)
                            <tr>
                                <th scope="row"></th>
                                <td>Product URL</td>

                                <td><a
                                        href="{{ route('product.show', $product->slug) }}">{{ route('product.show', $product->slug) }}</a>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th scope="row"></th>
                            <td>Product Unit</td>

                            <td>{{ $unit_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Product Quantity</td>

                            <td>{{ $request[0]['req_quantity'] }} &nbsp; {{ $unit_name }}</td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>Additional Information</td>

                            <td>{{ $request[0]['additional_information'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Request Posted On</td>

                            <td>{{ $request[0]['created_at'] }}</td>
                        </tr>



                    </tbody>
                </table>
            </div>
            @if ($product != null)
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="bulk-dealpanel">
                        <div class="topimgsection">
                            <a href="{{ route('product.show', $product->slug) }}" target="_blank">
                                <img src="{{ asset('uploads/') }}/{{ $product->thumbnailUrl() }}" alt="img">
                            </a>
                        </div>
                        <div class="lowerTxtprt">
                            <h4></h4>
                            <h3><a href="{{ route('product.show', $product->slug) }}"
                                    target="_blank">{{ $request[0]['product_name'] }}</a></h3>
                            <span> {{ $product->price_from }} {{ $product->getcurrency($product->currency_id) }}/
                                <sub>{{ $product->getunit($request[0]['unit']) }}</sub></span>
                            <small>{{ $product->MOQ }} {{ $product->getunit($request[0]['unit']) }} min order</small>
                            <a href="{{ route('product.show', $product->slug) }}" target="_blank"> <button
                                    class="viewbtn">VIEW</button> </a>

                        </div>
                    </div>
                </div>
            @endif
        </div>
        <a class="btn btn-success" href="{{ route('request.index') }}">Back</a>
        @if (auth()->user()->hasRole('seller'))
            @if ($request[0]->is_quotes($request[0]['id']) == 1)

            @else
                <a class="btn btn-success" href="{{ url('/quote/reply', $request[0]['id']) }}"
                    id="{{ $request[0]['id'] }}" style="color: #fff;">Quote Now</a>
            @endif
        @endif

    </div>
@stop
