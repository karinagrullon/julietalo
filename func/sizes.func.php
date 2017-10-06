<?php

function size_register($id_size,$id_it_type,$des_size,$id_usu){

if (size_exists($id_size)== false AND sized_exists($des_size) == false)   {

$date=date('Y-m-j h:i:s');
$id_size= mysql_real_escape_string($id_size);
mysql_query("INSERT INTO `sizes` VALUES ('','$id_it_type','$des_size','$date','$id_usu','')");

return mysql_insert_id();

}else{

$sql="UPDATE `sizes` SET id_it_type='$id_it_type',des_size='$des_size',id_usu='$id_usu',date='$date' WHERE id_size='$id_size'";
$re=mysql_query($sql) or die ("There was an error while updating the data").mysql_error();

}

}

function size_exists($id_size){

$id_size= mysql_real_escape_string($id_size);
$query=mysql_query("SELECT COUNT(`id_size`) from `sizes` WHERE `id_size` = '$id_size'");
return (mysql_result($query, 0) == 1) ? true : false;

}


function sized_exists($des_size){

$des_size= mysql_real_escape_string($des_size);
$query=mysql_query("SELECT COUNT(`des_size`) from `sizes` WHERE `des_size` = '$des_size'");
return (mysql_result($query, 0) >= 1) ? true : false;

}




function delete_size($id_size) {
$id_size= (int)$id_size;
//mysql_query("DELETE FROM `sizes` WHERE `id_size`=$id_size");

$sql="UPDATE `sizes` SET del_est_size=1 WHERE id_size='$id_size'";



$re=mysql_query($sql) or die ("There was an error while deleting the data").mysql_error();

}

?>

