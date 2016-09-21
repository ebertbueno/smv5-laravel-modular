@extends( Config::get('themes.backend') )

@section('content')
  <section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			{!! link_to_route('admin.manage-api.create', 'Add New') !!}
			Manage API Credentials
		</div>
		<div class="panel-body">
			<div>
				&middot;
				<small>All Clients ({!! $client->count() !!})</small>
			</div>
			<table class="table">
				<thead>
					<th>ID</th>
					<th>Name</th>
					<th>Created At</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody>
					@foreach ($client as $row)
					<tr>
						<td>{!! $row->id !!}</td>
						<td>{!! $row->name !!}</td>
						<td>{!! $row->created_at !!}</td>
						<td class="text-center">
							<a href="{!! route('admin.manage-api.edit', $row->id) !!}">Edit</a>
							&middot;
							@include('api::partials.modal', ['data' => $row, 'name' => 'manage-api'])
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>

  </section>
@stop
