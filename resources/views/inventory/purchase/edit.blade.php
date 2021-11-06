@extends('layouts.inventory')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Edit Purchase</h4>
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
                <form action="{{ route('purchase.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-space">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <input type="hidden" name="pur_ord_id" value="{{ $purchase_detail->id }}">
                                            <div class="form-group">
                                                <label>Date : {{ date('d/m/Y',strtotime($purchase_detail->created_at)) }}</label>
                                            </div>
                                            <div class="form-group">
                                                <label>Purchase Order</label>
                                                <input type="text" name="purchase_order"
                                                    value="{{ $purchase_detail->purchase_order }}" readonly
                                                    class="form-control" placeholder="Purchase Order">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
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
                                                    placeholder="Reference">
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
                                                                    id="unitname_{{ $inc }}">{{ $purchase->price + $purchase->price * 0.05 }}</label>
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
                                    <div class="card-action">
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    {{-- <table class="table table-head-bg-success" style="display:none;">
        <tbody>
            <tr id="cpyTr">
                <td>
                    <select required name="category_id[]" id="catid" class="form-control categorySlt">
                        <option value="">Please Select</option>
                        @foreach ($allcategory as $category)
                            <option value="{{ $category->id }}">
{{ $category->name }}
</option>
@endforeach
</select>

</td>
<td>
    <select required name="product_id[]" id="prodid" class="form-control productSlt">
        <option value="">Please Select</option>
    </select>
</td>
<td>
    <label id="unitname"></label>
</td>
<td>
    <input type="text" required id="item" name='item[]' class="itemNo">
</td>
<td>
    <input type="text" required id="price" name='price[]' class="itemNo">
</td>
<td>
    <label id="totaltext"></label>
    <input type="hidden" id="total" value="0" name='total[]'>
</td>
<td>
    <button type="button" class="btn btn-danger" onclick="deleteTblRowProd(this)"><i class="fa fa-trash"></i></button>
</td>
</tr>
</tbody>
</table> --}}

@endsection
