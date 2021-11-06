@extends('layouts.appseller')

@section('content')

<div class="col-md-9">
    <?php echo displayAlert(); ?>
    <h4>{{$page}}</h4>
    <div class="datatablestructure">

        <table id="example" class="table dt-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Product Name</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requestcallback as $request)
                <tr>

                    <td>{{ $request->id }}</td>
                    <td>{{ $request->name }}</td>
                    <td>{{ $request->email_add }}</td>
                    <td>{{ $request->mobile }}</td>
                    <td>{{ $request->prod_name }}</td>
                    <td>{{ $request->message }}</td>
                    <td>{{ $request->sign_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
