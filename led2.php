<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			// alert('working');

			function blinkTime(){
				counter = 0;
				for(var i=0;i<3;i++){
					$('#time2').fadeOut(300);
					$('#time2').fadeIn(300,function(){
							++counter;
							if(counter == 2){
								console.log('done');
								// blinkTime();
							}							
							
					});
				}				
						
			}


			function blinkKartNum(){
				$('#time2').hide();
				$('#k_no').show();
				var counter = 0;
				for(var i=0;i<3;i++){
					$('#k_no').fadeOut(300);
					$('#k_no').fadeIn(300, function(){
						++counter;
						if(counter == 3){
							console.log('done');
							$('#k_no').hide();
							$('#time2').show();
							blinkTime();
						}
					});

				}				
			}

			function blink(){
				blinkKartNum();
				// blinkTime();
				// alternate();
			}


			function blink_final_k(){
				var counter = 0;
				for(var i=0;i<2;i++){
					$('#k_no_final').fadeOut(200);
					$('#k_no_final').fadeIn(200, function(){
						++counter;
						if(counter == i){
							console.log('done');
							blink_final_t();
						}
					});

				}
			}

			function blink_final_t(){
				var counter = 0;
				for(var i=0;i<2;i++){
					$('#time_final').fadeOut(200);
					$('#time_final').fadeIn(200, function(){
						++counter;
						if(counter == i){
							console.log('done');
							// blink_final_t();
						}
					});

				}
			}

			// setInterval(blink(), 5000);


			setInterval(blink_final_k(), 5000);

			// toggle();


		});
	</script>
	<!-- <link href="https://fonts.googleapis.com/css?family=Rubik:500i,700i" rel="stylesheet"> -->
	<style type="text/css">
	@font-face {
		font-family: rub;
		src: url(css/fonts/Rubik-Medium.ttf);
	}


	*{padding: 0;margin: 0;font-family: 'rub', sans-serif;font-weight: 500;color: #DDDDDD;}
	body{background-color: #343434;}
	.screen{
		height: 128px;width: 256px;background-color: black;margin-top: 50px;margin-left: 50px;
		/*background: radial-gradient( #343434 15%, #000 50%);*/
		background: linear-gradient(#0B0B38, #000);
		/*background: linear-gradient(#000, #0B0B38);*/
	}
	#lap{/*background-color: green;*/padding-left: 63px;padding-top: 10px;border-bottom: 1px solid #7A7511;}
	#time{font-size: 30px;color: #FF4F4F;text-align: center;border-bottom: 1px solid #7A7511;}
	#name{text-align: right;margin-right: 50px;}
	#kart{text-align: right;margin-right: 55px;}
	/*0B0B38*/


	#holder{font-size: 19px;padding-top: 10px;padding-bottom: 5px;}
	#lap2{display: inline-block;padding-left: 48px; width: 80px;}
	#kart2{display: inline-block;width: 90px;text-align: right;padding-right: 38px;}
	#time2{
		color: #FF4F4F;
		position: fixed;
		width: 256px;
		padding-top: 0px;
		padding-bottom: 0px;
		font-size: 40px;color: #FF4F4F;text-align: center;border-bottom: 1px solid #343207;border-top: 1px solid #343207;
	}
	#name2{font-size: 19px;padding-left: 40px;padding-top: 7px;}

	.mid_stuff{
		padding-top: 0px;
		padding-bottom: 0px;
		font-size: 40px;color: #FF4F4F;text-align: center;border-bottom: 1px solid #343207;border-top: 1px solid #343207;
	}

	#k_no{position: fixed;
		color: white;
	padding-top: 0px;
	width: 256px;
		padding-bottom: 0px;
		font-size: 40px;text-align: center;border-bottom: 1px solid #343207;border-top: 1px solid #343207;}


	/*#k_no{visibility: hidden;}*/
	/*#time2{display: none;}*/
	/*#k_no{display: none;}*/
	</style>
</head>
<body>
<!-- 
fonts
rubik - numerals


cabin, nunito, nunito-sans 
-->
<div class="screen">
	<div id="lap">LAP 4</div>
	<div id="time">0:45:345</div>
	<div id="name">NARENDRA</div>
	<div id="kart">KART 1</div>
</div>

<div class="screen" style="overflow: hidden;">
	<div id="holder"><div id="lap2"></div><div id="kart2"></div></div>	
	<div class="mid_stuff">
		<div id="time2">0:45:345</div>
		<div id="k_no">K 2</div>
	</div>
	<div id="name2"></div>	
</div>


<div class="screen" style="overflow: hidden;">
	<div id="k_no_final" style="font-size: 60px;padding-top: 8px;padding-left: 10px;">K2</div>
	<div id="time_final" style="font-size: 40px;color: #FF4F4F;margin-top: -8px;padding-left: 10px;">0:45:345</div>
</div>


<!-- <div id="time3">0:45:345</div>
<div id="k_no3">K 2</div> -->

</body>
</html7