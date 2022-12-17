<?php
session_start();
include("connect.php");
if(isset($_POST['limit'], $_POST['start'], $_POST['user_id']))
{
	$query = mysqli_query($mysqli,"SELECT * FROM posts where user_id=".$_POST["user_id"]." ORDER BY post_id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."");
	while($row_post = mysqli_fetch_array($query))
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
		$post_type = $row_post['post_type'];
													
		$loggedin_user_email = $_SESSION['user_email'];
		$loggedin_query = mysqli_query($mysqli,"SELECT * FROM users where user_email = '$loggedin_user_email'");
		$loggedin_row = mysqli_fetch_array($loggedin_query);
								
		$loggedin_user_id = $loggedin_row['user_id'];
		
		$count_posts_like_unlike = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id'");
		$total_like_this_post = mysqli_num_rows($count_posts_like_unlike);
		
		$logged_in_user_like_post	=	 mysqli_query($mysqli,"select * from like_posts where post_id='$post_id' AND user_id='$loggedin_user_id'");
		$total_like_this_post_by_logged_in_user = mysqli_num_rows($logged_in_user_like_post);?>
							
		<div class="item fetched">
			
			<div class="animate-box">
				<?php
				if($post_image=="")
				{
				}
				else
				{?>
					<?php echo "<a href='https://findbestjodi.com/post_images/$post_image' class='image-popup fh5co-board-img' title='$user_name'><img src='post_images/$post_image' ></a>"; ?>
				<?php } ?>
			</div>
			
			<div class="animate-box">
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
			</div>
			
			<div class="fh5co-desc">
				<a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><img src="user_images/<?php echo "$user_image"; ?>" width="50" height="50">&nbsp&nbsp<?php echo "<b style='color:#2c82f8;font-size:120%'>$user_name</b> <p style='float:right;color:#4dc82c'><b>$post_type</b></p>"; ?> </a>
				<p>
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
							echo $post_content;
						}?>
					</h5>
				</p>
				
				<!-- Like Comment share -->
				<?php include("like_comment_share.php"); ?>	
				<!-- End Of Like Comment share -->
				
			</div>
		</div>
	<?php } ?>
<?php } ?>