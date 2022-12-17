<?php 
session_start();
include("includes/check.php"); 
include("connect.php");

if(isset($_GET['posts']))
{
	$post_id = base64_decode($_GET['posts']);
	$encoded_post_id = base64_encode($post_id);
	$noti_id = base64_decode($_GET['noti_id']);
	$check = mysqli_query($mysqli,"UPDATE notifications SET status='seen' where noti_id='$noti_id'");
	
	$query = mysqli_query($mysqli,"select * from posts where post_id='$post_id'");
	$row_post = mysqli_fetch_array($query);
	$user_id = $row_post['user_id'];
	$encoded_user_id = base64_encode($user_id);
	
	$user = mysqli_query($mysqli,"select * from users where user_id = '$user_id'");
	$row_user = mysqli_fetch_array($user);
	
	$user_name = $row_user['user_name'];
	$user_image = $row_user['user_image'];
											
	$post_image = $row_post['post_image'];
	$post_contents = htmlspecialchars_decode($row_post['post_content']);
	$post_content=str_replace('\r\n','',$post_contents);
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
<title>Find Best Jodi | Post By | <?php echo "$user_name"; ?></title>
<link rel="icon" type="image/png" href="https://findbestjodi.com/css/logo.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title itemprop="name">Find Best Jodi | Post | <?php echo "$user_name"; ?></title>
<meta property="og:image" content="https://findbestjodi.com/post_images/<?php echo "$post_image"; ?>">
<meta itemprop="image" content="https://findbestjodi.com/post_images/<?php echo "$post_image"; ?>">
<meta name="description" content="<?php echo "$post_content"; ?>" />
<meta name="keywords" content="<?php echo "$post_content"; ?>" />
<!-- Links -->
<?php include("includes/links.php"); ?>
<!-- End Of Links -->
<script src="//cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
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
						
						<p>
							<table id="customers">
								<tr>
									<th colspan="2"><center>View Your Post</center></th>
								</tr>
							</table>
						</p>	
						<div class="fh5co-spacer fh5co-spacer-sm"></div>
						
						<?php
						if(isset($_GET['posts']))
						{
							$post_id = $row_post['post_id'];
							$encoded_post_id = base64_encode($post_id);
							$user_id = $row_post['user_id'];
							$encoded_user_id = base64_encode($user_id);
							$email = mysqli_query($mysqli,"SELECT * FROM users where user_id = '$user_id'");
							$user_row = mysqli_fetch_array($email);
							$user_name = $user_row['user_name'];
							$user_image = $user_row['user_image'];
							$post_image = $row_post['post_image'];
							$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
							$post_contents = htmlspecialchars_decode(nl2br($row_post['post_content']));
							$post_content=str_replace('\r\n','',$post_contents);
							$post_youtube = $row_post['post_youtube'];
																		
							$loggedin_user_email = $_SESSION['user_email'];
							$loggedin_query = mysqli_query($mysqli,"SELECT * FROM users where user_email = '$loggedin_user_email'");
							$loggedin_row = mysqli_fetch_array($loggedin_query);
													
							$loggedin_user_id = $loggedin_row['user_id'];
							
							$count_posts_like_unlike = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id'");
							$total_like_this_post = mysqli_num_rows($count_posts_like_unlike);
							
							$logged_in_user_like_post	=	 mysqli_query($mysqli,"select * from like_posts where post_id='$post_id' AND user_id='$loggedin_user_id'");
							$total_like_this_post_by_logged_in_user = mysqli_num_rows($logged_in_user_like_post);?>		
							
							<img src="<?php echo "https://www.findbestjodi.com/user_images/$user_image"; ?>" width="50" height="50" > 
							<b style="color:#2c82f8;" ><?php echo "$user_name"; ?></b><br><br>
							
							<div class="fh5co-spacer fh5co-spacer-sm"></div>
								<p>
									<?php 
									if($post_image=="")
									{
									}
									else
									{
										echo "<img src='https://www.findbestjodi.com/post_images/$post_image' alt='$user_name' class='img-rounded img-responsive'>";
									}
									?>
								</p>
							
								<p>
									<?php
									if($post_content=="")
									{
									}
									else
									{?>
										<h5 style="color:black;font-size:110%;">
										<?php
										if(preg_match($reg_exUrl, $post_content, $url)) 
										{
											// make the urls hyper links
											echo preg_replace($reg_exUrl, "<a style='color:blue;' href='{$url[0]}'>{$url[0]}</a>", $post_content);
										} 
										else 
										{
											// if no urls in the text just return the text
											echo "<h5 style='color:white;'>$post_content</h5>";
										}?>
										</h5>
									<?php } ?>
								</p>
								
								<?php
								if($post_youtube=="")
								{
								}
								else
								{
									echo "<div style='position:relative; width:100%; height:0px; padding-bottom:56.25%;'>
											<iframe style='position:absolute; left:0; top:0; width:100%; height:100%'
												src='//www.youtube.com/embed/$post_youtube' allowfullscreen=''>
											</iframe>
										</div>"; 
								}?>
								
								<br>
								<p>
									<?php include("like_comment_share.php"); ?> 
								</p>	
								
								<table id="customers">
									<tr>
										<th colspan="2"><center>View Comments</th>
									</tr>
								</table>
							
								<?php
								include("connect.php");
								$user = $_SESSION['user_email'];
								$get_user = mysqli_query($mysqli,"select * from users where user_email='$user'");
								$row = mysqli_fetch_array($get_user);
								$loggedin_user_id = $row['user_id'];

								$get_posts = mysqli_query($mysqli,"select * from post_comments where post_id='$post_id' Order by 1 DESC");
								while ($row_posts = mysqli_fetch_array($get_posts))
								{
									$id = $row_posts['id'];
									$user_id = $row_posts['user_id'];
									$comment = nl2br($row_posts['comment']);
									$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
												
									$user = mysqli_query($mysqli,"select * from users where user_id='$user_id'");
									$row_user = mysqli_fetch_array($user);
															
									$user_name = $row_user['user_name'];
									$user_image = $row_user['user_image'];?>
												
									<?php
									$encoded_post_id 	=	base64_encode($post_id);
									$encoded_user_id 	=	base64_encode($user_id);						
									?>							
							
									<table id="customers">
										<tr>
											<td width="10%;">
												<a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>"><img src="<?php echo "user_images/$user_image"; ?>" width="50" height="50"></a>
											</td>
											<td width="90%;">
												<b><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>"> <?php echo $user_name; ?> </a></b>		
												<?php
												if($loggedin_user_id==$user_id)
												{?>
													<div class="pull-right action-btn">
														<b><a href="javascript:void(0)" onclick="delete_comments_posts(<?php echo $id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp
													</div>
											
												<?php } ?>
												<h5 style="color:white;">
													<?php
													if(preg_match($reg_exUrl, $comment, $url)) 
													{
														// make the urls hyper links
														echo preg_replace($reg_exUrl, "<a style='color:white;' href='{$url[0]}'>{$url[0]}</a>", $comment);
													} 
													else 
													{
														// if no urls in the text just return the text
														echo $comment;
													}?>
												</h5>
											</td>
										</tr>
									</table>
								<?php } ?>
							
								<table id="customers">
									<tr>
										<th colspan="2"><center>View Who Liked This Post</th>
									</tr>
								</table>
								
								<?php
								include("connect.php");
								$user = $_SESSION['user_email'];
								$get_user = mysqli_query($mysqli,"select * from users where user_email='$user'");
								$row = mysqli_fetch_array($get_user);
								$loggedin_user_id = $row['user_id'];

								$get_posts = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id' Order by 1 DESC");
								while ($row_posts = mysqli_fetch_array($get_posts))
								{
									$id = $row_posts['id'];
									$user_id = $row_posts['user_id'];
												
									$user = mysqli_query($mysqli,"select * from users where user_id='$user_id'");
									$row_user = mysqli_fetch_array($user);
															
									$user_name = $row_user['user_name'];
									$user_image = $row_user['user_image'];?>
												
									<?php
									$encoded_post_id 	=	base64_encode($post_id);
									$encoded_user_id 	=	base64_encode($user_id);						
									?>							
							
									<table id="customers">
										<tr>
											<td width="10%;">
												<a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>"><img src="<?php echo "user_images/$user_image"; ?>" width="50" height="50"></a>
											</td>
											<td width="90%;">
												<b><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>"> <?php echo $user_name; ?> </a></b>		
											</td>
										</tr>
									</table>
							<?php } ?>
							
						<?php } ?>
						
						</div>
					</div>
				</div>
			</div>
			<!-- End Of Single Post -->
					
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