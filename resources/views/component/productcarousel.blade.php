
<div class="product-item">
     @foreach($images as $image)
				

										
										<div class="product-image">
											<img src="{{ asset('uploads/') }}/{{ $image->url }}" alt="product-img" />

										</div>
 @endforeach
									</div>
 
  <div class="slider slider-nav">
      @foreach($images as $image)
										<div>
											<div class="itemList">
												<img src="{{ asset('uploads/') }}/{{ $image->url }}" alt="product-img" />
											</div>

										</div>
										
										 @endforeach
									</div>
