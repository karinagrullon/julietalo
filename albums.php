<?php
include 'init.php';
if(!logged_in_system()){
header('Location:index.php');
exit();
}

include 'template/header.php';
?>

<div id="admin_container">
<h3>Albums</h3>

<?php

//print_r(get_albums());

$albums= get_albums();
if (empty($albums)){
echo '<p> You don\'t have any albums</p>';
}else{
foreach($albums as $album){
echo '<p><a href="view_album.php?album_id=',$album['id'], '">', $album['name'], '</a> (', $album['count'],' images)<br/>
', $album['description'],'...<br/>
<a href="edit_album.php?album_id=',$album['id'],'">Edit </a> / <a href="delete_album.php?album_id=',$album['id'],'">Delete </a>
</p>';

}
}

echo '</div>';
include 'template/footer.php';
?>