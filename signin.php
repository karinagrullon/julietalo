<?php
include 'init.php';
include("template/header.php");

if (isset($_GET['shop'])== true) {
echo '<div class="info"> Please Sign in to begin shopping </div>';
} 

?>

<form method="POST"> 
 <div class="sign_div">  
<table class="login_table_b">
<tr>
<td>
Sign in <br />
<input type="email" required name="login_email" placeholder="Email" autofocus="autofocus" value="<?php
if (isset($login_email) == true) {
    echo $login_email;
}
?>"/> <br />
<input type="password" required name="login_password" placeholder="Password"/> <br/>
<input type="submit" value="Log in" class="blogin"/> <br/>
</td>
<td class="login_table_btd">
<p class="login_p">Are you a <strong>new</strong> custumer? If so please click below <br /></p>
<div align="center">
<a href="register.php"><input type="button" value="SIGN UP" class="bblogin" /></a> 

</div>

</td>
</tr>

<?php


echo '<tr><td>';
if (isset($_POST['login_email'], $_POST['login_password'])) {
    $login_email    = $_POST['login_email'];
    $login_password = $_POST['login_password'];
    
    $errors = array();
    
    if (empty($login_email) || empty($login_password)) {
        $errors[] = '<div class="log_errors">Email and password required</div>';
        
    } else {
        
        $login = login_check($login_email, $login_password);
        
        if ($login === false) {
            $errors[] = '<div class="log_errors">Unable to log you in</div>';
        }
        
    }
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error, '<br/>';
        }
        
    } else {
        //Log user in
        $_SESSION['user_id'] = $login;
        header('Location: index.php');
        exit();
    }
}
?>
</td></tr>
</table>

</div>

</form>

<?php
include 'template/footer.php';
?>