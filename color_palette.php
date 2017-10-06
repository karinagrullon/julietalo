<?php
include 'init.php';
include 'template/header.php';

$obtain_data= "SELECT co.id_color, co.des_color, co.image_id, co.del_est_color, im.image_id, im.ext FROM images AS im, colors AS co WHERE del_est_color='0' AND co.image_id=im.image_id";

$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data").mysql_error();
while($campo_act=mysql_fetch_array($re)){

$image_id=$campo_act['image_id'];
$ext = $campo_act['ext'];
?>
<img src="uploads/thumbs/color/-2/<?php echo $image_id.'.'.$ext; ?>" alt="fabric" />
<?php
}
?>