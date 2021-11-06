@extends('layouts.appsecond')

@section('content')
<div class="blog-detailbannerprt" style="background: url('{{ asset('uploads/') }}/{{$posts->image}}') 0 0 no-repeat;  background-attachment: fixed;
  background-position: center; background-repeat: no-repeat; background-size: cover;">
		<div class="blog-detailmid_cont">
			<h2>{{$posts->title}}</h2>
			<div class="dateprt">
				<p>{!! htmlspecialchars_decode(date('F j Y', strtotime($posts->created_at))) !!}</p>

			</div>
		</div>
	</div>

	<div class="category-body margin50">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8">
					<div class="blog-detailpara">

                    {!! htmlspecialchars_decode($posts->description) !!}

                    <div>
                        <div class="addthis_inline_share_toolbox"></div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-601d242ac445b079"></script>
                    </div>
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
											<img src="{{ asset('uploads/') }}/{{ $item->image }}" alt="img">
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
