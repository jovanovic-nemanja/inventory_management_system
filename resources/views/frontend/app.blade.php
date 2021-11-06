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
            <title>@yield('main_title')</title>

            <meta name="title" content="@yield('title')">
            <meta name="keywords" content="@yield('keywords')">
            <meta name="description" content="@yield('description')">
        <?php } else { ?>
            <title>{{ $general_setting->site_name }}</title>

            <meta name="title" content="{{ $general_setting->meta_title }}">
            <meta name="keywords" content="{{ $general_setting->meta_keywords }}">
            <meta name="description" content="{{ $general_setting->meta_description }}">
        <?php } ?>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/bootstrap.min.css') }}" >

        <!-- font css -->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/font-awesome.min.css') }}"> --}}
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- animation css -->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/aos.css') }}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

        <!-- crousel css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/slick-theme.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.css" rel="stylesheet" />

        <!-- Custom Scrollbar Css -->
        <link type="text/css" href="{{ asset('newdesign/css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"
              rel="stylesheet">

        <!-- custom css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/main.css') }}">


        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('newdesign/css/responsive.css') }}">
        <script src="{{ asset('newdesign/js/jquery.min.js') }}" type="text/javascript"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V4LH8XSTEJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V4LH8XSTEJ');
</script>

    </head>
    <body>

        <div id="app">
            <!-- Header -->
            <header id="banner" class="fixed-header">
                <div class="top_header">
                    <div class="container-fluid">
                        <div class="inner_upheader">
                            <p>
<img src="{{ asset('newdesign/images/icon/welcome.png') }}" alt="icon" />We welcome you to MamboDubai.com
                            </p>
                            <div class="righticonprt">

                                {{-- <div class="dropdown">
                                    <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <img src="{{ asset('newdesign/images/icon/help.png') }}" alt="icon" />
                                        <span>Help & Support</span>
                                    </a>
                                    <div class="dropdown-menu leftdrop" aria-labelledby="dropdownMenuButton">
                                        We provide the opportunity for you to negotiate your requests for information and quotations with our sellers.
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
                                                    <input type="text" name="word" value="{{ app('request')->input('word') != '' ? app('request')->input('word') : ''}}" placeholder="What are you looking for?" />
                                                </div>

                                                <select name="category" id="category" >
                                                    <option value="all">All</option>
                                                    @foreach($categorys as $category)
                                                    <option name="category" value="{{ $category->slug }}" {{ app('request')->input('category') == $category->slug ? 'selected' : ''}}>{{ $category->name }}</option>
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
                                                        <input type="text" name="word" value="{{ app('request')->input('word') != '' ? app('request')->input('word') : ''}}" placeholder="What are you looking for?" />
                                                    </div>

                                                    <select name="category" id="category" >
                                                        <option value="all">All</option>
                                                        @foreach($categorys as $category)
                                                        <option name="category" value="{{ $category->slug }}" {{ app('request')->input('category') == $category->name ? 'selected' : ''}}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <button class="search" type="submit">
                                                    <img src="{{ asset('newdesign/images/icon/search.png') }}" alt="search">
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
                                                    @php $first_name = $iparr = preg_split("/[\s,]+/",Auth::user()->name);
                                                    @endphp
                                                    {{$first_name[0] }}
                                                    (
                                                    @if(auth()->user()->hasRole('buyer'))
                                                    Buyer
                                                    @else
                                                     Seller
                                                    @endif
                                                    )</span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <ul>
                                                    @if(auth()->user()->hasRole('buyer'))
                                                    <li>
                                                        <a href="{{ route('buyerdashboard.index')}}"><i class="fa fa-server"></i> Dashboard
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @if(auth()->user()->hasRole('seller'))
                                                    <li>
                                                        <a href="{{ route('sellerdashboard.index')}}"><i class="fa fa-server"></i> Dashboard </a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('account')}}"><i class="fa fa-address-card-o"></i> My Profile
                                                        </a>
                                                    </li>
                                                    @if(auth()->user()->hasRole('seller'))
                                                    <li>
                                                        <a href="{{ route('product.my')}}"><i class="fa fa-database"></i> Products
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{ route('request.index')}}"><i class="fa fa-question-circle"></i> Request
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('quote.index')}}"><i class="fa fa-sticky-note-o"></i> Quotes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('purchaseorders.index')}}"><i class="fa fa-shopping-cart"></i> Purchase Order
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('purchaseorders.create')}}"><i class="fa fa-check-circle"></i> Completed Order
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('achieved.index')}}"><i class="fa fa-tags"></i> Archieved Quotes
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('requestcallback.index')}}"><i class="fa fa-phone"></i> Request Call Back
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>

                                                    </li>

                                                </ul>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>

                                        </li>
                                        @endguest

                                        <!-- AFTER LOGIN -->
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('newdesign/images/icon/message.png') }}" alt="message">
                                            </a>

                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('newdesign/images/icon/request.png') }}" alt="request">
                                            </a>

                                        </li>
                                    </ul>
                                </div>

                            </div>


                            <div class="side-nav">

                                <button type="button" class="closebtn sidemenuclose ml-auto">×</button>
                                <div class="mobile-links-section">
                                    <div class="categories-links mCustomScrollbar">
                                        <div class="categories_link_toggle">


                                            <div class="mobile_link_toggle d-md-block position-relative">


                                                @php($count=1)
                                                @foreach($main_categorys as $main_cat)

                                                <div class="mobile-link" id="subFullsection-{{$main_cat->id}}">
                                                    <h2>
                                                        <a href="./../../product?category={{ $main_cat->slug }}">
                                                            <img src="{{ asset('images/icon/menu-icon'.$count.'.png') }}" alt="icon">
                                                            {{$main_cat->name}}

                                                        </a>
                                                        <i id="subFullsectionMobile-{{$main_cat->id}}"><img src="{{ asset('images/icon/arrow.png') }}" alt="icon"></i>
                                                    </h2>
                                                </div>
                                                @php($count++)
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>



                                    @foreach($main_categorys as $main_cat1)
                                    <div class="category-submenu mCustomScrollbar" id="newsubFullsection-{{$main_cat1->id}}" >
                                        <div class="subFullsection">
                                            <button type="button" class="subclosebtn sidemenuclose ml-auto">×</button>
                                            @foreach($sub_categorys as $sub_cat)



                                            @if($sub_cat->parent == $main_cat1 -> id)
                                            @php($sub_sub_cat = $sub_cat->id)
                                            <div class="submenu-section">
                                                <h2 class="submenu-section-title">
                                                    <a href="./../../product?category={{ $sub_cat->slug }}">  {{$sub_cat->name}} </a>
                                                </h2>
                                                @foreach($sub_categorys as $sub_cat)
                                                @if($sub_cat->parent == $sub_sub_cat)
                                                <h3 class="submenu-section-link">
                                                    <a href="./../../product?category={{ $sub_cat->slug }}"> {{$sub_cat->name}} </a>
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
                <div id="overlay" class="overlay"></div>
            </header>





            @yield('content')


            @include('component.footer')

        </div>

    <flash-message message="{{ session('flash') }}" />



    <script src="{{ asset('newdesign/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>

    <script src="{{ asset('newdesign/js/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.min.js"></script>
    <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js" type="text/javascript" charset="utf-8"></script>



    <!-- animation js -->
    <script src="{{ asset('newdesign/js/aos.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>


    <!-- custom js -->
    <script src="{{ asset('newdesign/js/main.js') }}" type="text/javascript"></script>

    <script src="{{ asset('newdesign/js/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>

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
                                                                        if(email == 'blog@mambodubai.com'){
                                                                            window.location.href = "/bloghome";
                                                                        }else{
                                                                            location.reload();
                                                                        }
                                                                    },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
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
if (role == 'buyerprt'){

var user_name = $("input[name='buyer_user_name']").val();
var phone = $("input[name='buyer_phone']").val();
var email = $("input[name='buyer_name']").val();
var buyer_country = $("#buyer_country").val();
var password = $("input[name='buyer_password']").val();
var password_confirmation = $("input[name='buyer_password_confirmation']").val();
var password_confirmation = $("input[name='buyer_password_confirmation']").val();
role = 'buyer';
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
$('#buyererror span').html('');
if (user_name == ''){
$('#buyererror').html('Name is required.');
$("input[name='buyer_user_name']").focus();
e.preventDefault();
return false;
} else if (isNaN(user_name) == false){
$('#buyererror').html('Name must be in Character.');
$("input[name='buyer_user_name']").focus();
event.preventDefault();
return false;
} else if (user_name.length < 2 || user_name.length > 20) {
$('#buyererror').html('The Fisrt name must be between 2 and 20 words .');
$("input[name='buyer_user_name']").focus();
event.preventDefault();
return false;
} else if (email == ''){
$('#buyererror').html('Email is required.');
$("input[name='buyer_name']").focus();
event.preventDefault();
return false;
} else if (!emailReg.test(email)){
$('#buyererror').html('Email should be Valid.');
$("input[name='buyer_name']").focus();
event.preventDefault();
return false;
}else if (buyer_country == ''){
$('#buyererror').html('Country is required.');
$("input[name='buyer_country']").focus();
event.preventDefault();
return false;
} else if (phone == ''){
$('#buyererror').html('Phone is required.');
$("input[name='buyer_phone']").focus();
event.preventDefault();
return false;
} else if (isNaN(phone) == true){
$('#buyererror').html('Phone must be in numeric.');
$("input[name='buyer_phone']").focus();
event.preventDefault();
return false;
} else if (password == ''){
$('#buyererror').html('Password is required.');
$("input[name='buyer_password']").focus();
event.preventDefault();
return false;
} else if (password.length <= 5) {
$('#buyererror').html('Password length must be more than 5 character ');
$("input[name='buyer_password']").focus();
event.preventDefault();
return false;
} else if (password_confirmation == ''){
$('#buyererror').html('Confirm Password is not same.');
$("input[name='buyer_password_confirmation']").focus();
event.preventDefault();
return false;
} else if (password != password_confirmation){
$('#buyererror').html('Password mismatch.');
$("input[name='buyer_password_confirmation']").focus();
event.preventDefault();
return false;
}


} else{
var user_name = $("input[name='seller_user_name']").val();
var phone = $("input[name='seller_phone']").val();
var email = $("input[name='seller_name']").val();
var buyer_country = '1';
var password = $("input[name='seller_password']").val();
var password_confirmation = $("input[name='seller_password_confirmation']").val();
role = 'seller';
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
$('#sellererror span').html('');
if (user_name == ''){
$('#sellererror').html('Name is required.');
$("input[name='seller_user_name']").focus();
e.preventDefault();
return false;
} else if (isNaN(user_name) == false){
$('#sellererror').html('Name must be in Character.');
$("input[name='seller_user_name']").focus();
event.preventDefault();
return false;
} else if (user_name.length < 2 || user_name.length > 20) {
$('#sellererror').html('The Fisrt name must be between 2 and 20 words .');
$("input[name='seller_user_name']").focus();
event.preventDefault();
return false;
} else if (email == ''){
$('#sellererror').html('Email is required.');
$("input[name='seller_name']").focus();
event.preventDefault();
return false;
} else if (!emailReg.test(email)){
$('#sellererror').html('Email should be Valid.');
$("input[name='seller_name']").focus();
event.preventDefault();
return false;
} else if (phone == ''){
$('#sellererror').html('Phone is required.');
$("input[name='seller_phone']").focus();
event.preventDefault();
return false;
} else if (isNaN(phone) == true){
$('#sellererror').html('Phone must be in numeric.');
$("input[name='seller_phone']").focus();
event.preventDefault();
return false;
} else if (password == ''){
$('#sellererror').html('Password is required.');
$("input[name='seller_password']").focus();
event.preventDefault();
return false;
} else if (password.length <= 5) {
$('#sellererror').html('Password length must be more than 5 character ');
$("input[name='seller_password']").focus();
event.preventDefault();
return false;
}
else if (password_confirmation == ''){
$('#sellererror').html('Confirm Password is required.');
$("input[name='seller_password_confirmation']").focus();
event.preventDefault();
return false;
} else if (password != password_confirmation){
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
                country:buyer_country,
                password: password,
                password_confirmation:password_confirmation,
                role: role
        },
        success: function(data) {
        if (data == 'checkverify'){

        $("#" + role + "error").html('Sorry ! This email is not verified yet.');
        } else{
        window.location = '../verify_check/' + email;
        }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        var msg = JSON.parse(XMLHttpRequest.responseText);
        console.log(msg.message);
        $("#" + role + "error").html('Sorry !This email is already registered with us.');
        }
});
});
$("#askForPrice").click(function(e) {
                                                                e.preventDefault();
                                                                @guest
                                                                        $('#logpopup').modal('show');
                                                                @else
                                                                var qty =  $('#quantity').val();
                                                                $('#minimum_quantity').val(qty);
                                                                        $('#reqQutoPopup').modal('show');
                                                                @endguest
                                                                });
$("#resForQuota").click(function(e) {

e.preventDefault();
@guest
        $('#logpopup').modal('show');
@else
        var chkqty = $('#quantity').val();
$('#minimum_quantity').val(chkqty);
$('#reqQutoPopup').modal('show');
@endguest
});
$("#mblresForQuota").click(function(e) {

e.preventDefault();
@guest
        $('#logpopup').modal('show');
@else
        var chkqty = $('#quantity').val();
$('#minimum_quantity').val(chkqty);
$('#reqQutoPopup').modal('show');
@endguest
});
$(".removeError").click(function(e) {
$('#rQutaionError').html('');
});
$(".removeError").keyup(function(e) {
$('#rQutaionError').html('');
});
$("#reqSubmitBtn").click(function(e) {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
e.preventDefault();
$("#reqSubmitBtn").attr("disabled", true);
$("#reqSubmitBtn").text('Submit Processing');
var formData = $('#reqQutoPopup form').serializeArray();
if (formData[2].value <= 0){
$('#rQutaionError').html('Quantity should be valid.');
$("#minimum_quantity").focus();
e.preventDefault();
return false;
} else if (isNaN(formData[2].value) == true){
$('#rQutaionError').html('Quantity must be in numeric.');
$("#minimum_quantity").focus();
e.preventDefault();
return false;
} else if (formData[5].value == ''){
$('#rQutaionError').html('Additional Information is required !');
$("#additional_info").focus();
e.preventDefault();
return false;
}



$.ajax({
url: '{{ route('request.store') }}',
        type: 'POST',
        data:  {
        product_id: formData[0].value,
                unit:formData[1].value,
                req_quantity:formData[2].value,
                volume: formData[3].value,
                port_of_destination: formData[4].value,
                description: formData[5].value,
                product_name: formData[6].value
        },
        success: function(data) {
            $("#reqSubmitBtn").attr("disabled", false);
            $("#reqSubmitBtn").text('Submit');
        $("#reqQutoFrm").trigger('reset');
        $('#reqQutoFrm').css('display', 'none'); $('#requestSuccessTxt').css('display', 'contents');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $("#reqSubmitBtn").attr("disabled", false);
            $("#reqSubmitBtn").text('Submit');
        var msg = JSON.parse(XMLHttpRequest.responseText);
        console.log(msg);
        }
});
});
$("#successBtn").click(function(e) {
e.preventDefault(); $("#reqQutoFrm").css("display", "contents");
$("#requestSuccessTxt").css("display", "none");
});
$("#callbackSubmitBtn").click(function(e) {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
e.preventDefault();
var formData = $('#normalpopup form').serializeArray();
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if (formData[1].value == ''){
$('#reqCallBackError').html('Name is required.');
$("#reqCallBackName").focus();
e.preventDefault();
return false;
} else if (isNaN(formData[1].value) == false){
$('#reqCallBackError').html('Name must be in Character.');
$("#reqCallBackName").focus();
e.preventDefault();
return false;
} else if (formData[2].value == ''){
$('#reqCallBackError').html('Email is required');
$("#reqCallBackEmail").focus();
e.preventDefault();
return false;
} else if (!emailReg.test(formData[2].value)){
$('#reqCallBackError').html('Email should be Valid.');
$("#reqCallBackEmail").focus();
e.preventDefault();
return false;
} else if (formData[3].value == ''){
$('#reqCallBackError').html('Mobile is required.');
$("#reqCallBackMobile").focus();
e.preventDefault();
return false;
}


//                                                            $('#normalpopup').reset();
$.ajax({
url: '{{ route('requestcallback.storeCallback') }}',
        type: 'POST',
        data:  {
        product_id: formData[0].value,
                email_add:formData[2].value,
                name:formData[1].value,
                mobile:formData[3].value,
                message:formData[4].value
        },
        success: function(data) {
        $("#reqCallBackForm").trigger('reset');
        $('#reqCallBackForm').css('display', 'none');
        $('#reqCallBackSuccessTxt').css('display', 'contents');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        var msg = JSON.parse(XMLHttpRequest.responseText);
        console.log(msg);
        }
});
});
});
$("#reqCallBackSuccessBtn").click(function(e) {
e.preventDefault(); $("#reqQutoFrm").css("display", "contents");
$("#reqCallBackSuccessTxt").css("display", "none");
$("#reqCallBackForm").css("display", "contents");
});
$(".reqCallBackErrChk").keyup(function(e) {
$('#reqCallBackError').html('');
});
    </script>
    <script>
        $("#submitRegister").on('click', function(event) {
        //event.preventDefault();
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var country = $('#country').val();
        var email = $('#emailRegister').val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        //var emailReg = '/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i';
        var mobile = $('#mobile').val();
        var passsword = $('#passwordsignin').val();
        var message = $('#reqCallBackMessage').val();
        $('.error').html('');
        if (first_name == ''){
        $('#first_name').closest('.form-group').find('.error').html('**First Name is required.');
        $("#first_name").focus();
        event.preventDefault();
        return false;
        } else if (isNaN(first_name) == false){
        $('#first_name').closest('.form-group').find('.error').html('**First Name must be in Character.');
        $("#first_name").focus();
        event.preventDefault();
        return false;
        } else if (first_name.length < 2 || first_name.length > 20) {
        $('#first_name').closest('.form-group').find('.error').html('**The Fisrt name must be between 2 and 20 words .');
        $('#first_name').focus();
        event.preventDefault();
        return false;
        } else if (last_name == ''){
        $('#last_name').closest('.form-group').find('.error').html('**Last Name is required.');
        $("#last_name").focus();
        event.preventDefault();
        return false;
        } else if (isNaN(last_name) == false){
        $('#last_name').closest('.form-group').find('.error').html('**Last Name must be in Character.');
        $("#last_name").focus();
        event.preventDefault();
        return false;
        } else if (last_name.length < 2 || last_name.length > 20) {
        $('#last_name').closest('.form-group').find('.error').html('**The Last name must be between 2 and 20 words .');
        $('#last_name').focus();
        event.preventDefault();
        return false;
        } else if (country == ''){
        $('#country').closest('.form-group').find('.error').html('**Country is required.');
        $("#country").focus();
        event.preventDefault();
        return false;
        } else if (email == ''){
        $('#emailRegister').closest('.form-group').find('.error').html('**Email is required.');
        $("#emailRegister").focus();
        event.preventDefault();
        return false;
        } else if (!emailReg.test(email)){
        $('#emailRegister').closest('.form-group').find('.error').html('**Email should be Valid.');
        $("#emailRegister").focus();
        event.preventDefault();
        return false;
        } else if (mobile == ''){
        $('#mobile').closest('.form-group').find('.error').html('**Mobile is required.');
        $("#mobile").focus();
        event.preventDefault();
        return false;
        } else if (isNaN(mobile) == true){
        $('#mobile').closest('.form-group').find('.error').html('**Mobile must be in numeric.');
        $("#mobile").focus();
        event.preventDefault();
        return false;
        } else if (passsword == ''){
        $('#passwordsignin').closest('.form-group').find('.error').html('**Password is required.');
        $("#passwordsignin").focus();
        event.preventDefault();
        return false;
        }

        //  return false;

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
        if (email == ''){
    $("#forgotpassworderror").html('Email is required.');
    $("input[name='forgotemail']").focus();
    e.preventDefault();
    return false;
    } else if (!emailReg.test(email)){
    $("#forgotpassworderror").html('Email should be Valid.');
    $("input[name='forgotemail']").focus();
    e.preventDefault();
    return false;
    }
        $.ajax({
            url: '{{ route('password.forgot') }}',
    type: 'POST',
    data:  {
    email:email
    },
    success: function(data) {
        console.log(data);
        if(data.msg == 'no'){
            $("#forgotpassworderror").html('Email not exits in MamboDubai.com');
            $("input[name='forgotemail']").focus();
            e.preventDefault();
                return false;

        }else{
            $('#successMail').css('display','contents');
        $('#forgotformid').css('display','none');
        }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    // var msg = JSON.parse(XMLHttpRequest.responseText);
    var msg = JSON.parse(XMLHttpRequest);
    console.log(msg);
    }
});
    });
     $("#successMail").on('click', function(e) {
        $('#successMail').css('display','none');
        $('#forgotformid').css('display','contents');
    });
</script>
    @yield('script')
</body>
</html>
