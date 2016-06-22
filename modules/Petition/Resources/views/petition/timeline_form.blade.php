
							@if ($errors->any())
								<ul>
									{!! implode('', $errors->all('<li class="error">:message</li>')) !!}
								</ul>
							@endif

{!! Form::open( array('url' => 'timeline', 'method' => 'post', 'class'=>'form-horizontal timeline-form') ) !!}
							
							<h2 class="text-center">{{ trans('petition.timeline.new') }}</h2>
							<!-- pills start -->
							<div class="space-top"></div>
							<div class="form-group">
									{!! Form::label('title', '*'.trans('petition.s1_title'), ['class'=>'control-label  col-md-4']) !!}
									<div class="col-md-6">
										{!! Form::text('title', null, ['class'=>'form-control', 'required'=>true] ) !!}
									</div>
							</div>
							<div class="form-group">
									{!! Form::label('content', '*'.trans('petition.timeline.content'), ['class'=>'control-label col-md-4']) !!}
									<div class="col-md-6">
										{!! Form::textarea('content', null, ['class'=>'form-control','rows'=>'3'] ) !!}
									</div>
							</div>	
							<div class="form-group">
									{!! Form::label('link', '*'.trans('petition.timeline.link'), ['class'=>'control-label col-md-4']) !!}
									<div class="col-md-6">
										{!! Form::text('link', null, ['class'=>'form-control required'] ) !!}
									</div>
							</div>
							<div class="form-group">
									{!! Form::label(' ', '', ['class'=>'control-label col-md-4']) !!}
									<div class="col-md-6">
										<input type="hidden" name="petition_id" value="{{ Request::segment(2) }}" />
										<button type="submit" class="btn btn-default btn-sm submit">{{ trans('petition.s3_submit') }} <i class="fa fa-chevron-right pl-10"></i></button>
									</div>
							</div>
			<!-- pills end -->

	{!! Form::close() !!}
        