<?php

function fabric_register($id_fabric, $id_it_type, $des_fabric, $id_usu)
{
    
    if (fabric_exists($id_fabric) == false AND fabricd_exists($des_fabric) == false) {
        
        $date      = date('Y-m-j h:i:s');
        $id_fabric = mysql_real_escape_string($id_fabric);
        mysql_query("INSERT INTO `fabrics` VALUES ('','$id_it_type','$des_fabric','$date','$id_usu','')");
        
        return mysql_insert_id();
        
    } else {
        
        $sql = "UPDATE `fabrics` SET id_it_type='$id_it_type',des_fabric='$des_fabric',id_usu='$id_usu',date='$date' WHERE id_fabric='$id_fabric'";
        $re = mysql_query($sql) or die("There was an error while updating the data") . mysql_error();
        
    }
    
}

function fabric_exists($id_fabric)
{
    
    $id_fabric = mysql_real_escape_string($id_fabric);
    $query     = mysql_query("SELECT COUNT(`id_fabric`) from `fabrics` WHERE `id_fabric` = '$id_fabric'");
    return (mysql_result($query, 0) == 1) ? true : false;
    
}


function fabricd_exists($des_fabric)
{
    
    $des_fabric = mysql_real_escape_string($des_fabric);
    $query      = mysql_query("SELECT COUNT(`des_fabric`) from `fabrics` WHERE `des_fabric` = '$des_fabric'");
    return (mysql_result($query, 0) >= 1) ? true : false;
    
}




function delete_fabric($id_fabric)
{
    $id_fabric = (int) $id_fabric;
    //mysql_query("DELETE FROM `sizes` WHERE `id_size`=$id_size");
    
    $sql = "UPDATE `fabrics` SET del_est_fabric=1 WHERE id_fabric='$id_fabric'";
    
    $re = mysql_query($sql) or die("There was an error while deleting the data") . mysql_error();
    
}

?>
