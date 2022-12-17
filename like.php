<?php session_start(); ?>
<?php include('connect.php'); ?>
<?php
	$encoded_post_id	=	'';
	if(!empty($_POST)){
		
		$encoded_post_id	=	$_POST['post_id'];
		$post_id			=	base64_decode($encoded_post_id);
		
		$user 				= 	$_SESSION['user_email'];
		
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($mysqli,$get_user);
		$row = mysqli_fetch_array($run_user);
		
		$logged_in_user_id = $row['user_id'];
		
		$get_posts = "select * from posts where post_id='$post_id'";
						
		$run_posts = mysqli_query($mysqli,$get_posts);
		$row_posts = mysqli_fetch_array($run_posts);
		$post_owner_id		=	$row_posts['user_id'];
		
		$count_posts_like_unlike = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id' AND user_id='$logged_in_user_id'");
		
		$total_like_this_post = mysqli_num_rows($count_posts_like_unlike);
		$return_array			=	array();
		if($total_like_this_post>0){
			
			$sql = "DELETE FROM like_posts where post_id='$post_id' AND user_id='$logged_in_user_id'";
			$now_total_like_query = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id'");
			$total_like_for_this_post = mysqli_num_rows($now_total_like_query);	
			if (mysqli_query($mysqli,$sql) === TRUE) {
				$now_total_like_query = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id'");
				$total_like_for_this_post = mysqli_num_rows($now_total_like_query);
				
				$return_array['error']			=	0;
				$return_array['mesg']			=	'delete';
				$return_array['total_like']		=	$total_like_for_this_post;
				$return_array['post_id']		=	$post_id;
			}else{
				$return_array['error']			=	1;
				$return_array['mesg']			=	'failed';
				$return_array['total_like']		=	$total_like_for_this_post;
				$return_array['post_id']		=	$post_id;
			}
			
			
		}else{
			$insert_like_data = "insert into like_posts (user_id,post_id)
                	                values ('$logged_in_user_id','$post_id')";
									
			$run = mysqli_query($mysqli,$insert_like_data);
	 
			if($run)
			{
				$now_total_like_query = mysqli_query($mysqli,"select * from like_posts where post_id='$post_id'");
				$total_like_for_this_post = mysqli_num_rows($now_total_like_query);
				
				$return_array['error']		=	0;
				$return_array['mesg']		=	'success';
				$return_array['total_like']	=	$total_like_for_this_post;
				$return_array['post_id']	=	$post_id;
			}else{
				$return_array['error']	=	1;
				$return_array['mesg']	=	'failed';
				$return_array['total_like']	=	'';
				$return_array['post_id']	=	'';
			}						
		}
		echo json_encode($return_array,false);
		
	}
?>