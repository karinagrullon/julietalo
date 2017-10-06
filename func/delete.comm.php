<?php
include 'init.php';

if (!logged_in()) {
header('Location: index.php');
exit();
}

if (isset($_GET['id_com']) && isset($_GET['id_item'])) {
$id_item = $_GET['id_item'];
$id_com= $_GET['id_com'];
delete_comm($id_com);
}

header('Location: view_item.php?id_item='.$id_item.'&deleted=true');
exit();
?>