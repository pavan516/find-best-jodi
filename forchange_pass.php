<?php 
include("connect.php");
if(isset($_GET['email']))
{
$email = base64_decode($_GET['email']);
$encoded_email = base64_encode($email);
$pass = base64_decode($_GET['pass']);
$encoded_pass = base64_encode($pass);
	
$query = mysqli_query($mysqli,"select * from users where user_email='$email' and user_pass='$pass'");
$count = mysqli_num_rows($query);
if($count==1)
{?>
	
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
<title>Find Best Jodi | Change Password</title>
<link rel="icon" type="image/png" href="https://www.findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | Change Password</title>
<meta property="og:image" content="https://www.findbestjodi.com/css/logo.png">
<meta itemprop="image" content="https://www.findbestjodi.com/css/logo.png">
<meta name="description" content="find best jodi , find best friend, best jodi, best jodi find, find best lover, find friend, find jodi, jodi,login, sign in,ourmedia, our, our media, ourmedia.in, social media, media, facebook, freelancer, amazon, twitter, instagram, flipkart, hike, indianceo, google, promotion, news, events, startups, technology, mobiles, movies, sports, love stories, entertainments, motivational stories, inspirational stories, college events, College Summits, DJ Events/Nights, Promotional events, Fund raising events, startups, ngo's,Online Shopping in India,online Shopping store,Online Shopping Site,Buy Online,Shop Online,Online Shopping,Flipkart,Store,  Store Online Shopping Wallet Store, Wallet Store Online Shopping,Rewards Store, Rewards Store Online Shopping,Wishlist Store, Wishlist Store Online Shopping,Reviews Store, Reviews Store Online Shopping,subscriptions Store, Subscriptions Store Online Shopping,Amazon.in, Amazon, Online Shopping, online shopping india, india shopping online, amazon india, amazn, buy online, buy mobiles online, buy books online, buy movie dvd's online, kindle, kindle fire hd, kindle e-readers, ebooks, computers, laptop, toys, trimmers, watches, fashion jewellery, home, kitchen, small appliances, beauty, Sports, Fitness & Outdoors,Telugu Matrimonial, Telugu Matrimonials, Telugu Matrimony,online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, match.com, free personals, christian singles, black singles, asian singles, jewish singles, local singles,matrimonial, matrimony, matrimonials, indian matrimonials, marriage, marriage sites, matchmaking, shaadi, shaadi.com, shadi,  online dating, singles, dating, personals, matchmaker, matchmaking, love, match, dating site, match.com, free personals, christian singles, black singles, asian singles, jewish singles, local singles,Matrimonial, Matrimony, Indian Matrimonial - India Matrimonials,sahi jodi, Free Indian Matrimony, Indian shadi, vivah, totally free Indian matrimonial site, marriage partner,Indian life partner,marriage compatibility,Indian dating,matchmaking services, matchmaker services, best matchmaking services, personal matchmaking services, online matchmaking services, indian matrimonial, indian matrimony, indian matrimonial service, best matchmaking services,muslim matrimonials, muslim marriage, muslim women, muslim men, muslim dating, muslim ladies, muslim personals, muslim dating site, muslim matrimonials site, muslim marriage site,Arya Vysya Matrimony, Telugu Matrimony Arya Vysya, Arya Vysya Marriages, Arya Vysyas,Marriages,marriage,matrimonial, matrimonials, marriage, marriages, Indian matrimonials, marriage fixation, match fixing, shaadi, nikkha, nikha, pelli, Indian groom, indian grooms, indian bride, indian brides, bride, brides, groom, grooms, bride groom, bridegrooms, online matrimonials, matrimonial services, dating, vivaham, vanajarao, vanajarao.com, www.vanajarao.com, quick marriages, quickmarriages, Indian festival, Indian tradition, Femme, Women, beauty, horoscope, Indianwomen, Hyderabadwomen, Hindu religon, Muslim religon, Vanaja Rao Quick Marriages, Vanaja Rao, Quick Marriages, quickmarriages.com, Quick Marriage, Marriage Consultancy, Marriage Consultants, marriage, marriages, soul mate, LIFE PARTNER, life partner, marriage partner, Bride, bride, brides, Bridegroom, BrideGroom, EENADU, Eenadu, VAARTHA, Vaartha, ANDHRAJYOTHI, ANDHRA JYOTHI, Andhra Jyothi, The Hindu, THE HINDU, HINDU, Hindu, TIMES OF INDIA, Times of India, DECAN CHRONICLE. DECCAN CHRONICLE. Deccan Chronicle, Chronicle, Decan, Deccan, MUNSIF, Munsif, Bride, Matrimonies, Indian Matrimonies, NRI, Non Resident Indians, Indian origin, Indian descent, Indians, Matrimony Site, Matrimony,Telugu,Tamil,Bharath,bharat,barat,Kannada,Shaadi.com,telugumatrimony.com,secondshaadi.com,matrimony,bharatmatrimony,Indian matrimony, India, matrimonial, site, sites, login, search, brides, grooms, marriage, Telugu, Matrimonial, Matrimony, Matrimonials, Marriage, Brides, Grooms, Sites, Search, Login, Profiles,Telugu Matrimonial Login, Telugu Matrimony  Login,Free Matrimonial Sites, Free Marriage, Free Matrimonial, Free Sathi, Vivaah, Indian Matrimonials, Indian Marriage Site, Indian Matrimony, Indian Wedding Sites,matrimonial, Life partner, matrimonials, matrimony, Life partners, LifePartner.in, LPI, Indian matrimonial, marriage, Hindu Matrimonial, Muslim matrimonials, Indian matrimonial Site, indian bride, Lifepartner, Lifepartners, Indian groom, Indian matrimonial,matrimonial, matrimonials, matrimonial service, matrimony, matrimonial site, matchmaking, matchmaking services, indian matchmaker, NRI matrimonial, singles matchmaking, online matchmaking, indian matchmaking services, indian brides, indian grooms, hindu,Free Matrimonial Sites, Free Marriage, Free Matrimonial, Free Sathi, Vivaah, Indian Matrimonials, Indian Marriage Site, Indian Matrimony, Indian Wedding Sites,matrimonial, Life partner, matrimonials, matrimony, Life partners, LifePartner.in, LPI, Indian matrimonial, marriage, Hindu Matrimonial, Muslim matrimonials, Indian matrimonial Site, indian bride, Lifepartner, Lifepartners, Indian groom, Indian matrimonials,matrimony, marriage sites, indian matrimony, matrimonial, matrimonial sites, matrimonial india, matrimonial services, indian bride, indian marriage, indian groom,Matrimony, Matrimonial, Marriage, Wedding, Matrimonial Site, Free Matrimonial Sites, Free Marriage, Free Matrimonial, Indian Matrimonials, Indian Marriage Site, Indian Matrimony, Indian Wedding Sites, Vivah, Vivaah, vivaah.com, vivaha,Online Matchmaking, Online Matrimony, Marriage, Matrimonial Site, Shadi com, Jeevan sathi, Indian Brides, indian Grooms,free matrimony, free matrimony India, free shaadi, online matrimonial, matrimony, matrimonial, matrimonial websites, free matrimonial websites, oriya matrimony, indian matrimonial sites, hindu matrimonial, muslim matrimony, free matrimonials, free matrimonial sites, christian matrimony, manglik matrimony, free matrimonial sites in india, free matrimonial, indian matrimonial, matrimonial sites,matrimony, matrimony search,free matrimony, free matrimony India, free shaadi, online matrimonial, matrimony, matrimonial, matrimonial websites, free matrimonial websites, oriya matrimony, indian matrimonial sites, hindu matrimonial, muslim matrimony, free matrimonials, free matrimonial sites, christian matrimony, manglik matrimony, free matrimonial sites in india, free matrimonial, indian matrimonial, matrimonial sites" /> 
<meta name="keywords" content="change password for forgotten password in find best jodi" />

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
					
						<!-- Change Password -->
						<table id="customers">
							<tr>
								<th><center>Change Your Password</center></th>
							</tr>
						</table>
										
						<form method="post" action="" enctype="multipart/form-data">
								
							<div class="row">
								
								<div class="col-md-12">
									<label>New Password</label>
									<div class="form-group">
										<input type="password" name="user_newpass" id="user_newpass" required="required" class="form-control" placeholder="New Password"/>	
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Repeat New Password</label>
									<div class="form-group">
										<input type="password" name="user_new_reppass" id="user_new_reppass" required="required" class="form-control" placeholder="Repeat New Password"/>	
									</div>
								</div>
												
								<div class="form-group">
									<center><input type="submit" name="changepass" id="changepass" class="btn btn-default" value="Change Password"></center>
								</div>
												
							</div>
											
						</form>		
																
						<?php
						if(isset($_POST['changepass']))
						{
							include('connect.php');
							if(isset($_GET['email']))
							{
								$email = base64_decode($_GET['email']);
								$encoded_email = base64_encode($email);

								$user_newpass = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_newpass']), ENT_QUOTES, 'UTF-8');
								$user_new_reppass = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_new_reppass']), ENT_QUOTES, 'UTF-8');
								$encode_newpass = (crypt(sha1(md5($user_newpass)),$encoded_email));    	
					
								if($user_newpass==$user_new_reppass)
								{
									$update = mysqli_query($mysqli,"update users set user_pass='$encode_newpass' where user_email='$email'");
									if($update)
									{
										echo "<script>alert('Password Successfully Changed!')</script>";
										echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
										exit();
									}
								}
								else
								{
									echo "<script>alert('The Passwords Do Not Match!')</script>";
									echo "<script>window.open('https://findbestjodi.com/forchange_pass.php?email=$encoded_email&pass=$encoded_pass','_self')</script>";
									exit();
								}
							}
						}
						?> 										
						<!-- End Of Change Password -->
						
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

<?php 
}
else
{
	echo "<script>alert('Email Does Not Exist / Wrong Link(Try On Clicking Forgotten Password!)')</script>";
	echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
	exit();
}
}
else
{
	echo "<script>alert('Can't Access Directly!')</script>";
	echo "<script>window.open('https://findbestjodi.com/login.php','_self')</script>";
	exit();
}
?>