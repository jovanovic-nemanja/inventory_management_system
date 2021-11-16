@extends('layouts.inventory', ['menu' => 'batch'])

@section('content')

    <?php echo displayAlert(); ?>
    <div class="page-header">
        <h3 class="page-title"> Edit Batch </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/container/batch') }}">Batch</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Batch</li>
            </ol>
        </nav>
    </div>
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('batch.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="labelname">Name</label>
                            <input type="hidden" name="batch_id" value="{{$batch_detail->id}}" />
                            <input required="" type="text" name="name" class="form-control" placeholder="Name" value="{{$batch_detail->name}}" />
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
