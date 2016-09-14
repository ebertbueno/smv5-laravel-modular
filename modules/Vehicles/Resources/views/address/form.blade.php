@section('main')

@if ( Request::segment(3) == 'edit' )
	<h1>Edit Address</h1>
	{{ Form::model($data, array('method' => 'PATCH', 'route' =>array('address.update', $data->id), 'class'=>'form-horizontal')) }}
@endif
@if ( Request::segment(2) == 'create')
	<h1>Create Address</h1>

	{{ Form::open(array('route' => 'address.store','class'=>'form-horizontal')) }}
@endif		
		<div class="form-group">
			{{ Form::label('address_name', 'Exibition name:') }}
			<div class="col-md-4">
				{{ Form::text('address_name' ) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('zip_code', 'Zipcode:') }}
			<div class="col-md-4">
				{{ Form::text('zip_code') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('address', 'Address:') }}
			<div class="col-md-4">
				{{ Form::text('address') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('address2', 'Address2:') }}
			<div class="col-md-4">
				{{ Form::text('address2') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('country', 'Country:') }}
			<div class="col-md-4">
				{{ Form::text('country') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('state', 'State:') }}
			<div class="col-md-4">
				{{ Form::text('state') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('city', 'City:') }}
			<div class="col-md-4">
				{{ Form::text('city') }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label(' ', ' ') }}
			<div class="col-md-4">
				{{ Form::submit('Save', array('class' => 'btn btn-success')) }}
			</div>
		</div>
	{{ Form::close() }}


	@if ($errors->any())
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
	@endif
@stop