@extends('layouts.admin')

@section('main')

<h1>{{ Lang::get('vehicle.all') }}</h1>

<p>{{ link_to_route('vehicle.create', 'Add new vehicle') }}</p>

@if ($data->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Username</th>
				<th>Email</th>
				<th>Phone</th>
				<th></th>
				<th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->chassis }}</td>
					<td>{{ $row->plate }}</td>
                    <td>{{ link_to_route('vehicle.edit', 'Edit', array($row->id), array('class' => 'btn btn-info')) }}</td>
                    <td>{{ Form::open(array('method' => 'DELETE', 'route' => array('vehicle.destroy', $row->id))) }}                    
							{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
              
        </tbody>
      
    </table>
@else
    There are no vehicles
@endif

@stop