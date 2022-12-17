<!-- Likes -->
<?php
$post_owner_id 				=	$user_id;
$encoded_post_id			=	base64_encode($post_id);
															
if($total_like_this_post_by_logged_in_user>0)
{
	$thump_direction_class	=	'fa fa-thumbs-o-down';
	$text		=	'Unlike';
}
else
{
	$thump_direction_class	=	'fa fa-thumbs-o-up';
	$text		=	'Like';
}
?>

<script type="text/javascript">
function like_button(post_id)
{
	var post_id	=	post_id;
	$.ajax({
	   type: "POST",
	   url: 'like.php',
	   data:{post_id:post_id},
	   dataType:'json',
	   success:function(response) 
	   {
			if(response.error==0 && response.mesg=='success')
			{
				var element_id		=	'total_like_post_'+response.post_id;
				$('#total_like_post_'+response.post_id).html('');
				$('#total_like_post_'+response.post_id).html('Unlike '+response.total_like);
				$('#thumps_icon_'+response.post_id).removeClass('fa fa-thumbs-o-up');
				$('#thumps_icon_'+response.post_id).addClass('fa fa-thumbs-o-down');
			}
			else if(response.error==0 && response.mesg=='delete')
			{
				var element_id	=	'total_like_post_'+response.post_id;
										 
				$('#total_like_post_'+response.post_id).html('');
				$('#total_like_post_'+response.post_id).html('Like '+response.total_like);
				$('#thumps_icon_'+response.post_id).removeClass('fa fa-thumbs-o-down');
				$('#thumps_icon_'+response.post_id).addClass('fa fa-thumbs-o-up');
			}
		}
	});
}
</script>

<a class="btn btn-default" href="javascript:void(0)"  onclick="like_button('<?php echo $encoded_post_id; ?>');" >
	<i id="thumps_icon_<?php echo  $post_id; ?>" class="<?php echo $thump_direction_class; ?>"></i> 
	<span id="total_like_post_<?php echo  $post_id; ?>"><span><?php echo $text ?></span> <?php echo $total_like_this_post ?></span>
</a> 

<!-- End Of Likes -->
 	
<!-- Comments -->
<?php include("comments.php"); ?>
<!-- End Of Comments -->
	
<!-- Share / Copy Link -->
<a href="javascript:void(0)" class='copy-text<?php echo $post_id; ?>' style='display:none'>http://findbestjodi.com/detailspost.php?posts=<?php echo $encoded_post_id; ?></a>
<a class="btn btn-default" href="javascript:void(0)" onclick="copyToClipboard('.copy-text<?php echo $post_id; ?>')" ><i class="fa fa-files-o" ></i> Share Link </a>
<script>
function copyToClipboard(element) 
{
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(element).text()).select();
	document.execCommand("copy");
	$temp.remove();
	alert('Link Copied To Clipboard-Share Anywhere!');
}
</script>		
<!-- End Of Link Copied To Clipboard -->
	
	
	 	