<?php
session_start();

if((!isset($_COOKIE['user_email'])) AND (!isset($_SESSION['user_email'])))
{
	header("location: https://findbestjodi.com/login.php ");
}
else
{
	if(!isset($_SESSION['user_email']))
	{
		include('connect.php');
		$user = $_COOKIE['user_email'];
		$get_user = mysqli_query($mysqli,"select * from users");
		while($row = mysqli_fetch_array($get_user))
		{									
			$user_email = $row['user_email'];
			$encoded_user_email = base64_encode($user_email);
			$encode_user_email = crypt(sha1(md5($encoded_user_email)), $encoded_user_email);
			if($user==$encode_user_email)
			{
				$_SESSION['user_email'] = $user_email;
			}
		}
	}
}

function br2nl( $input ) {
 return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
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
<title>Find Best Jodi | Home</title>
<link rel="icon" type="image/png" href="https://www.findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | Home</title>
<meta property="og:image" content="https://www.findbestjodi.com/css/logo.png">
<meta itemprop="image" content="https://www.findbestjodi.com/css/logo.png">
<meta name="description" content="FIND BEST JODI | Have you Ever thought of finding people with similar interests. We are here to provide you a world of Similar people. Where you can connect with the World you Love. It is a Social networking platform where you can find people from different sources with similar interests in different aspects such as Love ,Life, Education and Careers. Find Best Jodi is a  platform with unique user experience . This helps user  to explore a world of new people . Find Your Jodi - Where People meet their Interests." />
<meta name="keywords" content="Find Best Jodi, findbestjodi, search for a jodi, find jodi, find best partner, find friend, find girl friend, find entreprenuer, find best friend, find best life partner, find best lover, find jodi, best jodi, best jodi for friend, " />

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
				<div class="row" >
					<div id="fh5co-board"  data-columns>
						<!-- here the item will be apended -->
					</div>
				</div>
			</div>
		</div>
						   
<script>
		$(document).ready(function()
		{
			 var limit = 10;
			 var start = 0;
			 var action = 'inactive';
			 function load_country_data(limit, start)
			 {
				$.ajax({
				url:"indexfetch.php",
				method:"POST",
				data:{limit:limit, start:start},
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
				load_country_data(limit, start);
			}
			
			$(window).scroll(function()
			{
				if($(window).scrollTop() + $(window).height() > $("#fh5co-board").height() && action == 'inactive')
				{
					action = 'active';
					start = start + limit;
					setTimeout(function()
					{
						load_country_data(limit, start);
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
		
				
	</body>
</html>