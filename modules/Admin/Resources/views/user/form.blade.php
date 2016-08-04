<!-- section start -->
<!-- ================ -->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h3>Gerenciar Usuários </h3>
</div>
<div class="modal-body" ng-app="app">
	<div class="row" ng-controller="UserController">
		@{{ model }}

		@if( Request::is('admin/users/create') )
				{!! Form::model($user, array('route' => 'admin.users.store', 'method' => 'post', 'class'=>'form-horizontal','id'=>'formAjax' )) !!}
		@else
				{!! Form::model( $user, array('route' => ['admin.users.update', $user->id], 'method' => 'PATCH', 'class'=>'form-horizontal', 'id'=>'formAjax')) !!}
		@endif
					<div class="col-md-12">
						<div class="status"></div>
						<div class="form-group">
								<div class="col-md-6">
									{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.name')] ) !!}
								</div>	
								<div class="col-md-6">
									{!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.lastname')] ) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								{!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.email')] ) !!}
							</div>	
							<div class="col-md-6">
								{!! Form::text('language', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.language')] ) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6">
								{!! Form::text('password', '', ['type'=>'password','class'=>'form-control','placeholder'=>trans('admin::profile.password')] ) !!}
							</div>	
							<div class="col-md-6">
								{!! Form::text('password_confirmation', '', ['type'=>'password','class'=>'form-control','placeholder'=>trans('admin::profile.password')] ) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								{!! Form::select('level', [1=>'Admin',2=>'Visitor'], null, ['class'=>'form-control'] ) !!}
							</div>
						</div>
						
						<div class="form-group">
							{!! Form::label(' ', '') !!}
							<div class="col-md-12">
								<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('admin::sign.signature') }}</button>
								<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('admin::layout.close') }}</button>
							</div>
						</div>
				</div>
				<div class="clearfix"></div>
			{!! Form::close() !!}
	</div>
</div>