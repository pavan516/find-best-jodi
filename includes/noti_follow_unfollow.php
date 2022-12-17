<?php
session_start();
include("connect.php");
$user = $_SESSION['user_email'];
$get_user = mysqli_query($mysqli,"select * from users where user_email='$user'");
$row = mysqli_fetch_array($get_user);
$user_id = $row['user_id'];
$follow_id = $_POST['follow_id'];

echo "<script>alert('$user_id')</script>";
echo "<script>alert('$follow_id')</script>";
?>