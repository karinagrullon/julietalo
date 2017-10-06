<?php
include 'init.php';
include ("template/header.php");
?>

<div id="container">
<div id="container_left">
<?php include 'categories.php'; 

?>

</div>

<div id="container_ditems">

<div id="main">

<?php 
$x = 2;
//Obtain drectory
if (isset($_GET['pkey']) && isset($_GET['ptype'])) {

$pkey= $_GET['pkey'];
$ptype = $_GET['ptype'];

switch ($ptype) {
    case 'occ':
        $sb= " Occasion";
$obtain_data= "SELECT id_oct,des_oct FROM occations WHERE id_oct='$pkey'";
$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data items").mysql_error();
while($campo_act=mysql_fetch_array($re)){
$des_pkey=$campo_act['des_oct'];
}
		break;
    case 'col':
        $sb= " Colors";
$obtain_data= "SELECT id_color,des_color FROM colors WHERE id_color='$pkey'";
$re = mysql_query($obtain_data) or die ("There was an error while obtaining the data items").mysql_error();
while($campo_act=mysql_fetch_array($re)){
$des_pkey=$campo_act['des_color'];
}		
		break;
    case 'pri':
        $sb= " Prices";
		if ($pkey == '100000') {
$des_pkey='All prices';
} else { $des_pkey='Under '.$pkey; }
		break;
}
}

?>

<div id="bread">
<ul>
 <li class="first"> <?php if (isset($sb)) { echo '<a href="#">'.$sb.'</a>'; }  ?>
 <ul>
<li>&gt;&gt; <?php if (isset($des_pkey)) { echo '<a href="#">'.$des_pkey.'</a>'; }  ?>
 </ul>
</div>

<!-- Filter by -->

<div>
<div class="filterBy" id="filterByDiv">
Filter by
</div>

<div id="accordionDiv" class="filterAccordion">

<div>
 <div id="Psize" class="psize"> Size</div>
  <div id ="Csize" class="csize">
   
   <?php
   display_sizes();
   ?>
   
  </div>
  </div>
  
  <div>
  <div id="Pcolor" class="pcolor"> Color</div>
  <div id ="Ccolor" class="ccolor">
    <?php
   display_colors();
   ?>
  </div>
  </div>
  
    <div>
  <div id="Pprice" class="pprice"> Price </div>
  <div id ="Cprice" class="cprice">
    <ul>
      <li>List item one</li>
      <li>List item two</li>
      <li>List item three</li>
    </ul>
  </div>
  </div>
  <input type="submit" value="Apply" class="blogin"/>
  </div>

</div>



<?php
$per_page= 40;

if ($ptype=='occ') { 

//Pagination occasions
$pages_query= mysql_query("SELECT COUNT(it.id_item) FROM `items` AS it, items_detail AS itd WHERE itd.id_item=it.id_item AND itd.id_qua <> '0' AND it.del_est_item=0 AND itd.del_est_itd = '0' AND it.id_oct='$pkey' GROUP BY itd.id_item");
$pages_query = mysql_num_rows($pages_query);

$pages = $pages_query / $per_page;
$page= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start= ($page -1) * $per_page;
$images= get_occ_images($pkey,$start,$per_page);


//Paginatinon
echo '<div class="pag_align">';
$request = 'ditems.php?'.$_SERVER['QUERY_STRING'];
$varname= 'page';
removeqsvar($request, $varname);
$page_previous= $_GET['page'] - 1;
$page_next= $_GET['page'] + 1;
if($page_previous == 0){ $pp= 'previous-off'; } else { $pp= 'previous'; }

echo '<ul id="pagination-digg"><li class="'.$pp.'"><a href="'.removeqsvar($request, $varname).'page='.$page_previous.'"> < </a></li>';

if ($pages >= 1 && $page <= $pages) {

If ($pages <> 1) {
for ($x=1; $x<=$pages; $x++) {
echo ($x == $page) ?  '<li class="active">'.$x.'</li>' : '<li><a href="'.removeqsvar($request, $varname).'page='.$x.'">'.$x.'</a> </li>';

}
}

// $xx= $x-1;
$xx= $x-1;
if( !isset($x) || $xx == $page) { $pn='next-off'; } else { $pn='next'; }

echo '<li class="'.$pn.'"><a href="'.removeqsvar($request, $varname).'page='.$page_next.'"> > </a></li></ul></div>';

}


} else {

if ($ptype == 'col') {

$pages_query= mysql_query("SELECT COUNT(it.id_item), mc.id_item, mc.id_color, itd.id_item, itd.id_qua FROM items AS it, item_main_color AS mc, items_detail AS itd WHERE mc.id_color = '$pkey' AND it.id_item = itd.id_item AND it.id_item=mc.id_item AND it.del_est_item = '0' AND itd.del_est_itd = '0' AND itd.id_qua <> '0' GROUP BY it.id_item ");
 
$pages_query = mysql_num_rows($pages_query);
//$pages= ceil($pages= mysql_result($pages_query, 0) / $per_page);
$pages = $pages_query / $per_page;
$page= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start= ($page -1) * $per_page;
$images= get_col_images($pkey,$start,$per_page);


//Paginatinon
echo '<div class="pag_align">';
$request = 'ditems.php?'.$_SERVER['QUERY_STRING'];
$varname= 'page';
removeqsvar($request, $varname);
$page_previous= $_GET['page'] - 1;
$page_next= $_GET['page'] + 1;
if($page_previous == 0){ $pp= 'previous-off'; } else { $pp= 'previous'; }

echo '<ul id="pagination-digg"><li class="'.$pp.'"><a href="'.removeqsvar($request, $varname).'page='.$page_previous.'"> < </a></li>';

if ($pages >= 1 && $page <= $pages) {

If ($pages <> 1) {


for ($x=1; $x<=$pages; $x++) {


echo ($x == $page) ?  '<li class="active">'.$x.'</li>' : '<li><a href="'.removeqsvar($request, $varname).'page='.$x.'">'.$x.'</a> </li>';
}
}

$xx= $x-1;
if( !isset($x) || $xx == $page) { $pn='next-off'; } else { $pn='next'; }

echo '<li class="'.$pn.'"><a href="'.removeqsvar($request, $varname).'page='.$page_next.'"> > </a></li></ul></div>'; }


} else {
if ($ptype == 'pri') {

//$pages_query= mysql_query("SELECT COUNT(it.id_item), iaq.id_item, iaq.id_qua FROM items AS it, item_avi_qua AS iaq WHERE it.id_item=iaq.id_item AND iaq.id_qua <> '0' AND iaq.del_est_it_qua = '0' AND it.del_est_item='0' AND it.pri_it < '$pkey'");
$pages_query= mysql_query("SELECT COUNT(it.id_item), itd.id_item, itd.id_qua FROM items AS it, items_detail AS itd WHERE itd.id_qua <> '0' AND it.id_item=itd.id_item AND itd.del_est_itd = '0' AND it.del_est_item='0' AND it.pri_it < '$pkey' GROUP BY it.id_item");
$pages_query = mysql_num_rows($pages_query);
//$pages= ceil($pages= mysql_result($pages_query, 0) / $per_page);
$pages = $pages_query / $per_page;
$page= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start= ($page -1) * $per_page;

$images= get_pri_images($pkey,$start,$per_page);

//Paginatinon
echo '<div class="pag_align">';
$request = 'ditems.php?'.$_SERVER['QUERY_STRING'];
$varname= 'page';
removeqsvar($request, $varname);
$page_previous= $_GET['page'] - 1;
$page_next= $_GET['page'] + 1;
if($page_previous == 0){ $pp= 'previous-off'; } else { $pp= 'previous'; }

echo '<ul id="pagination-digg"><li class="'.$pp.'"><a href="'.removeqsvar($request, $varname).'page='.$page_previous.'"> < </a></li>';

if ($pages >= 1 && $page <= $pages) {

If ($pages <> 1) {


for ($x=1; $x<=$pages; $x++) {


echo ($x == $page) ?  '<li class="active">'.$x.'</li>' : '<li><a href="'.removeqsvar($request, $varname).'page='.$x.'">'.$x.'</a> </li>';
}
}

$xx= $x-1;
if( !isset($x) || $xx == $page) { $pn='next-off'; } else { $pn='next'; }

echo '<li class="'.$pn.'"><a href="'.removeqsvar($request, $varname).'page='.$page_next.'"> > </a></li></ul></div>'; }
}
}
}

//Inicio Item sub type category 
if (isset($itype) == true && isset($iist) == true && isset($iistc) == true) {
	
$itype = $_GET['itype'];
$iist = $_GET['iist'];
$iistc = $_GET['iistc'];

$ptype= 0;
$pkey = 0;

$pages_query= mysql_query("SELECT count(distinct(itt.id_it_type)), itt.des_it_type, ist.id_ist, ist.des_ist, istc.id_istc, istc.des_istc, it.id_ist, it.id_istc, it.id_it_type  FROM item_type AS itt,item_sub_type AS ist,item_sub_type_cat AS istc, items AS it WHERE itt.del_est_it_type = 0 AND it.id_ist = ist.id_ist AND it.id_istc= istc.id_istc AND it.id_it_type= itt.id_it_type ORDER BY itt.id_it_type ASC");
$pages_query = mysql_num_rows($pages_query);
$pages = $pages_query / $per_page;
$page= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start= ($page -1) * $per_page;

$images= get_menu_images($itype,$iist,$iistc,$start,$per_page);

//Pagination
echo '<div class="pag_align">';
$request = 'ditems.php?'.$_SERVER['QUERY_STRING'];
$varname= 'page';
removeqsvar($request, $varname);
$page_previous= $_GET['page'] - 1;
$page_next= $_GET['page'] + 1;
if($page_previous == 0){ $pp= 'previous-off'; } else { $pp= 'previous'; }

echo '<ul id="pagination-digg"><li class="'.$pp.'"><a href="'.removeqsvar($request, $varname).'page='.$page_previous.'"> < </a></li>';

if ($pages >= 1 && $page <= $pages) {

If ($pages <> 1) {


for ($x=1; $x<=$pages; $x++) {


echo ($x == $page) ?  '<li class="active">'.$x.'</li>' : '<li><a href="'.removeqsvar($request, $varname).'page='.$x.'">'.$x.'</a> </li>';
}
}

$xx= $x-1;
if( !isset($x) || $xx == $page) { $pn='next-off'; } else { $pn='next'; }

echo '<li class="'.$pn.'"><a href="'.removeqsvar($request, $varname).'page='.$page_next.'"> > </a></li></ul></div>'; }
}


//Fin Item sub type category 




//Inicio Item sub type category con ocasiones

if (isset($itype) == true && isset($iist) == true && isset($iistc) == true && isset($_GET['ptype']) && isset($_GET['pkey'])) {
$itype = $_GET['itype'];
$iist = $_GET['iist'];
$iistc = $_GET['iistc'];

$ptype= $_GET['ptype'];
$pkey = $_GET['pkey'];


$pages_query= mysql_query("SELECT count(distinct(itt.id_it_type)), itt.des_it_type, ist.id_ist, ist.des_ist, istc.id_istc, istc.des_istc, it.id_ist, it.id_istc, it.id_it_type  FROM item_type AS itt,item_sub_type AS ist,item_sub_type_cat AS istc, items AS it WHERE itt.del_est_it_type = 0 AND it.id_ist = ist.id_ist AND it.id_istc= istc.id_istc AND it.id_it_type= itt.id_it_type ORDER BY itt.id_it_type ASC");
$pages_query = mysql_num_rows($pages_query);
$pages = $pages_query / $per_page;
$page= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start= ($page -1) * $per_page;


$images= get_menu_images($itype,$iist,$iistc,$start,$per_page);

//Pagination
echo '<div class="pag_align">';
$request = 'ditems.php?'.$_SERVER['QUERY_STRING'];
$varname= 'page';
removeqsvar($request, $varname);
$page_previous= $_GET['page'] - 1;
$page_next= $_GET['page'] + 1;
if($page_previous == 0){ $pp= 'previous-off'; } else { $pp= 'previous'; }

echo '<ul id="pagination-digg"><li class="'.$pp.'"><a href="'.removeqsvar($request, $varname).'page='.$page_previous.'"> < </a></li>';

if ($pages >= 1 && $page <= $pages) {

If ($pages <> 1) {


for ($x=1; $x<=$pages; $x++) {


echo ($x == $page) ?  '<li class="active">'.$x.'</li>' : '<li><a href="'.removeqsvar($request, $varname).'page='.$x.'">'.$x.'</a> </li>';
}
}

$xx= $x-1;
if( !isset($x) || $xx == $page) { $pn='next-off'; } else { $pn='next'; }

echo '<li class="'.$pn.'"><a href="'.removeqsvar($request, $varname).'page='.$page_next.'"> > </a></li></ul></div>'; }
}

//Fin Item sub type category con ocasiones


echo '</div>';
// echo '<table class="block_img"><tr><td>';

if (empty($images)){
echo '<div class="no_items">Sorry, there are not items with this criteria</div>';
} else {
echo '<div>';
foreach ($images as $image) {
echo '<div class="ditems_div_img"> <a href="view_item.php?ptype='.$ptype.'&pkey='.$pkey.'&pitem='.$image['id_item'].'"> <img class="ditems_img" src="uploads/thumbs/', $image['album'], '/', $image['id'], '.', $image['ext'], '" alt="" /> </a>'; 

$imid= $image['id'].'<br />';

$query3="SELECT it.id_item,it.image_id,it.pri_it,im.image_id,it.des_item FROM items AS it,images AS im WHERE it.del_est_item=0 AND it.image_id=im.image_id AND it.image_id='$imid' ORDER BY im.image_id DESC"; 

$rer = mysql_query($query3) or die ("There was an error while obtaining the data").mysql_error();
while($campo_re=mysql_fetch_array($rer)){

echo '<div class="di_detail">'.$des_item=$campo_re['des_item'].'</div>';
echo '<div class="di_price">$'.$pri_it=$campo_re['pri_it'].'</div>';

} 

echo '</div>';

}

}
echo '</div>';


?>
<!--</td></tr></table> -->


<div>
<?php
//Paginatinon
echo '<div class="pag_align">';
$request = 'ditems.php?'.$_SERVER['QUERY_STRING'];
$varname= 'page';
removeqsvar($request, $varname);
$page_previous= $_GET['page'] - 1;
$page_next= $_GET['page'] + 1;
if($page_previous == 0){ $pp= 'previous-off'; } else { $pp= 'previous'; }

echo '<ul id="pagination-digg"><li class="'.$pp.'"><a href="'.removeqsvar($request, $varname).'page='.$page_previous.'"> < </a></li>';

if ($pages >= 1 && $page <= $pages) {

If ($pages <> 1) {


for ($x=1; $x<=$pages; $x++) {


echo ($x == $page) ?  '<li class="active">'.$x.'</li>' : '<li><a href="'.removeqsvar($request, $varname).'page='.$x.'">'.$x.'</a> </li>';
}
}

$xx= $x-1;
if( !isset($x) || $xx == $page) { $pn='next-off'; } else { $pn='next'; }

echo '<li class="'.$pn.'"><a href="'.removeqsvar($request, $varname).'page='.$page_next.'"> > </a></li></ul></div>'; }

?>

<!-- END pagination --> </div>


</div>
</div>



</body>
<?php
include("template/footer.php");

?>
