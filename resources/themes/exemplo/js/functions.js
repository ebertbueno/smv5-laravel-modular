$(document).ready(function()
{
	if( $(".sidebar div > div").length > 0 )
	{
		$('.sidebar').removeClass('hide');
		$('section').attr('class', 'col-md-9');
	}
});