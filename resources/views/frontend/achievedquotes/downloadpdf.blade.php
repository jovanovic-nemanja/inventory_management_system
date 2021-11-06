@extends('layouts.appseller')


@section('content')

<!-- Map and From Area -->

<div class="col-md-9">
    <?php echo displayAlert(); ?>
    @if ($user_status == 1)
    <p style="color: red;">Your account was blocked by admin!</p>
    @endif
    <a href="/quote" class="btn btn-success" style="margin-left: 2%;">Back</a>
    <button class="btn  btn-success" id="makeQuotationPdf">PDF</button>
    <input type="hidden" id="pdfname" name="pdfname" value="QN{{ $quotes[0]->id }}">
    <br>
    <div class="row" id="sideview5">

        <div class="" style="width: 100%;">
            <div class="aHl"></div>
            <div id=":1c0" tabindex="-1"></div>
            <div id=":1cb" class="ii gt">
                <div id=":1cc" class="a3s aiL ">
                    <u></u>
                    <div style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000000; margin:30px;">
                        <div>
                            <table
                                style="border-collapse:collapse;width:44%;margin-bottom:20px; margin-right: 12%; float: left;">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;text-align:left;padding:7px">
                                            @if ($seller_detail[0]->company_logo != '')
                                            <img style="width: 200px;"
                                                src="{{ asset('uploads/') }}/{{ $seller_detail[0]->company_logo }}">
                                            @else
                                            <img style="width: 200px;"
                                                src="{{ asset('uploads/') }}/No-image-available.png">
                                            @endif
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <table style="border-collapse:collapse;width:44%;margin-bottom:20px">
                                <thead>
                                    <tr>

                                        <td
                                            style="font-size:29px;font-weight:bold;text-align:left;padding:7px;color:#d9534f">
                                            Archived QUOTATION</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td style="font-size:12px;text-align:left;padding:7px">
                                            Date : {{ $quotes[0]->created_at }}<br>
                                            Quotation Numnber: QN{{ $quotes[0]->id }}</td>
                                    </tr>
                                </tbody>
                            </table>


                            <br><br><br>




                            <table
                                style="border-collapse:collapse;width:44%;border-top:1px solid #264b72;margin-bottom:20px; margin-right: 12%; float: left;">
                                <thead>
                                    <tr>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                            Vendor</td>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-size:12px;text-align:left;padding:7px">
                                            {{ $seller_detail[0]->company_name }}<br>
                                            {{ $seller_detail[0]->company_address }}<br>
                                            {{ $seller_detail[0]->sellercountry }}<br>
                                            {{ $seller_detail[0]->phone_number }}<br>

                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <table
                                style="border-collapse:collapse;width:44%;border-top:1px solid #264b72;margin-bottom:20px">
                                <thead>
                                    <tr>

                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                            Ship To
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td style="font-size:12px;text-align:left;padding:7px">
                                            {{ $buyer_detail[0]->name }}<br>
                                            {{ $buyer_detail[0]->company_name }}<br>
                                            {{ $buyer_detail[0]->company_address }}<br>
                                            {{ $buyer_detail[0]->sellercountry }}<br>
                                            {{ $buyer_detail[0]->phone_number }}<br>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <table
                                style="border-collapse:collapse;width:100%;border-top:1px solid #264b72;border-left:1px solid #264b72;margin-bottom:20px">
                                <thead>
                                    <tr>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                            ITEM</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:left;padding:7px;color:#FFFF">
                                            DESCRIPTION</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:right;padding:7px;color:#FFFF">
                                            QTY</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:right;padding:7px;color:#FFFF">
                                            UNIT PRICE</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;background-color:#264b72;font-weight:bold;text-align:right;padding:7px;color:#FFFF">
                                            TOTAL</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:left;padding:7px">
                                            1
                                        </td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:left;padding:7px">
                                            {{ $quotes[0]->product_name }}</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                            {{ $quotes[0]->volume }} {{ $quotes[0]->unitname }}</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                            {{ number_format($quotes[0]->product_price, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                            {{ number_format($quotes[0]->product_price * $quotes[0]->volume, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                </tbody>

                                <tfoot>

                                    <tr>
                                        <td style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                            colspan="4"><b> SUBTOTAL:</b></td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                            {{ number_format($quotes[0]->product_price * $quotes[0]->volume, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                    @if ($quotes[0]->vat > 0)
                                    <tr>
                                        <td style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                            colspan="4"><b>VAT:</b></td>
                                        <td
                                            style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                            {{ number_format($quotes[0]->vat, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                    @endif
                                    {{-- <tr>
                                            <td style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                                colspan="4"><b>SHIPPING:</b></td>
                                            <td
                                                style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                {{ $quotes[0]->shipping_weight * $quotes[0]->shipping_price * $quotes[0]->volume }}.00
                                    {{ $quotes[0]->currency_name }}</td>
                                    </tr> --}}
                                    {{-- @if ($quotes[0]->other_price > 0)
                                            <tr>
                                                <td style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                                    colspan="4"><b>OTHER:</b></td>
                                                <td
                                                    style="font-size:12px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px">
                                                    {{ $quotes[0]->other_price }}.00 {{ $quotes[0]->currency_name }}
                                    </td>
                                    </tr>
                                    @endif --}}
                                    <tr>
                                        <td style="font-size:16px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;padding:7px"
                                            colspan="4"><b>TOTAL:</b></td>
                                        <td
                                            style="font-size:16px;border-right:1px solid #264b72;border-bottom:1px solid #264b72;text-align:right;">
                                            {{ number_format($quotes[0]->total_price, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                </tfoot>

                            </table>

                            <p style="margin-top:0px;margin-bottom:0px; text-align:center">Powered by <img width="90"
                                    height="40" src="{{ asset('newdesign/images/logo.png') }}"></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Map and From Area -->
@stop
