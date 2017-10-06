<div id="container_right">
<?php


$query3="SELECT con_sbr FROM `sidebar_right`"; 
$rer = mysql_query($query3) or die ("Upps... there was an error").mysql_error();
while($campo_re=mysql_fetch_array($rer)){
echo '<div class="sb_right_inner">'.$campo_re['con_sbr'].'</div>';
}
?>
</div>