@extends('layouts.app')

@section('main_title', 'All Categories | ' . $general_setting->site_name)
@section('title', 'all')
@section('description', 'all')
@section('keywords', $arrs)
    <div class="breadcamp">
        <div class="container-fluid">
            <a href="/">Home </a>/Search
        </div>
    </div>

@section('content')

    <style>
        .modal-overlay {
            background: #000000;
            opacity: 0.6;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
            filter: alpha(opacity=60);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }

        #ajaxLoadingBox {
            position: fixed;
            top: 50%;
            left: 50%;
            height: 60px;
            width: 60px;
            background: #333 url('../img/loader.gif') no-repeat;
            border-radius: 10px;
        }

    </style>


    <div class="category-body margin50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="leftcatprt">
                        <div class="subcatprt">
                            <h3 class="clicksub">All Categories</h3>

                            <div class="subcatList">
                                <ul>
                                    @foreach ($main_categorys as $category)
                                        <li>
                                            <a href="product?category={{ $category->slug }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="subcatprt priceprt margin20">
                            <h3 class="productsub">Price</h3>

                            <div class="slider-box">
                                <!-- <input type="text" id="priceRange" readonly>
                                                                                                                                                                                <div id="price-range" class="slider"></div> -->

                                <div id="slider-range" class="price-filter-range" name="rangeInput"></div>

                                <div class="inputTxt">
                                    <input type="text" min=0 max="900000" oninput="validity.valid||(value='0');"
                                        id="min_price" value="0" class="price-range-field" />
                                    <input type="text" min=0 max="900000" oninput="validity.valid||(value='900000');"
                                        id="max_price" value="900000" class="price-range-field"
                                        style="text-align: right;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="downaddprt">
                    <a href="#">
                        <img src="./images/listing-ad.png" alt="addimg" />
                    </a>
                    <a href="#">
                        <img src="./images/listing-ad2.png" alt="addimg" />
                    </a>
                </div> --}}
                </div>
                <div class="col-md-9">
                    <div class="rightListingprt">
                        <div class="listingheaderprt">
                            @if (app('request')->input('word') != '')
                                <h2> Search for "{{ app('request')->input('word') }}"</h2>
                            @else
                                <h2> Search Result</h2>
                            @endif

                            <input type="hidden" id="cat_slug" value="{{ $cat_slug }}">
                            <div class="sortingprt">
                                {{-- <p>Showing 1 to {{ count($categories) }} of {{ count($categories) }} Products</p> --}}
                                <div class="sortdiv">
                                    <label>Sort by:</label>
                                    <select name="sortdiv" id="sortdiv">
                                        <option value="3">Select</option>
                                        <option value="3">Lowest Price</option>
                                        <option value="4">Highest Price</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="infinite-scroll">
                            <div class="row" id="lstdata">
                                @if (sizeof($categories) > 0)
                                    @foreach ($categories as $product)
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <div class="bulk-dealpanel">
                                                <div class="topimgsection">
                                                    <a href="{{ route('product.show', $product->slug) }}">
                                                        <img src="{{ asset('uploads/') }}/{{ $product->thumbnailUrl() }}"
                                                            alt="img">
                                                    </a>
                                                </div>
                                                <div class="lowerTxtprt">
                                                    <h4>{{ $product->getCategoryname($product->category_id) }}</h4>
                                                    <a title="{{ $product->name }}"
                                                        href="{{ route('product.show', $product->slug) }}">
                                                        <h3 class="margin10">
                                                            {{ str_limit(strip_tags(ucwords(strtolower($product->name))), 25) }}
                                                        </h3>
                                                    </a>
                                                    @if ($product->price_show == 1)
                                                        @if ($product->price_fixed == 1)
                                                            <span>
                                                                {{ $product->price_to }}
                                                                {{ $product->getcurrency($product->currency_id) }} /
                                                                <sub>{{ $product->getunit($product->unit) }}</sub>
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ $product->price_from }}
                                                                {{ $product->getcurrency($product->currency_id) }} -
                                                                {{ $product->price_to }}
                                                                {{ $product->getcurrency($product->currency_id) }} /
                                                                <sub>{{ $product->getunit($product->unit) }}</sub>
                                                            </span>
                                                        @endif

                                                    @else
                                                        <span class="priceprtTxt">
                                                            <a href="{{ route('product.show', $product->slug) }}"
                                                                style="color:#264b72;" target="_blank">
                                                                Ask For Price
                                                            </a>
                                                        </span>
                                                    @endif

                                                    <small>{{ $product->MOQ }} {{ $product->getunit($product->unit) }}
                                                        min
                                                        order</small>
                                                    <p>{{ $product->getcompanyNameByProdcut($product->id) }}</p>
                                                    <a href="{{ route('product.show', $product->slug) }}"> <button
                                                            class="viewbtn">VIEW and inquire</button> </a>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {!! $categories->appends(Request::except('page'))->render() !!}
                                @else
                                    <p>There is no product in this category</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
