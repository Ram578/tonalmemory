    $('document').ready(function(){
					var innerHTML = "<source src='audio/1.wav'></source>";
					ctrlaudio.InnerHtml = innerHTML;
					//ctrlcount.InnerHtml = innerHTML;
					hdTuneNames = "audio/introduction/1.wav" + "," + "audio/introduction/2.wav" + "," + "audio/introduction/3.wav" + "," + "audio/introduction/4.wav" + "," + "audio/introduction/5.wav";
					hdImgNames = "img/introduction/12.jpg" + "," + "img/introduction/2.jpg" + "," + "img/introduction/3.jpg" + "," + "img/introduction/4.jpg" + "," + "img/introduction/52.jpg";
					$(function () {
					 //Find the audio control on the page
					   var audio = document.getElementById('ctrlaudio');
					   var ImgCount = document.getElementById('ctrlcount');
					   //songNames holds the comma separated name of songs
					   var TuneNames = hdTuneNames;
					   var ImgNames = hdImgNames;
					   var lstTuneNames = TuneNames.split(',');
					   var lstImgNames = ImgNames.split(',');
					   var curPlaying = 0;
					   var ImgPlaying = 0;
					   // Attaches an event ended and it gets fired when current playing song get ended
					   audio.addEventListener('ended', function() {
						//alert(lstTuneNames.length);
						   if (curPlaying + 1 == lstTuneNames.length ) {
							  $('.intro-screen-01').show();
							  $('.intro-wrapper .img-view').hide();
						   }
						    
						   var urls = audio.getElementsByTagName('source');
						   // Checks whether last song is already run
						   if (urls[0].src.indexOf(lstTuneNames[lstTuneNames.length - 1]) == -1) {
							   //replaces the src of audio song to the next song from the list
							   urls[0].src = urls[0].src.replace(lstTuneNames[curPlaying], lstTuneNames[++curPlaying]);
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