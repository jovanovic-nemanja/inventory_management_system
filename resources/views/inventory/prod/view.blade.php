@extends('layouts.inventory')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('flash'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    {{ Session::get('flash') }}
                </ul>
            </div>

            @endif
            <div class="page-header">
                <h4 class="page-title">Product</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ url('/inventoryboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('inventory/prod') }}">Product</a>
                    </li>
                </ul>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                           <h2 class="page-title" style="color:#6761b5;"> {{$product_name->name}} </h2>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('prod.updatemanually') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"></div>
                                        <input type="hidden" name="prod_id" value="{{ $product_name->id }}" />
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <input required="" type="text" name="stock" class="form-control"
                                                value="{{$product_name->stock}}" placeholder="Stock" />
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input required="" type="text" name="price" class="form-control"
                                                value="{{$product_name->price}}" placeholder="Price" />
                                        </div>
                                        <div class="form-group">
                                            <label>Reason</label>
                                            <input required="" type="text" name="reason" class="form-control"
                                                value="{{$product_name->reason}}" placeholder="Reason" />
                                        </div>
                                    </div>

                                    <div class="card-action">
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>In/Out Qty</th>
                                            <th>Quantity in Stock</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background-color: #dde4f9;">
                                            <td>{{$initial_date}}</td>
                                            <td></td>
                                            <td>{{$initial_stock}}</td>
                                            <td> Added with product </td>

                                        </tr>
                                        @foreach ($purchase as $category)
                                        <tr style="background-color: #cef0ac;">
                                            <td>{{ $category->date }}</td>
                                            <td>{{ $category->after_stock }}</td>
                                            <td>{{ $category->old_stock + $category->after_stock }}</td>
                                            <td>Supplier - {{ $category->supplier_name }}</td>

                                        </tr>
                                        @endforeach

                                        @foreach ($distribution as $category)
                                        <tr style="background-color: #fbd3d3;">
                                            <td>{{ $category->date }}</td>
                                            <td>(-) {{ $category->item }}</td>
                                            <td>{{ $category->after_stock }}</td>
                                            <td> Batch ID - {{ $category->batch_id }} </td>

                                        </tr>
                                        @endforeach

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
@stop
