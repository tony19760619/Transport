<?php 
 
//session_start();
$captcha_error = '';
if(isset($_POST["captcha"])){
	if($_SESSION["captcha"]!=$_POST["captcha"]){
		$captcha_error = 'Invalid security code';
	}
        @$errmsg .= $captcha_error;
        
    if($captcha_error == ''){
	$Suburb = @$_POST['Suburb1'];
	$body = ''.@$_SESSION['fromsource'].' - '.@$_POST['Contact1'].' - '.@$_POST['Name1'].' - '.@$_POST['City1'].' - '.$Suburb.' - '.@$_POST['Message1'];
	$to = "tony19760619@gmail.com";
	$subject = "My-Logistics.co.za User Message";

        $headers = 'From: ' .$_POST['Email']. "\r\n" .
            'Reply-To: ' .$_POST['Email']. "\r\n" .
            "MIME-Version: 1.0\r\n".
            "Content-Type: text/html; charset=ISO-8859-1\r\n".
            'X-Mailer: PHP/' . phpversion();
	
	if (mail($to, $subject, $body, $headers)) {
	  $MessageSent="Message Sent!";
          @$msg .= $MessageSent;
	} else {
	  $MessageSent="Error Sending Mail!";
          @$errmsg .= $MessageSent;
	}
    }
}

if(@$MessageSent === "Message Sent!"){ 
  //Do Something if message was sent
} 
?>
<table width="300" border=0><tbody><tr class="tbl1">
    	<td valign="top" class="tbl1">
        <div style="padding-left:9px;" id="ContactUs">
        <center>
          <b style="font-size:24px">Contact Us Now</b><br>
          <b style="font-size:16px">Tel: <a href="tel:0218530712">021-853-0712</a>&nbsp;&nbsp;&nbsp;Cell:<a href="tel:0834159196">083-415-9196</a> </b>
        </center>
        </div>
        <b class="xLine"></b>
        <form action="#" method="post" name="MailForm">
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            Your Name:<br>
            <input type="text" name="Name1" id="Name1" size="30" value="<?php echo @$_POST['Name1'];?>"/>
          </div>  
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            Your email address:<br>
            <input type="email" name="Email" id="Email" size="30" value="<?php echo @$_POST['Email'];?>"/>
          </div>
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            Your contact number (Cell or Tel): <br>
            <input type="tel" name="Contact1" id="Contact1" size="20" value="<?php echo @$_POST['Contact1'];?>"/>
          </div>
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            Your nearest city:<br>
          	<select id="City1" name="City1" onChange="SetSuburbs()">
<option value='' selected></option>
<option id='Eastern Cape-East London' value ='Eastern Cape-East London'>Eastern Cape-East London</option>
<option id='Eastern Cape-Libode' value ='Eastern Cape-Libode'>Eastern Cape-Libode</option>
<option id='Eastern Cape-Mthatha' value ='Eastern Cape-Mthatha'>Eastern Cape-Mthatha</option>
<option id='Eastern Cape-Port Elizabeth' value ='Eastern Cape-Port Elizabeth'>Eastern Cape-Port Elizabeth</option>
<option id='Free State-Bloemfontein' value ='Free State-Bloemfontein'>Free State-Bloemfontein</option>
<option id='Free State-QwaQwa' value ='Free State-QwaQwa'>Free State-QwaQwa</option>
<option id='Free State-Welkom' value ='Free State-Welkom'>Free State-Welkom</option>
<option id='Gauteng-Johannesburg' value ='Gauteng-Johannesburg'>Gauteng-Johannesburg</option>
<option id='Gauteng-Pretoria' value ='Gauteng-Pretoria'>Gauteng-Pretoria</option>
<option id='KwaZulu-Natal-Durban' value ='KwaZulu-Natal-Durban'>KwaZulu-Natal-Durban</option>
<option id='KwaZulu-Natal-Newcastle' value ='KwaZulu-Natal-Newcastle'>KwaZulu-Natal-Newcastle</option>
<option id='KwaZulu-Natal-Pietermaritzburg' value ='KwaZulu-Natal-Pietermaritzburg'>KwaZulu-Natal-Pietermaritzburg</option>
<option id='KwaZulu-Natal-Richards Bay' value ='KwaZulu-Natal-Richards Bay'>KwaZulu-Natal-Richards Bay</option>
<option id='Limpopo-Louis Trichardt' value ='Limpopo-Louis Trichardt'>Limpopo-Louis Trichardt</option>
<option id='Limpopo-Mokopane' value ='Limpopo-Mokopane'>Limpopo-Mokopane</option>
<option id='Limpopo-Ohrigstad, Burgersfort' value ='Limpopo-Ohrigstad, Burgersfort'>Limpopo-Ohrigstad, Burgersfort</option>
<option id='Limpopo-Polokwane' value ='Limpopo-Polokwane'>Limpopo-Polokwane</option>
<option id='Limpopo-Thohoyandou' value ='Limpopo-Thohoyandou'>Limpopo-Thohoyandou</option>
<option id='Limpopo-Tzaneen' value ='Limpopo-Tzaneen'>Limpopo-Tzaneen</option>
<option id='Mpumalanga-Bushbuckridge' value ='Mpumalanga-Bushbuckridge'>Mpumalanga-Bushbuckridge</option>
<option id='Mpumalanga-KaNgwane' value ='Mpumalanga-KaNgwane'>Mpumalanga-KaNgwane</option>
<option id='Mpumalanga-Nelspruit' value ='Mpumalanga-Nelspruit'>Mpumalanga-Nelspruit</option>
<option id='Mpumalanga-Witbank' value ='Mpumalanga-Witbank'>Mpumalanga-Witbank</option>
<option id='North West-Brits' value ='North West-Brits'>North West-Brits</option>
<option id='North West-Klerksdorp' value ='North West-Klerksdorp'>North West-Klerksdorp</option>
<option id='North West-Rustenburg' value ='North West-Rustenburg'>North West-Rustenburg</option>
<option id='Western Cape-Cape Town' value ='Western Cape-Cape Town'>Western Cape-Cape Town</option>
            </select>
          </div>
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px;height:42px">
            Your nearest suburb:<br>
			<input type="text" name="Suburb1" id="Suburb1" size="30" value="<?php echo @$_POST['Suburb1'];?>"/>
    	  </div>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            <textarea cols="47" rows="6" name="Message1" id="Message1" style="font-family:Arial, Helvetica, sans-serif;font-size:9px"><?php if(@$defaultMessage == '')
	{
		$defaultMessage = 'Hi www.My-Logistics.co.za,'.chr(13).chr(13).'Please, can you...'.chr(13).chr(13).'Thanks';	
	}
            if (@$_POST['Message1'] == ''){ 
              echo $defaultMessage; 
            }else{ 
              echo @$_POST['Message1'];
            }
          ?>
            </textarea>
          </div>
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            Security code: <br />
            <table><tr valign="middle"><td valign="middle">
            <img align="absmiddle" height="20px" width="80px" src="captcha.php" alt="Security Code Image"> <input type="text" name="captcha" id="captcha" size="6" maxlength="6">
         	</td></tr></table>
          </div>
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            <center>
            <a style="color:#000000"><?php echo @$captcha_error.@$MessageSent;?></a><br>
            
            <a href="javascript:document.MailForm.submit()" onClick="JustExit=true;return CheckForm2(MailForm)">
            	<div align="center">
                  <img src="images/ContactNow.png" />                </div>
            </a>
            </center>
          </div>
          <b class="xLine"></b>
          <div style="padding-left:9px;padding-bottom:10px;margin-top:5px">
            <!---
            <center>
            <a href="http://www.facebook.com/pages/LaserLipoSA-Life-Style-Salon/180655335329388"><img src="images/facebook icon.png"/></a>
            <a href="http://twitter.com/#!/laserliposa"><img src="images/twitter icon.png"/></a> 
            </center>
            --->
        	<a href="JavaScript:centeredPopup('privacy.php','Privacy Policy');">Privacy Policy</a> 
                 </div>
            <input type="hidden" id="MessageSent" value="<?php echo @$MessageSent;?>" />
        </form>
        </td></tr></tbody></table>