<?php
include("connect.php");
$query = mysqli_query($mysqli,"select * from users");
while($query_row = mysqli_fetch_array($query))
{
	$presentdate = date('m.d');
	$user_dob = $query_row['user_dob'];
	$user_dob_conv= strtotime($user_dob);
	$user_month_day= date('m.d',$user_dob_conv);
	if($presentdate==$user_month_day)
	{
		$user_id = $query_row['user_id'];
		$user_email = $query_row['user_email'];
		$user_name = $query_row['user_name'];
		$user_image = $query_row['user_image'];
		$post_content = "Today Is $user_name's Birthday. Wish $user_name <b style='color:purple;'> A Very Happy Birthday </b>";
		$post_type = "public";
		$post_youtube = "";
		$curent_date = date("Y-m-d");
				
		$check_query = mysqli_query($mysqli,"select * from posts where user_id ='$user_id' AND post_date='$curent_date'");
		if(mysqli_num_rows($check_query)>0)
		{
			
		}  
		else
		{
			$stmt = $mysqli->prepare("insert into posts (user_id,post_image,post_content,post_type,post_youtube,post_date) values(?,?,?,?,?,?)");
			$stmt->bind_param("ssssss", $a,$b,$c,$d,$e,$f);
				
			$a = "$user_id";
			$b = "$user_image";
			$c = "$post_content";
			$d = "$post_type";
			$e = "$post_youtube";
			$f = date("Y-m-d");
							
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
												<br><center><h2 style='color:black;'><b>Find Best Jodi Wish You A Very Happy Birthday</b></h2></center>
											</th>
										</tr>
										<tr>
											<td style='border:5px solid #ddd;padding:5px'>
												<center><h4 style='color:black;'><b>Click Here To View Who Are Wishing You On Your Birthday</b></h4></center>
												<center><button style='background-color:#2c82f8; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;'>
												<b><a href='https://www.findbestjodi.com/my_profile.php' style='color:black;'>Click Here</a></b></button></center><br><br>
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
					$subject = "Find Best Jodi Wish You A Very Happy Birthday";
					mail($to,$subject,$message,$header) or die();
				
			}
		}
		
	}
}
?>