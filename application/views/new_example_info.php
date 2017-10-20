<?=$Header;?>	
	<!-- Body content goes here -->
		<section class="intro-wrapper nextbranch-view">
				<div class="container">
					<div class="row">
                        <!-- When the page loads Audio will auto play -->
                        <audio id="ctrlaudioNewExampleInfo" class="audio-control" controls="controls" runat="server" autoplay>
                               <source src='resources/audio/moreinfo/1.wav'></source>
                        </audio>
                     <!-- Audio Play count list -->
                        <div id="ctrlcount" class="text-center img-view">
                            <img src="resources/img/moreinfo/1.jpg" alt="" title="" />        
                        </div>
                    <!-- Auido Play count list ends here -->
                    
                    <!-- Next and New example Buttons will appear once the Audio will finish -->
                        <!-- Screen to check next or new example -->
                        <div class="intro-screen-01  col-md-12 col-sm-12 col-xs-12 text-center" style="display:none;">
                            <a href="tonaltest?level=3" class="next-button">Start</a>
                          
                        </div>
                        <!-- Screen to check next or new example ends -->
                    </div>
				</div>
		</section>
	<!-- Body content ends here -->
	
	<!-- JS files will load here -->
	
	<script type="text/javascript" src="<?=base_url();?>resources/js/new_exampleinfo.js"></script>
<?=$Footer;?>