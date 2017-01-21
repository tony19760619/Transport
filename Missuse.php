<?php $checklogin=false;include_once('checklogin.php'); ?>
<!DOCTYPE html>
<?php 
require 'config.php';
require 'functions.php';
?>
<html lang="en">
<head>
<?php include_once('db.php'); ?>
<title><?php $PageTitle = 'Missuse of user details'; echo $PageTitle; ?></title>
</head>
<?php

include ('body.php');
	
if ((@$_REQUEST['key'] !== '') || (@$_REQUEST['key'] != '')){
	  //--------------------------------------
	  //-- Get the passed record
	  //--------------------------------------
	  $sql = "SELECT * FROM users where Hash = '".@$_REQUEST['key']."'";
	  $res = $mysqli->query($sql);
	  $row = $res->fetch_assoc();
	  
	  if (@$row['Active'] == 0){
             $sql = "update users set Active=-1 where Hash='".$_REQUEST['key']."'";
             $res = $mysqli->query($sql);
		?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'>
                <thead>
                    <tr>
                        <th class='tbl'>
                            You have marked your account details as Misrepresentation of information.<br>
                            We will not allow this account access to our system.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tbl">
                        <td class="tbl">
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
		<?php
          }else if ($row['Active'] == 1){
             $sql = "update users set Active=-1 where Hash='".$_REQUEST['key']."'";
             $res = $mysqli->query($sql);
		?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'>
                <thead>
                    <tr>
                        <th class='tbl'>
                            This account was activated...<br>
                            But now you marked this account details as Misrepresentation of information.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tbl">
                        <td class="tbl">
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
		<?php
	  }else if ($row['Active'] == -1){
         	?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'>
                <thead>
                    <tr>
                        <th class='tbl'>
                            This account was previously marked as Mirepresentation of information.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tbl">
                        <td class="tbl">
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
		<?php      
          }
} 
include("closebody.php");
?>
</html>
