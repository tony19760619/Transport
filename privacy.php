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
<title><?php $PageTitle = 'Privacy Policy'; echo $PageTitle; ?></title>
</head>
<?php
  include ('body.php');
?>
<div style="margin-left:20px;margin-right:20px">

<table width="800px" align="center" class="tbl"><thead class="tbl"><tr class="tbl"><th class="tbl">
<h1>Help Page On My-Logistics.co.za</h1>
    </tr></th></thead>
    <tbody><tr class="tbl"><td class="tbl" style="padding-left:20px;padding-right:20px" >

       <h1>Privacy Policy</h1>
          <p>My-Logistics.co.za only collects information needed to offer you our services. Your information will never be shared or sold to any third parties. You may contact us at any time to request to not receive future contact from us.</p>
	  <p>My-Logistics.co.za uses the Google Display network to show our ads on websites across the internet.  We also use remarketing to advertise online based on a user&rsquo;s previous visit to our website.</p>
	  <p>Remarketing involves third-party vendors, including Google, to show our ads across various sites on the internet.  Third-party vendors, including Google, use cookies to serve ads based on someone's past visits to our website</p>
	  <p>You can opt out of Google's use of cookies by visiting Google's <a href="http://www.google.com/settings/ads" target="_blank">Ads Settings</a>. Alternatively, you can opt out of a third-party vendor's use of cookies by visiting the<a href="http://www.networkadvertising.org/managing/opt_out.asp" target="_blank">Network Advertising Initiative opt-out page</a></p>
	  <p>You can also opt out of Third-party vendor cookies like DoubleClick by visiting the <a href="https://www.google.com/settings/ads/onweb#display_optout" target="_blank">DoubleClick opt-out page</a> or the <a href="http://www.networkadvertising.org/managing/opt_out.asp" target="_blank">Network Advertising Initiative opt-out page</a></p>  
	<br>               
            
            
    </td></tr></tbody></table>
    
<?php
  include("closebody.php");
?>
</div>
</html>
