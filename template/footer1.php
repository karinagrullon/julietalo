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

<!-- FRONT SLIDER -->

<!-- THIS JQUERY JUST WORKS FOR THE MAIN SLIDER DONT LET THE ZOOM WORK -->
 <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script> 
 <!-- END OF IT -->
   
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript"> 
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
	
	
<!-- END FRONT SLIDER -->
         

<div  id="footer">

</body>

<footer>

<p>JulietaLo &copy;<?php echo date("Y") ?> All rights reserved</p>

<div class="social_icon"> <a href="https://www.facebook.com/pages/Julietalo/1461554930723958?ref_type=bookmark" target="_blank"> <img src="images/social/fb.png" /> </a> </div>

<!-- PayPal Logo --><table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/bdg_secured_by_pp_2line.png" border="0" alt="Secured by PayPal"></a><div style="text-align:center"><a href="https://www.paypal.com/webapps/mpp/how-paypal-works"><font size="2" face="Arial" color="#0079CD"><b>How PayPal Works</b></font></a></div></td></tr></table><!-- PayPal Logo -->

</footer>

</div>

