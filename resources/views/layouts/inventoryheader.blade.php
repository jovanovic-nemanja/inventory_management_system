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

    <meta name="title" content="@yield('title')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@php
        echo ucfirst(html_entity_decode($__env->yieldContent('description')));
    @endphp">

    <meta property="og:title" content="@php
        echo ucwords(strtolower($__env->yieldContent('main_title')));
    @endphp" />
    <meta property="og:description" content="@php
        echo ucfirst(html_entity_decode($__env->yieldContent('description')));
    @endphp" />
    <meta property="og:url" content="https://www.mambodubai.com">
    <meta property="og:image" content="@yield('image')" />

    <meta name="twitter:card" content="@php
        echo ucwords(strtolower($__env->yieldContent('main_title')));
    @endphp" />
    <meta name="twitter:site" content="@mambodubai" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@php
        echo ucfirst(html_entity_decode($__env->yieldContent('description')));
    @endphp" />
    <meta property="og:image" content="@yield('image')" />

    <?php } else { ?>
    <title>
        @php
            echo ucwords(strtolower($general_setting->site_name));
        @endphp
    </title>

    <meta name="title" content="{{ $general_setting->meta_title }}">
    <meta name="keywords" content="{{ $general_setting->meta_keywords }}">
    <meta name="description" content="{{ $general_setting->meta_description }}">

    <meta property="og:title" content="{{ $general_setting->meta_title }}" />
    <meta property="og:description" content="{{ $general_setting->meta_description }}" />
    <meta property="og:url" content="https://www.mambodubai.com">
    <meta property="og:image" content="https://mambodubai.com/newdesign/images/logo.png" />


    <meta name="twitter:card" content="{{ $general_setting->meta_title }}" />
    <meta name="twitter:site" content="@MamboDubai" />
    <meta name="twitter:title" content="{{ $general_setting->meta_title }}" />
    <meta name="twitter:description" content="{{ $general_setting->meta_description }}" />
    <meta property="twitter:image" content="https://mambodubai.com/newdesign/images/logo.png">

    <?php } ?>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/bootstrap.min.css') }}">

    <!-- font css -->
    <!--<link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/font-awesome.min.css') }}">-->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- animation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/aos.css') }}">

    <!-- animation css -->
    <!-- <link rel="stylesheet" href="css/aos.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">



    <!-- crousel css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/slick-theme.css') }}">

    <!-- Custom Scrollbar Css -->
    <link type="text/css" href="{{ asset('newdesign/css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/main.css') }}">


    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/responsive.css') }}">
    <script src="{{ asset('newdesign/js/jquery.min.js') }}" type="text/javascript"></script>

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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V4LH8XSTEJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-V4LH8XSTEJ');

    </script>
    <meta name="facebook-domain-verification" content="52ujk8iipxepsb7hms1v2pldpz9bcr" />
</head>

<body>

    <div id="app">
     


                            @yield('content')

                        </div>

                        <flash-message message="{{ session('flash') }}" />



                        <script src="{{ asset('newdesign/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript">
                        </script>

                        <script src="{{ asset('newdesign/js/slick.js') }}" type="text/javascript" charset="utf-8"></script>
                        <!--<script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js" type="text/javascript"
                                                                                                                                                                                                                                                                                                                                                                                                                        charset="utf-8"></script>-->
                        <script src="{{ asset('newdesign/js/slick-animation.min.js') }}" type="text/javascript"></script>


                        <!-- animation js -->
                        <script src="{{ asset('newdesign/js/aos.js') }}" type="text/javascript"></script>


                        <!-- custom js -->
                        <script src="{{ asset('newdesign/js/main.js') }}" type="text/javascript"></script>

                        <script src="{{ asset('newdesign/js/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>
                        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

                        <script>
                            $(document).ready(function() {

                                $('#lgnFrm').validate({

                                    rules: {

                                        email: {

                                            required: true,

                                            email: true

                                        },

                                        password: {

                                            required: true

                                        },

                                    }

                                });

                            });

                        </script>

                        <script type="text/javascript">
                            $(document).ready(function() {

                                $(".chkradio").click(function(e) {
                                    var chkval = this.id;
                                    if (chkval == 'chkbuyer') {

                                        $("#chkbuyer").prop("checked", true);
                                        $("#chkseller").prop("checked", false);
                                    } else {
                                        $("#chkbuyer").prop("checked", false);
                                        $("#chkseller").prop("checked", true);
                                    }

                                });
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
                                            window.location.href = "/inventoryboard";
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                            console.log(msg);
                                            $("#loginBtn").text('LOGIN');
                                            $('#errmsg').text('Sorry Invalid login !');
                                        }
                                    });
                                });

                                $(".reg").keyup(function(e) {
                                    $('#buyererror').html('');
                                    $('#sellererror').html('');
                                });


                                $("#joinBtn").click(function(e) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    e.preventDefault();
                                    //                                                            var role = $("input[name='user']").val();
                                    var role = $('input[name="user"]:checked').val();
                                    console.log(role);

                                    if (role == 'buyerprt') {

                                        var user_name = $("input[name='buyer_user_name']").val();
                                        var phone = $("input[name='buyer_phone']").val();
                                        var email = $("input[name='buyer_name']").val();
                                        var buyer_country = $("#buyer_country").val();
                                        var password = $("input[name='buyer_password']").val();
                                        var password_confirmation = $("input[name='buyer_password_confirmation']").val();
                                        role = 'buyer';
                                        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;


                                        $('#buyererror span').html('');

                                        if (user_name == '') {
                                            $('#buyererror').html('**Name is required.');
                                            $("input[name='buyer_user_name']").focus();
                                            e.preventDefault();
                                            return false;
                                        } else if (isNaN(user_name) == false) {
                                            $('#buyererror').html('**Name must be in Character.');
                                            $("input[name='buyer_user_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (user_name.length < 2) {
                                            $('#buyererror').html('First name must be more than 2 characters.');
                                            $("input[name='buyer_user_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (email == '') {
                                            $('#buyererror').html('Email is required.');
                                            $("input[name='buyer_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (!emailReg.test(email)) {
                                            $('#buyererror').html('Email should be Valid.');
                                            $("input[name='buyer_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (phone == '') {
                                            $('#buyererror').html('Phone is required.');
                                            $("input[name='buyer_phone']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (isNaN(phone) == true) {
                                            $('#buyererror').html('Phone must be in numeric.');
                                            $("input[name='buyer_phone']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (buyer_country == '') {
                                            $('#buyererror').html('Country is required.');
                                            $("input[name='buyer_country']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password == '') {
                                            $('#buyererror').html('Password is required.');
                                            $("input[name='buyer_password']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password.length <= 5) {
                                            $('#buyererror').html('Password length must be more than 5 character ');
                                            $("input[name='buyer_password']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password_confirmation == '') {
                                            $('#buyererror').html('Confirm Password is Required.');
                                            $("input[name='buyer_password_confirmation']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password != password_confirmation) {
                                            $('#buyererror').html('Password mismatch.');
                                            $("input[name='buyer_password_confirmation']").focus();
                                            event.preventDefault();
                                            return false;
                                        }


                                    } else {
                                        var user_name = $("input[name='seller_user_name']").val();
                                        var phone = $("input[name='seller_phone']").val();
                                        var email = $("input[name='seller_name']").val();
                                        var buyer_country = '1';
                                        var password = $("input[name='seller_password']").val();
                                        var password_confirmation = $("input[name='seller_password_confirmation']").val();
                                        role = 'seller';
                                        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

                                        $('#sellererror span').html('');

                                        if (user_name == '') {
                                            $('#sellererror').html('**Name is required.');
                                            $("input[name='seller_user_name']").focus();
                                            e.preventDefault();
                                            return false;
                                        } else if (isNaN(user_name) == false) {
                                            $('#sellererror').html('**Name must be in Character.');
                                            $("input[name='seller_user_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (user_name.length < 2) {
                                            $('#sellererror').html('First name must be more than 2 characters.');
                                            $("input[name='seller_user_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (email == '') {
                                            $('#sellererror').html('**Email is required.');
                                            $("input[name='seller_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (!emailReg.test(email)) {
                                            $('#sellererror').html('**Email should be Valid.');
                                            $("input[name='seller_name']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (phone == '') {
                                            $('#sellererror').html('**Phone is required.');
                                            $("input[name='seller_phone']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (isNaN(phone) == true) {
                                            $('#sellererror').html('**Phone must be in numeric.');
                                            $("input[name='seller_phone']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password == '') {
                                            $('#sellererror').html('**Password is required.');
                                            $("input[name='seller_password']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password.length <= 5) {
                                            $('#sellererror').html('Password length must be more than 5 character ');
                                            $("input[name='seller_password']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password_confirmation == '') {
                                            $('#sellererror').html('Confirm Password is required.');
                                            $("input[name='seller_password_confirmation']").focus();
                                            event.preventDefault();
                                            return false;
                                        } else if (password != password_confirmation) {
                                            $('#sellererror').html('Password mismatch.');
                                            $("input[name='seller_password_confirmation']").focus();
                                            event.preventDefault();
                                            return false;
                                        }
                                    }
                                    $.ajax({
                                        url: '{{ route('emails.sendverifycode') }}',
                                        type: 'POST',
                                        data: {
                                            user_name: user_name,
                                            phone: phone,
                                            email: email,
                                            country: buyer_country,
                                            password: password,
                                            password_confirmation: password_confirmation,
                                            role: role
                                        },
                                        success: function(data) {

                                            if (data == 'checkverify') {

                                                $("#" + role + "error").html(
                                                    'Sorry ! This email is not verified yet.');

                                            } else {
                                                window.location = '../verify_check/' + email;
                                            }
                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            var msg = JSON.parse(XMLHttpRequest.responseText);
                                            console.log(msg);
                                            $("#" + role + "error").html('Sorry ! This email is already registered with us.');
                                        }
                                    });
                                });
                            });

                        </script>
                        <script>
                            $("#pagelgn").click(function(e) {

                            });

                            $(".pageReg").keyup(function(e) {
                                $('#page_buyererror').html('');
                                $('#page_buyererror').html('');
                            });

                            $("#pageJoinBtn").click(function(e) {

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                e.preventDefault();
                                var role = $('input[name="page_user"]:checked').val();
                                console.log(role);

                                if (role == 'page_buyerprt') {

                                    var user_name = $("input[name='page_buyer_user_name']").val();
                                    var phone = $("input[name='page_buyer_phone']").val();
                                    var email = $("input[name='page_buyer_email']").val();
                                    var password = $("input[name='page_buyer_password']").val();
                                    var password_confirmation = $("input[name='page_buyer_password_confirmation']").val();
                                    role = 'buyer';
                                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;


                                    $('#page_buyererror span').html('');

                                    if (user_name == '') {
                                        $('#page_buyererror').html('Name is required.');
                                        $("input[name='page_buyer_user_name']").focus();
                                        e.preventDefault();
                                        return false;
                                    } else if (isNaN(user_name) == false) {
                                        $('#page_buyererror').html('Name must be in Character.');
                                        $("input[name='page_buyer_user_name']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (user_name.length < 2) {
                                        $('#page_buyererror').html('First name must be more than 2 characters.');
                                        $("input[name='page_buyer_user_name']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (email == '') {
                                        $('#page_buyererror').html('Email is required.');
                                        $("input[name='page_buyer_email']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (!emailReg.test(email)) {
                                        $('#page_buyererror').html('Email should be Valid.');
                                        $("input[name='page_buyer_email']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (phone == '') {
                                        $('#page_buyererror').html('Phone is required.');
                                        $("input[name='page_buyer_phone']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (isNaN(phone) == true) {
                                        $('#page_buyererror').html('Phone must be in numeric.');
                                        $("input[name='page_buyer_phone']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password == '') {
                                        $('#page_buyererror').html('Password is required.');
                                        $("input[name='page_buyer_password']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password.length <= 5) {
                                        $('#page_buyererror').html('Password length must be more than 5 character ');
                                        $("input[name='page_buyer_password']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password_confirmation == '') {
                                        $('#page_buyererror').html('Confirm Password is required.');
                                        $("input[name='page_buyer_password_confirmation']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password != password_confirmation) {
                                        $('#page_buyererror').html('Password mismatch.');
                                        $("input[name='page_buyer_password_confirmation']").focus();
                                        event.preventDefault();
                                        return false;
                                    }


                                } else {
                                    var user_name = $("input[name='page_seller_user_name']").val();
                                    var phone = $("input[name='page_seller_phone']").val();
                                    var email = $("input[name='page_seller_email']").val();
                                    var password = $("input[name='page_seller_password']").val();
                                    var password_confirmation = $("input[name='page_seller_password_confirmation']").val();
                                    role = 'seller';
                                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

                                    $('#sellererror span').html('');

                                    if (user_name == '') {
                                        $('#page_sellererror').html('Name is required.');
                                        $("input[name='page_seller_user_name']").focus();
                                        e.preventDefault();
                                        return false;
                                    } else if (isNaN(user_name) == false) {
                                        $('#page_sellererror').html('Name must be in Character.');
                                        $("input[name='page_seller_user_name']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (user_name.length < 2) {
                                        $('#page_sellererror').html('First name must be more than 2 characters.');
                                        $("input[name='page_seller_user_name']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (email == '') {
                                        $('#page_sellererror').html('Email is required.');
                                        $("input[name='page_seller_email']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (!emailReg.test(email)) {
                                        $('#page_sellererror').html('Email should be Valid.');
                                        $("input[name='page_seller_email']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (phone == '') {
                                        $('#page_sellererror').html('Phone is required.');
                                        $("input[name='page_seller_phone']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (isNaN(phone) == true) {
                                        $('#page_sellererror').html('Phone must be in numeric.');
                                        $("input[name='page_seller_phone']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password == '') {
                                        $('#page_sellererror').html('Password is required.');
                                        $("input[name='page_seller_password']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password.length <= 5) {
                                        $('#page_sellererror').html('Password length must be more than 5 character ');
                                        $("input[name='page_seller_password']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password_confirmation == '') {
                                        $('#page_sellererror').html('Confirm Password is required.');
                                        $("input[name='page_seller_password_confirmation']").focus();
                                        event.preventDefault();
                                        return false;
                                    } else if (password != password_confirmation) {
                                        $('#page_sellererror').html('Password mismatch.');
                                        $("input[name='page_seller_password_confirmation']").focus();
                                        event.preventDefault();
                                        return false;
                                    }
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
                                        if (data == 'checkverify') {

                                            $("#page_" + role + "error").html(
                                                'Sorry ! This email is not verified yet.');

                                        } else {
                                            window.location = '../verify_check/' + email;
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        var msg = JSON.parse(XMLHttpRequest.responseText);
                                        $("#page_" + role + "error").html(
                                            'Sorry ! This email is already registered with us.');
                                    }
                                });
                            });

                        </script>

                        <script>
                            $("#forgotpass").on('click', function(e) {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                e.preventDefault();



                                var email = $("input[name='forgotemail']").val();
                                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                                if (email == '') {
                                    $("#forgotpassworderror").html('Email is required.');
                                    $("input[name='forgotemail']").focus();
                                    e.preventDefault();
                                    return false;
                                } else if (!emailReg.test(email)) {
                                    $("#forgotpassworderror").html('Email should be Valid.');
                                    $("input[name='forgotemail']").focus();
                                    e.preventDefault();
                                    return false;
                                }
                                $("#forgotpass").text('Processing');
                                $("#forgotpass").prop('disabled', true);
                                $.ajax({
                                    url: '{{ route('password.forgot') }}',
                                    type: 'POST',
                                    data: {
                                        email: email
                                    },
                                    success: function(data) {
                                        $("#forgotpass").text('Reset My Password');
                                        $("#forgotpass").prop('disabled', false);
                                        if (data.msg == 'no') {
                                            $("#forgotpassworderror").html('Email not exits in mambodubai.');
                                            $("input[name='forgotemail']").focus();
                                            e.preventDefault();
                                            return false;

                                        } else {
                                            $('#successMail').css('display', 'contents');
                                            $('#forgotformid').css('display', 'none');
                                        }
                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        $("#forgotpass").text('Reset My Password');
                                        $("#forgotpass").prop('disabled', false);
                                        var msg = JSON.parse(XMLHttpRequest.responseText);
                                        console.log(msg);
                                    }
                                });
                            });

                            $("#successMail").on('click', function(e) {
                                $('#successMail').css('display', 'none');
                                $('#forgotformid').css('display', 'contents');
                            });

                        </script>

                        @yield('script')
                    </body>

                    </html>
