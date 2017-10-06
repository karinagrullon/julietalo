<?php

function display_sizes(){	

}

function display_colors(){
		
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
   ORDER BY
   co.des_color ASC"; 

$re= mysql_query($sql) or die ("Error al ejecutar consulta 1").mysqlerror();
echo '<table border="1"> ';
while($campo =mysql_fetch_array($re)){
echo '
<tr>
<td>';
echo '<input type="checkbox" name="'.$campo['id_color'].'" value="'.$campo['id_color'].'"> <a href="ditems.php?ptype=col&pkey='.$campo['id_color'].'&page=1">'.$campo['des_color'].'</a>
</td>
</tr>';

}
echo '</table>';
}


?>