<?php
include 'init.php';
if (logged_in_system()) {
    
    
    if (isset($_POST['bnuevo'])) {
        header('Location:upload_item.php');
        exit();
    }
    
    include 'template/header.php';
    
    
    if (isset($_GET['registered']) == true ? $_GET['registered'] == true : false) {
        echo '<div class="success"> Your item has been successfully registered </div>';
    } else {
        if (isset($_GET['updated']) == true ? $_GET['updated'] == true : false) {
            echo '<div class="success"> Your settings have been succecfully updated </div>';
        } else {
            if (isset($_GET['deleted']) == true ? $_GET['deleted'] == true : false) {
                echo '<div class="success"> Item successfully deleted </div>';
            }
        }
    } 
?>

<h3> Subir art&iacute;culos</h3>

<?php
    
    //Recoger los datos para actualizar
    if (isset($_GET['id_item']) && !isset($_POST['id_item'])) {
        
        $datos       = $_GET['id_item'];
      //  $obtain_data = "SELECT it.id_item,it.id_oct,it.image_id,it.des_item,it.id_fabric,it.cos_it,it.pri_it,itc.id_item,itc.del_est_it_col,itc.id_color,im.image_id,im.ext,fa.id_fabric FROM items AS it, item_avi_colors AS itc,images AS im,fabrics AS fa WHERE it.id_item=itc.id_item AND it.image_id=im.image_id AND it.id_fabric=fa.id_fabric AND itc.del_est_it_col='0' AND it.id_item='$datos'";
	    $obtain_data = "SELECT it.id_item,it.id_oct,it.image_id,it.des_item,it.id_it_type,it.id_ist,it.id_istc,it.id_fabric,it.cos_it,it.pri_it,imc.id_item,imc.del_est_it_ma_co,imc.id_color,im.image_id,im.ext,fa.id_fabric FROM items AS it, item_main_color AS imc,images AS im,fabrics AS fa WHERE it.id_item=imc.id_item AND it.image_id=im.image_id AND it.id_fabric=fa.id_fabric AND imc.del_est_it_ma_co='0' AND it.id_item='$datos'";
        
        
        $re = mysql_query($obtain_data) or die("There was an error while obtaining the data general") . mysql_error();
        
        while ($campo_act = mysql_fetch_array($re)) {
            
            $id_item    = $campo_act['id_item'];
            $id_oct     = $campo_act['id_oct'];
            $id_fabric  = $campo_act['id_fabric'];
            $des_item   = $campo_act['des_item'];
			$id_it_type = $campo_act['id_it_type'];
			$id_ist     = $campo_act['id_ist'];
			$id_istc    = $campo_act['id_istc'];
            $cos_it     = $campo_act['cos_it'];
            $pri_it     = $campo_act['pri_it'];
            $image      = $campo_act['image_id'] . '.' . $campo_act['ext'];
            $image_name = $campo_act['image_id'];
            $image_ext  = $campo_act['ext'];
            $id_color   = $campo_act['id_color'];
            
        }
        
        
        $bclass       = 'update';
        $enviar_value = 'Actualizar';
        $bname        = 'bact';
        
    } else {
        
        $enviar_value = 'Registrar';
        $bclass       = 'save';
        $bname        = 'breg';
        
    }
    
    
    
    //Recoger datos de caracteristicas
    if (isset($_GET['id_item']) && !isset($_POST['id_item'])) {
        
        $datos = $_GET['id_item'];
        
        $obtain_data_1 = "SELECT id_item,des_it_feat FROM item_features WHERE id_item='$datos' AND del_est_feat = '0'";
        
        $re1 = mysql_query($obtain_data_1) or die("There was an error while obtaining the data features") . mysql_error();
        
        $feats = array();
        while ($campo_act1 = mysql_fetch_array($re1)) {
            
            $feats[] = $campo_act1['des_it_feat'];
        }
        
        
        $bclass       = 'update';
        $enviar_value = 'Actualizar';
        $bname        = 'bact';
        
    } else {
        
        $enviar_value = 'Siguiente';
        $bclass       = 'next';
        $bname        = 'breg';
    }
    
    //Recoger datos color principal
    
    isset($_GET['id_item']) == true ? $datos = $_GET['id_item'] : false;
    if (isset($datos) == true) {
        $obtain_data_co = "SELECT it.id_item,imc.id_color FROM items AS it, item_main_color AS imc WHERE it.id_item=imc.id_item AND it.del_est_item=0 AND it.id_item='$datos'";
        
        $re_co = mysql_query($obtain_data_co) or die("There was an error while obtaining color data") . mysql_error();
        
        while ($campo_color = mysql_fetch_array($re_co)) {
            $id_it_ma_co = $campo_color['id_color'];
        }
        
    }
    
?>

<div id="non-number"> </div>
<div id="non-cero"> </div>
<div id="non-positive"> </div>
<div id="cos-menor-pri"> </div>

<?php
    
    if (isset($_POST['id_item'])) {
   
        $id_item     = $_POST['id_item'];
        $id_oct      = $_POST['id_oct'];
        $id_fabric   = $_POST['id_fabric'];
        $id_it_type  = $_POST['id_it_type'];  
		$id_ist      = $_POST['id_ist'];
		$id_istc     = $_POST['id_istc'];
        $des_item    = $_POST['des_item'];
        $cos_it      = $_POST['cos_it'];
        $pri_it      = $_POST['pri_it'];
        $id_usu      = $_SESSION['id'];
        $feats       = $_POST['feats'];
	    $id_it_ma_co = $_POST['id_it_ma_co'];
        
		
        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_temp = $_FILES['image']['tmp_name'];
        
        $allowed_ext = array(
            'jpg',
            'jpeg',
            'png',
            'gif'
        );
        $image_ext   = strtolower(end(explode('.', $image_name)));
        $album_id    = -2;
        
        //If other images exist  
        if (isset($_FILES['sec_images'])) {
            
            foreach ($_FILES['sec_images']['name'] as $key => $name) {
                
                $r_image_name[] = $_FILES['sec_images']['name'];
                $r_image_size[] = $_FILES['sec_images']['size'];
                $r_image_temp[] = $_FILES['sec_images']['tmp_name'];
                $r_allowed_ext  = array(
                    'jpg',
                    'jpeg',
                    'png',
                    'gif'
                );
                $r_image_ext[]  = strtolower(end(explode('.', $name)));
                $sec_album_id[] = 8;
                
            }
        }
        
        
        $errors = array();
        
        
        if (empty($id_item) == true || $id_oct == '--Select--'  || $id_fabric == '--Select--'  || empty($id_it_type) == true || empty($des_item) == true || empty($feats) == true || empty($cos_it) == true || empty($pri_it) == true) {
            
		//	print_r(array_filter($sizqua));
	
            
            $ast      = 1;
            $errors[] = '<div class="errors">All fields required</div>';
        } else {
            
            
            if (in_array($image_ext, $allowed_ext) === false && empty($_GET['id_item'])) {
                
                $errors[] = '<div class="errors">Tipo de archivo no es admitido</div>';
                
            }
            
            if ($image_size > 3097152) {
                $errors[] = '<div class="errors">Maximimun file size is 3 MB</div>';
                
            }
            
            if ($album_id != -2) {
                if (album_check($album_id) == false) {
                    $errors[] = 'Could\'t upload to that album' . $album_id;
                }
            }
            
            
            
            if (upit_exists($id_item) == true) {
                if (empty($_GET['id_item'])) {
                    //est_exists is the function we created on user functions
                    $nue      = 1;
                    $errors[] = '<div class="errors">The item with the code ' . '<strong>' . $id_item . '</strong>' . ' already exists</div>';
                }
            }
            
        }
        
        
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error, '<br/>';
                
            }
            
            
        } else {
            //Register our item
            
            //Obtener el maximo de las images
            $q_mi      = mysql_query("SELECT MAX(`images`.`image_id`) FROM `images`");
            $r_mi      = mysql_fetch_array($q_mi);
            $max_image = $r_mi['MAX(`images`.`image_id`)'] + 1;
            
            
            upload_image($image_temp, $image_ext, $album_id);
            
            
            $register = upit_register($id_item, $max_image, $id_oct, $id_fabric, $id_it_type, $id_ist, $id_istc, $des_item, $id_it_feat, $cos_it, $pri_it, $id_usu, $id_it_ma_co ,$feats);
            
            //Upload other images
            upload_secun_images($r_image_temp, $r_image_ext, $sec_album_id, $id_item);
            // $_SESSION['id'] = $register;       Inicia una sesion con el id especificado
            
            
            if (isset($_GET['id_item']) == true) {
                header('Location: upload_item.php?updated=true');
                exit();
            } else {
                header('Location: upload_item_details.php?id_item='.$id_item.'&id_color='.$id_it_ma_co);
                exit();
            }
            
        }
        
    }
    
    //Obtener el maximo auto id
    $query_max_id = mysql_query("SELECT MAX(`items`.`id_item`) FROM `items`");
    $resultado    = mysql_fetch_array($query_max_id);
    $cur_auto_id  = $resultado['MAX(`items`.`id_item`)'] + 1;
    ?>

<?php
    if (isset($_POST['limpiar'])) {
        unset($id_item);
        unset($des_oct);
    }
?>

<form method="POST" enctype="multipart/form-data" name="f1">
    
<table border="1" width="100%" align="center" class="uptable">
<tr>
<td rowspan="13" class="trpic" width="10%"><p> 
<?php
        if (isset($_GET['id_item'])) {
        echo 'Your item:';
        echo '<div id="div_up_it_img">';
        
        echo '<a href="uploads/-2/', $image_name, '.', $image_ext, '" alt=""><img class="up_it_img1" src="uploads/-2/', $image_name, '.', $image_ext, '" alt="" class="previewmat" /> </a>';
        echo '</div>';
        
        echo '<input type="file" name="image" readonly="readonly" />';
        
    } else {
?>
<p class="select_file">Selecciona un archivo: </p>
<input type="file" name="image" value="<?php
        if (isset($image)) {
            echo $image;
        }
?>" autofocus="autofocus" /> 

<p class="select_file">Imagenes secundarias: </p>
<input type="file" name="sec_images[]" multiple="multiple" />

<div class="divpic"></div>
<?php
    }
?>
</td>
</tr>

<tr>
 <td width="5%" class="trstanbla">Codigo: </td><td width="60%"><input type="text" <?php
    if (isset($_GET['id_item'])) {
        echo 'readonly="readonly"';
    }
?> id="id-item" class=" <?php
    if (isset($_GET['id_item'])) {
        echo 'disabled';
    }
?>" name="id_item" size="10px" value="<?php
    if (isset($_GET['id_item'])) {
        echo $id_item;
    } else {
        printf("%011s", $cur_auto_id);
    }
?>">
 </tr>
 
<tr>
<td class="trstanbla"> Departamento: </td> <td> <select name="id_it_type" tabindex="2">

<option> --Select-- </option>

<?php
    $sql = "SELECT id_it_type, des_it_type FROM item_type WHERE del_est_it_type = 0 ORDER BY des_it_type ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_it_type'];
?>" <?php
        if (isset($id_it_type) == true) {
            if ($campo['id_it_type'] == $id_it_type) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_it_type'];
    }
?>
</option>
</select> <?php
    if (isset($id_it_type) == true) {
        if ($id_it_type == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?>  </td>
</tr>

<tr>
<td class="trstanbla"> Categor&iacute;a: </td> <td> 
<select name="id_ist" tabindex="2">

<option> --Select-- </option>

<?php
    $sql = "SELECT id_ist,des_ist FROM item_sub_type WHERE del_est_ist = 0 ORDER BY des_ist ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 2") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_ist'];
?>" <?php
        if (isset($id_ist) == true) {
            if ($campo['id_ist'] == $id_ist) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_ist'];
    }
?>
</option>
</select> <?php
    if (isset($id_ist) == true) {
        if ($id_ist == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?>  </td>
</tr>

<tr>
<td class="trstanbla"> Grupo categor&iacute;a: </td> <td> 
<select name="id_istc" tabindex="2">

<option> --Select-- </option>

<?php
    $sql = "SELECT id_istc,des_istc FROM item_sub_type_cat WHERE del_est_istc = 0 ORDER BY des_istc ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 3") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_istc'];
?>" <?php
        if (isset($id_oct) == true) {
            if ($campo['id_istc'] == $id_oct) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_istc'];
    }
?>
</option>
</select> <?php
    if (isset($id_istc) == true) {
        if ($id_istc == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?>  </td>
</tr> 


<tr>
<td class="trstanbla"> Descripci&oacute;n: </td> <td> <textarea name="des_item" onkeypress="return imposeMaxLength(this, 54)"; tabindex="0" class="gtextarea_smaller"><?php
    if (isset($des_item)) {
        echo $des_item;
    }
?></textarea> </td>
</tr>



<tr>

<td class="trstanbla">Caracteristicas</td>
<td>
<table width="100%" class="table_none">
<tr>
<td id="td1" width="60%"></td>
<td>
<input name="b1" type="button" onClick="createtext()" value="+" tabindex="1" >
<input name="b2" type="button" value="-" id="removetext" tabindex="1" >
</td>
</tr>
</table>
</td>
<tr>
<td class="trstanbla"><p>Ocasi&oacute;n: </td> <td>

<select name="id_oct" tabindex="2">

<option> --Select-- </option>

<?php
    $sql = "select id_oct,des_oct from occations WHERE del_est_oct = 0 ORDER BY des_oct ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_oct'];
?>" <?php
        if (isset($id_oct) == true) {
            if ($campo['id_oct'] == $id_oct) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_oct'];
    }
?>
</option>
</select> <?php
    if (isset($id_oct) == true) {
        if ($id_oct == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?> 

</td>  </td>
</tr>

<tr>
<td class="trstanbla"><p>Material: </td> 
<td> <select name="id_fabric" tabindex="4">

<option> --Select-- </option>

<?php
    $sql = "select id_fabric,des_fabric from fabrics WHERE del_est_fabric = 0 ORDER BY des_fabric ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_fabric'];
?>" <?php
        if (isset($id_fabric)) {
            if ($campo['id_fabric'] == $id_fabric) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_fabric'];
    }
?>
</option>
</select> <?php
    if (isset($id_fabric) == true) {
        if ($id_fabric == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?> 

</td>  </td>
</tr>

<tr>
<td class="trstanbla"><p>Color: </td> <td>

<select name="id_it_ma_co" tabindex="5" id="payments">

<option> --Select-- </option>

<?php
    $sql = "SELECT co.id_color, co.image_id, co.des_color, co.del_est_color, im.image_id, im.ext
FROM colors AS co, images AS im
WHERE co.image_id = im.image_id
AND co.del_est_color =0
ORDER BY co.des_color ASC 
LIMIT 0 , 30";

    $re = mysql_query($sql) or die("There was an error 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_color'];
?>" <?php
        if (isset($id_it_ma_co)) {
            if ($campo['id_color'] == $id_it_ma_co) {
                echo "SELECTED";
            }
        }
	
	//uploads/thumbs/color/-2/<?php echo $image_id.'.'.$ext; 
	
?>  data-image="uploads/thumbs/color/-2/<?php echo $campo['image_id'].'.'.$campo['ext']; ?>" > <?php
        echo $campo['des_color'];
    }
?>
</option>
</select>  <?php
    if (isset($id_it_ma_co)) {
        if ($id_it_ma_co == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?> 

</td>  </td>
</tr>

<tr>
 <td width="20%" class="trstanbla">Costo: </td><td><input class="input_number" type="text" id="cos-it" name="cos_it" tabindex="7" value="<?php
    if (isset($cos_it)) {
        echo $cos_it;
    }
?>">
 </tr>
 
<tr>
 <td width="20%" class="trstanbla">Precio: </td><td><input class="input_number_pri" tabindex="8" type="text" id="pri-it" name="pri_it" value="<?php
    if (isset($pri_it)) {
        echo $pri_it;
    }
?>">
 </tr>
<tr>
<td></td>
<td></td>
<td></td>
</tr>

</table>

&nbsp;

<td colspan="2" class="trstanbla">
<div class="b_center">
<input type="submit" value="Nuevo" accesskey="u" name="bnuevo" title="alt + u" tabindex="10" class="<?php
    if (!isset($_GET['id_item'])) {
        echo 'd_new';
    } else {
        echo 'new';
    }
?> " <?php
    if (!isset($_GET['id_item'])) {
        echo 'disabled="disabled"';
    }
?>  />

<input type="submit" value="<?php
    echo $enviar_value;
?>" id="<?php
    echo 'up-item-submit'; //if ($bclass == bguardar) {echo 'up-item-submit';} 
?>" accesskey="r" title ="alt + r" name="<?php
    echo $bname;
?>" tabindex="9" class=" <?php
    echo $bclass;
?>" />

<!--  name=benviar -->

<a tabindex="12" class="bnada" href="delete.up.item.php?id_item=<?php
    echo $datos;
?>&image_id=<?php
    echo $image_name;
?>">

<input type="button" value="Eliminar" title="alt + i" accesskey="i" tabindex="12" class="<?php
    if (!isset($_GET['id_item'])) {
        echo 'd_delete';
    } else {
        echo 'delete';
    }
?> " <?php
    if (!isset($_GET['id_item'])) {
        echo 'disabled="disabled"';
    }
?> name="beliminar" onclick="return confirm('¿Seguro que desea eliminar este articulo?')" /></a>

<input type="reset" value="Limpiar" title="alt + l" accesskey="l" tabindex="11" name="limpiar" class="<?php
    if (!isset($_GET['id'])) {
        echo 'clear';
    } else {
        echo 'd_clear';
    }
?> " />
</div>
</td>
</tr>
</form>


&nbsp;
&nbsp;

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<table border="0" align="center" class="display" width="100%" id="datatables">
<thead>
 <tr>
 <th width="5%"> <strong>Codigo</strong> </th>   <th width="50%"> <strong>Descripcion </strong></th>  <th width="40%"> <strong>Ocasion </strong></th>  <th width="5%"> <strong>Editar </strong></th>
 </tr>
</thead>
<tbody>
<?php
    $sql = mysql_real_escape_string($sql);
    
    
    $sql = "SELECT it.id_item,it.des_item,it.id_oct,it.des_item,oc.id_oct,oc.des_oct FROM items  AS it, occations AS oc WHERE it.del_est_item=0 AND it.id_oct=oc.id_oct ORDER BY it.id_item DESC";
    
    
    $re = mysql_query($sql) or die("There was an error while obtaing the data 3") . mysql_error();
    
    while ($campo2 = mysql_fetch_array($re)) {
        echo '<tr class="tr1"><td width="5%" class="td1">' . $campo2['id_item'] . '</td> <td width="50%">' . $campo2['des_item'] . '</td> <td width="40%">' . $campo2['des_oct'] . '</td> <td width="5%">' . '<a tabindex="20" href="upload_item.php?id_item=' . $campo2['id_item'] . '">' . '<img src="images/icons/Edit/edit-file-icon.png"/></a>' . '</td> </tr>';
    }
?>
</tbody>
</table>

<script type='text/javascript'>
<?php
    $js_array = json_encode($feats);
    echo "var javascript_array = " . $js_array . ";\n";
?>
</script>

<p>&nbsp;</p>
<?php
    include 'template/footer2.php';
    
} else {
    header('Location: index.php');
    exit();
}
?>


