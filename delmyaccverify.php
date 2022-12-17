<?php 
session_start();
include('connect.php');
if(isset($_GET['verify']))
{
	$user_email = base64_decode($_GET['verify']);
	$query = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
	$row = mysqli_fetch_array($query);
	
	$user_id = $row['user_id'];
	
	$posts = mysqli_query($mysqli,"DELETE FROM posts WHERE user_id='$user_id'");
	$comments = mysqli_query($mysqli,"DELETE FROM post_comments WHERE user_id='$user_id'");
	$notifications = mysqli_query($mysqli,"DELETE FROM notifications WHERE user_id='$user_id'");
	$like_posts = mysqli_query($mysqli,"DELETE FROM like_posts WHERE user_id='$user_id'");
	$followers = mysqli_query($mysqli,"DELETE FROM follower WHERE user_id='$user_id'");
	$follower = mysqli_query($mysqli,"DELETE FROM follower WHERE follow_id='$user_id'");
	$chat = mysqli_query($mysqli,"DELETE FROM conversation_user WHERE user_id='$user_id'");
	$user = mysqli_query($mysqli,"DELETE FROM users WHERE user_id='$user_id'");
	
	if($user)
	{
		echo "<script>alert('Successfully Deleted Your Account!')</script>";
		echo "<script>window.open('https://findbestjodi.com/register.php','_self')</script>";
		exit();
	}
}
?>