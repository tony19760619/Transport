<!DOCTYPE html>
<?php 
session_start();
if(@$_REQUEST['logout'] == true){
  $_SESSION['Username'] = '';
}    
require 'config.php';
require 'functions.php';
?>
<html lang="en">
<head>
<?php include_once('db.php'); ?>
<title><?php $PageTitle = 'My Logistics Home Page'; echo $PageTitle; ?></title>
<META NAME="keywords" CONTENT="logistics, truck loads, shipments, transport, free" />
<META NAME="description" CONTENT="My-Logistics.co.za. The place where you can auction your shipment loads to the lowest price" />
</head>
<?php
  include ('body.php');
?>
<div style="margin-left:20px;margin-right:20px">
<table width="800px" align="left" class="tbl" style="position: absolute;margin-left:50px"><tbody class="tbl1"><tr class="tbl1"><td class="tbl1" style="padding-right: 50px;padding-left: 50px">
<h1>List of Logistics Shipments and loads</h1>                    
<p>To get started have a look at some shipments on the system. Click <a href="OfferAShipmentView.php">[Shipments->List Of All Shipments]</a> from the main menu.</p>
<h1>More Information about Logistics Shipments and our services</h1>
<p>We have noticed that there is a lot of <strong>logistic</strong> type <strong>shipments</strong> in <strong>South Africa</strong> and we would like to fill the gap between supplier and customer by providing a insightful and <strong style="color:red">FREE</strong> <strong>logistics service</strong> like never seen before in South Africa.</p>
<p>He have been working hard in the background to bring you this <strong>logistics web site</strong> where <strong>you can request a shipment for free</strong> and for an introductory time you can also <strong>get awarded shipments to deliver for free</strong></p>
<p>This logistics service is very simple at the moment but very useful to both  logistics service clients and logistics service suppliers. </p>
<p>If you planning on logistically shipping anything internally in the country or even across the border or over sees you can rest assured enter in the commodity you transporting and a pick up and drop off point and you set. All you got to do then is respond to the messages coming in and watch the bidding price drop for your logistics shipment.</p>
<p>The highways in South Africa are full of trucks delivering goods to various logistics customers. Even if we only get 1% of the logistics deliveries for the month we will have plenty of deliveries to go round for our logistics companies registered on our logistics site.</p>
    </td></tr></tbody></table>

    <table width="800px" align="left" class="tbl" style="position: absolute;margin-left:50px;margin-top: 640px"><tbody class="tbl1"><tr class="tbl1"><td class="tbl1" style="padding-right: 50px;padding-left: 50px">
                    <br>
        Open Space <br>
        for your <br>
        <strong style="color:red">ADVERTS...</strong><br>
        <br>
        
        
                </td></tr></tbody></table>

    
    <table width="160px" align="left" class="tbl" style="position: absolute;margin-left:890px;height: 600px;overflow-y: scroll;"><tbody class="tbl1"><tr class="tbl1"><td class="tbl1" style="padding-right: 50px;padding-left: 50px">
                    <br>
        Open Space <br>
        for your <br>
        <strong style="color:red">ADVERTS...</strong><br>
        <br>
        
        
                </td></tr></tbody></table>
    
    
<input id="msg" name="msg" type="hidden" value="<?php echo @$msg.@$errmsg; ?>" />
<script> 
if( ($('#msg').val() !== '') || ($('#msg').val() != ''))alert($('#msg').val());
</script>

<?php
  include("closebody.php");
?>
</div>
</html>
