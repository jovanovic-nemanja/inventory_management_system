@extends('layouts.inventory')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Edit Category</h4>
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
                        <a href="#">Category</a>
                    </li>
                </ul>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('inventorycategory.update') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"></div>
                                <input type="hidden" name="cat_id" value="{{$category->id}}" />
                                <div class="form-group">
                                    <label>Name</label>
                                    <input required="" type="text" name="name" class="form-control"
                                        value="{{$category->name}}" placeholder="Name" />
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
