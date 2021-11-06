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
                            <div class="card">
                                <div class="form-group">
                                    <label>Date : {{ date('d M Y') }}</label>
                                </div>
                                <div class="form-group">
                                    <label>Supplier</label>
                                    <select name="supplier_id" required class="form-control myselect2">
                                        <option value="">Please Select</option>
                                        @foreach ($allsupplier as $supplier)
                                            @if ($supplier->id == $purchase_detail->supplier)
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
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <a type="button" id="addProduct" href="#" class="btn btn-secondary btn-round">
                                            <i class="fa fa-plus"></i>
                                            Add Product
                                        </a>
                                    </div>
                                </div>
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
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $inc = sizeof($allpurchase)-1;
                                                @endphp
                                                @foreach ($allpurchase as $purchase)


                                                    <tr id="cpyTr_{{ $inc }}">
                                                        <td>
                                                            <select required name="category_id[]"
                                                                id="catid_{{ $inc }}"
                                                                class="form-control categorySlt">
                                                                <option value="">Please Select</option>
                                                                @foreach ($allcategory as $category)
                                                                    @if ($category->id == $purchase->category)
                                                                        <option selected value="{{ $category->id }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endif

                                                                @endforeach
                                                            </select>

                                                        </td>
                                                        <td>
                                                            <select required name="product_id[]"
                                                                id="prodid_{{ $inc }}"
                                                                class="form-control productSlt">
                                                                <option value="">Please Select</option>
                                                                @foreach ($allprod as $product)
                                                                    @if ($product->id == $purchase->product)
                                                                        <option selected value="{{ $product->id }}">
                                                                            {{ $product->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $product->id }}">
                                                                            {{ $product->name }}
                                                                        </option>
                                                                    @endif

                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label id="unitname_{{ $inc }}"></label>
                                                        </td>
                                                        <td>
                                                            <input required type="text" value="{{ $purchase->item }}"
                                                                id="item_{{ $inc }}" name='item[]' class="itemNo">
                                                        </td>
                                                        <td>
                                                            <input required type="text" value="{{ $purchase->price }}"
                                                                id="price_{{ $inc }}" name='price[]'
                                                                class="itemNo">
                                                        </td>
                                                        <td>
                                                            <label
                                                                id="totaltext_{{ $inc }}">{{ $purchase->total }}</label>
                                                            <input type="hidden" id="total_{{ $inc }}"
                                                                value="{{ $purchase->total }}" name='total[]'>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteTblRowProd(this)"><i
                                                                    class="fa fa-trash"></i></button>
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
                                                        <label id="totalTxt">{{$chkVal}}</label>
                                                        <input type="hidden" value="{{$chkVal}}" name='alltotal' id="alltotal">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success">Save</button>
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
    <table class="table table-head-bg-success" style="display:none;">
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
                    <button type="button" class="btn btn-danger" onclick="deleteTblRowProd(this)"><i
                            class="fa fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

@endsection
