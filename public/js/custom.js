/* Theme Name:iDea - Clean & Powerful Bootstrap Theme
 * Author:HtmlCoder
 * Author URI:http://www.htmlcoder.me
 * Author e-mail:htmlcoder.me@gmail.com
 * Version: 1.3
 * Created:October 2014
 * License URI:http://support.wrapbootstrap.com/
 * File Description: Place here your custom scripts
 */
$(document).ready(function(){
    
    $('.signature-form').submit(function(e)
    {
        e.preventDefault();
        $('.helper-block').remove();
        $('.signature-form .status').removeClass('alert alert-success alert-danger').fadeOut('200');
        $('.signature-form .btn-success').attr('disabled', true);
      
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).closest('form').serialize(),
            success: function(data){
                // Success...
                var json = data.responseJSON;
                $('.signature-form .status').addClass('alert alert-success').html(data.message).fadeIn(200).delay(2000).fadeOut(200, function(){
                      $('#myModal').modal('hide');
                });
                $('.signature-form .btn-success').attr('disabled', false);
                show_hide_signature_btn( 'signed' );
              
                var sign_count = parseInt($('.sign-count').html());
                $('.sign-count').html( sign_count+1 );
            },
            statusCode: {
                412: function(data) {
                     var json = data.responseJSON;
                    $.each(json.error, function(index, value) {
                        $('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
                    });
                    $('.signature-form .status').addClass('alert alert-danger').html(json.message).fadeIn(200);
                    $('.signature-form .btn-success').attr('disabled', false);
                },
                303: function(data){
                    var json = data.responseJSON;
                    $('.signature-form .status').addClass('alert alert-danger').html(json.message).fadeIn(200).delay(5000).fadeOut(200);
                    $('.signature-form .btn-success').attr('disabled', false);
                    show_hide_signature_btn( 'signed' );
                }
            }
        });
    });
  
    // TEM CERTEZA...
    $('.sure-prompt').on('click', function(){
        var question = 'Are you sure?';
        question = $(this).attr('alt');
        if (confirm(question)) {
          return true;
        } else {
          return false; // cancel the event
        }
    });
  
    $('.btn-send-msg').on('click', function(e)
    {
        e.preventDefault();
        $('.helper-block').remove();
        $('.message-form .status').removeClass('alert alert-success alert-danger').fadeOut('200');
        $('.message-form .btn').attr('disabled', true);
      
        $.ajax({
            url: $('.message-form').attr('href'),
            type: 'POST',
            data: $('.message-form').closest('form').serialize(),
            success: function(data){
                var json = data.responseJSON;
                $('.message-form .status').addClass('alert alert-success').html(data.message).fadeIn(200).delay(2000).fadeOut(200, function(){
                      $('#myModal').modal('hide');
                });
                $('.message-form .btn').attr('disabled', false);
                loadTab( $('.message-form #receptor_id').val() );
            },
            statusCode: {
                412: function(data) {
                     var json = data.responseJSON;
                    $.each(json.error, function(index, value) {
                        $('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
                    });
                    $('.message-form .status').addClass('alert alert-danger').html(json.message).fadeIn(200);
                    $('.message-form .btn').attr('disabled', false);
                }
            }
        });
      
        return false;
    });
  
    $('.btn-reply-msg').on('click', function()
    {
         var $owner = $(this).attr('data-receptor');
         $('#receptor_id').val( $owner );
         $('#myModal').modal('show');
    });
  
    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      if( typeof button.data('receptor') != "undefined" && button.data('receptor') != null )
      {
          var id = button.data('receptor');
          var name = button.data('name');
          var modal = $(this);
          modal.find('#receptor_id').val( id );
          modal.find('#msg-name').html( name );
      }
    });
         
		$('[data-toggle="popover"]').popover();
		
		$('.img-fill').imagefill(); //each(function()
		/*{
				// Uncomment the following if you need to make this dynamic
				var refH = $(this).height();
				var refW = $(this).width();
				var refRatio = refW/refH;
				$(this).css({'position':'relative'});	

				var imgH = $(this).children("img").height();
				var imgW = $(this).children("img").width();
				
				if ( (imgW/imgH) < refRatio ) 
				{ 
					 var mtop = -(imgH/2);
					 $(this).children("img").css({'position':'absolute','width':'100%','height': 'auto !important', 'top':'50%', 'margin-top':mtop});	
				} 
				else 
				{
					 var mleft = -(imgW/2);
					 $(this).children("img").css({'position':'absolute','height':'100%','width': 'auto !important', 'left':'50%', 'margin-left':mleft});	
				}
	 });*/
	
		$('.search-box').submit(function()
		{
				var url = $(this).attr('action');
				var val = $('input', this).val();
				location.href=url+'/'+val;
				return false;
		});
});

function show_hide_signature_btn( status )
{
    if( status == 'signed' )
    {
        $('.btn-signature').html('<i class="fa fa-check pr-10"></i> Assinado').removeClass('btn-default').addClass('btn-success');
    }
    else
    {
         $('.btn-signature').html('<i class="fa fa-pencil pr-10"></i> Assinar').removeClass('btn-success').addClass('btn-default');
    }
}

function verify_logged_signature(id)
{
    $.ajax({
            url: '../signature/'+id,
            type: 'GET',
            success: function(data){
                // Success...
                show_hide_signature_btn( 'signed' );
            }
    });
}

function loadTab(id)
{
    var owner = id;
    $.get('./message/'+owner, function(data){
        $( '#vtab'+owner ).html( data );
        $( '#vtab'+owner ).tab('show');
				$(".tab-pane.active .frame-msg").animate({ scrollTop: 9999 }, 10);
    });
}

function getJsParam()
{
    var url = $(location).attr('href');
		if( url.indexOf('#') != -1 )
		{
				var param = url.split('#');
        return param[1];
		}
    return false;
}