<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();
}

if (isset($_GET['id_item'])){
$id_size= $_GET['id_item'];

cart_temp($id_item,$user_ip,$item_avi_size,$quantity,$id_usu);

//delete_size($id_size);
}

header('Location: view_item.php?pitem=00000000085');
exit();
?>