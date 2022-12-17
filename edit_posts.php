
<!-- Edit Your Post -->
<p>
	<table id="customers">
		<tr>
			<th colspan="2"><center>Edit Your Post</center></th>
		</tr>
	</table>
</p>
											
<form method="post" class="edit_posts_forma<?php echo $post_id; ?>" enctype="multipart/form-data">	

	<div class="row">
															
		<input type="text" name="post_id" id="post_id" value="<?php echo $post_id; ?>" style="display:none;">
		<input type="text" name="user_id" id="user_id" value="<?php echo $user_id; ?>" style="display:none;">

		<div class="col-md-12">
			<label>If Needed Change Image</label>
			<div class="form-group">
				<input style="background-color:black;" type="file" name="post_image" id="post_image" class="form-control" accept="image/x-png,image/gif,image/jpeg"/>	
			</div>
		</div>
										
		<div class="col-md-12">
			<label>Share Your YouTube Video</label>
			<div class="form-group">
				<input style="background-color:black;" type="text" name="post_youtube" id="post_youtube" class="form-control" value="<?php echo $post_youtube; ?>"/>	
			</div>
		</div>
		<?php $post_content = str_replace("<a", "@<a", $post_content ) ?>												
		<div class="col-md-12">
			<label>Share Your Feelings...</label>
			<div class="form-group">
				<textarea style="background-color:black;"  name="post_content" id="post_content<?php $rand = rand(); echo $rand;?>" class="form-control taggable" ><?php echo strip_tags(  preg_replace('/<br(\s+)?\/?>/i', "\n", $post_content)); ?></textarea>
			</div>
		</div>
																
		<div class="form-group">
			<center><input style="background-color:black;" type="submit" name="edit_posts_forma" id="edit_posts_forma" class="btn btn-default" value="EDIT"></center>
		</div>
																						
	</div>
																					
</form>
								
<div id="resultss<?php echo $post_id; ?>"></div>
	
<script>  
$(document).ready(function()
{
	var limit = 5;
	var start = 0;
	var user_id = <?php echo $user_id; ?>;
	
	$('.edit_posts_forma<?php echo $post_id; ?>').on('submit', function(event){
	event.preventDefault();
	$.ajax({
		url:"edit_posts_form.php",
		method:"POST",
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		success:function(data)
		{
			$('#resultss<?php echo $post_id; ?>').html(data);
		}
	})
	});
});  
$('.taggable').atwho({
    at: "@",
    data: arr,
})
</script>