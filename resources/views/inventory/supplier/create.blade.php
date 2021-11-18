@extends('layouts.inventory', ['menu' => 'supplier'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Create Supplier </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/supplier') }}">Supplier List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Supplier</li>
        </ol>
    </nav>
</div>
<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input required="" type="text" name="name" class="form-control" placeholder="Name" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input required="" type="text" name="phone" class="form-control" placeholder="phone" />
                    </div>
                    <div class="form-group">
                        <label>TRN Number</label>
                        <input required="" type="text" name="trn_no" class="form-control"
                            placeholder="TRN Number" />
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
