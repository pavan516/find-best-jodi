<!-- <script async src="https://code.jquery.com/jquery-2.1.4.min.js" integrity="sha256-8WqyJLuWKRBVhxXIL1jBDD7SDxU936oZkCnxQbWwJVw=" crossorigin="anonymous"></script> -->
<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>


<!-- Google Webfonts -->
<!-- <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> -->

<!-- End Of Google Webfonts -->


<link rel="stylesheet" href="/css/all.css">


<!-- Animate.css -->
<!-- <link rel="stylesheet" href="https://www.findbestjodi.com/css/animate.css"> -->
<!-- Icomoon Icon Fonts-->
<!-- <link rel="stylesheet" href="https://www.findbestjodi.com/css/icomoon.css"> -->
<!-- Magnific Popup -->
 <!-- <link rel="stylesheet" href="https://www.findbestjodi.com/css/magnific.css">  -->
<!-- Salvattore -->
<!-- <link rel="stylesheet" href="https://www.findbestjodi.com/css/salvattore.css"> -->
<!-- Theme Style -->
<!-- <link rel="stylesheet" href="https://www.findbestjodi.com/css/style.css"> -->
<!-- my css -->
<!-- <link rel="stylesheet" href="https://www.findbestjodi.com/css/mystyle.css"> -->


<!-- JS Links -->
<script async src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script async src="https://use.fontawesome.com/288179997b.js" type="text/javascript"></script>
<script>
	$(".nav-menu-btn").click(function(){
		console.log("Nav Triggered");
	 	$("#fh5co-offcanvass").toggleClass( 'nav-awake');



	});
		$(".nav-close").click(function(){
		console.log("Nav Triggered");
	 	$("#fh5co-offcanvass").removeClass( 'nav-awake');



	});

</script>
<!-- Nav bar -->
<!-- End Of Js Links -->

<!-- Script -->
 <script>
        function notify(name, Message, link)
        {
            //check if browser supports notification API
            if("Notification" in window)
            {
                if(Notification.permission == "granted")
                {
                    var notification = new Notification( name, {"body":Message});
                    if (link) {
                      notification.onclick = function () {
                        window.open(link);
                      };
                    }
                }
                else
                {
                    Notification.requestPermission(function (permission) {
                        if (permission === "granted") 
                        {
                            var notification = new Notification( name, {"body":Message});
                            if (link) {
                              notification.onclick = function () {
                                window.open(link);
                              };
                            }
                        }
                    });
                }
            }   
            else
            {
             
            }       
        }

  </script>
<!-- End Of Script -->

<!-- Notifications -->
<div id="noti" class="modal fade" role="dialog">
	 <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" >&times;</button>
				
				<table id="customers">
					<tr>
						<th colspan="2"><center>Notifications - Unseen</th>
					</tr>
				</table>
				<table>
					<?php
					include("connect.php");
					$user_email = $_SESSION['user_email'];
					$getuser = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
					$get = mysqli_fetch_array($getuser);
					$userLoggedin = $get['user_id'];
					
					$query = mysqli_query($mysqli,"select * from notifications where post_user_id='$userLoggedin' and status='unseen' ORDER BY 1 DESC");
					while($row=mysqli_fetch_array($query))
					{
						$noti_id = $row['noti_id'];
						$encoded_noti_id = base64_encode($noti_id);
						$post_id = $row['post_id'];
						$encoded_post_id = base64_encode($post_id);
						
						$user_id = $row['user_id'];
						$encoded_user_id = base64_encode($user_id);
						$user = mysqli_query($mysqli,"select * from users where user_id='$user_id'");
						$rowuser = mysqli_fetch_array($user);
						$user_name = $rowuser['user_name'];
						$user_image = $rowuser['user_image'];
						
						$other_user_id = $row['post_user_id'];
						$encoded_other_user_id = base64_encode($other_user_id);
						$other = mysqli_query($mysqli,"select * from users where user_id='$other_user_id'");
						$otheruser = mysqli_fetch_array($other);
						$other_name = $otheruser['user_name'];
						$other_image = $otheruser['user_image'];
						
						$type = $row['type'];
						$date = $row['date'];
						$status = $row['status'];
						
						if($type == "comment")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/detailspost.php?posts=<?php echo $encoded_post_id; ?>&noti_id=<?php echo $encoded_noti_id; ?>" style="color:black;">Commented On Your Post. </a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "requested")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/my_profile.php?noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;">Sent You A Follow Request.<b style="color:green;">Accept It</b> </a>
								</td>
							</tr>
						<?php } ?>
						<?php
						if($type == "tag")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/detailspost.php?posts=<?php echo $encoded_post_id; ?>&noti_id=<?php echo $encoded_noti_id; ?>" style="color:black;">tagged you in a post. </a>
								</td>
							</tr>
						<?php } ?>
						<?php
						if($type == "mention")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/detailspost.php?posts=<?php echo $encoded_post_id; ?>&noti_id=<?php echo $encoded_noti_id; ?>" style="color:black;">mentioned you in a post comment. </a>
								</td>
							</tr>
						<?php } ?>
						<?php
						if($type == "accepted")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>&noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;"><b style="color:green;">Accepted</b> Your Follow Request. Now View His Profile. </a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "unfollow")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>&noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;"> <b style="color:green;">Un-Following</b> You. Send A Follow Request Again <br></a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "rejected")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>&noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;"><b style="color:green;">Rejected</b> Your Follow Request. Send A Follow Request Again </a>
								</td>
							</tr>
						<?php } ?>
						
						<!-- Delete the Notifications -->
						<script type="text/javascript">
						function delete_notifications(noti_id)
						{
							$.ajax({
								url: "delete_notifications.php",
								method: "POST",
								async: false,
								data: {noti_id : noti_id},
								success: function(data)
								{        
									$('#noti'+noti_id).hide();
									noticount = $('#noticount').text();
									if (parseInt(noticount) > 0) {
										$('#noticount').text(parseInt(noticount) - 1);
									}

									noticounted = $('#noticounted').text();
									if (parseInt(noticounted) > 0) {
										$('#noticounted').text(parseInt(noticounted) - 1);
									}
								}
							});
						}
						</script>
						<div class="delete_notifications<?php echo $noti_id; ?>"></div>
						<!-- End Of Delete The Comment Stories -->	
				
					<?php } ?>
				</table>
				
				
				<table id="customers">
					<tr>
						<th colspan="2"><center>Notifications - seen</th>
					</tr>
				</table>
				<table>
					<?php
					include("connect.php");
					$user_email = $_SESSION['user_email'];
					$getuser = mysqli_query($mysqli,"select * from users where user_email='$user_email'");
					$get = mysqli_fetch_array($getuser);
					$userLoggedin = $get['user_id'];
					
					$querys = mysqli_query($mysqli,"select * from notifications where post_user_id='$userLoggedin' and status='seen' ORDER BY 1 DESC");
					while($row=mysqli_fetch_array($querys))
					{
						$noti_id = $row['noti_id'];
						$encoded_noti_id = base64_encode($noti_id);
						$post_id = $row['post_id'];
						$encoded_post_id = base64_encode($post_id);
						
						$user_id = $row['user_id'];
						$encoded_user_id = base64_encode($user_id);
						$user = mysqli_query($mysqli,"select * from users where user_id='$user_id'");
						$rowuser = mysqli_fetch_array($user);
						$user_name = $rowuser['user_name'];
						$user_image = $rowuser['user_image'];
						
						$other_user_id = $row['post_user_id'];
						$encoded_other_user_id = base64_encode($other_user_id);
						$other = mysqli_query($mysqli,"select * from users where user_id='$other_user_id'");
						$otheruser = mysqli_fetch_array($other);
						$other_name = $otheruser['user_name'];
						$other_image = $otheruser['user_image'];
						
						$type = $row['type'];
						$date = $row['date'];
						$status = $row['status'];
						
						if($type == "comment")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/detailspost.php?posts=<?php echo $encoded_post_id; ?>&noti_id=<?php echo $encoded_noti_id; ?>" style="color:black;">Commented On Your Post. </a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "requested")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/my_profile.php?noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;">Sended You A Follow Request.<b style="color:green;">Accept It</b> </a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "accepted")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>&noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;"><b style="color:green;">Accepted</b> Your Follow Request. Now View His Profile. </a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "unfollow")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>&noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;"> <b style="color:green;">Un-Following</b> You. Send A Follow Request Again <br></a>
								</td>
							</tr>
						<?php } ?>
						
						<?php
						if($type == "rejected")
						{?>
							<tr id="noti<?php echo $noti_id; ?>">
								<td width="15%;">
									<br><a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><span class="profile-pic" style="background:url('user_images/<?php echo "$user_image"; ?>'); padding: 30px; border-radius: 50%;"></span></a><br><br>
								</td>
								<td width="85%;">
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>" ><b style="color:#2c82f8;"><?php echo "$user_name"; ?></b><?php echo "<b style='float:right;'>$date</b>"; ?></a><br>
									<div class="pull-right action-btn"><b><a href="javascript:void(0)" onclick="delete_notifications(<?php echo $noti_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></b>&nbsp&nbsp&nbsp</div>
									&nbsp&nbsp&nbsp <a href="https://findbestjodi.com/user_profile.php?user=<?php echo $encoded_user_id; ?>&noti_id=<?php echo "$encoded_noti_id"; ?>" style="color:black;"><b style="color:green;">Rejected</b> Your Follow Request. Send A Follow Request Again </a>
								</td>
							</tr><div class="delete_notifications<?php echo $noti_id; ?>"></div>
						<?php } ?>
						
						<!-- Delete the Notifications -->
						<script type="text/javascript">
						function delete_notifications(noti_id)
						{
							$.ajax({
								url: "delete_notifications.php",
								method: "POST",
								async: false,
								data: {noti_id : noti_id},
								success: function(data)
								{
									console.log("Hiding Notifation- END");
									$('#noti'+noti_id).hide();
									noticount = $('#noticount').text();
									if (parseInt(noticount) > 0) {
										$('#noticount').text(parseInt(noticount) - 1);
									}
									
									noticounted = $('#noticounted').text();
									if (parseInt(noticounted) > 0) {
										$('#noticounted').text(parseInt(noticounted) - 1);
									}
								}
							});
						}
						</script>
						<div class="delete_notifications<?php echo $noti_id; ?>"></div>
						<!-- End Of Delete The Comment Stories -->	
				
					<?php } ?>
				</table>							
				
			</div>
		</div>
	</div>
</div>