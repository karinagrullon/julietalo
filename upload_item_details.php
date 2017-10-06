<?php
include 'init.php';
if (logged_in_system()) {
    include 'template/header.php';
?>

<h3> Detalles items </h3>

<?php  
    //Recoger los datos para actualizar
    if (isset($_GET['id_itd'])) {
        
        $datos       = $_GET['id_itd'];
        $obtain_data = "SELECT * FROM items_detail WHERE id_itd='$datos'";
        
        $re = mysql_query($obtain_data) or die("There was an error while obtaining the data") . mysql_error();
        while ($campo_act = mysql_fetch_array($re)) {
            
            $id_itd   = $campo_act['id_itd'];
            $id_item  = $campo_act['id_item'];
            $id_size  = $campo_act['id_size'];
            $id_color = $campo_act['id_color'];
            $id_qua   = $campo_act['id_qua'];
            
            $bclass       = 'update';
            $enviar_value = 'Actualizar';
        }
        
    } else {
        
        $enviar_value = 'Registrar';
        $bclass       = 'save';
        //$limpiar_tb= reset;
    }
?>


<?php
    
    //Asking if infomation has beens saved or updated correctly
    if (isset($_GET['saved']) == true && $_GET['saved'] == true) {
        echo '<div class="success"> La informacion ha sido guardada correctamente </div>';
    } else {
        
        if (isset($_GET['updated']) == true && $_GET['updated'] == true) {
            echo '<div class="success"> La informacion ha sido actualizada correctamente </div>';
        } else {
            
            if (isset($_GET['deleted']) == true && $_GET['deleted'] == true) {
                echo '<div class="success"> La informacion ha sido eliminada correctamente </div>';
            }
        }
    }
?>

<!-- ERRORS -->
<div id="non-number"> </div>
<div id="non-cero"> </div>
<div id="non-positive"> </div>

<?php
    if (isset($_POST['id_itd'], $_POST['id_size'], $_POST['id_color'], $_POST['id_qua'], $_GET['id_item'])) {
        
        $id_itd   = $_POST['id_itd'];
        $id_item  = $_GET['id_item'];
        $id_size  = $_POST['id_size'];
        $id_color = $_POST['id_color'];
        $id_qua   = $_POST['id_qua'];
        $id_usu   = $_SESSION['id'];
        
        
        //$usu_id= mysql_insert_id();
        if (isset($bnuevo)) {
            header('Location:upload_item_details.php');
            exit();
        }
        
        
        $errors = array();
        
        
        if (empty($id_itd) || $id_size == '--Select--' || $id_color == '--Select--' || empty($id_qua)) {
            
            $ast      = 1;
            $errors[] = '<div class="errors">All filds required</div>';
        } else {
            
            
            if (deit_exists($id_itd) == true) {
                if (!isset($_GET['id_itd'])) {
                    $errors[] = '<div class="errors">El codigo del articulo ya existe</div>';
                }
            }
            
            if (deit_exists_de($id_itd, $id_item, $id_size, $id_color) == true) {
                if (empty($_GET['id_itd'])) {
                    $astde    = 1;
                    $errors[] = '<div class="errors">El articulo que esta intentando ingresar ya existe</div>';
                }
            }
        }
        
        //print_r($errors);
        
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error, '<br/>';
            }
            
        } else {
            //Register our user
            
            $register = deit_register($id_itd, $id_item, $id_size, $id_color, $id_qua, $id_usu);
            // $_SESSION['id'] = $register;       Inicia una sesion con el id especificado
            
            
            
            if ($bclass == 'save') {
                header('Location: upload_item_details.php?saved=true');
                exit();
            } else {
                header('Location:  upload_item_details.php?updated=true');
                exit();
            }
        }
    }
    
    //Obtener el maximo auto id
    $query_max_id = mysql_query("SELECT MAX(`items_detail`.`id_itd`) FROM `items_detail`");
    $resultado    = mysql_fetch_array($query_max_id);
    $cur_auto_id  = $resultado['MAX(`items_detail`.`id_itd`)'] + 1;
?>

<?php
    if (isset($_POST['limpiar'])) {
        unset($id_itd);
        unset($id_size);
    }
?>

   
<!-- DETAILS -->
<form action= '' method='POST'>    
<table border="1" width="100%" align="center" class="stanbla">
<tr>
 <td width="20%" class="trstanbla">Codigo </td><td><input type="text" <?php
    if (isset($_GET['id_itd'])) {
        echo 'readonly="readonly"';
    }
?> id="id-itd" class=" <?php
    if (isset($_GET['id_itd'])) {
        echo 'disabled';
    }
?>" name="id_itd" size="10px" value="<?php
    if (isset($_GET['id_itd'])) {
        echo $id_itd;
    } else {
        printf("%05s", $cur_auto_id);
    }
?>" />
 <td rowspan="5">
 
 <?php
    //FOTO
?>

 </td>
 </tr>
 
 <tr>
 <td width="20%" class="trstanbla">Codigo del item</td><td><input type="text" id="id-item" name="id_item" size="10px" value="<?php
    if (isset($_GET['id_item']) == true) {
        echo $_GET['id_item'];
    } else {
        if (isset($id_item) == true) {
            echo $id_item;
        }
    }
?>"> 
 <a href="javascript:void(0)" onClick="openbox('Busqueda de articulos', 0)"> <input type="button" autofocus="autofocus" name="buscar" value="Buscar" tabindex="1"/> </a>
 </td>
 </tr>

<tr>
<td class="trstanbla">Tama&ntilde;o</td>
<td> 
<select name="id_size" tabindex="2" id="tsize">

<option> --Select-- </option>

<?php
    $sql = "select * FROM sizes WHERE del_est_size = 0 ORDER BY des_size ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_size'];
?>" <?php
        if (isset($id_size) == true) {
            if ($campo['id_size'] == $id_size) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_size'];
    }
?>
</option>
</select> <?php
    if (isset($id_size) == true) {
        if ($id_size == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?>
</td>
</tr>

<tr>
<td class="trstanbla">Color disponible</td>
<td> 

<select name="id_color" tabindex="9" id="tcolor">

<option> --Select-- </option>

<?php
    $sql = "select * FROM colors WHERE del_est_color = 0 ORDER BY id_color ASC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
?>
<option value="<?php
        echo $campo['id_color'];
?>" <?php
        if (isset($id_color) == true) {
            if ($campo['id_color'] == $id_color) {
                echo "SELECTED";
            }
        } elseif (isset($_GET['id_color'])) {
            if ($campo['id_color'] == $_GET['id_color']) {
                echo "SELECTED";
            }
        }
?> > <?php
        echo $campo['des_color'];
    }
?>
</option>
</select> <?php
    if (isset($id_color) == true) {
        if ($id_color == '--Select--' && $ast == 1) {
            echo '<strong class="asterisk">*</strong>';
        }
    }
?>
</td>
</tr>

<tr>
<td class="trstanbla">Cantidad</td>
<td><input type="number" id="did-qua" name="id_qua" value="<?php
    if (isset($id_qua) == true) {
        echo $id_qua;
    }
?>" /></td> 
</tr>

</table>
&nbsp;

<td colspan="2" class="trstanbla">
<div class="b_center">
<input type="submit" value="Nuevo" accesskey="u" name="bnuevo" title="alt + u" tabindex="10" class="<?php
    if (!isset($_GET['id_itd'])) {
        echo 'd_new';
    } else {
        echo 'new';
    }
?> " <?php
    if (!isset($_GET['id_itd'])) {
        echo 'disabled="disabled"';
    }
?>  />

<input type="submit" value="<?php
    echo $enviar_value;
?>" id="<?php
    if ($bclass == bguardar) {
        echo 'areg-submit';
    }
?>" accesskey="r" title ="alt + r" name="<?php
    echo $bname;
?>" tabindex="9" class=" <?php
    echo $bclass;
?>" />

<!--  name=benviar -->

<a class="bnada" href="delete.item.det.php?id_itd=<?php
    echo $datos;
?>">

<input type="button" value="Eliminar" title="alt + i" accesskey="i" tabindex="12" class="<?php
    if (!isset($_GET['id_itd'])) {
        echo 'd_delete';
    } else {
        echo 'delete';
    }
?> " <?php
    if (!isset($_GET['id_itd'])) {
        echo 'disabled="disabled"';
    }
?> name="beliminar" onclick="return confirm('¿Seguro que desea eliminar este articulo?')" /></a>

<input type="reset" value="Limpiar" title="alt + l" accesskey="l" tabindex="11" name="limpiar" class="<?php
    if (!isset($_GET['id_itd'])) {
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
 <th width="5%"> <strong>Codigo</strong> </th> <th width="30%"> <strong>Id item</strong></th> <th width="30%"> <strong> Size </strong></th>   <th width="30%"> <strong>Color </strong></th> <th width="30%"> <strong>Cantidad </strong></th>  <th width="5%"> <strong>Editar </strong></th>
 </tr>
</thead>
<tbody>
<?php
    
    $sql = "SELECT it.id_item, itd.id_item, itd.id_itd,itd.id_size, itd.id_color, itd.id_qua, si.id_size, si.des_size, co.id_color, co.des_color  FROM items AS it, sizes AS si, colors AS co, items_detail AS itd WHERE it.id_item=itd.id_item AND si.id_size=itd.id_size AND co.id_color=itd.id_color AND itd.del_est_itd = '0' ORDER BY id_itd DESC";
    $re = mysql_query($sql) or die("Error al ejecutar consulta 3") . mysql_error();
    
    while ($campo2 = mysql_fetch_array($re)) {
        
        
        echo '<tr class="tr1"><td width="5%" class="td1">' . $campo2['id_itd'] . '</td> <td width="30%">' . $campo2['id_item'] . '</td> <td width="30%">' . $campo2['des_size'] . '</td> <td width="30%">' . $campo2['des_color'] . '</td> <td width="30%">' . $campo2['id_qua'] . '</td> <td width="5%">' . '<a href="upload_item_details.php?id_itd=' . $campo2['id_itd'] . '&id_item=' . $campo2['id_item'] . '">' . '<img src="images/icons/Edit/edit-file-icon.png"/></a>' . '</td> </tr>';
        
    }
    
?>

</tbody>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
    include 'jsbform_items.php';
    include 'template/footer.php';
    
} else {
    header('Location: index.php');
    exit();
}

?>

<link type="text/css" rel="stylesheet" href="css/lightbox-form.css">
<script src="js/lightbox-form.js" type="text/javascript"></script>


