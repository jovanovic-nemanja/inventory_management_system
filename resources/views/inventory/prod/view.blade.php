@extends('layouts.inventory', ['menu' => 'products'])

@section('content')

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
        <h3 class="page-title"> {{$product_name->name}} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/prod') }}">Product List</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Product</li>
            </ol>
        </nav>
    </div>

    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('prod.updatemanually') }}" method="POST">
                        @csrf

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

                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
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
@stop
