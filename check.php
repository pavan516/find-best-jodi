<?php 
session_start();
$user_email = $_SESSION['user_email'];
$encoded_user_email = base64_encode($user_email);
$cookiehash = crypt(sha1(md5($encoded_user_email)), $encoded_user_email);
setcookie('user_email', $cookiehash, time()+5*365*24*60*60);
setcookie('user_chat_email', $cookiehash, time()+5*365*24*60*60, "/", "chat.ourmedia.org");
if(setcookie('user_email', $cookiehash, time()+5*365*24*60*60))
{
	echo "<script>window.open('http://findbestjodi.com/index.php','_self')</script>";
}
else
{
	echo "<script>window.open('http://findbestjodi.com/login.php','_self')</script>";
}
?>