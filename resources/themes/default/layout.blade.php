<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
	
<!-- Mirrored from htmlcoder.me/preview/idea/v.1.3/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Nov 2015 22:30:09 GMT -->
<head>
		<meta charset="utf-8">
		<title>Eu Concordo | @yield('title')</title>
		<meta name="description" content="">
		<meta name="author" content="htmlcoder.html">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<meta property="fb:app_id" content="{{ Config::get('facebook.client_id') }}" />
		<!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
		<!-- Bootstrap core CSS -->
		<link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link href="{{ asset('fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
		<!-- Fontello CSS -->
		<link href="{{ asset('fonts/fontello/css/fontello.css') }}" rel="stylesheet">
		<!-- Plugins -->
		<link href="{{ asset('plugins/rs-plugin/css/settings.css') }}" media="screen" rel="stylesheet">
		<link href="{{ asset('plugins/rs-plugin/css/extralayers.css') }}" media="screen" rel="stylesheet">
		<link href="{{ asset('plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
		<link href="{{ asset('css/animations.css') }}" rel="stylesheet">
		<link href="{{ asset('plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
	
		@yield('css')
		<!-- iDea core CSS file -->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<!-- Custom css -->
		<link href="{{ asset('css/light-blue.css') }}" rel="stylesheet">
		<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<!-- body classes: 
			"boxed": boxed layout mode e.g. <body class="boxed">
			"pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> 
	-->
	<body class="front no-trans">
		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">

			<!-- header-top start (Add "dark" class to .header-top in order to enable dark header-top e.g <div class="header-top dark">) -->
			<!-- ================ -->
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-xs-2 col-sm-6">

							<!-- header-top-first start -->
							<!-- ================ -->
							<div class="header-top-first clearfix">
								<ul class="social-links clearfix hidden-xs">
									<li class="twitter"><a target="_blank" href="https://twitter.com/EuConcordo"><i class="fa fa-twitter"></i></a></li>
									<li class="facebook"><a target="_blank" href="https://www.facebook.com/EuConcordoCom"><i class="fa fa-facebook"></i></a></li>
									<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
									<li class="linkedin"><a href="{{ url('contact') }}"><i class="fa fa-envelope-o"></i></a></li>
									<!--<li class="skype"><a target="_blank" href="http://www.skype.com/"><i class="fa fa-skype"></i></a></li>
									<li class="googleplus"><a target="_blank" href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
									<li class="flickr"><a target="_blank" href="http://www.flickr.com/"><i class="fa fa-flickr"></i></a></li>
									<li class="pinterest"><a target="_blank" href="http://www.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>-->
								</ul>
								<div class="social-links hidden-lg hidden-md hidden-sm">
									<div class="btn-group dropdown">
										<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
										<ul class="dropdown-menu dropdown-animation">
												<li class="twitter"><a target="_blank" href="https://twitter.com/EuConcordo"><i class="fa fa-twitter"></i></a></li>
												<li class="facebook"><a target="_blank" href="https://www.facebook.com/EuConcordoCom"><i class="fa fa-facebook"></i></a></li>
												<li class="linkedin"><a href="{{ url('contact') }}"><i class="fa fa-envelope-o"></i></a></li>
												<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- header-top-first end -->
						</div>
						<div class="col-xs-10 col-sm-6">
							<!-- header-top-second start -->
							<!-- ================ -->
							<div id="header-top-second"  class="clearfix">
								<!-- header top dropdowns start -->
								<!-- ================ -->
								<div class="header-top-dropdown">
									<div class="btn-group dropdown">
										<button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
												<i class="fa fa-search"></i> {{ trans('layout.search') }}
										</button>
										<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
											<li>
												<form role="search" class="search-box" action="{{ url('search') }}">
													<div class="form-group has-feedback">
														<input type="text" class="form-control" placeholder="Buscar" title="Tecle enter para enviar" >
														<i class="fa fa-search form-control-feedback"></i>
													</div>
												</form>
											</li>
										</ul>
									</div>
									<div class="btn-group dropdown">

										        @if( Auth::check() )
										            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
																		<i class="fa fa-user"></i> {{ trans('layout.logged_with') }} {{ Auth::user()->name }}</button>
																<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
																	<li>
																		
																			<ul>
																				<!--<li><a href="{{ url('user/config') }}" class="">{{ trans('layout.setting') }}</a></li>-->
																				<li><a href="{{ url('user/'.Auth::user()->id) }}" class="">{{ trans('layout.profile') }}</a></li>
																				<li>	<a href="{{ url('auth/logout') }}" class="">{{ trans('layout.logout') }}</a></li>
																			</ul>
																				
																			<div class="divider"></div>
																			<ul class="social-links clearfix">
																					<li class="twitter"><a target="_blank" href="https://twitter.com/EuConcordo"><i class="fa fa-twitter"></i></a></li>
																					<li class="facebook"><a target="_blank" href="https://www.facebook.com/EuConcordoCom"><i class="fa fa-facebook"></i></a></li>
																					<li class="youtube"><a target="_blank" href="http://www.youtube.com/"><i class="fa fa-youtube-play"></i></a></li>
																					<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
																			</ul>
																	</li>
																</ul>
										        @else

													<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ trans('layout.login') }}</button>
													<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
														<li>
															{!! Form::open(array('url' => 'auth/login', 'method' => 'post', 'class'=>'login-form')) !!}
																<div class="form-group has-feedback">
																	<label class="control-label">{{ trans('layout.username') }}</label>
																	<input name="email" type="text" class="form-control" placeholder="{{ trans('layout.username') }}" required>
																	<i class="fa fa-user form-control-feedback"></i>
																</div>
																<div class="form-group has-feedback">
																	<label class="control-label">{{ trans('layout.password') }}</label>
																	<input name="password" type="password" class="form-control" placeholder="{{ trans('layout.password') }}" required>
																	<i class="fa fa-lock form-control-feedback"></i>
																</div>
																<div class="form-group has-feedback">
																	<label class="control-label">
																		<input type="checkbox" name="remember"> {{ trans('layout.remember') }}
																	</label>
																</div>
																<div>
																	<button type="submit" class="btn btn-group btn-dark btn-sm">{{ trans('layout.login') }}</button>
																	<span> - </span>
																	<a  href="{{ url('auth/register') }}" class="btn btn-group btn-default btn-sm">{{ trans('layout.sign_up') }}</a>
																</div>
																<ul>
																	<li><a href="{{ url('password/email') }}">{{ trans('layout.forgot_pass') }}</a></li>
																</ul>
																<div class="divider"></div>
																<span class="text-center">{{ trans('layout.login_with') }}</span>
																<ul class="social-links clearfix">
																	<li class="facebook"><a href="{{ url('auth/facebook') }}"><i class="fa fa-facebook"></i></a></li>
																	<!--<li class="twitter"><a target="_blank" href="http://www.twitter.com/"><i class="fa fa-twitter"></i></a></li>
																	<li class="googleplus"><a target="_blank" href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>-->
																</ul>
															</form>
														</li>
													</ul>
												@endif
									</div>
								</div>
								<!--  header top dropdowns end -->

							</div>
							<!-- header-top-second end -->

						</div>
					</div>
				</div>
			</div>
			<!-- header-top end -->

<!-- header start classes:
	fixed: fixed navigation mode (sticky menu) e.g. <header class="header fixed clearfix">
	 dark: dark header version e.g. <header class="header dark clearfix">
================ -->
			<header class="header fixed clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<!-- header-left start -->
							<!-- ================ -->
							<div class="header-left clearfix">
								<!-- logo -->
								<div class="logo">
									<a href="/"><img src="{{ asset('images/logo-sm.png') }}" class="img-responsive" alt="iDea"></a>
								</div>
								<!-- name-and-slogan
								<div class="site-slogan">
									Clean &amp; Powerful Bootstrap Theme
								</div>
								 -->
							</div>
							<!-- header-left end -->
						</div>
						<div class="col-md-9">

							<!-- header-right start -->
							<!-- ================ -->
							<div class="header-right clearfix">

								<!-- main-navigation start -->
								<!-- ================ -->
								<div class="main-navigation animated">

									<!-- navbar start -->
									<!-- ================ -->
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">

											<!-- Toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
											</div>

											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse" id="navbar-collapse-1">

												<ul class="nav navbar-nav navbar-right">
										                {!! Menu::render('frontend') !!}
												</ul>

											</div>

										</div>
									</nav>
									<!-- navbar end -->

								</div>
								<!-- main-navigation end -->

							</div>
							<!-- header-right end -->

						</div>
					</div>
				</div>
			</header>
<!-- header end -->
	
<!--############# -->
<!-- ALERTAS -->
		@if( session()->get('message') )
			@include('default.theme.alert')
		@endif
<!--############# -->
<!--############# -->
	
<!--############# -->
<!-- CONTENT -->
<!--############# -->
                @yield('content')
<!--############# -->
<!-- END CONTENT -->
<!--############# -->
			
<!--############# -->
<!-- CITAÇÕES  -->
			<!-- ================ -->
			<div class="section gray-bg text-muted footer-top clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							{{ trans('layout.we_appers') }}
							<div class="owl-carousel clients">
								
								<div class="client">
									<a href="https://www.facebook.com/EuConcordoCom/photos/a.327795253990019.1073741825.244360035666875/327795257323352/?type=1&theater">
										<img src="{{ asset('images/logo_superint.png') }}" alt=""></a>
								</div>
								<div class="client">
									<a href="http://blogdobg.com.br/impeachment-de-dilma-rousseff-ja-soma-quase-15-milhao-de-adesoes/"><img src="{{ asset('images/logo-blog.svg') }}" alt=""></a>
								</div>
								<div class="client">
									<a href="http://www.cfcvirtual.com.br/site/detalhes_noticia.php?codigo=50">
										<img src="{{ asset('images/cfc.png') }}" alt=""></a>
								</div>
								<div class="client">
									<a href="http://www.metrojornal.com.br/nacional/claudio-humberto/exercito-ignora-mpf-e-se-sujeita-a-acao-judicial-157931">
										<img src="{{ asset('images/metro.png') }}" alt=""></a>
								</div>
								<div class="client">
									<a href="http://www.diariodopoder.com.br/noticia.php?i=25120548070">
										<img src="{{ asset('images/diario_poder.png') }}" alt=""></a>
								</div>
								<div class="client">
									<a href="http://anoticia.clicrbs.com.br/sc/geral/an-jaragua/noticia/2014/02/abaixo-assinado-busca-atendimento-24-horas-na-delegacia-da-mulher-em-jaragua-do-sul-4419753.html">
										<img src="{{ asset('images/anoticia.png') }}" alt=""></a>
								</div>
							
							</div>
						</div>
						<div class="col-md-6">
							<blockquote class="inline">
								<p class="margin-clear">{{ trans('layout.testemonial') }}</p>	
								<footer><cite title="Source Title">Wilton Lazarotto </cite></footer>
							</blockquote>
						</div>
					</div>
				</div>
			</div>
<!-- section end -->
<!-- ########### -->

<!-- footer start (Add "light" class to #footer in order to enable light footer) -->
<!-- ================ -->
			<footer id="footer">
				<!-- .footer start -->
				<!-- ================ -->
				<div class="footer">
					<div class="container">
						<div class="row">
							<!-- SOBRE -->
							<div class="col-md-6">
								<div class="footer-content">
									<div class="logo-footer">
										<img id="logo-footer" src="{{ asset('images/logo.png') }}" alt=""></div>
									<div class="row">
										<div class="col-sm-6">
											<p>Lorem ipsum dolor sit amet, consect tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ven.</p>
											<ul class="social-links circle">
												<li class="twitter"><a target="_blank" href="https://twitter.com/EuConcordo"><i class="fa fa-twitter"></i></a></li>
												<li class="facebook"><a target="_blank" href="https://www.facebook.com/EuConcordoCom"><i class="fa fa-facebook"></i></a></li>
												<li class="linkedin" title="contact form"><a href="{{ url('contact') }}"><i class="fa fa-envelope-o"></i></a></li>
												<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
											</ul>
											<small>{{ trans('layout.copyright') }}</small>
										</div>
										<div class="col-sm-6">
											<ul class="list-icons">
												<li><i class="fa fa-map-marker pr-10"></i> São Paulo/SP</li>
												<li><i class="fa fa-envelope-o pr-10"></i> info@euconcordo.com</li>
												<div class="separator-2"></div>
											</ul>
										</div>
									</div>
										
										 
										 
								</div>
							</div>
							<!-- PARCEIROS -->
							<div class="space-bottom hidden-lg hidden-xs"></div>
							<div class="col-sm-6 col-md-3">
								<div class="footer-content">
									<h3>{{ trans('layout.tweets') }}</h3>
									<a class="twitter-timeline" href="https://twitter.com/euconcordo" data-widget-id="709739199352709121">Tweets by @euconcordo</a>
									</div>
							</div>
							<!-- STATUS REDES SOCIAIS -->
							<div class="col-sm-6 col-md-3">
								<div class="footer-content">
										<h3>{{ trans('layout.fb_likes') }}</h3>
										<div id="fb-root"></div>
										<script>(function(d, s, id) {
											var js, fjs = d.getElementsByTagName(s)[0];
											if (d.getElementById(id)) return;
											js = d.createElement(s); js.id = id;
											js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=850857928366026";
											fjs.parentNode.insertBefore(js, fjs);
										}(document, 'script', 'facebook-jssdk'));</script>
										<div class="fb-page" data-href="https://www.facebook.com/EuConcordoCom" data-tabs="timeline" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/EuConcordoCom"><a href="https://www.facebook.com/EuConcordoCom">EuConcordo.com</a></blockquote></div></div>
									
								</div>
							</div>
						</div>
						<div class="space-bottom hidden-lg hidden-xs"></div>
					</div>
				</div>
				<!-- .footer end -->
			</footer>
			<!-- footer end -->

		</div>
		<!-- page-wrapper end -->

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					@section('modal')
					<p>Vazio</pp>
					@show
				</div>
			</div>
		</div>
		
		<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="{{ asset('plugins/jquery.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
		<!-- Modernizr javascript -->
		<script type="text/javascript" src="{{ asset('plugins/modernizr.js') }}"></script>
		
		@yield('js')
		<!-- Appear javascript -->
		<script type="text/javascript" src="{{ asset('plugins/jquery.appear.js') }}"></script>
		<!-- Count To javascript -->
		<script type="text/javascript" src="{{ asset('plugins/jquery.countTo.js') }}"></script>
		<!-- SmoothScroll javascript -->
		<script type="text/javascript" src="{{ asset('plugins/jquery.browser.js') }}"></script>
		<script type="text/javascript" src="{{ asset('plugins/SmoothScroll.js') }}"></script>
		<!-- image fill  -->
		<script type="text/javascript" src="{{ asset('js/jquery.imagesloaded.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery-imagefill.js') }}"></script>
		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="{{ asset('js/template.js') }}"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
									
		<script>
		@yield('script')
		</script>
		
	</body>

<!-- Mirrored from htmlcoder.me/preview/idea/v.1.3/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Nov 2015 22:35:36 GMT -->
</html>
