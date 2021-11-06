@extends('layouts.admin')

@section('content')

    <div class="main-panel">
        <div class="content">


            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Create Unit</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="/">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>

                        <li class="nav-item">
                            <a href="#">Unit</a>
                        </li>
                    </ul>
                </div>
        <div class="row">
          	<div class="col-12">
				<form action="{{ route('unit.update', $unit->id) }}" method="POST">
					@csrf

					<input type="hidden" name="_method" value="put">

					<div class="box">
						<div class="box-body">
							<div class="form-group">
								<label>Name</label>
								<input required type="text" name="name" class="form-control input-sm" placeholder="Name" value="{{ $unit->name }}" />
							</div>
						</div>

						<div class="box-footer">
							<button class="ps-btn btn-flat pull-right">Update Unit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

</div>
@endsection