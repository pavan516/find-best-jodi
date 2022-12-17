<?php 
include("includes/check.php"); 

if(isset($_POST['updateprof']))
{
	include('connect.php');
						
	$user_name = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_name']), ENT_QUOTES, 'UTF-8');
	$user_contact = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_contact']), ENT_QUOTES, 'UTF-8');
	$user_gender = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_gender']), ENT_QUOTES, 'UTF-8');
	$user_dob = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_dob']), ENT_QUOTES, 'UTF-8');
	$user_status = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_status']), ENT_QUOTES, 'UTF-8');
	$user_searchingfor = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_searchingfor']), ENT_QUOTES, 'UTF-8');
	$user_religion = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_religion']), ENT_QUOTES, 'UTF-8');
	$user_mothertongue = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_mothertongue']), ENT_QUOTES, 'UTF-8');
	$user_casteordivision = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_casteordivision']), ENT_QUOTES, 'UTF-8');
	$user_country = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_country']), ENT_QUOTES, 'UTF-8');
	$user_state = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['user_state']), ENT_QUOTES, 'UTF-8');
	$user_feeling = htmlspecialchars(mysqli_real_escape_string($mysqli,addslashes($_POST['user_feeling'])), ENT_QUOTES, 'UTF-8');
	$life_story = htmlspecialchars(mysqli_real_escape_string($mysqli,$_POST['life_story']), ENT_QUOTES, 'UTF-8');
	
	if(isset($_COOKIE['user_email']))
	{
		$cookie_email = $_COOKIE['user_email'];
		$check = mysqli_query($mysqli,"select * from users");
		while($row = mysqli_fetch_array($check))
		{
			$check_email = $row['user_email'];
			$encoded_check_email = base64_encode($check_email);
			$encrypted_check_email = (crypt(sha1(md5($encoded_check_email)),$encoded_check_email));
					
			if($cookie_email == $encrypted_check_email)
			{
				$query = mysqli_query($mysqli,"select * from users where user_email = '$check_email'");
				$rows = mysqli_fetch_array($query);
					
				$user_email = $rows['user_email'];
			}
		}
	}
												
	$stmt = $mysqli->prepare("UPDATE users SET user_name=? ,user_contact=? ,user_gender=? ,user_dob=? ,user_status=? ,user_searchingfor=? ,user_religion=? ,user_mothertongue=? ,user_casteordivision=? ,user_country=? ,user_state=? ,user_feeling=? ,life_story=? where user_email=?");
	$stmt->bind_param("ssssssssssssss", $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m,$n);
				
	$a = "$user_name";
	$b = "$user_contact";
	$c = "$user_gender";
	$d = "$user_dob";
	$e = "$user_status";
	$f = "$user_searchingfor";
	$g = "$user_religion";
	$h = "$user_mothertongue";
	$i = "$user_casteordivision";
	$j = "$user_country";
	$k = "$user_state";
	$l = "$user_feeling";
	$m = "$life_story";
	$n = "$user_email";
								
	$row = $stmt->execute();
								
	if($row)
	{
		echo "<script>alert('Successfully Updated Your Profile')</script>";
		echo "<script>window.open('https://findbestjodi.com/my_profile.php','_self')</script>";
		exit();
	}
}
else
{
	echo "<script>alert('Can't Access Directly!')</script>";
	echo "<script>window.open('https://findbestjodi.com/my_profile.php','_self')</script>";
	exit();
}
?>
<!-- End Of Php Code For Sign Up -->