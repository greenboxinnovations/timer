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

  <link href="css/main.css" rel="stylesheet">
  <link href="css/company_nav.css" rel="stylesheet">

  <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"> -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){

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
        $('#snackbar').animate({'bottom':'0'},function() {
          setTimeout(function(){
            $('#snackbar').animate({'bottom':'-50px'});           
          },2000);
        });
      }

      function loadCompCars(comp_id){
        $('#wrapper').load('display/customers/cust_list.php');
      }

      function init() {
        // $('#result').load('display/cars/cars.php');
        loadCompCars(comp_id);
      }

      // globals
      var comp_id = 1;
      var comp_name = $('.company_bar_company.company_bar_company_active').text();
      console.log(comp_id+' '+comp_name);
      init();

      // click functions
      // company Selector 
      $('.company_bar_company').on('click',function(){
        if(!$(this).hasClass('company_bar_company_active')){
          $('.company_bar_company').removeClass('company_bar_company_active');
          $(this).addClass('company_bar_company_active');

          comp_id = $(this).attr('company_bar_comp_id');
          comp_name = $(this).text();
          // console.log(comp_id+' '+comp_name);
          loadCompCars(comp_id);
        }
      });

    
      // cancel edit
		$('body').delegate('#cancel', 'click', function() {

			$('#result').empty();
			loadCompCars(comp_id);
			$('#fab').show();
		});



      // cancel edit
      $('body').delegate('.car_list_single', 'click', function() {
        var car_id = $(this).attr('id');       
        $('#wrapper').load('display/customers/customer_details.php?cust_id='+car_id);       
      });

     

      // cancel edit
      $('body').delegate('img', 'click', function() {

          var src = $(this).attr('src');

          $('#fade').fadeIn(600,function(){
            $("#im_full_screen").fadeIn(800); 
            $('#im_full_screen').css("background-image", "url("+src+")"); 
          }); 
       
      });

      // fab
		$('body').delegate('#fab', 'click', function() {

			$.ajax({
				url  : 'forms/customers/new_customer.php',
				type : 'get',
				success: function(response){
					$('#wrapper').html(response);
				}
			});

			$(this).hide();
		}); 

    			// save
			$('body').delegate('#save_company', 'click', function() {
				var url = 'api/customers';
			
				var cin = $("#cin").val();
				var company_name=$("#company_name").val();

				var action = 'insert';


				if((cin=='')||(company_name==''))
				{
					// alert("please enter appropriate value");
					showSnackBar("Please enter appropriate values!");
				}
				else{
					var myObject = {};
					myObject.action = action;
					myObject.name = company_name;
					myObject.no = cin;

					json_string = JSON.stringify(myObject);
					console.log(json_string);

					$.ajax({
						url: url,
						type: 'POST',
						contentType: "application/json",
						data:json_string,
						success: function(response){
							console.log(json_string);
							//console.log(response);
							showSnackBar(response);
							loadCompCars(comp_id);
							$('#fab').show();
						}
					});
				}
			});


      $('#fade').on('click',function(){
        
        $('#im_full_screen').fadeOut(600);
        $('#fade').fadeOut(600);
        
      });

    });
  </script>
  <style type="text/css">

    /*@override*/
    #wrapper{overflow: hidden;}

    #result{width: 964px;background-color: white;margin: 0px auto;margin-top: 64px;}

    #snackbar{
      /*display: none;*/
      position: fixed;bottom: -50px;
      width: 400px;
      height: 50px;
      background-color: rgb(20,20,20);
      color: white;
      right: 0;
      margin-right: 40px;
      line-height: 50px;
      padding-left: 24px;
    }

    .text_selected{color: #5264AE;font-weight: 500;} 

    /*static row*/
    .show_row{height: 48px;line-height: 48px;padding-left: 24px;border-bottom: 1px solid rgb(240,240,240);}
    .inline{display: inline-block;vertical-align: top;}
    .gqg_no{width: 300px;}
    .per_comp{width: 50px;text-align: right;}
    .num_val{width: 80px;text-align: right;color: rgba(0,0,0,0.8);}
    .start_date{text-align: right;width: 120px;color: rgba(0,0,0,0.8);}
    .tcf_no{width: 150px;text-align: right;color: rgba(0,0,0,0.8);margin-right: 24px;}
    /*.more_icon{width: 48px;background-color: green;text-align: center;margin-left: 24px;}*/
    .more_icon{           
      background-color: green;
      background: url('css/icons/ic_down_dark.png') no-repeat center center;
      width: 48px;
      height: 48px;     
    }

    

    /*this has to be below- overides color above*/
    .header{color: rgba(0,0,0,0.3);font-weight: 500;}


    /*toggle row*/
    .inline_3{width: 318px;/*background-color: green;*/display: inline-block;
      color: rgba(0,0,0,0.6);
      vertical-align: top;
    }
    .name{
      width: 100px;/*background-color: green;*/padding-left: 24px;height: 48px;line-height: 48px;
      font-size: 12px;font-weight: 900;}
    .val{/*background-color: grey;*/
      height: 48px;
      line-height: 48px;width: 160px;padding-left: 24px;
      font-size: 12px;font-weight: 900;
    }
    .spacer{height: 40px;line-height: 40px;border-top: 1px solid rgb(240,240,240);border-bottom: 1px solid rgb(240,240,240);text-align: right;font-size: 500;font-style: italic;font-size: 13px;
      margin-right: 12px;
      }
    .spacer span{padding-right: 12px;padding-left: 12px;padding-top: 6px;padding-bottom: 6px;border-radius: 2px;}
    .spacer span:hover{background-color: rgb(200,200,200);cursor: pointer;}
    .spacer span:active{background-color: rgb(160,160,160);}
    .toggle_row{display: none;}
 

    /*fab*/
    #fab{
      background: url('css/icons/ic_add.png') no-repeat center center;
      height: 50px;width: 50px;
      border-radius: 50%;
      position: fixed;
      background-color: #1aba7a;
      z-index: 2;bottom: 0;right: 0;margin-bottom: 25px;margin-right: 25px;
      -webkit-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.6);
      -moz-box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.6);
      box-shadow: 0px 1px 4px 0px rgba(0,0,0,0.6);
    }
    #fab:active{background-color: #138e5d;}

    .radial_anim{
      width: 48px;
      height: 48px;     
      position: absolute;     
      border-radius: 50%;
      background-color: rgb(220,220,220);     
      animation-name: radial;
      animation-duration: 1s;
    }


    /*forms*/
    #form_main{background-color: white;}
    .form_row{height: 48px;line-height: 48px;padding-left: 64px;color: #6b6b6b;}
    .form_spacer{height: 20px;}
    .form_inline{display: inline-block;/*background-color: green;*/}
    .text_placeholder{width: 200px;}
    .input_placeholder input{
      font-size:17px;
      padding:5px 10px 5px 5px;
      display:block;
      width:250px;
      border:none;
      border-bottom:1px solid #757575;
    }
    .input_placeholder input:focus{ outline:none; }
    .form_divider{height: 20px;border-top: 1px solid rgb(230,230,230);margin-top: 5px;}

    /* BOTTOM BARS*/
    .bar { position:relative; display:block; width:265px; }
    .bar:before, .bar:after {
      content:'';
      height:1.5px; 
      width:0;
      bottom:1px; 
      position:absolute;
      background:#5264AE; 
      transition:0.2s ease all; 
      -moz-transition:0.2s ease all; 
      -webkit-transition:0.2s ease all;
    }
    .bar:before {
      left:50%;
    }
    .bar:after {
      right:50%; 
    }
    .input_placeholder input:focus ~ .bar:before, .input_placeholder input:focus ~ .bar:after {
      width:50%;
    }

    select{padding:7px 10px 7px 10px;width: 265px;}
    select:focus{outline: none;}
    option{height: 48px;}

    .form_button_holder{padding-left: 64px;padding-top: 0px;padding-bottom: 40px;}

    .mat_btn{
      display: inline-block;
      position: relative;
      /*background-color: #4285f4;*/
      background-color: rgb(100,100,100);
      color: #fff;
      width: 120px;
      height: 32px;
      line-height: 32px;
      border-radius: 2px;
      font-size: 0.9em;
      text-align: center;
      transition: box-shadow 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      transition-delay: 0.2s;
      box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
    }
    .mat_btn:hover{cursor: pointer;}
    .mat_btn:active {
      background-color: rgb(90,90,90);
      box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
      transition-delay: 0s;
    }
    /*Cars Single Page css*/

    /*#main_wrapper{
      float: left;/*margin-left: 15em;margin-top: 4em;*/
      /*margin: 4em 15em 0em 15em;
      margin-top: 4em;
      width: calc(100% - 30em);*/
      /*background-color: green;*/
      /*height: auto;*/
    /*}*/
    /*#main_content{padding:5em;padding-top: 3em;}*/


    #gqg_heading{font-size: 2em;}
    #act_inact{color: green;margin-top: 0.5em;margin-bottom: 1em;}

    /*box with values*/
    .box_car_stats{display: inline-block;background-color: green;margin-right: 0.5em; border-radius: 2px;}
    .box_content{display: table;width: 8em;height: 5em;padding-left: 1.5em;}
    .box_vert{display: table-cell;vertical-align: middle;}
    .box_header{font-size: 0.9em;}
    .box_value{font-size: 1.4em;}
    .box_clear{clear: both;}

    #dummy{margin-top: 2em;}
    /**/
    #problem_table_holder{width: 65%;background: white;margin-left: 30px; border-radius: 5px;padding: 20px;}
    table{border-collapse: collapse; margin-left: 30px;}
    td{border: 1px solid rgb(200,200,200);font-size: 14px;color: rgb(20,20,20);padding: 5px;}
    .ptab_right{text-align: right;}

    .toggle{display: none;}

    /*porting*/
    #fade{
      display: none;
      width: 100%;height: 100%;background-color: rgba(0,0,0,0.9);
      position: fixed;z-index: 2;top: 0;
    }

    #im_full_screen{
      display: none;
      position: fixed;
      z-index: 3;     
      
      background-image: url("uploads/no_image.png");
      background-position: center; 
      background-repeat: no-repeat;
      background-size: cover;

      top: 0;
      width: 500px;
      height: 500px;
      top: 50%;
        left: 50%;
      margin-top: -250px;
        margin-left: -250px;
    }
    /*left and right divs*/
    #car_list{float: left;width: 30%;height: auto;margin-top:  60px}
    #approval_holder{float: right;width: 70%;height: auto;/*background-color: orange;*/margin-top:  60px;}

    /*car list*/
    .car_list_single{height:36px;line-height:36px;width: 220px;margin: 0 auto;background-color: rgb(240,240,240);padding-left: 36px;}
    .car_list_single:hover{background-color: orange;}

    /*center div*/
    #approval_center_div{width: 680px;background-color: white;margin: 0px auto;height: auto;margin-bottom:  20px;}
    #approval_center_header{height: 40px;line-height: 40px;padding-left: 12px;background-color: rgb(130,130,130);color: rgb(240,240,240);}

    /*inline block for images*/
    .img_inline{
      display: inline-block;
      margin-top: 1px;  
      width: 170px;
      background-color: white;
      text-align: center;
      height: 200px;
    }

    .fpair_inline{
      display: inline-block;
      margin-top: 1px;  
      width: 340px;
      background-color: white;
      text-align: center;
      height: 200px;
    }

    #approval_center_div img{margin-top: 8px;width: 150px;border:1px solid transparent;}
    #approval_center_div img:hover{border:1px solid rgb(200,200,200);}

    /*img{margin-top: 8px;width: 150px;}
    img:hover{-webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.35);}*/

    #approval_center_div input{width: 100px;}
    .img_push_left{font-size: 11px;text-align: left;margin-left: 10px;}

    
    /*approve btns*/
    #btn_holder{height: 60px;line-height: 60px;}
    .btn{width: 80px;height: 25px;margin-left: 12px;}

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

    @media only screen and (max-width: 965px){
      #wrapper{overflow: auto;}
    }
  </style>
</head>
<body>

<!-- app nav -->
<div id="app_bar">  
  <div id="menu"><img src="css/icons/ic_menu.png"></div>
  <div id="app_name">Spartan</div>
</div>

<!-- side nav -->
<div id="side_nav">
  <div id="side_nav_padding">
    <?php $active_page = 'customers'; ?>
    <?php include_once 'nav/nav.php'; ?>
  </div>
</div>

<!-- wrapper -->
<div id="wrapper">
    <!-- float left -->
    <div id="car_list">
      
    </div>

    <!-- float right -->
    <div id="approval_holder">

      
    </div>
</div>

<!-- fab -->
<div id="fab"></div>

<!-- snackbar -->
<div id="snackbar"></div>

<div id="fade"></div>

<div id="im_full_screen"></div>

</body>
</html>
    
  
  
  
