<?php

function upit_register($id_item, $max_image, $id_oct, $id_fabric, $id_it_type, $id_ist, $id_istc, $des_item, $id_it_feat, $cos_it, $pri_it, $id_usu, $id_it_ma_co, $feats){

if (upit_exists($id_item) == false)   {

$date=date('Y-m-j h:i:s');
$id_item= mysql_real_escape_string($id_item);

if (!empty($feats)) {
foreach($feats as $feat) {
mysql_query("INSERT INTO `item_features` VALUES ('','$id_item','$feat','$date','$id_usu','')");
}
}

mysql_query("INSERT INTO `items` (`id_item`,`image_id`,`id_oct`,`id_it_type`,`id_ist`,`id_istc`,`id_fabric`,`des_item`,`cos_it`,`pri_it`,`id_usu`,`date`,`del_est_item`) VALUES ('','$max_image','$id_oct','$id_it_type','$id_ist','$id_istc','$id_fabric','".trim($des_item)."','$cos_it','$pri_it','$id_usu','$date','')");
mysql_query("INSERT INTO `item_main_color` (`id_it_ma_co`,`id_item`,`id_color`,`date`,`id_usu`,`del_est_it_ma_co`) VALUES ('','$id_item','$id_it_ma_co','$date','$id_usu','')");

if (!empty($uploaded)) {
foreach($uploaded as $uplo) {
mysql_query("INSERT INTO `item_sec_images` VALUES('','$id_item','$uplo')");
}
}

return mysql_insert_id();

} else {

//Items
$sql="UPDATE `items` SET id_oct='$id_oct',id_fabric='$id_fabric',des_item='$des_item',cos_it='$cos_it',pri_it='$pri_it',id_usu='$id_usu',date='$date' WHERE id_item='$id_item'";
$re=mysql_query($sql) or die ("There was an error while updating items data ").mysql_error();

//Features
$sql="UPDATE `item_features` SET del_est_feat = '1' WHERE id_item='$id_item'";
$re=mysql_query($sql) or die ("There was an error while updating item feat data ").mysql_error();


if (!empty($feats)) {
foreach($feats as $feat) {
mysql_query("INSERT INTO `item_features` VALUES ('','$id_item','$feat','$date','$id_usu','')");
}
}

//Item main color
$sql_itm="UPDATE `item_main_color` SET id_color='$id_it_ma_co',date='$date',id_usu='$id_usu' WHERE id_item='$id_item'";
$re_itm=mysql_query($sql_itm) or die ("There was an error while updating item main color data ").mysql_error();

}

}

function upit_exists($id_item){

$id_item= mysql_real_escape_string($id_item);
$query=mysql_query("SELECT COUNT(`id_item`) from `items` WHERE `id_item` = '$id_item'");
return (mysql_result($query, 0) == 1) ? true : false;
}


function delete_upit($id_item) {
$id_item= (int)$id_item;
$sql="UPDATE `items` SET del_est_item=1 WHERE id_item='$id_item'";
$re=mysql_query($sql) or die ("Error al eliminar los datos").mysql_error();

$sql_ditmc="UPDATE `item_main_color` SET del_est_it_ma_co=1 WHERE id_item='$id_item'";
$re_ditmc=mysql_query($sql_ditmc) or die ("There was an error while deleting the data").mysql_error();

}



function array_menor($feats,$id_item){

$query=mysql_query("SELECT COUNT(`id_item`) from `item_features` WHERE `id_item` = '$id_item'");
$re= count($feats);

return (mysql_result($query, 0) < $re) ? true : false;

}



?>

