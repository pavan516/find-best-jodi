<!-- Php Code For Forgotten Password -->
<?php
include("connect.php");
if(isset($_POST['forgotten']))
{
	$user_email = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_email']), ENT_QUOTES, 'UTF-8');
	$encoded_user_email = base64_encode($user_email);
	$user_contact = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_contact']), ENT_QUOTES, 'UTF-8');
							
	$rawQuery = "SELECT * FROM users WHERE user_email = ? AND user_contact = ? ";
	$stmt = $mysqli->prepare($rawQuery);			
	$stmt->bind_param("ss", $l, $m);
				
	$l = "$user_email";
	$m = "$user_contact";
	
	$stmt->execute();
	$count = mysqli_stmt_fetch($stmt);
	if($count=='1')
	{
		function random_password( $length = 8 ) 
		{
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
		}
		$password = random_password(8); 
		$pass = (crypt(sha1(md5(htmlspecialchars(mysqli_real_escape_string($mysqli,$password), ENT_QUOTES, 'UTF-8'))),$encoded_user_email));
		$encoded_pass = base64_encode($pass);
		include("connect.php");
		$query = mysqli_query($mysqli,"UPDATE users SET user_pass='$pass' WHERE user_email='$l'");
																
		if($query)
		{
			$to = $user_email;
			$header = "FROM: Find Best Jodi <pavankumar@tirupati.hostedbywlh.com>\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$message = "<html>
							<head>
								<title>Find Best Jodi</title>
							</head>
							<body>
								<table style='font-family:arial,sans-serif;border-collapse:collapse;width:100%'>
									<tr>
										<th style='background-color:#2c82f8;color:white;border:5px solid #ddd;padding:5px'>
											<br><center><h2 style='color:black;'><b>Find Best Jodi - Forgotten Password</b></h2></center>
										</th>
									</tr>
									<tr>
										<td style='border:5px solid #ddd;padding:5px'>
											<center><h4 style='color:black;'><b>Click Here To Verify Your Email</b></h4></center>
											<center><button style='background-color:#2c82f8; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;'>
											<b><a href='https://www.findbestjodi.com/forchange_pass.php?email=$encoded_user_email&pass=$encoded_pass' style='color:black;'>Change Password Here</a></b></button></center><br><br>
										</td>
									<tr>
									<tr>
										<th style='background-color:#2c82f8;color:white;border:5px solid #ddd;padding:5px'>
											<center>
												<a href='abc.php'>hello</a> | 
												<a href='abc.php'>hello</a> |
												<a href='abc.php'>hello</a> |
												<a href='abc.php'>hello</a>
											</center>
										</th>
									</tr>
								</table>
					
							</body>
						</html>";
					$subject = "Forgotten Password";
					mail($to,$subject,$message,$header) or die();
										
			echo "<script>alert('Password Is Sended To Your $user_email!')</script>";								
			echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
			exit();
		}								
	}
	else
	{
		echo "<script>alert('Your Email Or Contact Number Is Incorrect!')</script>";
		echo "<script>window.open('https://findbestjodi.com/forgotten.php','_self')</script>";
		exit();
	}
}
else
{
	echo "<script>alert('Can't Access Directly!')</script>";
	echo "<script>window.open('https://findbestjodi.com/forgotten.php','_self')</script>";
	exit();
}
?>
<!-- End Of Php Code For Forgotten Password -->