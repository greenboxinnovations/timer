<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			// video init
			var video = document.getElementById('videoElement');			
			// canvas inits
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');


			// get a video handle
			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

			// Get access to the camera!
			if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
				// Not adding `{ audio: true }` since we only want video now
				// navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
				navigator.mediaDevices.getUserMedia({video: {facingMode: "user"}, audio: false}).then(function(stream) {					
					video.src = window.URL.createObjectURL(stream);
					video.play();
				});
			}


			$('#click_photo').on('click',function(){
				context.drawImage(video, 0, 0, 640, 480);
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				var image = canvas.toDataURL("image/png");
				//window.location.href=image; // it will save locally

				$.ajax({
					url : 'exe/save_cust_photo.php',
					type : 'POST',					
					data:{
						data 	: image,
						cu_id	: 1,
					},
					success : function(response){
						console.log(response);
					}
				});
			});

		});
	</script>

	<style type="text/css">
		*{padding: 0;margin: 0;}
		/*#videoElement {
			width: 500px;
			height: 375px;
			background-color: #666;
		}*/
	</style>
</head>
<body>


<video autoplay="true" id="videoElement" width="640" height="480"></video>
<button id="click_photo">Click Photo</button>
<canvas id="canvas" width="640" height="480"></canvas>

</body>
</html>
