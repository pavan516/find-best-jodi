

<?php
include("connect.php");

$action = $_POST['action'];


if($action == 'follow') 
{
    
    
   
    
   
    
    $user_id=$_POST["user_id"];
    $follow_id=$_POST["follow_id"];
    
    
    
    
    
   

    $rowQuery = "select * from follower where user_id = $user_id and follow_id = $follow_id";
    $rowData = mysqli_query($mysqli, $rowQuery);
    $row=mysqli_fetch_row($rowData);
	
	$id = $row['id'];
	
	

	 
	

    if($row) {

       $updateQuery = "update follower set status = 'pending' where id = ".$row['id'];
       mysqli_query($mysqli, $updateQuery);
    }
    else {
        
        
		$notificaions = mysqli_query($mysqli,"insert into notifications (post_id,user_id,post_user_id,type,date,status) values ('$id','$user_id','$follow_id','requested',NOW(),'unseen')");
      $insertQuery = "insert into follower(user_id,follow_id,status) values(".$user_id.",".$follow_id.",'pending')";

      // die($insertQuery);
       mysqli_query($mysqli, $insertQuery);
    
    }
    
    
    
    
  
    
    
    
    
    
    
    $data = send_notification($user_id,$follow_id,"follow");

    $returnData = array(
          'success' => 'success',
          'message' => 'successfully updated',
          'data'=>$data
    
      );
      
      

    die(json_encode($returnData));
    
    
    

}

else if($action == 'unfollow') {
    
   

    $user_id=$_POST["user_id"];
    $follow_id=$_POST["follow_id"];
    
   

	$notificaions = mysqli_query($mysqli,"insert into notifications (post_id,user_id,post_user_id,type,date,status) values ('0','$user_id','$follow_id','unfollow',NOW(),'unseen')");
    $insertQuery = "delete from follower where user_id = '".$user_id."' AND follow_id = '".$follow_id."'";
	  

       mysqli_query($mysqli, $insertQuery);
       
       
       
    $data = send_notification($user_id,$follow_id,"unfollow");
 
    $returnData = array(
          'success' => 'success',
          'message' => 'successfully deleted',
          'data'=>$data
      );

    die(json_encode($returnData));

}


function send_notification($userid,$followid,$type){
    
       $con=mysqli_connect("localhost","pavankum_imhskal",")xI6FhhFTAT7","pavankum_findbestjodi");
    
    
    	$userdata = "select * from users where user_id = '$userid'";
		$response = mysqli_query($con,$userdata);
		$co = $response->num_rows;
		if($co>0){
		    
		     while($row = $response->fetch_assoc()) {
                  $user_name = $row["user_name"];
                  
                }
		    
		}
		
		
		
			$usertoken = "select * from app_notifications where userd_id = '$followid'";
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
      
        $title = $user_name." wants to ".$type." you";
        
        $message = $type." request from ".$user_name;
        
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
	
	
	
	

	
	
	
	

	
	
	