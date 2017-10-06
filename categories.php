
<?php
if(isset($GET['itype']) == true) {
$itype = $_GET['itype'];
}

if(isset($GET['iist']) == true) {
$iist = $_GET['iist'];
}

if(isset($GET['iistc']) == true) {
$iistc = $_GET['iistc'];
}

if (isset($itype) == true && isset($iist) == true && isset($iistc) == true) {
?>

<div class="c_type_item">Girl Dresses</div>
<hr class="style-three">
<div class="c_sb">Shop by </div>
<div class="occ" id="occ">Occasion</div> 
<div class="occ-det" id="occ-det">
<?php 
   $sql ="SELECT
   distinct(oc.id_oct),
   oc.des_oct,
   itt.id_it_type,
   ist.id_ist,
   istc.id_istc,
   it.id_ist,
   it.id_istc,
   it.id_it_type  
FROM
   occations AS oc ,
   item_type AS itt,
   item_sub_type AS ist,
   item_sub_type_cat AS istc,
   items AS it 
WHERE
   it.id_oct  = oc.id_oct
   AND oc.del_est_oct = 0 
   AND it.id_ist = ist.id_ist 
   AND it.id_istc= istc.id_istc 
   AND it.id_it_type= itt.id_it_type 
   AND it.id_it_type = '$itype'
   AND it.id_ist = '$iist'
   AND it.id_istc = '$iistc'
   ORDER BY
   oc.id_oct ASC"; 
 
//$sql="SELECT id_oct,des_oct FROM occations WHERE del_est_oct = 0 ORDER BY des_oct ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '<ul class="cat_list">';
echo '<li><a href="ditems.php?ptype=occ&pkey='.$campo['id_oct'].'&page=1">'.$campo['des_oct'].'</a></li>';
echo '</ul>';
}
?>
</div>
<div class="col" id="col">Color</div> 
<div class="col-det" id="col-det">
<?php 

  $sql ="SELECT
   distinct(co.id_color),
   imc.id_color,
   co.des_color,
   itt.id_it_type,
   ist.id_ist,
   istc.id_istc,
   it.id_ist,
   it.id_istc,
   it.id_it_type  
FROM
   colors AS co ,
   item_type AS itt,
   item_sub_type AS ist,
   item_sub_type_cat AS istc,
   items AS it, 
   item_main_color AS imc
WHERE
   it.id_item = imc.id_item
   AND imc.id_color = co.id_color
   AND co.del_est_color = 0 
   AND it.id_ist = ist.id_ist 
   AND it.id_istc= istc.id_istc 
   AND it.id_it_type= itt.id_it_type 
   AND it.id_it_type = '$itype'
   AND it.id_ist = '$iist'
   AND it.id_istc = '$iistc'
   ORDER BY
   co.des_color ASC"; 

//$sql="SELECT id_color,des_color FROM colors WHERE del_est_color = 0 ORDER BY des_color ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '<ul class="cat_list">';
//echo '<li><a href="ditems.php?ptype=col&pkey='.$campo['id_color'].'&page=1">'.$campo['des_color'].'</a></li>';

echo '<li><a href="ditems.php?ptype=col&pkey='.$campo['id_color'].'&itype='.$itype.'&iist='.$iist.'&iistc='.$iistc.'&page=1">'.$campo['des_color'].'</a></li>';
echo '</ul>';
}
?>
</div>

<div class="pri" id="pri">Price</div>
<div class="pri-det" id="pri-det">
<?php 
echo '<ul class="cat_list">';
echo '<li><a href="ditems.php?ptype=pri&pkey=50&page=1">Under $50</a></li>';
echo '<li><a href="ditems.php?ptype=pri&pkey=80&page=1">Under $80</a></li>';
echo '<li><a href="ditems.php?ptype=pri&pkey=100000&page=1">All prices</a></li>';
echo '</ul>';
?>
</div>

<?php
} else {
?>




<div class="c_type_item">Girl Dresses</div>
<hr class="style-three">
<div class="c_sb">Shop by </div>
<div class="occ" id="occ">Occasion</div> 
<div class="occ-det" id="occ-det">
<?php 
$sql="SELECT id_oct,des_oct FROM occations WHERE del_est_oct = 0 ORDER BY des_oct ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '<ul class="cat_list">';
echo '<li><a href="ditems.php?ptype=occ&pkey='.$campo['id_oct'].'&page=1">'.$campo['des_oct'].'</a></li>';
echo '</ul>';
}
?>
</div>
<div class="col" id="col">Color</div> 
<div class="col-det" id="col-det">
<?php 
$sql="SELECT id_color,des_color FROM colors WHERE del_est_color = 0 ORDER BY des_color ASC";
$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '<ul class="cat_list">';
echo '<li><a href="ditems.php?ptype=col&pkey='.$campo['id_color'].'&page=1">'.$campo['des_color'].'</a></li>';
echo '</ul>';
}
?>
</div>

<div class="pri" id="pri">Price</div>
<div class="pri-det" id="pri-det">
<?php 
echo '<ul class="cat_list">';
echo '<li><a href="ditems.php?ptype=pri&pkey=50&page=1">Under $50</a></li>';
echo '<li><a href="ditems.php?ptype=pri&pkey=80&page=1">Under $80</a></li>';
echo '<li><a href="ditems.php?ptype=pri&pkey=100000&page=1">All prices</a></li>';
echo '</ul>';
?>
</div>

<?php 
}
?>
