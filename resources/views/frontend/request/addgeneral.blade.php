@extends('layouts.appseller')

@section('content')
<div class="col-md-9">
    <?php echo displayAlert(); ?>

<div class="formPrtt">
        <form  action="{{ route('request.store') }}" method="post"  enctype="multipart/form-data">
          <h4> Add General Request </h4><br>

        @csrf
        <div class="form-group">
            <label>Product Name*</label>
              <input type="text" class="form-control" name="product_name">
              <input type="hidden" name="type" id="type" value="-1" />
          </div>
        <div class="form-group">
            <label>Request Quantity*</label>
              <input type="text" class="form-control" id="quantity" name="req_quantity">
        </div>

        <div class="form-group">
            <label>Unit*</label>
              <select class="form-control select2 unit" id="unit" name="unit">
                <option selected value="">Select</option>
                @foreach($units as $unit)
                  <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
              </select>


        </div>

        <div class="form-group">

            <label>Additional Information*</label>


            <textarea class="form-control"  name="description"></textarea>

        </div>

        <div class="form-group">
            <label>Choose file</label>

            <input type="file" name="files" id="files" class="form-control files" />

        </div>
          <div class="form-group">
            <button  type="submit" class="btn margin20">Request a quote</button>
          </div>
      </form>
    </div>
</div>






@stop
