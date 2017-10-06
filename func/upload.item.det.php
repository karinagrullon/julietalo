<?php
function deit_register($id_itd, $id_item, $id_size, $id_color, $id_qua, $id_usu)
{
    $date = date('Y-m-j h:i:s');
    
    if (deit_exists($id_itd) == false) {
         $id_itd  = mysql_real_escape_string($id_itd);
        $id_item = mysql_real_escape_string($id_item);
        
        mysql_query("INSERT INTO `items_detail` (`id_itd`,`id_item`,`id_size`,`id_color`,`id_qua`,`id_usu`,`date`,`del_est_itd`) VALUES ('','$id_item','$id_size','$id_color','$id_qua','$id_usu','$date','0')");
        return mysql_insert_id();
        
    } else {
        
        $sql = "UPDATE `items_detail` SET id_item = '$id_item',id_size='$id_size', id_color='$id_color', id_qua='$id_qua' WHERE id_itd='$id_itd'";
        $re = mysql_query($sql) or die("Error al actualizar los datos") . mysql_error();
        
    }
}

function deit_exists($id_itd)
{
    $id_itd = mysql_real_escape_string($id_itd);
    
    $query = mysql_query("SELECT COUNT(`id_itd`) FROM `items_detail` WHERE `id_itd` = '$id_itd'");
    return (mysql_result($query, 0) == 1) ? true : false;
}

function deit_exists_de($id_itd, $id_item, $id_size, $id_color)
{
    $id_itd   = mysql_real_escape_string($id_itd);
    $id_item  = mysql_real_escape_string($id_item);
    $id_size  = mysql_real_escape_string($id_size);
    $id_color = mysql_real_escape_string($id_color);
    
    $query = mysql_query("SELECT COUNT(`id_itd`) FROM `items_detail` WHERE `id_item` = '$id_item' AND `id_size`='$id_size' AND `id_color`='$id_color'");
    return (mysql_result($query, 0) == 1) ? true : false;
}

function delete_itd($id_itd)
{
    $id_itd = (int) $id_itd;
    $sql    = "UPDATE `items_detail` SET del_est_itd=1 WHERE id_itd='$id_itd'";
    $re = mysql_query($sql) or die("Error al eliminar los datos") . mysql_error();
}




?>