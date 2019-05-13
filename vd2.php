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

			function resetDispArray(div){
				for (var i=0; i<dispArray.length; i++) {
					if(dispArray[i].div == div){
						

						div.find('.driver_lap').text("");
						div.find('.driver_time span').text("");
						div.find('.driver_name').text("");
						div.find('.driver_kart').text("");

						dispArray[i].active = false;
						break;
					}
				}
			}


			function findVacantDisp(){
				var returnDiv = undefined;
				for (var i=0; i<dispArray.length; i++) {
					if(dispArray[i].active == false){
						dispArray[i].active = true;
						returnDiv = dispArray[i].div;
						break;
					}
				}
				return returnDiv;
			}

			function showLap(json){

				var name = json.name;
				var lap = json.lap;
				var laptime = json.latest;
				var kart_no = json.kart_no;
				// console.log(json);
					
				var div = findVacantDisp();
				console.log(div);
				if(div != undefined){
					div.find(".driver_lap").html("LAP "+lap);
					div.find(".driver_time span").html(laptime);
					div.find(".driver_name").html(name);
					div.find(".driver_kart").text("KART NO "+kart_no);

					// for(var i=0; i<5; i++){
					// 	div.find('.driver_time span').fadeIn(500);
					// 	div.find('.driver_time span').fadeOut(500);
					// }
					setTimeout(function(){
						resetKartBool(kart_no);
						resetDispArray(div);
					}, 3000);
				}
				else{
					console.log('findVacantDisp error');
				}
			}


			function resetKartBool(id){
				console.log("reseting:"+id);
				for (var i=0; i<kartArray.length; i++) {
					if(kartArray[i].id == id){
						kartArray[i].active = false;						
						break;
					}
				}
			}

			function addKart(id){
				var myObj = {};
				myObj.id = id;				
				myObj.active = true;
				kartArray.push(myObj);
			}
			function isKartInArray(id){
				var returnVal = false;
				for (var i=0; i<kartArray.length; i++) {
					if(kartArray[i].id == id){
						returnVal = true;
						break;
					}
				}
				return returnVal;
			}
			function isKartActive(id){
				var returnVal = false;
				for (var i=0; i<kartArray.length; i++) {
					if((kartArray[i].id == id)&&(kartArray[i].active == true)){
						returnVal = true;
						break;
					}
				}
				return returnVal;
			}
			function updateKart(id){
				for (var i=0; i<kartArray.length; i++) {
					if(kartArray[i].id == id){
						kartArray[i].active = true;
						break;
					}
				}
			}			
			

			function fillDispArray(){
				// add display details to array
				for(var i=1;i<=4;i++){
					var dispObj = {};
					dispObj.id = i;
					dispObj.active = false;
					dispObj.div = $('#d'+i);
					dispArray.push(dispObj);
				}
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
								console.log(json);
								var kart_no = json[i].kart_no;

								// check if in kart array
								// else add
								if(isKartInArray(kart_no)){
									if(isKartActive(kart_no)){
										// do nothing
										console.log('kart no'+kart_no+' is active do nothing');
									}
									else{
										console.log('update');
										updateKart(kart_no);
										showLap(json[i]);
									}
								}
								else{
									// add and show
									console.log('add');
									addKart(kart_no);
									showLap(json[i]);
								}
							}
						}
					}
				});
			}


			// globals
			var kartArray = [];
			var dispArray = [];
			// init
			updateDisplay();
			fillDispArray();
		
		});
	</script>
	<style type="text/css">
		*{padding: 0;margin: 0;}
		body{background-color: black;color: white;font-family: helvetica;font-weight: bold;}
		.main_4{width: 33.3.3%;display: inline-block;height: 50vh;margin-right: -4px;vertical-align: top;}


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
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>	
</div>

<div class="main_4" id="d3">
	<div class="driver_main">
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>
</div>

<div class="main_4" id="d4">
	<div class="driver_main">
		<div class="driver_lap"></div>
		<div class="driver_time"><span></span></div>
		<div class="driver_name"></div>	
		<div class="driver_kart"></div>
	</div>
</div>

</body>
</html>