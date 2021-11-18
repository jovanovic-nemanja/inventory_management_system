@extends('layouts.inventory', ['menu' => 'container_type'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Edit Container Type </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/container/type') }}">Container Type List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Container Type</li>
        </ol>
    </nav>
</div>

<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('type.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{$type->id}}" />

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"
                           value="{{$type->title}}" placeholder="Title" />
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
