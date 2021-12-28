@extends('layouts.inventory', ['menu' => 'units'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Unit List </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Unit</li>
        </ol>
    </nav>
</div>

<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Unit List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/unit/create') }}"
                    class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Create Unit
                </a>
            </div>
        </div>
      
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table product-list">
                        <thead>
                            <tr>
                                <th>No#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($inventoryunits as $unit)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>
                                        <a href="{{ route('inventoryunit.edit', $unit->id) }}" data-toggle="tooltip"
                                            title="Edit" class="btn btn-success btn-edit" data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{ route('inventoryunit.delete', $unit->id) }}"
                                            data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger"
                                            data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </a> -->
                                    </td>
                                </tr>

                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
