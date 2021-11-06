@extends('layouts.appseller')

@section('content')

<!-- Map and From Area -->
<div class="col-md-9">
    <?php echo displayAlert(); ?>
    <div class="datatablestructure">
          <h4>Add Review</h4>
          @if($user_status == 1)
            <p style="color: red;">Your account was blocked by admin!</p>
          @endif

          <form action="{{ route('reviews.store') }}" method="POST" id="add_comments" style="width: 100%;">
            <div class="form-group">
              @csrf
              <input type="hidden" name="purchase_id" value="{{ $record->id }}">
              <input type="hidden" name="receiver" value="{{ $quotes[0]->sender }}">

              @if(auth()->user()->hasRole('seller'))
                <label><a href="{{ url('/purchaseorders/userreview', $quotes[0]->sender) }}" id="{{ $quotes[0]->sender }}"></a></label>
              @elseif(auth()->user()->hasRole('buyer'))
                <label><a href="{{ url('/purchaseorders/userreview', $quotes[0]->sender) }}" id="{{ $quotes[0]->sender }}">Seller Name: {{ $quotes[0]->username }}  &nbsp;  Seller Company Name: {{ $company }}</a></label><br><br>
              @endif

              <label>Rating</label>
                <div class="radioprt">
                  <div class="listitem-check">
                    <input type="radio" name="mark" value="1">
                    <label onclick="">Bad</label>
                  </div>
                  <div class="listitem-check">
                    <input type="radio" name="mark" value="2">
                    <label onclick="">Satisfactory</label>
                  </div>
                  <div class="listitem-check">
                    <input type="radio" name="mark" value="3">
                    <label onclick="">Normal</label>
                  </div>
                  <div class="listitem-check">
                    <input type="radio" name="mark" value="4">
                    <label onclick="">Good</label>
                  </div>
                  <div class="listitem-check">
                    <input type="radio" name="mark" value="5">
                    <label onclick="">Excellent</label>
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label>Remarks</label>
              <textarea rows="6" class="form-control description" name="description" id="description" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-danger" href="{{ route('purchaseorders.create') }}" style="color: #fff;">Back</a>

          </form>
        </div>
      </div>
      <div class="col-8 h-100">

      </div>

<!-- End Map and From Area -->
@stop
