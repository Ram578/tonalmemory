<?=$Header;?>
<script type="text/javascript">
	var arrQuestions = <?php echo json_encode($Questions); ?>
</script>
<!-- Body content goes here -->
<section class="intro-wrapper tonal-test-wrapper">
		<div class="container">
			<?php foreach($Questions as $key=>$question){ if($key == 0){ ?>
			<div class="row">
				<input type="hidden" id="hdnQuestionNo" value="<?=$key;?>" />

			 <!-- When the page loads Audio will auto play -->
                <audio id="TestAudioData" class="audio-control" controls="controls" runat="server" autoplay>
                       <source id="srcAudioPath" src='<?php echo base_url().$question["audiopath"];?>' ></source>
                </audio>

            <!-- Audio Play count list -->
				 <h1 id="h1QuestionCode" class="text-center color-white"><?=$question['questioncode'];?></h1>
				 <!-- Acutal test starts here -->
					<div class="tonal-test-view text-center">
						<?php
							for($intCtr = 1; $intCtr <= $question['optionscount']; $intCtr++)
							{
						?>
							<div class="option-view">
								 <input data-role-id="<?=$question['id'];?>" data-role-option="<?=$intCtr;?>" id="id_<?=$intCtr;?>" type="radio" name="SelectOption" class="radiobtn-custom-<?=$question['optioncolor']?> custom-radio-button" />
								 <label id="lbl_<?=$intCtr;?>" for="id_<?=$intCtr;?>" class="btn-<?=$question['optioncolor']?>"><?=$intCtr;?></label>
							 </div>
						<?php
							}
						?>
					</div>
				 <!-- Actual test ends here -->
					<div class="alert alert-danger text-center col-md-6 col-sm-6 col-xs-6 col-md-offset-3 col-sm-offset-3 col-xs-offset-3" style="display:none; position:absolute;">
					  <strong>Why haven’t you made a response! <br> Make a guess!</br></strong> 
					</div>
					<div class="alert alert-warning text-center col-md-4 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4" style="display:none; position:absolute;">
					  <strong> You have not answered the last problem. <br> <br> If you are having a problem and cannot continue, please talk to an AIMS staff member <font size="4"> Immediately! </font> </strong> 
					</div>
					<div class="alert alert-success text-center col-md-4 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4" style="display:none; position:absolute;">
					  <strong>The test will be terminated in another 20 seconds.!</strong> 
					</div>
            </div>
            <?php } } ?>
		</div>
		<?php
			$arrAvailableLevels = $this->config->item('AvailableLevels'); 

			$intNextLevel = $CurrentLevel+1;

			$hasNextLevel = false;

			if(in_array($intNextLevel, $arrAvailableLevels))
			{
				$hasNextLevel = true;
			}
		?>
		<div class="NextButtonWrapper" style="display:none;">
			<a id="aNextButtonWrapper" href="<?php if($hasNextLevel){ echo base_url().'introlevel/?level='.$intNextLevel; }else{ echo base_url().'thankyou'; } ?>" ><?php if($hasNextLevel){ echo "Next"; }else{ echo "Finish"; } ?></a> 
		</div>
</section>
<!-- Body content ends here -->

<!-- JS files will load here -->
<script type="text/javascript" src="<?=base_url();?>resources/js/Itemtest.js"></script>
<?=$Footer;?>