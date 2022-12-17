<?php 
include("includes/check.php"); 
?>
<?php
if(isset($_POST['changepass']))
{
	include('connect.php');

	$cookie_email = $_COOKIE['user_email'];
	$check = mysqli_query($mysqli,"select * from users");
	while($row = mysqli_fetch_array($check))
	{
		$check_email = $row['user_email'];
		$encoded_check_email = base64_encode($check_email);
		$encrypted_check_email = (crypt(sha1(md5($encoded_check_email)),$encoded_check_email));
					
		if($cookie_email == $encrypted_check_email)
		{
			$query = mysqli_query($mysqli,"select * from users where user_email = '$check_email'");
			$rows = mysqli_fetch_array($query);
					
			$user_email = $rows['user_email'];
			$encoded_user_email = base64_encode($user_email);
			$user_pass = $rows['user_pass'];
		}
	}

	$user_oldpass = (crypt(sha1(md5(htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_oldpass']), ENT_QUOTES, 'UTF-8'))),$encoded_user_email));
	$user_newpass = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_newpass']), ENT_QUOTES, 'UTF-8');
	$user_new_reppass = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_new_reppass']), ENT_QUOTES, 'UTF-8');
	$encode_newpass = (crypt(sha1(md5($user_newpass)),$encoded_user_email));    	
				
	if($user_pass==$user_oldpass)	
	{
		if($user_newpass==$user_new_reppass)
		{
			$update = mysqli_query($mysqli,"update users set user_pass='$encode_newpass' where user_email='$user_email'");
			if($update)
			{
				echo "<script>alert('Password Successfully Changed!')</script>";
				echo "<script>window.open('https://findbestjodi.com/logout.php','_self')</script>";
				exit();
			}
		}
		else
		{
			echo "<script>alert('The Passwords Do Not Match!')</script>";
			echo "<script>window.open('https://findbestjodi.com/my_profile.php','_self')</script>";
			exit();
		}
	}
	else
	{
		echo "<script>alert('The Password You Entered Is wrong!')</script>";
		echo "<script>window.open('https://findbestjodi.com/my_profile.php','_self')</script>";
		exit();
	}				
}
else
{
	echo "<script>alert('Can't Access Directly!')</script>";
	echo "<script>window.open('https://findbestjodi.com/my_profile.php','_self')</script>";
	exit();
}
?> 