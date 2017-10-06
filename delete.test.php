<?php
include 'init.php';

if (!logged_in()) {
header('Location: index.php');
exit();
}

if (isset($_GET['id_tes'])) {
$id_tes= $_GET['id_tes'];
delete_test($id_tes);
}

header('Location: testimonials.php?deleted=true');
exit();
?>