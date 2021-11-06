@extends('layouts.app')
@section('content')


    <div class="breadcamp">
        <div class="container-fluid">
            <a href="/">Home </a>/
            <a href="../login">Register </a> /
            Verification
        </div>
    </div>
    <div class="category-body margin60" style="margin-bottom:120px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="privacy-body">
                        <h2 class="text-center">
                            Please Verify Your Email !
                        </h2>
                        <p style=" width: 50%; margin-left:25%;">
                            You are welcme to Mambodubai platform ! Please check your inbox
                            (<strong>{{ $useremail }}</strong>) to
                            verify your email address and get access of the most valuable business network.
                            This is the just the last step to complete your registration and keep your account safe by
                            verifying the ownership
                        </p>

                    </div>
                </div>
            </div>





        </div>
    </div>


@endsection
