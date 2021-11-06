@extends('layouts.admin')

@section('content')

    @if (session('flash'))
        <div class="alert alert-primary">
            {{ session('flash') }}
        </div>
    @endif
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">Products</h4>
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
                            <a href="#">Products</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <input type="hidden" class="url" value="{{ Route('products.approveproductsbychoosing') }}" />
                    <input type="hidden" class="checkVals" />
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">List Of Products</div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-danger submit_checkbox mb-10">Approve</button>

                                        <div class="table-responsive">
                                            <table id="add-row" class="table table-bordered table-striped">

                                                <thead>
                                                    <tr>
                                                        <th><input type='checkbox' id="selectAll" /></th>
                                                        <th width="50px">No</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>User</th>
                                                        <th>Image</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                        <th width="150px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($products as $product)

                                                        <tr>
                                                            <td><input type='checkbox' class='checks' name='checks[]'
                                                                    value='{{ $product->id }}' />
                                                            </td>
                                                            <td>{{ $product->id }}</td>
                                                            <td>{{ str_limit($product->name, 30, '...') }}</td>
                                                            <td>{{ $product->getCategoryname($product->category_id) }}
                                                            </td>
                                                            <td>{{ $product->getUsername($product->user_id) }}</td>
                                                            <td>
                                                                <?php if (@$product->images->first()->url) {
                                                                ?>
                                                                <img class="img-fluid" width="100"
                                                                    src="{{ asset('uploads/') }}/{{ $product->images->first()->url }}"
                                                                    alt="">
                                                                <?php } else {} ?>
                                                            </td>

                                                            @if ($product->status == 1 || $product->status == null)
                                                                <td>Pending</td>
                                                            @endif
                                                            @if ($product->status == 2)
                                                                <td>Approved</td>
                                                            @endif
                                                            @if ($product->status == 3)
                                                                <td>Deleted</td>
                                                            @endif

                                                            <td>{{ $product->sign_date }}</td>
                                                            <td>
                                                                @if ($product->status == 1 || $product->status == null)
                                                                    <a href="{{ route('products.show', $product->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat"
                                                                        title="Approve">
                                                                        <i class="fa fa-check"></i>
                                                                    </a>
                                                                @endif
                                                                @if ($product->status == 2)
                                                                    <a href="{{ route('products.show', $product->id) }}"
                                                                        class="btn btn-primary btn-sm btn-flat"
                                                                        title="Pending">
                                                                        <i class="fa fa-ban"></i>
                                                                    </a>
                                                                @endif

                                                                <a href="{{ route('products.edit', $product->id) }}"
                                                                    class="btn btn-success btn-sm btn-flat" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('product.show', $product->slug) }}"
                                                                    class="btn btn-success btn-sm btn-flat" title="Detail">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>

                                                                <a href="{{ route('products.edit', $product->id) }}"
                                                                    class="btn btn-danger btn-sm btn-flat" title="Delete">
                                                                    <i class="fa fa-trash"></i>
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
        </div>

    </div>
@stop
