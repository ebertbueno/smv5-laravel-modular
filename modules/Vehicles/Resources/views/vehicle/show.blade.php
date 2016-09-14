@extends('layouts.admin')

@section('main')

<h1>View vehicle</h1>
{{ link_to_route('vehicle.index', 'Back', $vehicle->vehicle_id, array('class' => 'btn')) }}

{{ Form::model($vehicle, array('method' => 'PATCH', 'route' =>array('vehicle.update', $vehicle->vehicle_id))) }}
    <ul>
        <li>
            {{ Form::label('chassis', 'Chassis:') }}
            {{ Form::text('chassis', null, array('disabled'=>true) ) }}
        </li>
        <li>
            {{ Form::label('plate', 'Plate:') }}
            {{ Form::text('plate', null, array('disabled'=>true)) }}
        </li>
        <li>
        </li>
    </ul>
{{ Form::close() }}

@if ($errors->any())
    <ul>
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
@endif

@stop