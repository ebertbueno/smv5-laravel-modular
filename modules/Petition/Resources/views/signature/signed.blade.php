<!-- section start -->
			<!-- ================ -->
			{!! Form::open(array('route' => 'signature..store', 'method' => 'post', 'class'=>'form-horizontal signature-form')) !!}

<div class="col-md-12">
						<div class="status"></div>
						<div class="form-group">
								{!! Form::label('name', trans('profile.name').'*', ['class'=>'col-md-12']) !!}
								
									<div class="col-md-6">
										{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>trans('profile.name')] ) !!}
									</div>	
									<div class="col-md-6">
										{!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>trans('profile.lastname')] ) !!}
								</div>
						</div>
						<div class="form-group">
								{!! Form::label('name', trans('profile.name').'*', ['class'=>'col-md-12']) !!}
									<div class="col-md-6">
										{!! Form::text('country', null, ['class'=>'form-control', 'placeholder'=>trans('profile.country'), 'id'=>'country'] ) !!}
									</div>	
									<div class="col-md-6">
										{!! Form::text('city', null, ['class'=>'form-control', 'placeholder'=>trans('profile.city'), 'id'=>'administrative_area_level_1'] ) !!}
								</div>
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
								{!! Form::label('visibility', 'Visibilidade') !!}
								{!! Form::select('email_visibility', [0=>'Privado', 1=>'Apenas para o criador do abaixo-assinado', 2=>'Publico'], 1, ['class'=>'form-control'] ) !!}
						</div>
						
						<div class="form-group">
							{!! Form::label(' ', '') !!}
							<div class="col-md-12">
								{!! Form::hidden('petition_id', $petition->id ) !!}
								<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('sign.signature') }}</button>
								<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('layout.close') }}</button>
							</div>
						</div>
</div>
<div class="clearfix"></div>
			{!! Form::close() !!}
