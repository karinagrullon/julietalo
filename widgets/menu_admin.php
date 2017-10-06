<div class="admin_menu">
<a href="dashboard.php" title="Dashboard"> <div class="home">ESCRITORIO </div></a> 
<a href="upload_item.php" title="Upload item"> <div class="upload"> Cargar articulo </div></a> 
<a href="upload_item_details.php" title="Upload item"> <div class="upload"> Detalles articulo </div></a> 
<?php
if (!logged_in_system()){
?>

<a href="register.php"> <div class="register"> Registrar</div></a> 

<?php
  }else{
?>

<a href="logout.php"><div class="signout">Salir</div></a>



<?php
  }
?>

</div>

