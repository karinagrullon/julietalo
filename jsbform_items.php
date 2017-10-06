<div id="shadowing"></div>
<div id="box">

 <span id="boxtitle">  

 </span>

<form method="POST" action="">
<table border="0" align="center" class="display" width="100%" id="datatable_search">
<thead>
 <tr class="trbuscar2">
 <td width="7%"><p id="bp">Codigo<p></td>   <td width="30%"> <p id="bp">Descripcion</p></td>  <td width="20%"> <p id="bp"> Ocasion </p> </td> <td width="15%"> <p id="bp"> Material </p> </td> <td width="23%"> <p id="bp"> Fecha </p> </td>
 </tr>
 </thead>
 <body>
<?php
$sql= mysql_real_escape_string($sql);

$sql="SELECT it.id_item, it.des_item, it.id_oct, it.id_fabric, it.date , oc.id_oct, oc.des_oct, fa.id_fabric, fa.des_fabric FROM items AS it, occations AS oc, fabrics AS fa WHERE it.id_oct = oc.id_oct AND it.id_fabric=fa.id_fabric AND it.del_est_item = '0' AND it.id_item ORDER BY it.id_item DESC";

$re=mysql_query($sql) or die ("Error al ejecutar consulta 3").mysql_error();

if (mysql_num_rows($re)==0){
echo '<tr> <td colspan="5"> No existe ningun usuario con ese criterio de búsqueda. </td></tr>';
}else{
while($campo2=mysql_fetch_array($re)) {
echo '<tr class="tr1" onclick="" /> <td class="td1">'.'<a class="blink" href="upload_item_details.php?id_item='.$campo2['id_item'].'">'.$campo2['id_item'].'</a>'.'</td> <td class="td1">'.'<a class="blink" href="upload_item_details.php?id_item='.$campo2['id_item'].'">'.$campo2['des_item'].'</td>  <td class="td1">'.'<a class="blink" href="upload_item_details.php?id_item='.$campo2['id_item'].'">'.$campo2['des_oct'].'</a>'.'</td>  <td class="td1">'.'<a class="blink" href="upload_item_details.php?id_item='.$campo2['id_item'].'">'.$campo2['des_fabric'].'</a>'.'</td>  <td class="td1">'.'<a class="blink" href="upload_item_details.php?id_item='.$campo2['id_item'].'">'.$campo2['date'].'</a>'.'</td> </tr>';
}     }
?>
 </body>
 <tfoot>
  </tfoot>
</table>

&nbsp;
<p>&nbsp;</p>

<div align="right"><input type="button" value="CANCEL" class="cancel" onclick="closebox()" /> </div>

</div>

</div>
