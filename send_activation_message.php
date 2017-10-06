<?php
include 'init.php';
$user_id = $_SESSION['user_id'];

 if (user_activated($user_id) == true) {
   
    header('Location: user_activation.php?messagesend&activated=true');
    exit();
 } 

if (isset($_SESSION['user_id']) == true) {
  
    $datos       = $_SESSION['user_id'];
    $obtain_data = "SELECT * FROM users WHERE user_id='$datos'";
    
    $re = mysql_query($obtain_data) or die("There was an error while obtaining the data") . mysql_error();
    while ($campo_act = mysql_fetch_array($re)) {
        
        $register_email    = $campo_act['email'];
        $register_name     = $campo_act['name'];
        $register_lastname = $campo_act['lastname'];
    }
    
    //Register our user
    $code = rand(11111111, 99999999);
    $urll = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url  = str_replace("/send_activation_message.php", "", $urll);
    
    send_user_register_email($register_email, $code, $register_name, $register_lastname, $url);
    
 //   $_SESSION['user_id'] = $register;
    
    header('Location: user_activation.php?messagesend');
    exit();
    
} else {
    
    header('Location: index.php');
    exit();
    
}

?>