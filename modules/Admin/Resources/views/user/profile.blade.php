@extends( Config::get('themes.backend') )

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
	
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-12">

							<!-- page-title start -->
							<!-- ================ -->
							<h1 class="page-title">{{ @$account->user->name }}</h1>
							<div class="separator-2"></div>
							<!-- page-title end -->
							
							<div class="row">
								<div class="col-lg-3 col-sm-3">
									<div class="box-style-1 gray-bg team-member">
										<div class="overlay-container">
											<img src="{{ ($account->avatar) ? (( !strpos($account->avatar,'http') ) ? asset('uploads/'.$account->avatar):$account->avatar ) : asset('images/team-member-2.jpg') }}" class="avatar" style="width:100%;height:auto" >
											<!--
											<div class="overlay">
												<ul class="social-links colored clearfix">
													<li class="facebook"><a target="_blank" href="http://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>	
													<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
													<li class="skype"><a target="_blank" href="http://www.skype.com/"><i class="fa fa-skype"></i></a></li>
													<li class="googleplus"><a target="_blank" href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
												</ul>
											</div>
											-->
										</div>
										<h3>
											<a href="#" data-toggle="modal" data-target="#myModal">{{ trans('profile.edit_avatar') }}</a>
										</h3>
									</div>
								</div>
								<div class="col-lg-5 col-sm-9">
									<div class="tabs-style-2">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs" role="tablist">
											<li class="active"><a href="#h2tab1" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-home pr-5"></i>{{ trans('profile.account') }}</a></li>
											<li class=""><a href="#h2tab2" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-user pr-5"></i>{{ trans('profile.changepass') }}</a></li>
										</ul>
										<!-- Tab panes -->
										<div class="tab-content">
											<div class="tab-pane fade active in" id="h2tab1">
													@if ($errors->any())
															<ul>
																{{ implode('', $errors->all('<li class="error">:message</li>')) }}
															</ul>
														@endif
													{!! Form::model($account, ['method' => 'PATCH', 'route' => ['admin.user.update', $account->user_id], 'class' => 'form-horizontal']) !!}
														<div class="form-group">
															{!! Form::label('name', trans('profile.name'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('name', $account->user->name, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('name', trans('profile.lastname'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('last_name', $account->user->last_name, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('phonenumber', trans('profile.phone'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('phonenumber', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('city', trans('profile.city'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('city', null, ['class'=>'form-control']) !!}
															</div>
														</div> 	
														<div class="form-group">
															{!! Form::label('zipcode', trans('profile.zipcode'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('zipcode', null, ['class'=>'form-control']) !!}
															</div>
														</div> 
														<div class="form-group">
															{!! Form::label('address', trans('profile.address'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('address', null, ['class'=>'form-control']) !!}
															</div>
														</div>  	
														<div class="form-group">
															{!! Form::label('address2', trans('profile.address2'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('address2', null, ['class'=>'form-control']) !!}
															</div>
														</div>  
														<div class="form-group">
															{!! Form::label('country', trans('profile.country'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('country', null, ['class'=>'form-control']) !!}
															</div>
														</div>    	
														<div class="form-group">
															{!! Form::label('birthdate', trans('profile.birthdate'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::date('birthdate', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
															</div>
														</div>   
														<div class="form-group">
															{!! Form::label('about', trans('profile.about'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('about', null, ['class'=>'form-control']) !!}
															</div>
														</div> 
														<div class="form-group">
															{!! Form::label('website', trans('profile.website'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::text('website', null, ['class'=>'form-control']) !!}
															</div>
														</div> 	<div class="form-group">
															{!! Form::label('', '', ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																<button type="submit" class="btn btn-success">{{ trans('layout.save') }}</button>
															</div>
														</div>   

														{!! Form::close() !!}
										
											</div>
											<div class="tab-pane fade" id="h2tab2">
													<div class="status-pass"></div>
													{!! Form::open(['method' => 'post', 'route' => ['admin.user.updatePass', $account->user_id], 'class' => 'form-horizontal pass-form']) !!}
														<div class="form-group">
															{!! Form::label('name', trans('profile.oldpass'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::password('old_password', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('name', trans('profile.newpass'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::password('password', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('phonenumber', trans('profile.confirmpass'), ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																{!! Form::password('password_confirmation', null, ['class'=>'form-control']) !!}
															</div>
														</div>
														<div class="form-group">
															{!! Form::label('', '', ['class'=>'col-md-4']) !!}
															<div class="col-md-8">
																	<button type="submit" class="btn btn-success btn-pass" name="btn-pass">{{ trans('layout.save') }}</button>
															</div>
														</div>
												{!! Form::close() !!}
											
											</div>
										</div>
									</div>
												
									
								</div>
								<div class="col-lg-4 col-md-12 col-sm-8 col-sm-offset-4 col-md-offset-0">
									<div class="vertical-divider-left-lg side">
										<h2 class="title">{{ trans('profile.contacts') }}</h2>
										<ul class="list-icons">
											<li><i class="fa fa-phone pr-5"></i>{{ $account->phonenumber }}</li>
											<li><i class="fa fa-transgender pr-5"></i>{{ trans('profile.'.$account->gender) }}</li>
											<li><i class="fa fa-envelope pr-5"></i><a href="mailto:{{ $account->user->email }}"><small>{{ $account->user->email }}</small></a></li>
										</ul>
										<!--
										<ul class="social-links colored clearfix">
											<li class="twitter"><a target="_blank" href="http://www.twitter.com/"><i class="fa fa-twitter"></i></a></li>
											<li class="skype"><a target="_blank" href="http://www.skype.com/"><i class="fa fa-skype"></i></a></li>
											<li class="facebook"><a target="_blank" href="http://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
											<li class="googleplus"><a target="_blank" href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
										</ul>
										-->
									</div>
								</div>
							</div>
							
						</div>
						<!-- main end -->

					</div>

				</div>
			</div>
			<!-- section end -->
@endsection

@section('modal')
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('profile.edit_avatar') }}<h4>
			</div>
			<div class="modal-body">
						<div class="progress">
								<div class="bar"></div >
								<div class="percent">0%</div >
						</div>
						<div id="status"></div>
				
						{!! Form::open( ['method' => 'PATCH', 'route' => ['admin.user.update', $account->user_id], 'files' => true, 'class'=>'avatar-form'] ) !!}
								<div class="form-group">
									{!! Form::label('', trans('profile.select_image'), ['class'=>'col-md-4']) !!}
									<div class="col-md-8">
										{!!	Form::file('avatar', ['class'=>'form-control']) !!}
									</div>
								</div>  	
								<div class="form-group">
									{!! Form::label('', '', ['class'=>'col-md-4']) !!}
									<div class="col-md-8">
											<button type="submit" class="btn btn-success btn-avatar" name="btn-avatar">{{ trans('layout.send') }}</button>
									</div>
								</div>  
						{!! Form::close() !!}
						<div class="clearfix"></div>
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
$(document).ready(function()
{
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');

	$('.avatar-form').ajaxForm(
	{
		resetForm: true,
		beforeSend: function() 
		{
					var percentVal = '0%';
					bar.width(percentVal)
					percent.html(percentVal);
					$('.helper-block').remove();
					status.html('').removeClass('alert alert-danger');
					status.html('').removeClass('alert alert-success');
					$('.btn-avatar').attr('disabled', true);
		},
		uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal)
					percent.html(percentVal);
		},
		success: function(xhr) 
		{
					var percentVal = '100%';
					bar.width(percentVal);
					percent.html(percentVal);
					status.addClass('alert alert-success').html(xhr.message).fadeIn(200);
					$('.btn-avatar').attr('disabled', false);
					$('.avatar').removeAttr('src').attr('src', xhr.avatar );
				  setTimeout(function() { $('#myModal').modal('hide'); }, 3000);
		},
		complete: function(xhr) 
		{
				var json = xhr;/*xhr.responseJSON*/;
				status.html( json.message );
		},
		error: function(data)
		{
				var json = data.responseJSON;
				$.each(json.error, function(index, value) {
						$('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
				});
				status.addClass('alert alert-danger').html(json.message).fadeIn(200);
				$('.btn-avatar').attr('disabled', false);	
		}
	}); 

	$('.pass-form').ajaxForm({ 
        dataType:  'json', 
				beforeSend: function() {
					$('.helper-block').remove();
					$('.status-pass').html('').removeClass('alert alert-danger');
					$('.status-pass').html('').removeClass('alert alert-success');
					$('.btn-pass').attr('disabled', true);
				},
        success:   function (json) { 
						$('.status-pass').addClass('alert alert-success').html(json.message).fadeIn(200);
						$('.btn-pass').attr('disabled', false);
						$(".pass-form")[0].reset();
				},
				statusCode: {
						412: function(data) {
								var json = data.responseJSON;
								$.each(json.error, function(index, value) {
										$('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
								});
								$('.status-pass').addClass('alert alert-danger').html(json.message).fadeIn(200);
								$('.btn-pass').attr('disabled', false);
						}
				}
  });
	
});

@endsection
