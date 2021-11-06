@extends('layouts.inventory')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Unit</h4>
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
                            <a href="#">Unit</a>
                        </li>
                    </ul>



                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Unit List</h4>
                                    <a type="button" href="{{ url('/inventory/unit/create') }}"
                                        class="btn btn-primary btn-round ml-auto">
                                        <i class="fa fa-plus"></i>
                                        Create Unit

                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inventoryunits as $unit)
                                                <tr>
                                                <td>{{ $unit->id }}</td>
                                                    <td>{{ $unit->name }}</td>
                                                    <td>
                                                        <a href="{{ route('inventoryunit.edit', $unit->id) }}" data-toggle="tooltip"
                                                            title="" class="btn btn-link btn-edit" data-original-title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('inventoryunit.delete', $unit->id) }}"
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
