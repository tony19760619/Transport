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
<title><?php $PageTitle = 'My Logistics Help Page'; echo $PageTitle; ?></title>
</head>
<?php
  include ('body.php');
?>
<div style="margin-left:20px;margin-right:20px">
    <div style="position: absolute;color:white;background-color:white"> <?php include('contact.php'); ?> </div>
    <table width="800px" align="left" class="tbl" style="position: absolute;margin-left:350px"><tbody class="tbl1"><tr class="tbl1"><td class="tbl1" style="padding-right: 50px;padding-left: 50px">
<h2>More Information about Logistics services...</h2>
<p>So we got a simple site where you enter your shipment requests, and logistics companies and shipment vehicle owners can bid to do your job. It may not be the most secure way of doing it but it will surely be the cheapest and done according to your terms</p>
<p>We did add a rating figure and verified flag so you can pick the most secure option at the cheapest rate for your shipment request.</p>
<h2>Help us improve the site by suggesting improvements</h2>
<p>We welcome improvement requests and get to work on the straight away. we have a development team waiting just for your improvement requests.</p>
    </td></tr></tbody></table>

    <table width="800px" align="left" class="tbl" style="position: absolute;margin-left:350px;margin-top: 500px"><tbody class="tbl1"><tr class="tbl1"><td class="tbl1" style="padding-right: 50px;padding-left: 50px">
                    <br>
        Open Space <br>
        for your <br>
        <strong style="color:red">ADVERTS...</strong><br>
        <br>
        
        
                </td></tr></tbody></table>

    
    <table width="160px" align="left" class="tbl" style="position: absolute;margin-left:1190px;height: 600px;overflow-y: scroll;"><tbody class="tbl1"><tr class="tbl1"><td class="tbl1" style="padding-right: 50px;padding-left: 50px">
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


