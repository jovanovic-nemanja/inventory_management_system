@extends('layouts.setting')

@section('section')
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
 
	<div class="card rounded-0">
		<div class="card-body">
            <h5 class="text-uppercase font-weight-bold">{{ __('Edit Address') }}</h5>
            <br>
		    <form method="post" action="{{ route('address.update', $address->id) }}">
				@csrf
				<input type="hidden" name="_method" value="put">

				<div class="form-group row">
					<div class="col-md-12">
						<label for="address_name" class="col-form-label">{{ __('Address Name') }}</label>
						<input type="text" class="form-control" id="address_name" name="address_name" value="{{ $address->address_name }}" placeholder="Address Name">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label for="first_name" class="col-form-label">{{ __('First Name') }}</label>
						<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $address->first_name }}" placeholder="First Name">
					</div>

					<div class="col-md-6">
						<label for="last_name" class="col-form-label">{{ __('Last Name') }}</label>
						<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $address->last_name }}" placeholder="Last Name">
					</div>

				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label for="email" class="col-form-label">{{ __('Email Address') }}</label>
						<input type="text" class="form-control" id="email" name="email" value="{{ $address->email }}" placeholder="Email Address">
					</div>

					<div class="col-md-6">
						<label for="phone" class="col-form-label">{{ __('Phone Number') }}</label>
						<input type="text" class="form-control" id="phone" name="phone" value="{{ $address->phone }}" placeholder="Phone Number">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<label for="full_address" class="col-form-label">{{ __('Address') }}</label>
						<textarea name="full_address" class="form-control" cols="30" rows="2" placeholder="Address">{{ $address->full_address }}</textarea>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-12">
						<label for="suburb_or_town" class="col-form-label">{{ __('Suburb / Town') }}</label>
						<input type="text" class="form-control" id="suburb_or_town" name="suburb_or_town" value="{{ $address->suburb_or_town }}" placeholder="Suburb / Town">
					</div>						
				</div>

				<div class="form-group row">
					<div class="col-md-6">
						<label for="state_or_territory" class="col-form-label">{{ __('State / Teritory') }}</label>
						<input type="text" class="form-control" id="state_or_territory" name="state_or_territory" value="{{ $address->state_or_territory }}" placeholder="State / Teritory">
					</div>
					<div class="col-md-6">
						<label for="post_code" class="col-form-label">{{ __('Post Code') }}</label>
						<input type="text" class="form-control" id="post_code" name="post_code" value="{{ $address->post_code }}" placeholder="Post Code">
					</div>				
				</div>
				<br>

				<!-- Save Button -->
				<div class="form-group row">
				<div class="col-sm-12">
				  <button type="submit" class="btn btn-primary float-right btn-flat">{{ __('Update Address') }}</button>
				</div>
				</div>
				<!-- /Save Button -->
		    </form>
	    </div>
    </div>
@endsection