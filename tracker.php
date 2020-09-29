<?php

require_once("assets/config/config.php");
if(!empty($_GET)){
  $tracking_code = $_GET['tracking_code'];
}
else{
  $tracking_code = '';
}

 $result= mysqli_query($link,"SELECT inmerce_order_number, delivery_date, delivery_phase FROM trackingcodes WHERE inmerce_trackingcode = '$tracking_code'");

 if(mysqli_num_rows($result) == 1){
  while($row = mysqli_fetch_assoc($result)){
    $Order_id = $row['inmerce_order_number'];
    $delivery_day = $row['delivery_date'];
    $delivery_phase = $row['delivery_phase'];
  }
 }
else{
  $Order_id = '';
}


$Orderfeed_columns = array(
  "Order_Date",
  "concat(Shipping_First_Name,' ',Shipping_Last_Name) as 'Name'",
  "Shipping_Company",
  "Shipping_Address_1",
  "Shipping_City",
  "Shipping_Postcode"
);
if(!empty($Order_id)){
  $result= mysqli_query($link,"SELECT Order_Date,concat(Shipping_First_Name,' ',Shipping_Last_Name) as 'Name',Shipping_Company,
                                Shipping_Address_1,Shipping_City,Shipping_Postcode FROM Orderfeed WHERE Order_ID = $Order_id");


    while($row = mysqli_fetch_assoc($result)){
      foreach($row as $key=> $value){
        $Order_info[$key] = $value;
      }
    }
}
else{
  foreach($Orderfeed_columns as $key){
    $Order_info[$key] = '';
  }
  $Order_info['Name'] = '';

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="assets/img/search-location-solid.svg">
  <title>Order Tracking Online</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="assets/css/styles.css">
</head>



<body>

  <div class="container">

    <div class="row justify-content-md-center top-row tracker-top-row">
      <div class="col-md d-flex justify-content-between align-items-end">

        <a href="index.php">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
          </svg>
          Vorige pagina
        </a>

        <a href="#">
          Nederlands
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
          </svg>
        </a>

      </div>
    </div>

    <div class="row justify-content-center mid-row">
      <div class="col-md d-flex justify-content-center">

        <div class="tracking-code-display">
          <h4>Tracking code:</h4>
          <h1><?php echo $tracking_code ?></h1>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md">
        <div class="card">
          <ul id="progressbar">
            <li class="step1 <?php if($delivery_phase>=1) echo "active"?>"><h3>Order geplaatst</h3></li>
            <li class="step2 <?php if($delivery_phase>=2) echo "active"?>"><h3>Pakket verzonden</h3></li>
            <li class="step3 <?php if($delivery_phase>=3) echo "active"?>"><h3>Bezorger onderweg</h3></li>
            <li class="step4 <?php if($delivery_phase>=4) echo "active"?>"><h3>Pakket bezorgd</h3></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row equal">
      <div class="col-md-6">
        <div class="card card-dark card-equal">
          <?php if(isset($delivery_day)){ ?>
          <h4>Pakket wordt geleverd op</h4>
          <h1><?php echo $delivery_day ?></h1>     
          <h3><?php echo 'Tussen 8:00 en 18:00'?></h3>
          <?php }else{ ?>
          <h1><?php echo 'Tracking niet beschikbaar'?></h1>
          <?php } ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-equal">
          <h4>Ontvanger</h4>
          <h5>
          <?php  if(!empty($Order_info['Shipping_Company'])){echo $Order_info['Shipping_Company'].'<br>';}  ?>
          <?php  if(!empty($Order_info['Name'])){echo $Order_info['Name'].'<br>';}  ?>
          <?php  if(!empty($Order_info['Shipping_Address_1'])){echo $Order_info['Shipping_Address_1'].'<br>';}  ?>
          <?php  if(!empty($Order_info['Shipping_Postcode']) && !empty($Order_info['Shipping_City'])){echo $Order_info['Shipping_Postcode'].' '.$Order_info['Shipping_City'];} ?>
          </h5>
        </div>
      </div>
    </div>

    <div class="divider"></div>

    <div class="row">
      <div class="col-md">
        <div class="card">
          <h1>Veelgestelde vragen</h1>
          <br>
          <br>
          <br>
        </div>
      </div>
    </div>

  </div>



<!-- Footer Credits -->
  <div style="margin: 0 auto; margin-top: 70px; margin-bottom: 70px;">
      <h6 style="text-align: center;">ordertracking.online</h6>
  </div>


<!-- partial -->
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</body>
</html>
