<?php
include 'init.php';
include 'template/header.php';

$user_id = $_SESSION['user_id'];

if (logged_in() == true) {
    
    if (!logged_in() == true && isset($_GET['code']) == false && isset($_GET['uid']) == false) {
        header('Location: index.php');
        exit();
    }
    
    if (logged_in() == true && isset($_GET['code']) == true && isset($_GET['uid'])) {
        $activation_code    = $_GET['code'];
        $activation_user_id = $_GET['uid'];
        activate_user_account($activation_code, $activation_user_id);
        
        if (activate_user_account($activation_code, $activation_user_id) == true) {
            $uactive = 'true';
        } else {
            $uactive = 'false';
        }
        
        header('Location: user_update_inf.php?uactive=' . $uactive);
        exit();
        
    } else {
        if (isset($_GET['messagesend'])) {
            
            if (isset($_GET['activated']) == false) {
                
                echo '<p>&nbsp;</p>';
                
                echo '<div class="email">Please check your email and click on the verification link to continue</div>';
                echo '<div>Email didn&#39;t arrived?  <a href="send_activation_message.php"> Send email again </a> </div>';
                
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                
            } else {
                echo '<p>&nbsp;</p>';
                echo '<center><h1>Email address already verified</h1> <br /> No further action is needed.</center>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
                echo '<p>&nbsp;</p>';
            }
            
        }
    }
    
} else {
    
    header('Location: index.php');
    exit;
    
}
include 'template/footer.php';
