@extends('layouts.inventory', ['menu' => 'consignee'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Consignee List </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Consignee</li>
        </ol>
    </nav>
</div>

<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Consignee List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/consignee/create') }}"
                    class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Create Consignee
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($allshipper as $consignee)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $consignee->name }}</td>
                                    <td>{{ $consignee->email }}</td>
                                    <td>{{ $consignee->phone }}</td>
                                    <td>
                                        <a href="{{ route('consignee.edit', $consignee->id) }}"
                                            data-toggle="tooltip" title="Edit" class="btn btn-success btn-edit"
                                            data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('consignee.delete', $consignee->id) }}"
                                            data-toggle="tooltip" title="Remove" class="btn btn-link btn-danger"
                                            data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </a>
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
