<div id="main_div">

	<div class="page_header">Photo and Signature</div>
	<div class="bhari">
		<div id="webcam" style="text-align: center;margin-top: 30px;">
			<video autoplay="true" id="videoElement" width="384" height="288" style="border:1px solid #a9a9a9;border-radius: 3px;"></video>
			<canvas id="canvas" width="384" height="288" style="border:1px solid #a9a9a9;border-radius: 3px;"></canvas>
		</div>

		<div class="buttons" style="text-align: center;">
			<button id="click_photo">Click Photo</button>
			<button id="retake_photo">Retake Photo</button>
		</div>		
	</div>


	<div id="sign_canvas" class="bhari" style="text-align: center;margin-top: 50px;">
		<div><canvas id="sketchpad" height="300" width="400" style="border:1px solid black;"></div>

		<div class="buttons">
			<input type="button" value="Save" id="btn" size="30" >
	    	<input type="button" value="Clear" id="clr" size="23">
		</div>
	</div>

<!-- 	<div class="form_button_holder">
		<div class="mat_btn" id= "wcback">BACK</div>
		<div class="mat_btn" style="margin-left: 25px;background-color: #0087C1;" id="save_customer" >SAVE</div>
	</div> -->

	<div style="text-align: center;margin-top: 35px;margin-bottom: 30px;">
		<div class="mat_btn" id="wcback">BACK</div>
		<div class="mat_btn next_btn" id="save_customer">SAVE</div>
	</div>	
</div>