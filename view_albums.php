<?php
include 'init.php';
include 'template/header.php';

echo '<h3> View album</h3>';

$album_id= $_GET['album_id'];
$images= get_images($album_id);

if (empty($images)){
echo 'There are not images in this album';
} else {
//print_r($images);
foreach ($images as $image) {
echo '<a href=""> <img src="uploads/thumbs/', $image['album'], '/', $image['id'], '.', $image['ext'], '" alt="" /> </a> [<a href="delete_image.php?image_id=">x </a>]';
//echo '<a href=""> <img src="uploads/thumbs/5/2.jpg" alt="" /> </a> [<a href="delete_image.php?image_id=">x </a>]';

}

}


include 'template/footer.php';
?>