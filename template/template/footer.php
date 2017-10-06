</div>

</div>

</div>

<script type="text/javascript" src="js/jq_global.js"></script>
<script type="text/javascript" src="js/global.js"></script>


<!-- select dropdown -->

     <!-- dropdown -->  

<script type="text/javascript">
if (typeof jQuery !== 'undefined') {
    jQuery.noConflict();
}
</script>	 

<!-- Zoom -->
<script src="js/jquery-1.6.js" type="text/javascript"></script> 
<script src="js/jquery.jqzoom-core.js" type="text/javascript"></script>
     <!-- End zoom -->     
          
<!-- DATATABLE -->
<script src="DataTables/media/js/jquery.dataTables.js" type="text/javascript"> </script>

<script type="text/javascript">

$(document).ready(function() {

$('#datatable_search').dataTable({

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


         

<div  id="footer">
<footer>

<p>JulietaLo &copy;2013 All rights reserved</p>

</footer>
</div>

