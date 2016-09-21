@if(isset($model))
{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.manage-api.update', $model->id]]) !!}
@else
{!! Form::open(['files' => true, 'route' => 'admin.manage-api.store']) !!}
@endif
	<div class="form-group">
		{!! Form::label('id', 'ID:') !!}
		{!! Form::text('id', null, ['class' => 'form-control']) !!}
		{!! $errors->first('id', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		{!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('secret', 'Secret:') !!}
		{!! Form::password('secret', ['class' => 'form-control']) !!}
		{!! $errors->first('secret', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
	</div>
{!! Form::close() !!}
