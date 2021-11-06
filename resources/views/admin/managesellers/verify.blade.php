@extends('layouts.dashboards')

@section('content')
<div class="card">
  	<div class="card-body" style="padding: 5%;">
        <div class="row">
          	<div class="col-12">
				<form action="{{ route('managesellers.submitVerify') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<h4> Verify Seller </h4>
					<br>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('document') ? 'has-error' : '' }}">
								<label>Choose document</label>
				                <input type="file" class="form-control" id="document" name="document" placeholder="Document" required accept=".pdf" />
				                <span class="glyphicon glyphicon-user form-control-feedback"></span>
				                @if ($errors->has('document'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('document') }}</strong>
				                    </span>
				                @endif
				            </div>  
				            
				            <input type="hidden" name="userid" value="{{ $id }}">

				            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
				            	<label>Comments</label>
				                <textarea class="form-control comment" id="comment" name="comment" required></textarea>
				                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				                @if ($errors->has('comment'))
				                    <span class="help-block">
				                        <strong>{{ $errors->first('comment') }}</strong>
				                    </span>
				                @endif
				            </div>

				            <div class="form-group" style="text-align: center;">
				                <button class="btn btn-primary btn-flat pull-right" type="submit">Verify</button> 
				            </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
@stop