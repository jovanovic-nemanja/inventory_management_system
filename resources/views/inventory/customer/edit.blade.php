@extends('layouts.inventory', ['menu' => 'customer'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Edit Customer </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/customer') }}">Customer List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('customer.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="customer_id" value="{{$customer->id}}" />

                    <div class="form-group">
                        <label>Name</label>
                        <input required="" type="text" name="name" class="form-control"
                           value="{{$customer->name}}" placeholder="Name" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input readonly="" type="email" name="email" class="form-control"
                        value="{{$customer->email}}" placeholder="email" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input required="" type="text" name="phone" class="form-control"
                        value="{{$customer->phone}}" placeholder="phone" />
                    </div>
                    <div class="form-group">
                        <label>Initial Balance</label>
                        <input readonly="" type="text" name="balance" class="form-control"
                        value="{{$customer->balance}}" placeholder="Initial Balance" />
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
