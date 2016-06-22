@extends( Config::get('themes.frontend') )

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
	
					<h2 class="text-center">{{ trans('error.'.$code) }}</h2>

				</div>
			</div>
			<!-- section end -->
@endsection

@section('script')
	
	

@endsection