@extends('theme.layout')

@section('content')
<!-- section start -->
			<!-- ================ -->
			<div class="section clearfix">
				<div class="container">
					
					<h2 class="text-center">{{ trans('message.new_message') }}</h2>
					<!-- tabs start -->
					<div class="vertical" style="margin-top:0px">
												<!-- Nav tabs -->
												<ul class="nav nav-tabs" role="tablist">
																			<li>
																				<a href="#vtab{{ $user->id }}" data-owner="{{ $user->id }}" role="tab" data-toggle="tab">
																					<i class="fa fa-magic pr-10"></i> {{ $user->name }}
																				</a>
																			</li>
												</ul>
												<!-- Tab panes -->
												<div class="tab-content">
																	<div class="tab-pane fade in" id="vtab{{ $user->id }}">
																			<!-- section start -->
																				<!-- ================ -->
																					<div class="col-md-12 frame-msg">
																						<!-- tabs start -->
																						@if( count($messages) > 0 )
																								@foreach( array_reverse($messages) as $msg )
																												<div class="testimonial gray-bg {{ ($msg->owner_id == Auth::user()->id) ?'text-right':'' }}">
																														<div class="testimonial-body">
																															<p>{{ $msg->message }}</p>
																															<div class="testimonial-info-1">{{ trans('message.says') }} {{ $msg->oname }}</div>
																														</div>
																											</div>
																								@endforeach
																						@endif
																					</div>
																				<!-- section end -->
											
																					<div class="col-md-12">
																						{!! Form::open(array('route' => 'message.store', 'method' => 'post', 'class'=>'form-horizontal new-message-form')) !!}
																							<div class="status"></div>
																							<input type="hidden" name="receptor_id" id="receptor_id" value="{{ $_GET['user'] or '' }}">
																							<div class="form-group">
																								<label class="control-label">{{ trans('message.reply_message_to') }} <span id="msg-name">{{ $user->name }}</span></label>
																									<div class="input-group">
																										<textarea name="message" class="form-control" id="message"></textarea>
																										<span class="input-group-btn">
																											<button type="button" class="btn btn-default btn-new-msg" >{{ trans('layout.send') }}</a>
																										</span>
																									</div>
																							</div>
																						{!! Form::close() !!}
																						</div>
																					<div class="clearfix"></div>
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

@section('script')
	$(document).ready(function()
	{
			$('.nav-tabs li:first, .tab-content .tab-pane:first').addClass('active');
			$(".tab-pane.active .frame-msg").animate({ scrollTop: 9999 }, 10);
			
			$('.btn-new-msg').on('click', function(e)
    	{
        e.preventDefault();
        $('.helper-block').remove();
        $('.new-message-form .status').removeClass('alert alert-success alert-danger').fadeOut('200');
        $('.new-message-form .btn').attr('disabled', true);
      
        $.ajax({
            url: '{{ url('message') }}',
            type: 'POST',
            data: $('.new-message-form').closest('form').serialize(),
            success: function(data){
                var json = data.responseJSON;
                $('.new-message-form .status').addClass('alert alert-success').html(data.message).fadeIn(200).delay(2000).fadeOut(200, function(){
                      $('#myModal').modal('hide');
                });
                $('.new-message-form .btn').attr('disabled', false);
                location.reload();
            },
            statusCode: {
                412: function(data) {
                     var json = data.responseJSON;
                    $.each(json.error, function(index, value) {
                        $('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
                    });
                    $('.new-message-form .status').addClass('alert alert-danger').html(json.message).fadeIn(200);
                    $('.new-message-form .btn').attr('disabled', false);
                }
            }
        });
      
        return false;
     });
				
			setInterval( function(){
				location.reload();
			},30000);
  
	});
@endsection

