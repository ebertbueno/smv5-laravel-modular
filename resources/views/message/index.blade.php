@extends('theme.layout')

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
					
					<h2 class="text-center">{{ trans('message.manage_message') }}</h2>
					<!-- tabs start -->
					<div class="vertical" style="margin-top:0px">
												<!-- Nav tabs -->
												<ul class="nav nav-tabs users-msg" role="tablist">

														@foreach( $users as $key=>$msg )
																@if( $key != Auth::user()->id )
																			<li>
																				<a href="#vtab{{ $key }}" data-owner="{{ $key  }}" role="tab" data-toggle="tab"><i class="fa fa-magic pr-10"></i> {{ $msg }}</a>
																			</li>
																@endif
														@endforeach

												</ul>
												<!-- Tab panes -->
												<div class="tab-content">

														@foreach( $users as $key=>$msg )
															@if( $key != Auth::user()->id )
																	<div class="tab-pane fade in" id="vtab{{ $key }}">
																	
																	</div>
															@endif
														@endforeach
											<!-- tabs end -->
											</div>
									</div>

				</div>
			</div>
			<!-- section end -->
@endsection

@section('js')
		
		<!-- Parallax javascript -->
		<script src="{{ asset('plugins/jquery.parallax-1.1.3.js') }}"></script>
		<!-- Isotope javascript -->
		<script type="text/javascript" src="{{ asset('plugins/isotope/isotope.pkgd.min.js') }}"></script>
		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.js') }}"></script>
		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

@endsection

@section('modal')

		@include('message.form')

@endsection

@section('script')
	$(document).ready(function(){
			$('.nav-tabs li:first, .tab-content .tab-pane:first').addClass('active');
			loadTab( $('.nav-tabs li a:first').attr('data-owner') );
			$('.nav-tabs li a').on('click', function(){
					loadTab( $(this).attr('data-owner') );
			});
			setInterval( "loadTab( $('.nav-tabs li.active a').attr('data-owner') )",15000);
	});
@endsection

