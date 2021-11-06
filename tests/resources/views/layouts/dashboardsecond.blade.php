<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
    <title>{{ $general_setting->site_name }}</title>


    <!-- Font Awesome Icon Library -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="{{ asset('assets/vendors/quill/quill.snow.css') }}" rel="stylesheet">

    <!-- start css -->
    <!-- plugins:css -->
<!--     <link href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}" rel="stylesheet">
 -->    <!-- endinject -->
    <!-- Plugin css for this page -->
<!--     <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet">  -->

    <!-- <link href="{{ asset('assets/vendors/jquery-bar-rating/fontawesome-stars.css') }}" rel="stylesheet">  -->
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <!-- <link href="{{ asset('assets/css/demo_1/style.css') }}" rel="stylesheet">  -->
    <!-- end css -->
    <!-- <link href="{{ asset('css/fileinput.min.css') }}" rel="stylesheet"> -->



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

    <link href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet"> 


    <style>
        .fa {
          font-size: 25px;
        }

        .checked {
          color: orange;
        }
    </style>
</head>
<body class="sidebar-fixed">
    <div class="container-scroller" id="app">
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
                            <button>Search</button>
                        </form>
                    </div>
                    <div class="header__right">
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

        <!-- partial -->
        <main class="ps-page--my-account">
            <section class="ps-section--account">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ps-section__left">
                                <aside class="ps-widget--account-dashboard">
                                    <div class="ps-widget__content">
                                        <ul>
                                            @auth
                                                @if(auth()->user()->hasRole('seller'))
                                                    <li class="{{ isActiveRoute('product.my') }}">
                                                        <a href="{{ route('product.my') }}">
                                                            {{ __('Manage Product') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('product.create') }}">
                                                        <a href="{{ route('product.create') }}">
                                                            {{ __('Add Product') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endauth

                                            @auth
                                                @if(auth()->user()->hasRole('seller') || auth()->user()->hasRole('buyer'))
                                                    <li class="{{ isActiveRoute('request.index') }}">
                                                        <a href="{{ route('request.index') }}">
                                                            {{ __('Request') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('quote.index') }}">
                                                        <a href="{{ route('quote.index') }}">
                                                            {{ __('Quote') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('purchaseorders.index') }}">
                                                        <a href="{{ route('purchaseorders.index') }}">
                                                            {{ __('Purchase Order') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('purchaseorders.create') }}">
                                                        <a href="{{ route('purchaseorders.create') }}">
                                                            {{ __('Completed Order') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('achieved.index') }}">
                                                        <a href="{{ route('achieved.index') }}">
                                                            {{ __('Achieved Quotes') }}
                                                        </a>
                                                    </li>
                                                @endif

                                                @if(auth()->user()->hasRole('admin'))
                                                    <li class="{{ isActiveRoute('admin.generalsetting') }}">
                                                        <a href="{{ url('admin/general') }}">
                                                            {{ __('General') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.localizationsetting') }}">
                                                        <a href="{{ url('admin/localization') }}">
                                                            {{ __('Currency') }}
                                                        </a>
                                                    </li>
                                                    <!-- <li class="{{ isActiveRoute('managemanagers') }}">
                                                        <a href="{{ url('admin/managemanagers') }}">
                                                            {{ __('Managers') }}
                                                        </a>
                                                    </li> -->
                                                    <li class="{{ isActiveRoute('admin.managesellers') }}">
                                                        <a href="{{ url('admin/managesellers') }}">
                                                            {{ __('Sellers') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.managebuyers') }}">
                                                        <a href="{{ url('admin/managebuyers') }}">
                                                            {{ __('Buyers') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.unit') }}">
                                                        <a href="{{ url('admin/unit') }}">
                                                            {{ __('Unit') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.category') }}">
                                                        <a href="{{ url('admin/category') }}">
                                                            {{ __('Category') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.products') }}">
                                                        <a href="{{ url('admin/products') }}">
                                                            {{ __('Product') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.requests') }}">
                                                        <a href="{{ url('admin/requests') }}">
                                                            {{ __('Request') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.quotes') }}">
                                                        <a href="{{ url('admin/quotes') }}">
                                                            {{ __('Quote') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.emails') }}">
                                                        <a href="{{ url('admin/emails') }}">
                                                            {{ __('Email') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.logs') }}">
                                                        <a href="{{ url('admin/logs') }}">
                                                            {{ __('Admin Log') }}
                                                        </a>
                                                    </li>
                                                @endif

                                                @if(auth()->user()->hasRole('manager'))
                                                    <li class="{{ isActiveRoute('admin.managesellers') }}">
                                                        <a href="{{ url('admin/managesellers') }}">
                                                            {{ __('Sellers') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.managebuyers') }}">
                                                        <a href="{{ url('admin/managebuyers') }}">
                                                            {{ __('Buyers') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.unit') }}">
                                                        <a href="{{ url('admin/unit') }}">
                                                            {{ __('Unit') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.category') }}">
                                                        <a href="{{ url('admin/category') }}">
                                                            {{ __('Category') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.products') }}">
                                                        <a href="{{ url('admin/products') }}">
                                                            {{ __('Product') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.requests') }}">
                                                        <a href="{{ url('admin/requests') }}">
                                                            {{ __('Request') }}
                                                        </a>
                                                    </li>
                                                    <li class="{{ isActiveRoute('admin.quotes') }}">
                                                        <a href="{{ url('admin/quotes') }}">
                                                            {{ __('Quote') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endauth
                                        </ul>
                                    </div>
                                </aside>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <div id="back2top" style="display: block;"><i class="fa fa-angle-up"></i></div>
        <div class="ps-site-overlay"></div>
        <div id="loader-wrapper">
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>

        @include('component.footer')

        <flash-message message="{{ session('flash') }}" />
    </div>

    <!-- <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('assets/js/form-addons.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script> -->
    


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


    <script src="{{ asset('assets/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/editorDemo.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    @yield('script')
</body>
</html>
