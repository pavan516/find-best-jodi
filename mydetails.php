<?php
session_start();
include("connect.php");

$user_email = $_SESSION['user_email'];
$query = mysqli_query($mysqli,"select * from users where user_email = '$user_email'");
$row_user = mysqli_fetch_array($query);
														
$user_id = $row_user['user_id'];
$encoded_user_id = base64_encode($user_id);
$user_name = $row_user['user_name'];
$user_contact = $row_user['user_contact'];
$user_gender = $row_user['user_gender'];
$user_dob = $row_user['user_dob'];
$user_status = $row_user['user_status'];
$user_searchingfor = $row_user['user_searchingfor'];
$user_religion = $row_user['user_religion'];
$user_mothertongue = $row_user['user_mothertongue'];
$user_casteordivision = $row_user['user_casteordivision'];
$user_country = $row_user['user_country'];
$user_state = $row_user['user_state'];
$user_feelings = htmlspecialchars_decode($row_user['user_feeling']);
$user_feeling = str_replace('\r\n', '', $user_feelings);							
$user_image = $row_user['user_image'];
$user_views = $row_user['user_views'];
$presentdate = date("Y");
$time=strtotime($user_dob);
$year=date("Y",$time);
$age = $presentdate-$year;
$life_storys = htmlspecialchars_decode($row_user['life_story']);
$life_story=str_replace('\r\n','',$life_storys);?>


<p>
	<table id="customers">
		<tr>
			<th colspan="2"><center>Small Info About Myself</center></th>
		</tr>
		<tr>
			<td colspan="2"><h5 style="color:white;font-size:100%;"><?php echo "$user_feeling"; ?></h5></td>
		</tr>
	</table>
</p>
													
<p>
	<table id="customers">
		<tr>
			<th colspan="2"><center>My Details</center></th>
		</tr>
		<tr>
			<?php 
			$str = "https://findbestjodi.com/user_profile.php?user=$encoded_user_id";
			$url = urlencode($str);
			?>
			<td>Share Profile</td>
			<td>
				<a class="on-inline-web" target="_blank" href="https://web.whatsapp.com/send?text=<?php echo $url; ?>" title="WhatsApp Share"><img src="css/wp.png"/></a>
				<a class="on-inline-mobile"  target="_blank" href="whatsapp://send?text=<?php echo $url; ?>" title="WhatsApp Share"><img src="css/wp.png"/></a>
				<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>" title="Facebook Share"><img src="css/fb.png"/></a>
				<a target="_blank" href="https://plus.google.com/share?url=<?php echo $url; ?>" title="Google Plus Share"><img src="css/gp.png"/></a>
				<a target="_blank" href="http://twitter.com/share?text=View <?php echo $user_name; ?> Profile;url=<?php echo $url; ?>" title="Twitter Share"><img src="css/tw.png"/></a>
				<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" title="LinkedIn Share"><img src="css/in.png"/></a>
			</td>
		</tr>
		<tr>
			<td>Copy Profile Link To Share</td>
			<td>
				<!-- Share / Copy Link -->
				<a href="javascript:void(0)" class='copy-text<?php echo $user_id; ?>' style='display:none'>http://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?></a>
				<a class="btn btn-default" href="javascript:void(0)" onclick="copyToClipboard('.copy-text<?php echo $user_id; ?>')" ><i class="fa fa-files-o" ></i> Share Link </a>
				<script>
				function copyToClipboard(element) 
				{
					var $temp = $("<input>");
					$("body").append($temp);
					$temp.val($(element).text()).select();
					document.execCommand("copy");
					$temp.remove();
					alert('Link Copied To Clipboard-Share Anywhere!');
				}
				</script>		
				<!-- End Of Link Copied To Clipboard -->
			</td>
		</tr>
		<tr>
			<td>Gender</td>
			<td><?php echo "$user_gender"; ?></td>
		</tr>
		<tr>
			<td>Date Of Birth</td>
			<td><?php echo "$user_dob"; ?></td>
		</tr>
		<tr>
			<td>Age</td>
			<td><?php echo "$age Years"; ?></td>
		</tr>
		<tr>
			<td>Relationship Status</td>
			<td><?php echo "$user_status"; ?></td>
		</tr>
		<tr>
			<td>Intrested/Searching For</td>
			<td><?php echo "$user_searchingfor"; ?></td>
		</tr>
		<tr>
			<td>Religion</td>
			<td><?php echo "$user_religion"; ?></td>
		</tr>
		<tr>
			<td>MotherTongue</td>
			<td><?php echo "$user_mothertongue"; ?></td>
		</tr>
		<tr>
			<td>Caste / Division</td>
			<td><?php echo "$user_casteordivision"; ?></td>
		</tr>
		<tr>
			<td>Country</td>
			<td><?php echo "$user_country"; ?></td>
		</tr>
		<tr>
			<td>State</td>
			<td><?php echo "$user_state"; ?></td>
		</tr>
	</table>
</p>
													
<p>
	<table id="customers">
		<tr>
			<th><center>My Story</center></th>
		</tr>
		<tr>
			<td><h5 style="color:white;font-size:100%;"><?php echo "$life_story"; ?></h5></td>
		</tr>
	</table>
</p>