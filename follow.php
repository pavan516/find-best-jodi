<?php

require_once "connect.php";
$loggedin_user_email = $_SESSION['user_email'];
$loggedin_query = mysqli_query($mysqli,"SELECT * FROM users where user_email = '$loggedin_user_email'");
$loggedin_row = mysqli_fetch_array($loggedin_query);
									
$loggedin_user_id = $loggedin_row['user_id'];
				
$follow_query = mysqli_query($mysqli,"SELECT * FROM follower where user_id = '$loggedin_user_id' AND follow_id = '$user_id' AND status='accepted'");
$check = mysqli_num_rows($follow_query);
									
$followersQueryCurrent = mysqli_query($mysqli,"select * from follower where user_id='$loggedin_user_id' and follow_id ='$user_id'");
$currentFollower = mysqli_fetch_array($followersQueryCurrent);?>
  
<?php
if($currentFollower) 
{ ?>
	<a href="javascript:void(0)" class="following btn btn-default" id="chageuserfolowusers<?php echo "$user_id"; ?>" onclick="unfollow(<?php echo $loggedin_user_id; ?>,<?php echo $user_id; ?>)" > 
	
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
	</a>
	<?php 
} 
else 
{ 
?>

	<a href="javascript:void(0)" class="following btn btn-default" id="chageuserfolowusers<?php echo "$user_id"; ?>" style="margin-top: -8px" onclick="follow(<?php echo $loggedin_user_id; ?>,<?php echo $user_id; ?>)"><i class="fa fa-rss"></i> Follow</a>
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






