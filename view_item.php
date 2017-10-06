<?php
include 'init.php';
include("template/header.php");
?>conlainer_sidebar
<script>
    var id_item = <?php
json_encode($_GET['pitem']);
?>;
</script>

<div id="container">
<aside>
<div id="container_left">
<?php
include 'categories.php';
?>
</div>
</aside>

<div id="container_ditems">
<!-- <div id="main"> -->

<?php
$id_item = $_GET['pitem'];

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
    if (isset($des_pkey) == true) {
        echo '<a href="ditems.php?ptype=' . $ptype . '&pkey=' . $pkey . '&page=1">' . $des_pkey . '</a>';
    }
?>
 </ul>
 
 <li>&gt;&gt; <?php
    $obtain_data1 = "SELECT * FROM items WHERE id_item='$id_item'";
    $re = mysql_query($obtain_data1) or die("There was an error while obtaining the data items") . mysql_error();
    
    while ($campo_act = mysql_fetch_array($re)) {
        $des_item = $campo_act['des_item'];
    }
    if (isset($des_item) == true) {
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
    $id_color      = $campo_color['id_color'];
    $des_color_imc = $campo_color['des_color'];
}



//Get features 
$datos       = $_GET['pitem'];
$re          = mysql_query("SELECT id_item,des_it_feat FROM item_features WHERE id_item='$datos' AND del_est_feat= '0'");
$feats_array = array();
while ($feat_r = mysql_fetch_array($re)) {
    $feats_array[] = $feat_r['des_it_feat'];
}


//Get fabric
$datos = $_GET['pitem'];
$re    = mysql_query("SELECT it.id_item,it.id_fabric,fa.id_fabric,fa.des_fabric FROM items AS it, fabrics AS fa WHERE it.id_fabric=fa.id_fabric AND it.id_item='$datos' AND it.del_est_item= '0'");

while ($fa = mysql_fetch_assoc($re)) {
    $fabric = $fa['des_fabric'];
}

?>

<div id="non-number"> </div>

<?php

if (isset($_POST['b_atsb']) && isset($_POST['id_size']) && isset($_POST['id_qua'])) {
    $id_item  = $_GET['pitem'];
    $id_size  = $_POST['id_size'];
    $id_color = $_POST['id_color'];
    $id_qua   = $_POST['id_qua'];
    $ip_user  = $_SERVER["REMOTE_ADDR"];
    if (logged_in() == true) {
        $id_usu = $_SESSION['user_id'];
    } else {
        $id_usu = '0';
    }
    
    $errors = array();
    if (empty($id_item) == true || $id_size == '--Select--' || $id_qua == '--Select--') {
        
        $ast      = 1;
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
        
        $register = cart_temp($id_item, $id_size, $id_color, $id_qua, $ip_user, $id_usu);
        
        if (no_available($id_item) == true) {
            header('Location: index.php');
            exit();
        }
        
        if (isset($_GET['id_item'])) {
            header('Location: view_item.php?pitem=' . $id_item);
            exit();
        } else {
            header('Location: view_item.php?pitem=' . $id_item);
            exit();
        }
        
    }
    
}

?>

<form action= '' method='POST' enctype="multipart/form-data"> 
<table class="table_view_item">
<tr>
<td rowspan="16">
<?php
if (isset($_GET['pitem'])) {
?>
<!-- PRUEBA -->
<div class="clearfix" id="content">
    <div>
        <a href="<?php
    echo 'uploads/-2/', $image_name, '.', $image_ext;
?>" id="jqzoom" title="Zoom" rel='gal1'>
    <img class="up_it_img" src="<?php
    echo 'uploads/thumbs/big/-2/', $image_name, '.', $image_ext;
?>" >
    </div>
<!-- Division entre imagen grande e imagenes pequenas -->
 <div>

 <?php
    $images = get_view_images($id_item);
    
    if (empty($images)) {
        echo 'There is any item to perform';
    } else {
?>
<ul id="thumblist"  >
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
        
    }
?>
	
<!-- END Prueba -->

<?php
}
?>

</td>
</tr>
</table>


<table class="table_view_item1">
<tr>
<td colspan="2"> <div class="pro_des"> <?php
if (isset($des_item)) {
    echo $des_item;
}
?> </div></td> 
</tr>

<tr>
 <td><div class="th_view_item"><strong>Product code </strong></div></td><td> <div class="th_view_item"> <?php
if (isset($_GET['pitem'])) {
    if (isset($id_item) == true) {
        echo $id_item;
    }
}
?> </div> </td>
 </tr>
 
 <tr>
 <td> <div class="th_view_item"> <div class="p_price"> <?php
if (isset($pri_it)) {
    echo '<strong>US$' . number_format($pri_it, 2) . '</strong>';
}
?>  </div> <div class="little_p">Price</div> </div> </td>
 </tr>
 
 <?php
if (!empty($feats_array) == true) {
?> 
 <tr>
 <td colspan="2"><strong>Features</strong></td> 
 </tr>
 <tr>
 <td colspan="2"> <div class="th_view_item"> <?php
    if (isset($feats_array)) {
        foreach ($feats_array as $feat) {
            echo '<ul class="feat_list">';
            echo '<li>' . $feat . '</li>';
            echo '</ul>';
        }
    }
?> </div>
 </td>
 </tr>
 <?php
}
?> 


<?php
if (!empty($fabric) == true) {
?> 
 <tr>
 <td colspan="2"><strong>Fabric</strong></td> 
 </tr>
 <tr>
 <td colspan="2"> <div class="th_view_item"> <?php
    if (isset($fabric)) {
        echo $fabric;
    }
?> </div>
 </td>
 </tr>
 <?php
}
?> 
 
  
 <?php
$sql = mysql_query("SELECT DISTINCT(si.id_size), si.des_size, itd.id_size, itd.id_qua FROM items_detail AS itd, sizes AS si WHERE itd.del_est_itd = '0' AND itd.id_item='$id_item' AND si.id_size=itd.id_size AND itd.id_qua <> '0' ORDER BY si.id_size ASC");
if (mysql_num_rows($sql) == 1) {
    
    //Separate
    $sql1 = "SELECT DISTINCT(si.id_size), si.des_size, itd.id_size, itd.id_qua FROM items_detail AS itd, sizes AS si WHERE itd.del_est_itd = '0' AND itd.id_qua <> '0' AND itd.id_item='$id_item' AND si.id_size=itd.id_size";
    $re = mysql_query($sql1) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
        $des_size = $campo['des_size'];
        $id_size  = $campo['id_size'];
?>
<tr>
 <td colspan="2"> <div class="th_view_item">
Fits Girls <?php
        if (isset($des_size)) {
            echo '<strong>' . $des_size . '</strong>';
?><input type = "hidden" name= "id_size" value=<?php
            echo $id_size;
?> />
<input type = "hidden" name="id_color" value=<?php
            echo $id_color;
?> />

<?php
        }
?>X 
</div></td>
 </tr>
 
 <?php
    }
} else {
    //Separate
    $sql2 = "SELECT cp.id_item, cp.id_size, si.id_size,si.des_size FROM cart_process AS cp, sizes AS si WHERE si.id_size=cp.id_size AND cp.id_item='$id_item'";
    $re = mysql_query($sql2) or die("There was an error") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
        $q_siz = '1';
        echo $cart_sizes = $campo['des_size'];
    }
?>

  <tr>
<td colspan="2"><strong>Size</strong></td>
 </tr>
 <tr>
 <td colspan="2"> <div class="th_view_item">
<!-- SELECT HERE --> 
	<input type="hidden" value="<?php
    echo $_GET['pitem'];
?>" id="iditem" />
		<select name="id_size"  id="search_category_id">
		<option selected="selected">--Select--</option>
		<?php
    $id_item = $_GET['pitem'];
    $query   = "SELECT DISTINCT(si.id_size), si.des_size,itd.id_item,itd.id_size FROM sizes  AS si,items_detail AS itd WHERE  itd.id_item='$id_item' AND si.id_size=itd.id_size AND itd.del_est_itd = '0' AND si.del_est_size = '0'";
    $results = mysql_query($query);
    
    while ($rows = mysql_fetch_assoc(@$results)) {
?>
			<option value="<?php
        echo $rows['id_size'];
?>"
			<?php
        if (isset($id_size) == true) {
            if ($rows['id_size'] == $id_size) {
                echo "SELECTED";
            }
        }
?> /> 

<?php
        echo $rows['des_size'];
?></option>
<?php
    }
?>
		</select>	

<?php
    if (isset($des_size) == true) {
        if ($des_size == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?> 
</div></td></tr>

 <?php
}

// if there is only one color
$sql_qo = "SELECT COUNT(`id_item`) FROM items_detail WHERE id_item='$id_item' AND id_qua <> '0' AND del_est_itd = '0'";
$re_qo = mysql_query($sql_qo) or die("Error al ejecutar consulta k") . mysqlerror();
if (mysql_result($re_qo, 0) == 1) {
?>
<tr>
<td colspan="2"><strong>Color</strong></td>
</tr>
<tr>
<td colspan="2"> <div class="th_view_item">
<?php
    if (isset($id_size) == false) {
        $id_size = '0';
    }
    $query   = "SELECT co.id_color,co.des_color, itd.id_color FROM colors AS co, items_detail AS itd WHERE co.id_color = itd.id_color AND itd.id_item='$id_item' AND itd.id_size='$id_size'";
    $results = mysql_query($query);
    while ($rows = mysql_fetch_assoc(@$results)) {
        echo '<input type="hidden" name="id_color" value="' . $id_color . '" />';
        echo $des_color;
    }
    
} else {
    
?>
 </div>
 <!-- COLORS -->
<tr>
<td colspan="2"><strong>Colors</strong></td>
</tr>
<tr>
<td colspan="2"> <div class="th_view_item">
	<div id="show_sub_categories_color" align="left">
    <?php
    if (isset($id_size) == false) {
        $id_size = '0';
    }
    $query   = "SELECT co.id_color,co.des_color, itd.id_color FROM colors AS co, items_detail AS itd WHERE co.id_color = itd.id_color AND itd.id_item='$id_item' AND itd.id_size='$id_size'";
    $results = mysql_query($query);
?>
    <select name="id_color"  id="sub_category_idcolor">
		<option selected="selected">--Select--</option>
		<?php
    while ($rows = mysql_fetch_assoc(@$results)) {
?>
    <option value="<?php
        echo $rows['id_color'];
?>"><?php
        echo $rows['des_color'];
?></option>
<?php
    }
?>
	</select>
	
			<img src="images/zoomloader1.gif" style="margin-top:8px; float:left" id="loader1" alt="" />
		</div>
<?php
    if (isset($id_color) == true) {
        if ($id_color == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
    
}

?> 
<a href="#">  Color Palette</a></div></td></tr>
<!-- END COLORS -->
<?php
//Aki colors
$sql1 = mysql_query("SELECT COUNT(id_item),id_qua FROM items_detail WHERE del_est_itd = '0' AND id_item='$id_item' AND id_qua <> '0' AND id_qua = '1'");
if (mysql_result($sql1, 0) == 1) {
    echo '<input type="hidden" name="id_qua" value="1" />';
} else {
    
    
?>
<tr>
<td colspan="2"><strong>Quantity</strong></td>
</tr>
<tr>
<td colspan="2"> <div class="th_view_item">
	<div id="show_sub_categories" align="left">
    <?php
    if (isset($id_size) == false) {
        $id_size = '0';
    }
    $query   = "SELECT DISTINCT(si.id_size), it.id_item, itd.id_qua, itd.id_size,itd.id_color, itd.id_item FROM items AS it, sizes AS si, items_detail AS itd WHERE it.id_item=itd.id_item AND si.id_size=itd.id_size AND it.id_item = '$id_item' AND itd.id_size = '$id_size' AND itd.id_color='$id_color'";
    $results = mysql_query($query);
?>
	
	<select name="id_qua"  id="sub_category_id">
		<option selected="selected">--Select--</option>
		<?php
    while ($rows = mysql_fetch_assoc(@$results)) {
        $sort = 1;
        while ($sort <= $rows['id_qua']) {
?>
    <option value="<?php
            echo $sort;
?>"> <?php
            echo $sort;
?> </option>
	<?php
            $sort = $sort + 1;
        }
    }
?>
	</select>
    <img src="images/zoomloader1.gif" style="margin-top:8px; float:left" id="loader2" alt="" />
	</div>

<?php
    if (isset($id_qua) == true) {
        if ($id_qua == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
}
?> 
</div></td>
</tr>

<tr>
<td colspan="2">
<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
//echo $actual_link;
if (logged_in() == true && user_activated($user_id) == true) {
?>
<input type="submit" value="Add to Bag" accesskey="a" name="b_atsb" title="alt + a" tabindex="5" class="b_right" />
<?php
} else {
    
    if (logged_in() == true && user_activated($user_id) == false) {
        echo '<a href="user_activation.php?messagesend"><input type="button" disabled="disabled" value="Add to Bag" accesskey="a" name="b_atsb" title="Please validate your Email to begin Shopping" tabindex="5" class="disabled_b_right" /></a>';
    } else {
        
        if (logged_in() == false) {
            echo '<a href="signin.php?shop=shopping"><input type="button" disabled="disabled" value="Add to Bag" accesskey="a" name="b_atsb" title="Please sign in to begin Shopping" tabindex="5" class="disabled_b_right" /></a>';
        }
    }
}
?>
</td>

</tr>

<tr>
<td colspan="2"></td>
</tr>

<tr>
<td colspan="2"></td>
</tr>

</table>


<p>&nbsp;</p>

</form>
<!-- </div> -->


<!-- COMMENTS -->

<div class="customer_comments">

<?php
$ip_user = $_SERVER["REMOTE_ADDR"];
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
if (!logged_in() == true) {
    echo '<p>&nbsp;</p>';
    echo '<div class="no_items">Share your experience! Just <a href="signin.php"><strong>Sign in</strong></a> to begin </div>';
    
} else {
    
    if (logged_in() == true && user_activated($user_id) == false) {
        echo '<p>&nbsp;</p>';
        echo '<div class="no_items">Please validate your account to perform this action</div>';
    } else {
        $id_usu = $_SESSION['user_id'];
        
        //Asking if infomation has beens saved or updated correctly
        if (isset($_GET['saved']) == true && $_GET['saved'] == true) {
            echo '<div class="success" id="success"> Thanks for posting your comment </div>';
        } else {
            
            if (isset($_GET['updated']) == true && $_GET['updated'] == true) {
                echo '<div class="success" id="success"> You have successfully updated your post </div>';
            } else {
                
                if (isset($_GET['deleted']) == true && $_GET['deleted'] == true) {
                    echo '<div class="success" id="success"> You have successfully deleted your post  </div>';
                }
            }
        }
        
        
        //Recoger los datos para actualizar
        if (isset($_GET['id_com'])) {
            
            $datos       = $_GET['id_com'];
            $obtain_data = "SELECT * FROM comments WHERE id_com='$datos'";
            
            $re = mysql_query($obtain_data) or die("There was an error while obtaining the data") . mysql_error();
            while ($campo_act = mysql_fetch_array($re)) {
                
                $id_com  = $campo_act['id_com'];
                $tit_com = $campo_act['tit_com'];
                $mes_com = $campo_act['mes_com'];
                
                
                $bclass       = 'update';
                $enviar_value = 'Update';
                //$limpiar_tb= submit;
                
            }
            
        } else {
            
            $enviar_value = 'Save';
            $bclass       = 'save';
            //$limpiar_tb= reset;
        }
        
        //Post
        if (isset($_POST['id_com'], $_POST['tit_com'], $_POST['mes_com'])) {
            $id_com  = $_POST['id_com'];
            $tit_com = $_POST['tit_com'];
            $mes_com = $_POST['mes_com'];
            $user_id = $_SESSION['user_id'];
            
            
            $errors = array();
            
            if (empty($id_com) || empty($tit_com) || empty($mes_com)) {
                
                //echo $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                
                $ast      = '1';
                $errors[] = '<div class="errors">All filds required</div>';
            } else {
                
                
                if (comm_exists($id_com) == true) {
                    if (empty($_GET['id_com'])) {
                        //est_exists is the function we created on user functions
                        $nue      = 1;
                        $errors[] = '<div class="errors">This comment already exists</div>';
                    }
                }
                
            }
            
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo $error, '<br/>';
                    
                }
                
                
            } else {
                
                $register = comm_register($id_com, $id_item, $user_id, $tit_com, $mes_com);
                // $_SESSION['id'] = $register;       Inicia una sesion con el id especificado
                
                //$url = substr("$_SERVER[REQUEST_URI]", 4);
                
                if ($enviar_value == 'Save') {
                    //header('Location: '.$url.'&saved=true');
                    header('Location: view_item.php?pitem=' . $id_item . '&saved=true#success');
                    exit();
                } else {
                    //header('Location: '.$url.'&updated=true'); 
                    header('Location: view_item.php?pitem=' . $id_item . '&updated=true#success');
                    exit();
                }
                
                
            }
            
        }
        
        //Obtener el maximo auto id
        $query_max_id = mysql_query("SELECT MAX(`comments`.`id_com`) FROM `comments`");
        $resultado    = mysql_fetch_array($query_max_id);
        $cur_auto_id  = $resultado['MAX(`comments`.`id_com`)'] + 1;
        
        $url = substr("$_SERVER[REQUEST_URI]", 4);
?>


<form action= "" method="post">
<input type="hidden" <?php
        if (isset($_GET['id_com'])) {
            echo 'readonly="readonly"';
        }
?> id="id-com" class=" <?php
        if (isset($_GET['id_com'])) {
            echo 'disabled';
        }
?>" name="id_com" size="10px" value="<?php
        if (isset($_GET['id_com'])) {
            echo $id_com;
        } else {
            printf("%05s", $cur_auto_id);
        }
?>">

<table border="0" class="test_table1" id="edit">
<thead>
 <tr>
 <th colspan="2"> Costumer comments </th>
 </tr>
 
</thead>
<tbody>
<tr>
<td>Title</td>
</td>
<tr>
<td><input type="text" name="tit_com" maxlength= "40" value="<?php
        if (isset($tit_com)) {
            echo $tit_com;
        }
?>" /></td>
</tr> 

<td>Comment</td>
</td>
<tr>
<td><textarea name="mes_com" onkeypress="return imposeMaxLength(this, 299)"; class="gtextarea"><?php
        if (isset($mes_com)) {
            echo $mes_com;
        }
?></textarea></td>
</tr> 

<tr>
<td><input type="submit" value="<?php
        if (isset($enviar_value)) {
            echo $enviar_value;
        }
?>" name="<?php
        echo $bname;
?>" class="bestandar" /></td>
</tr>

</tbody>
</table>
</form>


<?php
    }
}

$url = substr("$_SERVER[REQUEST_URI]", 4);

?>
<p>&nbsp;</p>
<?php
echo '<table border="0" class="test_table2">
<tr>
<td colspan="4" class="test_bar">Comments</td> 
</tr>
';
$sql = "SELECT co.id_com,co.id_item,co.user_id, co.tit_com, co.mes_com, co.date, co.time, us.user_id, uf.user_id, us.name, us.lastname, uf.user_city, uf.user_state  FROM comments AS co, users AS us, users_inf AS uf WHERE co.user_id=us.user_id AND uf.user_id=us.user_id AND co.id_item='$id_item' AND del_est_com=0 ORDER BY co.id_com DESC";
$re = mysql_query($sql) or die("Error al ejecutar consulta 3") . mysql_error();
if (mysql_num_rows($re) == 0) {
    echo '<tr>
 <td colspan="4">No comments to perform</td>
 </tr>';
} else {
    while ($campo2 = mysql_fetch_array($re)) {
        echo '<tr class="test_hover">
 <th width="15%" class="test_td"><div class="test_strong">' . $campo2['name'] . ' ' . $campo2['lastname'] . '</div><p>' . $campo2['user_city'] . ', ' . $campo2['user_state'] . '</p></th> <th width="60%"><div class="test_tit">' . $campo2['tit_com'] . '</div></th> <th width="12%"><div class="test_date">' . $campo2['date'] . '</div></th> <th width="18%">';
        if (logged_in() && $campo2['user_id'] == $_SESSION['user_id']) {
            echo '<div class="tes_ico"><a href="view_item.php?pitem=' . $id_item . '&id_com=' . $campo2['id_com'] . '#edit">' . '<img src="images/icons/Edit/Copy of edit-file-icon.png"/></a></div>';
        }
        if (logged_in() && $campo2['user_id'] == $_SESSION['user_id']) {
            echo '<div class="tes_ico"><a onclick="return button_confirm()" href="delete.comm.php?id_item=' . $id_item . '&id_com=' . $campo2['id_com'] . '#success">' . '<img src="images/icons/Delete/Copy of Delete_16x16.png"/></a></div>';
        }
        echo '</th> 
 </tr><tr class="test_hover">
 <td class="test_td"></td> <td>' . $campo2['mes_com'] . '</td> <td></td> <td></td> 
 </tr>';
    }
}
?> </table>

<!-- COMMENTS END -->

</div>

</div>
</body>

<?php
include 'template/footer.php';
?>
