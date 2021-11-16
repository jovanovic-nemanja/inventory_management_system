@extends('layouts.inventory', ['menu' => 'batch'])

@section('content')
  <?php echo displayAlert(); ?>
  <div class="page-header">
    <h3 class="page-title"> Batch </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/inventoryboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Batch</li>
      </ol>
    </nav>
  </div>
  <div class="card grid-margin">
    <div class="card-body">
      <div class="row justify-content-between pb-3">
        <h4 class="card-title">Batch List</h4>
        <div class="text-right">
          <a type="button" href="{{ route('batch.create') }}" class="btn btn-success btn-round ml-auto">
            <i class="fa fa-plus"></i>Create Batch
          </a>
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
                <tr>
                  <th>No #</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($allbatch as $batch)
                  <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->name }}</td>
                    <td>
                      <a href="{{ route('batch.addProductbatch', $batch->id) }}"
                          data-toggle="tooltip" title="Manage Product" class="btn btn-link btn-add btn-success"
                          data-original-title="Add Product">
                          <i class="fa fa-plus"></i>
                      </a>
                      
                      <a href="{{ route('batch.view', $batch->id) }}"
                          data-toggle="tooltip" title="View" class="btn btn-link btn-edit btn-success"
                          data-original-title="View">
                          <i class="fa fa-eye"></i>
                      </a>
                      <a href="{{ route('batch.edit', $batch->id) }}"
                          data-toggle="tooltip" title="Edit" class="btn btn-link btn-edit btn-success"
                          data-original-title="Edit">
                          <i class="fa fa-edit"></i>
                      </a>
                      <a href="{{ route('batch.delete', $batch->id) }}"
                          data-toggle="tooltip" title="Delete" class="btn btn-link btn-danger"
                          data-original-title="Remove">
                          <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
