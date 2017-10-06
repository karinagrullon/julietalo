<?php
if(logged_in()){
//print_r(user_data('name'));
$user_data= user_data('name');
echo '
 <div id="login" onmouseover="showForm();" onmouseout="hideForm();">  
 <span class="label">
 <a href="signin.php">
 <div class="sign_bb">';  
echo '<div class="sign_b">Hello, <strong>', $user_data['name'].'!</strong>
</div>';
echo '
 </div>
 </a>
</span>  
    <div id="loginForm">   
	<a href="user_update_inf.php?user_id='.$_SESSION['user_id'].'">Update information</a>
 <br />
	<a href="logout.php">Log out</a>
</div>
</div>';

} else {

?>

<form method="POST"> 
	<!--  <div id="login" onmouseover="showForm();" onmouseout="hideForm();"> -->
	<div id="login">  
		<span class="label">
			<a href="signin.php">
				<div class="sign_b"> Sign in  </div>
			</a>
		</span>  
		<div id="loginForm">     
			<table class="login_table">
				<tr>
					<td>
						<input type="email" name="login_email" placeholder="Email" value="<?php if(isset($login_email)== true){ echo $login_email; } ?>"/>
								<input type="password" name="login_password" placeholder="Password"/>
								<br/>
								<input type="submit" value="Log in" class="blogin"/>
								<br/>

								<p class="login_p">New custumer? <a href="register.php">SIGN UP</a>
								</p>
							</td>
						</tr>

						<?php
echo '<tr>
<td>';
if (isset($_POST['login_email'], $_POST['login_password'])){
$login_email= $_POST['login_email'];
$login_password= $_POST['login_password'];

$errors= array();

if (empty($login_email) || empty($login_password)){
 $errors[]= '<div class="log_errors">Email and password required</div>';
 
  ?>
						<script type="text/javascript">
$(document).ready(
 function loginAppear() {
  $( "#loginForm" ).show(  "fast" );
}
)
						</script>
						<?php

}else{

$login= login_check($login_email,$login_password);

if ($login === false){
 $errors[]= '<div class="log_errors">Unable to log you in</div>';
 ?>
						<script type="text/javascript">
$(document).ready(
 function loginAppear() {
  $( "#loginForm" ).show(  "fast" );
}
)
						</script>
						<?php
}

}

if (!empty($errors)){
foreach($errors as $error){
echo $error, '<br/>';
}

}else{
//Log user in
$_SESSION['user_id']=$login;
header('Location: index.php');
exit();

}

}


?>
					</td>
				</tr>
			</table>

		</div>
	</div>
	<?php } ?>
	<!--
</span>
</p> -->

</form>