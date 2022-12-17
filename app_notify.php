<?php 
include("connect.php");

//  if(isset($_POST['token']))
//  {		
		$token  = $_POST["token"];
        $username = $_POST["username"];
		$userid = $_POST["userid"];
		$useremail = $_POST["useremail"];
		
		
		$userdata = "select * from users where user_email = '$useremail'";
		$response = mysqli_query($mysqli,$userdata);
		$co = $response->num_rows;
		if($co>0){
		    
		     while($row = $response->fetch_assoc()) {
                  $user_id =  $row["user_id"];
                  $user_name = $row["user_name"];
                  
                }
		    
		}
		
		
		
		
		$q = "select * from app_notifications where useremail= '$useremail'";
		$res = mysqli_query($mysqli,$q);
		$count = $res->num_rows;
		if($count>0){
		    		    	$query = "update `app_notifications` SET `token` = '$token' WHERE `app_notifications`.`useremail` = '$useremail'";
		if(mysqli_query($mysqli, $query))
		{
			$response=array(
				'error' => false,
				'message' =>'User token updated succefully'
			);
		}
		else
		{
			$response=array(
				'error' => true,
				'message' =>'Some error occured.Try again later'
			);
		}
// 		header('Content-Type: application/json');
// 		echo json_encode($response);
		    
		}
		else{
		    
		    		    		    	$query = "insert into app_notifications (userd_id,token,username,useremail) values ('$user_id','$token','$user_name','$useremail')";
		if(mysqli_query($mysqli, $query))
		{
			$response=array(
				'error' => false,
				'message' =>'User token saved succefully'
			);
		}
		else
		{
			$response=array(
				'error' => true,
				'message' =>'Some error occured.Try again later'
			);
		}
		    
		}
		
			header('Content-Type: application/json');
		echo json_encode($response);	
		
		
		
		
		
		
		
		
		
		
		
		
		
// 		if($token == null && $username == null && $useremail == null && $userid= null ){
		    
// 		    	$response=array(
// 				'error' => true,
// 				'message' =>'Authorization failed'
// 			);
		    
// 		}
// 		else{
		    
// 		    	$query = "insert into app_notifications (userd_id,token,username,useremail) values ('$userid','$token','$username','$useremail')";
// 		if(mysqli_query($mysqli, $query))
// 		{
// 			$response=array(
// 				'error' => false,
// 				'message' =>'User token saved succefully'
// 			);
// 		}
// 		else
// 		{
// 			$response=array(
// 				'error' => true,
// 				'message' =>'Some error occured.Try again later'
// 			);
// 		}
// 		header('Content-Type: application/json');
// 		echo json_encode($response);
		    
// 		}

		
	

//  }
//  else
//  {
    
//  		$response=array(
// 				'error' => true,
// 				'message' =>'Invalid Request'
// 			);
		
//  }
//  	echo json_encode($response);
 
	?>