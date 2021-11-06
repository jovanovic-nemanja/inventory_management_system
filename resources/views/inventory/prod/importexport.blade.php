@extends('layouts.inventory')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Product</h4>
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
                            <a href="">Product</a>
                        </li>
                    </ul>



                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="container">

                            <div class="panel panel-default">

                              <div class="panel-heading">

                              <h1> Import Export to Excel and CSV </h1>

                              </div>

                              <div class="panel-body">



                                <!-- <a href="{{ url('/inventory/prod/downloadExcel/html') }}"><button class="btn btn-success">Download Excel pdf</button></a> -->

                                <a href="{{ url('/inventory/prod/downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>

                                <a href="{{ url('/inventory/prod/downloadExcel/csv') }}"><button class="btn btn-success">Download csv</button></a>



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
                </div>
            </div>
        </div>
    </div>


@endsection
