<!DOCTYPE html>
<html>
<head>
	<title>I-Frame</title>
	<style type="text/css">
		@font-face {
			font-family: rub;
			src: url(css/fonts/Rubik-Medium.ttf);
		}
		*{padding: 0;margin: 0;}
		body{background-color: #343434;font-family: 'rub', sans-serif;font-weight: 500;color: #DDDDDD;}
		.main_4{
			width: 33.33%;display: inline-block;height: 50vh;margin-right: -4px;
			vertical-align: top;
			position: relative;
			text-align: center;			
			background: linear-gradient(#0B0B38, #000);
		}
		.center_shit{font-size: 4em;}

		#test_time{}

		iframe{width: 100%; height: 100%; border: none; margin: 0; padding: 0;}
	</style>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="js/easytimer.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			var height = $('.main_4').height();
			console.log(height);
			$('.center_shit').css("line-height", ($('.main_4').height()+"px"));

			var count = 5;
			var countTimer = 0;
			var time_left = 30;

			function beginCountDown(){
				// $('#test_time').text('5');
				var timer1 = new Timer();
				timer1.start({countdown: true, startValues: {seconds: 5}});
				timer1.addEventListener('secondsUpdated', function (e) {
					// $('#test_time').html(timer1.getTimeValues().toString());
					$('#test_time').html(timer1.getTotalTimeValues().seconds);					
				});
				timer1.addEventListener('targetAchieved', function (e) {
					console.log('done!');
					mainTime();
				});
			}

			// beginCountDown();
			// // beginTime(time);			


			function mainTime(){
				var timer = new Timer();
				// timer.start({countdown: true, startValues: {seconds: 5}});
				// timer.start({countdown: true, startValues: {minutes: 10}});
				timer.start({countdown: true, startValues: {hours: 2}});
				timer.addEventListener('secondsUpdated', function (e) {
					$('.basicUsage').html(timer.getTimeValues().toString());
				});

				timer.addEventListener('targetAchieved', function (e) {
					console.log('done!');
				});	
			}
			// mainTime();


			setInterval(function(){
				$.ajax({
					url: 'exe/get_color.php',
					type: 'GET',										
					success: function(response){						
						console.log(response);
						switch(response){
						case "red":
							$('#change_bg').css("background", "red");
							break;

						case "green":
							$('#change_bg').css("background", "green");
							break;

						case "yellow":
							$('#change_bg').css("background", "yellow");
							break;

						case "finish":
							$('#change_bg').css("background-image", "url('css/flag.jpg')");
							break;
						}
					}
				});
			}, 1500);


			$('button').on('click', function(){
				switch(this.id){
					case "btn_green":
						$('#change_bg').css("background", "green");
						break;
					case "btn_red":
						$('#change_bg').css("background", "red");
						break;
					case "btn_yellow":
						$('#change_bg').css("background", "yellow");
						break;
					case "btn_finish":
						$('#change_bg').css("background-image", "url('css/flag.jpg')");			
						break;
					case "btn_start":
						mainTime();
						break;
				}
			});
			
		});
	</script>
</head>
<body>


<!-- iteration 3 -->
<div class="main_4" id="change_bg"></div>

<div class="main_4" style="background-color: blue;">
	<div class="center_shit"><div class="basicUsage">02:00:00</div></div>
</div>

<div class="main_4" style="background-color: blue;">
	<div class="center_shit"><div class="basicUsage">02:00:00</div></div>
</div>



<div class="main_4">
	<button id="btn_green">Green</button>
	<button id="btn_yellow">Yellow</button>
	<button id="btn_red">Red</button>
	<button id="btn_finish">Finish</button>
	<button id="btn_start">Start</button>
</div>



<!-- <iframe src="https://www.mylaps.com/"></iframe> -->

</body>
</html>