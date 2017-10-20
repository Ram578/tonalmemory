			$('document').ready(function(){
				   // More Info Audio
				
					var innerHTML = "<source src='audio/new-example/1.wav'></source>";
					ctrlaudioNewExample.InnerHtml = innerHTML;
					hdTuneMoreInfoNames = "audio/new-example/1.wav" + "," + "audio/new-example/2.wav" + "," + "audio/new-example/3.wav" + "," + "audio/new-example/4.wav" + "," + "audio/new-example/5.wav" + "," + "audio/new-example/6.wav" + "," + "audio/new-example/7o.wav" + "," + "audio/new-example/new41.wav";
					hdImgNames = "img/new-example/1.jpg" + "," + "img/new-example/2.jpg" + "," + "img/new-example/3.gif" + "," + "img/new-example/4.jpg" + "," + "img/new-example/5.jpg" + "," + "img/new-example/6.gif" + "," + "img/new-example/71ori.jpg" + "," + "img/new-example/dummy.jpg";
					$(function () {
					 //Find the audio control on the page
					   var audio = document.getElementById('ctrlaudioNewExample');
					   var ImgCount = document.getElementById('ctrlcount');
					   //songNames holds the comma separated name of songs
					   var TuneNamesexample = hdTuneMoreInfoNames;
					   var ImgNames = hdImgNames;
					   var lstTuneExampleInfo = TuneNamesexample.split(',');
					    var lstImgNames = ImgNames.split(',');
					   var curPlaying = 0;
					   var ImgPlaying = 0;
					   // Attaches an event ended and it gets fired when current playing song get ended
					   audio.addEventListener('ended', function() {
						//alert(lstTuneExampleInfo.length);
						   if (curPlaying + 1 == lstTuneExampleInfo.length ) {
							  $('.intro-screen-01').show();
							  $('.intro-wrapper .img-view').hide();
							  
						   }
						    
						   var urls = audio.getElementsByTagName('source');
						   // Checks whether last song is already run
						   if (urls[0].src.indexOf(lstTuneExampleInfo[lstTuneExampleInfo.length - 1]) == -1) {
							   //replaces the src of audio song to the next song from the list
							   urls[0].src = urls[0].src.replace(lstTuneExampleInfo[curPlaying], lstTuneExampleInfo[++curPlaying]);
							   //Loads the audio song
							   audio.load();
							   //Plays the audio song
							   audio.play();
							}
							
							var Imgurls = ImgCount.getElementsByTagName('img');
						   // Checks whether last song is already run
						   if (Imgurls[0].src.indexOf(lstImgNames[lstImgNames.length - 1]) == -1) {
							   //replaces the src of audio song to the next song from the list
							   Imgurls[0].src = Imgurls[0].src.replace(lstImgNames[ImgPlaying], lstImgNames[++ImgPlaying]);
							  
							}
							
						 });
				   });
				   
				});