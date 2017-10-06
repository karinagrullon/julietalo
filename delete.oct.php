<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();

}


if (isset($_GET['id_oct'])){
$id_oct= $_GET['id_oct'];
delete_oct($id_oct);

}
header('Location: occations.php?deleted=true');
exit();

?>