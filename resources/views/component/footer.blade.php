<footer>
    <div class="newletterprt">
        <div class="container-fluid">
            <div class="innerNewsletterprt">
                <div class="leftsubsTxt">
                    <img src="{{ asset('images/icon/subscribe-icon.png') }}" alt="img">
                    <div class="joinTxt">
                        <h2>Join our Newsletter Now</h2>
                        <p>Register now to get updates on promotions.</p>
                    </div>
                </div>
                <div class="rightsubsTxt">
                    <div class="subscribeInputprt">
                        <input type="text" placeholder="Enter email address">
                        <button class="subsbutton">SUBSCRIBE</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="upperer-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footercont">
                        <a href="index.html">
                            <img src="{{ asset('images/logo.png') }}" alt="logo">
                        </a>
                        <p>
                            Get connected with B2B sellers and buyers.
                            Now you can easily choose your preferred products, negotiate prices, and complete your
                            deals, because all these features are in one place. You can purchase wholesale from
                            reputable sellers offering an excellent choice of products in various categories.
                            And you can also sell to verified buyers through MamboDubai.com, by becoming a seller of
                            your own products
                        </p>
                        <ul class="social">
                            <li>
                                <a href="https://www.facebook.com/mambodubai" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/mambodubai" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.pinterest.com/mambodubai/" target="_blank">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/mambodubai-com/" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footercont">
                        <h2>About </h2>
                        <ul>
                            <li>
                                <a href="{{ route('home.aboutus') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('home.products') }}">Products</a>
                            </li>
                            <li>
                                <a href="{{ route('home.howtobuy') }}">How to Buy</a>
                            </li>
                            <li>
                                <a href="{{ route('home.howtosell') }}">How to Sell</a>
                            </li>

                            <li>
                                <a href="{{ route('home.ourgoal') }}">Our Goal</a>
                            </li>




                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footercont">
                        <h2>Buy Products</h2>
                        <ul>
                            <li>
                                <a href="/product?category=food-and-beverages">Food and Beverages</a>
                            </li>
                            <li>
                                <a href="/product?category=hospitality-industry">Hospitality</a>
                            </li>
                            <li>
                                <a href="/product?category=health-beauty-baby-care">Health & Beauty</a>
                            </li>
                            <li>
                                <a href="/product?category=health-beauty-baby-care">Baby Center</a>
                            </li>

                            <li>
                                <a href="{{ route('home.allcategory') }}">All Categories</a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footercont">
                        <h2>Information</h2>
                        <ul>

                            <li>
                                <a href="{{ route('home.bloghome') }}" target="_blank">Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('home.privacypolicy') }}">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="{{ route('home.termsconditions') }}">Terms & Conditions</a>
                            </li>
                            <li>
                                @guest
                                    <a class="btn btn-success" href="{{ route('login') }}"" style=" color: #fff;">Join
                                        Now</a>
                                @else

                                    @if (auth()->user()->hasRole('buyer'))
                                        <a class="btn btn-success" href="{{ route('buyerdashboard.index') }}"
                                            style="color: #fff;">My Account</a>
                                    @endif
                                    @if (auth()->user()->hasRole('seller'))
                                        <a class="btn btn-success" href="{{ route('sellerdashboard.index') }}"
                                            style="color: #fff;">My Account</a>
                                    @endif
                                @endguest
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="footercont">
                        <h2>Support</h2>
                        <span>
                            <i class="fa fa-envelope"></i>
                            info@mambodubai.com
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="downfooter">
        © 2021 MamboDubai.com All rights reserved.

    </div>
</footer>

<div class="arrowup">
    <a href="javascript:" id="return-to-top">
        <i class="fa fa-angle-up"></i>
    </a>
</div>



<!-- Login Modal -->
<div class="logpopup modal fade" id="logpopup">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->

            <button type="button" class="close" data-dismiss="modal">&times;</button>


            <!-- Modal body -->
            <div class="modal-body">
                <div class="loginbody logbody">
                    <h2>Login</h2>
                    <div class="form-section">
                        <div id="errmsg" style="color:red;"></div>
                        <form>

                            <div class="form-group logfield">
                                <i class="fa fa-envelope"></i>
                                <input type="text" name="user_email" placeholder="Email" class="form-control" />
                            </div>
                            <div class="form-group logfield">
                                <i class="fa fa-lock lock"></i>
                                <input type="password" name="user_password" placeholder="Your account password"
                                    class="form-control" />
                            </div>

                            <div class="remprt">
                                <span>
                                    <input type="checkbox" />
                                    Remember me
                                </span>
                                <span>
                                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgot-form">
                                        Forgot Password
                                    </a>
                                </span>
                            </div>
                            <button id="loginBtn" class="btn full-width margin20">Login</button>
                        </form>

                        <div class="orprt">OR</div>

                        <ul class="sociallog">
                            <li>
                                <a href="{{ route('facebook.login') }}">
                                    <i class="fa fa-facebook face"></i>
                                </a>

                            </li>
                            <li>
                                <a href="{{ route('linkedin.login') }}">
                                    <i class="fa fa-linkedin linkin"></i>
                                </a>

                            </li>
                            <li>
                                <a href="{{ route('google.login') }}">
                                    <i class="gplus">
                                        <img src="{{ asset('images/icon/gplusicon.png') }}" alt="icon" />
                                    </i>
                                </a>

                            </li>
                        </ul>

                        <p class="anotherlog">Not yet registered? <a href="#" class="linkankerRegi">(Create an account
                                here)</a></p>
                    </div>

                </div>

                <div class="loginbody regibox">
                    <h2>Register</h2>

                    <div class="tworegiselectprt">
                        <span>
                            <input id="chkbuyer" class="chkradio" type="radio" name="user" checked="checked"
                                value="buyerprt" />
                            <label style="color: red;">Buyer</label>
                        </span>
                        <span>

                            <input id="chkseller" class="chkradio" type="radio" name="user" value="sellerprt" />
                            <label style="color: blue;">Seller</label>
                        </span>
                    </div>
                    <div class="form-section">
                        <form>
                            <div class="buyerprt desc" id="buyerprt">

                                <h3 style="color: red;">Join as Buyer</h3>
                                <span id="buyererror" class="text-danger"></span>
                                <div class="form-group reg">
                                    <input type="text" name="buyer_user_name" placeholder="Name" class="form-control" />
                                </div>
                                <div class="form-group reg">
                                    <input type="text" name="buyer_phone" placeholder="Phone" class="form-control" />
                                </div>
                                <div class="form-group reg">
                                    <input type="text" placeholder="Email" class="form-control" name="buyer_name" />
                                </div>
                                <div class="form-group reg">
                                    <div class="form-group">
                                        <select name="buyer_country" id="buyer_country" required class="form-control">
                                            <option value="">Please Country</option>
                                            @foreach ($all_country as $country)

                                                <option value="{{ $country->id }}">{{ $country->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group reg">
                                    <input type="password" name="buyer_password" placeholder="Your password"
                                        class="form-control" />
                                </div>
                                <div class="form-group reg">
                                    <input type="password" name="buyer_password_confirmation"
                                        placeholder="Password Confirm" class="form-control" />
                                </div>
                            </div>

                            <div class="sellerprt desc" id="sellerprt">

                                <h3 style="color: blue;">Join as Seller</h3>
                                <span id="sellererror" class="text-danger"> </span>
                                <div class="form-group">
                                    <input type="text" name="seller_user_name" placeholder="Name"
                                        class="form-control reg" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="seller_phone" placeholder="Phone"
                                        class="form-control reg" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="seller_name" placeholder="Email"
                                        class="form-control reg" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="seller_password" placeholder="Your password"
                                        class="form-control reg" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="seller_password_confirmation"
                                        placeholder="Password Confirm" class="form-control reg" />
                                </div>
                            </div>



                            <button id="joinBtn" class="btn full-width margin20">Join Now</button>

                        </form>
                        <p class="anotherlog"> <a href="#" class="linkankerlog">Have an account already</a>
                        </p>


                        {{-- <div class="orprt">OR</div> --}}

                        {{-- <ul class="sociallog">
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook face"></i>
                                </a>

                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-linkedin linkin"></i>
                                </a>

                            </li>
                            <li>
                                <a href="#">
                                    <i class="gplus">
                                        <img src="{{ asset('images/icon/gplusicon.png') }}" alt="icon" />
                                    </i>
                                </a>

                            </li>
                        </ul> --}}

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>


<!-- Product Delete Modal -->

<div class="logpopup modal fade" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="modal-body">
                <div class="loginbody logbody">
                    <h2>Delete Product</h2>
                    <div class="form-section">
                        <form id="delete-form" action="" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <p style="text-align: center;">Do you want to delete the product? </p>
                            <div style="text-align:center;">
                                <button type="submit" class="btn margin20">Yes</button>
                                <button class="btn margin20" data-dismiss="modal">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Forgot Modal -->

<div class="logpopup modal fade" id="forgot-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="modal-body">
                <div class="loginbody logbody">
                    <h2>Forgot Pasword</h2>
                    <div class="form-section">
                        <form id="forgotformid">
                            <span id="forgotpassworderror" class="text-danger"></span>
                            <div class="form-group logfield">
                                <i class="fa fa-envelope"></i>
                                <input type="text" name="forgotemail" placeholder="Email address"
                                    class="form-control" />
                            </div>
                            <button id="forgotpass" class="btn full-width margin20">Reset My Password</button>
                        </form>
                        <div id="successMail" style="display: none">
                            <p style="text-align: center;">Reset password link has been sent to your registered email
                                address.
                                Please check your inbox to reset password.
                            </p>
                            <button class="btn full-width margin20" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


<!-- Buyer QuickView Modal -->

<div class="logpopup modal fade" id="buyerQuickView">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="modal-body">

                <div class="col-sm-12 box" id="sideview2">
                    <div class="text-center">Quotation</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Particulars</th>
                                <th scope="col">Value</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>Product Name</td>

                                <td id="modal_prod_name"> </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Product Unit</td>

                                <td id="modal_prod_unit"> </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Product Quantity</td>

                                <td id="modal_prod_volume"></td>
                            </tr>

                            <tr>
                                <th scope="row"></th>
                                <td>Product Unit Price</td>

                                <td id="alter_unit"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Subtotal</td>

                                <td id="buyer_product_subtotal"></td>
                            </tr>
                            <tr style="display:none;" id="alter_vat_display">
                                <th scope="row"></th>
                                <td>VAT (5%) </td>
                                <td id="alter_vat"></td>

                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td style="font-size:20px;"><strong>Total</strong></td>
                                <td><strong id="alter_total"></strong></td>

                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" id="buyerquoteid" name="quoteid">
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Shipping</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>Unit Weight</td>

                                <td id="alter_weight"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td id="alter_unit_price_text">Shipping Unit</td>

                                <td id="alter_unit_price"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Total Weight</td>

                                <td id="alter_total_weight"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td style="font-size:20px;">Subtotal</td>

                                <td id="buyer_shipping_subtotal">/td>
                        </tbody>

                    </table> --}}


                    {{-- <table class="table" style="display:none;" id="alter_other_display">
                        <thead>
                            <tr>
                                <th scope="col">Others</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <th scope="row"></th>
                                <td id="alter_other_display_text"></td>

                                <td id="alter_other"></td>
                            </tr>
                        </tbody>
                    </table> --}}

                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Price</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <th scope="row"></th>
                                <td>Subtotal</td>
                                <td id="alter_subtotal"></td>

                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Shipping total</td>
                                <td id="alter_total_ship_price"></td>

                            </tr>
                            <tr style="display:none;" id="alter_total_other_display">
                                <th scope="row"></th>
                                <td id="alter_total_other_display_text"></td>
                                <td id="alter_total_other"></td>

                            </tr>
                            <tr style="display:none;" id="alter_vat_display">
                                <th scope="row"></th>
                                <td>VAT (5%) </td>
                                <td id="alter_vat"></td>

                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td style="font-size:20px;"><strong>Total</strong></td>
                                <td><strong id="alter_total"></strong></td>

                            </tr>
                        </tbody>
                    </table> --}}

                    <div class="text-center" id="displayDiv">
                        <a class="btn margin20" href="#" id="acceptBtn"
                            style="color: #fff;margin-right:20px;">Accept</a>
                        <a class="btn margin20" href="#" id="rejectBtn" style="color: #fff">Reject</a>
                    </div>

                    <div class="text-center" id="acceptDiv" style="display: none;">
                        <a class="btn margin20" href="{{ route('purchaseorders.index') }}"
                            style="color: #fff;">Done</a>
                    </div>

                    <div class="text-center" id="rejectDiv" style="display: none;">
                        <button class="btn margin20" data-dismiss="modal" style="color: #fff;">Done</button>
                    </div>

                </div>



            </div>


        </div>
    </div>
</div>

<!-- Seller QuickView Modal -->


<div class="logpopup modal fade" id="sellerQuickView">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="modal-body">

                <div class="col-sm-12 box" id="sideview1">
                    <div class="text-center">Quotation</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Particulars</th>
                                <th scope="col">Value</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>Product Name</td>

                                <td id="seller_modal_prod_name"> </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Product Unit</td>

                                <td id="seller_modal_prod_unit"> </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Product Quantity</td>

                                <td id="seller_modal_prod_volume"></td>
                            </tr>

                            <tr>
                                <th scope="row"></th>
                                <td>Product Unit Price</td>

                                <td id="seller_alter_unit"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Subtotal</td>

                                <td id="product_subtotal">/td>
                            </tr>
                            <tr style="display:none;" id="seller_alter_vat_display">
                                <th scope="row"></th>
                                <td>VAT (5%)</td>
                                <td id="seller_alter_vat"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td style="font-size:20px;"><strong>Total</strong></td>
                                <td><strong id="seller_alter_total"></strong></td>

                            </tr>


                        </tbody>
                    </table>
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Shipping</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>Unit Weight</td>

                                <td id="seller_alter_weight"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td id="seller_alter_unit_price_text">Shipping Unit ()</td>

                                <td id="seller_alter_unit_price"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Total Weight</td>

                                <td id="seller_total_weight"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td style="font-size:20px;">Subtotal</td>

                                <td id="shipping_subtotal">/td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="display:none;" id="seller_alter_other_display">
                        <thead>
                            <tr>
                                <th scope="col">Others</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <th scope="row"></th>
                                <td id="seller_alter_other_display_text"></td>

                                <td id="seller_alter_other"></td>
                            </tr>
                        </tbody>
                    </table> --}}

                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Price</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>

                        <tbody>


                            <tr>
                                <th scope="row"></th>
                                <td>Subtotal</td>
                                <td id="seller_alter_subtotal"></td>

                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>Shipping Total</td>
                                <td id="seller_alter_total_ship_price"></td>

                            </tr>
                            <tr style="display:none;" id="seller_alter_total_other_display">
                                <th scope="row"></th>
                                <td id="seller_alter_total_other_display_text"></td>
                                <td id="seller_alter_total_other"></td>
                            </tr>
                            <tr style="display:none;" id="seller_alter_vat_display">
                                <th scope="row"></th>
                                <td>VAT (5%)</td>
                                <td id="seller_alter_vat"></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td style="font-size:20px;"><strong>Total</strong></td>
                                <td><strong id="seller_alter_total"></strong></td>

                            </tr>
                        </tbody>
                    </table> --}}
                    <!--<div class="text-center"><button class="btn margin20">approve</button>&nbsp;&nbsp;&nbsp;<button class="btn margin20">Reject</button></div>-->
                </div>



            </div>


        </div>
    </div>
</div>
<!-- Start of mambodubai Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=2776312f-b314-467c-ad24-70166f9c4243">
</script>
<!-- End of mambodubai Zendesk Widget script -->
