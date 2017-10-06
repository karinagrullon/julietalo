<?php

ob_start();
session_start();
//mysql_connect('localhost','admin','admin');
mysql_connect('localhost','root','');
mysql_select_db('jh');

include 'func/user.func.php';
include 'func/album.func.php';
include 'func/image.func.php';
include 'func/thumb.func.php';
include 'func/sbr.func.php';
include 'func/oct.func.php';
include 'func/upload.item.func.php';
include 'func/sizes.func.php';
include 'func/fabrics.func.php';
include 'func/cart.func.php';
include 'func/upload.item.det.php';
include 'func/test.func.php';
include 'func/comm.func.php';
include 'func/col.func.php';
include 'func/ditems.func.php';



// cibaoaldia64

// cibaoaldia64


// 131001



?>