@extends('layouts.appseller')

@section('content')

<!-- Map and From Area -->
<div class="col-md-9">

    <h2> Quotation Details </h2>
    <div class="row">
        <div class="col-lg-8">
            <div class="tabprt">
                <ul id="tabs" class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Product
                            Detail</a>
                    </li>
                </ul>

                <div id="content" class="tab-content navtabcont" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">

                                <a data-toggle="collapse" href="#collapse-A" aria-expanded="true"
                                    aria-controls="collapse-A">
                                    Detail
                                </a>
                            </h5>
                        </div>

                        <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel"
                            aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="desc">
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
                                                            target="_blank">{{ $product_detail[0]->name }}</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>Product Unit</td>

                                                    <td>{{ $product_detail[0]->product_unit_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td>Product Quantity</td>

                                                    <td>{{ $result['volume'] }}
                                                        {{ $product_detail[0]->product_unit_name }}</td>
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
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    Product Detail
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel"
                            aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="container">

                                    <div class="col-lg-4 col-sm-6 col-xs-12">
                                        <div class="bulk-dealpanel">
                                            <div class="topimgsection">
                                                <a href="{{ route('product.show', $product_detail[0]->slug) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('uploads/') }}/{{ $imagesUrl->url }}" alt="img">
                                                </a>
                                            </div>
                                            <div class="lowerTxtprt">
                                                <h4></h4>
                                                <h3><a href="{{ route('product.show', $product_detail[0]->slug) }}"
                                                        target="_blank">{{ $product_detail[0]->name }}</a></h3>
                                                <span> {{ $product_detail[0]->price_from }}
                                                    {{ $product_detail[0]->currency_name }}/
                                                    <sub>{{ $product_detail[0]->product_unit_name }}</sub></span>
                                                <small>{{ $product_detail[0]->MOQ }}
                                                    {{ $product_detail[0]->product_unit_name }} min
                                                    order</small>
                                                <a href="{{ route('product.show', $product_detail[0]->slug) }}"
                                                    target="_blank"> <button class="viewbtn">VIEW</button> </a>

                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /container -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="datatablestructure">
                <form action="{{ route('comments.store') }}" method="POST" id="add_comments" style="width: 100%;">
                    <h4>Send Messages</h4>
                    <div class="form-group">
                        @csrf
                        <input type="hidden" name="quote_id" class="quote_id" value="{{ $result['id'] }}">
                        <textarea rows="8" columns="10" name="description" id="description" placeholder="Description"
                            class="form-control description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
            </div>
            <div class="formPrt">
                <h3>Messages</h3>
                <div class="p-4 box">
                    <div id="profile-list-left" class="py-2 live_comments_table">
                        @if ($allcomments)
                        @foreach ($allcomments as $comment)
                        <div class="card rounded mb-2">
                            <div class="card-body p-3">
                                <div class="media">
                                    <div class="media-body">
                                        <i class="fa fa-user"></i>
                                        {{ $comment->getUsername($comment->writer) }}
                                        ({{ $comment->sign_date }})
                                        <p class="mb-0 text-muted"> <?= nl2br($comment->description) ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if ($result['purchase'] == '')
        @if (auth()->user()->hasRole('buyer'))
        <a class="btn btn-success" href="{{ route('quote.index') }}" style="color: #fff;">Back</a>&nbsp
        <a class="btn btn-success" href="{{ route('quote.formaccepted', $result['id']) }}"
            style="color: #fff;">Accept</a>&nbsp
        <a class="btn btn-success" href="{{ route('quote.formreject', $result['id']) }}"
            style="color: #fff;">Reject</a>&nbsp
        <a class="btn btn-success" target="_blank" href="{{ route('quote.downloadpdf', $result['id']) }}"
            style="color: #fff;">Download</a>&nbsp
        @endif
        @endif
    </div>

</div>
<!-- End Map and From Area -->
@stop
@section('script')
<script>
    function livecomments() {
        var url = "{{ route('quote.getcomments', $result['id']) }}";

        setInterval(function ()
        {
                $.ajax({
                url: url,
                data: {},
                type: 'GET',
                success: function (result, status) {
                var parent = $('.live_comments_table');
                    if (result) {
                    $('.live_comments_table').empty();
                    for (var i = 0; i < result.length; i++) {
                        var tag='<div class="card rounded mb-2"><div class="card-body p-3"><div class="media"><div class="media-body"><i class="fa fa-user"></i> '
                        + result[i]["username"] + ' (' + result[i]["sign_date"] + ') ' + '<p class="mb-0 text-muted">' +
                        result[i]['description'] + '</p></div></div></div></div>' parent.append(tag);
                    }
                }
        }
    });
        }, 2000);
    } ;
            livecomments();
</script>
@endsection
