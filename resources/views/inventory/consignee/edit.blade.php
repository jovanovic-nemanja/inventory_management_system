@extends('layouts.inventory', ['menu' => 'consignee'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Edit Consignee </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/consignee') }}">Consignee List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Consignee</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('consignee.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="con_id" value="{{$consignee->id}}" />

                    <div class="form-group">
                        <label>Name</label>
                        <input required="" type="text" value="{{$consignee->name}}" name="name" class="form-control" placeholder="Name" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input required="" type="email" name="email" value="{{$consignee->email}}" class="form-control" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input required="" type="text" value="{{$consignee->phone}}" name="phone" class="form-control" placeholder="phone" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" class="form-control" placeholder="Address" required>{{$consignee->address}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
