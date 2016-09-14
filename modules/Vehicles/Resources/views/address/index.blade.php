@extends('layouts.admin')

@section('main')

<h1>{{ Lang::get('address.all_users') }}</h1>

<p>{{ link_to_route('address.create', 'Add new address') }}</p>

@if ($data->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
				<th>City</th>
				<th>Country</th>
				<th></th>
				<th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->address_name }}</td>
					<td>{{ $row->city }}</td>
					<td>{{ $row->country }}</td>
                    <td>{{ link_to_route('address.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) }}</td>
                    <td>{{ Form::open(array('method' => 'DELETE', 'route' => array('address.destroy', $row->user_id))) }}                    
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
              
        </tbody>
      
    </table>
@else
    There are no users
@endif

@stop