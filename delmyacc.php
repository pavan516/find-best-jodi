<?php 
session_start();
include("includes/check.php"); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111806738-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111806738-1');
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Find Best Jodi | Delete My Account</title>
<link rel="icon" type="image/png" href="https://findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | Delete My Account</title>
<meta property="og:image" content="https://findbestjodi.com/css/logoup.png">
<meta itemprop="image" content="https://findbestjodi.com/css/logoup.png">
<meta name="description" content="FIND BEST JODI | Where People Meet Their Interests | Find Best Jodi is a social networking platform where you can find people from different sources with similar interests in different aspects such as Love ,Life, Education and Careers. Find Best Jodi is a  platform with unique user experience . This helps user  to explore a world of new people . Find Your Jodi - Where People meet their Interests." />
<meta name="keywords" content="findbestjodi, Find Best Jodi, Delete my account in find best jodi, delete account in find best jodi." /> 

<!-- Links -->
<?php include("includes/links.php"); ?>
<!-- End Of Links -->

</head>
	<body>
		
		<!-- Right SideBar -->
		<?php include("includes/right_sidebar.php"); ?>
		<!-- End Of Right SideBar -->
	
		<!-- Body -->
		<div id="fh5co-main">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<center><h3 style="color:grey;">Deleting My Account permanently</h3></center>
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
					
							<form method="post" action="" enctype="multipart/form-data">
								
								<div class="row">
													
									<div class="col-md-12">
										<label>LoggedIn Email</label>
										<div class="form-group">
											<input type="email" name="user_email" id="user_email" required="required" class="form-control" placeholder="Enter Your E-Mail"/>	
										</div>
									</div>
									
									<div class="col-md-12">
										<label>LoggedIn Password</label>
										<div class="form-group">
											<input type="password" name="user_pass" id="user_pass" required="required" class="form-control" placeholder="Password"/>	
										</div>
									</div>
									
									<div class="col-md-12">
										<label>Feedback us - Y Do You Want To Delete Your Account!</label>
										<div class="form-group">
											<textarea name="feedback" id="feedback" required="feedback" class="form-control" placeholder="Feedback us - Y Do You Want To Delete Your Account!"></textarea>
										</div>
									</div>									
									
									<div class="form-group">
										<center><input type="submit" name="delete" id="delete" class="btn btn-primary" value="Delete My Account"></center>
									</div>
									
								</div>
								
							</form>
					
					</div>
        		</div>
			</div>
		</div>
		<!-- End Of Body -->
		
		<!-- Footer -->
		<?php include("includes/footer_links.php"); ?>
		<!-- End Of Footer -->
		
		<!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
		<!-- jQuery Easing -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Waypoints -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" type="text/javascript"></script>
		<!-- Magnific Popup -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" type="text/javascript"></script>
		<!-- Salvattore -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/salvattore/1.0.9/salvattore.min.js" type="text/javascript"></script>		
		<!-- Main JS -->
		<script src="js/main.js"></script>
		<!-- End Of Js Links -->
		
	</body>
</html>

<!-- Php Code For Delete Account -->
<?php
include('connect.php');
if(isset($_POST['delete']))
{
	$user_email = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_email']), ENT_QUOTES, 'UTF-8');
	$encoded_user_email = base64_encode($user_email);
	$user_pass = (crypt(sha1(md5(htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_pass']), ENT_QUOTES, 'UTF-8'))),$encoded_user_email));
	$feedback = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['feedback']), ENT_QUOTES, 'UTF-8');
		
	$rawQuery = mysqli_query($mysqli,"SELECT * FROM users WHERE user_email = '$user_email' AND user_pass = '$user_pass'");
	$count = mysqli_num_rows($rawQuery);
	if($count=='1')
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
											<br><center><h2 style='color:black;'><b>Find Best Jodi - Account Deletion Verification</b></h2></center>
										</th>
									</tr>
									<tr>
										<td style='border:5px solid #ddd;padding:5px'>
											<center><p style='color:black;'>
											<b>Account Deletion Of Find Best Jodi</b><br>
											Deleting Your Account Will Permanently Deletes Your Complete Data!</p></center>
										</td>
									</tr>
									<tr>
										<td style='border:5px solid #ddd;padding:5px'>
											<center><h4 style='color:black;'><b>Click Here To Delete Your Account Permanently</b></h4></center>
											<center><button style='background-color:#2c82f8; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;'>
											<b><a href='https://www.findbestjodi.com/delmyaccverify.php?verify=$encoded_user_email' style='color:black;'>Verify Deletion Of Your Account</a></b></button></center><br><br>
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
						
				$subject = "Account Deletion Verification";
				mail($to,$subject,$message,$header) or die();

				$to = "findbestjodi.com@gmail.com";
				$from = "$user_email";
				$message = "$user_email - $feedback";
				$subject = "Account Deleted";
				mail($to,$subject,$message,$from) or die();
				
				echo "<script>alert('An Verification Link Is Sended To Your Mail Id To Delete Your Account Permanently!')</script>";
				echo "<script>window.open('https://findbestjodi.com/logout.php','_self')</script>";
				exit();
			
		}
		else
		{
			echo "<script>alert('Your Email Or Password Is Incorrect! / Unverified')</script>";
			echo "<script>window.open('https://findbestjodi.com/delmyacc.php','_self')</script>";
			exit();
		}
}
?>
<!-- End Of Php Code For delete account -->