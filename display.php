<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){

		function showLap(json){

			var name = json.name;
			var lap = json.lap;
			var laptime = json.latest;

			$("#driver_lap").html("LAP "+lap);
			$("#driver_time span").html(laptime);
			$("#driver_name").html(name);

			for(var i=0; i<5; i++){
				$('#driver_time span').fadeIn(500);
				$('#driver_time span').fadeOut(500);
			}
							
			$("#lap_disp").animate({
				right: "0"
			}, 750, function(){
				setTimeout(hideLap, 3000);
			});
		}


		function hideLap(){			
			$("#lap_disp").animate({			
				right: "-100%"			
			}, 1000);			
		}

		function makeRequest(){

			$('#table_disp').load("display/display/p1.php");

			$.ajax({
				url: 'display/display/live_display.php',
				type: "GET",
				contentType: "application/json",	
				//data:json_data,
				success: function(response) {
					var json = $.parseJSON(response);
					//console.log(json);
					// $('#table_1').html("");
					// $('#table_2').html("");

					for(var i=0;i<json.length;i++){
						
						if(json[i].show){
							showLap(json[i]);
						}
						


						// var html = '<tr><td class="flex_name">'+json[i].name+'</td><td class="flex_score">'+json[i].best+'</td><td class="flex_score">'+json[i].total+'</td></tr>';
						// if(i<12){
						// 	$('#table_1').append(html);
						// }else{
						// 	$('#table_2').append(html);
						// }						
					}
				}
			});
		}


		function updateDisplay(){
			makeRequest();
			setInterval(function(){
				makeRequest();
			}, 1200);
		}

		updateDisplay();

		$('.btn').on('click',function(){
			showLap();
		})	
	});
	</script>

<!-- 	<style type="text/css">
		*{padding: 0;margin: 0;}

		@font-face {
			font-family: r_bold;
			src: url(css/fonts/RobotoMono-Bold.ttf);
		}
		@font-face {
			font-family: r_bold_italic;
			src: url(css/fonts/RobotoMono-BoldItalic.ttf);
		}		

		body{font-family: r_bold;background-color: rgb(22,22,22);}

		#wrapper{overflow: hidden;position: relative;width: 100%;height: 100vh;}

		#one{
			position: absolute;
			width: 100%;height: 100vh;z-index: 0;
		}
		#two{
			/*background-color: rgb(22,22,22);*/
			background-color: green;
			position: absolute;
			height: 100vh;
			width: 100%;
			right: -100%;			
		}

	</style> -->
	<style type="text/css">
		*{padding: 0;margin: 0;}
		

		@font-face {
			font-family: r_bold;
			src: url(css/fonts/RobotoMono-Bold.ttf);
		}
		@font-face {
			font-family: r_bold_italic;
			src: url(css/fonts/RobotoMono-BoldItalic.ttf);
		}
		@font-face {
			font-family: rub_light_italic;
			src: url(css/fonts/Rubik-LightItalic.ttf);
		}
		@font-face {
			font-family: rub_med_italic;
			src: url(css/fonts/Rubik-MediumItalic.ttf);
		}
		@font-face {
			font-family: rub_bold_italic;
			src: url(css/fonts/Rubik-BoldItalic.ttf);
		}
		
		@font-face {
			font-family: rub_black_italic;
			src: url(css/fonts/Rubik-BlackItalic.ttf);
		}

		body{font-family: r_bold;background-color: #0B0B38;z-index: 100;}
		#wrapper{overflow: hidden;position: relative;width: 100%;height: 100vh;}

		#table_disp{position: absolute;width: 100%;height: 100vh;z-index: 100;}

		#lap_disp{
			/*background-color: #0B0B38;*/
			background-color: #0A0A47;
			/*background-color: orange;*/
			position: absolute;
			height: 100vh;
			width: 100%;
			top: 0;
			right: -100%;
			/*right: 0;*/
			z-index: 200;		
		}
		/*driver*/
		#driver_main{position: fixed;height: 100vh;width: 100%;}		
		#driver_lap{
			/*background-color: #0B0B30;*/
			/*background-color: orange;*/
			font-size: 100px;
			padding-left: 310px;
			border-bottom: 1px solid #7A7511;
			padding-top: 60px;
			padding-bottom: 50px;
			color: #DDDDDD;font-family: rub_med_italic;font-style: italic;margin-top: 25px;
		}
		#driver_time{	
			background-color: #0B0B38;		
			padding-top: 30px;
			padding-bottom: 30px;
			text-align: center;
			font-size: 190px;
			border-bottom: 1px solid #7A7511; 			
			color: #FF4F4F;font-family: rub_med_italic;font-style: italic;
		}
		#driver_name{
			/*background-color: green;*/
			font-size: 70px;
			text-align: right;
			margin-right: 230px;margin-top: 40px;
			font-family: rub_bold_italic;font-style: italic;color: #FF4F4F;font-style: italic;
		}
		#driver_kart{
			font-size: 35px;
			text-align: right;
			margin-right: 235px;			
			font-family: rub_med_italic;font-style: italic;color: #DDDDDD;font-style: italic;
		}

		#line_holder_d_top{position: fixed;height: 100vh;width: 100%;background-color: #0B0B30;}
		#line_holder_d_bot{position: fixed;height: 34vh;width: 100%;margin-top: 66vh;background-color: #0A0A47;}
		.line_green_d_top{height: 8px;border-bottom: 1px solid #032826;}
		.line_green_d_bot{height: 8px;border-bottom: 1px solid #032826;}

		
		.flex{display: -webkit-flex;width: 100%;}
		/*.t_holder{width: 33.333%;background-color: green;}*/
		.t_holder{width: 50%;/*background-color: green;*/}
		.t_heading{color: #FF4F4F;font-family: rub_med_italic;font-size: 40px;/*background-color: yellow;*/height: 80px;line-height: 80px;text-align: center;font-style: italic;}
		.t_holder table{width: 80%;border-collapse: collapse;margin-right: auto;margin-left: auto;}
		.t_holder table td{/*border: 1px solid black;*/ height: 60px;
			/*background-color: orange;*/
		}

		.t_holder table tr:nth-child(odd){color: #DDDDDD;background-color: #080821;}
		.t_holder table tr:nth-child(even){color: rgb(180,180,180);}

		.t_no{padding-left: 18px;width: 50px;font-size: 18px;}
		.t_name{font-weight: 500;font-size: 20px;font-family: rub_med_italic;font-style: italic; }
		.t_time{width: 30%;text-align: right;padding-right: 24px;font-family: rub_bold_italic;font-style: italic; font-size: 22px;}


		#line_holder{position: absolute;height: 100vh;width: 100%;z-index: 0;}
		.line_green{height: 8px;border-bottom: 1px solid #032826;}
	</style>
</head>
<body>


<!-- <div id="wrapper">
	<div id="one">
		<div id="flex_parent">

			<div class="flex_2">
				<table id="table_1"></table>
			</div>

			<div class="flex_2">
				<table id="table_2"></table>
			</div>

		</div>
	</div>

	<div id="two">
		<div id="driver_main">
			<div id ="driver_lap"></div>
			<div id="driver_time"></div>
			<div id="driver_name"></div>
		</div>
	</div>
</div> -->

<div id="wrapper">
	<!-- <button class="btn">Click</button> -->
	<div id="table_disp">
		<div class="t_heading">TODAYS TOP 20</div>
		<div class="flex">	
			<div class="t_holder">
				<table>
				<?php
				for ($i=0; $i < 11; $i++) { 
					echo '<tr><td class="t_no">'.($i+1).'</td><td class="t_name">NARENDRA</td><td class="t_time">1.32.748</td></tr>';
				}
				?>
				</table>
			</div>

			<div class="t_holder">
				<table>
				<?php
				for ($i=0; $i < 11; $i++) { 
					echo '<tr><td class="t_no">'.($i+12).'</td><td class="t_name">VENKATESHWARA</td><td class="t_time">1.32.748</td></tr>';
				}
				?>
				</table>
			</div>	
		</div>
	</div>

	<div id="lap_disp">

		<div id="line_holder_d_top">
			<?php
			for ($i=0; $i < 27; $i++) {
				echo '<div class="line_green_d_top"></div>';
			}
			?>
		</div>

		<div id="line_holder_d_bot">
			<?php
			for ($i=0; $i < 28; $i++) {
				echo '<div class="line_green_d_bot"></div>';
			}
			?>
		</div>


		<div id="driver_main">	
			<div id="driver_lap">LAP 3</div>
			<div id="driver_time" class="blink"><span>0.45.456</span></div>
			<div id="driver_name">NARENDRA</div>
			<div id="driver_kart">KART 01</div>
		</div>
	</div>
</div>

</body>
</html>