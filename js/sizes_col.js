
$(document).ready(function() {
   // $('#sub_category').prop('disabled', 'true');
	$('#loader1').hide();
	$('#show_heading').hide();

//quantities
   $("#sub_category_idcolor").change(function(){

		$('#show_sub_categories').fadeOut();
		$('#loader1').show();
		$.post("procesar.php", {
			id_size: $('#search_category_id').val(),
			id_item: $('#iditem').val(),
			id_color: $('#sub_category_idcolor').val(),
			
		}, function(responses){
     		setTimeout("finishAjax('show_sub_categories', '"+escape(responses)+"')", 400);
		});
		return false;
	});
	
});



function finishAjax(id, responses){
// $('#sub_category').prop('disabled', 'true');
    $('#loader1').hide();
  $('#show_heading').show();
  $('#'+id).html(unescape(responses));
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


