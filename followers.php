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
<title>Find Best Jodi | My Followers</title>
<link rel="icon" type="image/png" href="https://www.findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | My Followers</title>
<meta property="og:image" content="https://www.findbestjodi.com/css/logo.png">
<meta itemprop="image" content="https://www.findbestjodi.com/css/logo.png">
<meta name="description" content="FIND BEST JODI | Have you Ever thought of finding people with similar interests. We are here to provide you a world of Similar people. Where you can connect with the World you Love. It is a Social networking platform where you can find people from different sources with similar interests in different aspects such as Love ,Life, Education and Careers. Find Best Jodi is a  platform with unique user experience . This helps user  to explore a world of new people . Find Your Jodi - Where People meet their Interests." />
<meta name="keywords" content="followers find best jodi, my followers in find best jodi, people who are following me in find best jodi, my followers findbestjodi." />

<!-- Links -->
<?php include("includes/links.php"); ?>
<!-- End Of Links -->

</style>
</head>
	<body>
		
		<!-- Right SideBar -->
		<?php include("includes/right_sidebar.php"); ?>
		<!-- End Of Right SideBar -->
		
		<!-- Body -->
		<div id="fh5co-main">
			<div class="container">
				<div class="row">
					<table id="customers">
						<tr>
							<th><center>Followers</center></th>
						</tr>
					</table>
					<div class="fh5co-spacer fh5co-spacer-sm"></div>
					<div id="fh5co-board" data-columns>
						
						<?php
						$session_email = $_SESSION['user_email'];
						$querys = mysqli_query($mysqli,"SELECT * FROM users WHERE user_email='$session_email'");
						$row = mysqli_fetch_array($querys);
						
						$loggedin_user_id = $row['user_id'];
						?>
						
						<?php
						include("connect.php");
						$query = mysqli_query($mysqli,"SELECT * FROM users ORDER BY 1 DESC");
						while($row_user = mysqli_fetch_array($query))
						{
							$user_id = $row_user['user_id'];
							$encoded_user_id = base64_encode($user_id);
							$user_email = $row_user['user_email'];
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
							$online = $row_user['online'];
							$presentdate = date("Y");
							$time=strtotime($user_dob);
							$year=date("Y",$time);
							$age = $presentdate-$year;
							
							$followers = mysqli_query($mysqli,"select * from follower where follow_id='$loggedin_user_id' and status='accepted'");
							while($rows = mysqli_fetch_array($followers))
							{
							
								$follow_id = $rows['user_id'];
								if($user_id==$follow_id)
								{?>
						
									<div class="item">
										<div class="animate-box">
											<?php
											if($user_image=="")
											{
											}
											else
											{?>
												<a href="<?php echo "https://findbestjodi.com/user_images/$user_image"; ?>" class="image-popup fh5co-board-img" title="<?php echo "$user_feeling"; ?>"><img src="user_images/<?php echo "$user_image"; ?>" alt="<?php echo "$user_name Image Is Missing Find Later"; ?>"></a>
											<?php } ?>
										</div>
									
										<div class="fh5co-desc">
											<?php echo "<a href='https://findbestjodi.com/user_profile.php?user=$encoded_user_id' style='color:#2c82f8;font-size:120%'><b>$user_name</b><p style='float:right;color:#4dc82c'>";if($online=='1'){ echo '<b>online</b>'; } else { echo 'offline'; }echo "</p></a>"; ?><br>
											<label>Gender :</label> <?php echo "$user_gender"; ?><br>
											<label>Age :</label> <?php echo "$age Years"; ?><br>
											<label>RelationShip Status :</label> <?php echo "$user_status"; ?><br>
											<label>Searching For A :</label> <?php echo "$user_searchingfor"; ?><br>
											<label>Religion :</label> <?php echo "$user_religion"; ?><br>
											
											<?php include("follow.php"); ?>
											<?php include("remove.php"); ?>
											
											<center><a class="btn btn-default" href="user_profile.php?user=<?php echo $encoded_user_id; ?>" >View Profile</a>
											
											<?php
											if($check == 1)
											{
												echo "<a class='btn btn-default' href='/chat/public/?user_name=$user_name' >Chat With Me</a></center>";
											}
											else
											{
												echo "<a class='btn btn-default' href='javascript:void(0)' onclick='alertmsg12()' >Chat With Me</a></center>";
											}
											?>
											<script type="text/javascript">
											function alertmsg12() { alert("Follow Me To Chat With Me!"); } 
											</script>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						<?php } ?>
						
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