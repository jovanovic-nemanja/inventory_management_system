<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-size: 16px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />

    <title>{{ $general_setting->site_name }}</title>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('design/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/fonts/Linearicons/Linearicons/Font/demo-files/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/owl-carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/owl-carousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/lightGallery-master/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('design/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('design/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('design/css/furniture.css') }}">
    <style>
        .fa {
            font-size: 25px;
        }

        .checked {
            color: orange;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Header -->
        <header class="header header--furniture" data-sticky="true">
            <div class="header__top">
                <div class="container" style="align-items: center;">
                    <div class="header__left">
                        <a class="ps-logo" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo2_1.png') }}" alt="" style="width: 130px;">
                        </a>
                        <div class="menu--product-categories">
                            <div class="menu__toggle"><i class="icon-menu"></i><span> Shop by Category</span></div>
                            <div class="menu__content">
                                <ul class="menu--dropdown">
                                    @foreach($categorys as $category)
                                        <li>
                                            <a href="{{ route('product.index', 'category='.$category->slug) }}"> {{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="header__center">
                        <form class="ps-form--quick-search" action="{{ route('product.index') }}" method="GET">
                            <div class="form-group--icon"><i class="icon-chevron-down"></i>
                                <select name="category" id="category" class="form-control">
                                    <option value="">All</option>
                                    @foreach($categorys as $category)
                                        <option value="{{ $category->slug }}" {{ app('request')->input('category') == $category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="form-control" type="text" name="word" placeholder="I'm looking for...">
                            <button>Search </button>
                        </form>
                    </div>
                    <div class="header__right">
                        <div class="header__actions">
                            <!-- <a class="header__extra" href="#">
                                <i class="icon-heart"></i>
                                <span>
                                    <i>0</i>
                                </span>
                            </a>
                            <div class="ps-cart--mini">
                                <a class="header__extra" href="#">
                                    <i class="icon-bag2"></i>
                                    <span>
                                        <i>0</i>
                                    </span>
                                </a>
                                <div class="ps-cart__content">
                                    <div class="ps-cart__items">
                                        <div class="ps-product--cart-mobile">
                                            <div class="ps-product__thumbnail">
                                                <a href="#">
                                                    <img src="img/products/clothing/7.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="ps-product__content">
                                                <a class="ps-product__remove" href="#">
                                                    <i class="icon-cross"></i>
                                                </a>
                                                <a href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                                <p>
                                                    <strong>Sold by:</strong> YOUNG SHOP
                                                </p>
                                                <small>1 x $59.99</small>
                                            </div>
                                        </div>
                                        <div class="ps-product--cart-mobile">
                                            <div class="ps-product__thumbnail"><a href="#"><img src="img/products/clothing/5.jpg" alt=""></a></div>
                                            <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a><a href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                                <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-cart__footer">
                                        <h3>Sub Total:<strong>$59.99</strong></h3>
                                        <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
                                    </div>
                                </div>
                            </div> -->
                            <div class="ps-block--user-header">
                                <div class="ps-block__left"><i class="icon-user"></i></div>
                                @guest
                                    <div class="ps-block__right">
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                        <a href="{{ route('emailverify') }}">{{ __('Join') }}</a>
                                    </div>
                                @else
                                    <div class="ps-block__right">
                                        <a href="{{ route('account') }}">{{ __('Account') }}</a>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}({{ Auth::user()->name }})</a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endguest  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navigation">
                <div class="container">
                    <div class="navigation__left">
                        <ul class="menu menu--furniture" style="width: max-content;">
                            <li class="menu-item">
                                <a href="{{ route('product.index', 'category=food') }}">Food</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('product.index', 'category=hospitality') }}">Hospitality</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('product.index', 'category=auto') }}">Auto</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('product.index', 'category=petrochemical') }}">Petrochemical</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('product.index', 'category=medical') }}">Medical</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        <div class="navigation__right ml-auto">
                            <ul class="navigation__extra">
                                @auth
                                    @if(auth()->user()->hasRole('admin'))
                                        <li>
                                            <a href="{{ route('dashboard.index') }}">Dashboard({{ $roles[0]->name }})</a>
                                        </li>
                                    @endif

                                    @if(auth()->user()->hasRole('manager'))
                                        <li>
                                            <a href="{{ route('managesellers.index') }}">Dashboard({{ $roles[0]->name }})</a>
                                        </li>
                                    @endif

                                    @if(auth()->user()->hasRole('seller'))
                                        <li>
                                            <a href="{{ route('sellerdashboard.index') }}">Dashboard({{ $roles[0]->name }})</a>
                                        </li>
                                    @endif

                                    @if(auth()->user()->hasRole('buyer'))
                                        <li>
                                            <a href="{{ route('buyerdashboard.index') }}">Dashboard({{ $roles[0]->name }})</a>
                                        </li>
                                    @endif
                                @endauth

                                @auth
                                    @if(auth()->user()->hasRole('buyer'))
                                        <li>
                                            <a href="{{ route('request.sendrequest', 'null') }}">Request</a>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <header class="header header--mobile furniture" data-sticky="true">
            <div class="navigation--mobile">
                <div class="navigation__left">
                    <a class="ps-logo" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo2_1.png') }}" alt="" style="width: 130px;">
                    </a>
                </div>
                <div class="navigation__right">
                    <div class="header__actions">
                        <div class="ps-block--user-header">
                            <div class="ps-block__left"><i class="icon-user"></i></div>
                            @guest
                                <div class="ps-block__right">
                                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    <a href="{{ route('emailverify') }}">{{ __('Join') }}</a>
                                </div>
                            @else
                                <div class="ps-block__right">
                                    <a href="{{ route('account') }}">{{ __('Account') }}</a>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}({{ Auth::user()->name }})</a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-search--mobile">
                <form class="ps-form--search-mobile" action="{{ route('product.index') }}" method="GET">
                    <div class="form-group--nest">
                        <input class="form-control" type="text" name="word" placeholder="Search something...">
                        <button><i class="icon-magnifier"></i></button>
                    </div>
                </form>
            </div>
        </header>

        <div class="ps-panel--sidebar" id="navigation-mobile">
          <div class="ps-panel__header">
            <h3>Categories</h3>
          </div>
          <div class="ps-panel__content">
            <ul class="menu--mobile">
              @foreach($categorys as $category)
                <li>
                  <a href="{{ route('product.index', 'category='.$category->slug) }}">{{ $category->name }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="navigation--list">
          <div class="navigation__content">
            <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile">
              <i class="icon-menu"></i>
              <span> Menu</span>
            </a>

            <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile">
              <i class="icon-list4"></i>
              <span> Categories</span>
            </a>

            <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar">
              <i class="icon-magnifier"></i>
              <span> Search</span>
            </a>
          </div>
        </div>
        <div class="ps-panel--sidebar" id="search-sidebar">
            <div class="ps-panel__header">
                <form class="ps-form--search-mobile" action="{{ route('product.index') }}" method="GET">
                    <div class="form-group--nest">
                        <input class="form-control" type="text" name="word" placeholder="Search something...">
                        <button><i class="icon-magnifier"></i></button>
                    </div>
                </form>
            </div>
            <div class="navigation__content"></div>
        </div>
        <div class="ps-panel--sidebar" id="menu-mobile">
            <div class="ps-panel__header">
                <h3>Menu</h3>
            </div>
            <div class="ps-panel__content">
                <ul class="menu--mobile">
                    <li class="menu-item">
                        <a href="{{ route('product.index', 'category=food') }}">Food</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('product.index', 'category=hospitality') }}">Hospitality</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('product.index', 'category=auto') }}">Auto</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('product.index', 'category=petrochemical') }}">Petrochemical</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('product.index', 'category=medical') }}">Medical</a>
                    </li>
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <li class="menu-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard({{ $roles[0]->name }})</a>
                            </li>
                        @endif

                        @if(auth()->user()->hasRole('manager'))
                            <li class="menu-item">
                                <a href="{{ route('managesellers.index') }}">Dashboard({{ $roles[0]->name }})</a>
                            </li>
                        @endif

                        @if(auth()->user()->hasRole('seller'))
                            <li class="menu-item">
                                <a href="{{ route('sellerdashboard.index') }}">Dashboard({{ $roles[0]->name }})</a>
                            </li>
                        @endif

                        @if(auth()->user()->hasRole('buyer'))
                            <li class="menu-item">
                                <a href="{{ route('buyerdashboard.index') }}">Dashboard({{ $roles[0]->name }})</a>
                            </li>
                        @endif
                    @endauth

                    @auth
                        @if(auth()->user()->hasRole('buyer'))
                            <li class="menu-item">
                                <a href="{{ route('request.sendrequest', 'null') }}">Request</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>

        @yield('content')

        <div id="back2top" style="display: block;"><i class="fa fa-angle-up"></i></div>
        <div class="ps-site-overlay"></div>
        <div id="loader-wrapper">
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <div class="ps-search" id="site-search"><a class="ps-btn--close" href="#"></a>
            <div class="ps-search__content">
                <form class="ps-form--primary-search" action="do_action" method="post">
                    <input class="form-control" type="text" placeholder="Search for...">
                    <button><i class="aroma-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <div class="modal fade" id="product-quickview" tabindex="-1" role="dialog" aria-labelledby="product-quickview" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"><span class="modal-close" data-dismiss="modal"><i class="icon-cross2"></i></span>
                    <article class="ps-product--detail ps-product--fullwidth ps-product--quickview">
                        <div class="ps-product__header">
                            <div class="ps-product__thumbnail" data-vertical="false">
                                <div class="ps-product__images" data-arrow="true">
                                    <div class="item"><img src="{{ asset('design/img/products/detail/fullwidth/1.jpg') }}" alt=""></div>
                                    <div class="item"><img src="{{ asset('design/img/products/detail/fullwidth/2.jpg') }}" alt=""></div>
                                    <div class="item"><img src="{{ asset('design/img/products/detail/fullwidth/3.jpg') }}" alt=""></div>
                                </div>
                            </div>
                            <div class="ps-product__info">
                                <h1>Marshall Kilburn Portable Wireless Speaker</h1>
                                <div class="ps-product__meta">
                                    <p>Brand:<a href="shop-default.html">Sony</a></p>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>(1 review)</span>
                                    </div>
                                </div>
                                <h4 class="ps-product__price">$36.78 – $56.99</h4>
                                <div class="ps-product__desc">
                                    <p>Sold By:<a href="shop-default.html"><strong> Go Pro</strong></a></p>
                                    <ul class="ps-list--dot">
                                        <li> Unrestrained and portable active stereo speaker</li>
                                        <li> Free from the confines of wires and chords</li>
                                        <li> 20 hours of portable capabilities</li>
                                        <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                        <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                    </ul>
                                </div>
                                <div class="ps-product__shopping"><a class="ps-btn ps-btn--black" href="#">Add to cart</a><a class="ps-btn" href="#">Buy Now</a>
                                    <div class="ps-product__actions"><a href="#"><i class="icon-heart"></i></a><a href="#"><i class="icon-chart-bars"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>

        @include('component.footer')

    </div>

    <flash-message message="{{ session('flash') }}" />

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('design/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('design/plugins/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('design/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('design/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('design/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('design/plugins/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('design/plugins/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('design/plugins/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('design/plugins/jquery.matchHeight-min.js') }}"></script>
    <script src="{{ asset('design/plugins/slick/slick/slick.min.js') }}"></script>
    <script src="{{ asset('design/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('design/plugins/slick-animation.min.js') }}"></script>
    <script src="{{ asset('design/plugins/lightGallery-master/dist/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('design/plugins/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('design/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('design/plugins/gmap3.min.js') }}"></script>
    <!-- custom scripts-->
    <script src="{{ asset('design/js/main.js') }}"></script>
    
    <!-- custom js: request for quotation -->
    <script src="{{ asset('js/rfq.js') }}"></script>

    @yield('script')
</body>
</html>
