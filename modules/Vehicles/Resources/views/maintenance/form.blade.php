@extends('layouts.admin')

@section('main')

@if ( Request::segment(3) == 'edit' )
	<h1>Edit vehicle</h1>
	{{ Form::model($vehicle, array('method' => 'PATCH', 'route' =>array('vehicle.update', $vehicle->id), 'class'=>'form-horizontal')) }}
@endif
@if ( Request::segment(2) == 'create')
	<h1>Create vehicle</h1>

	{{ Form::open(array('route' => 'vehicle.store','class'=>'form-horizontal')) }}
@endif		
		<div class="form-group">
			{{ Form::label('chassis', 'Chassis:') }}
			<div class="col-md-4">
				{{ Form::text('chassis' ) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('plate', 'Plate:') }}
			<div class="col-md-4">
				{{ Form::text('plate') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label(' ', ' ') }}
			<div class="col-md-4">
				{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			</div>
		</div>
	{{ Form::close() }}


	@if ($errors->any())
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	@endif
@stop