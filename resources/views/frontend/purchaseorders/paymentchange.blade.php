@extends('layouts.appseller')


@section('content')

    <!-- Map and From Area -->

    <div class="col-md-9">
        <?php echo displayAlert(); ?>

        @if ($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <h3>Purchase Order (Payment Status) </h3><br>
                @auth
                    @if (auth()->user()->hasRole('seller'))
                        <form action="{{ route('purchaseorders.update') }}" method="POST" id="acceptForm">
                            @csrf
                            <input type="hidden" name="accept_id" value="{{ $record->id }}">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Request ID</td>
                                        <td>{{ $quotes[0]->request_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Product Name</td>
                                        <td>{{ $quotes[0]->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Total Price</td>
                                        <td>{{ number_format($quotes[0]->total_price, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Purchase Date</td>
                                        <td>{{ $quotes[0]->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment status</td>
                                        @if ($record->payment_status == 0)
                                            <td>Disputed</td>
                                        @elseif($record->buyer_payment_status == 2)
                                            <td>Payment Released</td>
                                        @elseif($record->buyer_payment_status == 3)
                                            <td>Payment Accepted</td>
                                        @else
                                            <td>Pending</td>
                                        @endif

                                    </tr>


                                    @if ($record->payment_status == 2)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment information</td>

                                            <td>{{ $record->buyer_payment_information }}</td>
                                        </tr>
                                        @if ($record->payment_document != '')
                                            <tr>
                                                <th scope="row"></th>
                                                <td>Uploaded document</td>

                                                <td>
                                                    <a target="_blank"
                                                        href="{{ asset('/uploads/payment_document/') }}/{{ $record->payment_document }}"
                                                        download>
                                                        <i class=" fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment released on</td>

                                            <td>{{ $record->buyer_payment_updated_at }}</td>
                                        </tr>

                                    @endif
                                    @if ($record->payment_status == 3)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment information</td>

                                            <td>{{ $record->buyer_payment_information }}</td>
                                        </tr>
                                        @if ($record->payment_document != '')
                                            <tr>
                                                <th scope="row"></th>
                                                <td>Uploaded document</td>

                                                <td><a target="_blank"
                                                        href="{{ asset('/uploads/payment_document/') }}/{{ $record->payment_document }}"
                                                        download>
                                                        <i class=" fa fa-download" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment released on</td>

                                            <td>{{ $record->payment_updated_at }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment accepted on</td>

                                            <td>{{ $record->buyer_payment_updated_at }}</td>

                                        </tr>
                                    @endif
                                    @if ($record->payment_status == 0)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment information</td>

                                            <td>{{ $record->buyer_payment_information }}</td>
                                        </tr>
                                        @if ($record->payment_document != '')
                                            <tr>
                                                <th scope="row"></th>
                                                <td>Uploaded document</td>

                                                <td><a target="_blank"
                                                        href="{{ asset('/uploads/payment_document/') }}/{{ $record->payment_document }}"
                                                        download>
                                                        <i class=" fa fa-download" aria-hidden="true"></i>
                                                    </a></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Payment released on</td>

                                            <td>{{ $record->buyer_payment_updated_at }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Dispute Reason</td>

                                            <td>{{ $record->payment_information }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Dispute on</td>

                                            <td>{{ $record->payment_updated_at }}</td>
                                        </tr>

                                    @endif

                                </tbody>
                            </table>
                            @if ($record->buyer_payment_status == 2)
                                <div class="form-group col-md-10">
                                    <input type="checkbox" name="termsCondition">
                                    I agree the <a href="{{route('home.termsconditions')}}" target="_blank">terms and conditions</a>
                                </div>
                                <button type="submit" class="btn btn-success" style="margin-left: 2%;">Accept</button>
                            @elseif($record->payment_status == 0)
                                <div class="form-group col-md-10">
                                    <input type="checkbox" name="termsCondition">
                                    I agree the <a href="{{route('home.termsconditions')}}" target="_blank">terms and conditions</a>
                                </div>
                                <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
                                <button type="submit" class="btn btn-success" style="margin-left: 2%;">Accept</button>
                            @elseif($record->payment_status == 3)
                                <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
                                <button type="button" id="disputeBtn" class="btn btn-danger"
                                    style="margin-left: 2%;">Dispute</button>
                            @else
                                <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
                            @endif

                        </form>
                        <form action="{{ route('purchaseorders.update') }}" method="POST" id="disputeForm"
                            style="display:none;">
                            @csrf
                            <div class="form-group col-md-10">
                                <label>Dispute Reason</label>
                                <input type="hidden" name="dispute_id" value="{{ $record->id }}">
                                <textarea rows="8" name="payment_information" placeholder="Write your comment for dispute"
                                    class="form-control" required></textarea>
                            </div>
                            <div class="form-group col-md-10">
                                <input type="checkbox" name="disputeTermsCondition">
                                I agree the <a href="{{route('home.termsconditions')}}" target="_blank">Terms and Conditions</a>
                            </div>


                            <button type="button" id="disputeBack" class="btn btn-success"
                                style="margin-left: 2%;">Back</button>
                            <button type="submit" class="btn btn-danger" style="margin-left: 2%;">Submit</button>

                        </form>

                    @else
                        @if ($record->buyer_payment_status == 1)
                            <form action="{{ route('purchaseorders.update') }}" method="POST" id="payment_status_change"
                                enctype="multipart/form-data">
                                <div class="form-group col-md-10">
                                    <label>Payment Status</label>
                                    <select class="form-control status" name="buyer_payment_status" id="status">
                                        <option value="">Please Select</option>
                                        <option value="1">Payment Released</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-10">
                                    <label>Information</label>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $record->id }}">
                                    <textarea rows="8" name="payment_information" id="payment_information"
                                        placeholder="Information about payment" class="form-control " required></textarea>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label>Document (Optional)</label>
                                        <input type="file" name="file" class="form-control" />
                                    </div>
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group col-md-10">
                                    <input type="checkbox" name="termsCondition">
                                    I agree the <a href="{{route('home.termsconditions')}}" target="_blank"> terms and conditions.</a>
                                </div>

                                <button type="submit" class="btn btn-success" style="margin-left: 2%;">Submit</button>

                            </form>
                        @elseif($record->buyer_payment_status == 2)
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Request ID</td>
                                        <td>{{ $quotes[0]->request_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Product Name</td>
                                        <td>{{ $quotes[0]->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Total Price</td>
                                        <td>{{ number_format($quotes[0]->total_price, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Purchase Date</td>
                                        <td>{{ $quotes[0]->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Status</td>
                                        <td>Payment Released <strong>(Waiting for seller confirmation)</strong></td>

                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment information</td>

                                        <td>{{ $record->buyer_payment_information }}</td>
                                    </tr>
                                    @if ($record->payment_document != '')
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Uploaded document</td>

                                            <td><a target="_blank"
                                                    href="{{ asset('/uploads/payment_document/') }}/{{ $record->payment_document }}"
                                                    download>
                                                    <i class=" fa fa-download" aria-hidden="true"></i>
                                                </a></td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Released on</td>

                                        <td>{{ $record->buyer_payment_updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
                        @elseif($record->buyer_payment_status == 3)
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Request ID</td>
                                        <td>{{ $quotes[0]->request_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Product Name</td>
                                        <td>{{ $quotes[0]->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Total Price</td>
                                        <td>{{ number_format($quotes[0]->total_price, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Purchase Date</td>
                                        <td>{{ $quotes[0]->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Status</td>
                                        <td>Payment Accepted</td>

                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment information</td>

                                        <td>{{ $record->buyer_payment_information }}</td>
                                    </tr>
                                    @if ($record->payment_document != '')
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Uploaded document</td>
                                            <td>
                                                <a target="_blank"
                                                    href="{{ asset('/uploads/payment_document/') }}/{{ $record->payment_document }}"
                                                    download>
                                                    <i class=" fa fa-download" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Released on</td>

                                        <td>{{ $record->buyer_payment_updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Accepted on</td>

                                        <td>{{ $record->payment_updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
                        @elseif($record->buyer_payment_status == 0)
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Request ID</td>
                                        <td>{{ $quotes[0]->request_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Product Name</td>
                                        <td>{{ $quotes[0]->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Total Price</td>
                                        <td>{{ number_format($quotes[0]->total_price, 2, '.', ',') }}
                                            {{ $quotes[0]->currency_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Purchase Date</td>
                                        <td>{{ $quotes[0]->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Status</td>
                                        <td>Disputed</td>

                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment Information</td>

                                        <td>{{ $record->buyer_payment_information }}</td>
                                    </tr>
                                    @if ($record->payment_document != '')
                                        <tr>
                                            <th scope="row"></th>
                                            <td>Uploaded document</td>

                                            <td><a target="_blank"
                                                    href="{{ asset('/uploads/payment_document/') }}/{{ $record->payment_document }}"
                                                    download>
                                                    <i class=" fa fa-download" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment released on</td>

                                        <td>{{ $record->buyer_payment_updated_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Dispute Reason</td>

                                        <td>{{ $record->payment_information }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Payment disputed on</td>

                                        <td>{{ $record->buyer_payment_updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="/purchaseorders" class="btn btn-success" style="margin-left: 2%;">Back</a>
                        @endif
                    @endif
                @endauth

            </div>
            <div class="col-sm-6 box" id="sideview5">
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
                            <td>Product Unit</td>
                            @if ($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)
                                <td>{{ $quotes[0]->name }}</td>
                            @else
                                <td>{{ $quotes[0]->product_name }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Product Unit</td>

                            <td>{{ $quotes[0]->unitname }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Product Quantity</td>

                            <td>{{ $quotes[0]->volume }}</td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>Product Unit Price</td>
                            @if ($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)
                                <td>{{ number_format($quotes[0]->alternative_product_price, 2, '.', ',') }}
                                    {{ $quotes[0]->currency_name }}
                                </td>
                            @else
                                <td>{{ number_format($quotes[0]->product_price, 2, '.', ',') }}
                                    {{ $quotes[0]->currency_name }}</td>
                            @endif
                        </tr>




                        {{-- @if ($quotes[0]->other_price_desc != '' && $quotes[0]->other_price_desc != 0)
                            <tr>
                                <th scope="row"></th>
                                <td>{{ $quotes[0]->other_price_desc }} {{ $quotes[0]->currency_name }}</td>

                                <td>{{ $quotes[0]->other_price }} {{ $quotes[0]->currency_name }}</td>
                            </tr>
                        @endif --}}
                        <tr>
                            <th scope="row"></th>
                            <td> Subtotal</td>


                            @if ($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)
                                <td>{{ number_format($quotes[0]->alternative_product_price * $quotes[0]->volume, 2, '.', ',') }}
                                    {{ $quotes[0]->currency_name }}</td>
                            @else
                                <td>{{ number_format($quotes[0]->product_price * $quotes[0]->volume, 2, '.', ',') }}.00
                                    {{ $quotes[0]->currency_name }}</td>
                            @endif


                        </tr>
                        @if (!empty($quotes[0]->vat))
                            <tr>
                                <th scope="row"></th>
                                <td>VAT (5%)</td>

                                <td>{{ number_format($quotes[0]->vat, 2, '.', ',') }} {{ $quotes[0]->currency_name }}
                                </td>

                            </tr>
                        @endif
                        <tr>
                            <th scope="row"></th>
                            <td style="font-size:20px;"><strong>Total</strong></td>
                            <td style="font-size:20px;"><strong>{{ number_format($quotes[0]->total_price, 2, '.', ',') }}
                                    {{ $quotes[0]->currency_name }}</strong></td>

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

                            <td>{{ $quotes[0]->shipping_weight }} {{ $shipping_unit }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Shipping Unit ({{ $shipping_unit }})</td>

                            <td>{{ $quotes[0]->shipping_price }} {{ $quotes[0]->currency_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Total Weight<br>( Unit weight X Quantity )</td>

                            <td>{{ $quotes[0]->shipping_weight * $quotes[0]->volume }} {{ $shipping_unit }}</td>
                        </tr>
                        @if ($quotes[0]->other_price_desc != '')
                            <tr>
                                <th scope="row"></th>
                                <td>{{ ucfirst($quotes[0]->other_price_desc) }}</td>

                                <td>{{ number_format(round($quotes[0]->other_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $quotes[0]->currency_name }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th scope="row"></th>
                            <td style="font-size:20px;">Subtotal</td>

                            <td>{{ $quotes[0]->shipping_weight * $quotes[0]->volume * $quotes[0]->shipping_price }}.00
                                {{ $quotes[0]->currency_name }}</td>
                        </tr>
                    </tbody>
                </table> --}}
                {{-- @if ($quotes[0]->other_price_desc != '')
                    <table class="table">
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
                                <td>{{ ucfirst($quotes[0]->other_price_desc) }}</td>

                                <td>{{ number_format(round($quotes[0]->other_price, 3, PHP_ROUND_HALF_UP), 2) }}
                                    {{ $quotes[0]->currency_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif --}}
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
                            @if ($quotes[0]->alternative_product != '' || $quotes[0]->alternative_product != 0)
                                <td>{{ $quotes[0]->alternative_product_price * $quotes[0]->volume }}.00
                                    {{ $quotes[0]->currency_name }}</td>
                            @else
                                <td>{{ $quotes[0]->product_price * $quotes[0]->volume }}.00
                                    {{ $quotes[0]->currency_name }}</td>
                            @endif


                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td>Shipping Total</td>
                            <td>{{ $quotes[0]->shipping_weight * $quotes[0]->volume * $quotes[0]->shipping_price }}.00
                                {{ $quotes[0]->currency_name }}
                            </td>

                        </tr>
                        @if ($quotes[0]->other_price_desc != '' && $quotes[0]->other_price_desc != 0)
                            <tr>
                                <th scope="row"></th>
                                <td>{{ $quotes[0]->other_price_desc }}</td>

                                <td>{{ $quotes[0]->other_price }} {{ $quotes[0]->currency_name }}</td>

                            </tr>
                        @endif
                        @if (!empty($quotes[0]->vat))
                            <tr>
                                <th scope="row"></th>
                                <td>VAT (5%)</td>

                                <td>{{ $quotes[0]->vat }} {{ $quotes[0]->currency_name }}</td>

                            </tr>
                        @endif
                        <tr>
                            <th scope="row"></th>
                            <td style="font-size:20px;"><strong>Total</strong></td>
                            <td><strong>{{ $quotes[0]->total_price }} {{ $quotes[0]->currency_name }}</strong></td>

                        </tr>
                    </tbody>
                </table> --}}

            </div>
        </div>
    </div>

    <!-- End Map and From Area -->
@stop
