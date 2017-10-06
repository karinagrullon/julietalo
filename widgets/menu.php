<div class= "main_header">
<nav class= "main_nav">
<ul id="nav">
<!-- 
<li><a href="ditems.php?id_it_type=00001">GIRLS</a>

<ul class="subs">
    <li class="sub_head"><a href="#">Clothing</a></li>
	<li><a href="#">Dresses</a></li>
</ul>
</li>


<li><a href="#">WOMEN</a>
<ul class="subs">
    <li class="sub_head"><a href="#">Clothing</a></li>
	<li><a href="#">Dresses</a></li>
</ul>
</li>

<li><a href="#">MEN</a>
<ul class="subs">
    <li class="sub_head"><a href="#">Clothing</a></li>
	<li><a href="#">Shirts</a></li>
</ul>
</li>

<li><a href="#">HOUSE</a>
<ul class="subs">
    <li class="sub_head"><a href="#">Home Essencials</a></li>
	<li><a href="#">Bed & Bath</a></li>
</ul>
</li>
-->

<?php 
$sql="SELECT distinct(itt.id_it_type), itt.des_it_type, ist.id_ist, ist.des_ist, istc.id_istc, istc.des_istc, it.id_ist, it.id_istc, it.id_it_type  FROM item_type AS itt,item_sub_type AS ist,item_sub_type_cat AS istc, items AS it WHERE itt.del_est_it_type = 0 AND it.id_ist = ist.id_ist AND it.id_istc= istc.id_istc AND it.id_it_type= itt.id_it_type ORDER BY itt.id_it_type ASC";
$re= mysql_query($sql) or die ("Error in menu").mysqlerror();
while($campo =mysql_fetch_array($re)){
echo '

<li class="divider-vertical"><a href="#">'.$campo['des_it_type'].'</a>
<ul class="subs">
    <li class="sub_head"><a href="#">'.$campo['des_ist'].'</a></li>
	<li><a href="ditems.php?itype='.$campo['id_it_type'].'&iist='.$campo['id_ist'].'&iistc='.$campo['id_istc'].' &page=1">'.$campo['des_istc'].'</a></li>
</ul>
</li>';
}
?>

</ul>
</nav>
</div>

