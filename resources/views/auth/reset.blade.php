@extends( Config::get('themes.frontend') )

@section('content')
<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- resources/views/auth/reset.blade.php -->
						<h3 class="text-center">{{ trans('auth.sendreset.title') }}</h3>

						<form method="POST" action="/password/reset" class="form-horizontal col-md-6 col-md-offset-3">
								{!! csrf_field() !!}
								<input type="hidden" name="token" value="{{ $token }}">

								@if (count($errors) > 0)
										<ul>
												@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
												@endforeach
										</ul>
								@endif

								<div class="form-group">
										{!! Form::label('email', trans('layout.email').'*') !!}
										<input type="email" name="email" value="{{ old('email') }}" class="form-control">
								</div>

								<div class="form-group">
										{!! Form::label('password', trans('layout.password')) !!}
										<input type="password" name="password"  class="form-control">
								</div>

								<div class="form-group">
										{!! Form::label('password_confirmation', trans('layout.confirmation').' '.trans('layout.password')) !!}
										<input type="password" name="password_confirmation"  class="form-control">
								</div>

								<div class="form-group">
										<button type="submit" class="btn btn-success">
												{{ trans('profile.resetpass') }}
										</button>
								</div>
						</form>

					</div>
				</div>
			</section>
			<!-- main-container end -->

@endsection

@section('js')

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>

@endsection