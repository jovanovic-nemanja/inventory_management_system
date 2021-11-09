@extends('layouts.inventory')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Create Container Detail</h4>
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
                            <a href="{{ url('inventory/container/detail') }}">Container Detail</a>
                        </li>
                    </ul>



                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('detail.store') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"></div>
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
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input required="" type="text" name="type" class="form-control"
                                            placeholder="Type" />
                                    </div>
                                </div>

                                <div class="card-action">
                                    <button class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
