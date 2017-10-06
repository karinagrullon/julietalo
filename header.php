<!DOCTYPE HTML>
<head>
<!-- Bootstrap -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bottstrap -->


<link href="images/butterflybar.ico" type="image/x-icon" rel="shortcut icon" />
<!-- Character Encoding -->
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>JulietaLo</title>
<!-- Character Encoding -->
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
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


<!-- Zoom -->
<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">

<style type="text/css">

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

<!-- DROPDOWN -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="examples/css/sample.css" />

<script src="js/jquery/jquery-1.9.0.min.js" type="text/javascript"></script>

<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/msdropdown/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->



<!-- END DROPDOWN -->

</head>

<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46724313-1', 'julietalo.com');
  ga('send', 'pageview');

</script>

<div class="style-head2"> 
</div>

<div class="style-head1"> 

<div id="head_container">

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
<!-- <hr class="style-head"> -->

<div id="menu_upper">

<?php 
if(!logged_in_system()) {
include 'widgets/menu_upper.php'; 
} 
?>

</div>

<div id="logo_head">
<div class="logo_img"> <a href="index.php"><img src="images/banner3%20copia.png" width="15" alt="JH"></a> </div>

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



