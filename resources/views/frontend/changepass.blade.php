@extends('layouts.appseller')

@section('content')


    <div class="col-md-9">
        
        <?php echo displayAlert(); ?>
        <div class="formPrtt">

            <h3>{{ __('Change Password') }}</h3>
            <br>

            <form method="post" action="{{ route('account.updatePassword', $user->id) }}">
                @csrf
                <div class="row">

                    <input type="hidden" name="_method" value="put">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="old_password" class="col-sm-3 col-form-label">{{ __('Current Password') }}</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="old_password" required name="old_password"
                                    placeholder="{{ __('Current Password') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="password" class="col-sm-3 col-form-label">{{ __('New Password') }}</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" required
                                    placeholder="{{ __('New Password') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="password_confirmation"
                                class="col-sm-3 col-form-label">{{ __('Repeat New Password') }}</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password_confirmation" required
                                    name="password_confirmation" placeholder="{{ __('Repeat New Password') }}" />
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group" style="display: block; text-align: right; padding-right: 3%;">
                        <button type="submit" class="btn margin-20">{{ __('Update Password') }}</button>
                    </div>
                    <!-- /Save Button -->
                </div>
            </form>

        </div>
    </div>
@endsection
