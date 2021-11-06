@extends('layouts.inventory')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Customer</h4>
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
                        <a href="#">Customer</a>
                    </li>
                </ul>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Customer List</h4>
                                <a type="button" href="{{ url('/inventory/customer/create') }}"
                                    class="btn btn-primary btn-round ml-auto">
                                    <i class="fa fa-plus"></i>
                                    Create Customer

                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Current Balance</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($labels as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->email }}</td>
                                            <td>{{ $category->phone }}</td>
                                            <td>{{ number_format($category->current_balance) }}.00</td>
                                            <td>
                                                <a href="{{ route('customer.view', $category->id) }}" data-toggle="tooltip"
                                                    title="" class="btn btn-link btn-view" data-original-title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('customer.deposit', $category->id) }}"
                                                    data-toggle="tooltip" title="" class="btn btn-link btn-edit"
                                                    data-original-title="Deposit">
                                                    <i class="fa fa-money-check-alt"></i>
                                                </a>
                                                <a href="{{ route('customer.edit', $category->id) }}"
                                                    data-toggle="tooltip" title="" class="btn btn-link btn-edit"
                                                    data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('customer.delete', $category->id) }}"
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
