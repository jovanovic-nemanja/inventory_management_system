@extends('layouts.appsecond')

@section('content')
<div class="breadcamp">
    <div class="container-fluid">
        <a href="/">Home </a>/
        <a href="#">Reset Password</a> 
    </div>
</div>

<div class="category-body margin20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="loginbody page_logbody col-sm-6">
                <h2>Reset Password</h2>
                <div class="form-section">
                    <form action="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group logfield">
                            <i class="fa fa-envelope"></i>
                            <input type="email"  id="email" name="email" placeholder="Email" value="{{ $email or old('email') }}" class="form-control" autocomplete="off">
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group logfield">
                            <i class="fa fa-lock lock"></i>
                            <input type="password" placeholder="Your account password" id="password" name="password" class="form-control">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group logfield">
                            <i class="fa fa-lock lock"></i>
                            <input type="password" placeholder="Your account password again" id="password" name="password_confirmation" class="form-control">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                           
                        
                        
                        <button class="btn full-width margin20">Submit</button>
                    </form>               
                </div>

            </div>
        </div>
    </div>
</div>

@stop

@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>



@yield('js')
@stop

