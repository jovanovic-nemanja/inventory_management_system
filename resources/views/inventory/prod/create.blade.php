@extends('layouts.inventory', ['menu' => 'products'])

@section('content')

    <?php echo displayAlert(); ?>

    <div class="page-header">
        <h3 class="page-title"> Create Product </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/prod') }}">Product List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Product</li>
            </ol>
        </nav>
    </div>
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('prod.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="labelname">Name</label>
                            <input required type="text" name="name" class="form-control" placeholder="Name" />
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit" required class="form-control">
                                <option value="">Please Choose</option>
                                @foreach($allunits as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" required class="form-control">
                                <option value="">Please Choose</option>
                                @foreach($allcategory as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Initial Stock</label>
                            <input required type="text" name="stock" class="form-control"
                                placeholder="Stock" />
                        </div>

                        <div class="form-group">
                            <label>Initial Price</label>
                            <input required type="text" name="price" class="form-control"
                                placeholder="Price" />
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
