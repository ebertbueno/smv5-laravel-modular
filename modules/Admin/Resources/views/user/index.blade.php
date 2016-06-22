@extends( Config::get('themes.backend') )

@section('content')
	<section class="container-fluid">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="#" data-action="{{ url('admin/users/create') }}" data-toggle="modal" data-target="#myModal">Novo</a>
				Panel heading petition
			</div>
			<div class="panel-body">
			    <table id="users-table" class="display table" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>ID</th>
			                <th>Name</th>
			                <th>Email</th>
			                <th>Level</th>
			                <th>Language</th>
			                <th>Status</th>
			                <th></th>
			            </tr>
			        </thead>
			    </table>
			</div>
		</div>
	</section>

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            	{!! Form::open(['url' => '', 'method' => 'delete', 'class'=>"delete-form"]) !!}
					<div class="form-group">
						{!! Form::label('confirm', 'Are you sure?') !!}
						<div class="col-md-12">
							<button type="submit" id="btn-sign" class="btn btn-success">{{ trans('admin::sign.signature') }}</button>
							<button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">{{ trans('admin::layout.close') }}</button>
						</div>
					</div>
				{!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('css')
	<link type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
@endsection

@section('js')
	<script src="{{ url('js/jquery.form.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
@endsection

@section('script')
	$(document).ready(function() 
	{
	 	$system.datatables( '#users-table', '{{ url('admin/users') }}' );

	 	$system.parseForm();

	} );
@endsection
