<?php 
session_start();
include("includes/check.php"); 

if(isset($_POST['changeprof']))
{
	include('connect.php');
						
	$user_image = htmlspecialchars(mysqli_real_escape_string($mysqli,$_FILES['user_image']['name']), ENT_QUOTES, 'UTF-8');
	$post_image_tmp = $_FILES['user_image']['tmp_name'];
	
	if(isset($_COOKIE['user_email']))
	{
		$user_email = $_SESSION['user_email'];
		
		$base_name = basename($_FILES['user_image']['name']);
		$imageFileType = pathinfo($base_name,PATHINFO_EXTENSION);
		$checks = getimagesize($_FILES["user_image"]["tmp_name"]);	
		list($width,$height) = $checks;
	
		if ($checks['mime'] == 'image/jpeg') 
				$extension = "jpeg";
														
		elseif ($checks['mime'] == 'image/gif') 
			$extension = "gif";
												
		elseif ($checks['mime'] == 'image/png') 
			$extension = "png";
		else
		{
			echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
			echo "<script>window.open('/my_profile.php','_self')</script>";
			die();
		}	
							

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
					{
						echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
						echo "<script>window.open('/my_profile.php','_self')</script>";
					}	

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
					{
						echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
						echo "<script>window.open('/my_profile.php','_self')</script>";
					}	
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
					{
						echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
						echo "<script>window.open('/my_profile.php','_self')</script>";
					}	
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $general_width, $general_height, $width, $height);
				imagejpeg($thumb,"user_images/general/$unique_new_name.jpeg");
	

				// Removing Temp Image
				unlink("user_images_temp/$unique_new_name.$extension");

			}
		}

		// New File Name 
		$uniqueImage = $unique_new_name.".jpeg";

		// Adding Data To the Databasase
		$stmt = $mysqli->prepare("UPDATE users SET user_image=? where user_email=?");
		$stmt->bind_param("ss", $a,$b);
				
		$a = "$uniqueImage";
		$b = "$user_email";
							
		$row = $stmt->execute();
					
		if($row)
		{
			echo "<script>alert('Successfully Changed Your Profile Pic!')</script>";
			echo "<script>window.open('/my_profile.php','_self')</script>";
			exit();
		}
	}
}
else
{
	echo "<script>alert('Can't Access Directly!')</script>";
	echo "<script>window.open('/my_profile.php','_self')</script>";
	exit();
}
?>