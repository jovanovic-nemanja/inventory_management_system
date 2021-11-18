@extends('layouts.inventory', ['menu' => 'container_detail'])

@section('content')

<?php echo displayAlert(); ?>

<div class="page-header">
    <h3 class="page-title"> Create Container Detail </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('inventory/container/detail') }}">Container Detail List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Container Detail</li>
        </ol>
    </nav>
</div>
<div class="row grid-margin">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('detail.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Shipper Information</label>
                        <input required="" type="text" name="shipper_info" class="form-control"
                            placeholder="Shipper Info" />
                    </div>
                    <div class="form-group">
                        <label>Notify Information</label>
                        <input required type="text" name="notify_info" class="form-control"
                            placeholder="Notify Info" />
                    </div>

                    <div class="form-group">
                        <label>Port of Loading</label>
                        <input required type="text" name="port_loading" class="form-control"
                            placeholder="Port of Loading" />
                    </div>

                    <div class="form-group">
                        <label>Consignee Info </label>
                        <input required="" type="text" name="consignee_info" class="form-control"
                            placeholder="Consignee Info " />
                    </div>
                    <div class="form-group">
                        <label>Port of Discharge</label>
                        <input required="" type="text" name="port_discharge" class="form-control"
                            placeholder="Port of Discharge" />
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
