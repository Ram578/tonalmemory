			$('document').ready(function(){
				   // More Info Audio
				
					var innerHTML = "<source src='audio/moreinfo/1.wav'></source>";
					ctrlaudioMoreInfo.InnerHtml = innerHTML;
					hdTuneMoreInfoNames = "audio/moreinfo/1.wav" + "," + "audio/moreinfo/2.wav" + "," + "audio/moreinfo/3.wav" + "," + "audio/moreinfo/4.wav" + "," + "audio/moreinfo/5.wav" + "," + "audio/moreinfo/6.wav" + "," + "audio/moreinfo/7.wav";
					hdImgNames = "img/moreinfo/1.jpg" + "," + "img/moreinfo/2.jpg" + "," + "img/moreinfo/3.jpg" + "," + "img/moreinfo/4.jpg" + "," + "img/moreinfo/5.jpg" + "," + "img/moreinfo/6.jpg" + "," + "img/moreinfo/7.jpg";
					$(function () {
					 //Find the audio control on the page
					   var audio = document.getElementById('ctrlaudioMoreInfo');
					   var ImgCount = document.getElementById('ctrlcount');
					   //songNames holds the comma separated name of songs
					   var TuneNamesMoreInfo = hdTuneMoreInfoNames;
					   var ImgNames = hdImgNames;
					   var lstTuneMoreInfoNames = TuneNamesMoreInfo.split(',');
					   var lstImgNames = ImgNames.split(',');
					   var curPlaying = 0;
					   var ImgPlaying = 0;
					   // Attaches an event ended and it gets fired when current playing song get ended
					   audio.addEventListener('ended', function() {
						//alert(lstTuneMoreInfoNames.length);
						   if (curPlaying + 1 == lstTuneMoreInfoNames.length ) {
							  $('.intro-screen-01').fadeIn();
							   $('.intro-wrapper .img-view').fadeOut();
						   }
						    
						   var urls = audio.getElementsByTagName('source');
						   // Checks whether last song is already run
						   if (urls[0].src.indexOf(lstTuneMoreInfoNames[lstTuneMoreInfoNames.length - 1]) == -1) {
							   //replaces the src of audio song to the next song from the list
							   urls[0].src = urls[0].src.replace(lstTuneMoreInfoNames[curPlaying], lstTuneMoreInfoNames[++curPlaying]);
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