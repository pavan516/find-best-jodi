<?php 
session_start();
if(isset($_COOKIE['user_email']))
{
	echo "<script>window.open('index.php','_self')</script>";
	exit("Hi");
}
else
{
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
<title>Find Best Jodi | Sign-In</title>
<link rel="icon" type="image/png" href="https://www.findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | Sign-In</title>
<meta property="og:image" content="https://www.findbestjodi.com/css/logoup.png">
<meta itemprop="image" content="https://www.findbestjodi.com/css/logoup.png">
<meta name="description" content="FIND BEST JODI | Where People Meet Their Interests | Find Best Jodi is a social networking platform where you can find people from different sources with similar interests in different aspects such as Love ,Life, Education and Careers. Find Best Jodi is a  platform with unique user experience . This helps user  to explore a world of new people . Find Your Jodi - Where People meet their Interests." />
<meta name="keywords" content="find best jodi login, find best jodi sign in, best jodi login, best jodi sign in, find best friend, find friend, find jodi, jodi,login, sign in" />
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
						<center><h3 style="color:grey;">Sign-in Here </h3></center>
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
					
							<form method="post" action="#" enctype="multipart/form-data">
								
								<div class="row">
						
									<div class="col-md-12">
										<label>Email</label>
										<div class="form-group">
											<input type="email" name="user_email" id="user_email" required="required" class="form-control" placeholder="Enter Your E-Mail"/>	
										</div>
									</div>
									
									<div class="col-md-12">
										<label>Password</label>
										<div class="form-group">
											<input type="password" name="user_pass" id="user_pass" required="required" class="form-control" placeholder="Password"/>	
										</div>
									</div>
									
									<div class="form-group">
										<center><input type="submit" name="login" id="login" class="btn btn-primary" value="Sign In"></center>
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
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script> -->
		<!-- jQuery Easing -->
		<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script async src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Waypoints -->
		<script async src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js" type="text/javascript"></script>
		<!-- Magnific Popup -->
		<script async src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" type="text/javascript"></script>
		<!-- Salvattore -->
		<script async src="https://cdnjs.cloudflare.com/ajax/libs/salvattore/1.0.9/salvattore.min.js" type="text/javascript"></script>		
		<!-- Main JS -->
		<script async src="js/main.js"></script>
		<!-- End Of Js Links --> 
		
	</body>
</html>

<script>
function afterSuccessLogin(user_email) 
{
				
//	alert("Hello in script:    " + user_email );
	// if (Android != undefined) {
    // if (Android.saveValues != undefined) {

    Android.saveValues(user_email); 

    //alert("Hello");			   
    // }
    // }       
}
</script>


<!-- Php Code For Sign In -->
<?php
include('connect.php');
if(isset($_POST['login']))
{
	$user_email = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_email']), ENT_QUOTES, 'UTF-8');
	$encoded_user_email = base64_encode($user_email);
	$user_pass = (crypt(sha1(md5(htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_pass']), ENT_QUOTES, 'UTF-8'))),$encoded_user_email));
						
	$rawQuery = "SELECT * FROM users WHERE user_email = ? AND user_pass = ? AND verification = ?";
	$stmt = $mysqli->prepare($rawQuery);			
	$stmt->bind_param("sss", $a, $b, $c);
				
		$a = "$user_email";
		$b = "$user_pass";
		$c = "verified";
													
		$stmt->execute();
		$count = mysqli_stmt_fetch($stmt);
		
		if($count=='1')
		{
			$_SESSION['user_email'] = $user_email;
			echo "<script>alert('WELCOME TO FIND BEST JODI!')</script>";
			
			if(isset($_SESSION['user_email']))
			{
				$user_email = $_SESSION['user_email'];
				
				echo '<script>afterSuccessLogin("'.$user_email.'")</script>';
								
				$to = $user_email;
				$header = "FROM: Find Best Jodi <pavankumar@tirupati.hostedbywlh.com>\r\n";
				$message = "Welcome $user_name To FIND BEST JODI | Have you Ever thought of finding people with similar interests. We are here to provide you a world of Similar people. Where you can connect with the World you Love. It is a Social networking platform where you can find people from different sources with similar interests in different aspects such as Love ,Life, Education and Careers. Find Best Jodi is a  platform with unique user experience . This helps user  to explore a world of new people . Find Your Jodi - Where People meet their Interests";
				$subject = "Login Alerts";
				mail($to,$subject,$message,$header) or die();
				
				echo "<script>window.open('https://findbestjodi.com/check.php','_self')</script>";
				exit();
			}
		}
		else
		{
			echo "<script>alert('Your Email Or Password Is Incorrect! / Unverified')</script>";
			echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
			exit();
		}
}
?>
<!-- End Of Php Code For Sign In -->
<?php } ?>