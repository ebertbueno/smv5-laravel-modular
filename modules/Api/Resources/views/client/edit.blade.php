@extends( Config::get('themes.backend') )

@section('content')
<section class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Edit &middot; <small>{!! link_to_route('admin.manage-api.index', 'Back') !!}</small>
		</div>
		<div class="panel-body">
			
			<div>
				@include('api::client.form', array('model' => $client))
			</div>

		</div>
	</div>
</section>
@stop
