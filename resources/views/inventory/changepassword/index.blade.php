@extends('layouts.inventory', ['menu' => 'setting'])

@section('content')

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
        <h3 class="page-title"> Change Password </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('updatePassword') }}" method="POST">
                        @csrf

                        <input type="hidden" name="_method" value="put" />

                        <div class="form-group form-show-validation row">
                            <label for="username">
                                Current Password
                            </label>
                            <input type="password" class="form-control" placeholder="Current Password"
                                aria-label="username" aria-describedby="username-addon" id="username"
                                name="old_password" required />
                        </div>
                        <div class="form-group form-show-validation row">
                            <label for="username">
                                New Password
                            </label>
                            <input type="password" class="form-control" placeholder="New Password"
                                aria-label="username" aria-describedby="username-addon" name="password"
                                required />
                        </div>
                        <div class="form-group form-show-validation row">
                            <label for="username">
                                Repeat New Password
                            </label>
                            <input type="password" class="form-control" placeholder="Repeat New Password" aria-label="username" aria-describedby="username-addon" name="password_confirmation" required />
                        </div>

                        {{-- <div class="form-group">
                            <label for="labelname">Name</label>
                            <input required="" type="text" name="name" class="form-control" placeholder="Name" />
                        </div> --}}

                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection