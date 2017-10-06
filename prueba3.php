<?php
include 'init.php';
include 'template/header.php';
?>

<div class="c_type_item">Girl Dresses</div>
<hr class="style-three">
<p class="c_sb">Shop by </p>
<div class="occ" id="occ"><p>Occasion</p></div> 
<div class="occ-det" id="occ-det">
<?php 
$sql="SELECT id_oct,des_oct FROM occations WHERE del_est_oct = 0 ORDER BY des_oct ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '<ul>';
echo '<li><a href="ditems.php?ptype=occ&pkey='.$campo['id_oct'].'&page=1">'.$campo['des_oct'].'</a></li>';


echo '</ul>';
}
?>
</div>
<p>Color</p> 

<?php 
$sql="SELECT id_color,des_color FROM colors WHERE del_est_color = 0 ORDER BY des_color ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '<ul>';
echo '<li><a href="ditems.php?ptype=col&pkey='.$campo['id_color'].'&page=1">'.$campo['des_color'].'</a></li>';
echo '</ul>';
}
?>

<p>Price</p>

<?php 
echo '<ul id="none">';
echo '<li><a href="ditems.php?ptype=pri&pkey=50&page=1">Under $50</a></li>';
echo '<li><a href="ditems.php?ptype=pri&pkey=80&page=1">Under $80</a></li>';
echo '<li><a href="ditems.php?ptype=pri&pkey=100000&page=1">All prices</a></li>';
echo '</ul>';
?>




<?php
include 'template/footer.php';
?>
