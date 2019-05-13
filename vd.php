<!DOCTYPE html>
<html>
<head> 
	<title>Title</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			function updateDisplay(){
				makeRequest();
				setInterval(function(){
					makeRequest();
				}, 1200);
			}

			function resetBools(choice){
				switch(choice){
					case 1:
						myObj.d1 = false;
						break;
					case 2:
						myObj.d2 = false;
						break;
					case 3:
						myObj.d3 = false;
						break;
					case 4:
						myObj.d4 = false;
						break;
				}
			}

			function showLap(json){

				var name = json.name;
				var lap = json.lap;
				var laptime = json.latest;
				var kart_no = json.kart_no;
				// console.log(json);
					
				var div;
				var choice = 0;


				console.log("before d1 :"+myObj.d1);
				console.log("before d2:"+myObj.d2);

				if (!myObj.d1) {
					div = $('#d1');
					choice = 1;
					myObj.d1 = true;
				}
				if(!myObj.d2){
					div = $('#d2');
					choice = 2;
					myObj.d2 = true;
				}
				if(!myObj.d3){
					div = $('#d3');
					choice = 3;
					myObj.d3 = true;
				}
				if(!myObj.d4){
					div = $('#d4');
					choice = 4;
					myObj.d4 = true;
				}

				console.log("after d1:"+myObj.d1);
				console.log("after d2:"+myObj.d2);

				div.find(".driver_lap").html("LAP "+lap);
				div.find(".driver_time span").html(laptime);
				div.find(".driver_name").html(name);
				div.find(".driver_kart").text("KART NO "+kart_no);

				// for(var i=0; i<5; i++){
				// 	div.find('.driver_time span').fadeIn(500);
				// 	div.find('.driver_time span').fadeOut(500);
				// }

				setTimeout(resetBools(choice), 2000);				
			}
			

			function makeRequest(){

				$.ajax({
					url: 'display/display/live_display.php',
					type: "GET",
					contentType: "application/json",					
					success: function(response) {
						var json = $.parseJSON(response);
						// console.log(json);						

						for(var i=0;i<json.length;i++){
							
							if(json[i].show){
								showLap(json[i]);
							}
						}
					}
				});
			}

			updateDisplay();

			var myObj = {};
			myObj.d1 = false;
			myObj.d2 = false;
			myObj.d3 = false;
			myObj.d4 = false;		

			// setInterval(function(){
			// 	$('#d1 .driver_time').fadeIn(500);
			// 	$('#d1 .driver_time').fadeOut(500);
			// 	$('#d1 .driver_time').fadeIn(500);
			// 	$('#d1 .driver_time').fadeOut(500);
			// },2000);
		});
	</script>
	<style type="text/css">
		*{padding: 0;margin: 0;}
		body{background-color: black;color: white;font-family: helvetica;font-weight: bold;}
		.main_4{width: 50%;display: inline-block;height: 50vh;margin-right: -4px;vertical-align: top;}


		#d1{}
		/*driver*/
		.driver_main{width: 80%;margin: 0 auto;color: rgb(255,201,14);position: relative;top: 50%;transform: translateY(-50%);}		
		.driver_lap{font-size: 4.5em;}
		.driver_time{font-size: 6.4em;}
		.driver_name{font-size: 3.5em;text-align: right;}
		.driver_kart{font-size: 3em;text-align: right;}

	</style>
</head>
<body>

<div class="main_4" id="d1">
	<div class="driver_main">	
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>
</div>

<div class="main_4" id="d2" >
	<div class="driver_main">	
		<!-- <div class="driver_lap">LAP 3</div>
		<div class="driver_time">49:345</div>	
		<div class="driver_name">VINAY</div>	
		<div class="driver_kart">KART 05</div> -->
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>	
</div>

<div class="main_4" id="d3">
	<div class="driver_main">	
		<!-- <div class="driver_lap">LAP 2</div>
		<div class="driver_time">1:34:345</div>	
		<div class="driver_name">RAHUL</div>	
		<div class="driver_kart">KART 06</div> -->
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>
</div>

<div class="main_4" id="d4">
	<div class="driver_main">	
		<!-- <div class="driver_lap">LAP 4</div>
		<div class="driver_time">58:345</div>	
		<div class="driver_name">NARENDRA</div>	
		<div class="driver_kart">KART 01</div> -->
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>
</div>

</body>
</html>