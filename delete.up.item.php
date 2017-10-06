<?php
include 'init.php';

if (!logged_in_system()){
header('Location: index.php');
exit();

}


if (isset($_GET['id_item']) && isset($_GET['image_id'])){
$id_item= $_GET['id_item'];
$image_id= $_GET['image_id'];

echo $image_id;
delete_upit($id_item); 
erase_image($image_id);

}


header('Location: upload_item.php?deleted=true');
exit();

?>