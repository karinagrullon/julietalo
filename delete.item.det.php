<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();
}


if (isset($_GET['id_itd'])){
$id_itd= $_GET['id_itd'];
delete_itd($id_itd);
}

header('Location: upload_item_details.php?deleted=true');
exit();

?>