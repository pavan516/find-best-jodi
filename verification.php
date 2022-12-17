<?php 
session_start();
include('connect.php');
if(isset($_GET['verify']))
{
	$user_email = base64_decode($_GET['verify']);
	$code = base64_decode($_GET['code']);
	$encoded_user_email = base64_encode($user_email);
	$query = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
	$row = mysqli_fetch_array($query);
	$user_verification = $row['verification'];
	$verify="verified";
		
	if($user_verification==$code)
	{
		$updating = mysqli_query($mysqli,"UPDATE users SET verification='$verify' WHERE user_email='$user_email'");
		if($updating)
		{
			echo "<script>alert('Successfully Verified Your Account!')</script>";
			echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
			exit();
		}
	}
	else
	{
		echo "<script>alert('Verification Link Is In-Correct!')</script>";
		echo "<script>window.open('https://findbestjodi.com/register.php','_self')</script>";
		exit();
	}
}
?>