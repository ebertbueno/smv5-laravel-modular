@extends( Config::get('themes.frontend') )

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				
				<div class="container">
					
							<h2 class="text-center">{{ trans('petition::petitions.manage_petition') }}</h2>
							<a href="petition/create" class="btn btn-default ">{{ trans('petition::petitions.create_petition') }}</a> 
							<!-- tabs start -->
							<div class="tabs-style-2">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li class="active"><a href="#h2tab1" role="tab" data-toggle="tab"><i class="fa fa-home pr-5"></i> {{ trans('petition::petitions.my_petitions') }}</a></li>
									<li><a href="#h2tab2" role="tab" data-toggle="tab"><i class="fa fa-user pr-5"></i> {{ trans('layout.my') }} {{ trans('sign.signatures') }}</a></li>
									<!--<li><a href="#h2tab3" role="tab" data-toggle="tab"><i class="fa fa-envelope pr-5"></i>{{ trans('petition::petitions.victory') }}</a></li> -->
								</ul>
								<!-- Tab panes -->
								<div class="tab-content" style="padding-top:0px">
									<div class="tab-pane fade in active" id="h2tab1">
										
											<div class="vertical" style="margin-top:0px">
														<!-- Nav tabs -->
														<ul class="nav nav-tabs" role="tablist">

																@foreach( $petitions as $key => $petition )
																					<li {{ ($key == 0 ) ? 'class="active"':'' }}>
																						<a href="#vtab{{ $petition->id }}" role="tab" data-toggle="tab">
																								<i class="fa fa-magic pr-10"></i> {{ substr($petition->title, 0,30) }}
																						</a>
																					</li>
																@endforeach

														</ul>
														<!-- Tab panes -->
														<div class="tab-content">

																@foreach( $petitions as $key => $petition )

																		<div class="tab-pane fade in {{ ($key == 0 ) ? 'active':'' }}" id="vtab{{ $petition->id }}">
																				<h1 class="text-center title"> {{ $petition->title }}</h1>
																				<p>{{ $petition->declaration }}</p>
																				<h3>{{ trans('petition::petitions.for_who') }}</h3>
																				<p>{{ $petition->receiver }}</p>

																				<h3>{{ trans('petition::petitions.with_who') }}</h3>
																				<p>{{ $petition->sender }}</p>
																				<ul class="list-icons">
																					<li class="object-non-visible" data-animation-effect="fadeInUpSmall">
																						<i class="icon-check"></i> Site: {{ $petition->address }}</li>
																					<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
																						<i class="icon-check"></i> Tags: {{ $petition->tags }} </li>
																					<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="300">
																						<i class="icon-check"></i> Categoria: {{ $petition->category }}</li>
																					<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="500">
																						<i class="icon-check"></i> Link da petição: {{ url('petitions', [$petition->id]) }}</li>
																				</ul>
																				<div class="separator"></div>
																				<h2 class="title">{{ trans('petition::petitions.share_petition') }}</h2>
																				<div class="separator-2"></div>
																				<p class="lead">{{ trans('petition::petitions.share_text') }}</p>
																				<br>
																				@include('petition::petition.share', $petition)

																					<a href="./petitions/{{ $petition->id }}" class="btn btn-info">{{ trans('layout.view') }}</a>
																					<a href="./signature/{{ $petition->id }}/edit" class="btn btn-info">{{ trans('sign.signatures') }}</a>
																					<a href="./petition/{{ $petition->id }}/edit" class="btn btn-default">{{ trans('layout.edit') }}</a>
																					<!--<a href="./petition/{{ $petition->id }}" class="btn btn-default">Export</a>-->
																					<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-danger sure-prompt"  alt="Tem certeza disso?" data-id="{{ $petition->id }}" data-name="{{ $petition->title }}" >{{ trans('layout.delete') }}</a>
																		</div>
															
																@endforeach
													<!-- tabs end -->
													</div>
											</div>
										
									</div>
										
									<div class="tab-pane fade" id="h2tab2">
											<div class="space"></div>
										
											@include('petition::petition.petition_folio', $sign_petitions)
										
											<!-- pagination start 
											<ul class="pagination">
												<li><a href="#">«</a></li>
												<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
												<li><a href="#">4</a></li>
												<li><a href="#">5</a></li>
												<li><a href="#">»</a></li>
											</ul>-->
											<!-- pagination end -->
										
									</div>
									<!--<div class="tab-pane fade" id="h2tab3">
												<div class="space"></div>
												<div class="list-item">
														<div class="row">
															<div class="col-sm-6 col-md-4 col-lg-3">
																<div class="overlay-container">
																	<img src="images/portfolio-1.jpg" alt="">
																	<div class="overlay">
																		<div class="overlay-links">
																			<a href="portfolio-item.html"><i class="fa fa-link"></i></a>
																			<a href="images/portfolio-1.jpg" class="popup-img"><i class="fa fa-search-plus"></i></a>
																		</div>
																		<span>Web Design</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6 col-md-8 col-lg-9">
																<div class="body">
																	<h3 class="title"><a href="portfolio-item.html">Project Title</a></h3>
																	<p class="small"><i class="icon-calendar"></i> Feb, 2015 <i class="pl-10 fa fa-tags"></i> Web Design</p>
																	<p><i class="icon-calendar"></i> Assinaturas: 9999999 </p>

																	<a href="page-services.html" class="btn btn-default">Abrir</a>
																	<a href="page-services.html" class="btn btn-default">Remover assinatura</a>
																</div>
															</div>
														</div>
													</div>
													<div class="list-item">
														<div class="row">
															<div class="col-sm-6 col-md-4 col-lg-3">
																<div class="overlay-container">
																	<img src="images/portfolio-2.jpg" alt="">
																	<div class="overlay">
																		<div class="overlay-links">
																			<a href="portfolio-item.html"><i class="fa fa-link"></i></a>
																			<a href="images/portfolio-2.jpg" class="popup-img"><i class="fa fa-search-plus"></i></a>
																		</div>
																		<span>Web Design</span>
																	</div>
																</div>
															</div>
															<div class="col-sm-6 col-md-8 col-lg-9">
																<div class="body">
																	<h3 class="title"><a href="portfolio-item.html">Project Title</a></h3>
																	<p class="small"><i class="icon-calendar"></i> Feb, 2015 <i class="pl-10 fa fa-tags"></i> Web Design</p>
																	<p><i class="icon-calendar"></i> Assinaturas: 9999999 </p>

																	<a href="page-services.html" class="btn btn-default">Abrir</a>
																	<a href="page-services.html" class="btn btn-default">Remover assinatura</a>
																</div>
															</div>
														</div>
													</div>

													<ul class="pagination">
														<li><a href="#">«</a></li>
														<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
														<li><a href="#">2</a></li>
														<li><a href="#">3</a></li>
														<li><a href="#">4</a></li>
														<li><a href="#">5</a></li>
														<li><a href="#">»</a></li>
													</ul>
										
									</div>-->
								</div>
									</div>
							<!-- tabs end -->

				</div>
			</div>
			<!-- section end -->
@endsection

@section('modal')
			<div class="modal-header">
					<h3 class="modal-title"><h3>
			</div>
			<div class="modal-body">
					<!-- section start -->
			<!-- ================ -->
				{!! Form::open(['url' => 'petition/', 'method' => 'delete', 'class'=>"delete-form"]) !!}
					<div class="col-md-12">
								<div class="status"></div>
								{!! Form::label('name', trans('petition::petitions.delete_text'), ['class'=>'col-md-12']) !!}	
								<hr>
								<div class="form-group">
										{!! Form::label('comment', trans('petition::petitions.comment').'*') !!}
										{!! Form::textarea('comment', null, ['class'=>'form-control'] ) !!}
								</div>

								<div class="form-group">
									{!! Form::label(' ', '') !!}
									<div class="col-md-12">
										<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('layout.delete') }}</button>
										<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('layout.close') }}</button>
									</div>
								</div>
				</div>
				<div class="clearfix"></div>
			{!! Form::close() !!}

			</div>
@endsection
		
@section('js')
		
		<!-- Parallax javascript -->
		<script src="{{ asset('plugins/jquery.parallax-1.1.3.js') }}"></script>
		<!-- Isotope javascript -->
		<script type="text/javascript" src="{{ asset('plugins/isotope/isotope.pkgd.min.js') }}"></script>
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
@endsection
			
@section('script')
	$(document).ready(function()
	{
			$('#myModal').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var id = button.data('id');
				var name = button.data('name'); 
				var modal = $(this);
				modal.find('.modal-title').text( '{{ trans('layout.delete') }}'+name );
				modal.find('.modal-body form').attr('action', '{{ url('petition') }}/'+id );
			});		
	});
@endsection
