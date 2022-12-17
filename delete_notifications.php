<?php
include('connect.php');
$noti_id = $_POST['noti_id'];
	
$delete_post = mysqli_query($mysqli,"delete from notifications where noti_id='$noti_id'");
if($delete_post)
{
    echo<<<EOD
    <script>
        $("#noti$noti_id").hide();
    </script>
EOD;
}
?>	