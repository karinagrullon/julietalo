<?php
include 'init.php';
if (logged_in()) {
    header('Location: index.php');
    exit();
}

include 'template/header.php';
?>
<h3> Register</h3>

<div id="less-six" />
<div id="dont-match" />

<?php
if (isset($_POST['register_email'], $_POST['register_name'], $_POST['register_lastname'], $_POST['register_password'])) {
    $register_email           = $_POST['register_email'];
    $register_name            = $_POST['register_name'];
    $register_lastname        = $_POST['register_lastname'];
    $register_password        = $_POST['register_password'];
    $register_repeat_password = $_POST['register_repeat_password'];
    $register_ip              = $_SERVER['REMOTE_ADDR'];
    
    $errors = array();
    
    if (empty($register_email) || empty($register_name) || empty($register_lastname) || empty($register_password)) {
        $errors[] = '<div class="errors" id="reg-empty">All  fields required</div>';
    } else {
        
        if (filter_var($register_email, FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = '<div class="errors">Email adress not valid</div>';
            
        }
        
        if (strlen($register_email) > 255 || strlen($register_name) > 35 || strlen($register_password) > 35) {
            $errors[] = '<div class="errors">One or more field contains too many characters</div>';
            
        }
        
        if (user_exists($register_email) == true) {
            //user_exists is the function we created on user functions
            $errors[] = '<div class="errors">That email has already been registared</div>';
        }
        
        if (strlen($register_password) < 6) {
            $errors[] = '<div class="errors">Password must be at least <strong>6</strong> characters lenght</div>';
            unset($register_password);
            unset($register_repeat_password);
        }
        
        if ($register_password != $register_repeat_password) {
            $errors[] = '<div class="errors"> Passwords don\'t match!</div>';
            unset($register_password);
            unset($register_repeat_password);
        }
        
    }
    
    //print_r($errors);
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error, '<br/>';
            
        }
        
        
    } else {
        //Register our user
        $code     = rand(11111111, 99999999);
        $urll     = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url      = str_replace("/register.php", "", $urll);
        $register = user_register($register_email, $register_name, $register_lastname, $register_password, $register_ip, $code);
        send_user_register_email($register_email, $code, $register_name, $register_lastname, $url);
        
        
        $_SESSION['user_id'] = $register;
        
        header('Location: user_activation.php?messagesend');
        // header('Location: user_update_inf.php');
        exit();
        
    }
    
}

?>

<form action= '' method='POST' class="general_f">
	<table class="general_table" align="left">
		<tr>
			<td>Email<br />
				<input type="email" style="width:100%" required name="register_email" id="register-email" size="35" maxlegth="255" autofocus="autofocus" value="<?php
if (isset($register_email)) {
    echo $register_email;
}
?>"/> </td>
				</tr>

				<tr>
					<td>Name <br />
						<input type="text" style="width:100%" name="register_name" id="register-name" size="35" maxlegth="35" value="<?php
if (isset($register_name)) {
    echo $register_name;
}
?>" /></td>
						</tr>

						<tr>
							<td>Lastname<br />
								<input type="text" style="width:100%" name="register_lastname" id="register-lastname" size="35" maxlegth="35" value="<?php
if (isset($register_lastname)) {
    echo $register_lastname;
}
?>"/> </td>
								</tr>

								<tr>
									<td>Password<br />
										<input type="password" style="width:100%" name="register_password" id="register-password" size="35" maxlegth="35" value="<?php
if (isset($register_password)) {
    echo $register_password;
}
?>"/> 
											</td>
										</tr>

										<tr>
											<td>Repeat password<br />
												<input type="password" style="width:100%" name="register_repeat_password" id="register-repeat-password" size="35" maxlegth="255"/>
											</td>
										</tr>

										<tr>
											<td colspan="2">
												<input type="submit" value="Register" class="bestandar"  id="rsubmit"/>
											</td>
										</tr>

									</table>
								</form>

								<table class="f-left">
									<tr>
										<td>
											<img src="images/cute ad.png" align="rigth"  />
										</td>
									</tr>
								</table>

								<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
								<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
								<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
								<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>

								<?php
// echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include 'template/footer.php';
?>