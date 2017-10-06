<?php
include 'init.php';

// if (!logged_in_system()){
// header('Location: index.php');
// exit();
// }

if (isset($_GET['id_cp']) == true && isset($_GET['id_qua']) == true && isset($_GET['id_item']) == true && isset($_GET['id_size']) == true && isset($_GET['id_color']) == true){
$id_cp    = $_GET['id_cp'];
$id_qua   = $_GET['id_qua'];
$id_item  = $_GET['id_item'];
$id_size  = $_GET['id_size'];
$id_color = $_GET['id_color'];

delete_cp_sb($id_cp, $id_qua, $id_item, $id_size, $id_color);
}

header('Location: shopping_bag.php?deleted=true');
exit();
?>