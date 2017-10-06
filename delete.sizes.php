<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();
}


if (isset($_GET['id_size'])){
$id_size= $_GET['id_size'];
delete_size($id_size);
}

header('Location: sizes.php');
exit();
?>

