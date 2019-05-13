<!DOCTYPE html>
<html>
<head>
	<title>Webcam</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#retake_photo').hide();
			$('#canvas').hide();
			$('videoElement').show();
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
				navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
					video.src = window.URL.createObjectURL(stream);
					video.play();
				});
			}

			var type = "";
			var sign;
			var image;

			var can, ctx, flag = false,
				prevX = 0,
				currX = 0,
				prevY = 0,
				currY = 0,
				dot_flag = false;


			var x = "black",
		    	y = 2;
		    
			function getTimeStamp(){
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth()+1; //January is 0!
				var hr = today.getHours();
				var min = today.getMinutes();
				var sec = today.getSeconds();

				var yyyy = today.getFullYear();
				if(dd<10){
					dd='0'+dd;
				} 
				if(mm<10){
					mm='0'+mm;
				}
				if(hr<10){
					hr='0'+hr;
				}
				if(min<10){
					min='0'+min;
				}
				if(sec<10){
					sec='0'+sec;
				} 
				var today = dd+'/'+mm+'/'+yyyy+'-'+hr+':'+min+':'+sec;	
				return today;
			}


			function init() {
				can = document.getElementById('can');
				ctx = can.getContext("2d");
				w = can.width;
				h = can.height;

				can.addEventListener("mousemove", function (e) {
					findxy('move', e)
				}, false);
				can.addEventListener("mousedown", function (e) {
					findxy('down', e)
				}, false);
				can.addEventListener("mouseup", function (e) {
					findxy('up', e)
				}, false);
				can.addEventListener("mouseout", function (e) {
					findxy('out', e)
				}, false);
			}

			function draw() {
				ctx.beginPath();
				ctx.moveTo(prevX, prevY);
				ctx.lineTo(currX, currY);
				ctx.strokeStyle = x;
				ctx.lineWidth = y;
				ctx.stroke();
				ctx.closePath();
			}

			function erase() {
				ctx.clearRect(0, 0, w, h);
			}

			function save() {
				ctx.font = '15px Arial';
				ctx.fillStyle = '#C0C0C0';
				ctx.globalAlpha = 0.4;
				ctx.fillText(getTimeStamp(), 5, 12);
				sign = can.toDataURL('sign/png');
				type = "sign";
				$.ajax({
					url : '../../save_cust_photo.php',
					type : 'POST',
					data:{
						data    : sign,
						cu_id   : 1,
						type    : type
					},
					success : function(response){
						console.log(response);
					}
				});
			}

			function findxy(res, e) {
				if (res == 'down') {
					prevX = currX;
					prevY = currY;
					currX = e.clientX - can.offsetLeft;
					currY = e.clientY - can.offsetTop;

					flag = true;
					dot_flag = true;
					if (dot_flag) {
						ctx.beginPath();
						ctx.fillStyle = x;
						ctx.fillRect(currX, currY, 2, 2);
						ctx.closePath();
						dot_flag = false;
					}
				}
				if (res == 'up' || res == "out") {
					flag = false;
				}
				if (res == 'move') {
					if (flag) {
						prevX = currX;
						prevY = currY;
						currX = e.clientX - can.offsetLeft;
						currY = e.clientY - can.offsetTop;
						draw();
					}
				}
			}

			init();

			$('#click_photo').on('click',function(){
				context.drawImage(video, 0, 0, 640, 480);
				$('#canvas').show();
				$('#videoElement').hide();
				$('#retake_photo').show();
				$('#click_photo').hide();
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				image = canvas.toDataURL("image/png");
				type = "photo";
				//window.location.href=image; // it will save locally

				$.ajax({
					url : '../../save_cust_photo.php',
					type : 'POST',					
					data:{
						data 	: image,
						cu_id	: 1,
						type 	: type

					},
					success : function(response){
						console.log(response);
					}
				});
			});

			$('#retake_photo').on('click',function(){
				$('#canvas').hide();
				$('#videoElement').show();
				$('#retake_photo').hide();
				$('#click_photo').show();
			});

			$('#btn').on('click',function(){
				save();
			});
			$('#clr').on('click',function(){
				erase();
			});

			// Variables for referencing the canvas and 2dcanvas context
			var canvas,ctx;

			// Variables to keep track of the mouse position and left-button status 
			var mouseX,mouseY,mouseDown=0;

			// Variables to keep track of the touch position
			var touchX,touchY;

			// Keep track of the old/last position when drawing a line
			// We set it to -1 at the start to indicate that we don't have a good value for it yet
			var lastX,lastY=-1;

			// Draws a line between the specified position on the supplied canvas name
			// Parameters are: A canvas context, the x position, the y position, the size of the dot
			function drawLine(ctx,x,y,size) {

				// If lastX is not set, set lastX and lastY to the current position 
				if (lastX==-1) {
					lastX=x;
					lastY=y;
				}

				// Let's use black by setting RGB values to 0, and 255 alpha (completely opaque)
				r=0; g=0; b=0; a=255;

				// Select a fill style
				ctx.strokeStyle = "rgba("+r+","+g+","+b+","+(a/255)+")";

				// Set the line "cap" style to round, so lines at different angles can join into each other
				ctx.lineCap = "round";
				//ctx.lineJoin = "round";


				// Draw a filled line
				ctx.beginPath();

				// First, move to the old (previous) position
				ctx.moveTo(lastX,lastY);

				// Now draw a line to the current touch/pointer position
				ctx.lineTo(x,y);

				// Set the line thickness and draw the line
				ctx.lineWidth = size;
				ctx.stroke();

				ctx.closePath();

				// Update the last position to reference the current position
				lastX=x;
				lastY=y;
			}

			// Clear the canvas context using the canvas width and height
			function clearCanvas(canvas,ctx) {
				ctx.clearRect(0, 0, canvas.width, canvas.height);
			}

			// Keep track of the mouse button being pressed and draw a dot at current location
			function sketchpad_mouseDown() {
				mouseDown=1;
				drawLine(ctx,mouseX,mouseY,12);
			}

			// Keep track of the mouse button being released
			function sketchpad_mouseUp() {
				mouseDown=0;

				// Reset lastX and lastY to -1 to indicate that they are now invalid, since we have lifted the "pen"
				lastX=-1;
				lastY=-1;
			}

			// Keep track of the mouse position and draw a dot if mouse button is currently pressed
			function sketchpad_mouseMove(e) { 
				// Update the mouse co-ordinates when moved
				getMousePos(e);

				// Draw a dot if the mouse button is currently being pressed
				if (mouseDown==1) {
					drawLine(ctx,mouseX,mouseY,12);
				}
			}

			// Get the current mouse position relative to the top-left of the canvas
			function getMousePos(e) {
				if (!e){
					var e = event;
				}

				if (e.offsetX) {
					mouseX = e.offsetX;
					mouseY = e.offsetY;
				}
				else if (e.layerX) {
					mouseX = e.layerX;
					mouseY = e.layerY;
				}
			 }

			// Draw something when a touch start is detected
			function sketchpad_touchStart() {
				// Update the touch co-ordinates
				getTouchPos();

				drawLine(ctx,touchX,touchY,12);

				// Prevents an additional mousedown event being triggered
				event.preventDefault();
			}

			function sketchpad_touchEnd() {
				// Reset lastX and lastY to -1 to indicate that they are now invalid, since we have lifted the "pen"
				lastX=-1;
				lastY=-1;
			}

			// Draw something and prevent the default scrolling when touch movement is detected
			function sketchpad_touchMove(e) { 
				// Update the touch co-ordinates
				getTouchPos(e);

				// During a touchmove event, unlike a mousemove event, we don't need to check if the touch is engaged, since there will always be contact with the screen by definition.
				drawLine(ctx,touchX,touchY,12); 

				// Prevent a scrolling action as a result of this touchmove triggering.
				event.preventDefault();
			}

			// Get the touch position relative to the top-left of the canvas
			// When we get the raw values of pageX and pageY below, they take into account the scrolling on the page
			// but not the position relative to our target div. We'll adjust them using "target.offsetLeft" and
			// "target.offsetTop" to get the correct values in relation to the top left of the canvas.
			function getTouchPos(e) {
				if (!e){
					var e = event;
				}

				if(e.touches) {
					if (e.touches.length == 1) { // Only deal with one finger
						var touch = e.touches[0]; // Get the information for finger #1
						touchX=touch.pageX-touch.target.offsetLeft;
						touchY=touch.pageY-touch.target.offsetTop;
					}
				}
			}


			// Set-up the canvas and add our event handlers after the page has loaded
			function init() {
				// Get the specific canvas element from the HTML document
				canvas = document.getElementById('sketchpad');

				// If the browser supports the canvas tag, get the 2d drawing context for this canvas
				if (canvas.getContext){
					ctx = canvas.getContext('2d');
				}

				// Check that we have a valid context to draw on/with before adding event handlers
				if (ctx) {
					// React to mouse events on the canvas, and mouseup on the entire document
					canvas.addEventListener('mousedown', sketchpad_mouseDown, false);
					canvas.addEventListener('mousemove', sketchpad_mouseMove, false);
					window.addEventListener('mouseup', sketchpad_mouseUp, false);

					// React to touch events on the canvas
					canvas.addEventListener('touchstart', sketchpad_touchStart, false);
					canvas.addEventListener('touchend', sketchpad_touchEnd, false);
					canvas.addEventListener('touchmove', sketchpad_touchMove, false);
				}
			}
		});
	</script>
</head>
<body>

<div id="main_div">

	<div class="bhari">
		<div id = "webcam">
			<video autoplay="true" id="videoElement" width="640" height="480"></video>
			<canvas id="canvas" width="640" height="480"></canvas>
		</div>

		<div class="buttons">
			<button id="click_photo">Click Photo</button>
			<button id="retake_photo">Retake Photo</button>
		</div>		
	</div>


	<div id="sign_canvas" class="bhari">
		<div>
			<canvas id="sketchpad" height="300" width="400">
		</div>

		<div class="buttons">
			<input type="button" value="Save" id="btn" size="30" >
	    	<input type="button" value="Clear" id="clr" size="23">
		</div>
	</div>

	<div class="form_button_holder">
		<div class="mat_btn" id= "wcback">BACK</div>
		<div class="mat_btn" style="margin-left: 25px;background-color: #0087C1;" id="save_customer" >SAVE</div>
	</div>
</div>

</body>
</html>