@extends( Config::get('themes.frontend') )

@section('title', 'Home')

@section('content')

			@include('site.slideshow', ['petitions'=>$featured] )			

			<!-- page-top start-->
			<!-- ================ -->
			<div class="page-top">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="call-to-action">
								<h1 class="title">{{ trans('home.sec2_title') }} </h1>
								<p>{{ trans('home.sec2_msg') }}</p>
								<a href="./petition/create" class="btn btn-default contact">{{ trans('home.sec2_new_petition') }} <i class="pl-10 fa fa-file-text-o"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- page-top end -->

			<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">

				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2>{{ trans('layout.find_yours') }}</h2>
							<div class="separator-2"></div>
							<p>{{ trans('home.sec3_make_diff') }} </p>
								
								<div class="tabs-style-2">
													<!-- Nav tabs -->
										<ul class="nav nav-tabs" role="tablist">
														<li class="active">
															<a href="#h2tab1" role="tab" data-toggle="tab" aria-expanded="false">
																<i class="fa fa-star pr-5"></i> {{ trans('layout.featured') }}</a></li>
														<li class=""><a href="#h2tab2" role="tab" data-toggle="tab" aria-expanded="false">
															<i class="fa fa-sitemap pr-5"></i> {{ trans('layout.per_category') }}</a></li>
														<li class=""><a href="#h2tab3" role="tab" data-toggle="tab" aria-expanded="true">
															<i class="fa fa-calendar pr-5"></i> {{ trans('petition.new_petitions') }}</a></li>
													</ul>
													<!-- Tab panes -->
										<div class="tab-content">
												<div class="tab-pane fade active in" id="h2tab1">
													<h1 class="text-center title">{{ trans('layout.featured') }}</h1>
													<div class="space-bottom"></div>
													<div class="col-md-12">
															@include('site.petition_slider', $petitions)
													</div>
												</div>
												<div class="tab-pane fade" id="h2tab2">
													  <h1 class="text-center title">
																{{ trans('layout.per_category') }} 
																{!! Form::select('petition_category', $categories, 1, ['class'=>'pull-left input-sm input-categories']) !!}
														</h1>
														<div class="space-bottom"></div>
														<div class="col-md-12 category-body">
														</div>
												</div>
												<div class="tab-pane fade" id="h2tab3">
													<h1 class="text-center title">{{ trans('petition.new_petitions') }}</h1>
													<div class="space-bottom"></div>
													<div class="col-md-12">
																@include('site.petition_slider', ['petitions'=>$featured] )
													</div>
												</div>
										</div>
								</div>
								<!-- section end -->
						</div>
					</div>
				</div>
			</div>
			<!-- section end -->

			<!-- section start -->
			<!-- ================ -->
			<div class="section parallax light-translucent-bg parallax-bg-3">
				<div class="container">
					<div class="call-to-action">
						<div class="row">
							<div class="col-md-8">
								<h1 class="title text-center">{{ trans('home.sec4_not_find') }}</h1>
								<p class="text-center">{{ trans('home.sec4_not_find_desc') }}</p>
							</div>
							<div class="col-md-4">
								<div class="text-center">
									<a href="#" class="btn btn-default btn-lg"><i class="fa fa-file-text-o"></i> {{ trans('petition.create_petition') }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section end -->

			<!-- section start -->
			<!-- ================ -->
			<div class="section gray-bg clearfix">
				<div class="owl-carousel content-slider">
					
					<div class="testimonial">
						<div class="container">
							<div class="row  ">
								<div class="col-md-8 col-md-offset-2">
									<h2 class="title">Just Perfect!</h2>
									<div class="testimonial-image">
										<img src="images/testimonial-1.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle  img-responsive">
									</div>
									<div class="testimonial-body">
										<p>Sed ut perspiciatis unde omnis iste natu error sit voluptatem accusan tium dolore laud antium,  totam rem dolor sit amet tristique pulvinar, turpis arcu rutrum nunc, ac laoreet turpis augue a justo.</p>
										<div class="testimonial-info-1">- Jane Doe</div>
										<div class="testimonial-info-2">By Company</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="testimonial">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<h2 class="title">Wow amazing!</h2>
									<div class="testimonial-image">
										<img src="images/testimonial-2.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle img-responsive">
									</div>
									<div class="testimonial-body">
										<p>Turpis arcu rutrum nunc, ac laoreet turpis augue a justo. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, esse, animi maxime voluptate tempore at sunt labore incidunt nulla dignissimos iusto ad similique inventore distinctio quam repellendus itaque minus minima.</p>
										<div class="testimonial-info-1">- John Doe</div>
										<div class="testimonial-info-2">By Company</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="testimonial">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<h2 class="title">Thanks!</h2>
									<div class="testimonial-image">
										<img src="images/testimonial-3.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle img-responsive">
									</div>
									<div class="testimonial-body">
										<p>Phosfluorescently e-enable adaptive synergy for strategic quality vectors. Continually transform fully tested expertise with competitive technologies ac laoreet turpis augue a justo.</p>
										<div class="testimonial-info-1">- John Doe</div>
										<div class="testimonial-info-2">By Company</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<!-- section end -->

@endsection

@section('js')
		
		<!-- jQuery REVOLUTION Slider  -->
		<script type="text/javascript" src="{{ asset('plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
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
	$(document).ready(function(){
			$('.input-categories').on('change', function(){
					$.get('{{ url('getPetitionsByCat') }}/'+$(this).val() , function(data)
					{
							$('.category-body').html(data);
							$(".category-body .owl-carousel.carousel").owlCarousel({
								items: 4,
								pagination: false,
								navigation: true,
								navigationText: false
							});
							$('.img-fill').imagefill();
					});
			});
			$('.input-categories').trigger('change');
	})
@endsection