@extends( Config::get('themes.backend') )

@section('content')
	<section class="container">
		<div class="panel panel-default">
			<div class="panel-body">

				@if ( Request::segment(3) == 'create')
					<h1>Create vehicle</h1>
					{!! Form::open(array('route' => 'admin.vehicles.store','class'=>'form-horizontal', 'ng-controller'=>'PageController' )) !!}
				@endif
				@if ( Request::segment(4) == 'edit' )
					<h1>Edit vehicle</h1>
					{!! Form::model($vehicle, array('method' => 'PATCH', 'route' =>array('admin.vehicles.update', $vehicle->id), 'class'=>'form-horizontal', 'ng-controller'=>'PageController',
							'ng-init'=>'fill("'.$vehicle->vehicle_type.'","'.$vehicle->maker_id.'","'.$vehicle->vehicle_id.'","'.$vehicle->model_id.'","'.$vehicle->vehicle_title.'")','id'=>'FormVehicle')) !!}
				@endif		
		
				{!! Form::hidden('vehicle_title', '%%vehicle_title%%' ) !!}

				<div class="form-group">
					{!! Form::label('chassis', 'Chassis', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-8">
						{!! Form::text('chassis', null, ['class'=>"form-control"] ) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('plate', 'Plate:', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::text('plate', null, ['class'=>"form-control"]) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('maker_id', 'Vehicle type', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::select('vehicle_type', array('carros'=>'Cars'), 'carros', 
							['ng-change'=>'updateMakers()', 'ng-model'=>'typeVlr' ,'ng-options'=>'type.text for type in types track by type.key',	'form'=>'form-control' ] )  !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('maker_id', 'Maker', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::select('maker_id', array(), null, ['ng-change'=>'updateVehicles()', 'ng-model'=>'makerVlr' ,'ng-options'=>'item.fipe_name for item in makers track by item.id', 'form'=>'form-control'] ) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('vehicle_id', 'Vehicle', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::select('vehicle_id', array(), null, array( 'ng-change'=>'updateModels()', 'ng-model'=>'vehiclesVlr' ,'ng-options'=>'item.fipe_name for item in vehicles track by item.id','form'=>'form-control') ) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('model_id', 'Model', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::select('model_id', array(), null, array( 'ng-change'=>'updatePrices()', 'ng-model'=>'modelsVlr' ,'ng-options'=>'item.name for item in models track by item.id', 'form'=>'form-control') ) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('address_id', 'Car address', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::select('address_id', $addresses, null, ['form'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('status', 'Status', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::select('status', array(1=>'Active', 0=>'Inactive'), null,[ 'form'=>'form-control'] ) !!}
					</div>
				</div>
				<div class="form-group">
					{!! Form::label(' ', ' ', ['class'=>'control-label col-md-4']) !!}
					<div class="col-md-4">
						{!! Form::submit('Update', array('class' => 'btn btn-info')) !!}
					</div>
				</div>
			{!! Form::close() !!}


			@if ($errors->any())
				<ul>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</ul>
			@endif
				
		</div>
	</div>
</section>
@stop

@section('js')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
	<script type="text/javascript" src="{!! asset('modules/vehicles/js/ng.controllers.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('modules/vehicles/js/ng.services.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('modules/vehicles/js/app.js') !!}"></script>
@stop