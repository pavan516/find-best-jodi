<?php 
session_start();
include("includes/check.php"); 
include("connect.php");

if(isset($_GET['noti_id']))
{
	$noti_id = base64_decode($_GET['noti_id']);
	mysqli_query($mysqli,"UPDATE notifications SET status='seen' where noti_id='$noti_id'");
}

if(isset($_SESSION['user_email']))
{
	$user_email = $_SESSION['user_email'];
	$query = mysqli_query($mysqli,"select * from users where user_email = '$user_email'");
	$row_user = mysqli_fetch_array($query);
								
	$user_id = $row_user['user_id'];
	$encoded_user_id = base64_encode($user_id);
	$user_name = $row_user['user_name'];
	$user_contact = $row_user['user_contact'];
	$user_gender = $row_user['user_gender'];
	$user_dob = $row_user['user_dob'];
	$user_status = $row_user['user_status'];
	$user_searchingfor = $row_user['user_searchingfor'];
	$user_religion = $row_user['user_religion'];
	$user_mothertongue = $row_user['user_mothertongue'];
	$user_casteordivision = $row_user['user_casteordivision'];
	$user_country = $row_user['user_country'];
	$user_state = $row_user['user_state'];
	$user_feeling = $row_user['user_feeling'];
	$user_image = $row_user['user_image'];
	$presentdate = date("Y");
	$time=strtotime($user_dob);
	$year=date("Y",$time);
	$age = $presentdate-$year;
	$life_storys = htmlspecialchars_decode($row_user['life_story']);
	$life_story=str_replace('\r\n','',$life_storys);
}
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
<title>Find Best Jodi | My Profile | <?php echo "$user_name"; ?></title>
<link rel="icon" type="image/png" href="https://www.findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | My Profile | <?php echo "$user_name"; ?></title>
<meta property="og:image" content="https://www.findbestjodi.com/user_images/<?php echo "$user_image"; ?>">
<meta itemprop="image" content="https://www.findbestjodi.com/user_images/<?php echo "$user_image"; ?>">
<meta name="description" content="<?php echo "$user_feeling"; ?>" />
<meta name="keywords" content="<?php echo "$user_feeling"; ?> , <?php echo "$user_feeling"; ?><?php echo "$user_name"; ?>, <?php echo "$user_name"; ?> find best jodi , <?php echo "$user_name"; ?> find best friend, best jodi, best jodi find, find best lover, find friend, find jodi, jodi,login" />

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
					
						<table id="customers">
							<tr>
								<th colspan="2"><center>Share & Support Find Best Jodi</center></th>
							</tr>
							<tr>
								<?php 
								$str = "https://play.google.com/store/apps/details?id=com.vdtlabs.findbestjodi";
								$url = urlencode($str);
								?>
								<td>Share Our Application In Facebook</td>
								<td>
									<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>" title="Facebook Share"><img src="css/fb.png"/></a>
								</td>
							</tr>
							<tr>
								<td>Share Our Application In WhatsApp</td>
								<td>
									<a class="on-inline-web" target="_blank" href="https://web.whatsapp.com/send?text=<?php echo $url; ?>" title="WhatsApp Share"><img src="css/wp.png"/></a>
									<a class="on-inline-mobile"  target="_blank" href="whatsapp://send?text=<?php echo $url; ?>" title="WhatsApp Share"><img src="css/wp.png"/></a>
								</td>
							</tr>
							<tr>
								<td>Share Our Application In Google Plus</td>
								<td>
									<a target="_blank" href="https://plus.google.com/share?url=<?php echo $url; ?>" title="Google Plus Share"><img src="css/gp.png"/></a>
								</td>
							</tr>
							<tr>
								<td>Share Our Application In Twitter</td>
								<td>
									<a target="_blank" href="http://twitter.com/share?text=Download Find Best Jodi;url=<?php echo $url; ?>" title="Twitter Share"><img src="css/tw.png"/></a>
								</td>
							</tr>
							<tr>
								<td>Share Our Application In Linked In</td>
								<td>
									<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" title="LinkedIn Share"><img src="css/in.png"/></a>
								</td>
							</tr>
							<tr>
								<td>Copy Our Application Link To Share</td>
								<td>
									<!-- Share / Copy Link -->
									<a href="javascript:void(0)" class='copy-text' style='display:none'>https://play.google.com/store/apps/details?id=com.vdtlabs.findbestjodi</a>
									<a class="btn btn-default" href="javascript:void(0)" onclick="copyToClipboard('.copy-text')" ><i class="fa fa-files-o" ></i> Share Link </a>
									<script>
									function copyToClipboard(element) 
									{
										var $temp = $("<input>");
										$("body").append($temp);
										$temp.val($(element).text()).select();
										document.execCommand("copy");
										$temp.remove();
										alert('Link Copied To Clipboard-Share Anywhere!');
									}
									</script>		
									<!-- End Of Link Copied To Clipboard -->
								</td>
							</tr>
						</table>
								
										
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