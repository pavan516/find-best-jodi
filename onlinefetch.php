<?php
session_start();
include('connect.php');
if(isset($_POST['limit'], $_POST['start']))
{
	$query = mysqli_query($mysqli,"SELECT * FROM users where online='1' ORDER BY user_id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."");
	while($row_user = mysqli_fetch_array($query))
	{
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
		$user_feeling=str_replace('\r\n','',$user_feelings);
		$user_image = $row_user['user_image'];
		$online = $row_user['online'];
		$presentdate = date('Y');
		$time=strtotime($user_dob);
		$year=date('Y',$time);
		$age = $presentdate-$year;?>

		<div class="item fetched">
			<div class="animate-box">
				<?php
				if($user_image=="")
				{
				}
				else
				{?>
					<a href="<?php echo "https://findbestjodi.com/user_images/$user_image"; ?>" class="image-popup fh5co-board-img" title="<?php echo "$user_feeling"; ?>"><img src="user_images/<?php echo "$user_image"; ?>" alt="<?php echo "$user_name Image Is Missing Find Later"; ?>"></a>
				<?php } ?>
			</div>
		
			<div class="fh5co-desc">
				<?php echo "<a href='https://findbestjodi.com/user_profile.php?user=$encoded_user_id' style='color:#2c82f8;font-size:120%'><b>$user_name</b><p style='float:right;color:#4dc82c'>";if($online=='1'){ echo '<b>online</b>'; } else { echo 'offline'; }echo "</p></a>"; ?><br>
				<label>Gender :</label> <?php echo "$user_gender"; ?><br>
				<label>Age :</label> <?php echo "$age Years"; ?><br>
				<label>RelationShip Status :</label> <?php echo "$user_status"; ?><br>
				<label>Searching For A :</label> <?php echo "$user_searchingfor"; ?><br>
				<label>Religion :</label> <?php echo "$user_religion"; ?><br>
				
				<?php include("follow.php"); ?>
				
				<center><a class="btn btn-default" href="user_profile.php?user=<?php echo $encoded_user_id; ?>" >View Profile</a>
				
				<?php
				if($check == 1)
				{
					echo "<a class='btn btn-default' href='/chat/public/?user_name=$user_name' >Chat With Me</a></center>";
				}
				else
				{
					echo "<a class='btn btn-default' href='javascript:void(0)' onclick='alertmsg12()' >Chat With Me</a></center>";
				}
				?>
				<script type="text/javascript">
				function alertmsg12() { alert("Follow Me To Chat With Me!"); } 
				</script>
			</div>
		</div>
	<?php } ?>
<?php } ?>