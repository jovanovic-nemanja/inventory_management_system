@extends('layouts.appseller')

@section('content')

    <!-- Map and From Area -->
    <div class="col-md-9">

        <?php echo displayAlert(); ?>
        <style type="text/css">
            .alternate {
                display: none;
            }

            .table {
                width: auto !important
            }

        </style>
        <style>
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }

        </style>

        <div class="formPrtt">
            <h3>New Quote</h3>
            <form method="post" enctype="multipart/form-data" action="{{ route('quote.store') }}">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <input type="hidden" id="currency" value="{{ $data['currency_name'] }}">
                        <input type="hidden" name="currency_id" value="{{ $data['currency_id'] }}">
                        <input type="hidden" id="prod_quantity" value="{{ $data['req_quantity'] }}">
                        <input type="hidden" id="vat" name="vat" value="0">
                        <ul class="productDesc" id="main_product_desc">
                            <li>Product Name : {{ $data['product_name'] }}</li>
                            <li>Product Unit : {{ $unitname->name }}</li>
                            <li>Product Quantity: {{ $data['req_quantity'] }} {{ $unitname->name }}</li>
                            <li>Product Currency: {{ $data['currency_name'] }}</li>

                        </ul>

                        <ul class="productDesc alternate" id="alternative_product_desc">
                            <li id="prodname">Product Name : Alternative Product title</li>
                            <li id="produnit">Unit : </li>
                            <li id="prodvolume">Quantity : </li>

                        </ul>

                        <div class="form-group">
                            <label>Product is available ?</label>
                            <div class="radioprt">
                                <div class="listitem-check">
                                    <input type="radio" name="product_available" id="product_available_yes"
                                        class="product_available" value="1">
                                    <label onClick="">Yes</label>
                                </div>
                                <div class="listitem-check">
                                    <input type="radio" name="product_available" id="product_available_no"
                                        class="product_available" value="0">
                                    <label onClick="">No</label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="product_name" value="{{ $data['product_name'] }}">
                        <input type="hidden" name="volume" id="volume" value="{{ $data['req_quantity'] }}">
                        <input type="hidden" name="unit" value="{{ $data['unit'] }}">
                        <div class="form-group alternate">
                            <label>Product Name:</label>

                            <select class="form-control" id="alternative_product" name="alternative_product">
                                <option value="">Select Product</option>
                                @foreach ($myproducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id='product_yes' style="display: none;">
                            <div class="form-group alternate">
                                <label>Product Quantity:</label>
                                {{-- <input type="text" placeholder="Product Quantity" name="product_volume" id="product_volume"
                                    class="form-control" /> --}}
                                <input type="hidden" name="product_volume" id="product_volume"
                                    value="{{ $data['req_quantity'] }}">

                            </div>

                            <div class="form-group">
                                <input type="hidden" value="{{ $unitname->name }}" id="avail_prod_unit_name">
                                <label id="prod_unit_name">Product Unit Price ({{ $unitname->name }}):</label>
                                <input type="number" min=0 name="alternative_product_price" id="alternative_product_price"
                                    placeholder=" Unit Price" class="form-control" />
                            </div>


                            {{-- <div class="form-group">
                                <label>Do you want to include Shipping Cost ?</label>
                                <div class="radioprt">
                                    <div class="listitem-check">
                                        <input type="radio" name="shipping_available" id="shipping_available_yes"
                                            class="shipping_available" value="1">
                                        <label onClick="">Yes</label>
                                    </div>
                                    <div class="listitem-check">
                                        <input type="radio" name="shipping_available" id="shipping_available_no"
                                            class="shipping_available" value="0">
                                        <label onClick="">No</label>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div id="shipping_yes" style="display: none;">

                                <div class="form-group">
                                    <label>Product Unit Weight :</label>
                                    <input type="number" name="shipping_weight" id="shipping_weight" min="0" value="0"
                                        class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label>Shipping Unit:</label>

                                    <select class="form-control" name="shipping_unit" id="shipping_unit">
                                        <option value="">Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Shipping Unit Price:</label>
                                    <input type="number" name="shipping_price" id="shipping_unit_price" value="0" min="0"
                                        class="form-control" />
                                </div>

                            </div> --}}

                            {{-- <div class="form-group">
                                <label>Do you want to add any additional charges ?</label>
                                <div class="radioprt">
                                    <div class="listitem-check">
                                        <input type="radio" name="others_available" id="others_available_yes"
                                            class="others_available" value="1">
                                        <label onClick="">Yes</label>
                                    </div>
                                    <div class="listitem-check">
                                        <input type="radio" name="others_available" id="others_available_no"
                                            class="others_available" value="0">
                                        <label onClick="">No</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div id="others_yes" style="display: none;">
                                <div class="form-group">
                                    <label>Additional Charges Information:</label>
                                    <input type="text" id="other_price_desc" name="other_price_desc"
                                        placeholder="Additional Charges Information" class="form-control" />
                                </div>

                                <div class="form-group" id="other_charge_box" style="display:none;">
                                    <label>Additional Charge:</label>
                                    <input type="number" id="other_price" name="other_price" value="0" min="0"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Do you want to apply VAT on the quote ?</label>
                                <div class="radioprt">
                                    <div class="listitem-check">
                                        <input type="radio" name="vat_available" id="vat_available_yes"
                                            class="vat_available" value="1">
                                        <label onClick="">Yes</label>
                                    </div>
                                    <div class="listitem-check">
                                        <input type="radio" name="vat_available" id="vat_available_no" class="vat_available"
                                            value="0">
                                        <label onClick="">No</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="request_id" id="request_id"
                                value="{{ $data['request_id'] }}" />
                            <input type="hidden" name="total_price" id="total_price" />
                        </div>
                    </div>

                    <div class="col-sm-6 box" id="sideview">
                        <div class="text-center">New Quotation for</div>
                        <h3 class="text-center">{{ $data['product_name'] }}</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Value</th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Name</td>

                                    <td>{{ $data['product_name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Unit</td>

                                    <td>{{ $unitname->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Quantity</td>

                                    <td>{{ $data['req_quantity'] }} {{ $unitname->name }}</td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Unit Price</td>

                                    <td id="right_avail_unit"></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="font-size:20px;"> Subtotal</td>

                                    <td id="right_avail_product_subtotal"></td>

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
                                    <td>Unit Weight </td>

                                    <td id="right_avail_weight"></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td id="right_avail_unit_price_text">Unit Price</td>

                                    <td id="right_avail_unit_price"></td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td>Total Weight <br>( Unit weight X Quantity )</td>

                                    <td id="right_avail_total_weight"></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="font-size:20px;">Subtotal</td>

                                    <td id="right_avail_total_ship_price_sub" style="font-size:20px;"></td>

                                </tr>

                            </tbody>
                        </table> --}}
                        <table class="table" id="othertable" style="display: none">

                            <thead>
                                <tr>
                                    <th scope="col">Others</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr style="display:none;" id="right_avail_other_display">
                                    <th scope="row"></th>
                                    <td id="right_avail_other_display_text"></td>

                                    <td id="right_avail_other"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table">
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
                                    <td>Product Subtotal</td>
                                    <td id="right_avail_subtotal"></td>

                                </tr>
                                {{-- <tr>
                                    <th scope="row"></th>
                                    <td>Shipping Subtotal</td>
                                    <td id="right_avail_total_ship_price"></td>

                                </tr> --}}

                                <tr style="display:none;" id="right_avail_total_other_display">
                                    <th scope="row"></th>
                                    <td id="right_avail_total_other_display_text"></td>
                                    <td id="right_avail_total_other"></td>

                                </tr>
                                <tr style="display:none;" id="vat_display">
                                    <th scope="row"></th>
                                    <td>VAT (5%) </td>
                                    <td id="vat_total"></td>

                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td><strong>Total</strong></td>
                                    <td><strong id="right_avail_total"></strong></td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center"><button class="btn margin20">Submit</button></div>
                    </div>


                    <div class="col-sm-6 box" id="alternativesideview">
                        <div class="text-center">New Quotation for</div>
                        <h3 class="text-center" id="alternate_prod_name">Alternative</h3>
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

                                    <td id="alternate_prod_unit"> </td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Quantity</td>

                                    <td id="alternate_prod_volume"></td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Unit Price</td>

                                    <td id="right_alter_unit"></td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td>Weight per unit</td>

                                    <td id="right_alter_weight"></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Total Weight</td>

                                    <td id="right_alter_total_weight"></td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td id="right_alter_unit_price_text">Shipping Unit Price / Kg</td>

                                    <td id="right_alter_unit_price"></td>
                                </tr>
                                <tr style="display:none;" id="right_alter_other_display">
                                    <th scope="row"></th>
                                    <td id="right_alter_other_display_text"></td>

                                    <td id="right_alter_other"></td>
                                </tr>


                            </tbody>
                        </table>


                        <h5 class="text-center">Total Price</h5>


                        <table class="table">

                            <tbody>


                                <tr>
                                    <th scope="row"></th>
                                    <td>Product Subtotal</td>
                                    <td id="right_avail_subtotal"></td>

                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td>Shipping Subtotal</td>
                                    <td id="right_alter_total_ship_price"></td>

                                </tr>
                                <tr style="display:none;" id="right_alter_total_other_display">
                                    <th scope="row"></th>
                                    <td id="right_alter_total_other_display_text"></td>
                                    <td id="right_alter_total_other"></td>

                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="font-size: 20px;"><strong>Total</strong></td>
                                    <td style="font-size: 20px;"><strong id="right_alter_total"></strong></td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center"><button class="btn margin20">Submit</button></div>
                    </div>





                </div>

            </form>
        </div>
    </div>


    <!-- End Map and From Area -->
@stop
