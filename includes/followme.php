<?php 
include("includes/check.php"); 
?>

<!-- Logged In User Details -->
<?php
$user_email = $_SESSION['user_email'];
$query = mysqli_query($mysqli,"select * from users where user_email = '$user_email'");
$row_users = mysqli_fetch_array($query);
								
	$loggedin_user_id = $row_users['user_id'];
	$encoded_loggedin_user_id = base64_encode($loggedin_user_id);
	$loggedin_user_iduser_name = $row_users['user_name'];
?>
<!-- End Of Logged In User -->

<!-- Follow Option -->
<?php
	$followersQueryCurrent = mysqli_query($mysqli,"select * from follower where user_id='$loggedin_user_id' and follow_id ='$user_id'");
	$currentFollower = mysqli_fetch_array($followersQueryCurrent);
?>
<?php  
if($currentFollower) 
{ ?>
	<button style="margin-top:20px !important;padding:5px !important;" class="following btn btn-default" id="chageuserfolowusers<?php echo "$user_id"; ?>" style="margin-top: -8px" onclick="unfollow(<?php echo $loggedin_user_id; ?>,<?php echo $user_id; ?>)" > 
	<?php 
    if($currentFollower['status'] == 'accepted')
	{
		echo '<i class="fa fa-check"></i> Following';
	}
    else 
	{
        echo '<i class="fa fa-envelope-o"></i> Requested';
	}
    ?>
    </button>
<?php 
} 
else 
{ ?>
    <button class="following btn btn-default" id="chageuserfolowusers<?php echo "$user_id"; ?>" style="margin-top: -8px" onclick="follow(<?php echo $loggedin_user_id; ?>,<?php echo $user_id; ?>)"><i class="fa fa-rss"></i> Follow</button>
<?php } ?>
				
	
<script type="text/javascript">
  	function follow(user_id,follow_id) 
	{
       	var data = {
        	'action' : 'follow',
         	'user_id' : user_id,
         	'follow_id' : follow_id
            		}

         $.ajax({
         	url : 'ajax/user_controller.php',
         	type : 'post',
            data : data,
            success : function(response) 
			{
				response = $.parseJSON(response);
				if(response.success == 'success') 
				{
					posts_home_display(<?php echo $user_id; ?>);
							
					alert("Successfully follow.");
					$("#chageuserfolowusers"+follow_id).attr('onclick','unfollow('+user_id+','+follow_id+')');
					$("#chageuserfolowusers"+follow_id).html('<i class="fa fa-envelope-o"></i> Requested');
					
						
					

					
				}
            }
         })
     }
		
	function unfollow(user_id,follow_id) 
	{
        var data = {
         	'action' : 'unfollow',
           	'user_id' : user_id,
          	'follow_id' : follow_id
            		}

        $.ajax({
        	url : 'ajax/user_controller.php',
            type : 'post',
            data : data,
            success : function(response) 
			{
            	console.log(response);
            	response = $.parseJSON(response);
            	if(response.success == 'success') 
				{
            		alert("Successfully Unfollow.");
					$("#chageuserfolowusers"+follow_id).attr('onclick','follow('+user_id+','+follow_id+')');
					$("#chageuserfolowusers"+follow_id).html('<i class="fa fa-rss"></i> Follow');
            	}
            }
        })
     }
</script>
<script>
function posts_home_display(follow_id)
{
	$.ajax({
		url: "includes/noti_follow_unfollow.php",
		method: "POST",
		async: false,
		data: {follow_id : follow_id},
		success: function(data)
		{
			$('.posts_home_display').html(data);
		}
	});
}
</script>
<div class="posts_home_display"></div>