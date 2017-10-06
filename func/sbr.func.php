<?php

function sbr_register($con_sbr,$id_usu){
$fecha_tiempo=date('Y-m-j h:i:s');
if (empty($con_sbr) == true) {
$con_sbr= mysql_real_escape_string($con_sbr);
mysql_query("INSERT INTO `sidebar_right` VALUES ('','".trim($con_sbr)."','$fecha_tiempo','$id_usu')");
return mysql_insert_id();
} else {

$sql="UPDATE `sidebar_right` SET con_sbr='".trim($con_sbr)."',fec_upd='$fecha_tiempo',id_usu='$id_usu'";
$re=mysql_query($sql) or die ("Error al actualizar los datos").mysql_error();
} 
}

function con_sbr_empty($con_sbr){
$con_sbr= mysql_real_escape_string($con_sbr);
return (empty($con_sbr)) ? true : false;
}

?>