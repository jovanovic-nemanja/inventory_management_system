@extends('layouts.inventory', ['menu' => 'supplier'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Supplier List </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supplier</li>
        </ol>
    </nav>
</div>

<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Supplier List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/supplier/create') }}"
                    class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Create Supplier
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
                                <th>Phone</th>
                                <th>TRN Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($allsupplier as $supplier)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->trn_no }}</td>
                                    <td>
                                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                                            data-toggle="tooltip" title="Edit" class="btn btn-success btn-edit"
                                            data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{ route('supplier.delete', $supplier->id) }}"
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
