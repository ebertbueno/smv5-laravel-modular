@extends( Config::get('themes.frontend') )

@section('content')
<!-- main-container start -->
<!-- ================ -->
<section class="container">
		<div class="row">

			<!-- main start -->
			<!-- ================ -->
				<div class="col-md-6 col-md-offset-3">
					<h2 class="title text-center">{{ trans('auth.login') }}</h2>
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
							<label for="inputUserName" class="col-sm-3 control-label">{{ trans('auth.username') }}</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputUserName" placeholder="{{ trans('auth.username') }}" required name="email" value="{{ old('email') }}">
								<i class="fa fa-user form-control-feedback"></i>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label for="inputPassword" class="col-sm-3 control-label">{{ trans('auth.password') }}</label>
							<div class="col-sm-8">
								<input type="password" class="form-control" id="inputPassword" placeholder="{{ trans('auth.password') }}" required name="password">
								<i class="fa fa-lock form-control-feedback"></i>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-8">
								<div class="checkbox col-sm-4">
									<label>
										<input type="checkbox" name="remember"> {{ trans('auth.remember') }}
									</label>
								</div>
								<div class="col-sm-8">
									<ul>
										<li><a href="{{ url('password/email') }}">{{ trans('auth.forgot_pass') }}</a></li>
									</ul>
								</div>
								<button type="submit" class="btn btn-group btn-default btn-sm ">{{ trans('auth.login') }}</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-8">
								<span class="text-center text-muted">{{ trans('auth.login_with') }}</span>
								<ul class="social-links colored circle clearfix">
									<li class="facebook"><a target="_blank" href="/auth/facebook"><i class="fa fa-facebook"></i></a></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
				<p class="text-center space-top">{{ trans('auth.no_account_yet') }} <a href="/auth/register">{{ trans('auth.sign_up2') }}</a></p>
			<!-- main end -->

	</div>
</section>
<!-- main-container end -->

@endsection

@section('js')

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>

@endsection