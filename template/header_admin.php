<!DOCTYPE HTML>
<head>
<title>Jh</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/pagination.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/menu.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" href="css/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style_slide.css" type="text/css" media="screen" /> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!-- DATATABLE -->
<style type="text/css" title="currentStyle">
			@import "DataTables/media/css/demo_page.css";
			@import "DataTables/media/css/demo_table.css";
</style>
<!-- END DATATABLE -->

<!-- AJAX INSERT -->
<script>			
    $(function(){
	
		 var iditem = $('#id-item').val();
            $.post('prueba21.php',{action: "show", id_item:iditem},function(res){
                $('#result').html(res);
            }); 
			
        //insert record
        $('#insert').click(function(){
				
		    var iditem = $('#id-item').val();
            var idsize = $('#tsize').val();
            var idcolor = $('#tcolor').val();
			var idqua = $('#tquantity').val();
			 
            //syntax - $.post('filename', {data}, function(response){});
            $.post('prueba21.php',{action: "insert", id_item:iditem, id_size:idsize, id_color:idcolor, id_qua:idqua },function(res){
                $('#result').html(res);
            });    

	
            $.post('prueba21.php',{action: "show", id_item:iditem},function(res){
                $('#result').html(res);
            }); 
			
        });
 
        //show records
        $('#show').click(function(){
		 var iditem = $('#id-item').val();
            $.post('prueba21.php',{action: "show", id_item:iditem},function(res){
                $('#result').html(res);
            });        
        });
		
		
	//delete records 
 $('#idelete').click(function(){
		 var iditem = $('#id-item').val();
            $.post('prueba21.php',{action: "show", id_item:iditem},function(res){
                $('#result').html(res);
            });        
        });
		
    });
</script>
<!-- END INSET AJAX -->

<!-- Zoom -->
<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">
<style type"text/css">

.clearfix:after{clear:both;content:".";display:block;font-size:0;height:0;line-height:0;visibility:hidden;}
.clearfix{display:block;zoom:1;padding:1px;}

ul#thumblist{display:block;}
ul#thumblist li{float:left;margin-right:2.3%;list-style:none;}
ul#thumblist li a{display:block;border:1px solid #CCC;}
ul#thumblist li a.zoomThumbActive{
    border:1px solid #B21E1E;
}

</style>

<script type="text/javascript">

$(document).ready(function() {
	$('#jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
	
});

</script>
<!-- End zoom -->

<script type="text/javascript" src="js/sizes_qua.js"> </script>
<script type="text/javascript" src="js/sizes_col.js"> </script>

<!-- Character Encoding -->
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>

<body>

<div class="style-head2"> 
</div>

<div class="style-head1"> 

<div id="head_container">
<!-- <hr class="style-head"> -->

<div id="logo_head">

<!-- <a href="index.php"> <img src="images/logo.png" alt="JH"></a>  -->

 <span class="right"> 

<?php 
if(!logged_in_system()) {
include 'widgets/login.php'; 

} else {

if(logged_in_system()) {
echo '<div class="greet">';
$user_data_system= user_data_system('nombres','apellidos');
echo '<strong>Usuario: </strong>', $user_data_system['nombres'].' '.$user_data_system['apellidos'];
echo '</div>';
}
}
?>
</span> 

<div id="menu">

<?php 
if(!logged_in_system()) {
include 'widgets/menu.php'; 
} else {
include 'widgets/menu_admin.php'; 
}
?>

</div>
</div>
</div>
</div>

<!-- De aqui -->
<div id="main_container">



