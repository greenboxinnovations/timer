<!DOCTYPE html>
<html>
<head>
	<title>Tickets</title>
	<style type="text/css">
		*{padding: 0;margin: 0;}
		body{font-family: helvetica;}

		#top_bar{
			height: 150px;
			background-color: rgb(220,220,220);
			width: 100%;
			border-bottom: 1px solid rgb(190,190,190);
		}
		#search_input{margin-left: 50px;height: 50px;width: 650px;font-size: 25px;padding-left: 20px;margin-top: 50px;}
		#search_results{
			position: absolute;
			width: 672px;
			height: auto;
			background-color: white;margin-left: 50px;
			border-right: 1px solid rgb(190,190,190);
			border-left: 1px solid rgb(190,190,190);
			border-bottom: 1px solid rgb(190,190,190);
			/*border:1px solid rgb(190,190,190);*/
			display: none;
		}
		.search_single{
			/*position: absolute;*/
			background-color: white;
			font-size: 25px;
			padding-left: 20px;height: 40px;line-height: 40px;color: rgb(90,90,90);			
			/*z-index: 5;*/
		}
		.search_single:hover{background-color: red;}
		.float_left{float: left;}
		.float_right{float: right;font-size: 20px;margin-right: 20px;}
		.search_active{background-color: orange;}	
		#selected_name{color: rgb(20,20,20);line-height: 60px;margin-left: 50px;font-size: 20px;display: none;}
		#selected_name_cancel{
			background:url('css/icons/ic_cancel.png') no-repeat center center;
			position: fixed;z-index: 5;
			top: 0;left: 0;width: 24px;height: 24px;			
			padding: 10px;
			margin-top: 8px;
			display: none;	
			/*background-color: green;*/
		}
		#selected_name_cancel:hover{cursor: pointer;}


		/*recent customers*/
		.recent_box{
			margin-top: 10px;display: inline-block;width: 33%;margin-right: -5px;vertical-align: top;
		}		
		.recent_single{
			padding-left: 10px;			
			color: rgb(30,30,30);
			/*background-color: green;*/height: 40px;line-height: 40px;			
			border-bottom: 1px solid rgb(190,190,190);
			margin-right: 15px;
			margin-left: 15px;
		}
		.recent_single:hover{background-color: rgb(220,220,220);}



		/*rides*/
		#center_stuff{
			width: 1280px;height: auto;
			/*background-color: green;*/
			margin: 0 auto;
		}
		.box{
			display: inline-block;
			border: 1px solid transparent;
			vertical-align: top;
			width: 140px;			
			/*background-color: orange;*/
			border-radius: 5px;
			height: 160px;
			margin: 10px 20px;
		}
		.box_highlight{background-color: rgb(230,230,230); border: 1px solid rgb(200,200,200);}
		.box:hover{background-color: rgb(230,230,230);cursor: default;}
		.box:active{background-color: rgb(210,210,210);cursor: default;}

		.img_2{
			background:url('css/icons/ic_tower.png') no-repeat center center;
			padding-left: 20px;
			padding-right: 20px;
			/*background-color: red;*/
			height: 100px;
			width: 100px;
			margin: 0 auto;
			/*margin-top: 10px;*/
			padding-top: 10px;
		}

		.box_text{text-align: center;/*background-color: yellow;*/}
		.clear{clear: both;}
		.cancel{

			width: 24px;height: 24px;
			/*background-color: blue;*/
			display: inline-block;
			background:url('css/icons/ic_cancel.png') no-repeat center center;
			vertical-align: top;
			/*background-color: red;*/
			margin-left: 5px;
			margin-top: 2.5px;
			visibility: hidden;
		}

		.number{
			width: 94px;height: 24px;
			font-size: 20px;
			text-align: right;
			/*background-color: yellow;*/
			display: inline-block;
			vertical-align: top;
			/*margin-left: 70px;*/
			margin-top: 2.5px;
			line-height: 24px;
			padding-right: 17px;
			padding-bottom: 4px;			
			/*color: orange;*/
			/*visibility: hidden;*/
		}

		span.no_selection {
			-webkit-user-select: none; /* webkit (safari, chrome) browsers */
			-moz-user-select: none; /* mozilla browsers */
			-khtml-user-select: none; /* webkit (konqueror) browsers */
			-ms-user-select: none; /* IE10+ */
		}
		#btn_holder{width: 450px;height: 90px;/*background-color: green;*/position: fixed;bottom: -100px;right: 0;}
		.mat_btn{
			display: inline-block;
			position: relative;
			/*background-color: var(--back_button_color);*/
			background-color: rgb(100,100,100);
			color: #fff;
			width: 180px;
			height: 30px;
			line-height: 30px;
			margin:auto;
			border-radius: 5px;
			font-size: 20px;
			/*font-family: 'Raleway', sans-serif;*/
			/*font-weight: 700;*/
			margin: 0 10px;
			padding: 10px 0px;
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
		.next_btn{
			background-color: rgb(0,162,232);
		}

		#total_val{
			text-align: center;position: fixed;width: 250px;height: 60px;bottom: -100px;
			background-color: rgb(20,20,20);
			border-radius: 3px;
			color: rgb(240,240,240);
			font-weight: bold;
			line-height: 60px;font-size: 22px;margin-left: 24px;margin-bottom: 10px;
		}

	</style>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			// search functions
			function inputSearch($div){
				setTimeout(function () {
					var name = $div.val();					
					if(name != ""){

						$.ajax({
							url: "search.php",
							type: "GET", //send it through get method
							data:{ name : name },
							success: function(data) {							
								if(data == -1){		
									dismissSearch();
								}else{
									$('#search_results').show();
									$('#search_results').html(data);
									$('.search_single').first().addClass('search_active');
								}
							},
							error: function(xhr) {}
						});//ajax
					}//length check
					else{
						dismissSearch();
					}				
				}, 1);//set timeout
			}
			function downKey(){
				var s_single 		= $('.search_single');
				var active 			= $('.search_active');
				var act_index 		= active.index();
				var next 			= ++act_index;
								
				if(active.next().length != 0){
					s_single.removeClass('search_active');
					s_single.eq(next).addClass('search_active');
				}else{
					s_single.removeClass('search_active');
					s_single.eq(0).addClass('search_active');
				}
			}
			function upKey(){
				var s_single 		= $('.search_single');
				var active 			= $('.search_active');
				var act_index 		= active.index();
				var next 			= --act_index;

				if(active.next().length == -1){
					s_single.removeClass('search_active');						
					s_single.last().addClass('search_active');
				}else{
					s_single.removeClass('search_active');						
					s_single.eq(next).addClass('search_active');
				}
			}
			function escapeKey(){
				dismissSearch();
			}
			function enterKey($val){
				console.log('enter was pressed');

				var $act_div		= $('.search_active');
				var active_length 	= $act_div.length;
				var $name 			= $act_div.find('.float_left').text();
				cust_id 			= $act_div.find('.float_left').attr('id');
							
				// -999 is no results
				if( (cust_id != -999) && (active_length > 0) ){
					$('#search_input').fadeOut(300);
					dismissSearch();
					$("#top_bar").animate({
						height: '60px'
					}, 500, function(){
						$('#selected_name').text($name).fadeIn(300);
						$('#selected_name_cancel').fadeIn(300);

						loadRides();
					});	
				}
			}
			function dismissSearch(){
				$('#search_input').val("");
				$('#search_results').hide();
				$('#search_results').empty();
			}


			function revertCss(){
				hideBtns();
				hideTotal();
				$('#selected_name').fadeOut(300);
				$('#selected_name_cancel').fadeOut(300);
				loadRecent();
				$("#top_bar").animate({				
					height: '150px'					
				}, 500, function(){
					$('#search_input').val("").fadeIn(300);
				});
			}


			function loadRecent(){
				if (!click) {
					$('#wrapper_lower').load('display/tickets/live_customers.php');
				}
				
			}

			function loadRides(){
				$('#wrapper_lower').load('display/tickets/choose_rides.php');
				amount = 0;
			}


			function showBtns(){
				$("#btn_holder").animate({				
					bottom: '0px'					
				});
			}
			function hideBtns(){
				$("#btn_holder").animate({			
					bottom: '-100px'					
				});
			}


			function boxClick($div){
				// show btns if first click
				var hbox_num = $('.box_highlight').length;
				console.log(hbox_num);
				if(hbox_num == 0){
					showBtns();
				}

				var no = 0;
			
				// console.log($div.find('.box_text span').text());
				if(!$div.hasClass('box_highlight')){
					$div.find('.cancel').css('visibility', 'visible');
					$div.find('.number span').text("1");
					no = 1;
					// replace with blue image
					var v = $div.find('.img_change').css('background-image');
					var result = v.split('/');
					var blue_img = result[6].replace('.png")', '').trim() + "_b.png";
					//console.log(blue_img);
					$div.find('.img_change').css("background-image", "url(css/icons/"+blue_img+")");

					// console.log(v);
					$div.addClass('box_highlight');
					
					//console.log('add class');
				}
				else{
					no = $div.find('.number span').text();
					no++;
					$div.find('.number span').text(no);
					
				}	

				calculateTotal();

			}
			function boxCancel($div){

				// replace image
				var v = $div.find('.img_change').css('background-image');
				var result = v.split('/');
				var img = result[6].replace('_b.png")', '').trim() + ".png";
				// console.log(result[6]);
				$div.find('.img_change').css("background-image", "url(css/icons/"+img+")");

				$div.find('.cancel').css('visibility', 'hidden');
				$div.find('.number span').text("");			
				$div.removeClass('box_highlight');

				// hide btns if last box
				var hbox_num = $('.box_highlight').length;
				console.log(hbox_num);
				if(hbox_num == 0){
					hideBtns();
				}

				calculateTotal();
			}	

			function calculateTotal(){
				var count = $('.box_highlight').length;
				var amount = 0;

				if (count>0){
					$('.box_highlight').each(function(){
						var rate = $(this).find('.box_text span').attr("rate");	
						var no 		= $(this).find('.number span').text();
						amount +=  (rate*no);
					});
					showTotal(amount);
				}
				else{
					hideTotal();
				}
				// console.log("total is "+amount);				
			}

			function showTotal(val){
				$('#total_val').text("Total "+val);
				$('#total_val').animate({
					'bottom': '0'
				});
			}
			function hideTotal(){
				setTimeout(function() {
					$('#total_val').animate({
						'bottom': '-100px'
					});
				}, 400);				
			}

			function printTicket(names, ride_ids, nos, cust_id){



				$.ajax({
					url: 'exe/print_ticket.php',
					type: 'POST',
					data:{
						names 		: names,
						ride_ids	: ride_ids,
						nos   		: nos,
						cust_id 	: cust_id
					},
					success: function(response){
					 revertCss();
					 //cust_id = 0;
					}
				});

			}		


			// globals
			loadRecent();
			var click = false;
			var cust_id =  0;
			// loadRides();

			setInterval(function(){
				loadRecent();
			}, 5000);


			$('#search_input').on('keydown',function(e){
				// console.log(e.keyCode);
				var ref = $(this);
				var val = ref.val();
				// enter
				// if(e.keyCode == 13){
				// 	var val = ref.val();
				// 	enterKey(val);
				// 	//update cust_id
				// }


				switch(e.keyCode){
					case 13:							// Enter
						console.log("Enter key");						
						enterKey(val);
						//update cust_id
						break;
					case 27:							// Escape
						console.log("Escape key");
						escapeKey();
						break;
					case 40:							// Down						
						downKey();
						break;
					case 38:							// Up						
						upKey();
						break;
					default:							// valid key						
						inputSearch(ref);
						break;
				}


			});


			$('body').delegate('.recent_single','click', function(){

				var $name 	= $(this).text();
				cust_id 	= $(this).attr("id");
				click 		= true;

				$('#search_input').fadeOut(300);
				dismissSearch();
				$("#top_bar").animate({
					height: '60px'
				}, 500, function(){
					$('#selected_name').text($name).fadeIn(300);
					$('#selected_name_cancel').fadeIn(300);

					loadRides();
				});
			});

			$('body').delegate('.search_single','click', function(){
				var $name 	= $(this).find('.float_left').text();
				cust_id 	= $(this).find('.float_left').attr('id');
				click 		= true;

				$('#search_input').fadeOut(300);
				dismissSearch();
				$("#top_bar").animate({
					height: '60px'
				}, 500, function(){
					$('#selected_name').text($name).fadeIn(300);
					$('#selected_name_cancel').fadeIn(300);

					loadRides();
				});
			});

			$('body').delegate('.goback','click', function(){
				click = false;
				revertCss();
			});

			//printing
			$('body').delegate('#print','click', function(){

				var nos = [];
				var ride_ids = [];
				var names = [];


				$('.box_highlight').each(function(){
					var name 	= $(this).find('.box_text span').text();
					var ride_id = $(this).find('.box_text span').attr('ride_id');
					var no 		= $(this).find('.number span').text();


					nos.push(no);
					ride_ids.push(ride_id);
					names.push(name);

					// if ((name == 'go karting 1')||(name == 'go karting 2')) {
					
					// }					
				});

				printTicket(names,ride_ids, nos, cust_id);
				click = false;			
			});

			// choose rides
			$('body').delegate('.box :not(.cancel)', 'click', function(e) {
				e.stopPropagation();				
				var $div = $(this).closest('.box');
				boxClick($div);				
			});

			$('body').delegate('.cancel', 'click', function(e) {
			// $('.cancel').on('click', function(){
				var $div = $(this).closest('.box');
				boxCancel($div);
			});
		});
	</script>
</head>
<body>

<!-- top bar -->
<div id="top_bar">

	<div id="selected_name">Rohit Mane</div>
	<div id="selected_name_cancel" class="goback"></div>
	<input type="text" id="search_input" placeholder="Search" value="">
	<div id="search_results">
		<!-- <div class="search_single">
			<div class="float_left">Rohit Mane</div>
			<div class="float_right">9762230207</div>
		</div>
		<div class="search_single">
			<div class="float_left">Rohit Sharma</div>
			<div class="float_right">8411815106</div>
		</div>
				<div class="search_single">
			<div class="float_left">Rohit Sharma</div>
			<div class="float_right">8411815106</div>
		</div> -->
	</div>
</div>


<div id="wrapper_lower"></div>
<!-- <button id="canned">Cancel</button> -->

<div id="total_val">Total 350</div>

</body>
</html>