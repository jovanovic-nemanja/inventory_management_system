@extends('layouts.appseller')

@section('content')

<!-- Map and From Area --> 

<div class="col-md-9">
    <h4>Purchase Orders Status Change (<span style="color: red;">{{ $record->getstatus($record->payment_status) }}</span>) </h4><br/>
    @if($user_status == 1)
    <p style="color: red;">Your account was blocked by admin!</p>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('purchaseorders.update') }}" method="POST" id="payment_status_change">
                <h4>To change the payment status, please fill the payment information.</h4><br>
                <div class="form-group col-md-5">
                    <label>Status</label>
                    <select class="form-control status" id="status">
                        <option value="">choose</option>
                        @if($record->payment_status == 1)
                        <option value="1">Delivered</option>
                        @elseif($record->payment_status == 2)
                        <option value="1">Delivery Fine</option>
                        @endif
                    </select>
                </div>

                <div class="form-group col-md-10">
                    <label>Information</label>
                    @csrf
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <textarea rows="8" name="payment_information" id="payment_information" placeholder="How was the delivery?" class="form-control " required></textarea>
                </div>

                <button type="submit" class="btn btn-success" style="margin-left: 2%;">Submit</button>

            </form>
        </div>

        <div class="col-sm-6 box" id="sideview5">
            <div class="text-center">New Quotation for</div>
            <h3 class="text-center" id>Product name</h3>
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

                        <td>unitname</td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Product Volumn</td>

                        <td>volume</td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td>Product Unit Price</td>

                        <td id="right_avail_unit"></td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td>Product Weight</td>

                        <td id="right_avail_weight"></td>
                    </tr>

                    <tr>
                        <th scope="row"></th>
                        <td id="right_avail_unit_price_text">Shipping Unit Price / kilogram</td>

                        <td id="right_avail_unit_price"></td>
                    </tr>
                    <tr style="display:none;" id="right_avail_other_display">
                        <th scope="row"></th>
                        <td id="right_avail_other_display_text"></td>

                        <td id="right_avail_other"></td>
                    </tr>


                </tbody>
            </table>


            <h5 class="text-center">Total Price</h5>


            <table class="table">

                <tbody>


                    <tr>
                        <th scope="row"></th>
                        <td>Sub Total</td>
                        <td id="right_avail_subtotal"></td>

                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td>Shipping Price</td>
                        <td id="right_avail_total_ship_price"></td>

                    </tr>
                    <tr style="display:none;" id="right_avail_total_other_display">
                        <th scope="row"></th>
                        <td id="right_avail_total_other_display_text" ></td>
                        <td id="right_avail_total_other"></td>

                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td><strong>Total</strong></td>
                        <td><strong id="right_avail_total"></strong></td>

                    </tr>
                </tbody>
            </table>
           
        </div>
    </div>
</div>

<!-- End Map and From Area --> 
@stop
