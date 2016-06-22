@extends( Config::get('themes.frontend') )

@section('content')
					
	<!-- banner start -->
	<!-- ================ -->
	<div class="banner">
			<div class="fixed-image section light-translucent-bg" style="background-image:url('{{ asset('uploads/'.$petition->image ) }}');">
				<div class="container">

				<div class="space-top"></div>
				<h1> {{ $petition->title }}</h1>
				<div class="separator-2"></div>
				<div class="row">
					<div class="col-md-10">
						<ul class="list-icons">
							<li class="object-non-visible" data-animation-effect="fadeInUpSmall">
								<i class="icon-check"></i> Site: <a href="{{ $petition->address }}" target="_blank">{{ $petition->address }}</a></li>
							<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
								<i class="icon-check"></i> Tags: {{ @$petition->tags }} </li>
							<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="300">
								<i class="icon-check"></i> Categoria: {{ @$petition->category->name }}</li>
							<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="500">
								<i class="icon-check"></i> 
								Link da petição: <a href="{{ url('petitions', [$petition->id]) }}">{{ url('petitions', [$petition->id]) }}</a>
							</li>
						</ul>	
					</div>
					<div class="col-md-2">
							<a class="btn btn-lg btn-default pull-right btn-signature" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil pr-10"></i>{{ trans('sign.signature') }}</a>									
					</div>

				</div>

		</div>
	</div>
	<!-- banner end -->

	<!-- main-container start -->
	<!-- ================ -->
	<section class="main-container">
		<div class="container">
			<div class="row">

				<!-- main start -->
				<!-- ================ -->
				<div class="main col-md-12">
					<!-- page-title start -->
					<h1 class="page-title">{{ trans('petition.what_claim') }}</h1>
					<div class="separator-2"></div>
					<!-- page-title end -->
					<div class="row">
							<!-- CONTENT PETITION -->
							<div class="col-md-8">
								
									<p><img src="{{ asset('uploads/'.$petition->image) }}" style="height:80px; width:auto" ></p>
									<p>{{ $petition->declaration }}.</p>

									<h3>{{ trans('petition.for_who') }}</h3>
									<p>{{ $petition->receiver }}</p>

									<h3>{{ trans('petition.with_who') }}</h3>
									<p>{{ $petition->sender }}</p>

									<h3>{{ trans('petition.infos') }}</h3>
									<ul class="list-icons">
											<li class="object-non-visible" data-animation-effect="fadeInUpSmall">
												<i class="icon-check"></i> Site: {{ $petition->address }}</li>
											<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
												<i class="icon-check"></i> Tags: {{ $petition->tags }} </li>
											<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="300">
												<i class="icon-check"></i> Categoria: {{ @$petition->category->name }}</li>
											<li class="object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="500">
												<i class="icon-check"></i> Link da petição: {{ url('petitions', [$petition->id]) }}</li>
									</ul>
									<div class="separator"></div>
								
								  <!-- SHARE PEITITON -->
									<h2 class="title">{{ trans('petition.share_petition') }}</h2>
									<div class="separator-2"></div>
									<p class="lead">{{ trans('petition.share_text') }}</p>
									<br>
									@include('petition::petition.share', $petition)
									<div class="separator"></div>
								
									<!-- TIMELINE PETITION -->
									<h2 class="title">{{ trans('petition.timeline.title') }}</h2>
									<div class="separator-2"></div>
									<p class="lead">{{ trans('petition.timeline.subtitle') }}.</p>
									@if( Auth::check() )
								  <p>
										<a href="#" class="btn-newtimeline">
											<b>{{ trans('petition.timeline.btn-new') }}</b ><b class="fa fa-times" style="display:none"></b>
										</a>
								  </p>
									<div id="status-timeline"></div>
								  <div class="row new-timeline gray-bg clearfix" style="display:none">
											@include('petition::petition.timeline_form')
									</div>
									@endif
									<div class="row">
									@foreach( $timeline as $row )			
										<div class="col-md-12 gray-bg clearfix">
											<h4><a href="{{ $row->link }}" target="_blank" title="{{ trans('layout.view') }}">{{ $row->title }}</a></h4>
											<p>	
												{{ $row->content }}<br>
												<small style="color:#999">{{ trans('petition.created_at') }} {{ date('d/m/Y H:i'), strtotime($row->created_at) }}</small>
											</p>
										</div>
									@endforeach		
									</div>

						</div>
						<!-- END CONTENT PETITION -->
						
						<!-- SIDEBAR -->
						<aside class="sidebar col-md-4">
									<div class="side vertical-divider-left">
										
										<a class="btn btn-lg btn-default btn-signature" href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil pr-10"></i> {{ trans('sign.signature') }}</a>
										<div class="block clearfix">
											<h3 class="title margin-top-clear">{{ trans('sign.signatures') }}</h3>
											<div class="separator"></div>
											<div class="box-style-1 white-bg margin-top-clear">
												<i class="fa fa-users"></i>
												<span class="stat-num sign-count">{{ $signatures }}</span>
											</div>
										</div>
										
										<h3 class="title"><small>{{ trans('petition.created_by') }}:</small> {{ $petition->user->name }}</h3>
										<ul class="list-icons">
											<li><a href="{{ url('message/create?user='.$petition->user_id) }}">{{ trans('message.send_message') }}</a></li>
											<li><a href="{{ url('signature/'.$petition->id.'/find') }}" alt="Tem certeza?">{{ trans('sign.remove') }}</a></li>
											<li class="dropdown">
													<a href="#" id="dropdownMenu1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
														{{ trans('petition.report') }}
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
														<li class="dropdown-header">{{ trans('petition.report.why') }}</li>
														<li><a href="{{ url('petitions/'.$petition->id.'/report?why=1') }}" class="why1">{{ trans('petition.report.why1') }}</a></li>
														<li><a href="{{ url('petitions/'.$petition->id.'/report?why=2') }}" class="why2">{{ trans('petition.report.why2') }}</a></li>
														<li><a href="{{ url('petitions/'.$petition->id.'/report?why=3') }}" class="why3">{{ trans('petition.report.why3') }}</a></li>
													</ul>
											</li>
										</ul>
										<div class="separator"></div>
										
										<!-- COMMENTS -->
										@if( $petition->allow_comments == 1 ) 				
												<h3 class="title">{{ trans('petition.comments') }}...</h3>
												<!-- FB Commernts -->
												<div class="fb-comments" data-href="{{ url('petitions', [$petition->id]) }}" data-width="100%" data-numposts="5"></div>
												<!-- FB Commernts -->
												<!-- API facebook -->
												<div id="fb-root"></div>
												<script>(function(d, s, id) {
													var js, fjs = d.getElementsByTagName(s)[0];
													if (d.getElementById(id)) return;
													js = d.createElement(s); js.id = id;
													js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=850857928366026";
													fjs.parentNode.insertBefore(js, fjs);
												}(document, 'script', 'facebook-jssdk'));
												</script>
												<!-- API facebook -->		
										@endif
										
								</div>
							</aside>
							<!-- sidebar end -->
					</div>
					<hr>
				</div>
				<!-- main end -->

			</div>
		</div>
	</section>
	<!-- main-container end -->

	<!-- section start -->
	<!-- ================ -->
	<div class="section gray-bg clearfix">
		<div class="container">
			
					<h2 class="title">{{ trans('petition.status') }} {{ trans('layout.and') }} {{ trans('petition.targets') }}</h2>
					<div class="separator-2"></div>
					<p class="lead">{{ trans('petition.targets_text') }}.</p>
					<div class="row">
						<div class="col-md-6">
							<div class="row grid-space-10">
								<div class="col-sm-6">
									<div class="box-style-1 white-bg margin-top-clear">
										<h2 class="title">{{ trans('petition.targets') }}</h2>
										<i class="fa fa-briefcase"></i>
										<span class="stat-num">{{ ( !empty($petition->goal) )? $petition->goal:((int)$signatures+100) }}</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="box-style-1 white-bg margin-top-clear">
										<h2 class="title">{{ trans('sign.signatures') }}</h2>
										<i class="fa fa-users"></i>
										<span class="stat-num sign-count">{{ $signatures }}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h3>{{ trans('petition.shares') }}</h3>
							<div class="progress">
								<div class="progress-bar progress-bar-default" role="progressbar" data-animate-width="80%">
									<span class="object-non-visible" data-animation-effect="fadeInLeftBig" data-effect-delay="200">Facebook <div class="pluginCountTextDisconnected "></div></span>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar progress-bar-default" role="progressbar" data-animate-width="90%">
									<span class="object-non-visible" data-animation-effect="fadeInLeftBig" data-effect-delay="200">Twitter</span>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar progress-bar-default" role="progressbar" data-animate-width="75%">
									<span class="object-non-visible" data-animation-effect="fadeInLeftBig" data-effect-delay="200">Email</span>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar progress-bar-default" role="progressbar" data-animate-width="85%">
									<span class="object-non-visible" data-animation-effect="fadeInLeftBig" data-effect-delay="200">Link</span>
								</div>
							</div>
						</div>
					</div>
			
		</div>
	</div>
	<!-- section end -->

@endsection

@section('modal')
			<div class="modal-header">
					<h3>{{ trans('sign.signature') }} {{ $petition->title }}<h3>
			</div>
			<div class="modal-body">
					@include('petition::signature.signed', $petition)
			</div>
@endsection

@section('js')
		
		<script src="{{ asset('plugins/jquery.parallax-1.1.3.js') }}"></script>
		<!-- Isotope javascript -->
		<script type="text/javascript" src="{{ asset('plugins/isotope/isotope.pkgd.min.js') }}"></script>
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
						
		<script type="text/javascript" src="{{ asset('js/jquery.form.js') }}"></script>
						
@endsection
						
@section('script')
		verify_logged_signature('{{ $petition->id }}');				
						
		show_hide_signature_btn( getJsParam() );
		$(document).ready(function()
		{
				$('.btn-newtimeline').on('click', function(){
						$('.new-timeline').toggle('slow', function(){
								 $('.btn-newtimeline b').toggle('slow');
						});
						$('html, body').animate({scrollTop: $('.btn-newtimeline').offset().top-100	}, 2000);
				});

				$('.timeline-form').submit(function(e){
						$.ajax({
							 url: $(this).attr('action'),
							 type: 'POST',
							 data: $(this).closest('form').serialize(),
							 dataType:'json',
							 success: function(data) { 
										$('#status-timeline').html( data.message ).addClass('alert alert-info').delay(10000).fadeOut('slow');
										$('.timeline-form').resetForm(); 
										$('.btn-newtimeline').trigger('click');
							 },
							 error: function(data) {
										$('#status-timeline').html( data.message ).addClass('alert alert-danger').delay(15000).fadeOut('slow');
										$.each(data.error, function(index, value) {
												$('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
										});
										$('#status-timeline').addClass('alert alert-danger').html(data.message).fadeIn(200);
							 }
						});
						return false;
				});		
						
		});
						
@endsection
						