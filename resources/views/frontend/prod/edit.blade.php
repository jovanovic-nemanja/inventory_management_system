@extends('layouts.inventory')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Edit Product</h4>
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
                        <a href="#">Product</a>
                    </li>
                </ul>



            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('prod.update') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"></div>
                                <input type="hidden" name="prod_id" value="{{ $prods->id }}" />
                                <div class="form-group">
                                    <label>Name</label>
                                    <input required="" type="text" name="name" class="form-control"
                                        value="{{$prods->name}}" placeholder="Name" />
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" required class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach($allcategory as $cat)
                                        @if ($cat->id == $prods->category)
                                        <option selected="" value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @else
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endif


                                        @endforeach
                                    </select>
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
