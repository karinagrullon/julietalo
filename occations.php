<?php
include 'init.php';
if (logged_in_system()) {


include 'template/header.php';
?>



<h3> Crear una ocasion</h3>

<?php

//Recoger los datos para actualizar
if (isset($_GET['id_oct'])){

$datos=$_GET['id_oct'];
$obtain_data= "SELECT * FROM occations WHERE id_oct='$datos'";

$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data").mysql_error();
while($campo_act=mysql_fetch_array($re)){

$id_oct=$campo_act['id_oct'];
$des_oct=$campo_act['des_oct'];



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

if (isset($_POST['id_oct'],$_POST['des_oct'])){
$id_oct=$_POST['id_oct'];
$des_oct=$_POST['des_oct'];
$id_usu=$_SESSION['id'];


//$usu_id= mysql_insert_id();
if (isset($bnuevo)){
header('Location:occations.php');
exit();
 }


$errors= array();


if (empty($id_oct) || empty($des_oct)){

$ast = 1;
$errors[]= '<div class="errors">All filds required</div>';
}    else      {


if (oct_exists($id_oct) == true) {
if (empty($_GET['id_oct'])){
 //est_exists is the function we created on user functions
$nue= 1;
$errors[]='<div class="errors">The occations with the code '.'<strong>'.$id_oct.'</strong>'.'already exists</div>';
}
}

if (octd_exists($des_oct) == true) {
if (empty($_GET['id_oct'])){
$astde=1;
$errors[]='<div class="errors">The occations with the descripction '.'<strong>'.$des_oct.'</strong>'.' already exists</div>';
}
}

}

//print_r($errors);

if (!empty($errors)) {
foreach($errors as $error) {
echo $error, '<br/>';

}


}else{
 //Register our user

$register= oct_register($id_oct,$des_oct,$id_usu);
// $_SESSION['id'] = $register;       Inicia una sesion con el id especificado

unset($id_oct);
unset($des_oct);



//if ($bclass == 'bguardar') {
if ($bclass == 'save') {
header('Location: occations.php?saved=true');
exit(); 
} else {
header('Location: occations.php?updated=true'); 
exit();
}


}

}



//Obtener el maximo auto id
$query_max_id = mysql_query("SELECT MAX(`occations`.`id_oct`) FROM `occations`");
$resultado = mysql_fetch_array($query_max_id);
$cur_auto_id = $resultado['MAX(`occations`.`id_oct`)'] + 1;


?>

<?php
if (isset($_POST['limpiar'])){
unset($id_oct);
unset($des_oct);
}



?>



    
    
    <!-- OCCASIONS -->
<form action= '' method='POST'>    
<table border="0" width="100%" align="center" class="stanbla">
<tr>
 <td width="20%" class="trstanbla">Codigo: </td><td><input type="text" <?php  if(isset($_GET['id_oct'])){echo 'readonly="readonly"';} ?> id="id-aul" class=" <?php if(isset($_GET['id_oct'])){echo 'disabled';} ?>" name="id_oct" size="10px" value="<?php if (isset($_GET['id_oct'])) {echo $id_oct;} else {printf("%05s",$cur_auto_id);} ?>">
 </tr>


<tr>
<td class="trstanbla"><p>Descripcion: </td> <td><input type="text" name="des_oct" size="15" maxlength="20" tabindex="1"  autofocus = "autofocus" value="<?php if (isset($des_oct)){echo $des_oct;} ?>" > <?php if (empty($des_oct)){echo '<strong class="asterisk">*</strong>';}?>  </p>    </a></td>  </td>
</tr>

</table>

&nbsp;





<td colspan="2" class="trstanbla">
<div class="b_center">
<input type="submit" value="Nuevo" accesskey="u" name="bnuevo" title="alt + u" tabindex="10" class="<?php  if(!isset($_GET['id_oct'])){echo 'd_new';} else {echo 'new';} ?> " <?php  if(!isset($_GET['id_oct'])){echo 'disabled="disabled"';} ?>  />

<input type="submit" value="<?php echo $enviar_value; ?>" id="<?php if ($bclass == bguardar) {echo 'areg-submit';} ?>" accesskey="r" title ="alt + r" name="<?php echo $bname;?>" tabindex="9" class=" <?php echo $bclass; ?>" />

<!--  name=benviar -->

<a class="bnada" href="delete.oct.php?id_oct=<?php echo $datos;?>">

<input type="button" value="Eliminar" title="alt + i" accesskey="i" tabindex="12" class="<?php  if(!isset($_GET['id_oct'])){echo 'd_delete';} else {echo 'delete';} ?> " <?php  if(!isset($_GET['id_oct'])){echo 'disabled="disabled"';} ?> name="beliminar" onclick="return confirm('¿Seguro que desea eliminar este articulo?')" /></a>

<input type="reset" value="Limpiar" title="alt + l" accesskey="l" tabindex="11" name="limpiar" class="<?php  if(!isset($_GET['id_oct'])){echo 'clear';} else {echo 'd_clear';} ?> " />
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

$sql="SELECT id_oct,des_oct FROM occations WHERE del_est_oct=0 ORDER BY id_oct DESC";
$re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();

while($campo2=mysql_fetch_array($re)) {


echo '<tr class="tr1"><td width="5%" class="td1">'.$campo2['id_oct'].'</td> <td width="90%">'.$campo2['des_oct'].'</td> <td width="5%">'.'<a href="occations.php?id_oct='.$campo2['id_oct'].'">'.'<img src="images/icons/Edit/edit-file-icon.png"/></a>'.'</td> </tr>';

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



