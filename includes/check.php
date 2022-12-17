<?php
if((!isset($_COOKIE['user_email'])) AND (!isset($_SESSION['user_email'])))
{
	echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
}
else
{
	if(!isset($_SESSION['user_email']))
	{
		include('connect.php');
		$user = $_COOKIE['user_email'];
		$get_user = mysqli_query($mysqli,"select * from users");
		while($row = mysqli_fetch_array($get_user))
		{									
			$user_email = $row['user_email'];
			$encoded_user_email = base64_encode($user_email);
			$encode_user_email = crypt(sha1(md5($encoded_user_email)), $encoded_user_email);
			if($user==$encode_user_email)
			{
				$_SESSION['user_email'] = $user_email;
			}
		}
	}
}
?>