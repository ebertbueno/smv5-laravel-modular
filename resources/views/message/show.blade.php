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
				<div class="form-group">
					<a href="#" class="btn btn-default btn-reply-msg" data-toggle="modal" data-target="#myModal" data-receptor="{{ $owner }}" data-name="{{ $msg->rname or ''}}" >
						{{ ( isset($msg->rname) )? trans('message.reply_message'):trans('message.send_message') }}</a> 
				</div>
			<!-- section end -->

