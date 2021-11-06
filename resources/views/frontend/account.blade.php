@extends('layouts.appseller')

@section('content')

    <div class="col-md-9">
        <?php echo displayAlert(); ?>

        <form method="post" enctype="multipart/form-data" action="{{ route('account.update', $userDetail->id) }}">
            @csrf

            <input type="hidden" name="_method" value="put">
            <div class="formPrtt">
                <h2>My Profile</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name:<sup>*</sup></label>
                            <input type="text" name="name" value="{{ $userDetail->name }}" placeholder="Name"
                                class="form-control" />
                        </div>

                        <div class="form-group">
                            <label>Email:<sup>*</sup></label>
                            <span class="form-control">{{ $userDetail->email }}</span>
                            <input type="hidden" name="email" value="{{ $userDetail->email }}" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Logo:</label>
                            <input type="file" name="company_logo" id="file" class="form-control" />

                            @if ($userDetail->company_logo)
                                <img src="{{ asset('uploads/') }}/{{ $userDetail->company_logo }}" alt="img"
                                    width="200px">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone_number" value="{{ $userDetail->phone_number }}"
                                placeholder="Phone" class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Name:<sup>*</sup></label>
                            <input type="text" name="company_name" value="{{ $userDetail->company_name }}"
                                placeholder="Company Name" class="form-control" required />
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Company Address:</label>
                            <textarea rows="4" cols="50" name="company_address" class="form-control"
                                placeholder="Your company address">{{ $userDetail->company_address }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Country :<sup>*</sup></label>
                            <select name="country" class="form-control select2" required>
                                <option value="">Select Country</option>
                                @foreach ($all_country as $country)
                                    @if ($country->id == $userDetail->country)
                                        <option selected="" value="{{ $country->id }}">{{ $country->name }}</option>
                                    @else
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endif
                                @endforeach
                                <!--<input type="text" placeholder="Company Name" value="{{ $userDetail->country }}" name="country" class="form-control" />-->
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Year established:</label>

                            <input type="date" placeholder="Year established"
                                value="{{ $userDetail->year_of_establishment }}" name="year_of_established"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company function:</label>
                            <!--<input type="text" placeholder="Company Name" value="{{ $userDetail->company_function }}"  name="company_function" class="form-control select2" />-->
                            <!--                        <select  multiple data-live-search="true"   >-->
                            <?php $company_function = explode(',', $userDetail->company_function); ?>
                            <select name="company_function[]" class="form-control selectpicker" multiple>
                                <?php if (in_array('Manufacturer', $company_function)) { ?>
                                <option value="Manufacturer" selected="">Manufacturer</option>
                                <?php } else { ?>
                                <option value="Manufacturer">Manufacturer</option>
                                <?php } ?>
                                <?php if (in_array('Distributor', $company_function)) { ?>
                                <option value="Distributor" selected="">Distributor</option>
                                <?php } else { ?>
                                <option value="Distributor">Distributor</option>
                                <?php } ?>
                                <?php if (in_array('Whole Seller', $company_function)) { ?>
                                <option value="Whole Seller" selected="">Whole Seller</option>
                                <?php } else { ?>
                                <option value="Whole Seller">Whole Seller</option>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Prefered Currency:<sup>*</sup></label>
                            <!--<input type="text" placeholder="Currency"  value="{{ $userDetail->currency }}" name="currency" class="form-control" />-->

                            <select name="currency" class="form-control" required>
                                <option value="">Select Currency</option>
                                @foreach ($currencies as $curr)
                                    @if ($curr->id == $userDetail->currency)
                                        <option selected="" value="{{ $curr->id }}">{{ $curr->name }}</option>
                                    @else
                                        <option value="{{ $curr->id }}">{{ $curr->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @if (auth()->user()->hasRole('seller'))
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company License:</label>
                                <input type="file" name="company_license" id="file_license" class="form-control" />

                                @if ($userDetail->company_license)
                                    <a target="_blank" style="font-weight:bolder;"
                                        href="{{ asset('uploads/company_license') }}/{{ $userDetail->company_license }}">
                                        View License </a>
                                @endif
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="company_license" value="" class="form-control" />
                    @endif
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Company About:</label>
                            <textarea rows="4" cols="50" name="company_about" class="form-control"
                                placeholder="Company About"> {{ $userDetail->company_about }}</textarea>
                        </div>
                    </div>





                </div>
                <button class="btn margin20">Save</button>
            </div>
        </form>
    </div>

@stop
