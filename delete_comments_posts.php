<?php 
include("includes/check.php"); 
?>
<?php
include('connect.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	
	$delete_post = mysqli_query($mysqli,"delete from post_comments where id='$id'");
	if($delete_post)
	{
		echo "<script>alert('Your Comment Has Been Deleted Successfully!')</script>";
        exit();
	}
}
else
{
	echo "<script>window.open('https://findbestjodi.com/index.php','_self')</script>";
	exit();
}        
?>	