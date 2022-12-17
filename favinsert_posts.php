<div id="fh5co-main">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
						
				<div class="fh5co-spacer fh5co-spacer-sm"></div><br>
				<form method="post" action="favpostinsert_posts.php" enctype="multipart/form-data">
													
					<div class="row">
								
						<div class="col-md-12">
							<label>Select Post Type</label>
							<div class="form-group">
								<select  name="post_type" id="post_type" class="form-control">
									<option value="private" style="color:black;"><b>private</b></option>
								</select>
							</div>
						</div>
																						
						<div class="col-md-12">
							<label>Select Image</label>
							<div class="form-group">
								<input type="file" name="post_image" id="post_image" class="form-control" accept="image/x-png,image/gif,image/jpeg"/>	
							</div>
						</div>
															
						<div class="col-md-12">
							<label>Share Your YouTube Video</label>
							<div class="form-group">
								<input type="text" name="post_youtube" id="post_youtube" class="form-control" placeholder="Paste Your YouTube Video Url"/>	
							</div>
						</div>
														
						<div class="col-md-12">
							<label>Share Your Feelings...</label>
							<div class="form-group">
								<textarea name="post_content" id="post_content" class="form-control" placeholder="Share Your Feelings...."/></textarea>	
							</div>
						</div>
												
						<div class="form-group">
							<center><input type="submit" name="post" id="post" class="btn btn-default" value="Post"></center>
						</div>
														
					</div>
														
				</form>
						
			</div>
   		</div>
	</div>
</div>

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

$('#post_content').atwho({
    at: "@",
    data: arr,
})

</script>