@extends('layouts.inventory')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Container List</h4>
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
                        <a href="#">Container List</a>
                    </li>
                </ul>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Container List</h4>
                                <a type="button" href="{{ url('/inventory/container/create') }}"
                                    class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Create Container

                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Owner Name</th>
                                            <th>Batch</th>
                                            <th>Container Number</th>
                                            <th></th>
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
                                                <a href="{{ route('container.addproduct', $container->container_batch) }}"
                                                    data-toggle="tooltip" title="" class="btn btn-link btn-add"
                                                    data-original-title="Add">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <a href="{{ route('container.edit', $container->id) }}"
                                                    data-toggle="tooltip" title="" class="btn btn-link btn-edit"
                                                    data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('container.delete', $container->id) }}"
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
