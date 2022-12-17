<?php session_start(); ?>
<!-- php code for change profile pic -->
		<?php
		if(isset($_POST['post']))
		{
			include('connect.php');
						
			$post_type = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['post_type']), ENT_QUOTES, 'UTF-8');
			$post_image = htmlspecialchars(mysqli_real_escape_string($mysqli,$_FILES['post_image']['name']), ENT_QUOTES, 'UTF-8');
			$post_image_tmp = $_FILES['post_image']['tmp_name'];
			$post_youtube = htmlspecialchars(mysqli_real_escape_string($mysqli,ltrim($_POST['post_youtube'],"https://www.youtube.com/watch?v=")), ENT_QUOTES, 'UTF-8');
	
			$post_content = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['post_content']), ENT_QUOTES, 'UTF-8');
				
			$user_email = $_SESSION['user_email'];
			$query = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
			$row = mysqli_fetch_array($query);
			
			$user_id = $row['user_id'];
			$encoded_user_id = base64_encode($user_id);
						
			if($post_image=="" && $post_content=="" && $post_youtube=="")
			{
				echo "<script>alert('Share Your Feelings!')</script>";
				echo "<script>window.open('https://findbestjodi.com/favtimeline.php','_self')</script>";
				exit();
			}
			else
			{
				include("connect.php");
				
				if(!$post_image=="")
				{
					$base_name = basename($_FILES['post_image']['name']);
					$imageFileType = pathinfo($base_name,PATHINFO_EXTENSION);
					$checks = getimagesize($_FILES["post_image"]["tmp_name"]);	
									
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
						echo "<script>window.open('/favtimeline.php','_self')</script>";
												die();
					}				

					//End Of compress function
					$unique_new_name = substr(md5(mt_rand(111111,999999)), 0, 10);

				
					move_uploaded_file($_FILES["post_image"]["tmp_name"], "post_images_temp/$unique_new_name.$extension");
				
					$tempfiles = scandir("post_images_temp");


					// widthxheight
					$distroSizes = [
						'200x200',
						'300x300',
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
								if (!file_exists("post_images/$size")) {
									mkdir("post_images/$size");
								}
								$thumb = imagecreatetruecolor($specific_width, $specific_height);

								if ($checks['mime'] == 'image/jpeg') 
									$source = imagecreatefromjpeg("post_images_temp/".$file);
								elseif ($checks['mime'] == 'image/gif') 
									$source = imagecreatefromgif("post_images_temp/".$file);
								elseif ($checks['mime'] == 'image/png') 
									$source = imagecreatefrompng("post_images_temp/".$file);
								else
								{
									echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
									echo "<script>window.open('/favtimeline.php','_self')</script>";
								}	
							
								imagecopyresized($thumb, $source, 0, 0, 0, 0, $specific_width, $specific_height, $width, $height);
								$resized = imagejpeg($thumb,"post_images/$size/$unique_new_name.jpeg", 50);
							}
							if (!file_exists("post_images/original")) {
								mkdir("post_images/original");
							}
							// Moving Original
							if ($checks['mime'] == 'image/jpeg') 
								$source = imagecreatefromjpeg("post_images_temp/".$file);
							elseif ($checks['mime'] == 'image/gif') 
								$source = imagecreatefromgif("post_images_temp/".$file);
							elseif ($checks['mime'] == 'image/png') 
								$source = imagecreatefrompng("post_images_temp/".$file);
							else
							{
								echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
								echo "<script>window.open('/favtimeline.php','_self')</script>";
							}	
							imagejpeg($source,"post_images/original/$unique_new_name.jpeg");
							imagejpeg($source,"post_images/$unique_new_name.jpeg");

							if (!file_exists("post_images/general")) {
								mkdir("post_images/general");
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
								$source = imagecreatefromjpeg("post_images_temp/".$file);
							elseif ($checks['mime'] == 'image/gif') 
								$source = imagecreatefromgif("post_images_temp/".$file);
							elseif ($checks['mime'] == 'image/png') 
								$source = imagecreatefrompng("post_images_temp/".$file);
							else
							{
								echo '<script>alert("Only JPEG, GIF and PNG formats are accepted.")</script>';
								echo "<script>window.open('/favtimeline.php','_self')</script>";
							}	
				
							imagecopyresized($thumb, $source, 0, 0, 0, 0, $general_width, $general_height, $width, $height);
							imagejpeg($thumb,"post_images/general/$unique_new_name.jpeg");


							// Removing Temp Image
							unlink("post_images_temp/$unique_new_name.$extension");

						}
					}

					// New File Name 
					$uniqueImage = $unique_new_name.".jpeg";			
					
				}
				
				$stmt = $mysqli->prepare("insert into posts (user_id,post_image,post_content,post_type,post_youtube,post_date) values(?,?,?,?,?,?)");
				$stmt->bind_param("ssssss", $a,$b,$c,$d,$e,$f);
				$post_content =  preg_replace('#(\\\r\\\n)#', " <br /> ", $post_content);;

				$taggedguys = [];
				// Exploding Content Text
				$exploded = explode(" ", $post_content);
				$post_content = "";
				foreach ($exploded as $word) {
					if (substr($word, 0, 1) == "@") {
						$user_name = strtolower(substr($word, 1)); 
						// Checking If this Username even Exists
						$query = "SELECT COUNT(*),user_id FROM `users` WHERE `users`.`user_name` = '" . $user_name . "'";
						$result = mysqli_query($mysqli, $query);
						$data = mysqli_fetch_array($result);
						
						if ($data[0] == 1) {
							$word = "<a href='/user_profile.php?user=". base64_encode($data[1]) . "'>{$user_name}</a>";
							$taggedguys[] = $data[1];
							// Trigger Notifications
							

						}
					}
					$post_content = $post_content . " " . $word;
				}



				$a = "$user_id";
				$b = "$uniqueImage";
				$c = "$post_content";
				$d = "$post_type";
				$e = "$post_youtube";
				$f = date("Y-m-d");
							
				$row = $stmt->execute();
				$post_id = (mysqli_insert_id($mysqli));
	
				$today = date("Y-m-d");
			 	foreach ($taggedguys as $tagged) {
			 		$query = "INSERT INTO `notifications` (`noti_id`, `post_id`, `user_id`, `post_user_id`, `type`, `date`, `status`) VALUES (NULL, '{$post_id}', '{$user_id}', '{$tagged}', 'tag', '{$today}', 'unseen');";
					$result = mysqli_query($mysqli, $query);
				}			
										
				if($row)
				{
					echo "<script>alert('Successfully Published Your Post!')</script>";
					echo "<script>window.open('https://findbestjodi.com/favtimeline.php','_self')</script>";
					exit();
				}
			}
		}
		else
		{
			echo "<script>alert('Can't Access Directly!')</script>";
			echo "<script>window.open('https://findbestjodi.com/favtimeline.php','_self')</script>";
		}
		?>
		<!-- end of php code for Posting a public post -->