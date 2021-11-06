@extends('layouts.appseller')

@section('content')

				<div class="col-md-9">
								
					

				
					<div class="formPrt">
						<h2>My Profile</h2>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Name:</label>
									<input type="text" placeholder="Name" class="form-control" />
								</div>
								
								<div class="form-group">
									<label>Email:</label>
									<input type="text" placeholder="Email" class="form-control" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Company Logo:</label>
									<input type="file" placeholder="Name" class="form-control" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Phone:</label>
									<input type="text" placeholder="Phone" class="form-control" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Company Name:</label>
									<input type="text" placeholder="Company Name" class="form-control" />
								</div>
							</div>
                                                   
                                                    <div class="col-sm-12">
								<div class="form-group">
									<label>Company Address:</label>
									<textarea rows="4" cols="50" class="form-control"
										placeholder="Write message..."></textarea>
								</div>
							</div>
                                                    <div class="col-sm-6">
								<div class="form-group">
									<label>Country :</label>
									<input type="text" placeholder="Company Name" class="form-control" />
								</div>
							</div>
                                                    <div class="col-sm-6">
								<div class="form-group">
									<label>Year established:</label>
									<input type="text" placeholder="Company Name" class="form-control" />
								</div>
							</div>
                                                    <div class="col-sm-6">
								<div class="form-group">
									<label>Company function:</label>
									<input type="text" placeholder="Company Name" class="form-control" />
								</div>
							</div>
                                                    
                                                    <div class="col-sm-12">
								<div class="form-group">
									<label>Company About:</label>
									<textarea rows="4" cols="50" class="form-control"
										placeholder="Write message..."></textarea>
								</div>
							</div>
                                                    
							


							
						</div>
						<button class="btn margin20">Save</button>
					</div>
				</div>
		
@stop
