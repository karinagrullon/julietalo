<?php
include('init.php');

if($_REQUEST)
{
//	$id 	= $_REQUEST['parent_id'];
	$id_size 	= $_REQUEST['id_size'];
	$id_item = $_REQUEST['id_item'];
	$id_color = $_REQUEST['id_color'];
	
	$query = "SELECT DISTINCT(si.id_size), it.id_item, itd.id_qua, itd.id_size, itd.id_color, itd.id_item FROM items AS it, sizes AS si, items_detail AS itd WHERE it.id_item=itd.id_item AND si.id_size=itd.id_size AND it.id_item = '$id_item' AND itd.id_size = '$id_size' AND itd.id_color='$id_color'";
	$results = mysql_query($query);?>
	
	<select name="id_qua"  id="sub_category_id">
	
	<option selected="selected">--Select--</option>
	<?php
	while ($rows = mysql_fetch_assoc(@$results))
	{
	$sort = 1;
	while ($sort <= $rows['id_qua'] ) {
	?>
    <option value="<?php echo $sort; ?>"><?php echo $sort;?></option>
	<?php
	$sort = $sort + 1;
	}
	}?>
	</select>	
	
<?php	
}
?>