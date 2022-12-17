<?php 
include("includes/check.php"); 
?>
<!-- Pending Option -->
<?php
	$pendingQuery = mysqli_query($mysqli,"select * from follower where status='pending' and follow_id='$user_id'");
?>
<a style="margin-top:20px !important;padding:5px !important;" href="#" data-toggle="modal" data-target="#userPending" class="btn btn-default" style="" href="#"> Requests</a> <a  style="margin-top:20px !important;padding:5px !important;" class="btn btn-default" href="#" data-toggle="modal" data-target="#userPending"><?= mysqli_num_rows($pendingQuery) ?></a>
<!-- Pending List Box -->
<div id="userPending" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button onclick="closebelowheader();" type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pending List</h4>
			</div>
			<div class="modal-body">
				<?php if(mysqli_num_rows($pendingQuery) == 0)
				{?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4>0 pending requests !!</h4>
						</div>
					</div>
				<?php }
				else
				{?>
				<table id="<?php echo "$user_id"; ?>">
					<tbody id="customers">
						<?php 
						while ($row = mysqli_fetch_array($pendingQuery))
						{
							$request_user_id = $row['user_id'];
							$userSelect = mysqli_query($mysqli,"select * from users where user_id='$request_user_id'");
							$userRow = mysqli_fetch_array($userSelect);
											
							$request_user_id = $userRow['user_id'];
							$encoded_request_user_id = base64_encode($request_user_id);
							$request_user_name = $userRow['user_name'];
							$request_user_image = $userRow['user_image'];
						?>
						<tr>
							<td>
								<a href="user_profile.php?user=<?php echo $encoded_request_user_id; ?>"><img src="user_images/100x100/<?php echo $request_user_image; ?>" width="50" height="50"></a>
							</td>
							<td>
								<b><a href="user_profile.php?user=<?php echo $encoded_request_user_id; ?>"> <?php echo $request_user_name; ?> </a></b>		
							</td>
							<td>
								<br><button class="following btn btn-default" onclick="pending(this,<?php echo $user_id; ?>,<?php echo $request_user_id; ?>)" style="margin-top: -8px"><i class="fa fa-envelope-o"></i> Accept</button>
							</td>
							<td>
								<br><button class="following btn btn-default" onclick="reject(this,<?php echo $user_id; ?>,<?php echo $request_user_id; ?>)" style="margin-top: -8px"><i class="fa fa-envelope-o"></i> Reject</button>
							</td>
						</tr>
						<?php }  ?>
				
					</tbody>
				</table>
				<?php }  ?>
				
			</div>
		</div>
		
		<!-- End Of Modal Content -->
</div>
</div>
<!-- End Of Pending List Box -->
			
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
								  $("#chageuserfolow"+follow_id).attr('onclick','unfollow('+user_id+','+follow_id+')');
								  $("#chageuserfolow"+follow_id).html('<i class="fa fa-envelope-o"></i> Requested');
								  
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
								$("#chageuserfolow"+follow_id).attr('onclick','follow('+user_id+','+follow_id+')');
								$("#chageuserfolow"+follow_id).html('<i class="fa fa-rss"></i> Follow');
            				}
            			}
            		})
            	}

            	function pending(th,follow_id,user_id) {
            		var data = {
            			'action' : 'pending',
            			'user_id' : user_id,
            			'follow_id' : follow_id
            		}
            		
            		$.ajax({
            			url : 'ajax/pending_request.php',
            			type : 'post',
            			data : data,
            			success : function(response) {
            				console.log(response);
            				response = $.parseJSON(response);
            				if(response.success == 'success') {
            					$(th).html('<i class="fa fa-check"></i> Accepted');
            				}
            			}
            		})
            	}
				
				function reject(th,follow_id,user_id) {
            		var data = {
            			'action' : 'pending',
            			'user_id' : user_id,
            			'follow_id' : follow_id
            		}
            		
            		$.ajax({
            			url : 'ajax/reject_request.php',
            			type : 'post',
            			data : data,
            			success : function(response) {
            				console.log(response);
            				response = $.parseJSON(response);
            				if(response.success == 'success') {
            					$(th).html('<i class="fa fa-times"></i> Rejected');
            				}
            			}
            		})
            	}
            </script>