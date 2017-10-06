<?php
include 'init.php';
if (logged_in_system()) {

if(consulta($level)==true){
header('Location: index.php');
 exit();
}

if(inscripcion($level)==true){
header('Location: index.php');
exit();
}

if(cobro($level)==true){
header('Location: index.php');
exit();
}

if(contabilidad($level)==true){
header('Location: index.php');
exit();
}

if(profesor($level)==true){
header('Location: index.php');
exit();
}

if(tutor($level)==true){
header('Location: index.php');
exit();
}

include 'template/header.php';
?>



<h3> Crear un material para los art&iacute;culos</h3>

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

//Recoger los datos para actualizar
if (isset($_GET['id_fabric'])){

$datos=$_GET['id_fabric'];
$obtain_data= "SELECT * FROM fabrics WHERE id_fabric='$datos'";

$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data").mysql_error();
while($campo_act=mysql_fetch_array($re)){

$id_fabric=$campo_act['id_fabric'];
$des_fabric=$campo_act['des_fabric'];
$id_it_type=$campo_act['id_it_type'];



$bclass= update;
$enviar_value=Actualizar;
//$limpiar_tb= submit;

}

}  else  {

$enviar_value= Registrar;
$bclass= save;
//$limpiar_tb= reset;
}
?>


<?php
if (isset($_POST['id_fabric'],$_POST['id_it_type'],$_POST['des_fabric'])){
$id_fabric=$_POST['id_fabric'];
$id_it_type=$_POST['id_it_type'];
$des_fabric=$_POST['des_fabric'];
$id_usu=$_SESSION['id'];


//$usu_id= mysql_insert_id();
if (isset($bnuevo)){
header('Location:fabrics.php');
exit();
 }


$errors= array();


if (empty($id_fabric) || empty($des_fabric) || $id_it_type=='--Select--'){

$ast = 1;
$errors[]= '<div class="errors">All fields required</div>';
}    else      {


if (fabric_exists($id_fabric) == true) {
if (empty($_GET['id_fabric'])){
 //est_exists is the function we created on user functions
$nue= 1;
$errors[]='<div class="errors">The fabrics with the code '.'<strong>'.$id_fabric.'</strong>'.'already exists</div>';
}
}

if (fabricd_exists($des_fabric) == true) {
if (empty($_GET['id_fabric'])){
$astde=1;
$errors[]='<div class="errors">The fabrics with the descripction '.'<strong>'.$des_fabric.'</strong>'.' already exists</div>';
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

$register= fabric_register($id_fabric,$id_it_type,$des_fabric,$id_usu);
// $_SESSION['id'] = $register;       Inicia una sesion con el id especificado

unset($id_fabric);
unset($des_fabric);


if ($bclass == bguardar) {
header('Location: fabrics.php?saved=true');
exit(); 
} else {
header('Location: fabrics.php?updated=true'); 
exit();
}

}
}



//Obtener el maximo auto id
$query_max_id = mysql_query("SELECT MAX(`fabrics`.`id_fabric`) FROM `fabrics`");
$resultado = mysql_fetch_array($query_max_id);
$cur_auto_id = $resultado['MAX(`fabrics`.`id_fabric`)'] + 1;


?>

<?php
if (isset($_POST['limpiar'])){
unset($id_fabric);
unset($des_fabric);
}



?>



    
    
    <!-- AULAS -->
<form action= '' method='POST'>    
<table border="0" width="100%" align="center" class="stanbla">
<tr>
 <td width="20%" class="trstanbla">Codigo: </td><td><input type="text" <?php  if(isset($_GET['id_fabric'])){echo 'readonly="readonly"';} ?> id="id-fabric" class=" <?php if(isset($_GET['id_fabric'])){echo 'disabled';} ?>" name="id_fabric" size="10px" value="<?php if (isset($_GET['id_fabric'])) {echo $id_fabric;} else {printf("%05s",$cur_auto_id);} ?>">
 </tr>
 
 
 <tr>
<td class="trstanbla"><p>Tipo: </td>

<td> <select name="id_it_type" tabindex="5">

<option> --Select-- </option>

<?php

$sql="SELECT id_it_type,des_it_type FROM item_type WHERE del_est_it_type=0 ORDER BY des_it_type ASC";
$re= mysql_query($sql) or die ("There was an error! 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
?>


<option value="<?php echo $campo['id_it_type'];?>" <?php if ($campo['id_it_type']==$id_it_type){echo "SELECTED";} ?> > <?php echo $campo['des_it_type'];}?>
</option>

</select> <?php if ($id_it_type== '--Select--' && $ast == 1 || $astpr==1){echo '<strong class="asterisk">*</strong>';}?>   </p> </td>
  </tr> 


<tr>
<td class="trstanbla"><p>Descripcion: </td> <td><input type="text" name="des_fabric" size="15" maxlength="20" tabindex="1"  value="<?php if (isset($des_fabric)){echo $des_fabric;} ?>" > <?php if (empty($des_fabric) && $ast == 1 || $astde == 1){echo '<strong class="asterisk">*</strong>';}?>  </p>    </a></td>  </td>
</tr>

</table>

&nbsp;





<td colspan="2" class="trstanbla">

<div class="b_center">
<input type="submit" value="Nuevo" accesskey="u" name="bnuevo" title="alt + u" tabindex="10" class="<?php  if(!isset($_GET['id_fabric'])){echo 'd_new';} else {echo 'new';} ?> " <?php  if(!isset($_GET['id_fabric'])){echo 'disabled="disabled"';} ?>  />

<input type="submit" value="<?php echo $enviar_value; ?>" id="<?php if ($bclass == bguardar) {echo 'areg-submit';} ?>" accesskey="r" title ="alt + r" name="<?php echo $bname;?>" tabindex="9" class=" <?php echo $bclass; ?>" />


<a class="bnada" href="delete.fabrics.php?id_fabric=<?php echo $datos;?>">

<input type="button" value="Eliminar" title="alt + i" accesskey="i" tabindex="12" class="<?php  if(!isset($_GET['id_fabric'])){echo 'd_delete';} else {echo 'delete';} ?> " <?php  if(!isset($_GET['id_item'])){echo 'disabled="disabled"';} ?> name="beliminar" onclick="return confirm('¿Seguro que desea eliminar este articulo?')" /></a>

<input type="reset" value="Limpiar" title="alt + l" accesskey="l" tabindex="11" name="limpiar" class="<?php  if(!isset($_GET['id_fabric'])){echo 'clear';} else {echo 'd_clear';} ?> " />
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
 <th width="5%"> <strong>Codigo</strong> </th> <th width="40%"> Tipo </th>   <th width="50%"> <strong>Descripcion </strong></th>  <th width="5%"> <strong>Editar </strong></th>
 </tr>
</thead>
<tbody>
<?php
$sql= mysql_real_escape_string($sql);


$sql="SELECT fa.id_fabric,fa.des_fabric,fa.id_it_type,ity.id_it_type,ity.des_it_type FROM fabrics AS fa,item_type AS ity WHERE del_est_fabric=0 AND fa.id_it_type=ity.id_it_type ORDER BY id_fabric DESC";


$re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();

while($campo2=mysql_fetch_array($re)) {


echo '<tr class="tr1"><td width="5%" class="td1">'.$campo2['id_fabric'].'</td> <td width="40%">'.$campo2['des_it_type'].'</td> <td width="50%">'.$campo2['des_fabric'].'</td> <td width="5%">'.'<a href="fabrics.php?id_fabric='.$campo2['id_fabric'].'">'.'<img src="images/icons/Edit/edit-file-icon.png"/></a>'.'</td> </tr>';

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



