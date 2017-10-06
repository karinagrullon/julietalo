<?php

function logged_in() {
return isset($_SESSION['user_id']);
}

function login_check($register_email, $register_password) {
if (isset($email) ==true) { $email= mysql_real_escape_string($email); }


$login_query= mysql_query("SELECT COUNT(`user_id`) as `count`, `user_id` FROM `users` WHERE `email` = '$register_email' AND `password`= '".md5($register_password)."' GROUP BY `user_id` ") or die( mysql_error() );
return (@mysql_result($login_query, 0) == 1) ?  mysql_result($login_query, 0, 'user_id' ) : false;

}

function user_data(){
$args= func_get_args();
$fields= '`'.implode('`, `', $args).'`';

$query= mysql_query("SELECT $fields FROM `users` WHERE `user_id`=".$_SESSION['user_id'])or die( mysql_error());
$query_result= mysql_fetch_assoc($query);
foreach($args as $field){
$args[$field] = $query_result[$field];
}
return $args;
}

function user_register($register_email, $register_name,$register_lastname,$register_password,$register_ip,$code){
$register_email= mysql_real_escape_string($register_email);
$register_name= mysql_real_escape_string($register_name);

mysql_query("INSERT INTO `users` VALUES ('','$register_email','$register_name','$register_lastname','".md5($register_password)."','$register_ip','$code','0','')");
return mysql_insert_id();
}

function user_exists($register_email){

$register_email= mysql_real_escape_string($register_email);
$query=mysql_query("SELECT COUNT(`user_id`) from `users` WHERE `email` = '$register_email' AND activate = '1'");
return (mysql_result($query, 0) == 1) ? true : false;

}


//System users

function logged_in_system() {
return isset($_SESSION['id']);
}

function login_check_system($username, $password) {
$username= mysql_real_escape_string($username);
$login_query= mysql_query("SELECT COUNT(`id`) as `count`, `id` FROM `system_users` WHERE `username` = '$username' AND `contrasena`= '".md5($password)."' GROUP BY `id` ") or die( mysql_error() );
return (@mysql_result($login_query, 0) == 1) ?  mysql_result($login_query, 0, 'id' ) : false;
}


function user_data_system(){
$args= func_get_args();
$fields= '`'.implode('`, `', $args).'`';

$query= mysql_query("SELECT $fields FROM `system_users` WHERE `id`=".$_SESSION['id'])or die( mysql_error());
$query_result= mysql_fetch_assoc($query);
foreach($args as $field){
$args[$field] = $query_result[$field];
}
return $args;

}

function user_register_system($usu_id,$usu_nombres, $usu_apellidos,$usu_username,$usu_contrasena,$usu_user_type_id,$usu_email,$usu_status){


if (user_exists_system($usu_username)== false)   {

$fecing= date('Y-m-j');
$usu_username= mysql_real_escape_string($usu_username);
$usu_contrasena= mysql_real_escape_string($usu_contrasena);
mysql_query("INSERT INTO `system_users` VALUES ('','$usu_username','".md5($usu_contrasena)."','','$usu_user_type_id','$usu_apellidos','$usu_nombres','$usu_email','$fecing','$usu_status','')");
return mysql_insert_id();

}else{

$sql="UPDATE system_users set username='$usu_username',contrasena='".md5($usu_contrasena)."',last_login='',user_type_id='$usu_user_type_id',apellidos='$usu_apellidos',nombres='$usu_nombres',email='$usu_email',status='$usu_status' where id='$usu_id'";
$re=mysql_query($sql) or die ("Error al actualizar los datos").mysql_error();
}

}

function user_exists_system($usu_username){

$usu_username= mysql_real_escape_string($usu_username);
$query=mysql_query("SELECT COUNT(`id`) FROM `system_users` WHERE `username` = '$usu_username'");
return (mysql_result($query, 0) >= 1) ? true : false;

}


function delete_user_system($usu_id) {
$usu_id= (int)$usu_id;


$sql="update system_users set del_est_usu=1 where id='$usu_id'";
$re=mysql_query($sql) or die ("Error al eliminar los datos").mysql_error();

}

function consulta($level){
return ($level==5) ? true : false;
}

function inscripcion($level){
return ($level==2) ? true : false;
}

function cobro($level){
return ($level==3) ? true : false;
}

function contabilidad($level){
return ($level==4) ? true : false;
}

function profesor($level){
return ($level==6) ? true : false;
}

function tutor($level){
return ($level==7) ? true : false;
}


//User information

function user_inf_register($user_id,$id_coun,$user_adre,$user_city,$user_state,$user_poc,$user_pnu,$id_sec_que,$user_ans,$user_ip) {

if (user_inf_exists($user_id)== false)   { 

$reg_date= date('Y-m-j');
$reg_time = date('h:i:s');
$id_coun= mysql_real_escape_string($id_coun);
$user_id= mysql_real_escape_string($user_id);
mysql_query("INSERT INTO `users_inf` VALUES ('','$user_id','$id_coun','$user_adre','$user_city','$user_state','$user_poc','$user_pnu','$id_sec_que','$user_ans','$user_ip','$reg_date','$reg_time','')");
return mysql_insert_id();

}else{

$sql="UPDATE users_inf SET id_count='$id_count',user_adre='$user_adre',user_city='$user_city',user_city='$user_city',user_state='$user_state',user_poc='$user_poc',user_pnu='$user_pnu',id_sec_que='$id_sec_que',user_ans='$user_ans',user_ip='$user_ip' WHERE id='$usu_id'";
$re=mysql_query($sql) or die ("Error al actualizar los datos").mysql_error();
} 

}


function user_inf_exists($user_id){

$user_id= mysql_real_escape_string($user_id);
$query=mysql_query("SELECT COUNT(`user_id`) from `users_inf` WHERE `user_id` = '$user_id'");
return (mysql_result($query, 0) == 1) ? true : false;

} 


function send_user_register_email($register_email,$code,$register_name,$register_lastname,$url) {

//get user id by email
$query_u= mysql_query("SELECT user_id,email FROM users WHERE email='$register_email'");
while ($query_u_row = mysql_fetch_assoc($query_u)){
$uid = $query_u_row['user_id'];
}

require("PHPMailer-master/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP(); // send via SMTP
$mail->Host = "p3plcpnl0069.prod.phx3.secureserver.net"; // SMTP servers
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->Username = "non-reply@julietalo.com"; // SMTP username
$mail->Password = "MIustakia7"; // SMTP password

$mail->From = "non-reply@julietalo.com";
$mail->FromName = "JulietaLo";
$mail->AddAddress($register_email,$register_name.' '.$register_lastname);
$mail->AddReplyTo("non-reply@julietalo.com","JulietaLo.com");

$mail->WordWrap = 50; // set word wrap

$mail->IsHTML(true); // send as HTML

$mail->Subject = "Please Verify Your Email Address";
$mail->Body = "
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>JulietaLo activation Email</title>
<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
</head>
<body style='margin: 0; padding: 0;'>

<table width='600px' height='400px' background='http://julietalo.com/images/email_back.png' style='border:1px solid #CCCCCC; color: #696969; border-collapse: collapse; padding:15px 10px 20px 10px;'>
<tr>
<td width='70%' style='padding: 0 0 5px 5px;'><img src='http://julietalo.com/images/email.png' style='padding=5px;' alt='logo' /> </td>
<td width='30%'> </td>
</tr>

<tr>
<td style='padding: 0 0 5px 10px;'>Hi <strong>$register_name $register_lastname,</strong></td> 
<td width='30%'> </td>
</tr>

<tr>
<td style='padding: 0 0 10px 10px;'>Thanks for becoming a member of JulietaLo. Before you get stated, please verify your email so that we can know you're a real human:  </td>
<td width='30%'> </td>
</tr>

<tr>
<td align='left' style='padding: 0 0 10px 10px;'>

<a style='text-decoration:none;' href='$url/user_activation.php?uid=$uid&code=$code' target='_blank'><input type='button' 
style='
background-color:#9467a7;
color:#FFFFFF;
border:0px;
cursor:pointer;
border-radius:1px;
padding:4px 11px;
text-align:center;
clear:both;
display:block;
margin: 0 0 5px 0;
text-decoration:none;
' value='Verify Email Adress >>' align='left' /></a>

</td>
<td width='30%'> </td>
</tr>

<tr>
<td style='padding: 0 0 0 10px;'>Or copy and paste the following link in your browser:</td>
<td width='30%'> </td>
</tr>

<tr>
<td style='padding: 0 0 5px 10px;'><i> $url/user_activation.php?uid=$uid&code=$code </i></td>
<td width='30%'> </td>
</tr>

<tr>
<td style='padding: 0 0 15px 10px;'>After you complete registering you will be redirected to a form to complete some information. 
By then, you should be eager to get stated with your shopping experience. 
</td>
<td width='30%'> </td>
</tr>

<tr>
<td style='padding: 0 0 20px 10px;'>Thanks for joining us!<br /> <i> JulietaLo Staff </i> </td>
<td width='30%'> </td>
</tr>

</table>
</body>
</html>
";
$mail->AltBody = "This is the text-only body";


if(!$mail->Send())
{
echo "Message was not sent";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}

echo "Message has been sent";

}



function activate_user_account($activation_code,$activation_user_id) {

$activation_code= mysql_real_escape_string($activation_code);
$activation_user_id= mysql_real_escape_string($activation_user_id);

$check = mysql_query("SELECT * FROM `users` WHERE code = '$activation_code' AND activate = '1'");
if (mysql_num_rows($check) == 1) {
return false;
} else {


$activate="UPDATE `users` SET activate='1' WHERE code='$activation_code' AND user_id='$activation_user_id'";
$re=mysql_query($activate) or die ("There was an error while activating your account. Please try again.").mysql_error();

return true;
}

}


function user_activated($user_id) {
$check = mysql_query("SELECT * FROM `users` WHERE user_id= '$user_id' AND activate = '1'");
if (mysql_num_rows($check) >= 1) {
return true;
} else {
return false;
}
}
 
?>




