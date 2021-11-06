@extends('layouts.app')

@section('content')

<div class="ps-page--my-account">
    <div class="ps-my-account">
        <div class="container">
            <div class="ps-form--account-padding"></div>
            <form class="ps-form--account ps-tab-root" action="{{ url(config('adminlte.login_url', 'login')) }}" method="post" style="border: 1px solid;">
                <ul class="ps-tab-list">
                    <li class="active"><a href="#sign-in">Login</a></li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>Log In Your Account</h5>
                            {!! csrf_field() !!}

                            <?php if(@$msg) { ?>
                                <div class="alert alert-danger">
                                    {{ $msg }}
                                </div>
                            <?php } ?>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input required type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} form-forgot">
                                <input required type="password" class="form-control" id="password" name="password" placeholder="Password"> 
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="ps-checkbox">
                                    <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                    <label for="remember-me">Rememeber me</label>
                                </div>
                            </div>
                            <div class="form-group submtit">
                                <button class="ps-btn ps-btn--fullwidth">Login</button>
                            </div>
                        </div>
                        <div class="ps-form__footer">
                            <p class="u-align-center u-text u-text-2">
                                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}">{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                            </p>
                            
                            <p>Connect with:</p>
                            <ul class="ps-list--social">
                                <!-- <li><a class="facebook" href=""><i class="fa fa-facebook"></i></a></li> -->
                                <li><a class="google" href="{{ url('/redirect') }}"><i class="fa fa-google-plus"></i></a></li>
                                <!-- <li><a class="twitter" href=""><i class="fa fa-twitter"></i></a></li> -->
                                <!-- <li><a class="instagram" href=""><i class="fa fa-instagram"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
            <div style="padding-bottom: 130px;"></div>
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
