<!DOCTYPE HTML>
<html>
<head>
<link href="images/butterflybar.ico" type="image/x-icon" rel="shortcut icon" />
<!-- Character Encoding -->
<title>JulietaLo</title>
<meta name= "viewport" content = "width=device-width">
<meta name="description" content="JulietaLo allows you to customize your special occasions clothings made with the highest quality in the market. You can also buy our exclusive designs for girls, women and men">
<meta name="keywords" content="Clothing, Dress, Shirt, Girl, Custom, JulietaLo">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<!-- Character Encoding -->

<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/pagination.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/menu.css" rel="stylesheet" type="text/css" media="screen">
<link href="css/menu_upper.css" rel="stylesheet" type="text/css" media="screen">
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

 <script type="text/javascript">
$(function(){
        // Check the initial Position of the Sticky Header
        var stickyHeaderTop = $('#stickyheader').offset().top;

        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('#stickyheader').css({position: 'fixed', top: '0px'});
                        $('#stickyalias').css('display', 'block');
                } else {
                        $('#stickyheader').css({position: 'static', top: '0px'});
                        $('#stickyalias').css('display', 'none');
                }
        });
  });
  </script>


<!-- Zoom -->
<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">

<style type="text/css">

 .clearfix:after{clear:both;content:".";display:block;font-size:0;height:0;line-height:0;visibility:hidden;} 
 .clearfix{display:block;zoom:1;padding:1px;z-index:-1;} 

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

<!-- DROPDOWN -->

<link rel="stylesheet" href="examples/css/sample.css" />

<script src="js/jquery/jquery-1.9.0.min.js" type="text/javascript"></script>

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/msdropdown/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->


<!-- END DROPDOWN -->

</head>

<body>
<div id="output_width"></div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46724313-1', 'julietalo.com');
  ga('send', 'pageview');

</script>


 
<div class="style-head2"> 

<span class="right"> 
<?php 
if(!logged_in_system()) {
include 'widgets/login.php'; 

} else {

if(logged_in_system()) {
echo '<div class="usern">';
$user_data_system= user_data_system('nombres','apellidos');
echo '<strong>Usuario: </strong>', $user_data_system['nombres'].' '.$user_data_system['apellidos'];
echo '</div>';
}
}
?>
</span> 

<?php
include 'widgets/menu_upper.php'; 
?>
</div>
<div id="stickyheader">

<div class="style-head1"> 

<div id="head_container">

<div class="logo_img"> <a href="index.php"><img src="images/banner3%20copia.png" width="12%" alt="JulietaLo" id="logo_id" /></a> </div>

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
  <div id="stickyalias"></div>
<!-- De aqui -->

<div id="main_container">

<?php 
// if(logged_in()) { 
// echo 'main_container';
// }
  
// if(logged_in_system()) {
// echo 'main_system_container';	
// }
?>





