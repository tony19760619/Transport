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
<title><?php $PageTitle = 'Login or Register'; echo $PageTitle; ?></title>
</head>
<?php
$msg = '<font color="red">Please login</font>';
if ((@$_SESSION['Username'] === '') || (@$_SESSION['Username'] == '')){
	if(@$_REQUEST['Username'] !=''){
	  //--------------------------------------
	  //-- Get the passed record
	  //--------------------------------------
	  $sql = "SELECT * FROM users where Username = '".@$_REQUEST['Username']."' and Password = '".@$_REQUEST['Password']."' and Active=1";
	
	  $res = $mysqli->query($sql);
	
	  $row = $res->fetch_assoc();
	  
	  if (@$row['Username'] == $_REQUEST['Username']){
            if($row['Active'] == 1){
		$_SESSION['Username'] = $_REQUEST['Username'];
                include ('body.php');
		?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'><thead><tr><th class='tbl'>
		<a href="#" onclick="userlogout()" title="Logout">Logout <?php echo $_SESSION['Username']; ?></a>
            </th></tr></thead><tbody><tr class="tbl"><td class="tbl">&nbsp;</td></tr></tbody></table>
		<?php
		return;
            }else{
                include ('body.php');
		?>
            <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'><thead><tr><th class='tbl'>
                            <h2>This is not an active user. Please goto your email and click the link.</h2>
            </th></tr></thead><tbody><tr class="tbl"><td class="tbl">&nbsp;</td></tr></tbody></table>
		<?php
		return;
                
            }
	  } else {
		$msg = '<font color="red">Invalid or not active Username or Password!</font>';
	  }
	} 
    include ('body.php');
?>
<form id=loginform' action='#' method='post'>
  <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'><thead>
  <tr>
      <th class="tbl" colspan="2">
        <h2>LOGIN: Enter your Username and Password<br>if you have one already or <a = href="Register.php">Register</a> <strong style="color: red">for free!</strong></h2>
    </th>
  </tr>
        </thead>
        <tbody>
  <tr>
    <td>
      Username:
    </td>
    <td>
      <input type="text" id="Username" name="Username" value="<?php echo @$_REQUEST['Username'] ?>" />
    </td>
  </tr>
  <tr>
    <td>
      Password: 
    </td>
    <td>
      <input type="password" id="Password" name="Password" value="<?php echo @$_REQUEST['Password'] ?>" />
    </td>
  </tr>
  <tr class="tbl">
    <td class="tbl" colspan="2" align="right"><?php echo $msg; ?>&nbsp;&nbsp;&nbsp;<input type="submit" value="    Login    " /></td>
  </tr>
        </tbody>
  </table>
</form>

<?php
}else{
  include ('body.php');
?>

<table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'><thead><tr><th class='tbl'>
		<a href="#" onclick="userlogout()" title="Logout">Logout <?php echo $_SESSION['Username']; ?></a>
            </th></tr></thead><tbody><tr class="tbl"><td class="tbl">&nbsp;</td></tr></tbody></table>

<?php
}
include("closebody.php");
?>
</html>
