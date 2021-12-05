@extends('layouts.inventorynowrap', ['menu' => 'purchase'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Edit Purchase </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/purchase') }}">Purchase List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Purchase</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('purchase.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="pur_ord_id" value="{{ $purchase_detail->id }}" />

                    <div class="form-group">
                        <label>Date : {{ date('d/m/Y',strtotime($purchase_detail->created_at)) }}</label>
                    </div>
                    <div class="form-group">
                        <label>Purchase Order</label>
                        <input type="text" name="purchase_order"
                            value="{{ $purchase_detail->purchase_order }}" readonly
                            class="form-control" placeholder="Purchase Order">
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" required class="form-control myselect2">
                            <option value="">Please Select</option>
                            @foreach ($allsupplier as $supplier)
                                @if ($supplier->id == $purchase_detail->supplier_id)
                                    <option selected value="{{ $supplier->id }}">
                                        {{ $supplier->name }}
                                    </option>
                                @else
                                    <option value="{{ $supplier->id }}">
                                        {{ $supplier->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Reference</label>
                        <input type="text" name="purchase_reference" readonly
                            value="{{ $purchase_detail->purchase_reference }}" class="form-control"
                            placeholder="Reference" />
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
                                                <th scope="col">Before VAT</th>
                                                <th scope="col">VAT</th>
                                                <th scope="col">VAT Amount</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $inc = sizeof($allpurchase) - 1;
                                            @endphp
                                            @foreach ($allpurchase as $purchase)
                                                <tr id="cpyTr_{{ $inc }}">
                                                    <td>
                                                        <label
                                                            id="unitname_{{ $inc }}">{{ $purchase->category_name }}</label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            id="unitname_{{ $inc }}">{{ $purchase->product_name }}</label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            id="unitname_{{ $inc }}">{{ $purchase->unit_name }}</label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            id="unitname_{{ $inc }}">{{ $purchase->item }}</label>
                                                    </td>
                                                    <td>
                                                        <label
                                                            id="unitname_{{ $inc }}">{{ $purchase->price }}</label>
                                                    </td>

                                                    <td>
                                                        <label
                                                            id="unitname_{{ $inc }}">{{ $purchase->price * $purchase->item }}</label>
                                                    </td>
                                                    @if ($purchase->vat == 1)
                                                        <td>
                                                            <label id="unitname_{{ $inc }}">5%</label>
                                                        </td>
                                                        <td>
                                                            <label
                                                                id="unitname_{{ $inc }}">{{ $purchase->price * $purchase->item * 0.05 }}</label>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <label id="unitname_{{ $inc }}">0%</label>
                                                        </td>
                                                        <td>
                                                            <label
                                                                id="unitname_{{ $inc }}">0</label>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <label
                                                            id="totaltext_{{ $inc }}">{{ $purchase->total }}</label>
                                                    </td>
                                                </tr>
                                                @php
                                                    $inc--;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-head-bg-success">
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
                                                <td>
                                                    @php
                                                        $chkVal = 0;
                                                    @endphp
                                                    @foreach ($allpurchase as $purchase)
                                                        @php
                                                            $chkVal = $chkVal + $purchase->total;
                                                        @endphp
                                                    @endforeach
                                                    <label id="totalTxt">{{ $chkVal }}</label>
                                                    <input type="hidden" value="{{ $chkVal }}" name='alltotal'
                                                        id="alltotal">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
