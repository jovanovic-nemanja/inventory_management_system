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
    <h3 class="page-title"> Product </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </nav>
</div>
<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Product List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/prod/importExport') }}"
                    class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Import/Export
                </a>
                <a type="button" href="{{ url('/inventory/prod/create') }}"
                    class="btn btn-primary btn-round pl-3">
                    <i class="fa fa-plus"></i>
                    Create Product
                </a>
            </div>
        </div>
      
        <div class="row">
            <div class="col-12">
                <input type="hidden" class="url" value="{{ Route('inventory.deleteall') }}" />
                <input type="hidden" class="checkVals" />
                <button class="btn btn-danger submit_checkbox mb-5">Delete</button>

                <div class="table-responsive">
                    <table id="order-listing" class="table product-list">
                        <thead>
                            <tr>
                                <th><input type='checkbox' id="selectAll" /></th>
                                <th>No#</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prods as $category)
                                <tr>
                                    <td>
                                        <input type='checkbox' class='checks' name='checks[]'
                                            value='{{ $category->id }}' />
                                    </td>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->unit }}</td>
                                    <td>{{ $category->category }}</td>
                                    <td>{{ $category->stock }}</td>
                                    <td>{{ number_format($category->price) }}.00</td>
                                    <td>
                                        <a href="{{ route('prod.view', $category->id) }}" data-toggle="tooltip"
                                            title="View" class="btn btn-success btn-view" data-original-title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('prod.edit', $category->id) }}" data-toggle="tooltip"
                                            title="Edit" class="btn btn-primary btn-edit" data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="{{ route('prod.delete', $category->id) }}"
                                            data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger"
                                            data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
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
