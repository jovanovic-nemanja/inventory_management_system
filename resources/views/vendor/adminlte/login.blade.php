@extends('layouts.inventoryheader')

@section('content')

<div class="category-body margin20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="loginbody page_logbody col-sm-6">
                <h2>Login</h2>
                <div class="form-section">
                    <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post" id="lgnFrm">
                        {!! csrf_field() !!}
                        <div class="form-group logfield">
                            <i class="fa fa-envelope"></i>
                            <input type="email"  id="email" name="email" placeholder="Email" value="{{ old('email') }}" class="form-control" autocomplete="off">
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
                        <button id="pagelgn" class="btn full-width margin20">Login</button>
                    </form>

                </div>

            </div>

            <div class="loginbody page_regibox col-sm-6">
                <h2>Register</h2>
                
 
            </div>
            <div class="col-sm-3"></div>
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

