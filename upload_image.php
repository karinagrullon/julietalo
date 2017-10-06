<?php
include 'init.php';
If (!logged_in_system()){
header('Location: index.php');
exit();
}



include 'template/header.php';
?>

<div id="admin_container">
<h3>Upload image </h3>

<?php

if (isset($_FILES['image'])){
$image_name= $_FILES['image']['name'];
$image_size= $_FILES['image']['size'];
$image_temp= $_FILES['image']['tmp_name'];

$allowed_ext= array('jpg','jpeg','png','gif');
$image_ext= strtolower(end(explode('.',$image_name)));
$album_id= -1;

$errors= array();

if (empty($image_name)){
if ($album_id==-1){
$album_id=-1;
}
$errors[]= 'Something is missing';

} else{
 if (in_array($image_ext, $allowed_ext)=== false){
$errors[]= 'File type not allowed';

}

if ($image_size > 2097152){
 $errors[] ='Maximimun file size is 2mb';

}

if($album_id != -1){
if (album_check($album_id) == false){
 $errors[]=  'Could\'t upload to that album'.$album_id;
}
}


if ($album_id == "--Choose--"){
 $errors[]=  'Choose an album please!';
}


}
if (!empty($errors)){
foreach ($errors  as $error) {
echo $error, '<br />';
}

} else {
//Upload the image
upload_image_small($image_temp,$image_ext,$album_id);
if ($album_id=='-1') {
header ('Location: view_images.php?album_id='.$album_id);
exit();
} else {
header ('Location: view_album.php?album_id='.$album_id);
exit();
}


}

}

$albums= get_albums();
if (empty($albums)){
echo '<p>You don\'t have any albums. <a href="create_album.php">Create an album</a> </p>';

}else{

?>
<form action="" method="POST" enctype="multipart/form-data">
<p>Choose a field: <br /><input type="file" name="image" /> </p>

<p><input type="submit" value="Upload" /> </p>

</form>
</div>
<?php

}


include 'template/footer.php';
?>