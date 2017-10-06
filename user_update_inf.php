<?php
include 'init.php';
if (!logged_in()){
 header('Location: index.php');
 exit();
}

include 'template/header.php';
$user_id= $_SESSION['user_id'];
?>
<h3> Update your information </h3>

<?php
//Recoger los datos para actualizar
if (isset($_GET['user_id'])){

$datos=$_GET['user_id'];
$obtain_data= "SELECT * FROM users_inf WHERE user_id='$datos'";

$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data").mysql_error();
while($campo_act=mysql_fetch_array($re)){

$user_id=$campo_act['user_id'];
$id_coun=$campo_act['id_coun'];
$user_adre=$campo_act['user_adre'];
$user_city=$campo_act['user_city'];
$user_state=$campo_act['user_state'];
$user_poc=$campo_act['user_poc'];
$user_pnu=$campo_act['user_pnu'];
$id_sec_que=$campo_act['id_sec_que'];
$user_ans=$campo_act['user_ans'];
$user_ip=$campo_act['user_ip'];
$user_reg_date=$campo_act['user_reg_date'];
$user_reg_time=$campo_act['user_reg_time'];
$del_est_user=$campo_act['del_est_user'];


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

<div id="less-six" ></div>
<div id="dont-match" ></div>

<?php
if (isset($_POST['id_inf'],$_POST['id_coun'])){
$id_inf =$_POST['id_inf'];
$user_id=$_SESSION['user_id'];
$id_coun=$_POST['id_coun'];
$user_adre=$_POST['user_adre'];
$user_city=$_POST['user_city'];
$user_state=$_POST['user_state'];
$user_poc=$_POST['user_poc'];
$user_pnu=$_POST['user_pnu'];
$id_sec_que=$_POST['id_sec_que'];
$user_ans=$_POST['user_ans'];
$user_ip=$_SERVER['REMOTE_ADDR'];

$errors= array();

if ($id_coun == '--Select--' || empty($user_adre) || empty($user_city) || empty($user_state) || empty($user_poc) || empty($user_pnu) || $id_sec_que == '--Select--' || empty($user_ans)){
//$errors[]= '<div class="errors" id="reg-empty"> All  fields required </div>';
$errors[]= '<div class="errors" id="reg-empty"> All  fields required </div>';
$ast = '1';
$astau = '1';

}    else      {

// if (user_inf_exists($user_id) == true){
 // //user_exists is the function we created on user functions
// $errors[]='<div class="errors">There was an error</div>';
// } 
 }

if (!empty($errors)) {
foreach($errors as $error) {
echo $error, '<br/>';
}

} else {

 //Register our user

 $register_inf= user_inf_register($user_id,$id_coun,$user_adre,$user_city,$user_state,$user_poc,$user_pnu,$id_sec_que,$user_ans,$user_ip);
 
 if ($bclass == 'save') {
 header('Location: index.php?welcome=true');
 exit();
} else {
header('Location: index.php?updated=true'); 
exit();
}
 

}
}
//Obtener el maximo auto id
$query_max_id = mysql_query("SELECT MAX(`users_inf`.`id_inf`) FROM `users_inf`");
$resultado = mysql_fetch_array($query_max_id);
$cur_auto_id = $resultado['MAX(`users_inf`.`id_inf`)'] + 1;

?>

<form action= '' method='POST' class="general_f">
<input type="hidden" <?php  if(isset($_GET['id_inf'])){echo 'readonly="readonly"';} ?> id="id-inf" class=" <?php if(isset($_GET['id_inf'])){echo 'disabled';} ?>" name="id_inf" size="10px" value="<?php if (isset($_GET['id_inf'])) {echo $id_inf;} else {printf("%05s",$cur_auto_id);} ?>" />
<table class="general_table" border="0">
<tr>
<td colspan="2">Country:<br />
<select name="id_coun" tabindex="5" style="width:100%" autofocus="autofocus">

<option> --Select-- </option>

<?php
$sql="select id_coun,des_coun from countries WHERE del_est_coun = 0 ORDER BY des_coun ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
?>
<option value="<?php echo $campo['id_coun'];?>" <?php if(isset($id_coun)){ if ($campo['id_coun']==$id_coun){echo "SELECTED";} } ?> > <?php echo $campo['des_coun'];}?>
</option>
</select> <?php   if(isset($id_count) == true){   if ($id_coun== '--Select--' && $ast == 1 || $astau==1){echo '<strong class="asterisk">*</strong>';} } ?>   </p> </td>
</tr>

<tr>
<td colspan="2">Street address: <br />
<input type="text" name="user_adre" style="width:100%" id="user-adre" maxlegth="35" value="<?php if(isset($user_adre)){echo $user_adre;} ?>" /></td> 
</tr>

<tr>
<td width="25%">City:<br />
<input type="text" name="user_city" style="width:100%" id="user-city" maxlegth="35" value="<?php if(isset($user_city)){echo $user_city;} ?>"/> </td>

<td width="25%">State / Province:<br />
<input type="text" name="user_state" style="width:100%" id="user-state" maxlegth="35" value="<?php if(isset($user_state)){echo $user_state;} ?>"/> </td>

</tr>

<tr>
<td colspan="2">Postal code:<br />
<input type="text" name="user_poc" style="width:100%" id="user-poc" maxlegth="4" value="<?php if(isset($user_poc)){echo $user_poc;} ?>"/> </td>
</tr>

<tr>
<tr>
<td colspan="2">Phone number:<br />
<input type="text" name="user_pnu" style="width:100%" id="user-pnu" maxlegth="12" value="<?php if(isset($user_pnu)){echo $user_pnu;} ?>"/> </td>
</tr>

<tr>
<td colspan="2"> <p>&nbsp;  </p> Please fill in this security question, be sure you're the only one who know the answer:</td>
</tr>

<tr>
<td colspan="2">Security question:<br />
<select name="id_sec_que" style="width:100%" tabindex="5">

<option> --Select-- </option>

<?php
$sql="SELECT id_sec_que,des_sec_que FROM sec_que WHERE del_est_sec_que = 0 ORDER BY des_sec_que ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
?>
<option value="<?php echo $campo['id_sec_que'];?>" <?php if(isset($id_sec_que) == true) { if ($campo['id_sec_que']==$id_sec_que){echo "SELECTED";} } ?> > <?php echo $campo['des_sec_que'];}?>
</option>
</select> <?php if(isset($id_sec_que) == true) { if ($id_sec_que== '--Select--' && $ast == 1){echo '<strong class="asterisk">*</strong>';} }?>   </p> </td>
</tr>
<tr>

<tr>
<td colspan="2">Answer:<br />
<input type="text" name="user_ans" style="width:100%" id="user-ans" size="35" maxlegth="35" value="<?php if(isset($user_ans)){echo $user_ans;} ?>"/> </td>
</tr>

<td colspan="2"><input type="submit"  value="Continue" class="bestandar"  id="upsubmit" /> </td>
</tr>
</table>
</form>



<?php
include 'template/footer.php';
?>