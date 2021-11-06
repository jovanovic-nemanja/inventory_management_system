@extends('layouts.app')

@section('main_title', $product->name . " | " . $general_setting->site_name)
@section('title', $product->meta_title)
@section('description', $product->meta_description)
@section('keywords', $product->meta_keywords)

@section('content')
<div class="breadcamp">
                <div class="container-fluid">
                    <a href="/">Home </a>/
                    <a href="/product?category=">All Categories </a> /
                    <a href="/product?category={{ $category_name }}"> {{ $category_name }} </a>/ 
                    {{ $product->name}}
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
                                <h3>{{$product->name}}</h3>
                                <h2>{{$product->meta_title}}</h2>

                                <ul class="productDesc">
                                    <li>Min Order : {{ $product->MOQ }} {{ $product->getunit($product->unit)}}</li>
                                    <li>Condition : New</li>
                                    <li>Warranty: : YES</li>
                                    <li>Country of shipping : UAE</li>
                                </ul>
                                <!-- <h4>60 AED / <sub>Price <span>excluding VAT</span></sub></h4> -->
                                <span class="priceprtTxt">
                                    <h4>{{ $product->price_from }} {{ $localization_setting->currency }} / </h4>
                                    <h5>{{ $product->getunit($product->unit)}} <small>excluding TAX</small></h5>
                                </span>

                                <ul class="detail-social">
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/icon/facebook.png') }}" alt="social-icon" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/icon/twitter.png') }}" alt="social-icon" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/icon/linkedin.png') }}" alt="social-icon" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/icon/mail.png') }}" alt="social-icon" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/icon/whatapp.png') }}" alt="social-icon" />
                                        </a>
                                    </li>
                                </ul>

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
                                                        <li>Min Order : {{ $product->MOQ }} {{ $product->getunit($product->unit)}}</li>
                                                        <li>Condition : New</li>
                                                        <li>Warranty: : YES</li>
                                                        <li>Country of shipping : UAE</li>
                                                    </ul>

                                                    <h3>Product Description</h3>

                                                    <p>
                                                        {!! $product->description !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="pane-B" class="card tab-pane fade" role="tabpanel"
                                         aria-labelledby="tab-B">
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
                                                        <li>Company name: <strong>{{ $product->getcompanyNameByProdcut($product->id) }}</strong></li>
                                                        <li>Preferred currency: <strong>{{ $localization_setting->currency }}</strong></li>
                                                        <li>Company function: <strong>Manufacturer,
                                                                Distributor</strong></li>
                                                        <li>Year established: <strong>1991</strong></li>
                                                    </ul>

                                                    <h3>{{ $product->getcompanyNameByProdcut($product->id) }}</h3>

                                                    <p>
                                                        Lorem Ipsum is simply dummy text of the printing and
                                                        typesetting industry. Lorem Ipsum has been the industry's
                                                        standard
                                                        dummy text ever since the 1500s, when an unknown printer
                                                        took a galley of type and scrambled it to make a type
                                                        specimen
                                                        book. It has survived not only five centuries, but also the
                                                        leap into electronic typesetting, remaining essentially
                                                        unchanged. It was popularised in the 1960s with the release
                                                        of Letraset sheets containing Lorem Ipsum passages, and more
                                                        recently with desktop publishing software like Aldus
                                                        PageMaker including versions of Lorem Ipsum.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="full-rightprt">
                        <div class="box request-qutation">
                            <h3>Request for quotation</h3>
                               <input type="hidden" id="minquantity" value="{{$product->quantity}}" />
                            <div class="countprt">
                                <label>Quantity ({{ $product->getunit($product->unit)}})</label>
                                <div class="number">
                                    <span class="minus">-</span>
                                 
                                    <input type="text" id="quantity" value="{{$product->quantity}}" />
                                    <span class="plus">+</span>
                                </div>
                            </div>
                            <button class="btn full-width resnonebtn" id="resForQuota">Request For Quotation</button>
                        </div>
                        <div class="box margin20">
                            @if(App\User::getVerifystatusByproduct($product->user_id) == -1 || App\User::getVerifystatusByproduct($product->user_id) == 1)

                            @else(App\User::getVerifystatusByproduct($product->user_id) == 2)
                            <img src="{{ asset('images/verified-seller-logo.png') }}" alt="verified-logo" />
                            @endif

                            <div class="comnameLogoprt">
                                <h4>
                                    {{ $product->getcompanyNameByProdcut($product->id) }}
                                </h4>
                                <span>
                                    @if($product->getcompanyLogo($product->user_id) != '')
                                    <img src="{{ asset('uploads/') }}/{{ $product->getcompanyLogo($product->user_id)  }}" alt="company-logo" />
                                    @endif
                                </span>
                            </div>
                            <div class="sellernameprt">
                                <h5>Seller based in:</h5>
                                <p>United Arab Emirates</p>
                            </div>
                            <button class="viewbtn resnonebtn" data-toggle="modal"
                                    data-target="#normalpopup">REQUEST CALL
                                BACK</button>
                        </div>
                    </div>

                    <div class="twobtnPrt">
                        <button class="btn full-width" data-toggle="modal" data-target="#reqQutoPopup" >Request For Quotation</button>
                        <button class="viewbtn" data-toggle="modal" data-target="#normalpopup">REQUEST CALL
                            BACK</button>
                    </div>
                </div>
            </div>

            <div class="row margin20">
                <div class="col-md-12">
                    <div class="browse-categoryprt">
                        <h2 class="heading">More from this seller</h2>

                        <div class="slider more-seller margin20">
                            @foreach($product_list as $productl)
                            <div>
                                <div class="bulk-dealpanel">
                                    <div class="topimgsection">
                                        <a href="{{ route('product.show', $productl->slug) }}">
                                            <img src="{{ asset('uploads/') }}/{{ $productl->thumbnailUrl() }}" alt="img">
                                        </a>
                                    </div>
                                    <div class="lowerTxtprt">
                                        <h4>{{ $productl->getCategoryname($product->category_id) }}</h4>
                                        <h3><a href="{{ route('product.show', $productl->slug) }}">{{ $productl->name }}</a></h3>
                                        <span>{{ $productl->price_from}} {{ $localization_setting->currency }}  / <sub>{{ $productl->getunit($productl->unit)}}</sub></span>
                                        <small>{{ $productl->MOQ }} {{ $productl->getunit($productl->unit)}} min order</small>
                                        <p>{{ $productl->getcompanyNameByProdcut($productl->id) }}</p>

                                    </div>
                                </div>
                            </div>
                            @endforeach











                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="logpopup modal fade" id="reqCallBackPopup">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="modal-body">
                <div class="loginbody logbody">
                    <h2>RQUEST CALL BACK</h2>
                    <div class="form-section">
                        <form action="" method="post" id="reqCallBackForm">
                            <span id="reqCallBackError" class="text-danger"></span>
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            
                            <div class="form-group">
                                
                                <input type="text"  name="reqCallBackName" id="reqCallBackName" placeholder="Enter Your Name" class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" name="reqCallBackEmail" value="{{$useremail}}"  class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="text" name="reqCallBackMobile" id="reqCallBackMobile" placeholder=" Enter Your Mobile" class="form-control" />
                            </div>
                            
                            <button class="btn full-width margin20" id="callbackSubmitBtn">Submit</button>
                        </form>
                    <div id="reqCallBackSuccessTxt" style="display: none;">
                        <p>Thank you for submitting request</p>
                            <button class="btn full-width margin20" data-dismiss="modal" id="reqCallBackSuccessBtn">Done</button>
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
                    <h2 >REQUEST FOR QUOTION</h2>
                    <h4 class="text-center">{{$product->name}} </h4>
                    <div class="form-section">
                        <form id="reqQutoFrm">
                             <span id="rQutaionError" class="text-danger"></span>
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <input type="hidden" value="{{$product->unit}}" name="unit_id">
                            
                            <p style="text-align: left; margin-bottom: 10px; font-weight: 600; color: var(--default-color); ">Quantity ({{ $product->getunit($product->unit)}})</p>
                            <div class="form-group number">

                                <span class="minus">-</span>
                                <input class="removeError" type="text" id="minimum_quantity" name="quantity" autocomplete="off">
                                <span class="plus removeError">+</span>
                            </div>
                            		
                                <input type="hidden" name="volume" value="0"  class="form-control" />
                            

                            
                            <div class="form-group" style="display: none;">
                                <label>Destination</label>
                                <textarea rows="2" name="destination" cols="50" class="form-control"
                                          placeholder="Write about your destination">null</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Additional Information</label>
                                <textarea  rows="2" name="additional_info" id="additional_info" cols="50" class="form-control removeError"
                                          placeholder="Write about your  Additional information"></textarea>
                            </div>
                            <input type="hidden" value="{{$product->name}}" name="product_name">
                            <button class="btn full-width margin20" id="reqSubmitBtn">Submit</button>
                        </form>
                        <div id="requestSuccessTxt" style="display: none;">
                            <button class="btn full-width margin20" data-dismiss="modal" id="successBtn">Done</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection


