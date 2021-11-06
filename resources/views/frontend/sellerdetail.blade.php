@extends('layouts.app')

@section('content')
    <h3>{{ $page }}</h3>
    <style type="text/css">
        .mt-20 {
            margin-top: 20px;
        }

    </style>

    <style type="text/css">
        .btn-grey {
            background-color: #D8D8D8;
            color: #FFF;
        }

        .rating-block {
            background-color: #FAFAFA;
            border: 1px solid #EFEFEF;
            padding: 15px 15px 20px 15px;
            border-radius: 3px;
        }

        .bold {
            font-weight: 700;
        }

        .padding-bottom-7 {
            padding-bottom: 7px;
        }

        .review-block {
            background-color: #FAFAFA;
            border: 1px solid #EFEFEF;
            padding: 15px;
            border-radius: 3px;
            margin-bottom: 15px;
        }

        .review-block-name {
            font-size: 12px;
            margin: 10px 0;
        }

        .review-block-date {
            font-size: 12px;
        }

        .review-block-rate {
            font-size: 13px;
            margin-bottom: 15px;
            color: #dede1d;
        }

        .review-block-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .review-block-description {
            font-size: 13px;
        }
        .img-rounded{
            width:50%;
            }
    </style>
    <div class="breadcamp">
        <div class="container-fluid">
            <a href="/"> Home</a> / Seller Profile
        </div>
    </div>
    <div class="category-body margin50">
        <div class="container-fluid">
            <div class="cat-detail">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        <div class="row">
                            <div class="col-lg-5">

                                <div class="company-image">
                                    @if (isset($userdeatil[0]->company_logo))
                                        <img src="{{ asset('uploads/') }}/{{ $userdeatil[0]->company_logo }}"
                                            alt="product-img" />
                                    @else
                                        <img src="{{ asset('uploads/No-image-available.png') }}" alt="verified-logo" />
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="rightproductcont">
                                    <h3>Seller Information</h3>
                                    <h2>{{ $userdeatil[0]->company_name }}</h2>
                                    @if ($userdeatil[0]->verified == 1)
                                        <img src="{{ asset('images/verified-seller-logo.png') }}" alt="verified-logo" />
                                    @endif

                                    <ul class="productDescc">
                                        <li>Preferred currency: <strong>{{ $userdeatil[0]->currency_name }}</strong>
                                        </li>
                                        <li>Company function: <strong>{{ $userdeatil[0]->company_function }}</strong></li>
                                        <li>Year established: <strong>{!! htmlspecialchars_decode(date('F j Y', strtotime($userdeatil[0]->year_of_establishment))) !!}</strong></li>
                                        <li>Seller based in: <strong>{{ $userdeatil[0]->country_name }}</strong></li>

                                    </ul>


                                    <div>
                                        <div class="addthis_inline_share_toolbox"></div>
                                        <script type="text/javascript"
                                            src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-601d242ac445b079">
                                        </script>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row margin40">
                            <div class="col-lg-12">


                            </div>
                        </div>
                        <div class="row margin40">
                            <div class="col-lg-12">

                                <div class="tabprt">
                                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab"
                                                role="tab">About Company</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab"
                                                role="tab">Company Rating</a>
                                        </li>


                                    </ul>


                                    <div id="content" class="tab-content navtabcont" role="tablist">
                                        <div id="pane-A" class="card tab-pane fade show active" role="tabpanel"
                                            aria-labelledby="tab-A">
                                            <div class="card-header" role="tab" id="heading-A">
                                                <h5 class="mb-0">

                                                    <a data-toggle="collapse" href="#collapse-A" aria-expanded="true"
                                                        aria-controls="collapse-A">
                                                        About Company
                                                    </a>
                                                </h5>
                                            </div>


                                            <div id="collapse-A" class="collapse show" data-parent="#content"
                                                role="tabpanel" aria-labelledby="heading-A">
                                                <div class="card-body">
                                                    <div class="desc">
                                                        <h3>About {{ $userdeatil[0]->company_name }}</h3>
                                                        <p>{{ $userdeatil[0]->company_about }}</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                                            <div class="card-header" role="tab" id="heading-B">
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapse-B"
                                                        aria-expanded="false" aria-controls="collapse-B">
                                                        Company Rating
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel"
                                                aria-labelledby="heading-B">

                                                <div class="card-body">


                                                    <div class="container">

                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="rating-block">
                                                                    @php
                                                                        $sum_of_rating = 0;
                                                                        $rating = 0;
                                                                        $five_count = 0;
                                                                        $four_count = 0;
                                                                        $three_count = 0;
                                                                        $two_count = 0;
                                                                        $one_count = 0;
                                                                    @endphp
                                                                    @if (sizeof($allreviews) > 0)
                                                                        @foreach ($allreviews as $review)
                                                                            @php
                                                                                $sum_of_rating = $sum_of_rating + $review->mark;
                                                                                switch ( $review->mark) {
                                                                                    case '5':
                                                                                    $five_count++;
                                                                                        break;
                                                                                        case '4':
                                                                                    $four_count++;
                                                                                        break;
                                                                                        case '3':
                                                                                    $three_count++;
                                                                                        break;
                                                                                        case '2':
                                                                                    $two_count++;
                                                                                        break;
                                                                                        case '1':
                                                                                    $one_count++;
                                                                                        break;
                                                                                    default:
                                                                                        # code...
                                                                                        break;
                                                                                }
                                                                            @endphp
                                                                        @endforeach
                                                                        @php
                                                                            $rating = floor(($sum_of_rating * 5) / (sizeof($allreviews) * 5));
                                                                        @endphp
                                                                    @endif
                                                                    <h4>Average rating</h4>
                                                                    <h2 class="bold padding-bottom-7">
                                                                        {{ $rating }}
                                                                        <small>/
                                                                            5</small>
                                                                    </h2>
                                                                    @for ($i = $rating; $i > 0; $i--)
                                                                    <span class="fa fa-star checked"></span>
                                                                                    @endfor
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <h4>Rating breakdown</h4>
                                                                <div class="pull-left">
                                                                    <div class="pull-left"
                                                                        style="width:35px; line-height:1;">
                                                                        <div style="height:9px; margin:5px 0;">5 <span
                                                                                class="glyphicon glyphicon-star"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-left" style="width:180px;">
                                                                        <div class="progress"
                                                                            style="height:9px; margin:8px 0;">
                                                                            <div class="progress-bar progress-bar-success"
                                                                                role="progressbar" aria-valuenow="5"
                                                                                aria-valuemin="0" aria-valuemax="5"
                                                                                style="width: 1000%">
                                                                                <span class="sr-only">80% Complete
                                                                                    (danger)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right" style="margin-left:10px;"> {{$five_count}}
                                                                    </div>
                                                                </div>
                                                                <div class="pull-left">
                                                                    <div class="pull-left"
                                                                        style="width:35px; line-height:1;">
                                                                        <div style="height:9px; margin:5px 0;">4 <span
                                                                                class="glyphicon glyphicon-star"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-left" style="width:180px;">
                                                                        <div class="progress"
                                                                            style="height:9px; margin:8px 0;">
                                                                            <div class="progress-bar progress-bar-primary"
                                                                                role="progressbar" aria-valuenow="4"
                                                                                aria-valuemin="0" aria-valuemax="5"
                                                                                style="width: 80%">
                                                                                <span class="sr-only">80% Complete
                                                                                    (danger)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right" style="margin-left:10px;">{{$four_count}}
                                                                    </div>
                                                                </div>
                                                                <div class="pull-left">
                                                                    <div class="pull-left"
                                                                        style="width:35px; line-height:1;">
                                                                        <div style="height:9px; margin:5px 0;">3 <span
                                                                                class="glyphicon glyphicon-star"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-left" style="width:180px;">
                                                                        <div class="progress"
                                                                            style="height:9px; margin:8px 0;">
                                                                            <div class="progress-bar progress-bar-info"
                                                                                role="progressbar" aria-valuenow="3"
                                                                                aria-valuemin="0" aria-valuemax="5"
                                                                                style="width: 60%">
                                                                                <span class="sr-only">80% Complete
                                                                                    (danger)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right" style="margin-left:10px;">{{$three_count}}
                                                                    </div>
                                                                </div>
                                                                <div class="pull-left">
                                                                    <div class="pull-left"
                                                                        style="width:35px; line-height:1;">
                                                                        <div style="height:9px; margin:5px 0;">2 <span
                                                                                class="glyphicon glyphicon-star"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-left" style="width:180px;">
                                                                        <div class="progress"
                                                                            style="height:9px; margin:8px 0;">
                                                                            <div class="progress-bar progress-bar-warning"
                                                                                role="progressbar" aria-valuenow="2"
                                                                                aria-valuemin="0" aria-valuemax="5"
                                                                                style="width: 40%">
                                                                                <span class="sr-only">80% Complete
                                                                                    (danger)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right" style="margin-left:10px;">{{$two_count}}
                                                                    </div>
                                                                </div>
                                                                <div class="pull-left">
                                                                    <div class="pull-left"
                                                                        style="width:35px; line-height:1;">
                                                                        <div style="height:9px; margin:5px 0;">1 <span
                                                                                class="glyphicon glyphicon-star"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-left" style="width:180px;">
                                                                        <div class="progress"
                                                                            style="height:9px; margin:8px 0;">
                                                                            <div class="progress-bar progress-bar-danger"
                                                                                role="progressbar" aria-valuenow="1"
                                                                                aria-valuemin="0" aria-valuemax="5"
                                                                                style="width: 20%">
                                                                                <span class="sr-only">80% Complete
                                                                                    (danger)</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="pull-right" style="margin-left:10px;">{{$one_count}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <hr />
                                                                <div class="review-block">
                                                                    @foreach ($allreviews as $review)


                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                @if ($review->user_image != null)
                                                                                    <img src="{{ asset('uploads/') }}/{{ $review->user_image }}"
                                                                                        class="img-rounded">
                                                                                @else
                                                                                    <img src="{{ asset('uploads/') }}/userimage.png"
                                                                                        class="img-rounded">

                                                                                @endif

                                                                                <div class="review-block-name"><a
                                                                                        href="#">{{ $review->username }}</a>
                                                                                </div>
                                                                                <div class="review-block-date">
                                                                                    {!! htmlspecialchars_decode(date('F j Y', strtotime($review->sign_date))) !!}
                                                                                    <br />
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-9">
                                                                                <div class="review-block-rate">
                                                                                    @for ($i = $review->mark; $i > 0; $i--)
                                                                                        <span
                                                                                            class="fa fa-star checked"></span>
                                                                                    @endfor
                                                                                </div>
                                                                                {{-- <div class="review-block-title">this was nice in buy</div> --}}
                                                                                <div class="review-block-description">{{ $review->description }}</div>
                                                                            </div>
                                                                        </div>
                                                                        <hr />
                                                                    @endforeach
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
                        </div>

                        <div class="row margin40">

                            <div class="col-md-12">
                                <div class="rightListingprt">
                                    <div class="listingheaderprt">
                                        <h3>Products Of The Seller</h3>
                                        <div class="sortingprt">
                                            {{-- <p>Showing 1 to 60 of {{ $totalProduct }} Products</p> --}}
                                        </div>
                                    </div>
                                    <div class="infinite-scroll">
                                        <div class="row">
                                            @if (sizeof($products) > 0)
                                                @foreach ($products as $product)
                                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="bulk-dealpanel">
                                                            <div class="topimgsection">
                                                                @if ($product->image_url == '')
                                                                    <img src="{{ asset('uploads/No-image-available.png') }}"
                                                                        alt="verified-logo" />
                                                                @else
                                                                    <img src="{{ asset('uploads/') }}/{{ $product->image_url }}"
                                                                        alt="img">
                                                                @endif
                                                            </div>
                                                            <div class="lowerTxtprt">
                                                                <h4>{{ $product->getCategoryname($product->category_id) }}
                                                                </h4>
                                                                <!--<h3><a title="{{ $product->name }}" href="{{ route('product.show', $product->slug) }}">{{ str_limit(strip_tags($product->name), 25) }}</a></h3>-->

                                                                <a title="{{ $product->name }}"
                                                                    href="{{ route('product.show', $product->slug) }}">
                                                                    <h3 class="margin10">
                                                                        {{ str_limit(strip_tags(ucwords(strtolower($product->name))), 25) }}
                                                                    </h3>
                                                                </a>
                                                                @if ($product->price_show == 1)
                                                                    <span>{{ $product->price_from }}
                                                                        {{ $product->getcurrency($product->currency_id) }}
                                                                        -
                                                                        {{ $product->price_to }}
                                                                        {{ $product->getcurrency($product->currency_id) }}
                                                                        /
                                                                        <sub>{{ $product->getunit($product->unit) }}</sub></span>
                                                                @else
                                                                    <span class="priceprtTxt">
                                                                        <a href="{{ route('product.show', $product->slug) }}"
                                                                            style="color:#264b72;" target="_blank">
                                                                            Ask For Price
                                                                        </a>
                                                                    </span>
                                                                @endif


                                                                <small>{{ $product->MOQ }}
                                                                    {{ $product->getunit($product->unit) }} min
                                                                    order</small>
                                                                <p>{{ $product->getcompanyNameByProdcut($product->id) }}
                                                                </p>
                                                                {{-- @if ($product->getcompanyCountryByProdcut($product->id))
                                                        <div class="sellernameprt">
                                                            <h5>Seller based in:</h5>
                                                            <p>{{ $product->getcompanyCountryByProdcut($product->id) }}
                                                    </p>
                                                </div>
                                                @endif --}}
                                                                <a href="{{ route('product.show', $product->slug) }}">
                                                                    <button class="viewbtn">VIEW AND INQUIRE</button> </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                {!! $products->appends(Request::except('page'))->render() !!}
                                            @else
                                                <p>There is no product in this category</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-3">
                        <div class="full-rightprt">
                            <form method="POST" id="callbackSellerPrfleFrm">
                                @csrf
                                <div class="box request-qutation">
                                    <h3>Request Call Back</h3>
                                    <span id="reqCallBackErrorPrf" class="text-danger"></span>
                                    <span id="reqCallBackSuccesPrf" class="text-success"></span>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">


                                                <input type="text" id="reqPrfName" name="name" placeholder="Full Name"
                                                    class="form-control msgcls" />
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="email" id="reqPrfEmail" name="email_add" placeholder="Email"
                                                    class="form-control msgcls" />
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="tel" id="reqPrfMobile" name="mobile" placeholder="Mobile"
                                                    class="form-control msgcls" />
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea rows="4" name="message" cols="50" class="form-control"
                                                    placeholder="Your message"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="customer_id" value="{{ $userdeatil[0]->id }}" />
                                        <input type="hidden" name="product_id" value="" />
                                    </div>
                                    <button type="submit" id="callbackSellerPrfleBtn" class="btn full-width">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div class="twobtnPrt">
                            <button class="btn full-width">Request For Quotation</button>
                            <button class="viewbtn" data-toggle="modal" data-target="#normalpopup">REQUEST CALL
                                BACK</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        $(document).prop('title', '<?php echo $userdeatil[0]->company_name; ?>' +
            ' | Mambodubai');

    </script>
@stop
