var showAlert;

var showGuessAlert;

function fnSaveUserAnswer(questionid, selectedoption)
{
	$.ajax({
		'type'		: 'POST',
		'url'		: strBaseURL+'tonaltest/saveuseranswer', 
		'ajax' 		: true,
		'data' 		: { questionid : questionid, selectedoption : selectedoption },
		'success' 	: function(){},
		'failure' 	: function(){}
	});
}

function fnShowAlert()
{
	clearInterval(showAlert);

	clearTimeout(showGuessAlert);

	$('.alert-danger').fadeIn().delay(3000).fadeOut(100);
			
	showGuessAlert = setTimeout(function(){
		$('.alert-warning').fadeIn().delay(9000).fadeOut(100);
	}, 12000);
}

$('document').ready(function(){
	
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

$(document).on("keydown", disableF5);
	
   // More Info Audio
   setTimeout(function(){
		$(function () {
		 //Find the audio control on the page
		   var audioPlay = document.getElementById('TestAudioData');
		  // Attaches an event ended and it gets fired when current playing song get ended
		   audioPlay.addEventListener('ended', function() {

		   		clearInterval(showAlert);

				clearTimeout(showGuessAlert);
				
				//Enable the radio buttons
				$(":radio[name='SelectOption']").attr("disabled", false);

				$('.tonal-test-wrapper .tonal-test-view .option-view label').css('pointer-events','inherit');

				showAlert = setInterval(function(){
					fnShowAlert();
				},8000);
		   });

	   });
   },200);

   $("input.custom-radio-button").bind('click', function()
	{	

		if(!$("input.custom-radio-button:checked").val()) {
			fnShowAlert();			
		}
		else
		{
			clearInterval(showAlert);

			clearTimeout(showGuessAlert);

			fnSaveUserAnswer($("input.custom-radio-button:checked").attr("data-role-id"), $("input.custom-radio-button:checked").attr("data-role-option"));
			
			//Disable the radio buttons
			$(":radio[name='SelectOption']").attr("disabled", true);
			
			setTimeout(function(){
				
				if((parseInt($("#hdnQuestionNo").val())+1) == arrQuestions.length)
				{	
					//Check the subscore functionality.
					if(subscore_status.subscore_check == 1) 
					{
						var nextLevel = Number(CurrentLevel)+1;
						for(var i=0;i<subScores.length;i++) {
							if(nextLevel == subScores[i].level) {
								var minScore = subScores[i].min_score;
								var maxScore = subScores[i].max_score;
								$.ajax({
									'type'		: 'POST',
									'url'		: strBaseURL+'tonaltest/get_user_score', 
									'ajax' 		: true,
									'success' 	: function(response){
													if(response <= minScore || response >= maxScore) 
													{
														$("#test-completed").trigger('click');
														window.location.href = $("#aNextButton").attr('href');
													} else {
														$("#test-completed").trigger('click');
														setTimeout(function(){
															window.location.href = $("#aNextButtonWrapper").attr('href');
														},2000);
													}
												},
									'failure' 	: function(){}
								});
							}
						}
					
					} else {
						//$('.NextButtonWrapper').show();
						$("#test-completed").trigger('click');
						setTimeout(function(){
							window.location.href = $("#aNextButtonWrapper").attr('href');
						},2000);
					}
				}
				
				var intNextQuestion = parseInt($("#hdnQuestionNo").val())+1;

				if(arrQuestions.length > intNextQuestion)
				{
					$("#hdnQuestionNo").val(intNextQuestion);

					$("#TestAudioData").attr('src', strBaseURL+arrQuestions[intNextQuestion].audiopath);

					$("input.custom-radio-button").attr("checked",false);

					for(var intCtr = 1; intCtr<= arrQuestions[intNextQuestion].optionscount; intCtr++)
					{
						$("#id_"+intCtr).attr('data-role-id', arrQuestions[intNextQuestion].id);

						$strOldClass = $("#id_"+intCtr).attr('class');

						$("#id_"+intCtr).removeClass($strOldClass);

						$("#id_"+intCtr).addClass('radiobtn-custom-'+arrQuestions[intNextQuestion].optioncolor);

						$("#id_"+intCtr).addClass('custom-radio-button');

						$strLblClass = $("#lbl_"+intCtr).attr("class");

						$("#lbl_"+intCtr).removeClass($strLblClass);

						$("#lbl_"+intCtr).addClass('btn-'+arrQuestions[intNextQuestion].optioncolor);

					}
					
					$('.tonal-test-wrapper .tonal-test-view .option-view label').css('pointer-events','none');

					audioPlay1 = document.getElementById('TestAudioData');

					audioPlay1.play();

					$("#h1QuestionCode").html(arrQuestions[intNextQuestion].questioncode);
				}
		
			}, 1000);
		}
	});
	
	// Save the test completed date in pitch_users table in db through ajax.
	$( "#test-completed" ).on("click", function() {
		$.ajax({
			'type'		: 'POST',
			'url'		: strBaseURL+'tonaltest/save_test_completed_date', 
			'ajax' 		: true,
			'data' 		: { 'test_status' : 'completed' },
			'success' 	: function(){},
			'failure' 	: function(){}
		});
			
	});

});