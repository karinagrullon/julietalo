<?php

function cart_temp($id_item, $id_size , $id_color, $id_qua ,$ip_user , $id_usu)
{
    if (cp_exists($id_cp) == false) {
        
        $date      = date('Y-m-j h:i:s');
        $id_item = mysql_real_escape_string($id_item);
        mysql_query("INSERT INTO `cart_process` VALUES ('','$id_item','$id_size','$id_color','$id_qua','$ip_user','$date','$id_usu','')");
		
		//UPDATE QUANTITIES
		
		$se_que = mysql_query("SELECT `id_qua` FROM `items_detail` WHERE id_item= '$id_item' AND id_size = '$id_size' AND id_color = '$id_color'");
		while($re_se = mysql_fetch_assoc($se_que)) {
		$quantity = $re_se['id_qua'];
		}
		
		$quantity_sub = $quantity - $id_qua;
		$sql = "UPDATE `items_detail` SET id_qua='$quantity_sub' WHERE id_item='$id_item' AND id_size = '$id_size' AND id_color = '$id_color'";
        $re = mysql_query($sql) or die("There was an error while updating the data") . mysql_error();

		
        return mysql_insert_id();
        
    } else {
        
        $sql = "UPDATE `cart_process` SET id_item='$id_item',id_size='$id_size',id_color = '$id_color', id_qua='$id_qua',ip_user='$ip_user',date='$date',id_usu = '$id_usu' WHERE id_item='$id_item'";
        $re = mysql_query($sql) or die("There was an error while updating the data") . mysql_error();
        
    }
    
}

function cp_exists($id_cp) {  
    $id_cp = mysql_real_escape_string($id_cp);
    $query     = mysql_query("SELECT COUNT(`id_cp`) FROM `cart_process` WHERE `id_cp` = '$id_cp'");
    return (mysql_result($query, 0) == 1) ? true : false;
}

function no_available($id_item) {  
    $id_item = mysql_real_escape_string($id_item);
    $query     = mysql_query("SELECT COUNT(`id_item`) FROM `items_detail` WHERE `id_item` = '$id_item' AND `id_qua` = '0'");
    return (mysql_result($query, 0) == 1) ? true : false;
}



function item_data($id_item){
$args= func_get_args_item();
$fields= '`'.implode('`, `', $args).'`';

$query= mysql_query("SELECT $fields FROM `items` WHERE `id_item`='$id_item'")or die( mysql_error());
$query_result= mysql_fetch_assoc($query);
foreach($args as $field){
$args[$field] = $query_result[$field];
}
return $args;
}

function delete_cp_sb($id_cp, $id_qua, $id_item, $id_size, $id_color) {
$id_cp = mysql_real_escape_string($id_cp);
$id_qua = mysql_real_escape_string($id_qua);
$id_item = mysql_real_escape_string($id_item);
$id_size = mysql_real_escape_string($id_size);
$id_color = mysql_real_escape_string($id_color);
        
		//Obtain the quantity of before
        $se_que = mysql_query("SELECT `id_qua` FROM `items_detail` WHERE id_item= '$id_item' AND id_size = '$id_size' AND id_color = '$id_color'");
		while($re_se = mysql_fetch_assoc($se_que)) {
		$quantity_bf = $re_se['id_qua'];
		}
		
		//Get quantity from shopping bag
		$quantity_sub_cp = $quantity_bf + $id_qua;
		$sql = "UPDATE `items_detail` SET id_qua='$quantity_sub_cp' WHERE id_item='$id_item' AND id_size = '$id_size' AND id_color = '$id_color'";
        $re = mysql_query($sql) or die("There was an error while updating the data") . mysql_error();
		
		//Set to 1 the item in the shopping bag
		$sql = "UPDATE `cart_process` SET del_est_cp='1' WHERE id_cp='$id_cp'";
        $re = mysql_query($sql) or die("There was an error while updating the data") . mysql_error();

}



?>