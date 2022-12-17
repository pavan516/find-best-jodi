<?php 
session_start();
include("includes/check.php"); 
?>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #2c82f8;
    color: white;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 5px solid #ddd;
    padding: 5px;
	}


</style>
<?php
include("connect.php");
$user = $_SESSION['user_email'];
$get_user = mysqli_query($mysqli,"select * from users where user_email='$user'");
$row = mysqli_fetch_array($get_user);
$loggedin_user_id = $row['user_id'];

$post_id = $_POST['post_id'];
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
		
		<table class="table_data">
			<tbody>
				<tr>
					<td width="20%;">
						<a href="user_profile.php?user=<?php echo $encoded_user_id; ?>"><img src="<?php echo "user_images/100x100/$user_image"; ?>" width="50" height="50"></a>
					</td>
					<td width="80%;">
						<b><a href="user_profile.php?user=<?php echo $encoded_user_id; ?>"> <?php echo $user_name; ?> </a></b>		
						<?php
						if($loggedin_user_id==$user_id)
						{?>
							<div class="pull-right action-btn">
								<b><a href="javascript:void(0)" onclick="delete_comments_posts(<?php echo $id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp
							</div>
							<!-- Delete the Comment Stories -->
							<script type="text/javascript">
							function delete_comments_posts(id)
							{
								$.ajax({
									url: "delete_comments_posts.php",
									method: "POST",
									async: false,
									data: {id : id},
									success: function(data)
									{
										$('.delete_comments_posts'+id).html(data);
										function comments_posts_display(post_id)
										{
											$.ajax({
												url: "comments_posts_display.php",
												method: "POST",
												async: false,
												data: {post_id : post_id},
												success: function(data)
												{
													$('.comments_posts_display'+post_id).html(data);	
													fun=1;
												}
											});
										}
										comments_posts_display(<?php echo $post_id; ?>);
									}
								});
							}
							</script>
							<div class="delete_comments_posts<?php echo $id; ?>"></div>
							<!-- End Of Delete The Comment Stories -->
						<?php } ?>
						<h5>
							<?php
							if(preg_match($reg_exUrl, $comment, $url)) 
							{
								// make the urls hyper links
								echo preg_replace($reg_exUrl, "<a style='color:blue;' href='{$url[0]}'>{$url[0]}</a>", $comment);
							} 
							else 
							{
								// if no urls in the text just return the text
								echo $comment;
							}?>
						</h5>
					</td>
				</tr>
			</tbody>
		</table>
<?php } ?>