<div id="main_div">

	<div class="page_header">Photo and Signature</div>
	<div class="bhari">
		<div id="webcam" style="text-align: center;margin-top: 80px;">
			<video autoplay="true" id="videoElement" width="384" height="288" style="border:1px solid #a9a9a9;border-radius: 3px;"></video>			
			<canvas id="video_canvas" width="384" height="288" style="border:1px solid #a9a9a9;border-radius: 3px;"></canvas>
		</div>

		<div class="buttons">
			<div class="mat_btn_small" id="click_photo">CAPTURE</div>
			<div class="mat_btn_small" id="retake_photo">RETAKE</div>
		</div>		
	</div>


	<div id="sign_canvas" class="bhari" style="text-align: center;margin-top: 50px;">
		<div><canvas id="sketchpad" height="300" width="400" style="border:1px solid black;"></div>

		<div class="buttons">
			<!-- <div class="mat_btn_small" id="sign_btn">SAVE</div> -->
			<div class="mat_btn_small" id="sign_clr">CLEAR</div>			
		</div>
	</div>

	<div style="text-align: center;margin-top: 35px;margin-bottom: 30px;">
		<div class="mat_btn" id="wcback">BACK</div>
		<div class="mat_btn next_btn" id="save_customer">SAVE</div>
	</div>	
</div>