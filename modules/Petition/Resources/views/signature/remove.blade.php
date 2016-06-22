@extends( Config::get('themes.frontend') )

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
	@if ($errors->any())
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	@endif<!-- section start -->
			<!-- ================ -->
			{!! Form::open(array('url' => 'signature/sendlink', 'method' => 'post', 'class'=>'form-horizontal remove-signature-form')) !!}

<div class="col-md-12">
						<div class="status"></div>
						<div class="form-group">
								{!! Form::label('', trans('sign.remove').' '.$petition->title) !!}
						</div>
						<div class="form-group">
								{!! Form::label('email', trans('layout.email').'*') !!}
								{!! Form::text('email', null, ['class'=>'form-control'] ) !!}
						</div>
						<div class="form-group">
								{!! Form::label(' ', '') !!}
								<p>O EuConcordo.com usará este email para lhe avisar do andamento desta petição. Você poderá cancelar o recebimento a qualquer momento através de nossos sistema de newsletter.</p>
						</div>
						
						<div class="form-group">
							{!! Form::label(' ', '') !!}
							<div class="col-md-12">
								{!! Form::hidden('petition_id', $petition->id ) !!}
								<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('layout.delete') }}</button>
								<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('layout.close') }}</button>
							</div>
						</div>
</div>
<div class="clearfix"></div>
			{!! Form::close() !!}
        

				</div>
			</div>
			<!-- section end -->
@endsection

@section('script')
	


@endsection