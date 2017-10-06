<?php
include 'init.php';

if (!logged_in_system()){
header ('Location: index.php');
exit();

}

if (!isset($_GET['album_id']) || empty($_GET['album_id']) || album_check($_GET['album_id'])=== false){
header ('Location: albums.php');
exit();
}


include 'template/header.php';

$album_id= $_GET['album_id'];
$album_data= album_data($album_id, 'name','description');



echo '<h3>',$album_data['name'],'</h3> <p>',$album_data['description'] ,'</p>';

$album_id= $_GET['album_id'];
$images= get_images($album_id);

if (empty($images)){
echo 'There are not images in this album <a href="upload_image.php"> Upload one <a>>';
} else {
//print_r($images);
foreach ($images as $image) {
echo '<a href="uploads/', $image['album'], '/', $image['id'], '.', $image['ext'],'"> <img src="uploads/thumbs/', $image['album'], '/', $image['id'], '.', $image['ext'], '" alt="" title="Uploaded ', date('D M Y / h:1',$image['timestamp']),'" /> </a> [<a href="delete_image.php?image_id=',$image['id'],'">x </a>]';
//echo '<a href=""> <img src="uploads/thumbs/5/2.jpg" alt="" /> </a> [<a href="delete_image.php?image_id=">x </a>]';

}

}


include 'template/footer.php';
?>