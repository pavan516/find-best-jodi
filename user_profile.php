<?php 
session_start();
include("connect.php");

if(isset($_GET['noti_id']))
{
	$noti_id = base64_decode($_GET['noti_id']);
	mysqli_query($mysqli,"UPDATE notifications SET status='seen' where noti_id='$noti_id'");
}

if(isset($_GET['user']))
{
	$user_id = base64_decode($_GET['user']);
		
	mysqli_query($mysqli,"UPDATE users SET user_views=user_views + 1 WHERE user_id='$user_id'");
		
	$query = mysqli_query($mysqli,"SELECT * FROM users where user_id='$user_id'");
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
	$user_feelings = htmlspecialchars_decode($row_user['user_feeling']);
	$user_feeling = str_replace('\r\n', '', $user_feelings);
	$user_image = $row_user['user_image'];
	$user_views = $row_user['user_views'];
	$presentdate = date("Y");
	$time=strtotime($user_dob);
	$year=date("Y",$time);
	$age = $presentdate-$year;
	$life_storys = htmlspecialchars_decode($row_user['life_story']);
	$life_story=str_replace('\r\n','',$life_storys);
	
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
<title>Find Best Jodi | <?php echo "$user_name"; ?> | Profile</title>
<link rel="icon" type="image/png" href="https://www.findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | <?php echo "$user_name"; ?> | Profile</title>
<meta property="og:image" content="https://www.findbestjodi.com/user_images/<?php echo "$user_image"; ?>">
<meta itemprop="image" content="https://www.findbestjodi.com/user_images/<?php echo "$user_image"; ?>">
<meta name="description" content="<?php echo "$user_feeling"; ?>" />
<meta name="keywords" content="find best jodi profiles, <?php echo "$user_name"; ?> find best jodi, <?php echo "$user_name"; ?> Profile, <?php echo "$user_name"; ?> Profile in find best friend, best jodi, best jodi find, find best lover, find friend, find jodi, jodi,login, sign in" />

<?php } ?>

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
					
						<?php
						if(isset($_GET['user']))
						{
							$user_id = base64_decode($_GET['user']);
																			
							$query = mysqli_query($mysqli,"SELECT * FROM users where user_id='$user_id'");
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
							$user_feelings = htmlspecialchars_decode(addslashes($row_user['user_feeling']));
							$user_feeling=str_replace('\r\n','',$user_feeling);
							$user_image = $row_user['user_image'];
							$user_views = $row_user['user_views'];
							$presentdate = date("Y");
							$time=strtotime($user_dob);
							$year=date("Y",$time);
							$age = $presentdate-$year;
							$life_storys = htmlspecialchars_decode($row_user['life_story']);
							$life_story=str_replace('\r\n','',$life_storys);?>
						
					
						<table id="customers">
							<tr>
								<th><center><b><?php echo "$user_name"; ?> <i class="fa fa-eye" ></i> <?php echo "$user_views"; ?> Views</b></center></th>
							</tr>
						</table><br>
						
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
							<p>
								<img src="<?php echo "/user_images/$user_image"; ?>" alt="<?php echo "$user_name"; ?>" class="img-rounded img-responsive">
							</p>
							
							<?php
							if(isset($_SESSION['user_email']))
							{?>
								<p>
									<table id="customers">
										<tr>
											<th><center><?php echo "$user_name"; ?> Followers</center></th>
											<th><center>Follow <?php echo "$user_name"; ?></center></th>
										</tr>
										<tr><div id="posts_home_display"></div>
											<td><center><?php include("includes/user_followers.php"); ?></center></td>
											<td><center><?php include("includes/followme.php"); ?></center></td>
										</tr>
									</table>
								</p>
							<?php
							}
							else
							{?>
								<table id="customers">
									<tr>
										<th><center>Login To Follow Him/Her / View Him/Her Followers</center></th>
									</tr>
								</table>
							<?php } ?>
							
							<p>	
								<table id="customers">
									<tr>
										<th colspan="2"><center><?php echo "Small Info About $user_name"; ?></center></th>
									</tr>
									<tr>
										<td><h5 style="color:white;font-size:100%;"><?php echo "$user_feeling"; ?></h5></td>
									</tr>
								</table>
							</p>
							
							<p>
								<table id="customers">
									<tr>
										<th colspan="2"><center><?php echo "$user_name - Personal Details"; ?></center></th>
									</tr>
									<tr>
										<?php 
										$str = "https://findbestjodi.com/user_profile.php?user=$encoded_user_id";
										$url = urlencode($str);
										?>
										<td>Share <?php echo "<b>$user_name</b>"; ?> Profile</td>
										<td>
											<a class="on-inline-web" target="_blank" href="https://web.whatsapp.com/send?text=<?php echo $url; ?>" title="WhatsApp Share"><img src="css/wp.png"/></a>
											<a class="on-inline-mobile"  target="_blank" href="whatsapp://send?text=<?php echo $url; ?>" title="WhatsApp Share"><img src="css/wp.png"/></a>
											<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>" title="Facebook Share"><img src="css/fb.png"/></a>
											<a target="_blank" href="https://plus.google.com/share?url=<?php echo $url; ?>" title="Google Plus Share"><img src="css/gp.png"/></a>
											<a target="_blank" href="http://twitter.com/share?text=View <?php echo $user_name; ?> Profile;url=<?php echo $url; ?>" title="Twitter Share"><img src="css/tw.png"/></a>
											<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" title="LinkedIn Share"><img src="css/in.png"/></a>
										</td>
									</tr>
									<tr>
										<td>Copy <?php echo "<b>$user_name</b>"; ?> Profile Link</td>
										<td>
											<!-- Share / Copy Link -->
											<a href="javascript:void(0)" class='copy-text<?php echo $user_id; ?>' style='display:none'>http://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?></a>
											<a class="btn btn-default" href="javascript:void(0)" onclick="copyToClipboard('.copy-text<?php echo $user_id; ?>')" ><i class="fa fa-files-o" ></i> Share Link </a>
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
									<tr>
										<td>Gender</td>
										<td><?php echo "$user_gender"; ?></td>
									</tr>
									<tr>
										<td>Date Of Birth</td>
										<td><?php echo "$user_dob"; ?></td>
									</tr>
									<tr>
										<td>Age</td>
										<td><?php echo "$age Years"; ?></td>
									</tr>
									<tr>
										<td>Relationship Status</td>
										<td><?php echo "$user_status"; ?></td>
									</tr>
									<tr>
										<td>Intrested/Searching For</td>
										<td><?php echo "$user_searchingfor"; ?></td>
									</tr>
									<tr>
										<td>Religion</td>
										<td><?php echo "$user_religion"; ?></td>
									</tr>
									<tr>
										<td>MotherTongue</td>
										<td><?php echo "$user_mothertongue"; ?></td>
									</tr>
									<tr>
										<td>Caste / Division</td>
										<td><?php echo "$user_casteordivision"; ?></td>
									</tr>
									<tr>
										<td>Country</td>
										<td><?php echo "$user_country"; ?></td>
									</tr>
									<tr>
										<td>State</td>
										<td><?php echo "$user_state"; ?></td>
									</tr>														  
								</table>
							</p>
							
							<p>
								<table id="customers">
									<tr>
										<th colspan="2"><center><?php echo "$user_name - Life Story"; ?></center></th>
									</tr>
									<tr>
										<td><h5 style="color:white;font-size:100%;"><?php echo "$life_story"; ?></h5></td>
									</tr>
								</table>
							</p>
						<?php } ?>				
						</div>
						
						<?php
						$loggedin_user_email = $_SESSION['user_email'];
						$loggedin_query = mysqli_query($mysqli,"SELECT * FROM users where user_email = '$loggedin_user_email'");
						$loggedin_row = mysqli_fetch_array($loggedin_query);
												
						$loggedin_user_id = $loggedin_row['user_id'];
						
						$followers = mysqli_query($mysqli,"select * from follower where user_id='$loggedin_user_id' and follow_id='$user_id' and status='accepted'");
						$count = mysqli_num_rows($followers);
						if($count>=1)
						{?>
					
							<!-- Center Body -->
							<div id="fh5co-main">
								<div class="container">
									<div class="row" >
										<table id="customers">
											<tr>
												<th><center><?php echo $user_name ?> Posts</center></th>
											</tr>
										</table>
										<div id="fh5co-board"  data-columns>
											<!-- here the item will be apended -->
										</div>
									</div>
								</div>
							</div>
							
							<?php
							if(isset($_GET['user']))
							{
								$user_id = base64_decode($_GET['user']);?>
											   
							<script>
							$(document).ready(function()
							{
								 var limit = 5;
								 var start = 0;
								 var user_id = <?php echo $user_id; ?>;
								 var action = 'inactive';
								 function load_country_data(limit, start, user_id)
								 {
									$.ajax({
									url:"user_profilefetch.php",
									method:"POST",
									data:{limit:limit, start:start, user_id:user_id},
									cache:false,
									success:function(data)
									{
										items = $(data).toArray();
										
										var index;
										var itemIndex;
										
										var container = $('#fh5co-board .column');
										var containerLen = $('#fh5co-board .column').length;
												
										for (index = 0, itemIndex = 0, len = items.length , collen = container.length; index < collen,itemIndex < len ; ++index,++itemIndex) 
										{
											byThree = parseInt( index/3);
											
											if (byThree > (containerLen- 1)) 
											{
												index = 0;
												byThree = 0;
											}
											
											if ($(items[itemIndex]).attr("class") == "item fetched") 
											{
												console.log("Coloum: " + byThree);
												console.log("Item : " +itemIndex);
												console.log("Item Data :");
												console.log($(items[itemIndex]).attr("class"));
												console.log("========================");
												$(container[byThree]).append(items[itemIndex]);
											}
											else 
											{
												index++;
											}

										}
											
										// console.log($('#fh5co-board .column').html());
										
										if(data == '')
										{
											$('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
											action = 'active';
										}
										else
										{
											$('#load_data_message').html("<center><button style='background-color:#2c82f8;' type='button' class='btn btn-warning'><b >Loading...</b></button></center>");
											action = "inactive";
										}

										!function(){"use strict";var a=function(){$("body").on("click",".js-fh5co-menu-btn, .js-fh5co-offcanvass-close",function(){$("#fh5co-offcanvass").toggleClass("fh5co-awake")})},o=function(){$(document).click(function(a){var o=$("#fh5co-offcanvass, .js-fh5co-menu-btn");o.is(a.target)||0!==o.has(a.target).length||$("#fh5co-offcanvass").hasClass("fh5co-awake")&&$("#fh5co-offcanvass").removeClass("fh5co-awake")}),$(window).scroll(function(){$(window).scrollTop()>500&&$("#fh5co-offcanvass").hasClass("fh5co-awake")&&$("#fh5co-offcanvass").removeClass("fh5co-awake")})},n=function(){$(".image-popup").magnificPopup({type:"image",removalDelay:300,mainClass:"mfp-with-zoom",titleSrc:"title",gallery:{enabled:!0},zoom:{enabled:!0,duration:300,easing:"ease-in-out",opener:function(a){return a.is("img")?a:a.find("img")}}})},s=function(){$(".animate-box").length>0&&$(".animate-box").waypoint(function(a){"down"!==a||$(this).hasClass("animated")||$(this.element).addClass("bounceIn animated")},{offset:"75%"})};$(function(){n(),a(),o(),s()})}();
									}
									});
								}

								if(action == 'inactive')
								{
									action = 'active';
									load_country_data(limit, start, user_id);
								}
								
								$(window).scroll(function()
								{
									if($(window).scrollTop() + $(window).height() > $("#fh5co-board").height() && action == 'inactive')
									{
										action = 'active';
										start = start + limit;
										setTimeout(function()
										{
											load_country_data(limit, start, user_id);
										}, 1000);
									}
								});						 
							});
							</script> 

							<center><div id="load_data_message"></div></center>				
							<!-- End Of Body -->
						
							<?php } ?>
						<?php 
						}
						else
						{?>
							
							<div id="fh5co-main">
								<div class="container">
									<div class="row" >
										<table id="customers">
											<tr>
												<th><center><?php echo $user_name ?> Posts</center></th>
											</tr>
										</table>
										<div id="fh5co-board" >
											<table id="customers">
											<tr>
												<td><center>Follow Me To View My Posts</center></td>
											</tr>
										</table>
										</div>
									</div>
								</div>
							</div>
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