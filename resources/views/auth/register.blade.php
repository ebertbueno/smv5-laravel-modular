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
								<h2 class="title">{{ trans('auth.sign_up') }}</h2>
								<hr>
								</div>
								<!-- main-container end -->
								{!! Form::open(array('url' => 'auth/register', 'class'=>'form-horizontal', 'method'=>'post')) !!}
									<div class="form-group has-feedback">
										<label for="inputName" class="col-sm-3 control-label">{{ trans('auth.firstname') }}<span class="text-danger small">*</span></label>
										<div class="col-sm-6">
											{!! Form::text('name', null, ['class'=>'form-control'] ) !!}
											<i class="fa fa-pencil form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputLastName" class="col-sm-3 control-label">{{ trans('auth.lastname') }}<span class="text-danger small">*</span></label>
										<div class="col-sm-6">
											{!! Form::text('last_name', null, ['class'=>'form-control'] ) !!}
											<i class="fa fa-pencil form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputEmail" class="col-sm-3 control-label">{{ trans('auth.email') }} ({{ trans('auth.username') }})<span class="text-danger small">*</span></label>
										<div class="col-sm-6">
											{!! Form::text('email', null, ['class'=>'form-control']) !!}
											<i class="fa fa-envelope form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">{{ trans('auth.password') }}<span class="text-danger small">*</span></label>
										<div class="col-sm-6">
											{!! Form::password('password', ['class'=>'form-control']) !!}
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="inputPassword" class="col-sm-3 control-label">{{ trans('auth.confirmation') }} {{ trans('auth.password') }}<span class="text-danger small">*</span></label>
										<div class="col-sm-6">
											{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
											<i class="fa fa-lock form-control-feedback"></i>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
											<div class="checkbox">
												<label>
													<input type="checkbox" required>{{ trans('auth.accept') }} <a href="#">{{ trans('auth.police_terms') }}</a> {{ trans('auth.and') }} <a href="#">{{ trans('auth.police_private') }}</a>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
											<button type="submit" class="btn btn-default">{{ trans('auth.sign_up') }}</button>
										</div>
									</div>
								{!! Form::close() !!}
							</div>
						</div>
						<!-- main end -->

					</div>
				</div>
			</section>
	@if ($errors->any())
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	@endif
        
@endsection

@section('js')

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>

@endsection