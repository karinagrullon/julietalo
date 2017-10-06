<?php
include 'init.php';
If (!logged_in_system()){
header('Location: index.php');
exit();
}

include 'template/header.php';
?>

<div id="admin_container">

<?php
if (isset($_POST['album_name'],$_POST['album_description']) ){
$album_name= $_POST['album_name'];
$album_description=$_POST['album_description'];

$errors= array();
if (empty($album_name) || empty($album_description)){
$errors[]='Album name and description required';
}else{
//album validation
if (strlen($album_name)>55 || strlen($album_description)>255){
$errors[]='One or more fields contains too many characters';

}

}

if (!empty($errors)){
 foreach($errors as $error){
 echo $error, '<br/>';

 }
}else{
create_album($album_name,$album_description);
header('Location: albums.php');
exit();
}

}
?>


<h3>Create album</h3>
<form action="" method="post">
<p> Name: <br/> <input type="text" name="album_name" maxlength="55"/></p>
<p>Description: <br/><textarea name="album_description" rows="6" cols="35" maxlength="255"> </textarea></p>
<p> <input type="submit" value="Create"/></p>
</form>

</div>
<?php
include 'template/footer.php';
?>