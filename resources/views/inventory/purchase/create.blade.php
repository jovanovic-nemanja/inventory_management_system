@extends('layouts.inventorynowrap', ['menu' => 'purchase'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Create Purchase </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/purchase') }}">Purchase List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Purchase</li>
        </ol>
    </nav>
</div>
<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('purchase.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="created_at" value="{{ date('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Purchase Order</label>
                        <input type="text" name="purchase_order" value="{{rand(00000, 99999)}}"
                            readonly class="form-control" placeholder="Purchase Order">
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" required class="form-control myselect2">
                            <option value="">Please Select</option>
                            @foreach ($allsupplier as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Reference</label>
                        <input type="text" name="purchase_reference" value="{{rand(00000, 99999)}}"
                            class="form-control" placeholder="Reference">
                    </div>

                    <div class="row pt-5 pb-5">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center">
                                <a type="button" id="addProduct" href="#" class="btn btn-success btn-round">
                                    <i class="fa fa-plus"></i>
                                    Add Product
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12 table-responsive pt-3">
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
                                    <tr id="cpyTr_0">
                                        <td>
                                            <select required name="category_id[]" id="catid_0" class="form-control categorySlt">
                                                <option value="">Please Select</option>
                                                
                                                @foreach ($allcategory as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select required name="product_id[]" id="prodid_0"
                                                class="form-control productSlt">
                                                <option value="">Please Select</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label id="unitname_0"></label>
                                        </td>
                                        <td>
                                            <input required type="text" id="item_0" name='item[]'
                                                class="form-control itemNo">
                                        </td>

                                        <td>
                                            <input required type="text" id="price_0" name='price[]'
                                                class="form-control itemNo">
                                        </td>
                                        <td>
                                            <label id="beforevat_0">0</label>
                                        </td>
                                        <td>
                                            <select required name="vat[]" id="vat_0" class="form-control vatAdd">
                                                <option value="0">0%</option>
                                                <option value="1">5%</option>
                                            </select>
                                        </td>
                                        <td>
                                            <label id="vatamount_0">0</label>
                                        </td>
                                        <td>
                                            <label id="totaltext_0"></label>
                                            <input type="hidden" id="total_0" name='total[]'>
                                        </td>
                                    </tr>
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
                                            <label id="totalTxt">0</label>
                                            <input type="hidden" name='alltotal' id="alltotal">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
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
                <label id="beforevat">0</label>
            </td>
            <td>
                <select required name="vat[]" id="vat" class="form-control vatAdd">
                    <option value="0">0%</option>
                    <option value="1">5%</option>
                </select>
            </td>
            <td>
                <label id="vatamount">0</label>
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
