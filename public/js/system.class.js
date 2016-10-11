$(document).ready(function()
{

});

function System() {
    this.base_url = $('base').attr('href');
    this.objDT = 'nada...';
}

System.prototype.parseForm = function( selector='#formAjax', divStatus='.status', btnSubmit='.btn-success')
{
    $(selector).on('submit', function(e) 
    {
        $('.helper-block').remove();
        $('form '+divStatus ).removeClass('alert alert-success alert-danger').fadeOut('200');
        $('form '+btnSubmit ).attr('disabled', true);
      
        $(this).ajaxSubmit({
            target: divStatus, 
            dataType:'json',
            clearForm:true,
            success:function(data)
            {
                var json = data.responseJSON;
                $('form .status').addClass('alert alert-success').html(data.message).fadeIn(200).delay(2000).fadeOut(200, function(){
                      $('#myModal').modal('hide');
                      $system.objDT.ajax.reload();
                });
                $('form .btn-success').attr('disabled', false);
            },
            error: function(data) {
                 var json = data.responseJSON;
                $.each(json.error, function(index, value) {
                    $('input[name="'+index+'"]').parent().append('<span class="helper-block text-danger">'+value.join('<br>')+'</span>');
                });
                $('form '+divStatus).addClass('alert alert-danger').html(json.message).fadeIn(200);
                $('form '+btnSubmit).attr('disabled', false);
            },
            complete:function(){
                 $('form .btn-success').attr('disabled', false);
            }
        }); 
        return false; 
    }); 
}

System.prototype.datatables = function( div, url, method='GET', param = {} )
{
    param['processing'] = true; 
    param['serverSide'] = true; 
    param['fnCreatedCell'] = function (nTd, sData, oData, iRow, iCol){  
         $compile(nTd)($scope);
    };
    param['ajax'] = {url:url,method:method};
    this.objDT = $( div ).DataTable(param);

    return this.objDT;
}

System.prototype.deleteItem = function( selector )
{

        alert(  'Foi'  );

        var form = $('<form/>').attr({'action': $(selector).attr('href'), 'class':'form-horizontal', 'method':'post', 'id':'ajaxForm'});
        form.append( $('<input/>').attr({'type':'hidden','name':'_token','value':$(selector).data('token')} ) );
        form.append( $('<input/>').attr({'type':'hidden','name':'_method','value':'DELETE'}) );
        form.append( 
            $('<button/>').attr({
                'type':'submit','name':'btn-delete','class':'btn btn-danger'
            }).html('<i class="glyphicon glyphicon-edit"></i>')
        );
        var div = $('<div/>').addClass('modal-body');
       
        $('.modal-content').html( div.append(form) );
        
        $('#myModal').modal('show');
        /*$.ajax({
            url: ,
            method: 'post',
            data:{ 
                _token:,
                _method:'DESTROY'
            },
            success:function(){
                alert('Success!');
                $system.objDT.ajax.reload();
            }
        });*/
    
}

var $system = new System();