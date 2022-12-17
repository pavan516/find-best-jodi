<?php 
include("includes/check.php"); 
?>
<?php
include("connect.php");

$post_id = base64_decode($_POST['post_id']);
	
$get_users = mysqli_query($mysqli,"select * from posts where post_id = '$post_id'");
$rows = mysqli_fetch_array($get_users);
$follow_id = $rows['user_id'];
	
$user = $_SESSION['user_email'];
$get_user = mysqli_query($mysqli,"select * from users where user_email='$user'");
$row = mysqli_fetch_array($get_user);
								
$user_id = $row['user_id'];

$taggedguys = [];
$comment = $_POST['comment'];
$comment = str_replace("<br />", " <br> ", nl2br($comment));
// Exploding Content Text
$exploded = explode(" ", $comment);
$comment = "";
foreach ($exploded as $word) {


    if (substr($word, 0, 1) == "@") {
        $user_name = strtolower(substr($word, 1)); 
        
        // Checking If this Username even Exists
        $query = "SELECT COUNT(*),user_id FROM `users` WHERE `users`.`user_name` = '" . $user_name . "'";
        $result = mysqli_query($mysqli, $query);
        $data = mysqli_fetch_array($result);
  
        if ($data[0] == 1) {
            $word = "<a href='/user_profile.php?user=". base64_encode($data[1]) . "'>{$user_name}</a>";
            $taggedguys[] = $data[1];

        }
    }
    $comment = $comment . " " . $word;
}



$comment = mysqli_real_escape_string($mysqli,stripslashes($comment));

if($comment=='')
{
	echo "<script>alert('Comment Something!')</script>";
	exit();
}
else 
{
	$notificaions = mysqli_query($mysqli,"insert into notifications (post_id,user_id,post_user_id,type,date,status) values ('$post_id','$user_id','$follow_id','comment',NOW(),'unseen')");
	$query_comment = mysqli_query($mysqli,"insert into post_comments (user_id,post_id,comment,comment_date) values('$user_id','$post_id','$comment',NOW())");


    $today = date("Y-m-d");
    foreach ($taggedguys as $tagged) {
        $query = "INSERT INTO `notifications` (`noti_id`, `post_id`, `user_id`, `post_user_id`, `type`, `date`, `status`) VALUES (NULL, '{$post_id}', '{$user_id}', '{$tagged}', 'mention', '{$today}', 'unseen');";
        $result = mysqli_query($mysqli, $query);
    }       


	if($query_comment)
	{
	    
	    
	     send_notification($user_id,$follow_id,"commented");
	    
	    
		echo "<script>alert('Your Comment Has Been Published Successfully!')</script>";
		exit(); 
	}
}



function send_notification($userid,$followid,$type){
    
      $con = mysqli_connect("localhost","findbest_navapuk","Z-(?}u4@_s=^","findbest_findbestjodi");
    
    
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
      
        $title = $user_name." ".$type." on your post";
        
        $message = $user_name." ".$type." on your post";
        
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