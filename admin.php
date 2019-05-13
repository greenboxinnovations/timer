<?php 
require 'lock.php';
if(!isset($_SESSION))
{
	session_start();
}
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = date("Y-m-d H:i:s"); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<style type="text/css">
		*{padding: 0;margin: 0;}
		body{font-family: 'Roboto', sans-serif;}

		#app_bar{
			height: 100px;line-height: 100px;font-size: 30px;padding-left: 72px;background-color: rgb(112,146,190);
			color: white;
			font-weight: 500;
			-webkit-box-shadow: 0px 1px 9px 0px rgba(115,114,115,1);
			-moz-box-shadow: 0px 1px 9px 0px rgba(115,114,115,1);
			box-shadow: 0px 1px 9px 0px rgba(115,114,115,1);
		}

		#date_holder{height: 100px;line-height: 100px;margin-left: 72px;}		
		input[type="date"]{
			font-family: 'Roboto', sans-serif;border: none;font-size: 18px;font-weight: 500;
			color: rgb(60,60,60);
		}
		input[type="date"]::-webkit-inner-spin-button{
			display: none;
		}

		#ride_num{
			width: 80px;font-size: 18px;
			padding-left: 6px;
			padding-bottom: 2px;
			background-color: rgb(40,40,40);color: white;
			border:none;
			outline: none;			
			border-bottom: 2px solid white;
		}
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			margin: 0; 
		}

		.inline{display: inline-block;vertical-align: top;}


		#table_load{margin-left: 72px;}
		table{border-collapse: collapse;}

		td{padding: 10px;border: 1px solid rgb(200,200,200);}

		/*tr:not(:first-child):hover{background-color: rgb(230,230,230);}*/

		.header{color: rgb(130,130,130);}
		.ride_name{width: 350px;}
		.ride_num,.ride_rate,.ride_total{text-align: right;width: 85px;}

		#crunch_bar{
			position: fixed;width: 600px;height: 60px;bottom: -100px;right: 0;line-height: 60px;
			/*background-color: green;*/
			background-color: rgb(40,40,40);
			color: white;
			padding-left: 24px;
			margin-right: 72px;
			border-top-left-radius: 5px;
			border-top-right-radius: 5px;
		}


		#old_total{margin-left: 40px;}
		#sub_total{color: rgb(150,150,150);}
		#final_total{margin-left: 20px;color: orange;}

		#logout{
			top: 0;
			right: 0;
			position: fixed;
			margin: 30px;
			color: white;
		}

		#logout a{
			text-decoration: none;
			color: white;
		}


		.mat_btn{
			display: inline-block;			
			position: relative;
			background-color: rgb(80,80,80);
			color: #fff;
			width: 80px;			
			height: 20px;
			line-height: 20px;
			margin:auto;
			border-radius: 5px;
			font-size: 15px;			
			padding: 8px 15px;
			text-align: center;
			transition: box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
			transition-delay: 0.2s;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
		}
		.mat_btn:hover{cursor: pointer;}
		.mat_btn:active {
			/*background-color: rgb(90,90,90);*/
			box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
			transition-delay: 0s;
		}	


	</style>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			
			function rideKeydown($div){
				setTimeout(function(){
					var val 		= $div.val();
					var rate 		= $('#crunch_rate').val();
					var old_total 	= $('#old_total').text();

					if((val.length < 5) && (val != "")){
						// console.log(val);
						var sub_total 	= val * rate;
						var final_total = old_total - sub_total;

						$('#sub_total').text(sub_total);
						$('#final_total').text(final_total);
					}
					else{
						$('#sub_total').text("0");
						$('#final_total').text(old_total);
					}
				}, 10);
			}

			function loadTable(date1){
				$('#table_load').load("display/admin/table.php?date="+date1);
			}

			function showCrunch(){
				$('#crunch_bar').animate({
					'bottom': '0'
				},function(){
					$('#ride_num').focus();
				});
			}

			function hideCrunch(){

				$('#crunch_bar').animate({
					'bottom': '-100px'
				});
				$('#ride_num').val("");
				$('#sub_total').text("0");
			}

			$('#ride_num').on('keydown',function(e){

				if(e.keyCode == 27){
					hideCrunch();
				}
				else{					
					var ref = $(this);
					rideKeydown(ref);	
				}
			});


			$('#cancel_crunch').on('click',function(){
				hideCrunch();
			});



			///////////////////////////////////////
			///////////////////////////////////////
			///////////////////////////////////////
			///////////////////////////////////////
			///////////////////////////////////////
			///////////////////////////////////////
			///////////////////////////////////////
			///////////////////////////////////////

			var date1, date2;
			date1 = $('#date1').val();

			loadTable(date1);

			$('#crunch_btn').on('click', function(){
				if (date1 == undefined) {
					date1 = $('#date1').val();
				}
				
				var ride_num = $('#ride_num').val();
				var ride_id = $('#ride_id').val();
				var action = "dat";

				var myObject = {};
				myObject.action = action;
				myObject.ride_num = ride_num;
				myObject.ride_id = ride_id;
				myObject.date1 = date1;

				json_string = JSON.stringify(myObject);

				$.ajax({
					url: 'api/operations',
					type: 'POST',
					contentType: "application/json",
					data:json_string,
					success: function(response){
						loadTable(date1);
						hideCrunch();
					}
				});
				
			});

			// date functions
			$('#date1').on('change', function(){
				date1 = $(this).val();
				if(date1 != ""){
					loadTable(date1);
				}
			});

			$('#date2').on('change', function(){
				date2 = $(this).val();
				if(date2 != ""){
					console.log(date2);
				}
			});

		});
	</script>
</head>
<body>

<div id="app_bar">Admin Panel</div>

<div id="logout" ><a href="exe/logout.php">Logout</a></div>

<div id="date_holder">
	<input type="date" id="date1" class="date_input" value=<?php echo date("Y-m-d"); ?>>
<!-- 	<input type="date" id="date2" class="date_input"> -->
</div>


<div id="table_load"></div>



<div id="crunch_bar">
	<input type="number" id="ride_num">	
	<div class="inline" id="old_total"></div>
	<div class="inline">-</div>
	<div class="inline" id="sub_total">0</div>
	<div class="inline">=</div>
	<div class="inline" id="final_total"></div>
	<input type="hidden" id="crunch_rate" value="">
	<input type="hidden" id="ride_id" value="">
	<div style="float: right;margin-right: 20px;">
		<div class="mat_btn" id="crunch_btn">CRUNCH</div>
		<div class="mat_btn" id="cancel_crunch" style="width: 10px;margin-left: 10px;">X</div>
	</div>
</div>

</body>
</html>

