<!DOCTYPE html>
<html>
<head>
	<title>Race</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">		
		$(document).ready(function(){

			function send(color2){
				$.ajax({
					url: 'exe/save_color.php',
					type: 'POST',					
					data:{
						color:color2
					},
					success: function(response){						
						console.log("updated");
					}
				});
			}


			$('button').on('click', function(){
				switch(this.id){
					case "btn_green":
						// $('#change_bg').css("background", "green");
						send("green");
						break;
					case "btn_red":
						// $('#change_bg').css("background", "red");
						send("red");
						break;
					case "btn_yellow":
						// $('#change_bg').css("background", "yellow");
						send("yellow");
						break;
					case "btn_finish":
						// $('#change_bg').css("background-image", "url('css/flag.jpg')");			
						send("finish");
						break;
				}
			});
		});		
	</script>

	<style type="text/css">
		*{padding: 0; margin: 0;}
		body{background-color: black;}
		button{width: 250px;height: 80px;margin: 20px;font-size: 20px;}
	</style>
</head>
<body>

<div style="text-align: center;margin-top: 60px;">
<div><button id="btn_green">Green</button></div>
<div><button id="btn_yellow">Yellow</button></div>
<div><button id="btn_red">Red</button></div>
<div><button id="btn_finish">Finish</button></div>
</div>
</body>
</html>