@extends('layouts.app')

@section('content')
<div class="static-body margin50" style="margin-top: 200px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
                                    <div class="col-md-3"></div>
					<div class="privacy-body">
					
                                            <p>      Dear {{$name}}<br>
                A verification link sent in your email ({{$useremail}}). Please verify.
                </p> 
					
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
