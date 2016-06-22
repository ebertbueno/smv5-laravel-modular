		<div class="modal-header">
			<h3>
				Nova mensagem
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</h3>
		</div>
		<div class="modal-body">
			<div class="col-md-12">
				
			{!! Form::open(array('route' => 'message.store', 'method' => 'post', 'class'=>'form-horizontal message-form')) !!}
				<div class="status"></div>
				
				<input type="hidden" name="receptor_id" id="receptor_id" value="{{ $_GET['user'] or '' }}">

				<div class="form-group">
					<label class="control-label">{{ trans('message.reply_message_to') }} <span id="msg-name"></span></label>
					<textarea name="message" class="form-control" id="message"></textarea>
					
				</div>
				<div class="form-group">
					
					<button type="button" class="btn btn-default btn-send-msg" >{{ trans('layout.send') }}</a> 
					
				</div>
			{!! Form::close() !!}
				
			</div>
			<div class="clearfix"></div>
	</div>