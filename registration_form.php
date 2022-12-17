<!-- Php Code For Sign up -->
<?php
if(isset($_POST['register']))
{
	include('connect.php');
						
	$user_name = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_name']), ENT_QUOTES, 'UTF-8');
	$user_email = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_email']), ENT_QUOTES, 'UTF-8');
	$encoded_user_email = base64_encode($user_email);
	$user_pass = (crypt(sha1(md5(htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_pass']), ENT_QUOTES, 'UTF-8'))),$encoded_user_email));
	$user_pass1 = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_pass']), ENT_QUOTES, 'UTF-8');
	$user_pass2 = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_passrepeat']), ENT_QUOTES, 'UTF-8');
	$user_contact = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_contact']), ENT_QUOTES, 'UTF-8');
	$user_gender = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_gender']), ENT_QUOTES, 'UTF-8');
	$user_dob = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_dob']), ENT_QUOTES, 'UTF-8');
	$user_status = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_status']), ENT_QUOTES, 'UTF-8');
	$user_searchingfor = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_searchingfor']), ENT_QUOTES, 'UTF-8');
	$user_religion = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_religion']), ENT_QUOTES, 'UTF-8');
	$user_mothertongue = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_mothertongue']), ENT_QUOTES, 'UTF-8');
	$user_casteordivision = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_casteordivision']), ENT_QUOTES, 'UTF-8');
	$user_country = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_country']), ENT_QUOTES, 'UTF-8');
	$user_state = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_state']), ENT_QUOTES, 'UTF-8');
	$user_feeling = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_feeling']), ENT_QUOTES, 'UTF-8');
	$user_image = htmlspecialchars(mysqli_real_escape_string($mysqli,$_FILES['user_image']['name']), ENT_QUOTES, 'UTF-8');
	$post_image_tmp = $_FILES['user_image']['tmp_name'];
	$user_regdate = date("Y-m-d H:i:s");
	
	if($user_pass1==$user_pass2)
	{
		$get_email = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
		if(mysqli_num_rows($get_email)>0)
		{
			echo "<script>alert('EMAIL $email IS ALREADY EXIST, PLEASE TRY ANOTHER ONE!')</script>";
			echo "<script>window.open('https://findbestjodi.com/register.php','_self')</script>";
			exit();
		}  
		else
		{
			$base_name = basename($_FILES['user_image']['name']);
			$imageFileType = pathinfo($base_name,PATHINFO_EXTENSION);
			$checks = getimagesize($_FILES["user_image"]["tmp_name"]);	
				//////////////////////////////////////////////
				// IMAGE UPLOAD THING - ADNAN HUSSAIN TURKI //
				//////////////////////////////////////////////

					$checks = getimagesize($_FILES["user_image"]["tmp_name"]);	
					list($width,$height) = $checks;
				
					if ($checks['mime'] == 'image/jpeg') 
							$extension = "jpeg";
																	
					elseif ($checks['mime'] == 'image/gif') 
						$extension = "gif";
															
					elseif ($checks['mime'] == 'image/png') 
						$extension = "png";
					else
						die("Only JPEG, GIF and PNG formats are accepted.");
										

					//End Of compress function
					$unique_new_name = substr(md5(mt_rand(111111,999999)), 0, 10);

					move_uploaded_file($post_image_tmp, "user_images_temp/$unique_new_name.$extension");

					$tempfiles = scandir("user_images_temp");


					// widthxheight
					$distroSizes = [
						'50x50',
						'100x100',
						'500x500'
					];

					foreach ($tempfiles as $key => $file) {
						if ($file == ".") {
							# code...
						}
						elseif ($file == "..") {
							# code...
						}
						else {
							// Making Distros Copies...
							foreach ($distroSizes as $size) {
								$specific_width = explode("x", $size)[0];
								$specific_height = explode("x", $size)[1];
								if (!file_exists("user_images/$size")) {
									mkdir("user_images/$size");
								}
								$thumb = imagecreatetruecolor($specific_width, $specific_height);
								if ($checks['mime'] == 'image/jpeg') 
									$source = imagecreatefromjpeg("user_images_temp/".$file);
								elseif ($checks['mime'] == 'image/gif') 
									$source = imagecreatefromgif("user_images_temp/".$file);
								elseif ($checks['mime'] == 'image/png') 
									$source = imagecreatefrompng("user_images_temp/".$file);
								else
									die("Only JPEG, GIF and PNG formats are accepted.");

								imagecopyresized($thumb, $source, 0, 0, 0, 0, $specific_width, $specific_height, $width, $height);
								$resized = imagejpeg($thumb,"user_images/$size/$unique_new_name.jpeg", 50);
							}


							if (!file_exists("user_images/original")) {
								mkdir("user_images/original");
							}
							// Moving Original
								if ($checks['mime'] == 'image/jpeg') 
									$source = imagecreatefromjpeg("user_images_temp/".$file);
								elseif ($checks['mime'] == 'image/gif') 
									$source = imagecreatefromgif("user_images_temp/".$file);
								elseif ($checks['mime'] == 'image/png') 
									$source = imagecreatefrompng("user_images_temp/".$file);
								else
									die("Only JPEG, GIF and PNG formats are accepted.");
							imagejpeg($source,"user_images/original/$unique_new_name.jpeg");
							imagejpeg($source,"user_images/$unique_new_name.jpeg");

							if (!file_exists("user_images/general")) {
								mkdir("user_images/general");
							}

							// Making a general Image
								// Calculating General Dimension
								if ($width > 500) {
									$proportionalityRatio = round($width/500);
									$general_width = ($width/$proportionalityRatio);
									$general_height = ($height/$proportionalityRatio);
								}
								elseif ($height > 500) {
									$proportionalityRatio = round($height/500);
									$general_width = ($width/$proportionalityRatio);
									$general_height = ($height/$proportionalityRatio);
								} else{
									$general_width = $width;
									$general_height = $width;
								}
							
							$thumb = imagecreatetruecolor($general_width, $general_height);
								if ($checks['mime'] == 'image/jpeg') 
									$source = imagecreatefromjpeg("user_images_temp/".$file);
								elseif ($checks['mime'] == 'image/gif') 
									$source = imagecreatefromgif("user_images_temp/".$file);
								elseif ($checks['mime'] == 'image/png') 
									$source = imagecreatefrompng("user_images_temp/".$file);
								else
									die("Only JPEG, GIF and PNG formats are accepted.");
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $general_width, $general_height, $width, $height);
							imagejpeg($thumb,"user_images/general/$unique_new_name.jpeg");
				

							// Removing Temp Image
							unlink("user_images_temp/$unique_new_name.$extension");

						}
					}

					// New File Name 
					$uniqueImage = $unique_new_name.".jpeg";

			
				
				//////////////////////////////////////////////
				// END IMAGE UPLOAD  - ADNAN HUSSAIN TURKI  //
				//////////////////////////////////////////////
				function random_password( $length = 8 ) 
				{
					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
					$password = substr( str_shuffle( $chars ), 0, $length );
					return $password;
				}
				$verification = random_password(8); 
				$code = base64_encode($verification);
				
				$stmt = $mysqli->prepare("insert into users (user_name,user_email,user_pass,user_contact,user_gender,user_dob,user_status,user_searchingfor,user_religion,user_mothertongue,user_casteordivision,user_country,user_state,user_feeling,user_image,user_regdate,verification) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$stmt->bind_param("sssssssssssssssss", $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n,$o,$p,$q);
				
				$a = "$user_name";
				$b = "$user_email";
				$c = "$user_pass";
				$d = "$user_contact";
				$e = "$user_gender";
				$f = "$user_dob";
				$g = "$user_status";
				$h = "$user_searchingfor";
				$i = "$user_religion";
				$j = "$user_mothertongue";
				$k = "$user_casteordivision";
				$l = "$user_country";
				$m = "$user_state";
				$n = "$user_feeling";
				$o = "$uniqueImage";
				$p = "$user_regdate";
				$q = "$verification";
				
				$row = $stmt->execute();
								
				if($row)
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
													<br><center><h2 style='color:black;'><b>Find Best Jodi - Email Verification</b></h2></center>
												</th>
											</tr>
											<tr>
												<td style='border:5px solid #ddd;padding:5px'>
													<center><p style='color:black;'>
													<b>Thank You For Signing Up Into FIND BEST JODI</b><br>
													Verify your email to find people with similar interests. We are here to provide you a world of Similar people.</p></center>
												</td>
											</tr>
											<tr>
												<td style='border:5px solid #ddd;padding:5px'>
													<center><h4 style='color:black;'><b>Click Here To Verify Your Email</b></h4></center>
													<center><button style='background-color:#2c82f8; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;'>
													<b><a href='https://www.findbestjodi.com/verification.php?verify=$encoded_user_email&code=$code' style='color:black;'>Verify Email</a></b></button></center><br><br>
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
								</body>
								</html>";
					$subject = "Email verification";
					mail($to,$subject,$message,$header) or die();

					
					echo "<script>alert('Successfully Registered! Verify Your Email, A Verification Link Has Been Sent To Your Mail-Id')</script>";
					echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
					exit();
				}
		} 
	}
	else
	{
		echo "<script>alert('Passwords Do Not Matched')</script>";
		echo "<script>window.open('https://findbestjodi.com/register.php','_self')</script>";
		exit();
	}
}
else
{
	echo "<script>alert('Can't Access Directly!')</script>";
	echo "<script>window.open('https://findbestjodi.com/register.php','_self')</script>";
	exit();
}
?>
<!-- End Of Php Code For Sign Up -->