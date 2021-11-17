@extends('layouts.inventory', ['menu' => 'units'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Edit Unit </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/unit') }}">Unit List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Unit</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('inventoryunit.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="unit_id" value="{{$unit->id}}" />

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                           value="{{$unit->name}}" placeholder="Name" required />
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
