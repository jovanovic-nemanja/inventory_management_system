<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('admindesign/img/icon.ico') }}" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts and icons -->
    <script src="{{ asset('admindesign/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands", "simple-line-icons"
                ],
                urls: ["{{ asset('admindesign/css/fonts.min.css ') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admindesign/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admindesign/css/millenium.min.css') }}">

    <!-- Image uploader-->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="{{ asset('newdesign/css/image-uploader.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admindesign/css/demo.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="purple">

                <a href="/" class="logo">
                    {{-- <img src="{{ asset('admindesign/img/logo.png') }}" alt="navbar brand" class="navbar-brand"
                    style="width: 54%;"> --}}
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="purple2">

                <div class="container-fluid">

                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    {{-- <img src="{{ asset('admindesign/img/profile.jpg') }}" alt="..."
                                    class="avatar-img rounded-circle"> --}}
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img
                                                    src="{{ asset('admindesign/img/profile.jpg') }}"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>Super Admin</h4>
                                                <p class="text-muted">saels@inventory.com</p>
                                                <a href="/" class="btn btn-xs btn-secondary btn-sm">Visit
                                                    Website</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('admin/general') }}">Site Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onClick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">

                    <ul class="nav nav-secondary">
                        <li class="nav-item">
                            <a href="{{ url('/inventoryboard') }}">
                                <i class="fas fa-certificate"></i>
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                                <a href="{{ url('inventory/label') }}">
                        <i class="fas fa-certificate"></i>
                        {{ __('Label') }}
                        </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ url('inventory/container/batch') }}">
                                <i class="fas fa-certificate"></i>
                                {{ __('Batch') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('inventory/container') }}">
                                <i class="fas fa-certificate"></i>
                                {{ __('Container') }}
                            </a>
                        </li>

                        <li class="nav-item">

                            <a href="{{ url('inventory/prod') }}">
                                <i class="fab fa-product-hunt"></i>
                                {{ __('Products') }}
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="{{ url('inventory/unit') }}">
                                <i class="fab fa-product-hunt"></i>
                                {{ __('Units') }}
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href="{{ url('inventory/category') }}">
                                <i class="fab fa-product-hunt"></i>
                                {{ __('Category') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('inventory/customer') }}">
                                <i class="far fa-hand-paper"></i>
                                {{ __('Customers') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('inventory/supplier') }}">
                                <i class="fab fa-first-order-alt"></i>
                                {{ __('Supplier') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('inventory/purchase') }}">
                                <i class="fab fa-first-order-alt"></i>
                                {{ __('Purchase') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('inventory/shipper') }}">
                                <i class="fab fa-first-order-alt"></i>
                                {{ __('Shipper Info') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('inventory/consignee') }}">
                                <i class="fab fa-first-order-alt"></i>
                                {{ __('Consignee Info') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('inventory/container/detail') }}">
                                <i class="fab fa-first-order-alt"></i>
                                {{ __('Setting') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" onClick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fab fa-first-order-alt"></i>
                                {{ __('Logout') }}
                            </a>
                        </li>
                        
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        @yield('content')

        <div class="quick-sidebar">
            <a href="#" class="close-quick-sidebar">
                <i class="flaticon-cross"></i>
            </a>
            <div class="quick-sidebar-wrapper">
                <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages" role="tab"
                            aria-selected="true">Messages</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tasks" role="tab"
                            aria-selected="false">Tasks</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab"
                            aria-selected="false">Settings</a> </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-chat tab-pane fade show active" id="messages" role="tabpanel">
                        <div class="messages-contact">
                            <div class="quick-wrapper">
                                <div class="quick-scroll scrollbar-outer">
                                    <div class="quick-content contact-content">
                                        <span class="category-title mt-0">Contacts</span>
                                        <div class="avatar-group">
                                            <div class="avatar">
                                                <img src="{{ asset('admindesign/img/jm_denis.jpg') }}" alt="..."
                                                    class="avatar-img rounded-circle border border-white">
                                            </div>
                                            <div class="avatar">
                                                <img src="{{ asset('admindesign/img/chadengle.jpg') }}" alt="...""
                                                    class=" avatar-img rounded-circle border border-white">
                                            </div>
                                            <div class="avatar">
                                                <img src="{{ asset('admindesign/img/mlane.jpg') }}" alt="..."
                                                    class="avatar-img rounded-circle border border-white">
                                            </div>
                                            <div class="avatar">
                                                <img src="{{ asset('admindesign/img/talha.jpg') }}" alt="..."
                                                    class="avatar-img rounded-circle border border-white">
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-title rounded-circle border border-white">+</span>
                                            </div>
                                        </div>
                                        <span class="category-title">Recent</span>

                                        <span class="category-title">Other Contacts</span>
                                        <div class="contact-list">
                                            <div class="user">
                                                <a href="#">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('admindesign/img/jm_denis.jpg') }}"
                                                            alt="..."
                                                            class="avatar-img rounded-circle border border-white">
                                                    </div>
                                                    <div class="user-data2">
                                                        <span class="name">Jimmy Denis</span>
                                                        <span class="status">Online</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user">
                                                <a href="#">
                                                    <div class="avatar avatar-offline">
                                                        <img src="{{ asset('admindesign/img/chadengle.jpg') }}"
                                                            alt="..."
                                                            class="avatar-img rounded-circle border border-white">
                                                    </div>
                                                    <div class="user-data2">
                                                        <span class="name">Chad</span>
                                                        <span class="status">Active 2h ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="user">
                                                <a href="#">
                                                    <div class="avatar avatar-away">
                                                        <img src="{{ asset('admindesign/img/talha.jpg') }}" alt="..."
                                                            class="avatar-img rounded-circle border border-white">
                                                    </div>
                                                    <div class="user-data2">
                                                        <span class="name">Talha</span>
                                                        <span class="status">Away</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="messages-wrapper">
                            <div class="messages-title">
                                <div class="user">
                                    <div class="avatar avatar-offline float-right ml-2">
                                        <img src="{{ asset('admindesign/img/chadengle.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle border border-white">
                                    </div>
                                    <span class="name">Chad</span>
                                    <span class="last-active">Active 2h ago</span>
                                </div>
                                <button class="return">
                                    <i class="flaticon-left-arrow-3"></i>
                                </button>
                            </div>
                            <div class="messages-body messages-scroll scrollbar-outer">
                                <div class="message-content-wrapper">
                                    <div class="message message-in">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('admindesign/img/chadengle.jpg') }}" alt="..."
                                                class="avatar-img rounded-circle border border-white">
                                        </div>
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="name">Chad</div>
                                                <div class="content">Hello, Rian</div>
                                            </div>
                                            <div class="date">12.31</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-out">
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="content">
                                                    Hello, Chad
                                                </div>
                                            </div>
                                            <div class="message-content">
                                                <div class="content">
                                                    What's up?
                                                </div>
                                            </div>
                                            <div class="date">12.35</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-in">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('admindesign/img/chadengle.jpg') }}" alt="" ..."
                                                class="avatar-img rounded-circle border border-white">
                                        </div>
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="name">Chad</div>
                                                <div class="content">
                                                    Thanks
                                                </div>
                                            </div>
                                            <div class="message-content">
                                                <div class="content">
                                                    When is the deadline of the project we are working on ?
                                                </div>
                                            </div>
                                            <div class="date">13.00</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-out">
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="content">
                                                    The deadline is about 2 months away
                                                </div>
                                            </div>
                                            <div class="date">13.10</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-content-wrapper">
                                    <div class="message message-in">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('admindesign/img/chadengle.jpg') }}" alt="..."
                                                class="avatar-img rounded-circle border border-white">
                                        </div>
                                        <div class="message-body">
                                            <div class="message-content">
                                                <div class="name">Chad</div>
                                                <div class="content">
                                                    Ok, Thanks !
                                                </div>
                                            </div>
                                            <div class="date">13.15</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="messages-form">
                                <div class="messages-form-control">
                                    <input type="text" placeholder="Type here"
                                        class="form-control input-pill input-solid message-input">
                                </div>
                                <div class="messages-form-tool">
                                    <a href="#" class="attachment">
                                        <i class="flaticon-file"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tasks" role="tabpanel">
                        <div class="quick-wrapper tasks-wrapper">
                            <div class="tasks-scroll scrollbar-outer">
                                <div class="tasks-content">
                                    <span class="category-title mt-0">Today</span>
                                    <ul class="tasks-list">
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" checked="" class="custom-control-input"><span
                                                    class="custom-control-label">Planning new project structure</span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    class="custom-control-label">Create the main structure </span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    class="custom-control-label">Add new Post</span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    class="custom-control-label">Finalise the design proposal</span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>

                                    <span class="category-title">Tomorrow</span>
                                    <ul class="tasks-list">
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    class="custom-control-label">Initialize the project </span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    class="custom-control-label">Create the main structure </span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    class="custom-control-label">Updates changes to GitHub </span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="custom-checkbox custom-control checkbox-secondary">
                                                <input type="checkbox" class="custom-control-input"><span
                                                    title="This task is too long to be displayed in a normal space!"
                                                    class="custom-control-label">This task is too long to be displayed
                                                    in a normal space! </span>
                                                <span class="task-action">
                                                    <a href="#" class="link text-danger">
                                                        <i class="flaticon-interface-5"></i>
                                                    </a>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>

                                    <div class="mt-3">
                                        <div class="btn btn-primary btn-rounded btn-sm">
                                            <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            Add Task
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel">
                        <div class="quick-wrapper settings-wrapper">
                            <div class="quick-scroll scrollbar-outer">
                                <div class="quick-content settings-content">

                                    <span class="category-title mt-0">General Settings</span>
                                    <ul class="settings-list">
                                        <li>
                                            <span class="item-label">Enable Notifications</span>
                                            <div class="item-control">
                                                <input type="checkbox" checked data-toggle="toggle"
                                                    data-onstyle="primary" data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">Signin with social media</span>
                                            <div class="item-control">
                                                <input type="checkbox" data-toggle="toggle" data-onstyle="primary"
                                                    data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">Backup storage</span>
                                            <div class="item-control">
                                                <input type="checkbox" data-toggle="toggle" data-onstyle="primary"
                                                    data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">SMS Alert</span>
                                            <div class="item-control">
                                                <input type="checkbox" checked data-toggle="toggle"
                                                    data-onstyle="primary" data-style="btn-round">
                                            </div>
                                        </li>
                                    </ul>

                                    <span class="category-title mt-0">Notifications</span>
                                    <ul class="settings-list">
                                        <li>
                                            <span class="item-label">Email Notifications</span>
                                            <div class="item-control">
                                                <input type="checkbox" checked data-toggle="toggle"
                                                    data-onstyle="primary" data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">New Comments</span>
                                            <div class="item-control">
                                                <input type="checkbox" checked data-toggle="toggle"
                                                    data-onstyle="primary" data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">Chat Messages</span>
                                            <div class="item-control">
                                                <input type="checkbox" checked data-toggle="toggle"
                                                    data-onstyle="primary" data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">Project Updates</span>
                                            <div class="item-control">
                                                <input type="checkbox" data-toggle="toggle" data-onstyle="primary"
                                                    data-style="btn-round">
                                            </div>
                                        </li>
                                        <li>
                                            <span class="item-label">New Tasks</span>
                                            <div class="item-control">
                                                <input type="checkbox" checked data-toggle="toggle"
                                                    data-onstyle="primary" data-style="btn-round">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Custom template | don't include it in your project! -->
        <!--<div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="selected changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeSideBarColor" data-color="white"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Background</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                            <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                            <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                            <button type="button" class="changeBackgroundColor" data-color="dark"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="flaticon-settings"></i>
            </div>
        </div>-->
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('admindesign/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('admindesign/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admindesign/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('admindesign/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admindesign/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('admindesign/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('admindesign/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('admindesign/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('admindesign/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('admindesign/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('admindesign/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('admindesign/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('admindesign/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('admindesign/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admindesign/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('admindesign/js/plugin/gmaps/gmaps.js') }}"></script>

    <!-- Dropzone -->
    <script src="{{ asset('admindesign/js/plugin/dropzone/dropzone.min.js') }}"></script>

    <!-- Fullcalendar -->
    <script src="{{ asset('admindesign/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('admindesign/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="{{ asset('admindesign/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Bootstrap Wizard -->
    <script src="{{ asset('admindesign/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>

    <!-- jQuery Validation -->
    <script src="{{ asset('admindesign/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{ asset('admindesign/js/plugin/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('admindesign/js/plugin/select2/select2.full.min.js') }}"></script>


    <!-- Sweet Alert -->
    <script src="{{ asset('admindesign/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Number Format -->
    <script src="{{ asset('admindesign/js/plugin/jquery.number.min.js') }}"></script>

    <!-- Number Format -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script> --}}

    <!-- Millenium JS -->
    <script src="{{ asset('admindesign/js/millenium.min.js') }}"></script>

    <!-- Millenium DEMO methods, don't include it in your project! -->
    <script src="{{ asset('admindesign/js/setting-demo.js') }}"></script>
    {{-- <script src="{{ asset('admindesign/js/demo.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script type="text/javascript" src="{{ asset('newdesign/js/image-uploader.min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
            $('.delete-image').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (confirm("Are you sure want to delete it ?")) {


                    var id = this.id;
                    $.ajax({
                        url: '{{ route('products.delete_add_image') }}',
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
                var arrayExtensions = ["jpg", "jpeg", "png"];

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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script> --}}

    <script>
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
                $('#price_from').val(0);

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



        $('#makePdfContainer1').click(function() {
            var pdf = new jsPDF('p', 'pt', 'letter')

            // source can be HTML-formatted string, or a reference
            // to an actual DOM element from which the text will be scraped.
            , source = $('#sideview5')[0]

            // we support special element handlers. Register them with jQuery-style
            // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
            // There is no support for any other type of selectors
            // (class, of compound) at this time.
            , specialElementHandlers = {
            }

            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML
            (
                source // HTML string or DOM elem ref.
              , margins.left // x coord
              , margins.top // y coord
              , {'width': margins.width // max width of content on PDF
                 , 'elementHandlers': specialElementHandlers
                }
              , function (dispose) 
                {
                   // dispose: object with X, Y of the last line add to the PDF
                   // this allow the insertion of new lines after html
                   pdf.save('Mypdf.pdf');
                }
              , margins
            )
        });

        $('#makePdfContainer').click(function() {



            var HTML_Width = $("#sideview5").width();
		var HTML_Height = $("#sideview5").height();
		var top_left_margin = 25;
		var PDF_Width = HTML_Width+(top_left_margin*2);
		var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
		var canvas_image_width = HTML_Width;
		var canvas_image_height = HTML_Height;
		
		var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
		

		html2canvas($("#sideview5")[0],{allowTaint:true}).then(function(canvas) {
			canvas.getContext('2d');
			
			console.log(canvas.height+"  "+canvas.width);
			
			
			var imgData = canvas.toDataURL("image/jpeg", 1.0);
			var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
		    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
			
			
			for (var i = 1; i <= totalPDFPages; i++) { 
				pdf.addPage(PDF_Width, PDF_Height);
				pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
			}
			
		    pdf.save("loading-list.pdf");
        });





        // var doc = new jsPDF('p', 'pt', 'a4');

// doc.fromHTML($('#sideview5'), {
//   callback: function (doc) {
//     doc.save('MLB.pdf');
//   },
//   margin: [60, 60, 60, 60],
//   x: 32,
//   y: 32,
// });






    //         var doc = new jsPDF();
    //         var options = {
    //           pagesplit: true 
    //   };
    //         doc.addHTML($('#sideview5'), {pagesplit:true}, function() {
    //             doc.save('loading_list.pdf');
    //         });

        });
    </script>
    <script>
        $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#177dff',
            fillColor: 'rgba(23, 125, 255, 0.14)'
        });

        $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#f3545d',
            fillColor: 'rgba(243, 84, 93, .14)'
        });

        $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
            $('#products-datatables').DataTable({});
            $('#requests-datatables').DataTable({});
            $('#quotation-datatables').DataTable({});
            $('#purchase-datatables').DataTable({});
            $('#completes-datatables').DataTable({});
            $('#archived-datatables').DataTable({});
            $('#callback-datatables').DataTable({});


            $('#multi-filter-select').DataTable({
                "pageLength": 25,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "pageLength": 25,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var alls = $('#add-row tbody').children();

            $('body').on('click', '#selectAll', function() {
                if ($(this).hasClass('allChecked')) {
                    $('.checks input[type="checkbox"]', alls).prop('checked', false);
                    var table = $("#add-row").DataTable();
                    table.$("input[type='checkbox']").prop('checked', false);

                    $('.checkVals').val('');

                    // $('.submit_checkbox').remove();
                } else {
                    // $('input[type="checkbox"]', alls).prop('checked', true);
                    var table = $("#add-row").DataTable();
                    table.$("input[type='checkbox']").prop('checked', true);
                    var ids = [];

                    $('#add-row input:checked').each(function() {
                        if ($(this).attr('id') == 'selectAll') {

                        } else
                            ids.push($(this).val());
                    });

                    $('.checkVals').val(ids);
                }
                $(this).toggleClass('allChecked');


            })
        });
        $('.submit_checkbox').click(function() {
            submitcheck();
        });

        function submitcheck() {
            var ids = $('.checks').val();
            var table = $("#add-row").DataTable();
            var ids = [];
            table.$('td > input:checkbox').each(function() {
                if (this.checked) {
                    ids.push($(this).val());
                }
            });
            var ids = ids.toString();
            if (!ids) {
                alert('There are not any chosen items now.');
                return;
            }
            var href = $('.url').val();

            $.ajax({
                url: href,
                type: 'GET',
                data: {
                    ids: ids
                },
                success: function(result, status) {
                    if (result.status == 200) {
                        location.reload();

                    } else {
                        alert(result.msg);
                    }
                }
            })
        };
    </script>
    <script>
        function deleteCustomer(obj) {
            $(obj).closest('div.divCustomer').remove();
        }

        function deleteThis(obj) {
            $(obj).closest('div').remove();
        }

        function deleteCategory(obj) {
            $(obj).closest('div.cpy_div').remove();
        }

        function deleteTblRow(obj) {
            $(obj).closest('tr').remove();
        }

        $(document).on('change', '.prdLst', function() {
            var id = $(this).attr('id');
            id = id.split("_");
            var catid = parseInt(id[1]) + 1;

            var $tableBody = $('#myTable_' + id[1]).find("tbody"),
                $trLast = $tableBody.find("tr:first"),
                $trNew = $trLast.clone();
            var cyp_row = $trNew.attr('id');
            cyp_row = cyp_row.split("_");
            cyp_id = parseInt(cyp_row[2]) + 1;
            $("#" + cyp_row[0] + "_" + cyp_row[1] + "_" + cyp_row[2]).attr('id', cyp_row[0] + "_" + cyp_row[1] +
                "_" + cyp_id);


            $trLast.after($trNew);
        });
        $(document).on('click', '#add_customer', function() {
            var catid = $('.addMark').attr('id');
            catid = catid.split("_");
            var old_cat_id = catid[1];
            if ($('#customerList_' + old_cat_id).val() == '') {
                alert('Please select customer');
                return false;
            }
            catid = parseInt(catid[1]) + 1;

            $("#customer_div").clone().insertAfter("#card-header");



            $("#customerList").attr('id', 'customerList_' + catid);
            for (var i = 1; i <= old_cat_id; i++) {
                var selectedCus = $('#customerList_' + i).val();
                $('#customerList_' + catid + ' option[value="' + selectedCus + '"]').remove();
            }
            var cusLength = $('#customerList_' + catid + '> option').length;
            if (cusLength <= 1) {
                $('#customer_div').remove();
                alert('All customer added in this container');
            } else {
                $('#customer_div').removeAttr('style');
                $('#customer_div').removeAttr('id');
            }
            $("#nameMark").attr('name', 'mark_' + catid + '[]');
            $('#nameMark').removeAttr('id');

            $("#addMarkBtnId").attr('id', 'addMark_' + catid);
            $('#addMark_' + catid).addClass('addMark');
            $('#addMark').addClass('markDiv_' + catid);
            $('#addMark').removeAttr('id');
            $('.slect').addClass('myselect2');

        });
        $(document).on('change', '.catLst', function(e) {
            var id = $(this).attr('id');
            id = id.split("_");
            console.log(id);
            var catid = parseInt(id[1]);
            var cat_id = e.target.value;
            $.get('./../ajax_cat_prod/' + cat_id, function(data) {
                var subcat = $('#prdLst_' + catid).empty();
                $.each(data, function(key, value) {
                    subcat.append('<option value ="' + value.id + '">' + value.name +
                        '</option>');
                });
            });
        });
        $(document).on('change', '.categorySlt', function(e) {
            var id = $(this).attr('id');
            id = id.split("_");
            var catid = parseInt(id[1]);
            var cat_id = e.target.value;
            $.get('./../purchase/ajax_cat_prod/' + cat_id, function(data) {
                var subcat = $('#prodid_' + catid).empty();
                $.each(data, function(key, value) {
                    subcat.append('<option value ="' + value.id + '">' + value.name +
                        '</option>');
                });
            });
        });
        $(document).on('change', '.productSlt', function(e) {
            var id = $(this).attr('id');
            id = id.split("_");
            var catid = parseInt(id[1]);
            var cat_id = e.target.value;
            $.get('./../purchase/ajax_prod/' + cat_id, function(data) {
                $('#unitname_' + id[1]).text(data.unitname);
                $('#price_' + id[1]).val(data.price);
            });
        });
        $(document).on('change', '.vatAdd', function(e) {
            var rowId = $(this).closest('tr').attr('id');
            rowId = rowId.split("_");
            var item = $('#item_' + rowId[1]).val();
            var price = $('#price_' + rowId[1]).val();
            var total = parseInt(item) * parseInt(price);
            $("#vatamount_" + rowId[1]).text(0.00);
            if ($('#vat_' + rowId[1]).val() == 1) {
                $("#vatamount_" + rowId[1]).text($.number(Math.ceil(total * 0.05), 2));
                total = Math.ceil(parseFloat(total) + parseFloat(total * 0.05));
            }
            $("#totaltext_" + rowId[1]).text($.number(total, 2));
            $("#total_" + rowId[1]).val(total);
            var rowCount = $('#prodTbl >tbody >tr').length;
            var totalPrice = 0;
            for (var i = 0; i < rowCount; i++) {
                totalPrice = parseInt(totalPrice) + parseInt($('#total_' + i).val());
            }
            $('#totalTxt').text($.number(totalPrice, 2));
            $('#alltotal').val(totalPrice);
        });
        $(document).on('click', '#addProduct', function(e) {
            var $tableBody = $('#prodTbl').find("tbody"),
                $trLast = $tableBody.find("tr:first"),
                $trNew = $('#cpyTr').clone();
            var cyp_row = $trLast.attr('id');
            var catId = $('.categorySlt').attr('id');
            catId = catId.split("_");
            catId = parseInt(catId[1]) + 1;
            $trLast.before($trNew);
            $("#cpyTr").attr('id', 'cpyTr_' + catId);
            $("#catid").attr('id', 'catid_' + catId);
            $("#prodid").attr('id', 'prodid_' + catId);
            $("#unitname").attr('id', 'unitname_' + catId);
            $("#item").attr('id', 'item_' + catId);
            $("#price").attr('id', 'price_' + catId);
            $("#vat").attr('id', 'vat_' + catId);
            $("#beforevat").attr('id', 'beforevat_' + catId);
            $("#vatamount").attr('id', 'vatamount_' + catId);
            $("#totaltext").attr('id', 'totaltext_' + catId);
            $("#total").attr('id', 'total_' + catId);
        });

        $(document).on('keyup', '.itemNo', function() {
            var rowId = $(this).closest('tr').attr('id');
            rowId = rowId.split("_");
            var item = $('#item_' + rowId[1]).val();
            var price = $('#price_' + rowId[1]).val();
            var total = parseFloat(item) * parseFloat(price);
            $("#beforevat_" + rowId[1]).text($.number(total, 2));
            if ($('#vat_' + rowId[1]).val() == 1) {
                $("#vatamount_" + rowId[1]).text($.number(Math.ceil(total * 0.05), 2));
                total = Math.ceil(parseFloat(total) + parseFloat(total * 0.05));
            }
            $("#totaltext_" + rowId[1]).text($.number(total, 2));
            $("#total_" + rowId[1]).val(total);
            var rowCount = $('#prodTbl >tbody >tr').length;
            var totalPrice = 0;
            for (var i = 0; i < rowCount; i++) {
                totalPrice = parseFloat(totalPrice) + parseFloat($('#total_' + i).val());
            }
            $('#totalTxt').text($.number(totalPrice, 2));
            $('#alltotal').val(totalPrice);

        });

        function deleteTblRowProd(obj) {
            $(obj).closest('tr').remove();
            var totalPrice = 0;
            $("input[name='total[]']").each(function() {
                totalPrice = parseInt(totalPrice) + parseInt($(this).val());
            });

            $('#totalTxt').text(totalPrice);
            $('#alltotal').val(totalPrice);

        }

        $(document).on('keyup', '.mkkk', function() {
            var fStock = 0;
            var rowId = $(this).closest('tr').attr('id');
            rowId = rowId.split("_");
            var iStock = $('.iStock_' + rowId[1]).val();
            var inputs = $(".mark_" + rowId[1]);
            for (var i = 0; i < inputs.length; i++) {
                fStock = parseInt(fStock) + parseInt($(inputs[i]).val());
            }
            var stk = parseInt(iStock) - parseInt(fStock);
            if (stk < 0) {
                var fStock = 0;
                alert("Product not in stock");
                $(this).val(0);
                var inputs = $(".mark_" + rowId[1]);
                for (var i = 0; i < inputs.length; i++) {
                    fStock = parseInt(fStock) + parseInt($(inputs[i]).val());
                }
                fStocknew = parseInt(iStock) - parseInt(fStock);
                $('.stock_' + rowId[1]).val(fStocknew);
            } else {
                $('.stock_' + rowId[1]).val(stk);
            }
        });

        $(document).on('click', '.add_category', function() {
            var old_cat_id = $(this).attr('id');
            old_cat_id = old_cat_id.split("_");
            old_cat_id = old_cat_id[1];
            var id = $('.addProduct').attr('id');
            id = id.split("_");
            id = parseInt(id[1]) + 1;

            var copyContent = $("#addTable_" + old_cat_id).clone();
            $('.addTable_' + old_cat_id).append(copyContent);
            $('#category_div').attr('class', 'card cpy_div addTable_' + old_cat_id);
            $('#category_div').removeAttr('style');
            $('#category_div').removeAttr('id');
            $("#addProduct").attr('id', 'addProduct_' + id);
            $("#myTable").attr('id', 'myTable_' + id);
            $('#addProduct_' + id).addClass('addProduct');
            $('#addTable').removeAttr('id');
            $('.slect').addClass('myselect2');

        });
        $(document).on('click', '.addMark', function() {
            var batchId = $("#container_batch").val();
            var markId = $(this).attr('id');
            markId = markId.split("_");
            var check1 = 'mark_' + markId[1];
            var emptyCheck = $('input[name="mark_' + markId[1] + '[]"]').val();
            var found = 0;
            $.ajax({
                url: '././ajax_mark/' + batchId,
                cache: false,
                async: false,
                success: function(data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].name == emptyCheck) {
                            found = 1;
                            break;
                        }
                    }
                    return false;
                }
            });
            if (found == 1) {
                alert("Already added this mark in a batch");
                return false;

            }
            var arr = $('input[name="mark_' + markId[1] + '[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            let hasDuplicate = arr.some((val, i) => arr.indexOf(val) !== i);
            if (emptyCheck == '') {
                alert("Mark did not added.");
                return false;

            }
            if (hasDuplicate == true) {
                alert("Already added this mark");
                return false;

            }
            $('#addMark_' + markId[1]).after('<div  class="card-header bg-white markDiv_' + markId[1] +
                '" ><div class="span-icon"><div class="flaticon-box-1"></div></div><div class="span-title"><input type="text" name="mark_' +
                markId[1] +
                '[]" class="form-control" placeholder="Mark" /></div><button type="button" class="btn btn-danger" onclick="deleteThis(this)"><i class="fa fa-trash"></i></button></div>'
            );

        });

        $(document).on('change', '#container_number', function(e) {
            var container_number = $('#container_number').val().length;
            if (container_number > 7) {
                alert('Container number should not be greater than 7');
                $('#container_number').val('');
            }
        });


        $(document).ready(function() {

            $(".container_total").each(function() {
                var total = $(this).val();
                var id = $(this).attr('data-id');
                $('#container_amount_' + id).text("( Total - " + $.number(total ,2) + ' AED )');
            });
            var current_balance = $('#current_balance').val();
            var customer_expense = $('#customer_expense').val();
            console.log(current_balance);
            var balance = parseFloat(current_balance) - parseFloat(customer_expense);
            $('#expense').text('Expense :' + $.number(customer_expense,2) +' AED');
            $('#balance').text('Balance :' + $.number(balance,2)+' AED');

        });

        $(document).on('click', '#makePdf', function(e) {

            var pdfname = $('#pdfName').val();
            var doc = new jsPDF();
            doc.addHTML($('#invoicePdf'), {
                'background': '#fff',
            }, function() {
                doc.save(pdfname+'.pdf');
            });

        });
        $('#alert_demo_7').click(function(e) {
					swal({
						title: 'Are you sure?',
						text: "You won't be able to change anything in this container!",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes, Lock it!',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Lock) => {
						if (Lock) {
							swal({
								title: 'LOCKED!',
								text: 'Your container has been Locked.',
								type: 'success',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							}).then((Lock) => {
                                window.location.href = './../../container';
                            });

						} else {
							swal.close();
						}

					});
				});
    </script>


</body>

</html>
<!-- Localized -->
