<?php
include('connect.php');
if(isset($_POST['post_id']))
{
	$post_id = $_POST['post_id'];
	
	$query = mysqli_query($mysqli,"select * from posts where post_id='$post_id'");
	$row = mysqli_fetch_array($query);
	$image = $row['post_image'];
	$image_path = "post_images/$image";
	
	if($image=="")
	{}
	else
	{
	unlink($image_path);
	}
	
	$delete_comments = mysqli_query($mysqli,"delete from posts_comments where post_id='$post_id'");
	$delete_post = mysqli_query($mysqli,"delete from posts where post_id='$post_id'");
	if($delete_post)
	{
		echo "<script>alert('Your Post Has Been Deleted Successfully!')</script>";
		echo "<script>window.open('https://findbestjodi.com/my_posts.php','_self')</script>";
		exit();
	}
}
?>	