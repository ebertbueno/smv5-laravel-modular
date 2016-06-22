@extends( Config::get('themes.frontend') )

@section('content')
<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
							<div class="form-block center-block">
								<h2 class="title">{{ trans('layout.login') }}</h2>
								<hr>
								<form class="form-horizontal" method="POST" action="/auth/login">
                   {!! csrf_field() !!}

									@if (count($errors) > 0)
										<div class="alert alert-info">
												@foreach ($errors->all() as $error)
														<p>{{ $error }}</p>
												@endforeach
										</div>
										<br>
								  @endif
						
									<div class="form-group has-feedback">
										<label for="inputUserName" class="col-sm-3 control-label">{{ trans('layout.username') }}</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="inputUserName" placeholder="{{ trans('layout.username') }}" required name="email" value="{{ old('email') }}">
											<i class="fa fa-user form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">{{ trans('layout.password') }}</label>
										<div class="col-sm-8">
											<input type="password" class="form-control" id="inputPassword" placeholder="{{ trans('layout.password') }}" required name="password">
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-8">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="remember"> {{ trans('layout.remember') }}
												</label>
											</div>
											
											<button type="submit" class="btn btn-group btn-default btn-sm ">{{ trans('layout.login') }}</button>
											<ul>
												<li><a href="#">{{ trans('layout.forgot_pass') }}</a></li>
											</ul>
											<span class="text-center text-muted">{{ trans('layout.login_with') }}</span>
											<ul class="social-links colored circle clearfix">
												<li class="facebook"><a target="_blank" href="/auth/facebook"><i class="fa fa-facebook"></i></a></li>
											</ul>
										</div>
									</div>
								</form>
							</div>
							<p class="text-center space-top">{{ trans('layout.no_account_yet') }} <a href="/auth/register">{{ trans('layout.sign_up2') }}</a></p>
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->

@endsection

@section('js')

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>

@endsection