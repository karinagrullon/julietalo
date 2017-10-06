<?php
include 'init.php';
if (logged_in_system()) {

include 'template/header.php';
?>

<h3> Crear un color</h3>

<?php

//Recoger los datos para actualizar
if (isset($_GET['id_color'])){

$datos=$_GET['id_color'];
$obtain_data= "SELECT co.id_color, co.des_color, co.del_est_color, co.image_id,im.image_id,im.ext FROM colors  AS co, images AS im WHERE co.image_id=im.image_id AND co.id_color='$datos'";

$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data").mysql_error();
while($campo_act=mysql_fetch_array($re)){

$id_color=$campo_act['id_color'];
$des_color=$campo_act['des_color'];

$image_id= $campo_act['image_id'];
$ext = $campo_act['ext'];

$bclass= 'update';
$enviar_value='Actualizar';
//$limpiar_tb= submit;

}

}  else  {

$enviar_value= 'Registrar';
$bclass= 'save';
//$limpiar_tb= reset;
}
?>

<?php

//Asking if infomation has beens saved or updated correctly
if (isset($_GET['saved'])== true && $_GET['saved']==true) {
echo '<div class="success"> La informacion ha sido guardada correctamente </div>';
} else {

if (isset($_GET['updated'])== true && $_GET['updated']==true) {
echo '<div class="success"> La informacion ha sido actualizada correctamente </div>';
}  else {

if (isset($_GET['deleted'])== true && $_GET['deleted']==true) {
echo '<div class="success"> La informacion ha sido eliminada correctamente </div>';
} } }

if (isset($_POST['id_color'],$_POST['des_color'])) {
$id_color=$_POST['id_color'];
$des_color=$_POST['des_color'];
$id_usu=$_SESSION['id'];

  
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
  
        $errors = array();
        
        
        if (empty($id_color) == true || empty($des_color) == true) {
    
            $ast      = 1;
            $errors[] = '<div class="errors">All fields required</div>';
        } else {
            
            
            if (in_array($image_ext, $allowed_ext) === false && empty($_GET['id_color'])) {
                
                $errors[] = '<div class="errors">Tipo de archivo no es admitido</div>';
                
            }
            
            if ($image_size > 2097152) {
                $errors[] = '<div class="errors">Maximimun file size is 2 MB';
                
            }
            
            if ($album_id != -2) {
                if (album_check($album_id) == false) {
                    $errors[] = 'Could\'t upload to that album' . $album_id;
                }
            }
            
            
            
            if (color_exists($id_color) == true) {
                if (empty($_GET['id_color'])) {
                    //est_exists is the function we created on user functions
                    $nue      = 1;
                    $errors[] = '<div class="errors">The color with the code ' . '<strong>' . $id_color . '</strong>' . ' already exists</div>';
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
            
            
            upload_image_col($image_temp, $image_ext, $album_id);
            
            $register= color_register($id_color,$des_color,$max_image,$id_usu);
// $_SESSION['id'] = $register;       Inicia una sesion con el id especificado

unset($id_color);
unset($des_color);
unset($max_image);

//if ($bclass == 'bguardar') {
if ($bclass == 'save') {
header('Location: colors.php?saved=true');
exit(); 
} else {
header('Location: colors.php?updated=true'); 
exit();
}

}

}

//Obtener el maximo auto id
$query_max_id = mysql_query("SELECT MAX(`colors`.`id_color`) FROM `colors`");
$resultado = mysql_fetch_array($query_max_id);
$cur_auto_id = $resultado['MAX(`colors`.`id_color`)'] + 1;
?>

<?php
if (isset($_POST['limpiar'])){
unset($id_color);
unset($des_oct);
}
?>
    
<!-- COLORS -->
<form method="POST" enctype="multipart/form-data" name="f1">
  
<table border="0" width="100%" align="center" class="stanbla">

<tr>
 <td width="20%" class="trstanbla">Codigo: </td><td><input type="text" <?php  if(isset($_GET['id_color'])){echo 'readonly="readonly"';} ?> id="id-color" class=" <?php if(isset($_GET['id_color'])){echo 'disabled';} ?>" name="id_color" size="10px" value="<?php if (isset($_GET['id_color'])) {echo $id_color;} else {printf("%05s",$cur_auto_id);} ?>">
 </td>
 </tr>

<tr>
<td class="trstanbla"><p>Descripcion: </td> <td><input type="text" name="des_color" size="15" maxlength="45" tabindex="1"  autofocus = "autofocus" value="<?php if (isset($des_color)){echo $des_color;} ?>" > <?php if (empty($des_color)){echo '<strong class="asterisk">*</strong>';}?>  </p>    </a></td>  </td>
</tr>

<tr>
<td class="trstanbla">Foto:</td>
<td><p> 
<?php
    
    if (isset($_GET['id_color'])) {
        echo 'Tu foto:';
		?>
<img src="uploads/thumbs/color/-2/<?php echo $image_id.'.'.$ext; ?>" alt="fabric" />
        <?php
    } else {
?>
<p class="select_file">Selecciona un archivo: </p>
<input type="file" tabindex="2" name="image" value="<?php
        if (isset($image)) {
            echo $image;
        }
?>"  /> 

<?php
    }
?>



</td>

</tr>
</table>

&nbsp;

<td colspan="2" class="trstanbla">
<div class="b_center">
<a href="colors.php">
<input type="button" value="Nuevo" accesskey="u" name="bnuevo" title="alt + u" tabindex="10" class="<?php  if(!isset($_GET['id_color'])){echo 'd_new';} else {echo 'new';} ?> " <?php  if(!isset($_GET['id_color'])){echo 'disabled="disabled"';} ?>  /></a> 

<input type="submit" value="<?php echo $enviar_value; ?>" id="<?php if ($bclass == bguardar) {echo 'areg-submit';} ?>" accesskey="r" title ="alt + r" name="<?php echo $bname;?>" tabindex="9" class=" <?php echo $bclass; ?>" />

<!--  name=benviar -->

<a class="bnada" href="delete.col.php?id_color=<?php echo $datos;?>">

<input type="button" value="Eliminar" title="alt + i" accesskey="i" tabindex="12" class="<?php  if(!isset($_GET['id_color'])){echo 'd_delete';} else {echo 'delete';} ?> " <?php  if(!isset($_GET['id_color'])){echo 'disabled="disabled"';} ?> name="beliminar" onclick="return confirm('¿Seguro que desea eliminar este color?')" /></a>

<input type="reset" value="Limpiar" title="alt + l" accesskey="l" tabindex="11" name="limpiar" class="<?php  if(!isset($_GET['id_color'])){echo 'clear';} else {echo 'd_clear';} ?> " />
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
 <th width="5%"> <strong>Codigo</strong> </th>   <th width="90%"> <strong>Descripcion </strong></th>  <th width="5%"> <strong>Editar </strong></th>
 </tr>
</thead>
<tbody>
<?php

$sql="SELECT id_color,des_color FROM colors WHERE del_est_color=0 ORDER BY id_color DESC";
$re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();

while($campo2=mysql_fetch_array($re)) {


echo '<tr class="tr1"><td width="5%" class="td1">'.$campo2['id_color'].'</td> <td width="90%">'.$campo2['des_color'].'</td> <td width="5%">'.'<a href="colors.php?id_color='.$campo2['id_color'].'">'.'<img src="images/icons/Edit/edit-file-icon.png"/></a>'.'</td> </tr>';

}

?>

</tbody>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
include 'template/footer.php';

} else {
header('Location: index.php');
 exit();
}

?>
