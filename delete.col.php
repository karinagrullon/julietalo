<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();

}


if (isset($_GET['id_color'])){
$id_color= $_GET['id_color'];
delete_color($id_color);

}
header('Location: colors.php?deleted=true');
exit();

?>