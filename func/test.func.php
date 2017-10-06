<?php

function test_register($id_tes, $user_id, $tit_tes, $mes_tes){

$date=date('Y-m-j');
$time = date('h:i:s');

if (test_exists($id_tes)== false) {

$id_tes= mysql_real_escape_string($id_tes);
mysql_query("INSERT INTO `testimonials` VALUES ('','$user_id','".strip_tags($tit_tes)."','".strip_tags($mes_tes)."','$date','$time','')") or die ("There was an error while inserting the data").mysql_error();;

return mysql_insert_id();

} else {

$sql="UPDATE `testimonials` SET tit_tes='".strip_tags($tit_tes)."', mes_tes='".strip_tags($mes_tes)."', date='$date' ,time='$time' WHERE id_tes='$id_tes'";
$re=mysql_query($sql) or die ("There was an error while updating the data").mysql_error();
}
}

function test_exists($id_tes){

$id_tes= mysql_real_escape_string($id_tes);
$query=mysql_query("SELECT COUNT(`id_tes`) from `testimonials` WHERE `id_tes` = '$id_tes'");
return (mysql_result($query, 0) == 1) ? true : false;
}


function delete_test($id_tes) {
$id_tes= (int)$id_tes;

$sql="UPDATE `testimonials` SET del_est_tes='1' WHERE id_tes='$id_tes'";
$re=mysql_query($sql) or die ("There was an error while deleting the data").mysql_error();

}

?>

