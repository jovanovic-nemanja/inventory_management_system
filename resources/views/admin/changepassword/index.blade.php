@extends('layouts.admin')

@section('content')

<div class="main-panel">
    <div class="content">
        <div class="page-inner">
        <?php echo displayAlert(); ?>
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('flash'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    {{ Session::get('flash') }}
                </ul>
            </div>

        @endif
            <div class="page-header">
                <h4 class="page-title">Change Password</h4>
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
                        <a href="#">Change Password </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title"></div>

                        </div>
                        <form method='post' action="{{ route('admin.updatePassword') }}"
                            class="form-horizontal">
                            @csrf

                            <input type="hidden" name="_method" value="put">

                            <div class="form-group form-show-validation row">
                                <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                    Current Password
                                </label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Current Password"
                                            aria-label="username" aria-describedby="username-addon" id="username"
                                            name="old_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                    New Password
                                </label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="New Password"
                                            aria-label="username" aria-describedby="username-addon" name="password"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-show-validation row">
                                <label for="username" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">
                                    Repeat New Password
                                </label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Repeat New Password"
                                            aria-label="username" aria-describedby="username-addon"
                                            name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success">
                                            Update Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection