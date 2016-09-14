@extends( Config::get('themes.backend') )

@section('content')
	<section class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				{!! link_to_route('admin.vehicles.create', 'Add new vehicle') !!} 
				{{ Lang::get('vehicles.all') }}
			</div>
			<div class="panel-body">
				<table class="table" data-target="{!! url('admin/vehicles') !!}" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Chassis</th>
							<th>Plate</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
</section>

@stop

@section('css')
	<link type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
@endsection

@section('scripts')
	$(document).ready(function() {
    $('.table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": $('.table').data('target')
		});
	});
@endsection