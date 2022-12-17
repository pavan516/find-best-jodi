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
<script>

	var names;
	$.ajax({
		url:"/chat/public/getnames",
		method:"GET",
		async: false,
		success:function(data)
		{
			 names = data;
		}
	})
var parsed = JSON.parse(names);

var arr = [];

for(var x in parsed){
  arr.push(parsed[x]);
}

$('.taggable').atwho({
    at: "@",
    data: arr,
})

</script>
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
							$user_feelings = htmlspecialchars_decode($row_user['user_feeling']);
							$user_feeling = str_replace('\r\n', '', $user_feelings);							
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
								<th><center><?php echo "$user_name"; ?> <i class="fa fa-eye" ></i> <?php echo "$user_views"; ?> Views</center></th>
							</tr>
						</table><br>
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
							
						<p>
							<img src="<?php echo "/user_images/$user_image"; ?>" alt="<?php echo "$user_name"; ?>" class="img-rounded img-responsive">
						</p>
						
						<p>
							<table id="customers">
								<tr>
									<th><center>My Followers</center></th>
									<th><center>My Requests</center></th>
								</tr>
								<tr>
									<td><center><?php include("includes/my_followers.php"); ?></center></td>
									<td><center><?php include("includes/my_requests.php"); ?></center></td>
								</tr>
							</table>
						</p>
						
						<table id="customers">
							<tr>
								<th><center><a href="javascript:void(0)" style="color:white;" onclick="mydetails()">View My Details <i class="fa fa-chevron-down"></i> </a></center></th>
							</tr>
						</table>
						
						<script>  
						function mydetails()
						{
							$.ajax({
								url: "mydetails.php",
								method: "POST",
								async: false,
								success: function(data)
								{
									$('.mydetails').html(data);	
								}
							});
						}
						</script>
						<div class="mydetails"></div>
																								
						<?php } ?>
						
						
						<!-- Edit Details -->
						<table id="customers">
							<tr>
								<th><center><a href="javascript:void(0)" style="color:white;" onclick="editdetails()">Edit My Details <i class="fa fa-chevron-down"></i> </a></center></th>
							</tr>
						</table>
						
						<script>  
						function editdetails()
						{
							$.ajax({
								url: "editdetails.php",
								method: "POST",
								async: false,
								success: function(data)
								{
									$('.editdetails').html(data);	
								}
							});
						}
						</script>
						<div class="editdetails"></div>
						<!-- End Of Edit Details -->
						
						<!-- share your feelings -->
						<table id="customers">
							<tr>
								<th><center><a href="javascript:void(0)" style="color:white;" onclick="sharefeelings()">Share Your Feelings <i class="fa fa-chevron-down"></i> </a></center></th>
							</tr>
						</table>
						
						<script>  
						function sharefeelings()
						{
							$.ajax({
								url: "sharefeelings.php",
								method: "POST",
								async: false,
								success: function(data)
								{
									$('.sharefeelings').html(data);	
								}
							});
						}
						</script>
						<div class="sharefeelings"></div>
						<!-- End Of share your feelings -->
										
					</div>
				</div>
			</div>
		</div>
					
		<!-- End Of Body -->
		
		<!-- Center Body -->
		<div id="fh5co-main">
			<div class="container">
				<div class="row" >
					<table id="customers">
						<tr>
							<th><center>My Posts</center></th>
						</tr>
					</table>
					<div id="fh5co-board"  data-columns>
						<!-- here the item will be apended -->
					</div>
				</div>
			</div>
		</div>
						   
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

				url:"my_profilefetch.php",
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
			
<script  async src="/js/jquery.caret.js" type="text/javascript"></script>
<script  async src="/js/jquery.atwho.js" type="text/javascript"></script>


	</body>
</html>