<?=$Header;?>
<!-- Body content goes here -->
<section class="intro-wrapper nextbranch-view">
		<div class="container">
			<div class="row">
                <!-- When the page loads Audio will auto play -->
                <audio id="ctrlaudioNewExample" class="audio-control" controls="controls" runat="server" autoplay>
                       <source src='resources/audio/new-example/1.wav'></source>
                </audio>
            <!-- Audio Play count list -->
                <div id="ctrlcount" class="text-center img-view">
                    <img src="resources/img/new-example/1.jpg" alt="" title="" />        
                </div>
            <!-- Auido Play count list ends here -->
            
            <!-- Next and New example Buttons will appear once the Audio will finish -->
                <!-- Screen to check next or new example -->
                <div class="intro-screen-01  col-md-8 col-sm-8 col-xs-8 col-md-offset-2 col-sm-offset-2 col-xs-offset-2" style="display:none;">
                    <a href="tonaltest?level=3" class="next-button col-md-4 col-sm-4 col-xs-4 text-center col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Start</a>
                     <a href="newexampleinfo" class="blue-button more-info col-md-5 col-sm-5 col-xs-5 text-center col-md-offset-1 col-sm-offset-1 col-xs-offset-1">More Information</a>
                </div>
			
                <!-- Screen to check next or new example ends -->
            </div>
		</div>
</section>
<!-- Body content ends here -->
<!-- JS files will load here -->
<script type="text/javascript" src="<?=base_url();?>resources/js/new_example.js"></script>
<?=$Footer;?>