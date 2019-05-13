<?php
date_default_timezone_set("Asia/Kolkata");

  include '../../query/conn.php';

  $cust_id = $_GET['cust_id'];

  $sql="SELECT * FROM `customers` WHERE `id` = '$cust_id' ;";

  $info=mysqli_query($conn,$sql);
  $count=mysqli_num_rows($info);

  echo' <div id="approval_holder">';

  echo'<div id="approval_center_div">';

    if($count==0){
      echo'<div id="approval_center_header">NO DATA</div>';
    }
    else{

      while($row = mysqli_fetch_assoc($info)){

        echo '<div class="single_container">';

        echo '<div id="approval_center_header">'.strtoupper($row['name']).' -  '.$row['no'].'</div>';
       
        // single container
        echo'</div>';
      }

       
      

      echo'<div style="float:left;margin-top:20px;" class="mat_btn" id="cancel">OK</div>';
    }
  echo'</div>';

  echo'</div>';

//////////////////////////////////  REMOVE /SPARTAN FROM ALL DIRECTORIES
?>.

<!-- float right -->
   

      
    