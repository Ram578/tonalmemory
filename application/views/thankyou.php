<?=$Header;?>
<!-- Body content goes here -->
<section class="intro-wrapper nextbranch-view" style="background:#f4b081 url('resources/img/ribbon.png') repeat-x;">
		<div class="container">
			<div class="row">
				<div class="thankyou-view">
					<div class="thankyou_01">
						<h1 style="color:#000; font-size:36px; line-height:50px;">
							You have completed the AIMS Tonal Memory exercise. You correctly answered <span style="color:#ff0000;"><?=$CorrectAns;?></span> of the <span style="color:#ff0000;"><?=$NoOfQtsAttempted;?></span> items.
						</h1>
						<h2 class="color-white" style="color:#000; font-size:36px;  line-height:50px;">
							This indicates that you have <span class="color:"><?=$Grade;?></span> Tonal Memory ability. 
						</h2>
					</div>
					<div class="thankyou_02 text-center">
						<p class="color-white" style="font-size:42px; padding:10px 0;">Thank you for your effort!</p>
						<p class="color-white" style="font-size:42px; padding:10px 0; text-decoration:underline; color:#1f3864;">Continue with any unfinished work..</p>
					</div>
				</div>
            </div>
		</div>
</section>
<!-- Body content ends here -->
<!-- JS files will load here -->
<script type="text/javascript">
	$(document).ready(function(){
		
		 $(".thankyou_01, .thankyou_02").hide();
			timer = setTimeout(function () {
				$('.thankyou_01').show();
			}, 100);
			timer = setTimeout(function () {
				$('.thankyou_02').show();
				$('.thankyou_01').hide();
			}, 15000);
			
		
		setTimeout(function(){
			$.ajax({
				'type'		: 'POST',
				'url'		: strBaseURL+'thankyou/logout', 
				'ajax' 		: true,
				'data' 		: {},
				'success' 	: function(response){ window.location.href = strBaseURL; },
				'failure' 	: function(){}
			});
		},25000);
	});
</script>
<?=$Footer;?>