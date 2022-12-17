<script>

pinger = function ping() {
    console.log("Ping");
    $.ajax({
        type:'GET',
        url:'/chat/public/ping',
        success:function(data)
        {
          
            result = JSON.parse(data);

            // Incrementing Message Count
            if (parseInt(result.unreadConvo) > 0) {
                // Check if the any convo thing increase
                previouscount = $("#messageCounted").text();
                if (parseInt(result.unreadConvo) > parseInt(previouscount)) {
                    notify("FindBestJodi", "Someone trying to contact you... Click to respond.", "/chat/public");
                }
                $("#messageCounted").text(result.unreadConvo);
                $("#messageCounted").show();
                $("#messageCount").text(result.unreadConvo);
                $("#messageCount").show();

                

            } else{
                $("#messageCounte").text(result.unreadConvo);
                $("#messageCount").hide();
                $("#messageCounted").text(result.unreadConvo);
                $("#messageCounted").hide();
            }

            console.log(result);
        },
        error: function() {
            console.log("Error while Ping");
        }
    });
}
pinger();
setInterval( pinger,  10 * 1000);
</script>

<!-- Footer -->
<footer id="fh5co-footer">
	<div class="container">
		<div class="row row-padded">
			<div class="col-md-12 text-center">
				<p><small>&copy; <a href="http://www.omgroupofitsolutions.in">OM GROUP OF IT SOLUTIONS</a> | CO-PRODUCT OF: <a href="https://www.ourmedia.in" target="_blank">OURMEDIA</a></small></p>
			</div>
		</div>
	</div>
</footer>
<!-- End Of Footer -->

<!-- Up Arrow -->
<a href="javascript:void(0);" style="float:right;background-color:white;" onclick="$('html, body').animate({ scrollTop: 0 }, 500);" class="topbtn"><i class="fa fa-angle-up"></i></a>

<script>
$(document).ready(function() {
$(window).scroll(function() {    
    var scrolls = $(window).scrollTop();   
	if (scrolls > 50) {
        $(".catebar1").slideUp();
    }else{
		$(".catebar1").slideDown();
	}
});
});
</script>
<!-- End Of Up Arrow -->

