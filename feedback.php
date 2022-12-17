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
<title>Find Best Jodi | Contact Us</title>
<link rel="icon" type="image/png" href="https://findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | Contact Us</title>
<meta property="og:image" content="https://findbestjodi.com/css/logoup.png">
<meta itemprop="image" content="https://findbestjodi.com/css/logoup.png">
<meta name="description" content="FIND BEST JODI is a Social networking platform where you can find people from different sources with similar interests in different aspects such as Love ,Life, Education and Careers. Find Best Jodi is a  platform with unique user experience . This helps user  to explore a world of new people . Find Your Jodi - Where People meet their Interests." />
<meta name="keywords" content="Contact Us find best jodi, contact find best jodi, Contact Us findbestjodi" />

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
						<center><h3 style="color:grey;">Feed Back Form</h3></center>
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
					
							<form method="post" action="" enctype="multipart/form-data">
								
								<div class="row">
						
									<div class="col-md-12">
										<label>Email</label>
										<div class="form-group">
											<input type="email" name="email" id="email" required="required" class="form-control" placeholder="Enter Your E-Mail"/>	
										</div>
									</div>
									
									<div class="col-md-12">
										<label>Your Name</label>
										<div class="form-group">
											<input type="text" name="name" id="name" required="required" class="form-control" placeholder="Enter Your Name"/>	
										</div>
									</div>
									
									<div class="col-md-12">
										<label>Contact</label>
										<div class="form-group">
											<input type="number" name="contactno" id="contactno" required="required" class="form-control" placeholder="Contact"/>	
										</div>
									</div>
									
									<div class="col-md-12">
										<label>Your FeedBack</label>
										<div class="form-group">
											<textarea name="msg" id="msg" required="required" class="form-control" placeholder="Your Feedback!"/></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<center><input type="submit" name="feedback" id="feedback" class="btn btn-primary" value="FeedBack"></center>
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

<!-- Php Code For Contact -->
<?php
include("connect.php");
if(isset($_POST['feedback']))
{
	$email = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['email']), ENT_QUOTES, 'UTF-8');
	$name = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['name']), ENT_QUOTES, 'UTF-8');
	$contact = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['contact']), ENT_QUOTES, 'UTF-8');
	$msg = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['msg']), ENT_QUOTES, 'UTF-8');

	$to = "findbestjodi.com@gmail.com";
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
									<br><center><h2 style='color:black;'><b>Find Best Jodi - Contact Form</b></h2></center>
								</th>
							</tr>
							<tr>
								<td style='border:5px solid #ddd;padding:5px'>
									<center><h4 style='color:black;'><b>$name</b></h4></center>
									<center><h4 style='color:black;'><b>$email</b></h4></center>
									<center><h4 style='color:black;'><b>$contact</b></h4></center>
									<center><h4 style='color:black;'><b>$msg</b></h4></center>
								</td>
							</tr>	
						</table>
					
					</body>
				</html>";
	$subject = "FeedBack Form";
	mail($to,$subject,$message,$header) or die();
										
	echo "<script>alert('Thank You For Your Valuable FeedBack')</script>";
	echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
	exit();
}
?>
<!-- End Of Php Code For Contact -->