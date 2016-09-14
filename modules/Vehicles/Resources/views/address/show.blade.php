@extends('layouts.admin')

@section('main')

<h1>View User</h1>
{{ link_to_route('users.index', 'Back', $user->user_id, array('class' => 'btn')) }}

{{ Form::model($user, array('method' => 'PATCH', 'route' =>array('users.update', $user->user_id))) }}
    <ul>
        <li>
            {{ Form::label('name', 'Username:') }}
            {{ Form::text('name', null, array('disabled'=>true) ) }}
        </li>
        <li>
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email', null, array('disabled'=>true)) }}
        </li>
        <li>
            {{ Form::label('phone', 'Phone:') }}
            {{ Form::text('phone', null, array('disabled'=>true)) }}
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