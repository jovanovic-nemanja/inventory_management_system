@extends('layouts.inventorynowrap', ['menu' => 'purchase'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> View Purchase </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/purchase') }}">Purchase List</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Purchase</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Date : {{ date('d/m/Y',strtotime($purchase_detail->created_at)) }}</label>
                    </div>
                    <div class="form-group">
                        <label>Purchase Order : {{ $purchase_detail->purchase_order }}</label>
                    </div>

                    <div class="form-group">
                        <label>Supplier :</label>

                        @foreach ($allsupplier as $supplier)
                            @if ($supplier->id == $purchase_detail->supplier_id)
                                <label> {{ $supplier->name }}</label>
                            @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Reference Number : {{ $purchase_detail->purchase_reference }}</label>
                    </div>

                    <div class="row pt-5 pb-5">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-head-bg-success" id="prodTbl">
                                        <thead>
                                            <tr class="table-success">
                                                <th scope="col">Category</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">No of Items</th>
                                                <th scope="col">Cost Price</th>
                                                <th scope="col">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $inc = sizeof($allpurchase) - 1;
                                            @endphp

                                            @foreach ($allpurchase as $purchase)
                                                <tr id="cpyTr_{{ $inc }}">
                                                    <td>
                                                        @foreach ($allcategory as $category)
                                                            @if ($category->id == $purchase->category)
                                                                <label>
                                                                    {{ $category->name }}
                                                                </label>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($allprod as $product)
                                                            @if ($product->id == $purchase->product)
                                                                <label> {{ $product->name }} </label>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <label id="unitname_{{ $inc }}"></label>
                                                    </td>
                                                    <td>
                                                        <label>{{ $purchase->item }}</label>
                                                    </td>
                                                    <td>
                                                        <label>{{number_format($purchase->price) }}.00</label>
                                                    </td>
                                                    <td>
                                                        <label id="totaltext_{{ $inc }}">{{ number_format($purchase->total) }}.00</label>
                                                        <input type="hidden" id="total_{{ $inc }}"
                                                            value="{{ $purchase->total }}" name='total[]'>
                                                    </td>
                                                </tr>
                                                @php
                                                    $inc--;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-head-bg-success" style=" background-color: #e9f0f0">
                                        <tbody>
                                            <tr>
                                                <td>TOTAL PRICE
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td style="text-align: center">
                                                    @php
                                                        $chkVal = 0;
                                                    @endphp
                                                    @foreach ($allpurchase as $purchase)
                                                        @php
                                                            $chkVal = $chkVal + $purchase->total;
                                                        @endphp
                                                    @endforeach
                                                    <label id="totalTxt">{{number_format( $chkVal) }}.00</label>
                                                    <input type="hidden" value="{{ $chkVal }}" name='alltotal'
                                                        id="alltotal" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
