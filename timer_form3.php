<?php
//require 'lock.php';

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
  <title>Customers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

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


    $(document).ready(function() {

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
              'bottom': '0'
          }, function() {
              setTimeout(function() {
                  $('#snackbar').animate({
                      'bottom': '-50px'
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

      function loadForm(){        
        $('#wrapper').load('forms/standalone_form/phone_number.php');
      }

      function flashRed(div){


        var fade_time = 250;
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

      loadForm();
      // Validation for Add Customer Form
      $('body').delegate('.name_validate', 'keydown', nameValidate); 
      $('body').delegate('.num_validate', 'keydown', numberValidate);
      $('body').delegate(':text', 'click', removeRed);


      var phone_number = "";
      var firstname = "";
      var lastname = "";
      var email = "";
      var age = "";
      var child_count = 1;
      var child_array = [];

      var child_html = ['child_first_name', 'child_last_name', 'child_age'];
      var cust_html = ['first_name','last_name','age','email'];


      $('body').delegate('#ph_no_next', 'click', function(){

          phone_number = $('#phone_number').val();
          if(phone_number.length != 10){
            var ph_no_html = $('#phone_number');
            flashRed(ph_no_html);
            showSnackBar("Please enter a valid phone number");
          }else{
            $('#wrapper').load('forms/standalone_form/new_customer.php');
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

      $('body').delegate('#ncback', 'click', function(){
          $('#wrapper').load('forms/standalone_form/phone_number.php', function() {
            $('#phone_number').val(phone_number);
          });
      });


      $('body').delegate('#add_children', 'click', function() {
          
          $("html, body").animate({ scrollTop: $(document).height() }, 1000);
          lastname = $('#last_name').val();

          $('#child_add').append('<div class="form_row" style="margin-bottom:15px"><div class="form_inline children">Child ' + child_count + '<div class="input_placeholder form_inline" style="margin-left:60px"><input type="text" class="child_first_name name_validate"  placeholder="firstname"><span class="bar"></span></div><div class="input_placeholder form_inline" style="margin-left:80px"><input type="text" class="child_last_name name_validate"  placeholder="lastname" value="' + lastname + '"><span class="bar"></span></div><div class="input_placeholder form_inline" style="margin-left:80px"><input type="text" class="child_age num_validate" placeholder="Age" style="width:150px"><span class="bar" style="width:115px"></span></div><div class="form_inline cross"></div></div></div>');

          child_count++;
      });



      $('body').delegate('.cross', 'click', function() {          
          $(this).parent().parent().remove();
          child_count--;
      });

      $('body').delegate('#addcustnext', 'click', function() {


        firstname = $('#first_name').val();
        lastname = $('#last_name').val();
        age=$('#age').val();
        email=$('#email').val();
        var cust_validate = true;
        var child_validate = [];

        if((firstname=='')||(lastname=='')||(email=='')||((age=='')||(age <=0)||(age >=120)))
        {
          for(var i=0;i<cust_html.length;i++)
          {
            var temp_html = $('#' +cust_html[i]);
            var temp_val=temp_html.val();
            if(temp_val=="")
            {
              (temp_html.parent()).addClass("highlight");
              flashRed(temp_html.parent());
              
            }
          }
          cust_validate = false;
        }

        $('.children').each(function(){
          var ref=$(this);
          var child_first_name=$(this).find('.child_first_name').val();
          var child_last_name = $(this).find('.child_last_name').val();
          var child_age = $(this).find('.child_age').val();
          var flag=false;

          for(var i=0;i<child_html.length;i++)
          {
            var temp_html = ref.find('.' +child_html[i]);
            var temp = temp_html.val();
            if(temp=="")
            { 

                (temp_html.parent()).addClass("highlight");                
                temp_html.addClass("placeholder_red");

                flashRed(temp_html.parent());
                flag=true;
            }
          }
          if(flag==false)
          {
            var child = {};
            child.firstname = child_first_name;
            child.lastname = child_last_name;
            child.age = child_age;
            console.log(child);
            child_array.push(child);
          }

          child_validate.push(flag);

        });

        if((cust_validate) && !($.inArray(true, child_validate) !== -1)){
            $('#wrapper').load('forms/standalone_form/termsAndConditions.php', function(){
              $('#s1').text(firstname+' '+lastname);
              $('#s2').text(phone_number);
              $('#s3').text(age); 
            });
        }            
        else{
          showSnackBar("Please enter appropriate values!");
        }
          


    });




      $('body').delegate('#tncback', 'click', function() {

          $('#wrapper').load('forms/standalone_form/new_customer.php', function() {
            $('#first_name').val(firstname);
            $('#last_name').val(lastname);
            $('#age').val(age);
            $('#email').val(email);
          });
      });

      $('body').delegate('#tncnext', 'click', function() {

          if ($('#tnc').is(':checked')) {
              $('#wrapper').load('forms/standalone_form/importantNotes.php');
          } else {
              showSnackBar("Please agree to the terms and conditions!");
          }


      });

      $('body').delegate('#ipback', 'click', function() {

          $('#wrapper').load('forms/standalone_form/termsAndConditions.php', function() {
              $('#s1').text(firstname + ' ' + lastname);
              $('#s2').text(phone_number);
              $('#s3').text(age);
          });

      });


      $('body').delegate('#ipnext', 'click', function() {

          $('#wrapper').load('forms/standalone_form/wcsign.php');

      });

     
      $('body').delegate('#save_customer', 'click', function() {

          var url = 'api/customers';
          var action = 'insert';

          var myObject = {};
          myObject.action = action;
          myObject.firstname = firstname;
          myObject.lastname = lastname;
          myObject.phone_number = phone_number;
          myObject.child = child_array;
          myObject.email = email;
          myObject.age = age;

          json_string = JSON.stringify(myObject);
          console.log(json_string);

          $.ajax({
              url: url,
              type: 'POST',
              contentType: "application/json",
              data: json_string,
              success: function(response) {
                  console.log(json_string);
                  //console.log(response);
                  console.log(response);
                  child_array = [];
                  loadForm();

              }
          });
      });



  });
  </script>
  <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Muli');
      @import url('https://fonts.googleapis.com/css?family=Raleway');

      :root{
        --back_button_color: #193441; /*#fd7400;*/
        --next_btn_color: #fd7400;
        --field_color: white;
        --b_color: white;
        --wrapper_color: white;
      }

      body{
        background-color: var(--b_color);
        margin: 0;
        padding: 0;
      }

      #wrapper{
        background-color: var(--wrapper_color);
        width: 70vw;
        margin: auto;
        margin-top: 7vh;
        padding:25px;
        box-shadow: 0px 0px 15px -4px rgba(0,0,0,0.69);
        height: auto;
      }

       #snackbar{
          /*display: none;*/
          position: fixed;bottom: -50px;
          width: 30vw;
          height: 50px;
          background-color: rgb(20,20,20);
          color: white;
          right: 0;
          margin-right: 40px;
          line-height: 50px;
          padding-left: 24px;
      }

      .form_row{
        display: inline;
        height: 7vh;
        line-height: 7vh;
        padding-left: 64px;
        color: #6b6b6b;
      }

      #form_content{
        margin: auto;
      }

      .text_placeholder{
        width: 160px;
        font-family: 'Raleway', sans-serif;
        font-size: 19px;
      }
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
        font-family: 'Raleway', sans-serif;
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

      .show_row{
        height: 60px;
        line-height: 48px;
        padding-left: 24px;
        border-bottom: 1px solid rgb(240,240,240);
        font-size: 30px; 
        text-align: center;
        font-family: 'Muli', sans-serif;
      }

      #add_children{
        width: 90%;
        margin: auto;
        text-align: center;
        padding: 10px 15px;
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
        background:url('css/icons/ic2_cancel_24px.png') no-repeat center center;
        margin-left: 60px;
        vertical-align: top;
        margin-top: 10px;
        height: 24px;
        width: 24px;
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


      .form_paragraph{
        height: auto;
        line-height: 25px; 
        font-weight: 500;
        padding: 40px;
        color: #6b6b6b;
        font-family: 'Raleway', sans-serif;
      } 

      #conditions{
        font-family: 'Raleway', sans-serif;
        font-weight: 800;
        color:black;
      }


      

      .mat_btn{
        display: inline-block;
        position: relative;
        background-color: var(--back_button_color);
        color: #fff;
        width: 25%;
        margin:auto;
        border-radius: 2px;
        font-size: 1.1em;
        font-family: 'Raleway', sans-serif;
        font-weight: 700;
        margin: 0 80px;
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
      .next_btn{
        background-color: var(--next_btn_color);
      }

    



      #ph_no{
        /*position: relative;*/
        display: table;
        margin: auto;
      }
      #ph_no_next{
        display: table;
        margin: 0 auto;
      }

  </style>
</head>
<body>


  <div id="wrapper"></div>




  <!-- snackbar -->
  <div id="snackbar"></div>

  <div id="fade"></div>

  <div id="im_full_screen"></div>

</body>

  
</html>
    




