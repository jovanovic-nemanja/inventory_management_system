@extends('layouts.inventory')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <?php echo displayAlert(); ?>
            <div class="page-header">
                <h4 class="page-title">Create Product</h4>
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
                    <form action="{{ route('prod.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title"></div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input required="" type="text" name="name" class="form-control"
                                        placeholder="Name" />
                                </div>
                                <div class="form-group">
                                    <label> Unit</label>
                                    <select name="unit" required class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach($allunits as $unit)

                                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" required class="form-control">
                                        <option value="">Please Select</option>
                                        @foreach($allcategory as $cat)

                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Initial Stock</label>
                                    <input required="" type="text" name="stock" class="form-control"
                                        placeholder="Stock" />
                                </div>

                                <div class="form-group">
                                    <label>Initial Price</label>
                                    <input required="" type="text" name="price" class="form-control"
                                        placeholder="Price" />
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