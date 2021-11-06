<!--@extends('layouts.appsecond')-->


@section('content')

    <section class="bannerPrt">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="side-nav active">
                        <div class="categories-links">
                            @php($count = 1)
                                @foreach ($main_categorys as $main_cat)

                                    <div class="sidebarLink">
                                        <h2>
                                            <a href="product?category={{ $main_cat->slug }}">
                                                <img src="images/icon/menu-icon{{ $count }}.png" alt="icon">
                                                {{ $main_cat->name }}

                                            </a>
                                            <i><img src="images/icon/arrow.png" alt="icon"></i>
                                        </h2>
                                        <div class="menuSubMenu mCustomScrollbar">
                                            <div class="subFullsection">
                                                @foreach ($sub_categorys as $sub_cat)
                                                    @if ($sub_cat->parent == $main_cat->id)
                                                        <div class="panelSection">

                                                            @php($sub_sub_cat = $sub_cat->id)

                                                                <h3>
                                                                    <a href="product?category={{ $sub_cat->slug }}">
                                                                        {{ $sub_cat->name }}
                                                                    </a>
                                                                </h3>


                                                                @foreach ($sub_categorys as $sub_cat)
                                                                    @if ($sub_cat->parent == $sub_sub_cat)
                                                                        <h4>
                                                                            <a href="product?category={{ $sub_cat->slug }}">
                                                                                {{ $sub_cat->name }}
                                                                            </a>
                                                                        </h4>
                                                                    @endif
                                                                @endforeach

                                                                @php($sub_sub_cat = '')

                                                                </div>
                                                            @endif
                                                        @endforeach




                                                    </div>

                                                </div>

                                            </div>

                                            @php($count++)
                                            @endforeach



                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="banner">
                                        <div class="bannerslider">
                                            @foreach ($slider_image as $image)
                                                <div class="item">
                                                    <img src="images/{{ $image->img_url }}" alt="#" />
                                                    <div class="bannerTxt">
                                                        <h1 data-animation-in="fadeInUp" data-delay-in="0.3">{{ $image->text }}</span>
                                                        </h1>

                                                        <a href="product?category={{ $image->text2 }}" class="btn"
                                                            data-animation-in="fadeInUp" data-delay-in="0.5">INQUIRE NOW
                                                        </a>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="rightflexadd">
                                        <div class="rightaddsection">
                                            <a href="#">
                                                <img src="images/right-addimg1.png" alt="#" />
                                            </a>
                                        </div>
                                        <div class="rightaddsection margin20">
                                            <a href="#">

                                                <img src="images/right-addimg2.png" alt="#" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="topbodyprt">
                        <div class="container-fluid">
                            {{-- <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="javascript:void()">
                                            <img src="images/icon/customer-icon1.png" alt="icon">
                                            <div class="righticonTxt">
                                                <h3>Inquiry</h3>
                                                <p>Inquire for price</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="javascript:void()">
                                            <img src="images/icon/customer-icon2.png" alt="icon">
                                            <div class="righticonTxt">
                                                <h3>Receive quotation</h3>
                                                <p>Seller will send quote</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="javascript:void()">
                                            <img src="images/icon/customer-icon3.png" alt="icon">
                                            <div class="righticonTxt">
                                                <h3>Approve quotation</h3>
                                                <p>Seller receives Purchase Order</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="javascript:void()">
                                            <img src="images/icon/customer-icon4.png" alt="icon">
                                            <div class="righticonTxt">
                                                <h3>Order Fulfillment</h3>
                                                <p>Manage Delivery and Payment</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="#">
                                            <!-- <img src="images/icon/customer-icon1.png" alt="icon"> -->
                                            <span class="blue">1</span>
                                            <div class="righticonTxt">
                                                <h3>Inquiry</h3>
                                                <p>Inquire for price</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="#">
                                            <!-- <img src="images/icon/customer-icon2.png" alt="icon"> -->
                                            <span class="orenge">2</span>
                                            <div class="righticonTxt">
                                                <h3>Receive quotation</h3>
                                                <p>Seller will send quote</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="#">
                                            <!-- <img src="images/icon/customer-icon3.png" alt="icon"> -->
                                            <span class="green">3</span>
                                            <div class="righticonTxt">
                                                <h3>Approve quotation</h3>
                                                <p>Seller receives Purchase Order</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <div class="practiceareaPrt">
                                        <a href="#">
                                            <!-- <img src="images/icon/customer-icon4.png" alt="icon"> -->
                                            <span class="yellow">4</span>
                                            <div class="righticonTxt">
                                                <h3>Order Fulfillment</h3>
                                                <p>Manage Delivery and Payment</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="browse-categoryprt">
                                <h2 class="heading">Browse By Categories</h2>

                                <div class="browsesliderprt" id="browse">
                                    <div class="slider browseSlider">
                                        @foreach ($main_categorys as $category)
                                            <div>
                                                <div class="category-panel">
                                                    <div class="topimgsection">
                                                        <a href="product?category={{ $category->slug }}">
                                                            <img src="images/{{ $category->thumbs_url }}" alt="img">
                                                        </a>

                                                    </div>
                                                    <div class="lowerTxtprt text-center">
                                                        <h3><a href="product?category={{ $category->slug }}">
                                                                {{ $category->name }}</a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                @stop
