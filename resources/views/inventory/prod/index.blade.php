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
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">Product</a>
                    </li>
                </ul>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Product List</h4>
                                <a type="button" href="{{ url('/inventory/prod/importExport') }}"
                                    class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Import/Export

                                </a>
                                <a type="button" href="{{ url('/inventory/prod/create') }}"
                                    class="btn btn-primary btn-round">
                                    <i class="fa fa-plus"></i>
                                    Create Product

                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" class="url" value="{{ Route('inventory.deleteall') }}" />
                            <input type="hidden" class="checkVals" />
                            <button class="btn btn-danger submit_checkbox mb-10">Delete</button>
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id="selectAll" /></th>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Price</th>
                                            <th></th>
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
                                                    title="" class="btn btn-link btn-view" data-original-title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('prod.edit', $category->id) }}" data-toggle="tooltip"
                                                    title="" class="btn btn-link btn-edit" data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('prod.delete', $category->id) }}"
                                                    data-toggle="tooltip" title="" class="btn btn-link btn-danger"
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
        </div>
    </div>

</div>
@stop
