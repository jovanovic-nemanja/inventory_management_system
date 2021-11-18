@extends('layouts.inventory', ['menu' => 'shipper'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Edit Shipper </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/shipper') }}">Shipper List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Shipper</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('shipper.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="sup_id" value="{{$shipper->id}}" />

                    <div class="form-group">
                        <label>Name</label>
                        <input required="" type="text" value="{{$shipper->name}}" name="name" class="form-control" placeholder="Name" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input required="" type="email" name="email" value="{{$shipper->email}}" class="form-control" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input required="" type="text" value="{{$shipper->phone}}" name="phone" class="form-control" placeholder="phone" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address" required>{{$shipper->address}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
