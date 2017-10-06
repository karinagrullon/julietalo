<?php
include 'init.php';
include("template/header.php");
?>

<div id="container">
<div id="container_left">
<?php
include 'categories.php';
?>
	
</div>

<div id="container_ditems">
<div id="main">

<?php
$ip_user     = $_SERVER["REMOTE_ADDR"];
if (isset($_SESSION['user_id'])) {
$user_id      = $_SESSION['user_id']; 
}
if (!logged_in() == true) {
echo '<p>&nbsp;</p>';
echo '<div class="no_items">Share your experience! Just <a href="signin.php"><strong>Sign in</strong></a> to begin </div>';

} else {

if (logged_in() == true && user_activated($user_id) == false) {
echo '<p>&nbsp;</p>';
echo '<div class="no_items">Please validate your account to perform this action</div>';
} else {
$id_usu      = $_SESSION['user_id']; 

//Asking if infomation has beens saved or updated correctly
if (isset($_GET['saved'])== true && $_GET['saved']==true) {
echo '<div class="success" id="success"> Thanks for posting your testimonial </div>';
} else {

if (isset($_GET['updated'])== true && $_GET['updated']==true) {
echo '<div class="success"> You have successfully updated your post </div>';
}  else {

if (isset($_GET['deleted'])== true && $_GET['deleted']==true) {
echo '<div class="success"> You have successfully deleted your post  </div>';
} } }


//Recoger los datos para actualizar
if (isset($_GET['id_tes'])){

$datos=$_GET['id_tes'];
$obtain_data= "SELECT * FROM testimonials WHERE id_tes='$datos'";

$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data").mysql_error();
while($campo_act=mysql_fetch_array($re)){

$id_tes=$campo_act['id_tes'];
$tit_tes=$campo_act['tit_tes'];
$mes_tes=$campo_act['mes_tes'];


$bclass= 'update';
$enviar_value='Update';
//$limpiar_tb= submit;

}

}  else  {

$enviar_value= 'Save';
$bclass= 'save';
//$limpiar_tb= reset;
}

//Post
if (isset($_POST['id_tes'],$_POST['tit_tes'],$_POST['mes_tes'])){
$id_tes=$_POST['id_tes'];
$tit_tes=$_POST['tit_tes'];
$mes_tes=$_POST['mes_tes'];
$user_id=$_SESSION['user_id'];


$errors= array();

if (empty($id_tes) || empty($tit_tes) || empty($mes_tes)){

$ast = '1';
$errors[]= '<div class="errors">All filds required</div>';
}    else      {


if (test_exists($id_tes) == true) {
if (empty($_GET['id_tes'])){
 //est_exists is the function we created on user functions
$nue= 1;
$errors[]='<div class="errors">This testimonial already exists</div>';
}
}

}

if (!empty($errors)) {
foreach($errors as $error) {
echo $error, '<br/>';

}


} else {

$register= test_register($id_tes, $user_id, $tit_tes, $mes_tes);
// $_SESSION['id'] = $register;       Inicia una sesion con el id especificado


if ($enviar_value == 'Save') {
header('Location: testimonials.php?saved=true');
exit(); 
} else {
header('Location: testimonials.php?updated=true'); 
exit();
}


}

}

//Obtener el maximo auto id
$query_max_id = mysql_query("SELECT MAX(`testimonials`.`id_tes`) FROM `testimonials`");
$resultado = mysql_fetch_array($query_max_id);
$cur_auto_id = $resultado['MAX(`testimonials`.`id_tes`)'] + 1;

?>

<form action= "" method="post">
<input type="hidden" <?php  if(isset($_GET['id_tes'])){echo 'readonly="readonly"';} ?> id="id-tes" class=" <?php if(isset($_GET['id_tes'])){echo 'disabled';} ?>" name="id_tes" size="10px" value="<?php if (isset($_GET['id_tes'])) {echo $id_tes;} else {printf("%05s",$cur_auto_id);} ?>">

<table border="0" class="test_table1">
<thead>
 <tr>
 <th colspan="2"> Custumer testimonials </th>
 </tr>
 
</thead>
<tbody>
<tr>
<td>Title</td>
</td>
<tr>
<td><input type="text" name="tit_tes" maxlength= "40" value="<?php if(isset($tit_tes)) { echo $tit_tes; } ?>" /></td>
</tr> 

<td>Testimonial</td>
</td>
<tr>
<td><textarea name="mes_tes" onkeypress="return imposeMaxLength(this, 299)"; class="gtextarea"><?php if(isset($mes_tes)) { echo $mes_tes; } ?></textarea></td>
</tr> 

<tr>
<td><input type="submit" value="<?php if(isset($enviar_value)) { echo $enviar_value; } ?>" name="<?php echo $bname;?>" class="bestandar" /></td>
</tr>

</tbody>
</table>
</form>

<?php
}
}
?>
<p>&nbsp;</p>
<?php
echo '<table border="0" class="test_table2">
<tr>
<td colspan="4" class="test_bar">Testimonials</td> 
</td>
';
 $sql="SELECT te.id_tes,te.user_id, te.tit_tes, te.mes_tes, te.date, te.time, us.user_id, uf.user_id, us.name, us.lastname, uf.user_city, uf.user_state  FROM testimonials AS te, users AS us, users_inf AS uf WHERE te.user_id=us.user_id AND uf.user_id=us.user_id AND del_est_tes=0 ORDER BY te.id_tes DESC";
 $re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();

 while($campo2=mysql_fetch_array($re)) {
 echo '<tr class="test_hover">
 <th width="15%" class="test_td"><div class="test_strong">'.$campo2['name'].' '.$campo2['lastname'].'</div><p>'.$campo2['user_city'].', '.$campo2['user_state'].'</p></th> <th width="60%"><div class="test_tit">'.$campo2['tit_tes'].'</div></th> <th width="12%"><div class="test_date">'.$campo2['date'].'</div></th> <th width="18%">'; 
 if (logged_in() && $campo2['user_id'] == $_SESSION['user_id']) { echo '<div class="tes_ico"><a href="testimonials.php?id_tes='.$campo2['id_tes'].'">'.'<img src="images/icons/Edit/Copy of edit-file-icon.png"/></a></div>';}
 if (logged_in() && $campo2['user_id'] == $_SESSION['user_id']) { echo '<div class="tes_ico"><a onclick="return button_confirm()" href="delete.test.php?id_tes='.$campo2['id_tes'].'">'.'<img src="images/icons/Delete/Copy of Delete_16x16.png"/></a></div>';}
 echo '</th> 
 </tr><tr class="test_mes_hover">
 <td class="test_td"></td> <td>'.$campo2['mes_tes'].'</td> <td></td> <td></td> 
 </tr>';
 }
?> </table>

</div>
</div>
</div>

<?php
include("template/footer.php");
?>
