<?php
include 'init.php';
?>
<!-- HEADER -->

<!DOCTYPE HTML>
<head>
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

<!-- DROPDOWN -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="examples/css/sample.css" />
<script src="js/jquery/jquery-1.9.0.min.js"></script>
<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="css/msdropdown/dd.css" />
<script src="js/msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->


<!-- END DROPDOWN -->

</head>

<body>

<!-- END Header -->
 

<script>
    var id_item = <?php json_encode($_GET['pitem']); ?>;
</script>

<script type="text/javascript">
if (typeof jQuery !== 'undefined') {
    jQuery.noConflict();
}
</script>

<div id="container">


<div id="container_ditems">
<div id="main">

<?php
 $id_item =  $_GET['pitem'];
 
 if (no_available($id_item) == true) {
     header('Location: index.php');
	 exit();    
 }
 
//Obtain directory
if (isset($_GET['pkey']) && isset($_GET['ptype'])) {
    
    $pkey  = $_GET['pkey'];
    $ptype = $_GET['ptype'];
    
    switch ($ptype) {
        case 'occ':
            $sb          = " Occasion";
            $obtain_data = "SELECT id_oct,des_oct FROM occations WHERE id_oct='$pkey'";
            $re = mysql_query($obtain_data) or die("There was an error while obtaining the data items") . mysql_error();
            while ($campo_act = mysql_fetch_array($re)) {
                $des_pkey = $campo_act['des_oct'];
            }
            break;
        case 'col':
            $sb          = " Colors";
            $obtain_data = "SELECT id_color,des_color FROM colors WHERE id_color='$pkey'";
            $re = mysql_query($obtain_data) or die("There was an error while obtaining the data items") . mysql_error();
            while ($campo_act = mysql_fetch_array($re)) {
                $des_pkey = $campo_act['des_color'];
            }
            break;
        case 'pri':
            $sb = " Prices";
            if ($pkey == '100000') {
                $des_pkey = 'All prices';
            } else {
                $des_pkey = 'Under ' . $pkey;
            }
            break;
    }
?>

<div id="bread">
<ul>
 <li class="first"> <?php
    if (isset($sb)) {
        echo '<a href="#">' . $sb . '</a>';
    }
?>
 <ul>
<li>&gt;&gt; <?php
    if (isset($des_pkey)==true) {
        echo '<a href="ditems?ptype=' . $ptype . '&pkey=' . $pkey . '&page=1">' . $des_pkey . '</a>';
    }
?>
 </ul>
 
 <li>&gt;&gt; <?php
 $obtain_data1 = "SELECT * FROM items WHERE id_item='$id_item'";
 $re = mysql_query($obtain_data1) or die("There was an error while obtaining the data items") . mysql_error();

 while ($campo_act = mysql_fetch_array($re)) {
	$des_item = $campo_act['des_item'];
 }
    if (isset($des_item)==true) {
        echo '<a href="#">' . $des_item . '</a>';
    }
?>
 </ul>
 
</div>

<hr class="style-three">

<?php
}
$id_item = $_GET['pitem'];

//Recoger los datos para actualizar
if (isset($_GET['pitem'])) {
  
    $datos       = $_GET['pitem'];
    $obtain_data = "SELECT it.id_item,it.id_oct,it.image_id,it.des_item,it.id_fabric,it.cos_it,it.pri_it,itm.id_item,itm.id_color,co.id_color,co.des_color,im.image_id,im.ext,fa.id_fabric FROM items AS it, item_main_color AS itm,images AS im,fabrics AS fa,colors AS co WHERE it.id_item=itm.id_item AND it.image_id=im.image_id AND it.id_fabric=fa.id_fabric AND itm.id_color=co.id_color AND itm.del_est_it_ma_co='0' AND it.id_item='$datos'";
 
    $re = mysql_query($obtain_data) or die("There was an error while obtaining the data items") . mysql_error();
    
    $colors = array();
    while ($campo_act = mysql_fetch_array($re)) {
        
        $id_item    = $campo_act['id_item'];
        $id_oct     = $campo_act['id_oct'];
        $id_fabric  = $campo_act['id_fabric'];
        $des_item   = $campo_act['des_item'];
        $cos_it     = $campo_act['cos_it'];
        $pri_it     = $campo_act['pri_it'];
        $image      = $campo_act['image_id'] . '.' . $campo_act['ext'];
        $image_name = $campo_act['image_id'];
        $image_ext  = $campo_act['ext'];
        $des_color  = $campo_act['des_color'];
        $colors[]   = $campo_act['id_color'];
        
    }
    
    $bclass       = 'bactualizar';
    $enviar_value = 'Actualizar';
    $bname        = 'bact';
    
} else {
    
    $enviar_value = 'Registrar';
    $bclass       = 'bguardar';
    $bname        = 'breg';
    //$limpiar_tb= reset;
}

//Recoger datos color principal

$datos          = $_GET['pitem'];
$obtain_data_co = "SELECT it.id_item,imc.id_color,imc.id_item,co.id_color,co.des_color FROM items AS it, item_main_color AS imc,colors AS co WHERE it.id_item=imc.id_item AND co.id_color=imc.id_color AND it.del_est_item=0 AND it.id_item='$datos'";


$re_co = mysql_query($obtain_data_co) or die("There was an error while obtaining color data") . mysql_error();

while ($campo_color = mysql_fetch_array($re_co)) {
	$id_color = $campo_color['id_color'];
    $des_color_imc = $campo_color['des_color'];
}



//Get features 
$datos       = $_GET['pitem'];
$re          = mysql_query("SELECT id_item,des_it_feat FROM item_features WHERE id_item='$datos' AND del_est_feat= '0'");
$feats_array = array();
while ($feat_r = mysql_fetch_array($re)) {
$feats_array[] = $feat_r['des_it_feat'];
}


?>

<div id="non-number"> </div>

<?php

if (isset($_POST['b_atsb']) && isset($_POST['id_size']) && isset($_POST['id_qua'])) {
    $id_item     = $_GET['pitem'];
    $id_size = $_POST['id_size'];
	$id_color = $_POST['id_color'];
    $id_qua     = $_POST['id_qua']; 
	$ip_user     = $_SERVER["REMOTE_ADDR"];
	if (logged_in() == true) {
    $id_usu      = $_SESSION['user_id']; 
	} else {
	$id_usu = '0';
	}
    
    $errors = array();
    if (empty($id_item) == true || $id_size == '--Select--' || $id_qua == '--Select--') {

        $ast = 1;
        $errors[] = '<div class="errors">All fields required</div>';
		
    } else {
	
	 if (cp_exists($id_cp) == true) {
 
                    $errors[] = '<div class="errors">You have already have this item into your shopping bag. </div>';
             
            }    
    }
    
    //print_r($errors);
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error, '<br/>';
            
        }
        
        
    } else {
        //Register our user
        
        $register = cart_temp($id_item, $id_size , $id_color, $id_qua ,$ip_user , $id_usu);
		
			 if (no_available($id_item) == true) {
                   header('Location: index.php');
				   exit();    
            } 
        
        if (isset($_GET['id_item'])) {
            header('Location: view_item.php?pitem='.$id_item);
            exit();
        } else {
            header('Location: view_item.php?pitem='.$id_item);
            exit();
        }
        
    }
    
}
 
?>

<form action= '' method='POST' enctype="multipart/form-data"> 
<table border="0" width="100%" align="center" class="table_view_item">
<tr>
<td rowspan="16" class="tr_view_item"><p> 
<?php
if (isset($_GET['pitem'])) {
?>

<!-- PRUEBA -->

<div class="clearfix" id="content">
    <div class="clearfix">
        <a href="<?php
    echo 'uploads/-2/', $image_name, '.', $image_ext;
?>" id="jqzoom" title="Zoom" rel='gal1'>
            <img class="up_it_img" src="<?php
    echo 'uploads/thumbs/big/-2/', $image_name, '.', $image_ext;
?>" >
    </div>
	<br/>
 <div class="clearfix">
 
 <?php
    $images = get_view_images($id_item);
    
    if (empty($images)) {
        echo 'There are not images';
    } else {
?>
<ul id="thumblist" class="clearfix" >
		<li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php
        echo 'uploads/thumbs/big/-2/', $image_name, '.', $image_ext;
?>',largeimage: '<?php
        echo 'uploads/-2/', $image_name, '.', $image_ext;
?>'}"><img src='<?php
        echo 'uploads/thumbs/small/-2/', $image_name, '.', $image_ext;
?>'></a></li>
		

		<?php
        foreach ($images as $image) {
?>
 <li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'uploads/thumbs/big/8/<?php
            echo $image['id'] . '.' . $image['ext'];
?>',largeimage: 'uploads/8/<?php
            echo $image['id'] . '.' . $image['ext'];
?>'}"><img src='uploads/thumbs/8/<?php
            echo $image['id'] . '.' . $image['ext'];
?>'></a></li>
	
	<?php
        }
?>
	</ul>
	</div>
</div>

<?php
        $imid = $image['id'] . '<br />';
              echo '</div>';     
    }
?>
	
<!-- END Prueba -->

<?php
} 
?>

</td>
</tr>
</table>

&nbsp;

</form>

<p>&nbsp;</p>


</body>

<?php
 include 'template/footer2.php';
?>
