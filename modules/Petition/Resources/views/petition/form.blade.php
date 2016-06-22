@extends( Config::get('themes.backend') )

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
	@if ($errors->any())
		<ul>
			{!! implode('', $errors->all('<li class="error">:message</li>')) !!}
		</ul>
	@endif
	
	@if( Request::segment(2) == 'create' )
		{!! Form::model($petition, array('route' => 'petition..store', 'method' => 'post', 'class'=>'form-horizontal', 'files'=>true)) !!}
	@elseif( Request::segment(3) == 'edit' )
		{!! Form::model($petition, array('route' => ['petition..update', $petition->id], 'method' => 'PATCH', 'class'=>'form-horizontal', 'files'=>true)) !!}					
	@endif
							<h2 class="text-center">{{ trans('petition.new_petition') }}</h2>
							<!-- pills start -->
							<div class="process">
								<!-- Nav tabs -->
								<ul class="nav nav-pills white space-top new-petition" role="tablist">
									<li class="active"><a href="#pill-pr-1" role="tab" data-toggle="tab" title="Step 1">
											<i class="fa fa-dot-circle-o pr-5"></i> {{ trans('petition.claim') }}</a></li>
									<li><a href="#pill-pr-2" role="tab" data-toggle="tab" title="Step 2">
											<i class="fa fa-dot-circle-o pr-5"></i> {{ trans('petition.target') }}</a></li>
									<li><a href="#pill-pr-3" role="tab" data-toggle="tab" title="Step 3">
											<i class="fa fa-dot-circle-o pr-5"></i> {{ trans('petition.disclosure') }}</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content clear-style">
									
									<div class="tab-pane active" id="pill-pr-1">
											<h3 class="text-center">{{ trans('petition.s1_header') }}</h3>
											<div class="space-top"></div>
											<div class="form-group">
													{!! Form::label('title', '*'.trans('petition.s1_title'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::text('title', null, ['class'=>'form-control required'] ) !!}
													</div>
											</div>
											<div class="form-group">
													{!! Form::label('declaration', '*'.trans('petition.s1_declaration'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::textarea('declaration', null, ['class'=>'form-control required'] ) !!}
													</div>
											</div>	
											<div class="form-group">
													{!! Form::label(' ', '', ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														<a href="#" class="btn btn-light-gray btn-sm next1">{{ trans('petition.next') }} <i class="fa fa-chevron-right pl-10"></i></a>
													</div>
											</div>
									</div>
									
									<div class="tab-pane" id="pill-pr-2">
											<h3 class="text-center">{{ trans('petition.s2_header') }}</h3>
											<div class="space-top"></div>
											<div class="form-group">
													{!! Form::label('sender', '*'.trans('petition.s2_sender'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::text('sender', null, ['class'=>'form-control required'] ) !!}
													</div>
											</div>
											<div class="form-group">
													{!! Form::label('receiver', '*'.trans('petition.s2_receiver required'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::text('receiver', null, ['class'=>'form-control required'] ) !!}
													</div>
											</div>
											<div class="form-group">
													{!! Form::label(' ', '', ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														<a href="#" class="btn btn-light-gray btn-sm next2">{{ trans('petition.next') }} <i class="fa fa-chevron-right pl-10"></i></a>
													</div>
											</div>
									</div>
									
									<div class="tab-pane" id="pill-pr-3">
											<h3 class="text-center">{{ trans('petition.s3_header') }}</h3>
											<div class="space-top"></div>
										@if( !empty($petition->image) )
											<div class="form-group">
													{!! Form::label('', '', ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														<img src="{{ url('uploads/'.$petition->image ) }}" style="height:80px; width:auto">
													</div>
											</div>
												
										@endif
											<div class="form-group">
													{!! Form::label('image', trans('petition.s3_image'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::file('image', null, ['class'=>'form-control'] ) !!}
													</div>
											</div>
											<div class="form-group">
													{!! Form::label('category', '*'.trans('petition.s3_category'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::select('category_id', $categories, null, ['placeholder' => 'Select...', 'class'=>'form-control required'] ) !!}
													</div>
											</div>
											<div class="form-group">
													{!! Form::label('address', trans('petition.s3_address'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::text('address', null, ['class'=>'form-control'] ) !!}
													</div>
											</div>
											<div class="form-group">
													{!! Form::label('tags', trans('petition.s3_tags'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::text('tags', null, ['class'=>'form-control'] ) !!}
													</div>
											</div>	
											<div class="form-group">
													{!! Form::label('goal', trans('petition.s3_goal'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														{!! Form::number('goal', null, ['class'=>'form-control'] ) !!}
													</div>
											</div>	
											<div class="form-group">
													{!! Form::label('allow_comments', trans('petition.s3_allow_comments'), ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														<label class="col-md-3">{{ trans('layout.yes') }} {!! Form::radio('allow_comments', 1, true) !!}</label>
														<label class="col-md-3">{{ trans('layout.no') }} {!! Form::radio('allow_comments', 0) !!}</label>
													</div>
											</div>
											<div class="form-group">
													{!! Form::label(' ', '', ['class'=>'control-label col-md-4']) !!}
													<div class="col-md-6">
														<button type="submit" class="btn btn-default btn-sm submit">{{ trans('petition.s3_submit') }} <i class="fa fa-chevron-right pl-10"></i></button>
													</div>
											</div>
									</div>
								</div>
							</div>
							<!-- pills end -->

	{!! Form::close() !!}
        

				</div>
			</div>
			<!-- section end -->
@endsection

@section('js')
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>
@endsection

@section('script')
	
	$('.next1').on('click', function()
	{
			var flag = true;
			$.each( $('#pill-pr-1 .required'), function()
			{
					if( $(this).val().length < 5 )
					{
							alert( '{!! trans('validation.required') !!}'.replace(':attribute', $(this).attr('name') ) );
							flag = false;
							return false;
					}
			});		
			if( flag == true )
			{
					$('.new-petition a[href="#pill-pr-2"]').trigger('click');
			}
	});
	$('.next2').on('click', function()
	{
			var flag = true;
			$.each( $('#pill-pr-2 .required'), function()
			{
					if( $(this).val().length < 5 )
					{
							alert( '{!! trans('validation.required') !!}'.replace(':attribute', $(this).attr('name') )  );
							flag = false;
							return false;
					}
			});		
			if( flag == true )
			{
					$('.new-petition a[href="#pill-pr-3"]').trigger('click');
			}
	});

@endsection