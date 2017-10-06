<?php
include 'init.php';
if (logged_in_system()) {


if (!isset($_GET['album_id']) || empty($_GET['album_id'])){
header ('Location: albums.php');
exit();
} 


include 'template/header.php';

//echo '<div id="admin_container">';

$album_id= $_GET['album_id'];
$album_data= album_data($album_id, 'name','description');



echo '<h3>',$album_data['name'],'</h3> <p>',$album_data['description'] ,'</p>';

$album_id= $_GET['album_id'];
$images= get_images($album_id);

if (empty($images)){
echo 'There are not images in this album <a href="upload_image.php"> Upload one <a>>';
} else {
//print_r($images);

echo '<table border="0" align="center" class="display" width="100%" id="datatables">
<thead>
<tr>  
<td> IMAGENES </td>
</tr></thead>
<tbody>';
foreach ($images as $image) {
echo '<tr><td>';
echo '<a href="uploads/', $image['album'], '/', $image['id'], '.', $image['ext'],'"> <img src="uploads/thumbs/', $image['album'], '/', $image['id'], '.', $image['ext'], '" alt="" title="Uploaded ', date('D M Y / h:1',$image['timestamp']),'" /></a> [<a title="Eliminar" href="delete_image_admin.php?image_id=',$image['id'],'"> x </a>]';
//echo '<a href=""> <img src="uploads/thumbs/5/2.jpg" alt="" /> </a> [<a href="delete_image.php?image_id=">x </a>]';
echo '</td></tr>';
}
echo '</tbody></table>';
}
//echo '</div>';

echo '<p>&nbsp; </p>';
echo '<p>&nbsp; </p>';

include 'template/footer.php';
} else {
header('Location: index.php');
 exit();
}

?>