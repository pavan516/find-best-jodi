<?php 
include("includes/check.php");
?>
<?php
$queryss = mysqli_query($mysqli,"SELECT * FROM post_comments WHERE post_id='$post_id'");
$count = mysqli_num_rows($queryss);
?>
<a href="#" class="btn btn-default" onclick="comment_posts(<?php echo $post_id; ?>)" data-toggle="modal" data-target="#comments_posts<?php echo $post_id; ?>" ><i class="fa fa-commenting-o" ></i> View Comments <span> <?php echo $count; ?> </span> </a>
								
<!-- View Comments -->
	<div id="comments_posts<?php echo $post_id; ?>" class="modal fade" role="dialog" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
					<!-- Insert Comments -->
					<form method="post" class="insert_comments<?php echo $post_id; ?>" enctype="multipart/form-data">
						
						<input type="text" name="post_id" id="post_id" value="<?php echo $encoded_post_id ?>" style="display:none;"/>
						<textarea name="comment" id="comment<?php echo $post_id; ?>" class="commented form-control"  style="background-color:black;" placeholder="Comment Something......"></textarea><br>
						<input type="submit" align="left" name="insert_comments" id="insert_comments" value="Comment Here" class="btn btn-default" /></center>
						

					</form>
					<div id="result"></div>

					<script>  
					$(document).ready(function(){   
						$('.insert_comments<?php echo $post_id; ?>').on('submit', function(event){
							event.preventDefault();
							$.ajax({
								url:"insert_comments_posts.php",
								method:"POST",
								data:new FormData(this),
								contentType:false,
								cache:false,
								processData:false,
								success:function(data)
								{
									$('#result').html(data);
									$('#comment<?php echo $post_id; ?>').val('');
									comments_posts_display(<?php echo $post_id; ?>);
								}
							})
						});
						
						function comments_posts_display(post_id)
						{
							$.ajax({
								url: "comments_posts_display.php",
								method: "POST",
								async: false,
								data: {post_id : post_id},
								success: function(data)
								{
									$('.comments_posts_display'+post_id).html(data);	
								}
							});
						}
						comments_posts_display(<?php echo $post_id; ?>);
					});  
					</script>
					<!-- End Of Insert Of Comments -->
					
					<!-- Display Comments -->
					<div class="comments_posts_display<?php echo $post_id; ?>"></div>
					<!-- End Of Display Comments -->
					
				</div>	
			</div>
		</div>
	</div>
<!-- End Of View Comments -->

<script  async src="/js/jquery.caret.js" type="text/javascript"></script>
<script  async src="/js/jquery.atwho.js" type="text/javascript"></script>

<script>

	var names;
	$.ajax({
		url:"/chat/public/getnames",
		method:"GET",
		async: false,
		success:function(data)
		{
			 names = data;
		}
	})
var parsed = JSON.parse(names);

var arr = [];

for(var x in parsed){
  arr.push(parsed[x]);
}

$('.commented').atwho({
    at: "@",
    data: arr,
})

</script>
