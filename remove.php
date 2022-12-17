<?php
$loggedin_user_email = $_SESSION['user_email'];
$loggedin_query = mysqli_query($mysqli,"SELECT * FROM users where user_email = '$loggedin_user_email'");
$loggedin_row = mysqli_fetch_array($loggedin_query);
									
$loggedin_user_id = $loggedin_row['user_id'];

$pendingQuery = mysqli_query($mysqli,"select * from follower where status='accepted' and user_id='$user_id' and follow_id='$loggedin_user_id'");
 
if(mysqli_num_rows($pendingQuery) == 0)
{ 
}
else
{?>
	<a class="following btn btn-default" onclick="reject(this,<?php echo $loggedin_user_id; ?>,<?php echo $user_id; ?>)" style="margin-top: -8px"><i class="fa fa-envelope-o"></i> Remove</a>
<?php }  ?>
<!-- End Of Pending List Box -->
			
            <script type="text/javascript">
            					
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
								alert("Successfully Removed As Your follower.");
            					$(th).html('<i class="fa fa-times"></i> Removed');
            				}
            			}
            		})
            	}
            </script>