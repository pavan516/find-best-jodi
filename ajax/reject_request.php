


<?php
include('connect.php');
$action = $_POST['action'];

if($action == 'pending') 
{
    $user_id=$_POST["user_id"];
    $follow_id=$_POST["follow_id"];
    
    $rowQuery = mysqli_query($mysqli,"select * from follower where user_id ='$user_id' and follow_id='$follow_id'");
    $row=mysqli_fetch_array($rowQuery);
	
	$id = $row['id'];

    if($row) 
	{
		$notificaions = mysqli_query($mysqli,"insert into notifications (post_id,user_id,post_user_id,type,date,status) values ('$id','$follow_id','$user_id','rejected',NOW(),'unseen')");
		$updateQuery = mysqli_query($mysqli,"DELETE FROM follower where id='$id'");
    }
    
    
      $vin = send_notification($user_id,$follow_id,"rejected");
    
    $returnData = array(
          'success' => 'success',
          'message' => 'successfully updated',
           'data'=>$vin
      );

    die(json_encode($returnData));

}



function send_notification($userid,$followid,$type){
    
    
    
       $con=mysqli_connect("localhost","pavankum_imhskal",")xI6FhhFTAT7","pavankum_findbestjodi");
    
    
    	$userdata = "select * from users where user_id = '$followid'";
		$response = mysqli_query($con,$userdata);
		$co = $response->num_rows;
		if($co>0){
		    
		     while($row = $response->fetch_assoc()) {
                  $user_name = $row["user_name"];
                  
                }
		    
		}
		
		
		
			$usertoken = "select * from app_notifications where userd_id = '$userid'";
		$respo = mysqli_query($con,$usertoken);
		$con = $respo->num_rows;
		if($con>0){
		    
		     while($row = $respo->fetch_assoc()) {
                  $user_token = $row["token"];
                  
                }
		    
		}
		
		
	
		
		
		
		
    
    
    
    
    
 
        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();

        $payload = array();
        $payload['web_view_url'] = 'https://findbestjodi.com/login.php';
      
        $title = $user_name." ".$type." your request";
        
        $message = $user_name." ".$type." your request";
        
        $push->setTitle($title);
        $push->setMessage($message);

      
            $push->setImage('');
       

        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $json = '';
        $response = '';
        $regId = $user_token;
      
            $json = $push->getPush();
           
            $response = $firebase->send($regId, $json);
            return $response;
    
}






	?>
	