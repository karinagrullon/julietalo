<ul id="nav_upper">
<?php
if (!logged_in()) {
?>

<li><a href="shopping_bag.php">SHOPPING BAG</a></li>
<li><a href="testimonials.php">TESTIMONIALS</a></li>
<li><a href="contactus.php">CONTACT US</a></li>

<?php
} else {
?>

<li><?php
    $ip_user = $_SERVER['REMOTE_ADDR'];
    $id_usu  = $_SESSION['user_id'];
    $sql1    = "SELECT SUM(`id_qua`) AS `cantidad`,`ip_user` FROM cart_process WHERE `id_usu` = '$id_usu' AND del_est_cp = '0'";
    $re = mysql_query($sql1) or die("Error al ejecutar consulta 1") . mysqlerror();
    while ($campo = mysql_fetch_array($re)) {
      $qua_item_cart = $campo['cantidad'];
      echo '<div class="sho_qua">'.$qua_item_cart.'</div>';
    }
?></li>
<li><a href="shopping_bag.php">SHOPPING BAG</a></li>
								<li><a href="testimonials.php">TESTIMONIALS</a></li>
                    <li><a href="contactus.php">CONTACT US</a></li>
                   
                
                </ul>

<?php
}
?>



