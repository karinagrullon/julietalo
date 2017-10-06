<?php

function color_register($id_color,$des_color,$max_image,$id_usu){

$date=date('Y-m-j h:i:s');

if (color_exists($id_color)== false)   {
$id_color= mysql_real_escape_string($id_color);
mysql_query("INSERT INTO `colors` VALUES ('','$des_color','$max_image','$id_usu','$date','')");

return mysql_insert_id();

} else {

$sql="UPDATE `colors` SET des_color='$des_color',id_usu='$id_usu',date='$date' WHERE id_color='$id_color'";
$re=mysql_query($sql) or die ("Error al actualizar los datos").mysql_error();

}
}

function color_exists($id_color){

$id_color= mysql_real_escape_string($id_color);
$query=mysql_query("SELECT COUNT(`id_color`) from `colors` WHERE `id_color` = '$id_color'");
return (mysql_result($query, 0) == 1) ? true : false;

}


function colord_exists($des_color){

$des_color= mysql_real_escape_string($des_color);
$query=mysql_query("SELECT COUNT(`des_color`) from `colors` WHERE `des_color` = '$des_color'");
return (mysql_result($query, 0) == 1) ? true : false;

}




function delete_color($id_color) {
$id_color= (int)$id_color;
//mysql_query("DELETE FROM `colors` WHERE `id_color`=$id_color");
$sql="UPDATE `colors` SET del_est_color=1 WHERE id_color='$id_color'";
$re=mysql_query($sql) or die ("Error al eliminar los datos").mysql_error();

}

?>

