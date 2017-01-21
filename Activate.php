<?php $checklogin=false;include_once('checklogin.php'); ?>
<!DOCTYPE html>
<?php 
require 'config.php';
require 'functions.php';
?>
<html lang="en">
<head>
<?php include_once('db.php'); ?>
<title><?php $PageTitle = 'User Activation'; echo $PageTitle; ?></title>
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
             $sql = "update users set Active=1 where Hash='".$_REQUEST['key']."'";
             $res = $mysqli->query($sql);
             $_SESSION['Username'] = $row['Username'];
		?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'>
                <thead>
                    <tr>
                        <th class='tbl'>
                            Thank you for activating your account. Feel free to browse around.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tbl">
                        <td class="tbl">
                            <a href="#" onclick="userlogout()" title="Logout">Logout <?php echo $_SESSION['Username']; ?></a>
                            &nbsp;
                        </td>
                    </tr>
                </tbody>
            </table>
		<?php
          }else if ($row['Active'] == 1){
             $_SESSION['Username'] = $row['Username']; 
		?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'>
                <thead>
                    <tr>
                        <th class='tbl'>
                            Previously activated account.Logging you in automatically. Feel free to browse around.
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tbl">
                        <td class="tbl">
                            <a href="#" onclick="userlogout()" title="Logout">Logout <?php echo $_SESSION['Username']; ?></a>
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
                            You trying to use an account that has been marked as impersonation.
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
