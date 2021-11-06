<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="font-size: 16px;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">

    <?php if ($__env->yieldContent('main_title')) { ?>
    <title>
        @php
            echo ucwords(strtolower($__env->yieldContent('main_title')));
        @endphp

    </title>

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="@yield('description')" />

    <meta name="twitter:card" content="@yield('title')" />
    <meta name="twitter:site" content="@MamboDubai" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />

    <meta name="title" content="@yield('title')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <?php } else { ?>
    <title>
        @php
            echo ucwords(strtolower($general_setting->site_name));
        @endphp
    </title>

    <meta name="title" content="{{ $general_setting->meta_title }}">
    <meta name="keywords" content="{{ $general_setting->meta_keywords }}">
    <meta name="description" content="{{ $general_setting->meta_description }}">

    <meta property="og:title" content="@php
        echo ucwords(strtolower($__env->yieldContent('main_title')));
    @endphp" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:description" content="@yield('description')" />

    <meta name="twitter:card" content="@php
        echo ucwords(strtolower($__env->yieldContent('main_title')));
    @endphp" />
    <meta name="twitter:site" content="@mambodubai" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />

    <?php } ?>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/bootstrap.min.css') }}">

    <!-- font css -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/font-awesome.min.css') }}">-->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- animation css -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/aos.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">


    <!-- crousel css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/slick-theme.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />
    <!-- Custom Scrollbar Css -->
    <link type="text/css" href="{{ asset('newdesign/css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"
        rel="stylesheet">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/main.css') }}">


    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/responsive.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta/dist/css/bootstrap-select.min.css">


    <!-- Image uploader-->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="{{ asset('newdesign/css/image-uploader.min.css') }}">
    <script src="{{ asset('newdesign/js/jquery.min.js') }}" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1160221851065141');
        fbq('track', 'PageView');

    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=1160221851065141&ev=PageView
&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
    <meta name="facebook-domain-verification" content="52ujk8iipxepsb7hms1v2pldpz9bcr" />

</head>

<body>

    <div id="app">
        <header id="banner" class="fixed-header">
            <div class="top_header">
                <div class="container-fluid">
                    <div class="inner_upheader" style=" min-height:8px;">
                        {{-- <p><img src="{{ asset('newdesign/images/icon/welcome.png') }}" alt="icon" />We welcome you to
                            MamboDubai.com</p> --}}
                        <div class="righticonprt">

                            {{-- <div class="dropdown">
                                    <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <img src="{{ asset('newdesign/images/icon/help.png') }}" alt="icon" />
                                        <span>Help & Support</span>
                                    </a>
                                    <div class="dropdown-menu leftdrop" aria-labelledby="dropdownMenuButton">
                                        We provide the opportunity for you to negotiate your requests for information and quotations with our sellers
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <img src="{{ asset('newdesign/images/icon/offer.png') }}" alt="icon" />
                                        <span>Special offers & exclusive deals</span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        Get special offers and exclusive details from our verified sellers.
                                    </div>
                                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="down-header">
                <div class="container-fluid">
                    <div class="inner-downheader">
                        <div class="logoprt">
                            <a href="#" class="sidetogglebtn">
                                <img src="{{ asset('newdesign/images/icon/toggle.png') }}" alt="menu-icon">
                            </a>


                            <a href="/" class="logo">
                                <img src="{{ asset('newdesign/images/logo.png') }}" alt="logo">
                            </a>
                        </div>

                        <div class="rightSearchpanel">
                            <div class="for-web-version">
                                <form action="{{ route('product.search') }}" method="GET">

                                    <div class="searchprt">

                                        <div class="searchinputarea">
                                            <div class="leftinputTxt">
                                                <input type="text" name="word"
                                                    value="{{ app('request')->input('word') != '' ? app('request')->input('word') : '' }}"
                                                    placeholder="What are you looking for?" />
                                            </div>

                                            <select name="category" id="category">
                                                <option value="all">All</option>
                                                @foreach ($categorys as $category)
                                                    <option name="category" value="{{ $category->slug }}"
                                                        {{ app('request')->input('category') == $category->slug ? 'selected' : '' }}>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <button class="search" type="submit">
                                            <img src="{{ asset('newdesign/images/icon/search.png') }}" alt="search">
                                        </button>

                                    </div>
                                </form>
                            </div>

                            <!-- FOR MOBILE VERSION START-->

                            <div class="for-Mob-version">
                                <form action="{{ route('product.search') }}" method="GET">
                                    @csrf
                                    <div class="searchdrop">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <div class="dropdown-search">
                                        <div class="searchprt">
                                            <div class="searchinputarea">
                                                <div class="leftinputTxt">
                                                    <input type="text" name="word"
                                                        value="{{ app('request')->input('word') != '' ? app('request')->input('word') : '' }}"
                                                        placeholder="What are you looking for?" />
                                                </div>

                                                <select name="category" id="category">
                                                    <option value="all">All</option>
                                                    @foreach ($categorys as $category)
                                                        <option name="category" value="{{ $category->slug }}"
                                                            {{ app('request')->input('category') == $category->name ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <button class="search" type="submit">
                                                <img src="{{ asset('newdesign/images/icon/search.png') }}"
                                                    alt="search">
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- FOR MOBILE VERSION END-->





                            <div class="userloginSec">
                                <ul>
                                    @guest


                                        <li>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#logpopup">
                                                <img src="{{ asset('newdesign/images/icon/user.png') }}" alt="user">
                                                <span>Login / Register</span>
                                            </a>

                                        </li>
                                    @else

                                        <!-- AFTER LOGIN -->

                                        <li>
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="{{ asset('images/icon/user.png') }}" alt="user">
                                                <span>
                                                    @php
                                                        $first_name = preg_split('/[\s,]+/', Auth::user()->name);
                                                    @endphp
                                                    {{ $first_name[0] }}
                                                    (
                                                    @if (auth()->user()->hasRole('buyer'))
                                                        Buyer
                                                    @else
                                                        Seller
                                                    @endif
                                                    )
                                                </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <ul>
                                                    @if (auth()->user()->hasRole('buyer'))
                                                        <li>
                                                            <a href="{{ route('buyerdashboard.index') }}"><i
                                                                    class="fa fa-server"></i> Dashboard
                                                            </a>
                                                        </li>
                                                        <li>
                                                        <a href="{{ route('account') }}"><i
                                                                class="fa fa-address-card-o"></i> My Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('changepass') }}">
                                                            <i class="fa fa-address-card-o"></i>Change Password
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @if (auth()->user()->hasRole('seller'))
                                                        <li>
                                                            <a href="{{ route('sellerdashboard.index') }}"><i
                                                                    class="fa fa-server"></i> Dashboard </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('product.my') }}"><i
                                                                    class="fa fa-database"></i> Products
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('request.index') }}"><i
                                                                class="fa fa-question-circle"></i> Request
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('quote.index') }}"><i
                                                                class="fa fa-sticky-note-o"></i> Quotes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('purchaseorders.index') }}"><i
                                                                class="fa fa-shopping-cart"></i> Purchase Order
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('purchaseorders.create') }}"><i
                                                                class="fa fa-check-circle"></i> Completed Order
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('achieved.index') }}"><i
                                                                class="fa fa-tags"></i>
                                                            Archieved Quotes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('requestcallback.index') }}"><i
                                                                class="fa fa-phone"></i> Request Call Back
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('logout') }}"
                                                            onClick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                                class="fa fa-power-off"></i> Logout</a>

                                                    </li>

                                                </ul>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>

                                        </li>
                                    @endguest
                                    <!-- AFTER LOGIN -->

                                   {{--
								    @guest
                                        <li>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#logpopup">
                                                <img src="{{ asset('newdesign/images/icon/message.png') }}"
                                                    alt="message">
                                            </a>

                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#logpopup">
                                                <img src="{{ asset('newdesign/images/icon/request.png') }}"
                                                    alt="request">
                                            </a>

                                        </li>
                                    @else
                                        <li>
                                            <a href="request">
                                                <img src="{{ asset('newdesign/images/icon/message.png') }}"
                                                    alt="message">
                                            </a>

                                        </li>
                                        <li>
                                            <a href="requestcallback">
                                                <img src="{{ asset('newdesign/images/icon/request.png') }}"
                                                    alt="request">
                                            </a>

                                        </li>
                                        @endif
										--}}
                                    </ul>
                                </div>

                            </div>




                            <div class="side-nav">

                                <button type="button" class="closebtn sidemenuclose ml-auto">×</button>
                                <div class="mobile-links-section">
                                    <div class="categories-links mCustomScrollbar">
                                        <div class="categories_link_toggle">


                                            <div class="mobile_link_toggle d-md-block position-relative">


                                                @php($count = 1)
                                                    @foreach ($main_categorys as $main_cat)

                                                        <div class="mobile-link" id="subFullsection-{{ $main_cat->id }}">
                                                            <h2>
                                                                <a href="./../../product?category={{ $main_cat->slug }}">
                                                                    <img src="{{ asset('images/icon/menu-icon' . $count . '.png') }}"
                                                                        alt="icon">
                                                                    {{ $main_cat->name }}

                                                                </a>
                                                                <i id="subFullsectionMobile-{{ $main_cat->id }}"><img
                                                                        src="{{ asset('images/icon/arrow.png') }}"
                                                                        alt="icon"></i>
                                                            </h2>
                                                        </div>
                                                        @php($count++)
                                                        @endforeach

                                                    </div>

                                                </div>
                                            </div>



                                            @foreach ($main_categorys as $main_cat1)
                                                <div class="category-submenu mCustomScrollbar"
                                                    id="newsubFullsection-{{ $main_cat1->id }}">
                                                    <div class="subFullsection">
                                                        <button type="button" class="subclosebtn sidemenuclose ml-auto">×</button>
                                                        @foreach ($sub_categorys as $sub_cat)



                                                            @if ($sub_cat->parent == $main_cat1->id)
                                                                @php($sub_sub_cat = $sub_cat->id)
                                                                    <div class="submenu-section">
                                                                        <h2 class="submenu-section-title">
                                                                            <a href="./../../product?category={{ $sub_cat->slug }}">
                                                                                {{ $sub_cat->name }} </a>
                                                                        </h2>
                                                                        @foreach ($sub_categorys as $sub_cat)
                                                                            @if ($sub_cat->parent == $sub_sub_cat)
                                                                                <h3 class="submenu-section-link">
                                                                                    <a
                                                                                        href="./../../product?category={{ $sub_cat->slug }}">
                                                                                        {{ $sub_cat->name }} </a>
                                                                                </h3>
                                                                            @endif
                                                                        @endforeach

                                                                        @php($sub_sub_cat = '')
                                                                        </div>


                                                                    @endif

                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overlay"></div>
                            </header>

                            <div class="breadcamp">
                                <div class="container-fluid">
                                    <a href="/">Home </a>/
                                    @if (auth()->user()->hasRole('buyer'))
                                        <a href="/buyerdashboard">Dashboard </a>/
                                    @endif
                                    @if (auth()->user()->hasRole('seller'))
                                        <a href="/sellerdashboard">Dashboard </a>/
                                    @endif
                                    {{ $page }}
                                </div>
                            </div>
                            <div class="category-body margin50">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-2 d-none d-sm-block">
                                            <div class="leftcatprt acountList">
                                                <ul class="acountListing">
                                                    @if (auth()->user()->hasRole('buyer'))
                                                        <li>
                                                            <a href="{{ route('buyerdashboard.index') }}"> <i class="fa fa-server"></i>
                                                                Dashboard
                                                            </a>
                                                        </li>
                                                        <li>
                                                        <a href="{{ route('account') }}">
                                                            <i class="fa fa-address-card-o"></i> My Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('changepass') }}">
                                                            <i class="fa fa-address-card-o"></i>Change Password
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @if (auth()->user()->hasRole('seller'))
                                                        <li>
                                                            <a href="{{ route('sellerdashboard.index') }}"> <i class="fa fa-server"></i>
                                                                Dashboard </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('product.my') }}">
                                                                <i class="fa fa-database"></i> Products
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('request.index') }}">
                                                            <i class="fa fa-question-circle-o"></i> Request
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('quote.index') }}">
                                                            <i class="fa fa-sticky-note-o"></i> Quotes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('purchaseorders.index') }}">
                                                            <i class="fa fa-shopping-cart"></i> Purchase Order
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('purchaseorders.create') }}">
                                                            <i class="fa fa-check-circle"></i> Completed Order
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('achieved.index') }}">
                                                            <i class="fa fa-tags"></i> Archieved Quotes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('requestcallback.index') }}">
                                                            <i class="fa fa-phone"></i> Request Call Back
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="downaddprt">
                                                {{-- <a href="#">
                                                    <img src="{{ asset('images/listing-ad.jpg') }}" alt="addimg" />
                                                </a>
                                                <a href="#">
                                                    <img src="{{ asset('images/listing-ad2.jpg') }}" alt="addimg" />
                                                </a> --}}
                                            </div>
                                        </div>
                                        @guest
                                        @else
                                            <?php if (empty($single_user_detail->company_name) ||
                                            empty($single_user_detail->name) || empty($single_user_detail->currency)) {

                                            Session::flash('message', 'danger|Please complete your profile first before adding products!');
                                            $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                            if ($actual_link != 'https://mambodubai.com/account') {
                                            header('Location: https://mambodubai.com/account');
                                            die();
                                            }
                                            ?>
                                            @yield('content')
                                            <?php
                                            } else {
                                            ?>
                                            @yield('content')
                                            <?php
                                            } ?>
                                        @endguest
                                    </div>
                                </div>
                            </div>


                            @include('component.footer')

                        </div>

                        <flash-message message="{{ session('flash') }}" />



                        <script src="{{ asset('newdesign/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript">
                        </script>
                        <script src="{{ asset('newdesign/js/slick.js') }}" type="text/javascript" charset="utf-8"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
                        <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js" type="text/javascript"
                            charset="utf-8"></script>


                        <!-- animation js -->
                        <script src="{{ asset('newdesign/js/aos.js') }}" type="text/javascript"></script>


                        <!-- custom js -->
                        <script src="{{ asset('newdesign/js/main.js') }}" type="text/javascript"></script>

                        <script src="{{ asset('newdesign/js/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>

                        <!-- Latest compiled and minified JavaScript -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta/dist/js/bootstrap-select.min.js"></script>

                        <!--// Imgae Uploader-->

                        <script type="text/javascript" src="{{ asset('newdesign/js/image-uploader.min.js') }}"></script>
                        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

                        <!--Chart JS-->
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>>
                        </script>
                        <!--Chart Circle-->
                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/circles/0.0.6/circles.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {

                                $("#disputeBtn").click(function(e) {

                                    $("#acceptForm").css('display', 'none');
                                    $("#disputeForm").css('display', 'contents');

                                });
                                $("#disputeBack").click(function(e) {

                                    $("#acceptForm").css('display', 'contents');
                                    $("#disputeForm").css('display', 'none');

                                });

                                $('#payment_status_change').validate({

                                    rules: {
                                        delivery_status: {
                                            required: true
                                        },
                                        termsCondition: {
                                            required: true
                                        },
                                    }

                                });
                                $('#disputeForm').validate({

                                    rules: {
                                        buyer_delivery_information: {
                                            required: true
                                        },
                                        disputeTermsCondition: {
                                            required: true
                                        },
                                    }

                                });
                                $('#acceptForm').validate({

                                    rules: {
                                        termsCondition: {
                                            required: true
                                        },
                                    }

                                });


                            });

                        </script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#loginBtn").click(function(e) {
                                    $("#loginBtn").text('Login Processing');
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    e.preventDefault();
                                    var email = $("input[name='user_email']").val();
                                    var password = $("input[name='user_password']").val();
                                    $.ajax({
                                        url: '{{ route('login') }}',
                                        type: 'POST',
                                        data: {
                                            email: email,
                                            password: password
                                        },
                                        success: function(data) {

                                            if ($.isEmptyObject(data.error)) {
                                                location.reload();
                                            } else {
                                                printErrorMsg(data.error);
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            $("#loginBtn").text('LOGIN');
                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                            $('#errmsg').text('Sorry Invalid login !');
                                        }
                                    });
                                });
                                $("#joinBtn").click(function(e) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    e.preventDefault();
                                    var role = $("input[name='user']").val();
                                    if (role == 'buyerprt') {
                                        var user_name = $("input[name='buyer_user_name']").val();
                                        var phone = $("input[name='buyer_phone']").val();
                                        var email = $("input[name='buyer_name']").val();
                                        var password = $("input[name='buyer_password']").val();
                                        var password_confirmation = $("input[name='buyer_password_confirmation']").val();
                                        role = 'buyer';
                                    } else {
                                        var user_name = $("input[name='seller_user_name']").val();
                                        var phone = $("input[name='seller_phone']").val();
                                        var email = $("input[name='seller_name']").val();
                                        var password = $("input[name='seller_password']").val();
                                        var password_confirmation = $("input[name='seller_password_confirmation']").val();
                                        role = 'seller';
                                    }

                                    $.ajax({
                                        url: '{{ route('emails.sendverifycode') }}',
                                        type: 'POST',
                                        data: {
                                            user_name: user_name,
                                            phone: phone,
                                            email: email,
                                            password: password,
                                            password_confirmation: password_confirmation,
                                            role: role
                                        },
                                        success: function(data) {
                                            alert('please check your mail');
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                            console.log(msg);
                                        }
                                    });
                                });
                                $("#resForQuota").click(function(e) {

                                    e.preventDefault();
                                    @guest
                                        $('#logpopup').modal('show');
                                    @else
                                        var qty = $('#quantity').val();
                                        $('#minimum_quantity').val(qty);
                                        $('#reqQutoPopup').modal('show');
                                    @endguest
                                });
                                $("#mblresForQuota").click(function(e) {

                                    e.preventDefault();
                                    @guest
                                        $('#logpopup').modal('show');
                                    @else
                                        var qty = $('#quantity').val();
                                        $('#minimum_quantity').val(qty);
                                        $('#reqQutoPopup').modal('show');
                                    @endguest
                                });
                                $(".productdelete").click(function(e) {
                                    e.preventDefault();
                                    var del_id = this.id;
                                    $('#delete-form').attr('action', './product/' + del_id);
                                    $('#delete-modal').modal('show');
                                });
                                $("#askForPrice").click(function(e) {
                                    e.preventDefault();
                                    @guest
                                        $('#logpopup').modal('show');
                                    @else
                                        var qty = $('#quantity').val();
                                        $('#minimum_quantity').val(qty);
                                        $('#reqQutoPopup').modal('show');
                                    @endguest
                                });
                                $("#reqSubmitBtn").click(function(e) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    e.preventDefault();
                                    var formData = $('#reqQutoPopup form').serializeArray();
                                    $('#reqQutoPopupFrm')[0].reset();
                                    $.ajax({
                                        url: '{{ route('request.store') }}',
                                        type: 'POST',
                                        data: {
                                            product_id: formData[0].value,
                                            unit: formData[1].value,
                                            req_quantity: formData[2].value,
                                            volume: formData[3].value,
                                            port_of_destination: formData[4].value,
                                            description: formData[5].value,
                                            product_name: formData[6].value
                                        },
                                        success: function(data) {
                                            alert('Quotion submitted successfully');
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                            console.log(msg);
                                        }
                                    });
                                });
                                $("#callbackSubmitBtn").click(function(e) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    e.preventDefault();
                                    var formData = $('#normalpopup form').serializeArray();
                                    $('#normalpopupFrm')[0].reset();
                                    $.ajax({
                                        url: '{{ route('requestcallback.storeCallback') }}',
                                        type: 'POST',
                                        data: {
                                            product_id: formData[0].value,
                                            email_add: formData[1].value,
                                            name: formData[2].value,
                                            mobile: formData[3].value
                                        },
                                        success: function(data) {
                                            alert(data.msg);
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                            console.log(msg);
                                        }
                                    });
                                });
                            });

                        </script>

                        <script>
                            $(document).ready(function() {
                                $('#example').DataTable({
                                    "order": [
                                        [0, "desc"]
                                    ]
                                });
                                $('.selectpicker').selectpicker();
                                $('.delete-image').click(function() {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    if (confirm("Are you sure want to delete it ?")) {


                                        var id = this.id;
                                        $.ajax({
                                            url: '{{ route('product.deleteadditionalimage') }}',
                                            type: 'POST',
                                            data: {
                                                id: id
                                            },
                                            success: function(result) {
                                                $('#previd' + id).remove();
                                            }
                                        });
                                    }

                                });
                            });
                            $(function() {
                                var imagesPreview = function(input, placeToInsertImagePreview) {
                                    var ext = input.files[0].name.split(".");
                                    ext = ext[ext.length - 1].toLowerCase();
                                    var arrayExtensions = ["jpg", "jpeg", "png", "bmp", "gif"];

                                    if (arrayExtensions.lastIndexOf(ext) == -1) {
                                        alert("Wrong extension type.");
                                        $("#gallery-photo-add").val("");
                                        return false;
                                    }
                                    if (input.files[0].size > 2000000) {
                                        alert("Image too large");
                                        $("#gallery-photo-add").val("");
                                        return false;
                                    }
                                    if (input.files) {
                                        var filesAmount = input.files.length;
                                        for (i = 0; i < filesAmount; i++) {
                                            var reader = new FileReader();
                                            reader.onload = function(event) {
                                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                                    placeToInsertImagePreview);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }

                                };
                                $('#gallery-photo-add').on('change', function() {
                                    $(".gallery img:last-child").remove()
                                    imagesPreview(this, 'div.gallery');
                                });
                            });
                            $('.input-images-1').imageUploader();

                        </script>

                        <script>
                            $(document).ready(function() {
                                $('#alternativesideview').hide();
                                var prod_quantity = $('#prod_quantity').val();
                                $('#product_volume').val(prod_quantity);
                                $('.product_available').change(function() {
                                    if (this.value == '1') {

                                        $('#product_yes').css('display', 'contents');

                                        $('#product_available_no').prop('checked', 'false');
                                        $('#product_available_yes').prop('checked', 'true');
                                        $('#product_volume').val(prod_quantity);
                                        $('#alternative_product_price').val(0);
                                        $('#shipping_weight').val(0);
                                        $('#shipping_unit_price').val(0);
                                        $('#other_price').val(0);
                                        $('#other_price_desc').val('');
                                        $('#product_volume').val(0);
                                        $('#total_price').val(0);
                                        var avail_prod_unit_name = $('#avail_prod_unit_name').val();
                                        $("#prod_unit_name").text('Product Unit Price (' + avail_prod_unit_name + ') :');
                                        $("#prodname").text();
                                        $("#produnit").text();
                                        $("#prodvolume").text('Quantity :');
                                        $("#right_alter_total_weight").text('');
                                        $("#right_alter_weight").text('');
                                        $("#right_alter_total_ship_price").text('');
                                        $("#right_alter_unit").text('');
                                        $("#right_alter_unit_price").text('');



                                        $("#right_alter_subtotal").text('');
                                        $("#right_alter_total").text('');
                                        $("#alternate_prod_volume").text('');

                                        $('.alternate').hide();
                                        $('#main_product_desc').show();
                                        $('#sideview').show();
                                        $('#alternative_product_desc').hide();
                                        $('#alternativesideview').hide();
                                        $('#other_charge_box').css('display', 'none');
                                        $('#othertable').css('display', 'none');

                                    } else if (this.value == '0') {

                                        $('#product_yes').css('display', 'none');
                                        $('#shipping_yes').css('display', 'none');
                                        $('#others_yes').css('display', 'none');

                                        $("#product_available_yes").removeAttr('checked');
                                        $('#product_available_yes').prop('checked', 'false');
                                        $('#product_available_no').prop('checked', 'true');
                                        $("#alternative_product").val(['']);
                                        $("#prod_unit_name").text('Product Unit Price :');
                                        $("#prodname").text('Product Name : Alternative Product title');
                                        $("#produnit").text('Unit :');
                                        $('#alternative_product_price').val(0);
                                        $('#shipping_weight').val(0);
                                        $('#shipping_unit_price').val(0);
                                        $('#other_price').val(0);
                                        $('#other_price_desc').val('');
                                        $('#total_price').val(0);
                                        $('#main_product_desc').hide();
                                        $('#alternative_product_desc').show();
                                        // $('#alternativesideview').show();
                                        // $('#sideview').hide();
                                        $('#other_charge_box').css('display', 'none');
                                        $('#othertable').css('display', 'none');

                                        var currency = $('#currency').val();
                                        $('#shipping_yes').css('display', 'none');
                                        $('#others_yes').css('display', 'none');
                                        $("#shipping_unit").val('');
                                        $('#shipping_unit_price').val(0);

                                        var volume = $('#prod_quantity').val();
                                        var alternative_product_price = $('#alternative_product_price').val();
                                        var total = volume * alternative_product_price;

                                        $('#total_price').val(0);
                                        $('#vat').val(0);
                                        $('#vat_display').css('display', 'none');
                                        $('#vat_available_yes').prop('checked', 'false');
                                        $('#vat_available_no').prop('checked', 'false');



                                        $('#right_avail_unit').text('N/A');
                                        $('#right_avail_product_subtotal').text('N/A');
                                        $('#right_avail_weight').text('N/A');
                                        $('#right_avail_unit_price').text('N/A');
                                        $('#right_avail_subtotal').text('N/A');

                                        $('#right_avail_total_weight').text('N/A');
                                        $('#right_avail_total_ship_price').text('N/A');
                                        $('#right_avail_total_ship_price_sub').text('N/A');
                                        $('#other_charge_box').css('display', 'none');
                                        $('#othertable').css('display', 'none');
                                        $('#right_avail_other_display').css('display', 'none');
                                        $('#right_avail_total_other_display').css('display', 'none');
                                        $("#right_avail_total").text(0 + ' ' + currency);
                                    }
                                });
                                $('.shipping_available').change(function() {
                                    if (this.value == '1') {
                                        $('#shipping_yes').css('display', 'contents');
                                    } else if (this.value == '0') {
                                        var currency = $('#currency').val();
                                        $('#shipping_yes').css('display', 'none');
                                        $('#others_yes').css('display', 'none');
                                        $("#shipping_unit").val('');
                                        $('#shipping_unit_price').val(0);
                                        $('#shipping_weight').val(0);

                                        var volume = $('#prod_quantity').val();
                                        var alternative_product_price = $('#alternative_product_price').val();
                                        var total = volume * alternative_product_price;

                                        $('#total_price').val(total);
                                        $('#right_avail_total').text(total + ' ' + currency);
                                        x
                                        $('#right_avail_weight').text('N/A');
                                        $('#right_avail_unit_price').text('N/A');
                                        $('#right_avail_total_weight').text('N/A');
                                        $('#right_avail_total_ship_price').text('N/A');
                                        $('#right_avail_total_ship_price_sub').text('N/A');
                                        $('#other_charge_box').css('display', 'none');
                                        $('#othertable').css('display', 'none');
                                        $('#right_avail_other_display').css('display', 'none');
                                        $('#right_avail_total_other_display').css('display', 'none');
                                        $("#right_avail_total").text(check_val + ' ' + currency);




                                    }
                                });
                                $('.vat_available').change(function() {
                                    var currency = $('#currency').val();
                                    if (this.value == '1') {

                                        $('#vat_display').css('display', 'table-row');
                                        var prod_sub = $('#right_avail_subtotal').html();
                                        // var ship_sub = $('#right_avail_total_ship_price').html();


                                        var intStr1 = prod_sub.replace(/[A-Za-z$-]/g, "");

                                        // var intStr2 = ship_sub.replace(/[A-Za-z$-]/g, "");
                                        var intStr3 = 0;
                                        // if ($('.others_available').prop('checked')) {
                                        //     var other_sub = $('#right_avail_total_other').html();
                                        //     var intStr3 = other_sub.replace(/[A-Za-z$-]/g, "");
                                        // }
                                        // var total_price = parseInt(intStr1) + parseInt(intStr2) + parseInt(intStr3);
                                        var total_price = $('#total_price').val();
                                        // var total_price = parseFloat(intStr1);
                                        var vat_val = Number(total_price * 0.05).toFixed(2);
                                        $('#vat').val(vat_val);
                                        $('#vat_total').text(formatNumber(vat_val) + ' ' + currency);
                                        var total_price_vat = Number(parseFloat(total_price) + parseFloat(vat_val)).toFixed(
                                            2);
                                        $('#total_price').val(total_price_vat);
                                        $('#right_avail_total').text(formatNumber(total_price_vat) + ' ' + currency);

                                    } else if (this.value == '0') {
                                        var alternative_product_price = $('#alternative_product_price').val();
                                        var volume = $('#volume').val();
                                        var total = Number(parseFloat(alternative_product_price * volume)).toFixed(2);
                                        console.log(total);
                                        $('#total_price').val(total);
                                        $('#right_avail_total').text(formatNumber(total) + ' ' + currency);
                                        $('#vat').val(0);
                                        $('#vat_display').css('display', 'none');
                                    }
                                });
                                $('.others_available').change(function() {
                                    if (this.value == '1') {
                                        $('#others_yes').css('display', 'contents');
                                    } else if (this.value == '0') {
                                        var currency = $('#currency').val();
                                        $('#others_yes').css('display', 'none');
                                        var total = $('#total_price').val();
                                        var other_price = $('#other_price').val();
                                        var vat = $('#vat').val();
                                        if (total > 0) {
                                            if (other_price == '') {
                                                other_price = 0;
                                            }
                                            var check_val = parseFloat(total) - (parseFloat(other_price) + parseFloat(vat));
                                            var vat_val = (check_val * 0.05).toFixed(2);
                                            $('#vat').val(vat_val);
                                            $('#total_price').val(check_val);
                                        } else {
                                            var check_val = 0;
                                        }

                                        $('#other_price').val(0);
                                        $('#other_price_desc').val('');
                                        $('#right_avail_total_other').html('');
                                        $('#vat_total').html(vat_val + ' ' + currency);

                                        $('#other_charge_box').css('display', 'none');
                                        $('#othertable').css('display', 'none');
                                        $('#right_avail_other_display').css('display', 'none');
                                        $('#right_avail_total_other_display').css('display', 'none');
                                        $("#right_avail_total").text(check_val + ' ' + currency);

                                    }

                                });



                                $('#alternative_product_price').keyup(function() {
                                    if (this.value <= 0) {

                                        $(this).val('');
                                    }
                                    var volume = $('#volume').val();

                                    var currency = $('#currency').val();

                                    var other_price = $('#other_price').val();
                                    var shipping_weight = $('#shipping_weight').val();
                                    var product_volume = $('#product_volume').val();
                                    var shipping_unit_price = $('#shipping_unit_price').val();
                                    var currency = $('#currency').val();
                                    var alternative_product_price = $('#alternative_product_price').val();
                                    alternative_product_price = Number(alternative_product_price).toFixed(2);
                                    var right_avail_total_ship_value = shipping_weight * shipping_unit_price *
                                        product_volume;
                                    var subtotal = Number(alternative_product_price * volume).toFixed(2);

                                    if ($('input[name="vat_available"]:checked').val() == 1) {
                                        var vat = formatNumber(Number((parseFloat(subtotal) * 0.05)).toFixed(2));
                                    } else {
                                        var vat = 0;
                                    }
                                    // var total = parseInt(subtotal) + parseInt(right_avail_total_ship_value) + parseInt(
                                    //     vat) + parseInt(other_price);
                                    var total = Number(parseFloat(subtotal) + parseFloat(vat)).toFixed(2);
                                    $('#vat').val(vat);
                                    $('#total_price').val(total);

                                    // if ($('#product_available_yes').prop('checked')) {
                                    $("#right_avail_unit").text(formatNumber(alternative_product_price) + ' ' + currency);
                                    $("#right_avail_product_subtotal").text(formatNumber(subtotal) + ' ' + currency);
                                    $("#right_avail_total").text(formatNumber(total) + ' ' + currency);
                                    $("#right_avail_subtotal").text(formatNumber(subtotal) + ' ' + currency);
                                    $("#vat_total").text(vat + ' ' + currency);

                                    // } else {
                                    // $("#right_alter_unit").text(alternative_product_price + ' ' +currency);
                                    //  $("#right_alter_total").text(total + ' ' +currency);
                                    //  $("#right_alter_subtotal").text(subtotal + ' ' +currency);
                                    // }
                                });



                                $('#product_volume').keyup(function() {
                                    var volume = $('#product_volume').val();
                                    $("#volume").val(volume);
                                    $("#prodvolume").text("Quantity :" + volume);
                                    $("#alternate_prod_volume").text(volume);
                                    var alternative_product_price = $('#alternative_product_price').val();
                                    var shipping_weight = $('#shipping_weight').val();
                                    var product_volume = $('#product_volume').val();
                                    var shipping_unit_price = $('#shipping_unit_price').val();
                                    var currency = $('#currency').val();

                                    var other_price = $('#other_price').val();
                                    var subtotal = alternative_product_price * volume;
                                    var right_avail_total_ship_value = shipping_weight * shipping_unit_price *
                                        product_volume;
                                    var vat_available = $("input[name='vat_available']").val();
                                    if (vat_available == '1') {
                                        var vat = (parseInt(right_avail_total_ship_value) + parseInt(subtotal)) * 0.05;
                                    } else {
                                        var vat = 0;
                                    }

                                    var right_avail_total_value = parseInt(right_avail_total_ship_value) + parseInt(
                                        subtotal) + parseInt(vat) + parseInt(other_price);
                                    $('#total_price').val(right_avail_total_value);
                                    $('#vat').val(vat);

                                    $("#right_alter_weight").text(shipping_weight);
                                    $("#right_alter_total_weight").text(shipping_weight * product_volume);

                                    $("#right_alter_total_ship_price").text(right_avail_total_ship_value + ' ' +
                                        currency);
                                    $("#vat_total").text(vat + ' ' + currency);
                                    $("#right_alter_subtotal").text(subtotal + ' ' + currency);
                                    $("#right_alter_total").text(right_avail_total_value + ' ' + currency);
                                });



                                $('#shipping_weight').keyup(function() {
                                    var volume = $('#volume').val();
                                    var alternative_product_price = $('#alternative_product_price').val();
                                    var shipping_weight = $('#shipping_weight').val();
                                    var product_volume = $('#product_volume').val();
                                    var shipping_unit_price = $('#shipping_unit_price').val();
                                    var currency = $('#currency').val();

                                    var other_price = $('#other_price').val();
                                    var subtotal = alternative_product_price * volume;
                                    var right_avail_total_ship_value = shipping_weight * shipping_unit_price * volume;

                                    var vat_available = $("input[name='vat_available']").val();
                                    if (vat_available == '1') {
                                        var vat = (parseInt(right_avail_total_ship_value) + parseInt(subtotal)) * 0.05;
                                    } else {
                                        var vat = 0;
                                    }
                                    var right_avail_total_value = parseInt(right_avail_total_ship_value) + parseInt(
                                        subtotal) + parseInt(vat) + parseInt(other_price);
                                    $('#total_price').val(right_avail_total_value);
                                    $('#vat').val(vat);
                                    var shipping_unit_value = $('#shipping_unit').val();
                                    if (shipping_unit_value != '') {
                                        var shipping_unit_text = $('#shipping_unit :selected').text();
                                    } else {
                                        var shipping_unit_text = '';
                                    }
                                    $("#vat_total").text(vat + ' ' + currency);
                                    // if ($('#product_available_yes').prop('checked')) {
                                    $("#right_avail_weight").text(shipping_weight + ' ' + shipping_unit_text);
                                    $("#right_avail_total_weight").text((shipping_weight * volume) + ' ' +
                                        shipping_unit_text);
                                    $("#right_avail_total_ship_price").text(right_avail_total_ship_value + ' ' +
                                        currency);
                                    $("#right_avail_total_ship_price_sub").text(right_avail_total_ship_value + ' ' +
                                        currency);
                                    $("#right_avail_total").text(right_avail_total_value + ' ' + currency);

                                    // } else {
                                    // $("#right_alter_weight").text(shipping_weight);
                                    // $("#right_alter_total_weight").text(shipping_weight * product_volume);
                                    // $("#right_alter_total_ship_price").text(right_avail_total_ship_value + ' ' +currency);
                                    // $("#right_alter_total").text(right_avail_total_value + ' ' +currency);
                                    // }
                                });


                                $('#shipping_unit').change(function() {

                                    var shipping_unit_value = $('#shipping_unit').val();
                                    if (shipping_unit_value != '') {
                                        var shipping_unit_text = $('#shipping_unit :selected').text();
                                    } else {
                                        var shipping_unit_text = '';
                                    }
                                    var tdval = $("#shipping_weight").val();
                                    var prod_quantity = $("#prod_quantity").val();
                                    if ($('#product_available_yes').prop('checked')) {
                                        $("#right_avail_unit_price_text").text('Unit Price (' + shipping_unit_text +
                                            ')');
                                        $("#right_avail_weight").text(tdval + ' ' + shipping_unit_text);
                                        $("#right_avail_total_weight").text((tdval * prod_quantity) + ' ' +
                                            shipping_unit_text);

                                    } else {
                                        $("#right_alter_unit_price_text").text('Unit Price (' + shipping_unit_text +
                                            ')');
                                    }
                                });

                                $('#shipping_unit_price').keyup(function() {

                                    var other_price = $('#other_price').val();
                                    var shipping_weight = $('#shipping_weight').val();
                                    var product_volume = $('#product_volume').val();
                                    var shipping_unit_price = $('#shipping_unit_price').val();

                                    var other_price = $('#other_price').val();
                                    var currency = $('#currency').val();
                                    var volume = $('#volume').val();
                                    var alternative_product_price = $('#alternative_product_price').val();
                                    var subtotal = alternative_product_price * volume;
                                    var right_avail_total_ship_value = shipping_weight * shipping_unit_price * volume;

                                    var vat_available = $("input[name='vat_available']").val();
                                    if (vat_available == '1') {
                                        var vat = (parseInt(right_avail_total_ship_value) + parseInt(subtotal)) * 0.05;
                                    } else {
                                        var vat = 0;
                                    }
                                    var right_avail_total_value = parseInt(right_avail_total_ship_value) + parseInt(
                                        subtotal) + parseInt(vat) + parseInt(other_price);
                                    $('#total_price').val(right_avail_total_value);
                                    $('#vat').val(vat);

                                    // if ($('#product_available_yes').prop('checked')) {
                                    $("#right_avail_unit_price").text(shipping_unit_price + ' ' + currency);
                                    $("#right_avail_total_ship_price").text(right_avail_total_ship_value + ' ' +
                                        currency);
                                    $("#right_avail_total_ship_price_sub").text(right_avail_total_ship_value + ' ' +
                                        currency);
                                    $("#vat_total").text(vat + ' ' + currency);
                                    $("#right_avail_total").text(right_avail_total_value + ' ' + currency);
                                    // } else {
                                    // $("#right_alter_unit_price").text(shipping_unit_price + ' ' +currency);
                                    // $("#right_alter_total_ship_price").text(right_avail_total_ship_value + ' ' +currency);
                                    // $("#right_alter_total").text(right_avail_total_value + ' ' +currency);
                                    // }
                                });

                                $('#other_price').keyup(function() {

                                    var other_price = $('#other_price').val();
                                    if (other_price == '') {
                                        var other_price = 0;
                                    }
                                    var shipping_weight = $('#shipping_weight').val();
                                    var product_volume = $('#product_volume').val();
                                    var shipping_unit_price = $('#shipping_unit_price').val();
                                    var vat = $('#vat').val();
                                    var alternative_product_price = $('#alternative_product_price').val();
                                    var volume = $('#volume').val();
                                    var subtotal = alternative_product_price * volume;


                                    var right_avail_total_value = parseInt(subtotal) + parseInt(shipping_weight *
                                        shipping_unit_price * volume) + parseInt(vat) + parseInt(other_price);
                                    $('#total_price').val(right_avail_total_value);
                                    var vat_available = $("input[name='vat_available']").val();
                                    if (vat_available == '1') {
                                        var vat = parseInt(right_avail_total_value) * 0.05;
                                    } else {
                                        var vat = 0;
                                    }
                                    $('#vat').val(vat);
                                    var currency = $('#currency').val();

                                    $("#right_avail_other").text(other_price + ' ' + currency);
                                    $("#right_avail_total_other").text(other_price + ' ' + currency);
                                    $("#right_avail_total").text(right_avail_total_value + ' ' + currency);
                                    $("#vat_total").text(vat + ' ' + currency);


                                });

                                $('#other_price_desc').keyup(function() {


                                    var other_price_desc = $('#other_price_desc').val();
                                    var currency = $('#currency').val();

                                    if (other_price_desc != '') {
                                        $('#other_charge_box').css('display', 'contents');
                                        $('#othertable').css('display', 'table');

                                        if ($('#product_available_yes').prop('checked')) {
                                            $("#right_avail_other_display_text").text(other_price_desc);
                                            $("#right_avail_total_other_display_text").text(other_price_desc);
                                            $('#right_avail_other_display').css('display', 'contents');
                                            $('#right_avail_total_other_display').css('display', 'contents');

                                        } else {
                                            $("#right_alter_other_display_text").text(other_price_desc);
                                            $("#right_alter_total_other_display_text").text(other_price_desc);
                                            $('#right_alter_other_display').css('display', 'contents');
                                            $('#right_alter_total_other_display').css('display', 'contents');
                                        }
                                    } else {
                                        var total = $('#total_price').val();
                                        var other_price = $('#other_price').val();
                                        if (total > 0) {
                                            if (other_price == '') {
                                                other_price = 0;
                                            }
                                            var check_val = parseInt(total) - parseInt(other_price);
                                            $('#total_price').val(check_val);
                                        } else {
                                            var check_val = 0;
                                        }
                                        $('#other_price').val(0);

                                        $('#other_charge_box').css('display', 'none');
                                        $('#othertable').css('display', 'none');
                                        if ($('#product_available_yes').prop('checked')) {
                                            $('#right_avail_other_display').css('display', 'none');
                                            $('#right_avail_total_other_display').css('display', 'none');
                                            $("#right_avail_total").text(check_val + ' ' + currency);
                                            $("#right_avail_total_other").text(0 + ' ' + currency);
                                            $("#right_avail_other").text(0 + ' ' + currency);


                                        } else {
                                            $('#right_alter_other_display').css('display', 'none');
                                            $('#right_alter_total_other_display').css('display', 'none');
                                            $("#right_alter_total").text(check_val + ' ' + currency);
                                            $("#right_alter_total_other").text(0 + ' ' + currency);
                                            $("#right_alter_other").text(0 + ' ' + currency);
                                        }
                                    }
                                });

                                $("#alternative_product").change(function(e) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    e.preventDefault();
                                    var product_id = $("#alternative_product").val();
                                    $.ajax({
                                        url: '{{ route('quote.getproductname') }}',
                                        type: 'POST',
                                        data: {
                                            product_id: product_id
                                        },
                                        success: function(data) {
                                            console.log(data[0].name);
                                            console.log(data);
                                            $("#prodname").text("Product Name : " + data[0].name);
                                            $("#alternate_prod_name").text(data[0].name);
                                            $("#produnit").text("Unit : " + data[0].unitname);
                                            $("#alternate_prod_unit").text(data[0].unitname);
                                            $("#alternative_product_price").val(data[0].price_from);
                                            $("#prod_unit_name").text('Product Unit Price (' + data[0]
                                                .unitname + '):');
                                            // $("#product_volume").val(data[0].MOQ);

                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {

                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                        }
                                    });
                                });
                            });

                            function formatNumber(num) {
                                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                            }

                        </script>
                        <script>
                            $(".buyerQuickView").click(function(e) {
                                $('#btnDiv').css('display', 'contents');
                                $('#rejectDiv').css('display', 'none');
                                $("#alter_prd").remove();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                e.preventDefault();
                                $.ajax({
                                    url: '{{ route('quote.quotedetail') }}',
                                    type: 'POST',
                                    data: {
                                        id: this.id
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if (data[0].alternative_product_price != 0) {
                                            var prod_price = data[0].alternative_product_price;
                                        } else {
                                            var prod_price = data[0].product_price;
                                        }
                                        var subtotal = data[0].volume * prod_price;
                                        // var shipping_total = data[0].shipping_weight * data[0].shipping_price * data[0].volume;

                                        if (data[0].alternative_product_name != '') {
                                            $("<p id='alter_prd' class='text-center'>( Alternative of - " + data[0]
                                                .alternative_product_name + " )</p>").insertAfter(
                                                "#modal_prod_name");
                                        }

                                        var currency_name = data[0].currency_name;
                                        $("#buyerquoteid").val(data[0].id);
                                        $("#modal_prod_name").text(data[0].product_name);
                                        $("#modal_prod_unit").text(data[0].unitname);
                                        $("#modal_prod_volume").text(data[0].volume + " " + data[0].unitname);
                                        $("#alter_unit").text(prod_price + " " + currency_name);
                                        $("#alter_weight").text(data[0].shipping_weight + " " + data[0].unitname);
                                        $("#alter_total_weight").text(data[0].shipping_weight * data[0].volume + " " +
                                            data[0].unitname);
                                        $("#alter_subtotal").text(subtotal + '.00' + " " + currency_name);
                                        // $("#buyer_product_subtotal").text(subtotal + '.00' + " " + currency_name);
                                        // $("#alter_unit_price_text").text('Shipping Unit (' + data[0].unitname + ')');
                                        // $("#alter_unit_price").text(data[0].shipping_price + " " + currency_name);
                                        // $("#alter_total_ship_price").text(shipping_total + " " + currency_name);
                                        // $("#buyer_shipping_subtotal").text(shipping_total + " " + currency_name);
                                        $("#alter_total").text(data[0].total_price + " " + currency_name);
                                        // if (data[0].other_price_desc == '' || data[0].other_price_desc == null || data[
                                        //         0].other_price_desc == 0) {
                                        //     $('#alter_other_display').css('display', 'none');
                                        //     $('#alter_total_other_display').css('display', 'none');

                                        // } else {
                                        //     $('#alter_other_display').css('display', 'table-row');
                                        //     $('#alter_total_other_display').css('display', 'table-row');
                                        //     $("#alter_other_display_text").text(data[0].other_price_desc + " " +
                                        //         currency_name);
                                        //     $("#alter_other").text(data[0].other_price + currency_name);
                                        //     $("#alter_total_other_display_text").text(data[0].other_price_desc + " " +
                                        //         currency_name);
                                        //     $("#alter_total_other").text(data[0].other_price + " " + currency_name);
                                        // }
                                        if (data[0].vat > 0) {
                                            $('#alter_vat_display').css('display', 'table-row');
                                            $("#alter_vat").text(data[0].vat + " " + currency_name);
                                        } else {
                                            $('#alter_vat_display').css('display', 'none');
                                            $("#alter_vat").text('0' + " " + currency_name);
                                        }
                                        if (data[0].purchase_info != '') {
                                            $("#displayDiv").css('display', 'none');

                                        } else {
                                            $("#displayDiv").css('display', 'table-row');
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        $("#loginBtn").text('LOGIN');
                                        var msg = JSON.parse(XMLHttpRequest.responseText);
                                        $('#errmsg').text('Sorry Invalid login !');
                                    }
                                });
                            });


                            $(".sellerQuickView").click(function(e) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                e.preventDefault();
                                $.ajax({
                                    url: '{{ route('quote.quotedetail') }}',
                                    type: 'POST',
                                    data: {
                                        id: this.id
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        if (data[0].alternative_product_price != 0) {
                                            var prod_price = data[0].alternative_product_price;
                                        } else {
                                            var prod_price = data[0].product_price;
                                        }
                                        var currency_name = data[0].currency_name;
                                        var subtotal = data[0].volume * prod_price;
                                        // var shipping_total = data[0].shipping_weight * data[0].shipping_price * data[0]
                                        //     .volume;
                                        $("#seller_modal_prod_name").text(data[0].product_name);
                                        $("#seller_modal_prod_unit").text(data[0].unitname);
                                        $("#seller_modal_prod_volume").text(data[0].volume + " " + data[0].unitname);
                                        $("#seller_alter_unit").text(formatNumber(prod_price) + " " + currency_name);
                                        // $("#seller_alter_weight").text(data[0].shipping_weight + " " + data[0].unitname);
                                        // $("#seller_total_weight").text(data[0].shipping_weight * data[0].volume + " " + data[0].unitname);
                                        $("#seller_alter_subtotal").text(formatNumber(subtotal) + '.00' + " " +
                                            currency_name);
                                        $("#product_subtotal").text(formatNumber(subtotal) + '.00' + " " +
                                            currency_name);
                                        // $("#seller_alter_unit_price_text").text('Shipping Unit (' + data[0].unitname + ')');
                                        // $("#seller_alter_unit_price").text(data[0].shipping_price + " " + currency_name);
                                        // $("#seller_alter_total_ship_price").text(shipping_total + '.00' + " " +currency_name);
                                        // $("#shipping_subtotal").text(shipping_total + '.00' + " " + currency_name);
                                        $("#seller_alter_total").text(formatNumber(data[0].total_price) + " " +
                                            currency_name);
                                        // if (data[0].other_price_desc == '' || data[0].other_price_desc == null || data[
                                        //         0].other_price_desc == 0) {
                                        //     $('#seller_alter_other_display').css('display', 'none');
                                        //     $('#seller_alter_total_other_display').css('display', 'none');


                                        // } else {


                                        //     $('#seller_alter_other_display').css('display', 'table-row');
                                        //     $('#seller_alter_total_other_display').css('display', 'table-row');
                                        //     $("#seller_alter_other_display_text").text(data[0].other_price_desc + " " +
                                        //         currency_name);
                                        //     $("#seller_alter_other").text(data[0].other_price + " " + currency_name);
                                        //     $("#seller_alter_total_other_display_text").text(data[0].other_price_desc +
                                        //         " " + currency_name);
                                        //     $("#seller_alter_total_other").text(data[0].other_price + " " +
                                        //         currency_name);
                                        // }
                                        if (data[0].vat > 0) {
                                            $('#seller_alter_vat_display').css('display', 'table-row');
                                            $("#seller_alter_vat").text(data[0].vat + " " + currency_name);
                                        } else {
                                            $('#seller_alter_vat_display').css('display', 'none');
                                            $("#seller_alter_vat").text('0' + " " + currency_name);
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        $("#loginBtn").text('LOGIN');
                                        var msg = JSON.parse(XMLHttpRequest.responseText);
                                        $('#errmsg').text('Sorry Invalid login !');
                                    }
                                });
                            });


                            $("#acceptBtn").click(function(e) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                e.preventDefault();
                                var id = $("#buyerquoteid").val();
                                console.log('rajib');
                                $.ajax({
                                    url: '{{ route('quote.accepted') }}',
                                    type: 'POST',
                                    data: {
                                        id: id
                                    },
                                    success: function(data) {
                                        $('#displayDiv').css('display', 'none');
                                        $('#acceptDiv').css('display', 'contents');
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        $("#loginBtn").text('LOGIN');
                                        var msg = JSON.parse(XMLHttpRequest.responseText);
                                        $('#errmsg').text('Sorry Invalid login !');
                                    }
                                });
                            });


                            $("#rejectBtn").click(function(e) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                e.preventDefault();
                                var id = $("#buyerquoteid").val();
                                $.ajax({
                                    url: '{{ route('quote.reject') }}',
                                    type: 'POST',
                                    data: {
                                        id: id
                                    },
                                    success: function(data) {
                                        $('#displayDiv').css('display', 'none');
                                        $('#rejectDiv').css('display', 'contents');
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        $("#loginBtn").text('LOGIN');
                                        var msg = JSON.parse(XMLHttpRequest.responseText);
                                        $('#errmsg').text('Sorry Invalid login !');
                                    }
                                });
                            });

                        </script>


                        @if (Request::path() == '/buyerdashboard' || Request::path() == '/sellerdashboard')
                            <script>
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                            'October', 'November', 'December'
                                        ],
                                        datasets: [{
                                            label: 'Products',
                                            data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                                            backgroundColor: [
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(54, 162, 235, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(54, 162, 235, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });

                            </script>

                            <script>
                                var ctx = document.getElementById('myChartOrders').getContext('2d');


                                var myChartOrders = new Chart(document.getElementById("myChartOrders"), {
                                    type: 'line',
                                    data: {
                                        labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                            'October', 'November', 'December'
                                        ],
                                        datasets: [{
                                            data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                                            label: "Purchased Orders",
                                            borderColor: "#3e95cd",
                                            fill: false
                                        }, {
                                            data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                                            label: "Completed Orders",
                                            borderColor: "#8e5ea2",
                                            fill: false
                                        }]
                                    },
                                    options: {
                                        title: {
                                            display: false,
                                            text: 'World population per region (in millions)'
                                        }
                                    }
                                });

                            </script>

                            <script>
                                var ctx = document.getElementById('myChartQuotes').getContext('2d');


                                var myChartQuotes = new Chart(document.getElementById("myChartQuotes"), {
                                    type: 'line',
                                    data: {
                                        labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                            'October', 'November', 'December'
                                        ],
                                        datasets: [{
                                            data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                                            label: "Purchased Orders",
                                            borderColor: "#3e95cd",
                                            fill: false
                                        }, {
                                            data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                                            label: "Completed Orders",
                                            borderColor: "#8e5ea2",
                                            fill: false
                                        }]
                                    },
                                    options: {
                                        title: {
                                            display: false,
                                            text: 'World population per region (in millions)'
                                        }
                                    }
                                });

                            </script>

                        @endif
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
                        <script>
                            $('#makePdf').click(function() {

                                var doc = new jsPDF();
                                doc.addHTML($('#sideview5'), {
                                    'background': '#fff',
                                }, function() {
                                    doc.save('purchaseorder.pdf');
                                });

                            });
                            $('#makeQuotationPdf').click(function() {
                                var pdfname = $('#pdfname').val();
                                var doc = new jsPDF();
                                doc.addHTML($('#sideview5'), {
                                    'background': '#fff',
                                }, function() {
                                    doc.save(pdfname + '.pdf');
                                });

                            });
                            $(".myselect2").select2();

                            $('.price_check').keyup(function(e) {
                                e.preventDefault();
                                var price_from = $('#price_from').val();
                                var price_to = $('#price_to').val();

                                if (parseInt(price_to) < parseInt(price_from)) {
                                    $('#price_to_error').css('display', 'block');
                                    // $this.focus();
                                    e.preventDefault();
                                } else {
                                    $('#price_to_error').css('display', 'none');
                                }

                            });
                            $('.product_price_show').change(function() {
                                if (this.value == '1') {
                                    // $('#price_section').css('display', 'contents');
                                    $('#price_ask').css('display', 'none');
                                    $('#fixed_price').css('display', 'block');
                                    $('#price_section').css('display', 'contents');
                                    $('#range_show').prop('checked', 'true');

                                } else if (this.value == '0') {
                                    $('#price_section').css('display', 'none');
                                    $('#fixed_price').css('display', 'none');
                                    $('#fixed_price_section').css('display', 'none');
                                    $('#price_ask').css('display', 'block');
                                    $('#price_from').val(0);
                                    $('#price_to').val(0);

                                }
                            });
                            $('.product_fixed_price_show').change(function() {
                                if (this.value == '1') {
                                    $('#fixed_price_section').css('display', 'contents');
                                    $('#price_section').css('display', 'none');

                                } else if (this.value == '0') {
                                    $('#price_section').css('display', 'contents');
                                    $('#fixed_price_section').css('display', 'none');
                                    //$('#price_from').val(0);
                                    var price_from = $('#price_from').val();
                                    $('#price_from').val(price_from);

                                }
                            });
                            $("#price_fixed").keyup(function(e) {

                                e.preventDefault();
                                var price_fixed = $('#price_fixed').val();
                                console.log(price_fixed);
                                $('#price_to').val(price_fixed);

                            });

                            $("#product_submit").click(function(e) {

                                var desc = CKEDITOR.instances['prod_description'].getData();
                                if (desc == '') {
                                    CKEDITOR.instances['prod_description'].focus();
                                    $("#prod_des").scrollTop();
                                    e.preventDefault();
                                    return false;
                                }
                            });

                        </script>


                        @yield('script')
                    </body>

                    </html>
