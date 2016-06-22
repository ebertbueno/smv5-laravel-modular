@extends( Config::get('themes.frontend') )

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
	
					<h3 class="text-center">{{ trans('sign.signatures') }}</h3>
					<a href="{{ url('petition') }}">{{ trans('layout.back') }}</a>
					<table class="table">
						<tr>
							<th>Name</td>
							<th>Last Name</td>
							<th>City</td>
							<th>Country</td>
							<th>Email</td>
							<th>Status</td>
							<th>Remove</td>
						</tr>
					@foreach( $signatures as $sign )
						<tr>
							<td>{{ $sign->user->name }}</td>
							<td>{{ $sign->user->last_name }}</td>
							<td>{{ $sign->account->city }}</td>
							<td>{{ $sign->account->country }}</td>
							<td>{{ $sign->user->email }}</td>
							<td>{{ ($sign->confirmed == 1)? trans('layout.yes'):trans('layout.no') }}</td>
							<td>
								{!! Form::open(['url' => 'signature/'.$sign->id, 'method' => 'delete', 'style'=>'margin:0px;padding:0px;']) !!}
										<button type="submit" class="btn btn-default btn-sm sure-prompt" style="margin:0px;padding:0px" >{{ trans('layout.delete') }}</button>
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
					</table>
				</div>
			</div>
			<!-- section end -->
@endsection

@section('script')
	


@endsection