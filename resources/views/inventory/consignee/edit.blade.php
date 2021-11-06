@extends('layouts.inventory')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Edit Consignee</h4>
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
                            <a href="#">Consignee</a>
                        </li>
                    </ul>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('consignee.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="con_id" value="{{$consignee->id}}">
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
                                <textarea name="address" class="form-control" placeholder="Address">{{$consignee->address}}</textarea>
                            </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>


@endsection
