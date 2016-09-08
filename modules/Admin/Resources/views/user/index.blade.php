@extends( Config::get('themes.backend') )

@section('content')
	<section class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<button class="btn btn-link" ng-click="toggle('add', 0)">Novo</button>
				<button class="btn btn-link" ng-click="reload()">Reload</button>
				Panel heading petition
			</div>
			<div class="panel-body">
					<div ng-show="status.type == 'success'" class="alert alert-success">@{{ status.message }}</div>
			    <table id="users-table" datatable="" dt-options="dtOptions" dt-columns="dtColumns"  dt-instance="dtInstance" class="display table" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>ID</th>
			                <th>Name</th>
			                <th>Last name</th>
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

@endsection

@section('modal')

	 @include('admin::user.form')

@endsection

@section('css')
	<link type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
@endsection

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://rawgithub.com/l-lin/angular-datatables/dev/dist/angular-datatables.min.js"></script>
  <script type="text/javascript" src="{{ url('modules/admin/js/admin.class.js') }}"></script>
  <!-- http://www.tutorials.kode-blog.com/laravel-5-angularjs-tutorial -->
@endsection

@section('script')
	
@endsection
