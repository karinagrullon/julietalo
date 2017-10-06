<?php
if (logged_in_system()) {
//print_r(user_data('name'));
echo '<div class="usern">';
$user_data= user_data('nombres','apellidos');
echo '<strong> Usuario: </strong>', $user_data['nombres'].' '.$user_data['apellidos'];
echo '</div>';
} else {

?>

<div class="cinicio">
<table border="0" width="100%" class="ilogin_table">
<thead>
<tr>
<td colspan="2"> <img src="images/banner3 copia.png" width="160"/> </td>
</tr>
</thead>
<tbody>

<tr>
<td colspan="2"> 

<?php
if (isset($_POST['user_login_username'], $_POST['user_login_password'])){
$user_login_username= $_POST['user_login_username'];
$user_login_password= $_POST['user_login_password'];


$errors= array();

if (empty($user_login_username) || empty($user_login_password)){
 $errors[]= '<div class="errors"> Username and password required </div>';

}else{

$login= login_check_system($user_login_username,$user_login_password);

if ($login === false){
 $errors[]= '<div class="errors"> You can not sign in  </div>';
}

}

if (!empty($errors)){
foreach($errors as $error){
echo $error, '<br/>';
}
echo '</div>';

}else{
//Log user in
$_SESSION['id']=$login;
header('Location: dashboard.php');
exit();

}

}

?>
</td>
</tr>

<form action="" method="post">

<tr>
<p>
 <td> User <br /> <input type="text" name="user_login_username" class="log_input" tabindex="1" autofocus="autofocus" /> </td>


</tr>
<tr>
<td> Password <br /> <input type="password" class="log_input" name="user_login_password" tabindex="2" /></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="Enter" accesskey="n" tabindex="3" class="bestandar"  /> 
</td>
</p>
</tr>
</form>
<tbody>
</table>
<?php
}
?>

