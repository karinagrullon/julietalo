

<script>
function createByJson() {
	var jsonData = [					
					{description:'Choos your payment gateway', value:'', text:'Payment Gateway'},					
					{image:'images/msdropdown/icons/Amex-56.png', description:'My life. My card...', value:'amex', text:'Amex'},
					{image:'images/msdropdown/icons/Discover-56.png', description:'It pays to Discover...', value:'Discover', text:'Discover'},
					{image:'images/msdropdown/icons/Mastercard-56.png', title:'For everything else...', description:'For everything else...', value:'Mastercard', text:'Mastercard'},
					{image:'images/msdropdown/icons/Cash-56.png', description:'Sorry not available...', value:'cash', text:'Cash on devlivery', disabled:true},
					{image:'images/msdropdown/icons/Visa-56.png', description:'All you need...', value:'Visa', text:'Visa'},
					{image:'images/msdropdown/icons/Paypal-56.png', description:'Pay and get paid...', value:'Paypal', text:'Paypal'}
					];
	$("#byjson").msDropDown({byJson:{data:jsonData, name:'payments2'}}).data("dd");
}
$(document).ready(function(e) {		
	//no use
	try {
		var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
												var val = data.value;
												if(val!="")
													window.location = val;
											}}}).data("dd");

		var pagename = document.location.pathname.toString();
		pagename = pagename.split("/");
		pages.setIndexByValue(pagename[pagename.length-1]);
		$("#ver").html(msBeautify.version.msDropdown);
	} catch(e) {
		//console.log(e);	
	}
	
	$("#ver").html(msBeautify.version.msDropdown);
		
	//convert
	$("select").msDropdown({roundedBorder:false});
	createByJson();
	$("#tech").data("dd");
});
function showValue(h) {
	console.log(h.name, h.value);
}
$("#tech").change(function() {
	console.log("by jquery: ", this.value);
})
//
</script>

</div>

</div>

</div>

<script type="text/javascript" src="js/jq_global.js"></script>
<script type="text/javascript" src="js/global.js"></script>

          
<!-- DATATABLE -->
<script src="DataTables/media/js/jquery.dataTables.js" type="text/javascript"> </script>

<script type="text/javascript">

$(document).ready(function() {

$('#datatables').dataTable({


	"aaSorting": [[0, "desc"]],
	//"bJQueryUI": true,
        "sPaginationType": "full_numbers",
		"bAutoWidth": false,
	
	
	"oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ ",
            "sZeroRecords": "No existen datos para esta consulta",
            "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(De un maximo de _MAX_ registros)",
			"sSearch": "Buscar: _INPUT_",
			"sEmptyTable": "No hay datos disponibles para esta tabla",
			"sLoadingRecords": "Por favor espere - Cargando...",  
			"sProcessing": "Actualmente ocupado",
			"sSortAscending": " - click/Volver a ordenar en orden Ascendente",
			"sSortDescending": " - click/Volver a ordenar en orden descendente",
			
			"oPaginate": {
        "sFirst":    "<<",
        "sLast":     ">>",
        "sNext":     ">",
        "sPrevious": "<"
    },
			
        }
	});

})

</script>


<!-- END DATATABLE -->



 <!-- Zoom -->
<script src="js/jquery-1.6.js" type="text/javascript"></script> 
<script type="text/javascript">
var jQuery_1_6 = $.noConflict(true);
</script>

<script src="js/jquery.jqzoom-core.js" type="text/javascript"></script>
	
     <!-- End zoom --> 
	 


 <!-- PRUEBA -->

     <!-- PRUEBA --> 
         

<div  id="footer">
<footer>

<p>JulietaLo &copy;2013 All rights reserved</p>

</footer>
</div>

