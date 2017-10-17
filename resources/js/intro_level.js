			$('document').ready(function(){
					$(function () {
					 //Find the audio control on the page
					   var audio = document.getElementById('LevelAudio');
					   // Attaches an event ended and it gets fired when current playing song get ended
					   audio.addEventListener('ended', function() {
						//alert(lstTuneNames.length);
						   $('.tonal-test-wrapper .tonal-test-view .option-view label').css('pointer-events','inherit');
						   window.location.href = $('#aNextButtonWrapper').attr('href');
					 	 });
				   });
				});