<style>
	table {
		border: 1px solid #999;
		border-collapse: collapse;
		width: 100%
	}

	td {
		border: 1px solid #999
	}

	.table td,
	.table th {
		padding: 5px !important;
	}

</style>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-space">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h3>
									{{ $items['batch']->name }}
								</h3>
							</div>
						</div>

						<div class="accordion accordion-secondary">
							@php
								$increment = 1;
								$tbl_inc = 1;
								$td_inc = 1;
							@endphp
							@foreach ($items['allcategory'] as $cus)
								<div class="card">
									<div class="card-header collapsed" id="heading{{ $cus->id }}"
										data-toggle="collapse" data-target="#collapse{{ $cus->id }}"
										aria-expanded="false" aria-controls="collapse{{ $cus->id }}"
										role="button">
										<div class="span-icon">
											<div class="flaticon-box-1"></div>
										</div>
										<div class="span-title">
											{{ $cus->name }}
										</div>
										<div class="span-mode"></div>
									</div>

									<div id="collapse{{ $cus->id }}" class="collapse"
										aria-labelledby="heading{{ $cus->id }}" data-parent="#accordion">
										<div class="card-body">

											<table class="table table-head-bg-success"
												id="myTable_{{ $increment }}" style="text-align: center;">
												<thead>
													<tr>
														<th scope="col" rowspan="2"
															style="border: 1px solid #999 !important;">Product</th>

														@php
															$counts = count(App\Mark::where('container_id', $items['container']->id)->get());
														@endphp
														<th scope="col" colspan="<?= $counts + 1 ?>"
															style="text-align: center; border: 1px solid #999 !important;">
															{{ $items['container']->owner_name }}</th>
													</tr>
													<tr>
														@foreach ($items['allmarks'] as $mark)
															<th scope="col">{{ $mark->name }}</th>
														@endforeach
														<th scope="col">Total</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($items['allproductdetail'] as $prod)
														@if ($prod->category_id == $cus->id)
															@if($prod->prod_stock > 0)
																<tr id="row_{{ $tbl_inc }}"
																	class="getRow">
																	<td>
																		<label>{{ $prod->product_name }}</label>
																	</td>

																	@if (isset($items['allmarkdetail'][$tbl_inc - 1]))
																		@php
																			$markinc = 1;
																			$total = 0;
																			$incMarkData = $items['allmarkdetail'][$tbl_inc - 1]['mark_data'];
																			$incMarkData = json_decode($incMarkData);
																			$countOfprev = $items['prev_count'];
																			
																		@endphp
																		@foreach ($items['allmarks'] as $key => $mark)
																			@php
																				$makrval = $incMarkData[$markinc - 1 + $countOfprev];
																				$total = $total + $makrval;
																			@endphp

																			<td>
																				<label>{{ $makrval }}</label>
																			</td>
																			@php
																				$td_inc++;
																				$markinc++;
																			@endphp
																		@endforeach
																		<td><label>{{ $total }}</label></td>
																	@endif
																</tr>

																@php
																	$tbl_inc++;
																@endphp
															@endif
														@endif
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								@php
									$increment++;
								@endphp
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>