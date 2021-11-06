@extends('layouts.app')

@section('content')
<div class="ps-page--my-account">
    <div class="ps-my-account" style="min-height: 60vh;">
        <div class="container">
            <div class="ps-form--account-padding"></div>
            <form class="ps-form--account ps-tab-root" action="{{ route('emails.validatecode') }}" method="post" style="border: 1px solid;">
                <ul class="ps-tab-list">
                    <li class="active">
                        <a href="#sign-in">
                            <br>
                            <h3>
                                Please enter code!
                            </h3>
                        </a>
                    </li>
                </ul>
                <div class="ps-tabs">
                    <div class="ps-tab active" id="sign-in">
                        <div class="ps-form__content">
                            <h5>{{ $useremail }}</h5>
                            {!! csrf_field() !!}
                            <input type="hidden" name="role" value="{{ $role }}" />
                            <input type="hidden" name="email" value="{{ $useremail }}" />

                            <input required type="text" name="verify_codes" class="form-control" value="{{ $id }}" placeholder="Enter Code">    
                            <br>
                            
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <br>
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            @if ($msg)
                                <br>
                                <span class="help-block">
                                    <strong>{{ $msg }}</strong>
                                    <a href="{{ route('emailverifyforresend', ['email' => $useremail, 'role' => $role]) }}">Resend</a>
                                </span>
                                <br>
                            @endif

                            <div class="form-group submtit">
                                <button class="ps-btn ps-btn--fullwidth">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
