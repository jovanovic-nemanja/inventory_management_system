@extends('layouts.inventory', ['menu' => 'customer'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Customer List </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customer</li>
        </ol>
    </nav>
</div>

<div class="card grid-margin">
    <div class="card-body">
        <div class="row justify-content-between pb-3">
            <h4 class="card-title">Customer List</h4>
            <div class="text-right">
                <a type="button" href="{{ url('/inventory/customer/create') }}"
                    class="btn btn-success btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Create Customer
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Current Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($labels as $category)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->email }}</td>
                                    <td>{{ $category->phone }}</td>
                                    <td>{{ number_format($category->current_balance) }}.00</td>
                                    <td>
                                        <a href="{{ route('customer.view', $category->id) }}" data-toggle="tooltip"
                                            title="View" class="btn btn-primary btn-view" data-original-title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('customer.deposit', $category->id) }}"
                                            data-toggle="tooltip" title="Deposit" class="btn btn-primary btn-edit"
                                            data-original-title="Deposit">
                                            <i class="fa fa-money"></i>
                                        </a>
                                        <a href="{{ route('customer.edit', $category->id) }}"
                                            data-toggle="tooltip" title="Edit" class="btn btn-success btn-edit"
                                            data-original-title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{ route('customer.delete', $category->id) }}"
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
