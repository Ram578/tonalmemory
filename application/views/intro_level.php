<?=$Header;?>	
<?php
	$arrAvailableLevels = $this->config->item('AvailableLevels'); 

	$intNextLevel = $CurrentLevel+1;

	$hasNextLevel = false;

	if(in_array($intNextLevel, $arrAvailableLevels))
	{
		$hasNextLevel = true;
	}
?>

	<!-- Body content goes here -->
		<section class="intro-wrapper tonal-test-wrapper">
				<div class="container">
					
					<?php
						 if($CurrentLevel == 4)
						 {
						?>
						 
						 	<div class="level-intro-view">
							 <audio id="LevelAudio" class="audio-control" controls="controls" runat="server" autoplay>
							   <source id="" src='<?=base_url();?>resources/audio/level-intro/level_4.wav' ></source>
							</audio>
								<div class="tonal-test-view text-center">
								
									<div class="option-view">
										 <input id="1" type="radio" name="SelectOption" class="radiobtn-custom-blue custom-radio-button" />
										 <label  for="1" class="btn-blue">1</label>
									 </div>
									 <div class="option-view">
										 <input id="2" type="radio" name="SelectOption" class="radiobtn-custom-blue custom-radio-button" />
										 <label  for="2" class="btn-blue">2</label>
									 </div>
									 <div class="option-view">
										 <input id="3" type="radio" name="SelectOption" class="radiobtn-custom-blue custom-radio-button" />
										 <label  for="3" class="btn-blue">3</label>
									 </div>
									 <div class="option-view">
										 <input id="4" type="radio" name="SelectOption" class="radiobtn-custom-blue custom-radio-button" />
										 <label  for="4" class="btn-blue">4</label>
									 </div>
									
								
							</div>
							</div>
						 
						<?php
						 }elseif($CurrentLevel == 5){
						?>
						 <div class="level-intro-view">
							 <audio id="LevelAudio" class="audio-control" controls="controls" runat="server" autoplay>
							   <source id="" src='<?=base_url();?>resources/audio/level-intro/level_5.wav' ></source>
							</audio>
								<div class="tonal-test-view text-center">
								
									<div class="option-view">
										 <input id="1" type="radio" name="SelectOption" class="radiobtn-custom-green custom-radio-button" />
										 <label  for="1" class="btn-green">1</label>
									 </div>
									 <div class="option-view">
										 <input id="2" type="radio" name="SelectOption" class="radiobtn-custom-green custom-radio-button" />
										 <label  for="2" class="btn-green">2</label>
									 </div>
									 <div class="option-view">
										 <input id="3" type="radio" name="SelectOption" class="radiobtn-custom-green custom-radio-button" />
										 <label  for="3" class="btn-green">3</label>
									 </div>
									 <div class="option-view">
										 <input id="4" type="radio" name="SelectOption" class="radiobtn-custom-green custom-radio-button" />
										 <label  for="4" class="btn-green">4</label>
									 </div>
									<div class="option-view">
										 <input id="4" type="radio" name="SelectOption" class="radiobtn-custom-green custom-radio-button" />
										 <label  for="4" class="btn-green">5</label>
									 </div>
								
							</div>
							</div>
						<?php
						 }elseif($CurrentLevel == 6){
						?>
						 
						  <div class="level-intro-view">
							 <audio id="LevelAudio" class="audio-control" controls="controls" runat="server" autoplay>
							   <source id="" src='<?=base_url();?>resources/audio/level-intro/level_6.wav' ></source>
							</audio>
								<div class="tonal-test-view text-center">
								
									<div class="option-view">
										 <input id="1" type="radio" name="SelectOption" class="radiobtn-custom-yellow custom-radio-button" />
										 <label  for="1" class="btn-yellow">1</label>
									 </div>
									 <div class="option-view">
										 <input id="2" type="radio" name="SelectOption" class="radiobtn-custom-yellow custom-radio-button" />
										 <label  for="2" class="btn-yellow">2</label>
									 </div>
									 <div class="option-view">
										 <input id="3" type="radio" name="SelectOption" class="radiobtn-custom-yellow custom-radio-button" />
										 <label  for="3" class="btn-yellow">3</label>
									 </div>
									 <div class="option-view">
										 <input id="4" type="radio" name="SelectOption" class="radiobtn-custom-yellow custom-radio-button" />
										 <label  for="4" class="btn-yellow">4</label>
									 </div>
									<div class="option-view">
										 <input id="4" type="radio" name="SelectOption" class="radiobtn-custom-yellow custom-radio-button" />
										 <label  for="4" class="btn-yellow">5</label>
									 </div>
									 <div class="option-view">
										 <input id="4" type="radio" name="SelectOption" class="radiobtn-custom-yellow custom-radio-button" />
										 <label  for="4" class="btn-yellow">6</label>
									 </div>
								
							</div>
							</div>
						 
						<?php
						 }
						?>
					
				</div>
				<div class="row NextButtonWrapper" style="display:none;">
						<a id="aNextButtonWrapper" href="<?=base_url();?>tonaltest/?level=<?=$CurrentLevel;?>">NEXT</a>
                    </div>
		</section>
	<!-- Body content ends here -->
	
	<!-- JS files will load here -->
	<script type="text/javascript" src="<?=base_url();?>resources/js/intro_level.js"></script>
<?=$Footer;?>
