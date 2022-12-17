<?php

session_start();
session_destroy();
setcookie("user_email","",time()-5*365*24*60*60);
setcookie('user_chat_email', $cookiehash, time()-5*365*24*60*60, "/", "chat.ourmedia.org");
header("location: https://findbestjodi.com/login.php");

?>