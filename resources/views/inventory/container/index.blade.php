@extends('layouts.inventory', ['menu' => 'container'])

@section('content')

<?php echo displayAlert(); ?>
<div class="page-header">
    <h3 class="page-title"> Container </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Container</li>
        </ol>
    </nav>
</div>
<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Container List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/container/create') }}" class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>Create Container
                </a>
            </div>
        </div>
      
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Owner Name</th>
                                <th>Batch</th>
                                <th>Container Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allcontainer as $container)
                                <tr>
                                    <td>{{ $container->shipper_name }}</td>
                                    <td>{{ $container->owner_name }}</td>
                                    <td>{{ $container->batch_name }}</td>
                                    <td>{{ $container->container_number }}</td>
                                    <td>
                                        <a href="{{ route('container.addproduct', [$container->id, $container->container_batch]) }}"
                                            data-toggle="tooltip" title="Manage Product" class="btn btn-link btn-add"
                                            data-original-title="Add">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="{{ route('container.edit', $container->id) }}"
                                            data-toggle="tooltip" title="Edit" class="btn btn-link btn-edit"
                                            data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{ route('container.delete', $container->id) }}"
                                            data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger"
                                            data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </a> -->
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
