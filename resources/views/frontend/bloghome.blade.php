@extends('layouts.appsecond')
   <section class="bannerPrt">

    <div class="banner">
        <div class="blogSlider" id="blogSlider">
            @foreach ($allposts as $item)
            <div class="item">

                <img src="uploads/{{ $item->image }}" alt="#" />



                <div class="slide__content">
                    <a href="{{ route('blogdetail', $item->id )}}">
                        <h2 class="animated" data-animation-in="fadeInUp">
                            {{$item->title}}
                        </h2>
                    </a>
                </div>
            </div>
            @endforeach
        </div>


    </div>

</section>
@section('content')

    <div class="category-body margin50">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8">
					<div class="row">
                        @foreach ($allposts as $item)
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="blog-panel">
								<div class="topblogimg">
									<a href="{{ route('blogdetail', $item->id )}}">
										<img src="uploads/{{ $item->image }}" alt="img">
									</a>
								</div>
								<div class="downblogcontent">
                                    <a href="{{ route('blogdetail', $item->id )}}">
                                        <h2> {{$item->title}}</h2>
                                    </a>
									<div class="dateprt">
										<p>{!! htmlspecialchars_decode(date('F j Y', strtotime($item->created_at))) !!}</p>

									</div>
									{{-- <p> {{$item->description}}/p> --}}
								</div>
								<div class="blogButtonprt">
									<a href="{{ route('blogdetail', $item->id )}}">READ MORE</a>
								</div>
							</div>
						</div>
                        @endforeach
					</div>

				</div>
				<div class="col-lg-4">
					<div class="blogrightprt">
						<div class="subscribesearchprt margin30">
							<h2>Connect & Follow</h2>
							<div>
                                <div class="addthis_inline_share_toolbox"></div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-601d242ac445b079"></script>
                            </div>
						</div>

						<div class="subscribesearchprt margin30">
							<h2>Latest Posts</h2>

							<ul class="latest__Post">
                                @foreach ($allposts as $item)
								<li>
									<div class="leftblogImg">
										<a href="{{ route('blogdetail', $item->id )}}">
											<img src="uploads/{{ $item->image }}" alt="img">
										</a>

									</div>
									<div class="rightLatestTxt">
										<h3>
                                            {{$item->title}}
                                        </h3>
										<span>{!! htmlspecialchars_decode(date('F j Y', strtotime($item->created_at))) !!}</span>
									</div>
								</li>
                                @endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


@stop
