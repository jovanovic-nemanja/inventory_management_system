@extends('layouts.inventory', ['menu' => 'products'])

@section('content')

    <?php echo displayAlert(); ?>

    <div class="page-header">
        <h3 class="page-title"> Import Export to Excel and CSV </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/prod') }}">Product List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import Export to Excel and CSV</li>
            </ol>
        </nav>
    </div>

    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('/inventory/prod/downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
                    <a href="{{ url('/inventory/prod/downloadExcel/csv') }}"><button class="btn btn-primary">Download csv</button></a>
                    
                    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url('/inventory/prod/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif

                        <input type="file" name="import_file" />
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
