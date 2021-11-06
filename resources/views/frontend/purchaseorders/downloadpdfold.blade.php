@extends('layouts.appseller')


@section('content')

<!-- Map and From Area -->

<div class="col-md-9">
    <?php echo displayAlert(); ?>
    @if($user_status == 1)
    <p style="color: red;">Your account was blocked by admin!</p>
    @endif
    <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
    <button class="btn  btn-success" id="makePdf">Download</button>
    <br>
    <div class="row">

        <div class="col-sm-11 box" id="sideview5">
            <p class="text-center">



                @if($seller_detail[0]->company_logo != '')
                <img style="width: 200px;" src="{{ asset('uploads/') }}/{{ $seller_detail[0]->company_logo }}">
                @else
                <img style="width: 200px;" src="{{ asset('uploads/') }}/No-image-available.png">
                @endif
            </p>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Seller</th>
                        <th scope="col">Buyer</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"></th>
                        <td>Seller Name</td>

                        <td>Buyer Name</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>{{$seller_detail[0]->name}}<br>{{$seller_detail[0]->company_name}}</td>

                        <td>{{$buyer_detail[0]->name}}<br>{{$buyer_detail[0]->company_name}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">Quotation for</div>
            @if($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)
            <h3 class="text-center" id>{{$quotes[0]->name}}</h3>
            @else
            <h3 class="text-center" id>{{$quotes[0]->product_name}}</h3>
            @endif

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
                        <td>Product Unit</td>

                        <td>{{$quotes[0]->unitname}}</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Product Quantity</td>

                        <td>{{$quotes[0]->volume}}</td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td>Product Unit Price</td>
                        @if($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)
                        <td>{{$quotes[0]->alternative_product_price}}.00 {{$quotes[0]->currency_name}}</td>
                        @else
                        <td>{{$quotes[0]->product_price}} {{$quotes[0]->currency_name}}</td>
                        @endif
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td>Product Weight</td>

                        <td>{{$quotes[0]->shipping_weight}}</td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td>Shipping Unit Price / kilogram</td>

                        <td>{{$quotes[0]->shipping_price}} {{$quotes[0]->currency_name}}</td>
                    </tr>
                    @if($quotes[0]->other_price_desc != '' && $quotes[0]->other_price_desc != 0 )
                    <tr>
                        <th scope="row"></th>
                        <td>{{$quotes[0]->other_price_desc}} {{$quotes[0]->currency_name}}</td>

                        <td>{{$quotes[0]->other_price}} {{$quotes[0]->currency_name}}</td>
                    </tr>
                    @endif


                </tbody>
            </table>


            <h5 class="text-center">Total Price</h5>


            <table class="table">

                <tbody>


                    <tr>
                        <th scope="row"></th>
                        <td>Product Total</td>
                        @if($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)

                        <td>{{$quotes[0]->volume * $quotes[0]->alternative_product_price}}.00 {{$quotes[0]->currency_name}}</td>
                        @else
                        <td>{{$quotes[0]->volume * $quotes[0]->product_price}}.00 {{$quotes[0]->currency_name}}</td>
                        @endif

                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Shipping Total</td>
                        <td>{{$quotes[0]->shipping_weight * $quotes[0]->shipping_price * $quotes[0]->volume}}}.00 {{$quotes[0]->currency_name}}</td>

                    </tr>
                    @if($quotes[0]->other_price_desc != '' && $quotes[0]->other_price_desc != 0  )
                    <tr>
                        <th scope="row"></th>
                        <td>{{$quotes[0]->other_price_desc}}</td>

                        <td>{{$quotes[0]->other_price}} {{$quotes[0]->currency_name}}</td>

                    </tr>
                    @endif
                    <tr>
                        <th scope="row"></th>
                        <td><strong>Total</strong></td>
                        <td><strong>{{$quotes[0]->total_price}} {{$quotes[0]->currency_name}}</strong></td>

                    </tr>
                </tbody>
            </table>
            <p class="text-center">
                All right reserved by<br>
                <img src="{{ asset('newdesign/images/logo.png') }}" alt="logo" style="width: 80px; height: 40px;">
            </p>

        </div>

    </div>
</div>

<!-- End Map and From Area -->
@stop
