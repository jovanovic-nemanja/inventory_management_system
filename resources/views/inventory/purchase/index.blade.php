@extends('layouts.inventory', ['menu' => 'purchase'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Purchase List </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchase</li>
        </ol>
    </nav>
</div>

<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Purchase List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/purchase/create') }}"
                    class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Create Purchase
                </a>
            </div>
        </div>
      
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>No#</th>
                                <th>Supplier</th>
                                <th>Date</th>
                                <th>Reference</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($allpurchase as $purchase)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $purchase->supplier_name }}</td>
                                    <td>{{ $purchase->created_at }}</td>
                                    <td>{{ $purchase->purchase_reference }}</td>
                                    <td>
                                        <a href="{{ route('purchase.edit', $purchase->id) }}"
                                        data-toggle="tooltip" title="Edit" class="btn btn-success btn-edit"
                                        data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- <a href="{{ route('purchase.view', $purchase->id) }}"
                                            data-toggle="tooltip" title="View" class="btn btn-primary btn-edit"
                                            data-original-title="View">
                                            <i class="fa fa-eye"></i>
                                        </a> -->
                                        <!-- <a href="{{ route('purchase.delete', $purchase->id) }}"
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
