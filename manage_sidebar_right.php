<?php
include 'init.php';
If (!logged_in_system()){
header('Location: index.php');
exit();
}
include 'template/header.php';

if(empty($con_sbr)==true){
$obtain_data= "SELECT `con_sbr` FROM sidebar_right";
$re = mysql_query($obtain_data) or die ("Error al obtener datos").mysql_error();
while($campo_act=mysql_fetch_array($re)){
$con_sbr=$campo_act['con_sbr'];
}
}

if(isset($_POST['con_sbr'])){
$con_sbr=$_POST['con_sbr'];
$id_usu=$_SESSION['id'];

$register= sbr_register($con_sbr,$id_usu);
header('Location: manage_sidebar_right.php?success=true');
exit();
}



?>
<h3> Sidebar appearance </h3>
<?php
if (isset($_GET['success']) == true && $_GET['success']==true){
echo '<div class="success"> Your settings have been successfully saved </div>';
}
?>

<form method="post" action="">
<table>
<tr> 
<td> Paste your HTML here </td>
</tr>
<tr>
<td><textarea name="con_sbr" onkeypress="return imposeMaxLength(this, 900)"; class="gtextarea">
<?php if (isset($con_sbr)){echo $con_sbr;} ?>

</textarea></td>
</tr>

</table>

<?php


?>
<p><input type="submit" value="Save" /> </p>

</form>


<?php

include 'template/footer.php';
?>