@extends('layouts.app')

@section('main_title', $product->name . ' | ' . $general_setting->site_name)
@section('title', $product->meta_title)
@section('description', $product->meta_description)
@section('keywords', $product->meta_keywords)
@section('image', asset('uploads/') . '/' . $product->image_url)


@section('content')
    <div class="breadcamp">
        <div class="container-fluid">
            <a href="/">Home </a>/
            <a href="/product?category=">All Categories </a> /
            <a href="/product?category={{ $category_slug }}"> {{ $category_name }} </a>/
            @php
                echo ucwords(strtolower($product->name));
            @endphp
        </div>
    </div>

    <div class="category-body margin50">
        <div class="container-fluid">
            <div class="cat-detail">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="sliding-detailimgprt">
                                    @include('component.productcarousel', ['images' => $product->images])
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="rightproductcont">
                                    <h3>{{ $category_name }}</h3>
                                    <h2>{{ $product->name }}</h2>

                                    <ul class="productDesc">
                                        <li>Min Order : {{ $product->MOQ }} {{ $product->getunit($product->unit) }}</li>
                                    </ul>
                                    @if ($product->price_show == 1)
                                        @if ($product->price_fixed == 1)
                                            <span class="priceprtTxt">
                                                <h4>
                                                    {{ $product->price_to }} {{ $product_currency_name->name }} / </h4>
                                                <h5>{{ $product->getunit($product->unit) }} <small>excluding TAX</small>
                                                </h5>
                                            </span>
                                        @else
                                            <span class="priceprtTxt">
                                                <h4>{{ $product->price_from }} {{ $product_currency_name->name }} -
                                                    {{ $product->price_to }} {{ $product_currency_name->name }} /
                                                </h4>
                                                <h5>{{ $product->getunit($product->unit) }} <small>excluding TAX</small>
                                                </h5>
                                            </span>

                                        @endif


                                    @else
                                        @if (auth()->user() == '')
                                            <span class="priceprtTxt">
                                                <button class="btn" id="askForPrice" style="margin-bottom: 20px;">Ask For
                                                    Price</button>
                                            </span>
                                        @elseif(auth()->user()->hasRole('buyer'))
                                            <span class="priceprtTxt">
                                                <button class="btn" id="askForPrice" style="margin-bottom: 20px;">Ask For
                                                    Price</button>
                                            </span>
                                        @endif
                                    @endif
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

                                <div class="tabprt">
                                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab"
                                                role="tab">Product Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab"
                                                role="tab">Company overview</a>
                                        </li>


                                    </ul>


                                    <div id="content" class="tab-content navtabcont" role="tablist">
                                        <div id="pane-A" class="card tab-pane fade show active" role="tabpanel"
                                            aria-labelledby="tab-A">
                                            <div class="card-header" role="tab" id="heading-A">
                                                <h5 class="mb-0">

                                                    <a data-toggle="collapse" href="#collapse-A" aria-expanded="true"
                                                        aria-controls="collapse-A">
                                                        Product Details
                                                    </a>
                                                </h5>
                                            </div>


                                            <div id="collapse-A" class="collapse show" data-parent="#content"
                                                role="tabpanel" aria-labelledby="heading-A">
                                                <div class="card-body">
                                                    <div class="desc">
                                                        <h3>Product Specification</h3>

                                                        <ul class="productDesc">
                                                            <li>Min Order : {{ $product->MOQ }}
                                                                {{ $product->getunit($product->unit) }}
                                                            </li>
                                                        </ul>

                                                        <h3>Product Description</h3>

                                                        <p>
                                                            {!! $product->description !!}
                                                        </p>
                                                        @if ($product->video_link != '')
                                                            <iframe width="420" height="345"
                                                                src="{{ $product->video_link }}">
                                                            </iframe>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                                            <div class="card-header" role="tab" id="heading-B">
                                                <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapse-B"
                                                        aria-expanded="false" aria-controls="collapse-B">
                                                        Company overview
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel"
                                                aria-labelledby="heading-B">
                                                <div class="card-body">
                                                    <div class="desc">
                                                        <h3>Company overview</h3>

                                                        <ul class="productDesc">
                                                            <li>Company name:
                                                                <strong>{{ $product->getcompanyNameByProdcut($product->id) }}</strong>
                                                            </li>
                                                            <li>Preferred currency:
                                                                <strong>{{ $localization_setting->currency }}</strong>
                                                            </li>


                                                            @if ($product->getcompanyFunctionByProdcut($product->id))
                                                                <li>Company function:
                                                                    <strong>{{ $product->getcompanyFunctionByProdcut($product->id) }}</strong>
                                                                </li>
                                                            @endif

                                                            @if ($product->getcompanyEstablishedByProdcut($product->id))
                                                                <li>Year established:
                                                                    <strong>{{ $product->getcompanyEstablishedByProdcut($product->id) }}</strong>
                                                                </li>
                                                            @endif

                                                            <li>
                                                                <span class="priceprtTxt">
                                                                    <a target="_blank"
                                                                        href="{{ route('home.sellerdetail', Crypt::encrypt($product->getsellerIdByProdcut($product->id))) }}">
                                                                        <button class="btn full-width">
                                                                            Visit Seller
                                                                        </button>
                                                                    </a>
                                                                </span>
                                                            </li>
                                                        </ul>

                                                        <h3>{{ $product->getcompanyNameByProdcut($product->id) }}</h3>

                                                        @if ($product->getcompanyAboutByProdcut($product->id))
                                                            <p>{{ $product->getcompanyAboutByProdcut($product->id) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>



                            </div>
                        </div>
                    </div>
                    @if (auth()->user())
                        @if (auth()->user()->hasRole('seller'))
                            @php
                                $display = 'none';
                            @endphp
                        @else
                            @php
                                $display = 'contents';
                            @endphp
                        @endif
                    @else
                        @php
                            $display = 'contents';
                        @endphp
                    @endif
                    <div class="col-md-12 col-lg-3">

                        <div class="full-rightprt">
                            @if ($display == 'none')
                                <div class="leftcatprt acountList">
                                    <ul class="acountListing">
                                        <li>
                                            <a href="https://mambodubai.com/sellerdashboard"> <i class="fa fa-server"></i>
                                                Dashboard
                                            </a>
                                        </li>

                                        <li>
                                            <a href="https://mambodubai.com/account">
                                                <i class="fa fa-address-card-o"></i> My Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mambodubai.com/myproduct">
                                                <i class="fa fa-database"></i> Product
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mambodubai.com/request">
                                                <i class="fa fa-question-circle-o"></i> Request
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mambodubai.com/quote">
                                                <i class="fa fa-sticky-note-o"></i> Quotes
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mambodubai.com/purchaseorders">
                                                <i class="fa fa-shopping-cart"></i> Purchase Order
                                            </a>
                                        </li>

                                        <li>
                                            <a href="https://mambodubai.com/purchaseorders/create">
                                                <i class="fa fa-check-circle"></i> Completed Order
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mambodubai.com/achieved">
                                                <i class="fa fa-tags"></i> Archieved Quotes
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://mambodubai.com/requestcallback">
                                                <i class="fa fa-phone"></i> Request Call Back
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else

                                <div class="box request-qutation">

                                    @if ($sellerFlag == 0)
                                        <h3>Request for quotation</h3>
                                    @else
                                        <h3>Quotation Request</h3>
                                    @endif
                                    <input type="hidden" id="minquantity" value="{{ $product->MOQ }}" />

                                    @if ($sellerFlag == 0)
                                        <div class="countprt">
                                            <label>Quantity ({{ $product->getunit($product->unit) }})</label>
                                            <div class="number">
                                                <span class="minus">-</span>

                                                <input type="text" id="quantity" value="{{ $product->MOQ }}" />
                                                <span class="plus">+</span>
                                            </div>
                                        </div>


                                        <button class="btn full-width resnonebtn" id="resForQuota">Request For
                                            Quotation</button>
                                    @else
                                        <a href="/quote" class="btn full-width">Check Quotations</a>
                                    @endif
                                </div>
                                <div class="box margin20">
                                    @if (App\User::getVerifystatusByproduct($product->user_id) == -1 || App\User::getVerifystatusByproduct($product->user_id) == 1)

                                    @else(App\User::getVerifystatusByproduct($product->user_id) == 2)
                                        <img src="{{ asset('images/verified-seller-logo.png') }}" alt="verified-logo" />
                                    @endif

                                    <div class="comnameLogoprt">
                                        <h4>
                                            {{ $product->getcompanyNameByProdcut($product->id) }}
                                        </h4>
                                        <span>
                                            @if ($product->getcompanyLogo($product->user_id) != '')
                                                <img src="{{ asset('uploads/') }}/{{ $product->getcompanyLogo($product->user_id) }}"
                                                    alt="company-logo" />
                                            @endif
                                        </span>
                                    </div>

                                    @if ($product->getcompanyCountryByProdcut($product->id))
                                        <div class="sellernameprt">
                                            <h5>Seller based in:</h5>
                                            <p>{{ $product->getcountry($product->id) }}</p>
                                        </div>
                                    @endif

                                    @if ($sellerFlag == 0)
                                        <button class="viewbtn resnonebtn" data-toggle="modal"
                                            data-target="#normalpopup">REQUEST
                                            CALL
                                            BACK</button>

                                    @else
                                        <a href="/requestcallback" class="btn full-width">Check Call Back</a>
                                    @endif
                                </div>

                            @endif
                        </div>

                        <div class="twobtnPrt">
                            <button class="btn full-width" id="mblresForQuota">
                                Request For Quotation
                            </button>
                            <button class="viewbtn" data-toggle="modal" data-target="#normalpopup">
                                REQUEST CALL BACK
                            </button>
                        </div>
                    </div>
                </div>
                @if ($product_list != '')
                    <div class="row margin20">
                        <div class="col-md-12">
                            <div class="browse-categoryprt">
                                <h2 class="heading">More from this seller</h2>

                                <div class="slider more-seller margin20">
                                    @foreach ($product_list as $productl)
                                        <div>
                                            <div class="bulk-dealpanel">
                                                <div class="topimgsection">
                                                    <a href="{{ route('product.show', $productl->slug) }}">
                                                        <img src="{{ asset('uploads/') }}/{{ $productl->thumbnailUrl() }}"
                                                            alt="img">
                                                    </a>
                                                </div>
                                                <div class="lowerTxtprt">
                                                    <h4>{{ $productl->getCategoryname($productl->category_id) }}</h4>
                                                    <h3><a
                                                            href="{{ route('product.show', $productl->slug) }}">{{ ucwords(strtolower($productl->name)) }}</a>
                                                    </h3>
                                                    @if ($productl->price_show == 1)
                                                        @if ($productl->price_fixed == 1)
                                                            <span>
                                                                {{ $productl->price_from }}
                                                                {{ $productl->getcurrency($productl->currency_id) }}
                                                                / <sub>{{ $productl->getunit($productl->unit) }}</sub>
                                                            </span>

                                                        @else
                                                            <span>
                                                                {{ $productl->price_from }}
                                                                {{ $productl->getcurrency($productl->currency_id) }} -
                                                                {{ $productl->price_to }}
                                                                {{ $productl->getcurrency($productl->currency_id) }}
                                                                / <sub>{{ $productl->getunit($productl->unit) }}</sub>
                                                            </span>
                                                        @endif


                                                    @else
                                                        <span class="priceprtTxt">
                                                            <a href="{{ route('product.show', $productl->slug) }}"
                                                                style="color:#264b72;" target="_blank">
                                                                Ask For Price
                                                            </a>
                                                        </span>
                                                    @endif
                                                    <small>{{ $productl->MOQ }}
                                                        {{ $productl->getunit($productl->unit) }}
                                                        min order</small>
                                                    <p>{{ $productl->getcompanyNameByProdcut($productl->id) }}</p>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row margin20">
                        <div class="col-md-12">
                            <div class="browse-categoryprt">
                                <h2 class="heading">More from this Category</h2>

                                <div class="slider more-seller margin20">
                                    @foreach ($product_other_category as $productl)
                                        <div>
                                            <div class="bulk-dealpanel">
                                                <div class="topimgsection">
                                                    <a href="{{ route('product.show', $productl->slug) }}">
                                                        <img src="{{ asset('uploads/') }}/{{ $productl->thumbnailUrl() }}"
                                                            alt="img">
                                                    </a>
                                                </div>
                                                <div class="lowerTxtprt">
                                                    <h4>{{ $productl->getCategoryname($productl->category_id) }}</h4>
                                                    <h3><a
                                                            href="{{ route('product.show', $productl->slug) }}">{{ ucwords(strtolower($productl->name)) }}</a>
                                                    </h3>
                                                    @if ($productl->price_show == 1)
                                                        @if ($productl->price_fixed == 1)
                                                            <span>
                                                                {{ $productl->price_to }}
                                                                {{ $productl->getcurrency($productl->currency_id) }}
                                                                / <sub>{{ $productl->getunit($productl->unit) }}</sub>
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ $productl->price_from }}
                                                                {{ $productl->getcurrency($productl->currency_id) }} -
                                                                {{ $productl->price_to }}
                                                                {{ $productl->getcurrency($productl->currency_id) }}
                                                                / <sub>{{ $productl->getunit($productl->unit) }}</sub>
                                                            </span>
                                                        @endif


                                                    @else

                                                        <span class="priceprtTxt">
                                                            <a href="{{ route('product.show', $productl->slug) }}"
                                                                style="color:#264b72;" target="_blank">
                                                                Ask For Price
                                                            </a>
                                                        </span>

                                                    @endif
                                                    <small>{{ $productl->MOQ }}
                                                        {{ $productl->getunit($productl->unit) }}
                                                        min order</small>
                                                    <p>{{ $productl->getcompanyNameByProdcut($productl->id) }}</p>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach











                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <div class="logpopup modal fade" id="normalpopup">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="modal-body">
                    <div class="loginbody logbody">
                        <h2>REQUEST CALL BACK</h2>
                        <div class="form-section">
                            <form action="" method="post" id="reqCallBackForm">
                                <span id="reqCallBackError" class="text-danger"></span>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">

                                <div class="form-group">

                                    <input type="text" name="reqCallBackName" id="reqCallBackName" placeholder="Name"
                                        class="form-control reqCallBackErrChk" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" id="reqCallBackEmail" name="reqCallBackEmail"
                                        placeholder="Email" value="{{ $useremail }}"
                                        class="form-control reqCallBackErrChk" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="reqCallBackMobile" id="reqCallBackMobile" placeholder="Mobile"
                                        class="form-control reqCallBackErrChk" />
                                </div>
                                <div class="form-group">
                                    <textarea rows="2" id="reqCallBackMessage" name="message" cols="50" class="form-control"
                                        placeholder="Your Message"></textarea>
                                </div>

                                <button class="btn full-width margin20" id="callbackSubmitBtn">Submit</button>
                            </form>
                            <div id="reqCallBackSuccessTxt" style="display: none;">
                                <p>Thank you for submitting request</p>
                                <button class="btn full-width margin20" data-dismiss="modal"
                                    id="reqCallBackSuccessBtn">Done</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="logpopup modal fade" id="reqQutoPopup">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="modal-body">
                    <div class="loginbody logbody">
                        <h2>REQUEST FOR QUOTATION</h2>
                        <h4 class="text-center">{{ $product->name }} </h4>
                        <div class="form-section">
                            <form id="reqQutoFrm">
                                <span id="rQutaionError" class="text-danger"></span>
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="{{ $product->unit }}" name="unit_id">

                                <p
                                    style="text-align: left; margin-bottom: 10px; font-weight: 600; color: var(--default-color); ">
                                    Quantity ({{ $product->getunit($product->unit) }})</p>
                                <div class="form-group number">

                                    <span class="minus">-</span>
                                    <input class="removeError" type="text" id="minimum_quantity" name="quantity"
                                        autocomplete="off">
                                    <span class="plus removeError">+</span>
                                </div>

                                <input type="hidden" name="volume" value="0" class="form-control" />
                                <div class="form-group">
                                    <label>Additional Information</label>
                                    <textarea rows="2" name="additional_info" id="additional_info" cols="50"
                                        class="form-control removeError"
                                        placeholder="Anything you want the seller to know about your request"></textarea>
                                </div>
                                <input type="hidden" value="{{ $product->name }}" name="product_name">
                                <button class="btn full-width margin20" id="reqSubmitBtn">Submit</button>
                            </form>
                            <div id="requestSuccessTxt" style="display: none;">
                                <p class="text-center">Thank you for submitting your request ! Expect a Quotation from the
                                    Seller shortly.</p>
                                <button class="btn full-width margin20" data-dismiss="modal" id="successBtn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
