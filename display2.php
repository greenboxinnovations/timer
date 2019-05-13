<!DOCTYPE html>
<html>
<head>
	<title>Display</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){

		var interval = null;		
		var cameraCheck = false;

		function blinkFunction(){
			
			var elem = $('#driver_time');				
			if (elem.css('visibility') == 'hidden') {
				elem.css('visibility', 'visible');
			}
			else{
				elem.css('visibility', 'hidden');
			}			
		}


		function showLap(json){

			// var name = json.name;
			// var lap = json.lap;
			// var laptime = json.latest;

			// $("#driver_lap").html("LAP "+lap);
			// $("#driver_time").html(laptime);
			// $("#driver_name").html(name);

			interval = setInterval(blinkFunction, 750);
			$("#two").animate({			
				right: "0"
			},1000);

			setTimeout(hideLap, 5000);
		}


		function hideLap(){			
			clearInterval(interval);
			$("#two").animate({			
				right: "-100%"			
			}, 1000);			
		}

		function makeRequest(){

			$.ajax({
				url: 'display/display/live_display.php',
				type: "GET",
				contentType: "application/json",	
				//data:json_data,
				success: function(response) {
					var json = $.parseJSON(response);
					//console.log(json);
					$('#table_1').html("");
					$('#table_2').html("");

					for(var i=0;i<json.length;i++){
						
						if(json[i].show){
							showLap(json[i]);
						}


						var html = '<tr><td class="flex_name">'+json[i].name+'</td><td class="flex_score">'+json[i].best+'</td><td class="flex_score">'+json[i].total+'</td></tr>';
						if(i<12){
							$('#table_1').append(html);
						}else{
							$('#table_2').append(html);
						}						
					}
				}
			});
		}

		// function pingCamera(){
		// 	if (!cameraCheck) {

		// 		cameraCheck = true;

		// 		$.ajax({
		// 			url: 'exe/ping.php',
		// 			type: "GET",
		// 			contentType: "application/json",	
		// 			//data:json_data,
		// 			success: function(response) {
		// 				cameraCheck = false;
		// 			}
		// 		});
		// 	}
		// }

		function updateDisplay(){
			//makeRequest();
			setInterval(function(){
				makeRequest();
			}, 1200);
		}
		// function checkCamera(){
		// 	setInterval(function(){
		// 			pingCamera();
		// 	}, 7000);
		// }

		updateDisplay();
		//checkCamera();


		// $('#o').on('click',function(){
		// 	count = 0;
		// 	interval = setInterval(blinkFunction, 750);
		// 	$("#two").animate({			
		// 		right: "0"
		// 	},1000);
		// });

		// $('#t').on('click',function(){
		// 	$("#two").animate({			
		// 		right: "-100%"			
		// 	},1000);
		// });	


		$('#test').on('click',function(){
			showLap();
		})	
	});
	</script>

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


		/*flex*/
		#flex_parent{display: -webkit-flex;margin-top: 30px;}
		.flex_2{display: inline-block;width: 50%;}
		#flex_parent table{width: 95%;border-collapse: collapse;margin-left: auto;margin-right: auto;font-size: 28px;color: rgb(200,200,200);}
		#flex_parent td{border:1px solid transparent;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;}
		#flex_parent td.flex_name{color: orange;font-family: r_bold_italic;}
		#flex_parent td.flex_score{text-align: right;color: rgb(150,150,150);}
		#flex_parent tr:nth-child(odd){background-color: rgb(40,40,40);}	


		/*driver*/
		#driver_main{margin-left: 90px;}		
		#driver_lap{font-size: 150px;color: yellow;font-family: r_bold_italic;margin-top: 25px;}
		#driver_time{font-size: 250px;color: yellow;}
		#driver_name{font-size: 100px;text-align: right;margin-right: 100px;margin-top: 20px;font-family: r_bold_italic;color: rgb(220,200,200);}
	</style>
</head>
<body>


<div id="wrapper">
	<div id="one">
		<div id="flex_parent">

			<div class="flex_2">
				<table id="table_1"></table>
			</div>

			<div class="flex_2">
				<table id="table_2"></table>
			</div>

		</div><!-- flex_parent -->
	</div>

	<div id="two">
		<div id="driver_main">
			<div id ="driver_lap"></div>
			<div id="driver_time"></div>
			<div id="driver_name"></div>

		</div>

	</div>

</div>

</body>
</html>