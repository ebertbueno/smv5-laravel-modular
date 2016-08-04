@extends( Config::get('themes.backend') )

@section('content')
	<section class="container-fluid">

		<div class="panel panel-default" ng-controller="UserController as showCase">
			<div class="panel-heading">
				<!--<a href="#" data-action="{{ url('admin/users/create') }}" data-toggle="modal" data-target="#myModal">Novo</a>-->
				<buton ng-click="toggle('add', 0)">Novo</button>
				Panel heading petition
			</div>
			<div class="panel-body" >
			    <table id="users-table" class="display table" cellspacing="0" width="100%" datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" >
			        <thead>
			        	<tr>
			        		<td>ID</td>
			        		<td>Name</td>
			        		<td>Email</td>
			        		<td>Level</td>
			        		<td>Lang</td>
			        		<td>Status</td>
			        		<td> </td>
			        	</tr>
			        </thead>
			    </table>
			</div>
		</div>
	</section>

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            	{!! Form::open(['url' => '', 'method' => 'delete', 'class'=>"delete-form"]) !!}
					<div class="form-group">
						{!! Form::label('confirm', 'Are you sure?') !!}
						<div class="col-md-12">
							<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('admin::sign.signature') }}</button>
							<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('admin::layout.close') }}</button>
						</div>
					</div>
				{!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog" ng-controller="UserController">
	        <div class="modal-content" >	
		        <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3>@{{ form_title }}</h3>
				</div>
				<div class="modal-body">
					<div class="row" >
						{!! Form::open(array('route' => 'admin.users.store', 'method' => 'post', 'class'=>'form-horizontal','id'=>'formAjax' )) !!}
							<div class="col-md-12">
								<div class="status"></div>
								<div class="form-group">
									<div class="col-md-6">
										{!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.name'), 'ng-model'=>"employee.name"] ) !!}
									</div>	
									<div class="col-md-6">
										{!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.lastname'), 'ng-model'=>"employee.lastname"] ) !!}
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										{!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.email'), 'ng-model'=>"employee.email"] ) !!}
									</div>	
									<div class="col-md-6">
										{!! Form::text('language', null, ['class'=>'form-control', 'placeholder'=>trans('admin::profile.language'), 'ng-model'=>"employee.language"] ) !!}
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6">
										{!! Form::text('password', '', ['type'=>'password','class'=>'form-control','placeholder'=>trans('admin::profile.password'), 'ng-model'=>"employee.password"] ) !!}
									</div>	
									<div class="col-md-6">
										{!! Form::text('password_confirmation', '', ['type'=>'password','class'=>'form-control','placeholder'=>trans('admin::profile.password'), 'ng-model'=>"employee.confirm_password"] ) !!}
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										{!! Form::select('level', [1=>'Admin',2=>'Visitor'], null, ['class'=>'form-control', 'ng-model'=>"employee.level"] ) !!}
									</div>
								</div>
								
								<div class="form-group">
									{!! Form::label(' ', '') !!}
									<div class="col-md-12">
										<button type="submit" ng-click="save(modalstate, id)" ng-disabled="frmEmployees.$invalid" id="btn-sign" class="btn btn-success">{{ trans('admin::sign.signature') }}</button>
										<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('admin::layout.close') }}</button>
									</div>
								</div>
							</div>
						{!! Form::close() !!}
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
        </div>
    </div>
@stop

@section('css')
	<link type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<link type="text/css" href="{{ url('bower_components/angular-datatables/dist/angular-datatables.min.css') }}" />
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://l-lin.github.io/angular-datatables/vendor/angular/angular.js"></script>
	<script src="{{ url('bower_components/angular-datatables/dist/angular-datatables.min.js') }}"></script>
	<script src="{{ url('modules/Admin/js/admin.class.js') }}"></script>
@endsection

@section('script')
	$(document).ready(function() 
	{
	 	//var table = $system.datatables( '#users-table', '{{ url('admin/users') }}' );

	 	//$system.parseForm();

	} );
@endsection
