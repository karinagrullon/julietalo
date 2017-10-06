<?php
include 'init.php';
include ("template/header.php");

if (logged_in()){
$user_data= user_data('name');
if (isset($_GET['welcome']) == true) { echo 'Welcome '.$user_data['name'].'!'; }
}
?>

<div class="made_in">
$5 STANDARD GROUND SHIPPING 
</div>

<div id="container">
<?php
//Asking if infomation has beens saved or updated correctly
if (isset($_GET['saved'])== true && $_GET['saved']==true) {
echo '<div class="success"> La informacion ha sido guardada correctamente </div>';
} else {

if (isset($_GET['updated'])== true && $_GET['updated']==true) {
echo '<div class="success"> Your information has been successfully updated </div>';
}  else {

if (isset($_GET['deleted'])== true && $_GET['deleted']==true) {
echo '<div class="success"> La informacion ha sido eliminada correctamente </div>';
} } }
?>

<!-- <div id="container_left">
<?php // include 'categories.php'; ?>
</div> -->

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
		        <img src="images/birthday_dresses_1.png" data-thumb="images/birthday_dresses_1.png" alt="one" />
                <img src="images/kirsys%20copia.png" data-thumb="images/kirsys copia.png" alt="two" />
                <img src="images/ava%20dress.jpg" data-thumb="ava ndress.jpg" alt="three" />  
            </div>
	    </div>

<div class="repeat"> </div>
<?php
$images= get_index_images();

if (empty($images)){
echo 'There are not items to perform';
} else {

foreach ($images as $image) {
echo '<div class="id_div_img"><a href="view_item.php?pitem='.$image['id_item'].'"> <img class="id_img" src="uploads/thumbs/', $image['album'], '/', $image['id'], '.', $image['ext'], '" alt="" /> </a>'; 

$imid= $image['id'].'<br />';

$query3="SELECT it.id_item,it.image_id,it.pri_it,im.image_id,it.des_item FROM items AS it,images AS im WHERE it.del_est_item=0 AND it.image_id=im.image_id AND it.image_id='$imid' ORDER BY im.image_id DESC"; 

$rer = mysql_query($query3) or die ("There was an error while obtaining the data").mysql_error();
while($campo_re=mysql_fetch_array($rer)){

echo '<div class="detail">'.$des_item=$campo_re['des_item'].'</div>';
echo '<div class="price">$'.$pri_it=$campo_re['pri_it'].'</div>';

} 

echo '</div>';

}

}


?>


</div>

<?php
//include 'template/sidebar_right.php';

?>

<?php
include("template/footer1.php");

?>
