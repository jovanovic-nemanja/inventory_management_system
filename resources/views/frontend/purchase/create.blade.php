@extends('layouts.inventory')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Create Purchase</h4>
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
            <form action="{{ route('purchase.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-space">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label>Date : {{ date('d M Y') }}</label>
                                        </div>
                                        <div class="form-group">
                                            <label>Purchase Order</label>
                                            <input type="text" name="purchase_order" value="{{rand(00000, 99999)}}"
                                                readonly class="form-control" placeholder="Purchase Order">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">

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
                                            <label>Reference Number</label>
                                            <input type="text" name="purchase_reference" value="{{rand(00000, 99999)}}"
                                                class="form-control" placeholder="Reference Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
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
                                            <th scope="col">VAT</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="cpyTr_0">
                                            <td>
                                                <select required name="category_id[]" id="catid_0"
                                                    class="form-control categorySlt">
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
                                                <select required name="vat[]" id="vat_0" class="form-control vatAdd">
                                                    <option value="0">0%</option>
                                                    <option value="1">5%</option>
                                                </select>
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
                            <div class="card-action">
                                <button class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                <select required name="vat[]" id="vat" class="form-control vatAdd">
                    <option value="0">0%</option>
                    <option value="1">5%</option>
                </select>
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
