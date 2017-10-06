<?php
include 'init.php';
echo '<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">';

if (logged_in_system()){
echo 'You are logged in';

} else{

 include 'widgets/login_admin.php';  

 }

?>

<!-- <img src="images/login_background_butter.png" class="login_b_b"> -->