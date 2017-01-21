<?php $checklogin=false;include_once('checklogin.php'); ?>
<!DOCTYPE html>
<?php 
require 'config.php';
require 'functions.php';
?>
<html lang="en">
<head>
<?php include_once('db.php'); ?>
<title><?php $PageTitle = 'Register'; echo $PageTitle; ?></title>
<?php
if(@$_REQUEST['submit'] == '    Register    '){
    
    $CleanUsername = preg_replace('/[^0-9a-zA-Z]/', '', @$_REQUEST['Username']);
    if($CleanUsername == @$_REQUEST['Username']){
        //------------------------------------------------------------------------
        //-- Check for duplicate Username
        //------------------------------------------------------------------------
        $sqlcu = "SELECT COUNT(*) as Existing FROM users where Username = '".$CleanUsername."'";	
        $rescu = $mysqli->query($sqlcu);
        $rowcu = $rescu->fetch_assoc();
        if($rowcu['Existing']>0){
           @$errmsg .= "The Username you entered already exists! ";    
        }

        //------------------------------------------------------------------------
        //-- Check for duplicate Email
        //------------------------------------------------------------------------
        $sqlce = "SELECT COUNT(*) as Existing FROM users where Email = '".@$_REQUEST['Email']."'";	
        $resce = $mysqli->query($sqlce);
        $rowce = $resce->fetch_assoc();
        if($rowce['Existing']>0){
           @$errmsg .= "The Email you entered already exists! ";    
        }

        if(@$errmsg == ''){
            //------------------------------------------------------------------------
            //-- Register new user in db
            //------------------------------------------------------------------------
            $sqliu ='insert into users(Username,Hash, Password, Email, Mobile, UserType,'.
                'Address, FirstName, Surname, DateOfBirth, PersonalIdentificationDocumentType, '.
                'PersonalIdentificationNumber, CompanyName, CompanyIdentificationNumber, '.
                'CompanyTaxOrVatNo, Country) '.
                'values('.
                '"'.$CleanUsername.'",'.    
                'md5("'.$CleanUsername.'"),'.
                '"'.@$_REQUEST['Password'].'",'.
                '"'.@$_REQUEST['Email'].'",'.
                '"'.@$_REQUEST['Mobile'].'",'.
                '"'.@$_REQUEST['UserType'].'",'.
                '"'.@$_REQUEST['Address'].'",'.
                '"'.@$_REQUEST['FirstName'].'",'.
                '"'.@$_REQUEST['Surname'].'",'.
                '"'.@$_REQUEST['DateOfBirth'].'",'.
                '"'.@$_REQUEST['PersonalIdentificationDocumentType'].'",'.
                '"'.@$_REQUEST['PersonalIdentificationNumber'].'",'.
                '"'.@$_REQUEST['CompanyName'].'",'.
                '"'.@$_REQUEST['CompanyIdentificationNumber'].'",'.
                '"'.@$_REQUEST['CompanyTaxOrVatNo'].'",'.
                '"'.@$_REQUEST['Country'].'")';

            $resiu = $mysqli->query($sqliu);    

            if (!$resiu){
               @$errmsg .= mysqli_error($mysqli);
            }
            else{    
                //------------------------------------------------------------------------
                //-- Get the email hash key to send to user
                //------------------------------------------------------------------------
                $sqlk = 'select Hash from users where Username = "'.$CleanUsername.'"';
                $resk = $mysqli->query($sqlk);
                $rowk = $resk->fetch_assoc();
                $key = $rowk['Hash'];

                //------------------------------------------------------------------------
                //-- Send mail
                //------------------------------------------------------------------------
                $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
                'Reply-To: ' .'no-reply@my-logistics.co.za'. "\r\n" .
                "MIME-Version: 1.0\r\n".
                "Content-Type: text/html; charset=ISO-8859-1\r\n".
                'X-Mailer: PHP/' . phpversion();

                $to = $_REQUEST['Email'];
                $subject = 'Activate your account at www.My-Logistics.co.za';
                @$body .= 'Hi '.@$_REQUEST['FirstName']."<br><br>";
                @$body .= 'This email was triggered off by you or someone else on our site'."<br>";
                @$body .= "You can <strong>activate your account</strong> <a href='http://www.my-logistics.co.za/Activate.php?key=$key'>here</a>"."<br><br>";
                @$body .= "Alternatively report this as someone else using your email illegally <a href='http://www.my-logistics.co.za/Missuse.php?key=$key'>here</a>"."<br><br>";
                @$body .= "This is an automatically generated email please do not respond on this email as nobody will reply to it.<br><br>";
                @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

                //$headers  = 'MIME-Version: 1.0' . "\r\n";
                //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                //$headers .= 'From: '.$_POST['Email']. "\r\n";

                if (mail($to, $subject, $body, $headers)) {
                  @$msg .= "Registration Succesful. Please check your email for the activation link. Remember to check your Spam too, just in case.";
                } else {
                  @$errmsg .= "Message delivery failed...";
                }
            }        
        }
    }else{
        @$errmsg = 'Invalid characters in Username';
    }
}
?>
<title><?php $PageTitle = 'Register with us'; echo $PageTitle; ?></title>
</head>
<?php
    include ('body.php');
?>

<?php if((@msg != '')||(@errmsg != '')) echo '<center>'.@$msg.'<br><font color="red">'.@$errmsg.'</font></center><br>';?>

<form id=loginform' action='#' method='post'><table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'><thead>
  <tr>
      <th class="tbl" colspan="2">
        <h2>REGISTER: Enter a unique Username, and your details</h2>
      </th>
  </tr>
        </thead>
        <tbody>
  <tr>
    <td>
      Username:
    </td>
    <td>
        <input type="text" id="Username" name="Username" onkeyup='checkUsername()' value="<?php echo @$_REQUEST['Username'] ?>" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Password: 
    </td>
    <td>
        <lable id="PasswordMsg">Please enter a valid password!</lable>
        <br>
        <input onchange="checkmypassword()" onkeyup="checkmypassword()" type="password" id="Password" name="Password" value="<?php echo @$_REQUEST['Password'] ?>" />
        <img id="PasswordPic" src="images/cross.png" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Retype Password: 
    </td>
    <td>
        <lable id="PasswordCheckMsg">Please retype your password!</lable>
        <br>
        <input onchange="checkmypassword()" onkeyup="checkmypassword()" type="password" id="PasswordCheck" name="PasswordCheck" value="" />
        <img id="PasswordCheckPic" src="images/cross.png" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Email:
    </td>
    <td>
        <input type="email" size="40" id="Email" name="Email" value="<?php echo @$_REQUEST['Email'] ?>" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Mobile:
    </td>
    <td>
        <input type="tel" id="Mobile" name="Mobile" value="<?php echo @$_REQUEST['Mobile'] ?>" />
    </td>
  </tr>
  <tr>
    <td>
      User Type:
    </td>
    <td>
        <select name='UserType' id='UserType' >
            <option value='I Have Stuff To Ship' <?php if(@$_REQUEST['UserType'] == 'I Have Stuff To Ship')echo 'selected'; ?> >I Have Stuff To Ship</option>
            <option value='I Have A Vehicle for Load Shipments' <?php if(@$_REQUEST['UserType'] == 'I Have A Vehicle for Load Shipments')echo 'selected'; ?> >I Have A Vehicle for Load Shipments</option>
            <option value='All of the above' <?php if(@$_REQUEST['UserType'] == 'All of the above')echo 'selected'; ?> >All of the above</option>
        </select>&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Address:
    </td>
    <td width='400px'>
        <textarea wrap='soft' rows='4' id='Address' name='Address' style='width:400px'><?php echo @$_REQUEST['Address'];?></textarea>&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      First Name:
    </td>
    <td>
        <input type="text" size="30" id="FirstName" name="FirstName" value="<?php echo @$_REQUEST['FirstName'] ?>" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Surname:
    </td>
    <td>
        <input type="text" size="30" id="Surname" name="Surname" value="<?php echo @$_REQUEST['Surname'] ?>" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Date Of Birth:
    </td>
    <td>
        <input type="text" size="10" id="DateOfBirth" name="DateOfBirth" value="<?php echo @$_REQUEST['DateOfBirth'] ?>" />&nbsp;*
    </td>
  </tr>
  <tr>
    <td>
      Personal Identification Document Type:
    </td>
    <td>
        <select name='PersonalIdentificationDocumentType' id='UserType' >
            <option value='Passport' <?php if(@$_REQUEST['PersonalIdentificationDocumentType'] == 'Passport')echo 'selected'; ?> >Passport</option>
            <option value='Identification Number Issued By Country' <?php if(@$_REQUEST['PersonalIdentificationDocumentType'] == 'Identification Number Issued By Country')echo 'selected'; ?> >Identification Number Issued By Country</option>
            <option value='None' <?php if(@$_REQUEST['PersonalIdentificationDocumentType'] == 'None')echo 'selected'; ?> >None</option>
        </select>&nbsp;*
    </td>
  </tr>  
  <tr>
    <td>
      Personal Identification Number:
    </td>
    <td>
        <input type="text" id="PersonalIdentificationNumber" name="PersonalIdentificationNumber" value="<?php echo @$_REQUEST['PersonalIdentificationNumber'] ?>" />
    </td>
  </tr>
  <tr>
    <td>
      Company Name:
    </td>
    <td>
        <input type="text" size="30" id="CompanyName" name="CompanyName" value="<?php echo @$_REQUEST['CompanyName'] ?>" />
    </td>
  </tr>
  <tr>
    <td>
      Company Identification Number:
    </td>
    <td>
        <input type="text" id="CompanyIdentificationNumber" name="CompanyIdentificationNumber" value="<?php echo @$_REQUEST['CompanyIdentificationNumber'] ?>" />
    </td>
  </tr>
  <tr>
    <td>
      Company Tax Or Vat No:
    </td>
    <td>
        <input type="text" id="CompanyTaxOrVatNo" name="CompanyTaxOrVatNo" value="<?php echo @$_REQUEST['CompanyTaxOrVatNo'] ?>" />
    </td>
  </tr>
  <tr>
    <td>
      Country:
    </td>
    <td>
        <select name='Country' id='Country' >
            <?php
                $sqlc = "SELECT * FROM countries order by Name";
	
                $resc = $mysqli->query($sqlc);
	
                while ($row = $resc->fetch_assoc()){
                ?>    
                    <option value="<?php echo $row['Name'];?>" <?php if(@$_REQUEST['Country'] == $row["Name"])echo 'selected'; ?> ><?php echo $row['Name'];?></option>
                <?php
                }        
            ?>
            </select>&nbsp;*
    </td>
  </tr> 
  <tr class="tbl">
    <td class="tbl" colspan="2" align="right">
        <input onclick="if(checkmypassword()==false){alert('Password not set correctly');return false;}return checkregisterform();" type="submit" id="submit" name="submit" value="    Register    " />
    </td>
  </tr>
    </tbody>
    </table>
    <input type="hidden" id='msg' name='msg' value="<?php echo @$msg.@$errmsg; ?>">
</form>
<script>
    
  if( ($("#Password").val() != '') || ($("#Password").val() !== ''))checkmypassword();
    
  $('#DateOfBirth').datepicker({
                  dateFormat: 'yy-mm-dd',
                  changeMonth: true,
                  changeYear: true,
                  minDate: '-100y',
                  maxDate: '+1y',
                  yearRange: "1926:2026"
              });
              
  if($("#msg").val() != ''){
      alert($("#msg").val());
  }
  
</script>
<?php
include("closebody.php");
?>
</html>
