@extends('layouts.appsecond')

@section('content')

<div id="homepage-8">
    <div class="ps-vendor-banner bg--cover" data-background="{{ asset('design/img/bg/vendor.jpg') }}">
        <div class="container">
            <h2 style="background: rgba(0, 0, 0, 0.5);">Find your Business products from Reliable Suppliers</h2><a class="ps-btn ps-btn--lg" href="{{ route('product.index') }}">Products</a>
        </div>
    </div>
    <div class="ps-site-features">
        <div class="container">
            <div class="ps-block--site-features ps-block--site-features-2">
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-rocket"></i></div>
                    <div class="ps-block__right">
                        <h4>Fast Delivery</h4>
                        <p>For all orders within UAE</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-sync"></i></div>
                    <div class="ps-block__right">
                        <h4>Return Policies</h4>
                        <p>For any defects</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-credit-card"></i></div>
                    <div class="ps-block__right">
                        <h4>Secure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                </div>
                <div class="ps-block__item">
                    <div class="ps-block__left"><i class="icon-bubbles"></i></div>
                    <div class="ps-block__right">
                        <h4>24/7 Support</h4>
                        <p>Dedicated support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section--vendor ps-vendor-about">
        <div class="container">
            <div class="ps-section__header">
                <p>Why Buy / Sell On MamboDubai.com</p>
                <h4>Join our marketplace and connect with verified Sellers and Buyers through an amazing supply chain application that makes Trading Easy.</h4>
            </div>
            <div class="ps-section__content">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--icon-box-2">
                            <div class="ps-block__thumbnail"><img src="{{ asset('design/img/icons/vendor-1.png') }}" alt=""></div>
                            <div class="ps-block__content">
                                <h4>Low Fees</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                    <p>It doesn’t take much to list your items and once you make a sale, Our transactional commission is nominal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--icon-box-2">
                            <div class="ps-block__thumbnail"><img src="{{ asset('design/img/icons/vendor-2.png') }}" alt=""></div>
                            <div class="ps-block__content">
                                <h4>Powerful Tools</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                    <p>Our online tools and services make it easy to manage and promote your products.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block--icon-box-2">
                            <div class="ps-block__thumbnail"><img src="{{ asset('design/img/icons/vendor-3.png') }}" alt=""></div>
                            <div class="ps-block__content">
                                <h4>Support 24/7</h4>
                                <div class="ps-block__desc" data-mh="about-desc">
                                    <p>Our tools and services make it easy to manage, promote and grow your business.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section--vendor ps-vendor-milestone">
        <div class="container">
            <div class="ps-section__header" style="padding-bottom: 0px;">
                <p>How it works</p>
                <h4>Easy to start selling online on Mambo just 4 simple steps</h4>
            </div>
            <div class="ps-section__content" style="text-align: center;">
                <a style="font-size: medium; color: #476b91;" href="{{ route('howtoworks.index') }}">Learn More</a>
            </div>
        </div>
    </div>
    <div class="ps-home-trending-products ps-section--furniture" style="padding: 100px 0 100px 0;">
        <div class="container">
            <div class="ps-section__header">
                <h3>LASTEST PRODUCTS</h3>
            </div>
            <div class="ps-section__content">
              <div class="row">
                @if($products)
                  @foreach($products as $product)
                    <div class="col-md-3">
                        <div style="border: 1px solid; padding: 3%; margin-bottom: 4%; border-radius: 3px;">
                            <div class="ps-product__thumbnail">
                                <a href="{{ route('product.show', $product->slug) }}">
                                <img src="{{ asset('uploads/') }}/{{ $product->thumbnailUrl() }}" alt="" style="object-fit: cover; width: 100%; height: 165px;">
                                </a>
                            </div>
                            <div class="ps-product__container">
                                <div class="ps-product__content">
                                    <a class="ps-product__title" href="{{ route('product.show', $product->slug) }}">{{ str_limit($product->name, 20, '...') }}</a><br>
                                    <a class="ps-product__vendor" href="{{ url('/purchaseorders/userreview', $product->user_id) }}">{{ $product->getUsername($product->user_id) }}</a><br>
                                    Company: <a class="ps-product__vendor" href="{{ url('/purchaseorders/userreview', $product->user_id) }}">{{ $product->getcompanyName($product->user_id) }}</a>
                                    <p class="ps-product__price">{{ number_format(round($product->price_from, 3, PHP_ROUND_HALF_UP), 2) }} ~ {{ number_format(round($product->price_to, 3, PHP_ROUND_HALF_UP), 2) }} {{ $localization_setting->currency }}/piece</p>
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
    <br>
    <div class="ps-vendor-banner bg--cover" data-background="{{ asset('design/img/bg/vendor.jpg') }}">
        <div class="container">
            <h2 style="background: rgba(0, 0, 0, 0.5);">Join our marketplace and connect with verified Sellers and Buyers through an amazing supply chain application that makes Trading Easy.</h2>
            <a class="ps-btn ps-btn--lg" href="{{ route('emailverify') }}">Join as Buyer</a>
            <a class="ps-btn ps-btn--lg" style="background-color: #E48582;" href="{{ route('emailverifyseller') }}">Join as Seller</a>
        </div>
    </div>
</div>

@stop
