<style type="text/css">
	.badge1 {
		position:relative;
	}
	.badge1[data-badge]:after {
		content:attr(data-badge);
		position:absolute;
		top:0px;
		right:-28px;
		font-size:.7em;
		background:#2c82f8;
		color:white;
		width:25px;
		height:25px;
		text-align:center;
		line-height:25px;
		border-radius:50%;
		box-shadow:0 0 1px #fff;
	}
</style>

<!-- pending requests -->
<?php
if(isset($_SESSION['user_email']))
{
	$user_email = $_SESSION['user_email'];
	$user = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
	$user_row = mysqli_fetch_array($user);
	$user_id = $user_row['user_id'];
	$pendingrequests = mysqli_query($mysqli,"select * from follower where status='pending' and follow_id='$user_id'");
	$countpendingreq = mysqli_num_rows($pendingrequests);
}
?>
<!-- End Of Pending Requests -->

<!-- Online users -->
<?php 
$online = mysqli_query($mysqli,"select * from users where online='1'");
$onlinecount = mysqli_num_rows($online);
?>
<!-- End Of Online Users -->



<!-- Notifications -->
<?php 
if(isset($_SESSION['user_email']))
{
	$user_email = $_SESSION['user_email'];
	$user = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
	$user_row = mysqli_fetch_array($user);
	$user_id = $user_row['user_id'];
	
	$noti = mysqli_query($mysqli,"select * from notifications where post_user_id='$user_id' and status='unseen'");
	$noticount = mysqli_num_rows($noti);
}
?>
<!-- End Of Notifications -->

<!-- Right SideBar -->
<div id="fh5co-offcanvass" class="nav-sleep">
	<a href="#" class="fh5co-offcanvass-close nav-close">Menu <i class="fa fa-window-close"></i> </a>
	<h1 class="fh5co-logo"><a class="navbar-brand" href="index.php">Find Best Jodi</a></h1>
	<ul>
	<?php 
	include("connect.php");
	if(isset($_SESSION['user_email']))
	{
		echo "<li><a href='https://findbestjodi.com/index.php'><i style='color:#2c82f8;' class='fa fa-home'></i> Home</a></li>";
		echo "<li><a href='https://findbestjodi.com/timeline.php'><i style='color:#2c82f8;' class='fa fa-newspaper-o'></i> Timeline</a></li>";
		echo "<li><a href='https://findbestjodi.com/favtimeline.php'><i style='color:#2c82f8;' class='fa fa-heart'></i> Favourite Timeline</a></li>";
		echo "<li><a href='https://findbestjodi.com/findjodi.php'><i style='color:#2c82f8;' class='fa fa-search'></i> Find Jodi</a></li>";
		echo "<li><a href='https://findbestjodi.com/my_profile.php'><i style='color:#2c82f8;' class='fa fa-user-circle'></i> My Profile &nbsp"; if($countpendingreq=='0'){ } else{ echo "<b><span class='badge'> $countpendingreq</span></b>"; } echo "</a></li>";
		echo "<li><a href='chat/public/'><i style='color:#2c82f8;' class='fa fa-comments'></i> My Messages <span style='display:none;' id='messageCounted' class='badge'>0</span></a></li>";
		echo "<li><a href='#' data-toggle='modal' data-target='#noti' ><i style='color:#2c82f8;' class='fa fa-bell'></i> Notifications &nbsp"; if($noticount=='0'){ } else{ echo "<b><span class='badge' id='noticount' > $noticount</span></b>"; } echo "</a></li>";
		echo "<li><a href='https://findbestjodi.com/following.php'><i style='color:#2c82f8;' class='fa fa-user'></i> Following By Me</a></li>";
		echo "<li><a href='https://findbestjodi.com/followers.php'><i style='color:#2c82f8;' class='fa fa-users'></i> My Followers</a></li>";
		echo "<li><a href='https://findbestjodi.com/online.php'><i style='color:#2c82f8;' class='fa fa-meh-o'></i> Online Jodi's <span  class='badge'>"; if($onlinecount=='0'){ } else{ echo "$onlinecount"; }  echo"</span> </a></li>";
		echo "<li><a href='https://findbestjodi.com/share_support.php'><i style='color:#2c82f8;' class='fa fa-share-alt'></i> Share And Support</a></li>";
		echo "<li><a href='https://findbestjodi.com/logout.php'><i style='color:#2c82f8;' class='fa fa-sign-out'></i> Logout</a></li>";
		echo "<li><a href='https://findbestjodi.com/delmyacc.php'><i style='color:#2c82f8;' class='fa fa-times'></i> Delete My Account</a></li>";
	}
	else
	{
		echo "<li><a href='https://findbestjodi.com/login.php'><i style='color:#2c82f8;' class='fa fa-sign-in'></i> Sign In</a></li>";
		echo "<li><a href='https://findbestjodi.com/register.php'><i style='color:#2c82f8;' class='fa fa-user'></i> Create Account</a></li>";
		echo "<li><a href='https://findbestjodi.com/forgotten.php'><i style='color:#2c82f8;' class='fa fa-key'></i> Forgotten Password</a></li>";
		echo "<li><a href='https://findbestjodi.com/aboutus.php'><i style='color:#2c82f8;' class='fa fa-info-circle'></i> About Us</a></li>";
		echo "<li><a href='https://findbestjodi.com/contactus.php'><i style='color:#2c82f8;' class='fa fa-phone'></i> Contact Us</a></li>";
		echo "<li><a href='https://findbestjodi.com/feedback.php'><i style='color:#2c82f8;' class='fa fa-comments-o'></i> FeedBack</a></li>";
		echo "<li><a href='https://findbestjodi.com/terms&cond.php'><i style='color:#2c82f8;' class='fa fa-info'></i> Terms And Conditions</a></li>";
		echo "<li><a href='https://findbestjodi.com/privacypolicy.php'><i style='color:#2c82f8;' class='fa fa-user-secret'></i> Privacy Policy</a></li>";
		echo "<li><a href='https://findbestjodi.com/share_support.php'><i style='color:#2c82f8;' class='fa fa-share-alt'></i> Share And Support</a></li>";
	}
	?>
	</ul>
</div>
<!-- End Of SideBar -->
		

<!-- Header -->
<header id="fh5co-header" role="banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="#" id="bar_click" class="fh5co-menu-btn nav-menu-btn">Menu <i class="fa fa-bars"></i></a> 
				<h1><a class="navbar-brand" href="index.php">Find Best Jodi</a></h1>		
			</div>
		</div>
	</div>
	<?php
	if(isset($_SESSION['user_email']))
	{?>
	<style>
		.scrollmenu a {
			padding-left: 5px!important;
    		padding-right: 5px!important;
		}
		.scrollmenu a i {
			padding: 5px;

		}
		.grey {
			background-color: #777;
		}
		.scrollmenu a i {
			margin: 0px;
		    padding: 5px!important;
		}
	</style>
	<div class="bar">
		<div class="scrollmenu" style="display: flex;
  justify-content: space-between;">
			<a <?php if (stripos($_SERVER['REQUEST_URI'], 'index.php' )): ?> class="grey" <?php endif ?> href='https://findbestjodi.com/index.php'><i class='fa fa-home'></i> <span class="on-web">Home </span></a>
			<a<?php if (stripos($_SERVER['REQUEST_URI'], '/timeline.php' ) !== false): ?> class="grey" <?php endif ?> href='https://findbestjodi.com/timeline.php'><i class='fa fa-newspaper-o'></i> <span class="on-web">Timeline</span></a>
			<!-- <a<?php if (stripos($_SERVER['REQUEST_URI'], '/favtimeline.php' ) !== false): ?> class="grey" <?php endif ?> href='https://findbestjodi.com/favtimeline.php'><i class='fa fa-heart'></i> <span class="on-web">Favourite Timeline</span></a> -->
		 	<a <?php if (stripos($_SERVER['REQUEST_URI'], 'findjodi.php' )): ?>class="grey"<?php endif ?> href='https://findbestjodi.com/findjodi.php'><i class='fa fa-search'></i> <span class="on-web">Find Jodi</span></a>
			<a <?php if (stripos($_SERVER['REQUEST_URI'], 'my_profile.php' )): ?>class="grey"<?php endif ?> style="display: inline-block;;" href='https://findbestjodi.com/my_profile.php'><i class='fa fa-user-circle'></i> <span class="on-web">My Profile</span> <?php if($countpendingreq=='0'){ } else{ echo "<span class='badge'>$countpendingreq"; } ?></span></a>
			<?php echo "<a style='display: inline-block;' href='chat/public/'><i class='fa fa-comments'></i> <span class='on-web'>My Messages <span style='display:none;' id='messageCount' class='badge'>0</span></a>"; ?>
			<a  style="display: inline-block;;"  href='#' data-toggle='modal' data-target='#noti' ><i class='fa fa-bell'></i><span  class='badge' id="noticounted"><?php if($noticount=='0'){ } else{ echo "$noticount"; } ?></span><span class="on-web">Notifications</span> </a>
			<a <?php if (stripos($_SERVER['REQUEST_URI'], 'online.php' )): ?>class="grey"<?php endif ?> style="display: inline-block;;"  href='https://findbestjodi.com/online.php'><i class='fa fa-meh-o'></i> <span  class='badge'><?php if($onlinecount=='0'){ } else{ echo "$onlinecount"; } ?></span><span class="on-web">Online Jodi's</span> </a>
		  	<a href="#about" class="nav-menu-btn"  ><i class="fa fa-bars"></i></a> 
		</div>
	</div>
	<?php } ?>
</header>
<!-- End Of Header -->
<script>
	$(".nav-menu-btn").click(function(){
		console.log("Nav Triggered");
	 	$("#fh5co-offcanvass").toggleClass( 'nav-awake');



	});
		$(".nav-close").click(function(){
		console.log("Nav Triggered");
	 	$("#fh5co-offcanvass").removeClass( 'nav-awake');



	});

</script>
<!-- Nav bar -->

<style>
#fh5co-offcanvass {
	overflow-y: scroll;;
}
div.bar {
	display: none;
    position: fixed;
    top: 0px;
    z-index: 100;	width: 100%;

}
	div.scrollmenu {
    background-color: black;
    overflow: auto;
    text-align: right;
    /*white-space: nowrap;*/

    z-index: 100;
}

div.scrollmenu a {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 10px;
    text-decoration: none;

}
.show {
	display: block;
	-webkit-transition: height 2s; /* Safari */
    transition: height 2s;
    transition-timing-function: linear;
}
div.scrollmenu a:hover {
    background-color: #777;
}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
        height: 0px;
    background: transparent;  /* optional: just make scrollbar invisible */
}
</style>
<script>
	$(function() {
	    $(window).scroll(function() {  
	        var topHeight = $('#fh5co-header').height(); 
	            var scroll = $(window).scrollTop();  

	            if (scroll >= topHeight) {
	                $(".bar").slideDown();
	            }
	            if (scroll < topHeight) {
	                $(".bar").slideUp();
	                // $(".bar").removeClass("show");
	            }

	    });
	});
</script>