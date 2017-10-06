<?php
include 'init.php';
include("template/header.php");
?>

<div id="container">
<div id="container_left">
<?php
include 'categories.php';
$actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
?>
	
</div>

<div id="container_ditems">
<div id="main">

<?php
$ip_user     = $_SERVER["REMOTE_ADDR"];
if (isset($_SESSION['user_id'])) {
$user_id      = $_SESSION['user_id']; 
}
if (!logged_in() == true) {
echo '<p>&nbsp;</p>';
echo '<div class="no_items">Please <a href="signin.php">Sign in</a> to begin shopping</div>';

} else {

if (logged_in() == true && user_activated($user_id) == false) {
echo '<p>&nbsp;</p>';
echo '<div class="no_items">Please go to your email and validate your Email to perform this action</div><br />';
echo '<div>Email didn&#39;t arrived?  <a href="send_activation_message.php"> Send email again </a> </div>';

} else {

$id_usu      = $_SESSION['user_id']; 
?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="buttacup204@aol.com">
<input type="hidden" name="currency_code" value="US">

<table border = "0" width="100%">
<tr>
<td>
<table border="1" class="shopping_bag_table">
<thead>
 <tr>
 <th colspan="2"> SHOPPING BAG </th>
 </tr>
 
</thead>
<tbody>
<?php
$sql = "SELECT cp.id_cp,cp.id_item, cp.id_size, cp.id_color, cp.id_qua, it.id_item,it.des_item, it.pri_it, si.id_size, si.des_size, co.id_color, co.des_color, it.image_id, im.image_id ,im.image_id, im.album_id, im.timestamp, im.ext FROM cart_process AS cp, items AS it, colors AS co, sizes AS si, images AS im WHERE it.id_item=cp.id_item AND co.id_color=cp.id_color AND si.id_size=cp.id_size AND it.image_id=im.image_id AND cp.del_est_cp = '0' AND cp.id_usu = '$id_usu'";
$re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();
$i = 1;
while($campo2=mysql_fetch_array($re)) {

echo '<tr>
<td width="30%">
<table>
<tr>
<td><div class="sb_image"><img class="id_img" src="uploads/thumbs/', $campo2['album_id'], '/', $campo2['image_id'], '.', $campo2['ext'], '" alt="" /></div></td>
</tr>
<tr>
<td><a href="delete.item.sb.php?id_cp='.$campo2['id_cp'].'&id_qua='.$campo2['id_qua'].'&id_item='.$campo2['id_item'].'&id_size='.$campo2['id_size'].'&id_color='.$campo2['id_color'].'">Remove</a></td>
</tr>
</table>

</td>

<td width="70%">

<table class="sb_table_inside">
<tr>
<td colspan="2"><div class="sb_title">'.$campo2['des_item'].'</div></td>
<td></td>


<input type="hidden" name="item_name_'.$i.'" value="'.$campo2['des_item'].'">
<input type="hidden" name="amount_'.$i.'" value="'.$campo2['pri_it'].'">
<input type="hidden" name="quantity_'.$i.'" value="'.$campo2['id_qua'].'">

<td class="sb_right"><div class="p_price">US$ '.number_format($campo2['id_qua'] * $campo2['pri_it'],2).'</div>';
if ($campo2['id_qua'] <> 1) { echo '<div class="little_p">US$ '.number_format($campo2['pri_it'],2).' each</div>'; }

echo '
</tr>

<tr>
<td><div class="sb_desc">Color</div></td> <td><div class="sb_desc_next">'.$campo2['des_color'].'</div></td> 
</tr>

<tr>
<td><div class="sb_desc">Size</td> </div><td><div class="sb_desc_next">'.$campo2['des_size'].'</div></td> 
</tr>

<tr>
<td><div class="sb_desc">Qty</td></div> <td><div class="sb_desc_next">'.$campo2['id_qua'].'</div></td> 
</tr>

</table>

</td>
</tr>';
$i = $i + 1;
}
?>

<?php
$sql = "SELECT SUM(it.pri_it * cp.id_qua) AS res, it.id_item, cp.id_item FROM items AS it, cart_process AS cp WHERE cp.id_item=it.id_item AND cp.del_est_cp = '0' AND cp.id_usu = '$id_usu'";
$re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();

while($campo3=mysql_fetch_array($re)) {

echo '<tr>
<td></td>
<td>Subtotal <div class="sb_subtotal">US$ '.number_format($campo3['res'],2).'</div>';
?>




</td>
</tr>
<?php
}
?>
</tbody>
</table>

</td>
<td>
 <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
<td> 
</tr>
</table>
</form>

<?php
}
}
echo '
</div>
</div>
</div>
';
include("template/footer.php");
?>
