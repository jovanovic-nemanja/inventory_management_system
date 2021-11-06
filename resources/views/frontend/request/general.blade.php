@extends('layouts.appseller')

@section('content')

<!-- Map and From Area -->
<div class="col-md-9">
    <?php echo displayAlert(); ?>
    <div class="datatablestructure">
          @if(auth()->user()->hasRole('buyer'))

            <div class="row">
            <div class="col-md-6">
            <h3>My General Requests</h3>
            </div>
            <div class="col-md-6" style="text-align: right;">
                <a class="btn btn-success" href="{{ route('request.addgeneral') }}">
                    Add Request
                </a>

                @if($user_status == 1)
                <p style="color: red;">Your account was blocked by admin!</p>
                @endif
            </div>
        </div>
        <br>
            <table id="example" class="table dt-responsive" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Request ID</th>
				  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <!-- <th width="10%">Destination</th>
                  <th width="20%">Additional information</th> -->
                  <!--<th>Attached file</th>-->
                  <th>Status</th>
                  <th>Request Date</th>
                  @if($user_status == 0)
                    <th>Action</th>
                  @endif

                  @if($user_status == 1)
                  @endif
                </tr>
              </thead>

              <tbody>
                @foreach($requests as $request)
                  <tr>
                    <td>{{ $request['id'] }}</td>
					<td>{{ $request['product_name'] }}</td>
                    <td>{{ $request['req_quantity'] }}</td>
                    <td>
                      <h4 style='display: none;' class="unit_val">{{ $request['unit'] }}</h4>
                      {{ $request->getunit($request['unit']) }}
                    </td>


                    @if($request['status'] == 1)
                      <td>Pending</td>

                    @elseif($request['status'] == 2)
                      <td>Approved</td>

                    @elseif($request['status'] == 3)
                      <td>Canceled</td>

                    @endif

                    <td>{{ $request['sign_date'] }}</td>
                    <td style="white-space: nowrap">
                    @if($user_status == 0)
                      @if($request['status'] == 1)
                         <a class="btn btn-success" href="{{ route('request.view', $request['id']) }}" id="{{ $request['id'] }}" style="color: #fff;">View</a>
                        <a class="btn btn-success" href="{{ route('request.change', $request['id']) }}" id="{{ $request['id'] }}">Edit</a>

                      @elseif($request['status'] == 2)
                        <a class="btn btn-success" href="{{ route('request.view', $request['id']) }}" id="{{ $request['id'] }}" style="color: #fff;">View</a>
                      @endif

                      @if($request['status'] == 1)
                        <a class="btn btn-danger delete" href="{{ url('/request/destroy', $request->id) }}" style="color: #fff;">Cancel</a>
                      @endif
                    @endif
</td>
                    @if($user_status == 1)
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif

          <a class="btn btn-medium btn-success rfq" data-toggle="modal" data-target="#myModal" style='display: none;'></a>

  </div>
</div>
<!-- End Map and From Area -->
@stop
