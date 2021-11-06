@extends('layouts.admin')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Email Template List</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"> Template List</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:730px">
                            <tbody>
                                <tr>
                                    <td width="30" bgcolor="#ffa5a2" background="#">
                                        <table width="90%" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:590px">
                                            <tbody>
                                                <tr>
                                                    <td height="40">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#264b72" align="center" style="font-family:Calibri;">
                                                        &nbsp;
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td bgcolor="#FFFFFF" style="font-family:Calibri; font-size:15px; color:#231f20;font-weight:normal">
                                                        <table width="92%" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:520px">
                                                            <tr>
                                                                <td height="88" bgcolor="#FFFFFF" style="text-align:center; padding: 10px 0;">
                                                                    <a target="_blank" href="https://mambodubai.com" alt="" class="CToWUd">
                                                                        <img src="https://mambodubai.com/images/logo.png" alt="#" />
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="1" bgcolor="#f2f2f2"></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="15">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <p style="font-size: 20px; margin-bottom: 0;"><strong>Hi <span style="color: #df3762;">USER NAME,</span></strong>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="35">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>

                                                                    <p style="font-size: 16px; margin-bottom: 0;">
                                                                        <?php echo html_entity_decode($template->email_body) ?>
                                                                    </p>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="25">&nbsp;</td>
                                                            </tr>

                                                            <tr>
                                                                <td align="center">
                                                                    <div style="width:200px; height:200px;">
                                                                        <img src="https://mambodubai.com/uploads/170X170/H7d93f3280c714c6ab16e206bd37cfb76g.jpg" style="width:100%; height:100%; object-fit: cover;">
                                                                    </div>
                                                                    <h5 style="text-transform: uppercase; font-size: 18px; color: #000; margin-top: 10px; margin-bottom: 10px; letter-spacing: 1px; padding: 0 10%;">
                                                                        PRODUCT NAME
                                                                    </h5>

                                                                    <p style="color: #3b3b3b; opacity: 0.6;"> CATEGORY NAME</p>

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td height="30">&nbsp;</td>
                                                            </tr>

                                                            <tr>
                                                                <td bgcolor="#fbfbfb" style="color:#231f20; padding: 20px; border:1px solid #ccc3c4; border-radius: 20px;">
                                                                    <strong style="font-size: 18px; letter-spacing: 1px;">
                                                                        REQUEST FOR QUOTATION DETAILS
                                                                    </strong>
                                                                    <span style="margin-top: 15px; display: block;">
                                                                        <strong style="padding-right: 20px; width: 200px; display: inline-block;">Product
                                                                            Company Name:
                                                                        </strong>
                                                                        COMPANY NAME
                                                                    </span>
                                                                    <span style="margin-top: 15px; display: block;">
                                                                        <strong style="padding-right: 20px; width: 200px; display: inline-block;">
                                                                            Product Name:
                                                                        </strong>
                                                                        <div style="display: inline-block; width:250px; vertical-align: top; color: #5e95aa;">
                                                                            PRODUCT NAME
                                                                        </div>

                                                                    </span>
                                                                    <span style="margin-top: 15px; display: block;">
                                                                        <strong style="padding-right: 20px; width: 200px; display: inline-block;">
                                                                            Product Unit:
                                                                        </strong>
                                                                        PRODUCT UNIT
                                                                    </span>
                                                                    <span style="margin-top: 15px; display: block;">
                                                                        <strong style="padding-right: 20px; width: 200px; display: inline-block;">Product
                                                                            Order Quantity:
                                                                        </strong>
                                                                        OQ
                                                                    </span>
                                                                    <span style="margin-top: 15px; display: block;">
                                                                        <strong style="padding-right: 20px; width: 200px; display: inline-block;">
                                                                            Additional Information:
                                                                        </strong>
                                                                        A I
                                                                    </span>

                                                                    <span style="margin-top: 15px; display: block;">
                                                                        <strong style="padding-right: 20px; width: 200px; display: inline-block;">
                                                                            Request Posted On:
                                                                        </strong>
                                                                        DATE
                                                                    </span>

                                                                    <a href="" target="_blank">
                                                                        <button style="background: #d9534f; color: #fff; padding:10px 25px; border-radius: 10px; border:none; cursor: pointer;margin-left:36%;">
                                                                            View Now
                                                                        </button>
                                                                    </a>

                                                                </td>
                                                            </tr>


                                                            <tr>
                                                                <td height="25">&nbsp;</td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <p>
                                                                        <strong>CUSTOMER SERVICE</strong>
                                                                    </p>
                                                                    <p style="color: #4a4747; font-size: 14px;">
                                                                        <strong>
                                                                            If you’ve got any questions you can contact instabeuaty or
                                                                        </strong>

                                                                    </p>

                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td style="font-size: 17px;">
                                                                    <span style="color: #5e95aa;">
                                                                        Email: info@mambodubai.com
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="40">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>



                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td bgcolor="#3d3d3d">
                                        <table width="92%" cellspacing="0" cellpadding="0" border="0" align="center" style="max-width:507px">
                                            <tbody>
                                                <tr>
                                                    <td align="center" height="100">
                                                        <a href="https://www.facebook.com/mambodubai" target="_blank" style="margin-right: 20px; text-decoration: none;">
                                                            <img src="https://mambodubai.com/images/mail-images/face-book.png" alt="#" />
                                                        </a>
                                                        <a href="https://twitter.com/mambodubai" target="_blank" style="margin-right: 20px; text-decoration: none;">
                                                            <img src="https://mambodubai.com/images/mail-images/twitter.png" alt="#" />
                                                        </a>
                                                        <a href="https://www.pinterest.com/mambodubai" target="_blank" style="margin-right: 20px; text-decoration: none;">
                                                            <img src="https://mambodubai.com/images/mail-images/pinterest.png" alt="#" />
                                                        </a>
                                                        <a href="https://www.linkedin.com/company/mambodubai-com" target="_blank" style="margin-right: 20px; text-decoration: none;">
                                                            <img src="https://mambodubai.com/images/mail-images/linkedin.png" alt="#" />
                                                        </a>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td height="1" bgcolor="#534f50" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Calibri; color: #fff; font-size: 14px;" colspan="2" align="center">
                                                        <p>

                                                            Get connected with B2B sellers and buyers. Now you can easily choose your
                                                            preferred products,
                                                            negotiate prices, and
                                                            complete your deals, because all these features are in one place. You can
                                                            purchase wholesale from
                                                            reputable sellers
                                                            offering an excellent choice of products in various categories. And you can also
                                                            sell to verified
                                                            buyers through
                                                            MamboDubai.com, by becoming a seller of your own products

                                                        </p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td height="15">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-family:Calibri; color: #d5cece; font-size: 14px;" align="center">
                                                        <a href="https://mambodubai.com/about-us" style="color: #fff;">About us</a> |
                                                        <a href="https://mambodubai.com/products" style="color: #fff;">Products</a> |
                                                        <a href="https://mambodubai.com/blog" style="color: #fff;">Blog</a> |
                                                        <a href="https://mambodubai.com/privacy-policy" style="color: #fff;">Privacy
                                                            Policy</a> |
                                                        <a href="https://mambodubai.com/terms-conditions" style="color: #fff;">Terms &
                                                            Conditions</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="font-family:Calibri; color: #d5cece; font-size: 14px;" align="center">
                                                        <p>All rights reserved MamboDubai.com</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="15">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop