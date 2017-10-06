<?php
include 'init.php';

?>

<style type="text/css" title="currentStyle">
			@import "DataTables/media/css/demo_page.css";
			@import "DataTables/media/css/demo_table.css";
</style>

<table border="0" align="center" class="display" width="100%" id="datatables">
<thead>
 <tr>
 <th width="5%"> <strong>Codigo</strong> </th>   <th width="50%"> <strong>Descripcion </strong></th>  <th width="40%"> <strong>Ocasion </strong></th>  <th width="5%"> <strong>Editar </strong></th>
 </tr>
</thead>
<tbody>
<?php
    $sql = mysql_real_escape_string($sql);
    
    
    $sql = "SELECT it.id_item,it.des_item,it.id_oct,it.des_item,oc.id_oct,oc.des_oct FROM items  AS it, occations AS oc WHERE it.del_est_item=0 AND it.id_oct=oc.id_oct ORDER BY it.id_item DESC";
    
    
    $re = mysql_query($sql) or die("There was an error while obtaing the data 3") . mysql_error();
    
    while ($campo2 = mysql_fetch_array($re)) {
        echo '<tr class="tr1"><td width="5%" class="td1">' . $campo2['id_item'] . '</td> <td width="50%">' . $campo2['des_item'] . '</td> <td width="40%">' . $campo2['des_oct'] . '</td> <td width="5%">' . '<a tabindex="20" href="upload_item.php?id_item=' . $campo2['id_item'] . '">' . '<img src="images/icons/Edit/edit-file-icon.png"/></a>' . '</td> </tr>';
    }
?>
</tbody>
</table>
<?php
 include 'template/footer.php';
 ?>