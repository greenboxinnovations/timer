<?php
//require 'lock.php';
require 'query/time_session.php';
?>
<!DOCTYPE html>
<html>
<head>	
	<title>Customer</title>

	<link rel="apple-touch-icon" sizes="57x57" href="css/favi5/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="css/favi5/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="css/favi5/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="css/favi5/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="css/favi5/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="css/favi5/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="css/favi5/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="css/favi5/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="css/favi5/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="css/favi5/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="css/favi5/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="css/favi5/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="css/favi5/favicon-16x16.png">
	<link rel="manifest" href="css/favi5/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="css/favi5/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
		

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/main.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Raleway:400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:700i" rel="stylesheet">

	<!-- normal js -->
	<script type="text/javascript">
		$(document).ready(function() {

			// TO DISABLE FRONT AND BACK SCROLL WINDOWS TABLET IN CHROME
			// chrome://flags/#overscroll-history-navigation
			// disable the flag "overscroll-history-navigation"

			// get in and out of fullscreen mode
			function toggleFullScreen() {
				if (!document.fullscreenElement &&    // alternative standard method
					!document.mozFullScreenElement &&
					!document.webkitFullscreenElement &&
					!document.msFullscreenElement ) {
					// current working methods
					if (document.documentElement.requestFullscreen) {
					  document.documentElement.requestFullscreen();
					}
					else if (document.documentElement.msRequestFullscreen) {
						document.documentElement.msRequestFullscreen();
					}
					else if (document.documentElement.mozRequestFullScreen) {
						document.documentElement.mozRequestFullScreen();
					}
					else if (document.documentElement.webkitRequestFullscreen) {
						document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
					}
				}
				else {
					if (document.exitFullscreen) {
						document.exitFullscreen();
					}
					else if (document.msExitFullscreen) {
						document.msExitFullscreen();
					}
					else if (document.mozCancelFullScreen) {
						document.mozCancelFullScreen();
					}
					else if (document.webkitExitFullscreen) {
						document.webkitExitFullscreen();
					}
				}
			}

			// add anim around button
			function radial_fade(fade_div) {
				var offset = fade_div.position();
				var $div = $('<div class="radial_anim"></div>');
				$div.css({
					top: offset.top,
					left: offset.left
				});
				fade_div.append($div);
				window.setTimeout(function() {
					$div.remove();
				}, 600);
			}

			// snackbar functions
			function showSnackBar(message) {
				$('#snackbar').text(message);
				$('#snackbar').animate({
					'top': '0'
				}, function() {
					setTimeout(function() {
						$('#snackbar').animate({
							'top': '-100px'
						});
					}, 2000);
				});
			}


			function nameValidate(event){

				if (event.keyCode == 32) {
					event.preventDefault();
				}
				event = event || window.event;
				var charCode = (typeof event.which == "undefined") ? event.keyCode : event.which;
				var charStr = String.fromCharCode(charCode);
				if (/\d/.test(charStr)) {
					return false;
				}
			}

			function numberValidate(event){
				if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || (event.keyCode >= 35 && event.keyCode <= 40)) {
					// Allow: home, end, left, right, down, up

					// let it happen, don't do anything
					return;
				}
				// Ensure that it is a number and stop the keypress
				if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
					event.preventDefault();
				}
			}


			// webcam functions
			function setupWebcamOld(){
				$('#retake_photo').hide();
				$('#video_canvas').hide();
				$('videoElement').show();
				// video init
				video = document.getElementById('videoElement');
				// canvas inits
				video_canvas = document.getElementById('video_canvas');
				ctx_cam = video_canvas.getContext('2d');


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
				initCanvas();
			}
			function setupWebcam(){
				$('#retake_photo').hide();
				$('#video_canvas').hide();
				$('#videoElement').show();
				// video init
				video = document.getElementById('videoElement');				
				// canvas inits
				video_canvas = document.getElementById('video_canvas');
				ctx_cam = video_canvas.getContext('2d');


				// get a video handle
				navigator.mediaDevices.enumerateDevices()
					.then(gotDevices).then(getStream).catch(handleError);
					
				initCanvas();
			}
			function gotDevices(deviceInfos) {
				for (var i = 0; i !== deviceInfos.length; ++i) {
					var deviceInfo = deviceInfos[i];
					
					if((deviceInfo.kind === 'videoinput') && (deviceInfo.label == "UNICAM Front")) {
						console.log(deviceInfo);
						frontCamId = deviceInfo.deviceId;
					}
				}
			}
			function getStream() {
				if (window.stream) {
					window.stream.getTracks().forEach(function(track) {
						track.stop();
					});
				}

				var constraints = {
					video: {
						optional: [{					
							sourceId: frontCamId
						}]
					}
				};

				navigator.mediaDevices.getUserMedia(constraints).then(gotStream).catch(handleError);
			}
			function gotStream(stream) {
				window.stream = stream; // make stream available to console
				localStream = stream;
				videoElement.srcObject = stream;
			}
			function handleError(error) {
				console.log('Error: ', error);
			}

			function releaseCam(){
					localStream.getVideoTracks()[0].stop();

			}

			var localStream;

			// Set-up the canvas and add our event handlers after the page has loaded
			function initCanvas() {
				// Get the specific canvas element from the HTML document
				canvas 	= document.getElementById('sketchpad');
				w 		= canvas.width;
				h 		= canvas.height;
				// If the browser supports the canvas tag, get the 2d drawing context for this canvas
				if (canvas.getContext){
					ctx = canvas.getContext('2d');
				}

				// Check that we have a valid context to draw on/with before adding event handlers
				if (ctx) {
					// React to mouse events on the canvas, and mouseup on the entire document
					canvas.addEventListener('mousedown', sketchpad_mouseDown, false);
					canvas.addEventListener('mousemove', sketchpad_mouseMove, false);
					canvas.addEventListener('mouseup', sketchpad_mouseUp, false);

					// React to touch events on the canvas
					canvas.addEventListener('touchstart', sketchpad_touchStart, false);
					canvas.addEventListener('touchend', sketchpad_touchEnd, false);
					canvas.addEventListener('touchmove', sketchpad_touchMove, false);
				}
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

				// we have just made a mark on the canvas and is no longer empty
				sign_taken = true;
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
				// we have just made a mark on the canvas and is no longer empty
				sign_taken = true;			
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
			function sign_erase(sign_bool) {
				sign_bool = false;
				// console.log(sign_taken);
				ctx.clearRect(0, 0, w, h);
			}
			function sign_save(sign_bool, cu_id) {
				ctx.font = '15px Arial';
				ctx.fillStyle = '#C0C0C0';
				ctx.globalAlpha = 0.4;
				ctx.fillText(getTimeStamp(), 5, 12);
				sign = canvas.toDataURL('sign/png');
				type = "sign";
				// window.location.href=sign; // it will save locally
				$.ajax({
					url : 'exe/save_cust_photo.php',
					type : 'POST',
					data:{
						data    : sign,
						cu_id   : cu_id,
						i_type 	: "sign"
					},
					success : function(response){
						sign_bool = false;
						console.log(response);
					}
				});
			}

			function photo_save(photo_taken, cu_id){
				// output to browser
				// here is the most important part because if you dont replace you will get a DOM 18 exception.
				// var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				// var c1 = document.getElementById('video_canvas');
				var image = video_canvas.toDataURL("image/png");
				type = "photo";
				// window.location.href=image; // it will save locally

				$.ajax({
					url : 'exe/save_cust_photo.php',
					type : 'POST',					
					data:{
						data 	: image,
						cu_id	: cu_id,
						i_type 	: "photo"
					},
					success : function(response){
						photo_taken = false;
						console.log(response);
						// $('#wrapper').load('forms/kiosk2/success.php', redirect);
					}
				});
			}

			// success page functions
			function redirect(){
				success_timer = setInterval(successNums, 900);
			}
			function successNums(){

				console.log(success_count);
				var c = 5 - success_count;
				$('#redirect_time').text(c);
				++success_count;

				if(success_count > 4){
					clearInterval(success_timer);
					success_timer = 0;
					success_count = 0;
					setTimeout(function() {
						$('#wrapper').load('forms/kiosk2/phone_number.php');
					}, 900);					
				}
			}



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


			function loadFirstPage(){
				$('#wrapper').load('forms/kiosk2/phone_number.php');
				// $('#wrapper').load('forms/kiosk2/new_customer.php');
				// $('#wrapper').load('forms/kiosk2/terms_conditions.php');
				// $('#wrapper').load('forms/kiosk2/imp_notes.php');
				// $('#wrapper').load('forms/kiosk2/sign.php', setupWebcam);
				// $('#wrapper').load('forms/kiosk2/success.php', redirect);
			}

			function flashRed(div){
				var fade_time = 350;				
				div.fadeIn(fade_time);
				div.fadeOut(fade_time);
				div.fadeIn(fade_time);
				div.fadeOut(fade_time);
				div.fadeIn(fade_time);
				div.fadeOut(fade_time);
				div.fadeIn(fade_time);
			}

			function removeRed(div){
				($(':text').parent()).removeClass('highlight');
				$(':text').removeClass('placeholder_red');
			}


			// globals
			var phone_number 	= "";
			var firstname 		= "";
			var lastname 		= "";
			var email 			= "";
			var age 			= "";
			var child_count 	= 1;
			var child_array 	= [];
			var adult_count		= 1;
			var adult_array		= [];

			var child_html 	= ['child_first_name', 'child_last_name', 'child_age'];
			var adult_html	= ['adult_first_name', 'adult_last_name', 'adult_age'];
			var cust_html 	= ['first_name', 'last_name', 'age', 'email'];

			var photo_taken	= false;
			var sign_taken	= false;


			var success_timer = 0;
			var success_count = 0;

			var exit_count = 0;		// for fullscreen toggle

			loadFirstPage();

			// webcam variables
			var frontCamId = "";

			var video_canvas;

			// globals for sign and photo
			// Variables for referencing the canvas and 2dcanvas context
			var canvas,ctx,w,h;
			// Variables to keep track of the mouse position and left-button status 
			var mouseX,mouseY,mouseDown=0;
			// Variables to keep track of the touch position
			var touchX,touchY;
			// Keep track of the old/last position when drawing a line
			// We set it to -1 at the start to indicate that we don't have a good value for it yet
			var lastX,lastY=-1;
			// webcam context is different
			var ctx_cam,video;


			
			// click functions
			// validation
			$('body').delegate('.name_validate', 'keydown', nameValidate); 
			$('body').delegate('.num_validate', 'keydown', numberValidate);
			$('body').delegate(':text', 'click', removeRed);


			// toggle fullscreen mode
			$('#db_click').click(function(){
				exit_count++;
				console.log('canExit: '+exit_count);
				if(exit_count == 5){
					alert('canExit');
					exit_count = 0;
					toggleFullScreen();
				}
			});


			// 1st page
			$('body').delegate('#p1_next', 'click', function(){

				phone_number = $('#phone_number').val();
				if(phone_number.length != 10){
					var ph_no_html = $('#phone_number');
					flashRed(ph_no_html);
					showSnackBar("PLEASE ENTER A VALID PHONE NUMBER");
				}
				else{
					$('#wrapper').load('forms/kiosk2/new_customer.php');
					var url = 'exe/get_customer_data.php?phone_number='+phone_number;

					$.ajax({
						url: url,
						type: 'GET',
						success: function(response) {
							data = $.parseJSON(response);
							var object = data[0];
							$('#first_name').val(object.firstname);
							$('#last_name').val(object.lastname);
							$('#age').val(object.age);
							$('#email').val(object.email);
						}
					});
				}
			});


			// 2nd page
			$('body').delegate('#p2_back', 'click', function(){
				$('#wrapper').load('forms/kiosk2/phone_number.php', function() {
					$('#phone_number').val(phone_number);
				});
			});
			$('body').delegate('#add_children_btn', 'click', function() {

				// $("html, body").animate({ scrollTop: $(document).height() }, 1000);
				lastname = $('#last_name').val();

				var html = '<div class="child_holder"><div class="row_style_small"><div class="inline_child text_style" style="margin-left: 20px;">Child '+child_count+'</div><div class="inline_child cross"></div></div><div class="row_style"><div class="inline_child"><input type="text" class="child_first_name name_validate"  placeholder="Firstname"></div><div class="inline_child"><input type="text" class="child_last_name name_validate"  placeholder="Lastname" value="'+lastname+'"></div><div class="inline_child"><input type="number" class="child_age num_validate" placeholder="Age"></div></div></div>';

				$('#child_add').append(html);

				child_count++;
			});
			$('body').delegate('.cross', 'click', function() {
				$(this).parent().parent().remove();
				child_count--;
			});

			$('body').delegate('#add_adult_btn', 'click', function() {

				// $("html, body").animate({ scrollTop: $(document).height() }, 1000);

				var html = '<div class="adult_holder"><div class="row_style_small"><div class="inline_adult text_style" style="margin-left: 20px;">Adult '+adult_count+'</div><div class="inline_adult cross_a"></div></div><div class="row_style"><div class="inline_adult"><input type="text" class="adult_first_name name_validate"  placeholder="Firstname"></div><div class="inline_adult"><input type="text" class="adult_last_name name_validate"  placeholder="Lastname"></div><div class="inline_adult"><input type="number" class="adult_age num_validate" placeholder="Age"></div></div></div>';

				$('#adult_add').append(html);

				adult_count++;
			});

			$('body').delegate('.cross_a', 'click', function() {
				$(this).parent().parent().remove();
				adult_count--;
			});




			$('body').delegate('#addcustnext', 'click', function() {


				firstname 	= $('#first_name').val();
				lastname 	= $('#last_name').val();
				age 		= $('#age').val();
				email 		= $('#email').val();

				// console.log(firstname+" "+lastname+" "+age+" "+email);

				var cust_validate 	= true;
				var child_validate 	= [];
				var adult_validate  = [];

				// validate parent values
				if((firstname=='')||(lastname=='')||(email=='')||((age=='')||(age <=0)||(age >=120))) {

					for(var i=0; i<cust_html.length; i++) {
						var temp_html 	= $('#' +cust_html[i]);
						var temp_val	= temp_html.val();						

						if(temp_val==""){
							(temp_html.parent()).addClass("highlight");
							flashRed(temp_html.parent());
						}
					}
					cust_validate = false;
				}

				// $('.children').each(function(){
				$('.child_holder').each(function(){

					var ref 				= $(this);
					var child_first_name 	= $(this).find('.child_first_name').val();
					var child_last_name 	= $(this).find('.child_last_name').val();
					var child_age 			= $(this).find('.child_age').val();
					var flag 				= false;

					console.log(child_first_name+" "+child_last_name+" "+child_age);

					for(var i=0;i<child_html.length;i++) {

						var temp_html 	= ref.find('.' +child_html[i]);
						var temp 		= temp_html.val();

						if(temp=="") {

							(temp_html.parent()).addClass("highlight");
							temp_html.addClass("placeholder_red");

							flashRed(temp_html.parent());
							flag=true;
						}
					}
					if(flag == false) {
						var child 		= {};
						child.firstname = child_first_name;
						child.lastname 	= child_last_name;
						child.age 		= child_age;		
						child_array.push(child);
						// console.log(child);
					}
					child_validate.push(flag);
				});

				$('.adult_holder').each(function(){

					var ref 				= $(this);
					var adult_first_name 	= $(this).find('.adult_first_name').val();
					var adult_last_name 	= $(this).find('.adult_last_name').val();
					var adult_age 			= $(this).find('.adult_age').val();
					var flag 				= false;

					console.log(adult_first_name+" "+adult_last_name+" "+adult_age);

					for(var i=0;i<adult_html.length;i++) {

						var temp_html 	= ref.find('.' +adult_html[i]);
						var temp 		= temp_html.val();

						if(temp=="") {

							(temp_html.parent()).addClass("highlight");
							temp_html.addClass("placeholder_red");

							flashRed(temp_html.parent());
							flag=true;
						}
					}
					if(flag == false) {
						var adult		= {};
						adult.firstname = adult_first_name;
						adult.lastname 	= adult_last_name;
						adult.age 		= adult_age;		
						adult_array.push(adult);
						// console.log(child);
					}
					adult_validate.push(flag);
				});




				if((cust_validate) && !($.inArray(true, child_validate) !== -1)&& !($.inArray(true, adult_validate) !== -1)){
					$('#wrapper').load('forms/kiosk2/terms_conditions.php', function(){
						$('#s1').text(firstname+' '+lastname);
						$('#s2').text(phone_number);
						$('#s3').text(age);
					});
				}
				else{
					showSnackBar("PLEASE ENTER APPROPRIATE VALUES!");
				}
			});


			// 3rd page
			$('body').delegate('#tncback', 'click', function() {
				$('#wrapper').load('forms/kiosk2/new_customer.php', function() {
					$('#first_name').val(firstname);
					$('#last_name').val(lastname);
					$('#age').val(age);
					$('#email').val(email);
				});
			});
			$('body').delegate('#checkbox_img, #checkbox_text', 'click', function() {
				if($('#tnc').is(':checked')){
					$('#tnc').prop('checked', false);					
					radial_fade($('#checkbox_img'));
					$('#checkbox_img').css("background-image", "url(css/unchecked.png)");
				}
				else{
					$('#tnc').prop('checked', true);
					radial_fade($('#checkbox_img'));					
					$('#checkbox_img').css("background-image", "url(css/checked.png)");
				}				
			});
			$('body').delegate('#tncnext', 'click', function() {
				if ($('#tnc').is(':checked')) {
					$('#wrapper').load('forms/kiosk2/imp_notes.php');
				}
				else {
					showSnackBar("PLEASE AGREE TO THE TERMS AND CONDITIONS!");
				}
			});


			// 4th page
			$('body').delegate('#ipback', 'click', function() {
				$('#wrapper').load('forms/kiosk2/terms_conditions.php', function() {
					$('#s1').text(firstname + ' ' + lastname);
					$('#s2').text(phone_number);
					$('#s3').text(age);
				});
			});
			$('body').delegate('#ipnext', 'click', function() {
				$('#wrapper').load('forms/kiosk2/sign.php', setupWebcam);
			});


			// 5th page
			$('body').delegate('#click_photo', 'click',function(){

				// console.log('wprling');
				ctx_cam.drawImage(video, 0, 0, 384, 288);
				ctx_cam.font = '15px Arial';
				ctx_cam.fillStyle = '#C0C0C0';
				ctx_cam.globalAlpha = 1;
				ctx_cam.fillText(getTimeStamp(), 5, 12);

				$('#video_canvas').show();
				$('#videoElement').hide();
				$('#retake_photo').show();
				$('#click_photo').hide();
				photo_taken = true;
				// // output to browser
				// // here is the most important part because if you dont replace you will get a DOM 18 exception.
				// // var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
				// var canvas = document.getElementById('canvas');
				// var image = canvas.toDataURL("image/png");
				// type = "photo";
				// // window.location.href=image; // it will save locally

				// $.ajax({
				// 	url : 'exe/save_cust_photo.php',
				// 	type : 'POST',					
				// 	data:{
				// 		data 	: image,
				// 		cu_id	: 1,
				// 		type 	: type

				// 	},
				// 	success : function(response){
				// 		photo_taken = true;
				// 		console.log(response);
				// 	}
				// });
			});			
			$('body').delegate('#retake_photo', 'click',function(){
				photo_taken = false;
				$('#video_canvas').hide();
				$('#videoElement').show();
				$('#retake_photo').hide();
				$('#click_photo').show();
			});
			$('body').delegate('#sign_clr', 'click',function(){
				sign_taken = false;		 
				sign_erase(sign_taken);
				
			});
			$('body').delegate('#sign_btn', 'click',function(){					 
				sign_save(sign_taken);
			});			
			$('body').delegate('#save_customer', 'click', function() {

				if((!photo_taken) && (!sign_taken)){
					showSnackBar("Click Photo and Sign");
				}
				else if(!photo_taken){
					console.log("click photo");
					showSnackBar("Click Photo");
				}
				else if(!sign_taken){
					console.log("please sign");
					showSnackBar("Please Sign");
				}


				if((photo_taken)&&(sign_taken)){

					var url 	= 'api/customers';
					var action 	= 'insert';

					var myObject 		= {};
					myObject.action 	= action;
					myObject.firstname 	= firstname;
					myObject.lastname 	= lastname;
					myObject.phone_number = phone_number;
					myObject.child 		= child_array;
					myObject.adults		= adult_array;
					myObject.email 		= email;
					myObject.age 		= age;

					json_string = JSON.stringify(myObject);
					console.log(json_string);

					$('#wrapper').load('forms/kiosk2/success.php', redirect);

					$.ajax({
						url: url,
						type: 'POST',
						contentType: "application/json",
						data: json_string,
						success: function(response) {
							// console.log(json_string);
							//console.log(response);
							console.log(response);
							child_array = [];
							adult_array = [];

							sign_save(sign_taken, response);
							photo_save(photo_taken, response);
							releaseCam();
						}
					});
				}
			});
		});
	</script>


	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Muli');
		/*@import url('https://fonts.googleapis.com/css?family=Raleway');*/

		*{padding: 0;margin: 0;}


		:root{
			--back_button_color: #193441; /*#fd7400;*/
			--next_btn_color: rgb(62,116,206);
			--field_color: white;
			--b_color: white;
			--wrapper_color: white;
		}


		body{
			font-family: 'Roboto', sans-serif;
			background-color: var(--b_color);
			margin: 0;
			padding: 0;
		}

		/*for full screen toggle*/
		#db_click{position: fixed;width: 50px;height: 50px;right: 0;top: 0;background-color: black;}
		
		#wrapper{
			background-color: var(--wrapper_color);
			/*width: 70vw;*/
			width: 80%;
			margin: auto;
			margin-top: 7vh;
			padding:25px;
			box-shadow: 0px 0px 15px -4px rgba(0,0,0,0.69);
			height: auto;
			border-radius: 5px;
		}



		#snackbar{
			/*display: none;*/
			top: -100px;
			/*top: 0;*/
			left: calc(50% - 350px);
			font-size: 30px;
			line-height: 70px;
			position: fixed;

			width: 700px;
			height: 70px;
			background-color: rgb(80,80,80);
			color: orange;
			margin-top: 20px;
			text-align: center;
		}


		/*page styling here*/
		.page_header{
			height: 80px;
			line-height: 65px;
			font-size: 35px;
			text-align: center;
			border-bottom: 1px solid rgb(240,240,240);
			font-family: 'Muli', sans-serif;
		}

		
		.inline_2{
			/*background-color: orange;*/
			display: inline-block;
			vertical-align: top;
			width: 50%;
			margin-right: -4px;
		}

		.text_style{			
			/*background: green;*/
			text-align: right;			
			font-family: 'Raleway', sans-serif;
			/*font-family: 'Muli', sans-serif;*/
			font-weight: 500;
			color: rgb(100,100,100);
			font-size: 23px;
		}
		.text_style span{padding-right: 50px;}

		.row_style{
			height: 70px;
			line-height: 70px;			
		}
		.row_style_small{
			height: 45px;
			line-height: 45px;
			/*background-color: green;*/
		}


		/*children*/
		.child_holder{margin-bottom: 20px;}
		.inline_adult, .inline_child{
			vertical-align: top;
			display: inline-block;
			/*background-color: green;*/
			margin-right: 15px;			
			/*margin-right: -4px;*/
			/*margin-right: 10px;*/
		}



		.adult_first_name, .child_first_name{width: 180px;margin-left: 15px;}
		.adult_last_name, .child_last_name{width: 180px;}
		.adult_age, .child_age{width: 100px;}
		
		

		.dividers{
			display: inline-block;
			vertical-align: top;
			width: 49%;
		}

		#divider{
			border-right: 1px solid black;
			width: 1%;
			height: 30%;
		}

		input[type = "text"], input[type=number]{
			background-color: var(--field_color);
			padding: 10px 15px;
			font-family: 'Muli', sans-serif;
			font-weight: 500;
			font-size: 20px;
		}

		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			margin: 0; 
		}

		.form_spacer{height: 20px;}
		.form_smallspace{height: auto;}
		.form_inline{display: inline-block;}



		#add_children{
		
			margin: auto;
			text-align: center;
			font-family: 'Muli', sans-serif;
			font-size: 20px;
			border: none;
			border-bottom: 1px solid rgb(240,240,240);
			border-top: 1px solid rgb(240,240,240);
		}
		#child_add{
			margin: auto;
		}

		.cross{
			height: 24px;
			width: 24px;
			background:url('css/icons/ic_cancel.png') no-repeat center center;
			background-color: rgb(220,220,220);
			border:1px solid rgb(200,200,200);
			border-radius: 5px;
			padding: 6px;
			margin-top: 3px;
		}

		.cross_a{
			height: 24px;
			width: 24px;
			background:url('css/icons/ic_cancel.png') no-repeat center center;
			background-color: rgb(220,220,220);
			border:1px solid rgb(200,200,200);
			border-radius: 5px;
			padding: 6px;
			margin-top: 3px;
		}

		.children{
			margin: auto;
			font-family: 'Raleway', sans-serif;
			font-size: 19px;
		}

		/*#addcustnext{
		position: relative;
		background-color: var(--next_btn_color);
		width: 30%;
		margin: auto;
		text-align: center;
		font-family: 'Muli', sans-serif;
		font-size: 20px;
		padding: 10px 15px;
		box-shadow: 0 1px 3px 0 #193441;
		border-radius: 5px;
		margin-bottom: 5px;
		}*/




		/*3rd page*/
		#conditions{
			font-family: 'Raleway', sans-serif;
			font-weight: 800;
			font-size: 20px;
			color:black;
		}
		.form_paragraph{
			height: auto;
			line-height: 25px; 
			font-weight: 500;
			padding: 40px;
			color: #6b6b6b;
			font-family: 'Raleway', sans-serif;
		} 
		#checkbox_img{
			margin-top: 10px;
			height: 48px;
			width: 48px;
			background:url('css/unchecked.png');
			/*background:url('css/checked.png');*/
			/*background-color: green;*/
		}
		#checkbox_text:hover{cursor: pointer;}
		#checkbox_img:hover{cursor: pointer;}


		#videoElement {
			transform:rotate(-90deg);
		}
		#video_canvas {
			transform:rotate(-90deg);
		}


		.mat_btn{
			display: inline-block;
			position: relative;
			background-color: var(--back_button_color);
			color: #fff;
			width: 240px;			
			height: 45px;
			line-height: 45px;
			margin:auto;
			border-radius: 5px;
			font-size: 22px;
			font-family: 'Raleway', sans-serif;
			font-weight: 700;
			margin: 0 20px;
			padding: 10px 15px;
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

		.mat_btn_small{
			display: inline-block;
			position: relative;
			background-color: var(--back_button_color);
			color: #fff;
			width: 100px;			
			height: 30px;
			line-height: 30px;
			margin:auto;
			border-radius: 5px;
			font-size: 18px;
			font-family: 'Raleway', sans-serif;
			font-weight: 700;
			margin: 0 20px;
			padding: 10px 15px;
			text-align: center;
			transition: box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
			transition-delay: 0.2s;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
		}
		.next_btn{
			background-color: var(--next_btn_color);
		}


		.radial_anim{
			width: 48px;
			height: 48px;
			padding: 10px;
			margin-left: -10px;
			position: absolute;
			border-radius: 50%;
			background-color: rgb(220,220,220);
			animation-name: radial;
			animation-duration: 1s;
		}
		@keyframes radial {
			from {
				transform: scale(1);
				opacity: 1;
			}
			to {
				transform: scale(1.5);
				opacity: 0;
			}
		}
	</style>

</head>
<body>

<div id="db_click"></div>

<div id="wrapper"></div>


<!-- snackbar -->
<div id="snackbar">ENTER ALL FIELDS</div>

<div id="fade"></div>

<div id="im_full_screen"></div>


</body>
</html>