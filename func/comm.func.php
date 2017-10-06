<?php

function comm_register($id_com, $id_item, $user_id, $tit_com, $mes_com){

$date=date('Y-m-j');
$time = date('h:i:s');

if (comm_exists($id_com)== false) {

$id_com= mysql_real_escape_string($id_com);
mysql_query("INSERT INTO `comments` VALUES ('','$id_item','$user_id','".strip_tags($tit_com)."','".strip_tags($mes_com)."','$date','$time','')") or die ("There was an error while inserting the data").mysql_error();;

return mysql_insert_id();

} else {

$sql="UPDATE `comments` SET tit_com='".strip_tags($tit_com)."', mes_com='".strip_tags($mes_com)."', date='$date' ,time='$time' WHERE id_com='$id_com'";
$re=mysql_query($sql) or die ("There was an error while updating the data").mysql_error();
}

}

function comm_exists($id_com){

$id_com= mysql_real_escape_string($id_com);
$query=mysql_query("SELECT COUNT(`id_com`) from `comments` WHERE `id_com` = '$id_com'");
return (mysql_result($query, 0) == 1) ? true : false;

}



function delete_comm($id_com) {
$id_com= (int)$id_com;

$sql="UPDATE `comments` SET del_est_com='1' WHERE id_com='$id_com'";
$re=mysql_query($sql) or die ("There was an error while deleting the data").mysql_error();

}

?>

