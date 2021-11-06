@extends('layouts.setting')

@section('section')

	<div class="card rounded-0">
		<div class="card-body" style="padding: 3%;">
            <h3>{{ __('Reviews') }}</h3>
            <br>

			<div class="row">
				<label for="rating" class="col-sm-3 col-form-label">{{ __('My Rating') }}</label>
				@if(!auth()->user()->hasRole('admin'))
					<div class="col-sm-9">
						<?php 
							if (round($marks) == 0) { ?>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span> ( <?php echo number_format($marks, 1); ?> )
						<?php }elseif (round($marks) == 1) { ?>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span> ( <?php echo number_format($marks, 1); ?> )
						<?php }elseif (round($marks) == 2) { ?>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span> ( <?php echo number_format($marks, 1); ?> )
						<?php }elseif (round($marks) == 3) { ?>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span> ( <?php echo number_format($marks, 1); ?> )
						<?php }elseif (round($marks) == 4) { ?>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span> ( <?php echo number_format($marks, 1); ?> )
						<?php }elseif (round($marks) == 5) { ?>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span> ( <?php echo number_format($marks, 1); ?> )
						<?php } ?>
					</div>
				@endif
			</div><br>

			<div class="row">
				<?php if(count($reviews) > 0) { ?>
                    @foreach($reviews as $review)
                        <div class="col-md-12">
                            <hr>
                            <div class="form-group">
                                <?php 
                                    if (round($review->mark) == 0) { ?>
                                        <?php echo number_format($review->mark, 1); ?>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span> 
                                <?php }elseif (round($review->mark) == 1) { ?>
                                        <?php echo number_format($review->mark, 1); ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span> 
                                <?php }elseif (round($review->mark) == 2) { ?>
                                        <?php echo number_format($review->mark, 1); ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span> 
                                <?php }elseif (round($review->mark) == 3) { ?>
                                        <?php echo number_format($review->mark, 1); ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span> 
                                <?php }elseif (round($review->mark) == 4) { ?>
                                        <?php echo number_format($review->mark, 1); ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span> 
                                <?php }elseif (round($review->mark) == 5) { ?>
                                        <?php echo number_format($review->mark, 1); ?>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span> 
                                <?php } ?>
                                <span class="pull-right">{{ $review->total_price }} {{ $localization_setting->currency }}</span>
                            </div>

                            <div class="form-group">
                                <span>{{ $review->description }}</span>
                                <br><br>

                                <span>{{ $review->name }} ( {{ $review->sign_date }} )</span>
                            </div>
                        </div>
                    @endforeach
                <?php } else { ?>
                    <div style="text-align: center;">
                        <p>No Review</p>    
                    </div>
                <?php } ?>
			</div>
        </div>
    </div>
@endsection