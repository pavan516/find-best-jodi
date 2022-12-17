<?php 
include("includes/check.php"); 
?>
<!-- Logged In User Details -->
<?php 
include("connect.php");
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
			$row_user = mysqli_fetch_array($query);
								
			$loggedin_user_id = $row_user['user_id'];
			$encoded_loggedin_user_id = base64_encode($loggedin_user_id);
			$loggedin_user_iduser_name = $row_user['user_name'];
		}
	}
}
?>
<!-- End Of Logged In User -->

<?php 
	$followersQuery = mysqli_query($mysqli,"select * from follower where status = 'accepted' and follow_id = '$user_id'");
?>
		
<a style="margin-top:20px !important;padding:5px !important;" class="btn btn-default" href="#" data-toggle="modal" data-target="#userFollowers"> Followers</a> <a  style="margin-top:20px !important;padding:5px !important;" class="btn btn-default" href="#" data-toggle="modal" data-target="#userFollowers"><?= mysqli_num_rows($followersQuery) ?></a>
		    
<!-- Followers Box -->
<div id="userFollowers" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Follower List</h4>
			</div>
					
			<?php if($row_user) { ?>
			   	<div class="modal-body">							
					<table id="table_comment_97" class="table_data">
						<tbody>
							<?php 
							while ($rows = mysqli_fetch_array($followersQuery))
							{
								$followers_user_id = $rows['user_id'];
									
								$userSelect = mysqli_query($mysqli,"select * from users where user_id='$followers_user_id'");
								$userRow = mysqli_fetch_array($userSelect);
									
								$followers_user_id = $userRow['user_id'];
								$encoded_followers_user_id = base64_encode($followers_user_id);
								$followers_user_image = $userRow['user_image'];
								$followers_user_name = $userRow['user_name'];?>
									
							<tr>
								<td width="10%">
									<a href="user_profile.php?user=<?php echo $encoded_followers_user_id; ?>"><img src="<?php echo "user_images/100x100/$followers_user_image"; ?>" width="50" height="50"></a>
								</td>
								<td width="45%">
									<b><a href="user_profile.php?user=<?php echo $encoded_followers_user_id; ?>"> <?php echo $followers_user_name; ?> </a></b>		
								</td>
								<td width="45%">
									<?php
									$rQuery = mysqli_query($mysqli,"select * from follower where user_id='$loggedin_user_id' and follow_id = '$followers_user_id'");
									$rRow = mysqli_fetch_array($rQuery);
									?>
									<?php  if($rRow['status'] == 'accepted') { ?>
										<br><button class="following btn btn-default" id="chageuserfolowuser<?php echo $followers_user_id; ?>" style="margin-top: -8px" onclick="unfollow(<?php echo $loggedin_user_id; ?>,<?php echo $followers_user_id; ?>)" ><i class="fa fa-check"></i> Following</button>
									<?php } elseif($rRow['status'] == 'pending') { ?>
										<br><button class="pending btn btn-default" id="chageuserfolowuser<?php echo $followers_user_id; ?>" style="margin-top: -8px" onclick="unfollow(<?php echo $loggedin_user_id; ?>,<?php echo $followers_user_id; ?>)" ><i class="fa fa-envelope-o"></i> Requested</button>
									<?php } else { ?>
										<br><button class="following btn btn-default" id="chageuserfolowuser<?php echo $followers_user_id; ?>" style="margin-top: -8px" onclick="follow(<?php echo $loggedin_user_id; ?>,<?php echo $followers_user_id; ?>)"><i class="fa fa-rss"></i> Follow</button>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php
				} 
				else
				{ ?>
					<div class="row">
                       	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       		<h4>No Followers !!</h4>
                       	</div>
                    </div>
				<?php } ?>										
			</div>
		</div>
		<!-- End Of Modal content-->
	</div>
</div>
<!-- End Of Followers Box -->

<!-- script -->			  
	<script type="text/javascript">
            	function follow(user_id,follow_id) {
            		var data = {
            			'action' : 'follow',
            			'user_id' : user_id,
            			'follow_id' : follow_id
            		}

            		$.ajax({
            			url : 'ajax/user_controller.php',
            			type : 'post',
            			data : data,
            			success : function(response) {
            				response = $.parseJSON(response);
            				if(response.success == 'success') {
            				      alert("Successfully follow.");
								  $("#chageuserfolowuser"+follow_id).attr('onclick','unfollow('+user_id+','+follow_id+')');
								  $("#chageuserfolowuser"+follow_id).html('<i class="fa fa-envelope-o"></i> Requested');
								  
            				}
            			}
            		})
            	}
				function unfollow(user_id,follow_id) {
            		var data = {
            			'action' : 'unfollow',
            			'user_id' : user_id,
            			'follow_id' : follow_id
            		}

            		$.ajax({
            			url : 'ajax/user_controller.php',
            			type : 'post',
            			data : data,
            			success : function(response) {
            				console.log(response);
            				response = $.parseJSON(response);
            				if(response.success == 'success') {
            					alert("Successfully Unfollow.");
								$("#chageuserfolowuser"+follow_id).attr('onclick','follow('+user_id+','+follow_id+')');
								$("#chageuserfolowuser"+follow_id).html('<i class="fa fa-rss"></i> Follow');
            				}
            			}
            		})
            	}
            </script>
			