@extends('layouts.inventory')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">View Purchase</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">Purchase</a>
                    </li>
                </ul>

            </div>
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-space">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Date :{{ $purchase_detail->created_at }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Purchase Order : {{ $purchase_detail->purchase_order }}</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">

                                    <div class="form-group">
                                        <label>Supplier :</label>
                                        @foreach ($allsupplier as $supplier)
                                        @if ($supplier->id == $purchase_detail->supplier)
                                        <label> {{ $supplier->name }}</label>
                                        @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Reference Number : {{ $purchase_detail->purchase_reference }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-head-bg-success" id="prodTbl">
                                    <thead>
                                        <tr>
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
                                                </select>

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
                                                <label>{{ $purchase->price }}</label>
                                            </td>
                                            <td>
                                                <label id="totaltext_{{ $inc }}">{{ $purchase->total }}</label>
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
            </div>
        </div>
    </div>
</div>

@endsection
