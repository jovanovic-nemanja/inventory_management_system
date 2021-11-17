@extends('layouts.inventory', ['menu' => 'products'])

@section('content')

    <?php echo displayAlert(); ?>
    <div class="page-header">
        <h3 class="page-title"> Edit Product </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/container/batch') }}">Product List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
            </ol>
        </nav>
    </div>
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('prod.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="hidden" name="prod_id" value="{{ $prods->id }}" />
                            <input required type="text" name="name" class="form-control"
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
                        <div class="form-group">
                            <label>Stock</label>
                            <input required type="text" name="stock" class="form-control"
                                value="{{$prods->stock}}" placeholder="Name" />
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

