<?php

include 'init.php';
include ("template/header_admin.php");
?>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />



<div id="container">

<div class="admin_menu_vertical">
<ul id="MenuBar1" class="MenuBarVertical">
  <li><a href="dashboard.php">Inicio</a>
  </li>
  <li><a href="upload_item.php">Cargar articulo</a></li>
  <li><a class="upload_image.php" href="#">Imagenes</a>
      <ul>
        <li><a class="MenuBarItemSubmenu" href="view_images?album_id=-1.php">Libreria</a>
            <ul>
              <li><a href="#">elemento 3.1.1</a></li>
              <li><a href="#">elemento 3.1.2</a></li>
            </ul>
        </li>
        <li><a href="upload_image.php">Agregar nuevo</a></li>
      </ul>
  </li>
  
   <li><a class="MenuBarItemSubmenu" href="#">Mantenimientos</a>
  <ul>
            <li><a  href="occations.php">Ocasiones</a></li>
            <li><a  href="fabrics.php">Materiales</a></li>
            <li><a  href="sizes.php">Tama&ntilde;os</a></li>
			<li><a  href="colors.php">Colores</a></li>
        </ul>
  </li>
  <li><a href="create_category.php">Categorias</a></li>
  
            <li><a class="MenuBarItemSubmenu" href="#">Apariencia</a>
            <ul>
              <li><a href="manage_sidebar_right.php">Sidebar derecha</a></li>
              <li><a href="#">elemento 3.1.2</a></li>
            </ul>
        </li>
  
</ul>
</div>



<div class="admin_center">



</div>




</div>
</body>


<?php
include("template/footer.php");

?>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
