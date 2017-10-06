<?php

function oct_register($id_oct,$des_oct,$id_usu){

if (oct_exists($id_oct)== false AND oct_exists($des_oct) == false)   {

$date=date('Y-m-j h:i:s');
$id_oct= mysql_real_escape_string($id_oct);
mysql_query("INSERT INTO `occations` VALUES ('','$des_oct','$id_usu','$date','')");

return mysql_insert_id();

}else{

$sql="UPDATE `occations` SET des_oct='$des_oct',id_usu='$id_usu',date='$date' WHERE id_oct='$id_oct'";
$re=mysql_query($sql) or die ("Error al actualizar los datos").mysql_error();

}
}

function oct_exists($id_oct){

$id_oct= mysql_real_escape_string($id_oct);
$query=mysql_query("SELECT COUNT(`id_oct`) from `occations` WHERE `id_oct` = '$id_oct'");
return (mysql_result($query, 0) == 1) ? true : false;

}


function octd_exists($des_oct){

$des_oct= mysql_real_escape_string($des_oct);
$query=mysql_query("SELECT COUNT(`des_oct`) from `occations` WHERE `des_oct` = '$des_oct'");
return (mysql_result($query, 0) == 1) ? true : false;

}




function delete_oct($id_oct) {
$id_oct= (int)$id_oct;
//mysql_query("DELETE FROM `occations` WHERE `id_oct`=$id_oct");

$sql="UPDATE `occations` SET del_est_oct=1 WHERE id_oct='$id_oct'";



$re=mysql_query($sql) or die ("Error al eliminar los datos").mysql_error();

}

?>

