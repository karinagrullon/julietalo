<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();
}


if (isset($_GET['id_fabric'])){
$id_fabric= $_GET['id_fabric'];
delete_fabric($id_fabric);
}

header('Location: fabrics.php?deleted=true');
exit();
?>