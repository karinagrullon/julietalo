
$(document).ready(function() {
   // $('#sub_category').prop('disabled', 'true');   
    $('#loader2').hide();
	$('#show_heading').hide();
	
//Colors
	$('#search_category_id').change(function(){
		$('#show_sub_categories_color').fadeOut();
		$('#loader2').show();
		$.post("procesar_color.php", {
			id_size: $('#search_category_id').val(),
			id_item: $('#iditem').val(),
		}, function(response){
			
			setTimeout("finishAjax('show_sub_categories_color', '"+escape(response)+"')", 400);
		});
		return false;
	});
	
});


function finishAjax(id, response){
// $('#sub_category').prop('disabled', 'true');
  $('#loader2').hide();
  $('#show_heading').show();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} 

function alert_id()
{
	if($('#sub_category_id').val() == '--Select--')
	alert('Please select a quantity.');
	else
	alert($('#sub_category_id').val());
	return false;
}


