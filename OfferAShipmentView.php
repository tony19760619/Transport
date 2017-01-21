<?php $checklogin=false;include_once('checklogin.php'); ?>
<!DOCTYPE html>
<?php

include('config.php');
include('functions.php');
?>
<html lang="en">
<head>
<?php include('db.php'); ?> 
<title><?php $PageTitle = 'Shipment Details View'; echo $PageTitle; ?></title>
<META NAME="keywords" CONTENT="logistics, truck loads, shipments, transport, free" />
<META NAME="description" CONTENT="My-Logistics.co.za. The place where you can auction your shipment loads to the lowest price" />

</head>
<?php

//-----------------------------------------------
//-- Auto Login - if coming from responce email
//-----------------------------------------------
if((@$_REQUEST['type'] == 4)||(@$_REQUEST['type'] == 5)){
    $sqlali = 'select * from users where Hash="'.$_REQUEST['hash'].'"';
    $resali = $mysqli->query($sqlali);
    $rowali = $resali->fetch_assoc();
    @$_SESSION['Username'] = $rowali['Username'];

    if(@$_REQUEST['type'] == 4){
      if (!isset($_REQUEST['rhash'])){
        $ContactUser = '';
      }else{
        $sqlali = 'select * from users where Hash="'.$_REQUEST['rhash'].'"';
        $resali = $mysqli->query($sqlali);
        $rowali = $resali->fetch_assoc();
        $ContactUser = $rowali['Username'];
      }
        $_REQUEST['type'] = 1;
        $_REQUEST['recowner'] = @$_SESSION['Username'];
        $_REQUEST['loggedin'] = @$_SESSION['Username'];
        $_REQUEST['ContactUser'] = @$ContactUser;
    }

    if(@$_REQUEST['type'] == 5){

        $_REQUEST['type'] = 2;
        $_REQUEST['recowner'] = @$_SESSION['Username'];
        $_REQUEST['loggedin'] = @$_SESSION['Username'];
        $_REQUEST['ContactUser'] = '';
    }
    
}

include ('body.php');

if(@$_SESSION['Username'] == '') echo "<center><font color='red'><h2>Register for Free, or Login to <br>view extra info and reply to listing</h2></font></center>";
echo "<form id=picuploader' enctype='multipart/form-data' action='#' method='post'><div>";

@$_SESSION['id'] = @$_REQUEST['id'];

//------------------------------------------------------------------------------
//-- Do update of Awarding bid before getting record for screen
//------------------------------------------------------------------------------
if((@$_REQUEST['type']==1)||(@$_REQUEST['type']==4)){
    
    if(@$_REQUEST['AwardBidTo']!=''){
        AwardBidToUser($_REQUEST['id'],$_REQUEST['AwardBidTo'],$_REQUEST['AwardBidAmount']);        
    }

    if(@$_REQUEST['UnawardBid']=='True'){
        UnawardBid($_REQUEST['id']);        
    }
}

//--------------------------------------
//-- Get the passed record
//--------------------------------------
$sql = "SELECT * FROM OfferAShipment where id =".$_SESSION['id'];

$res = $mysqli->query($sql);

if(!$res){
    header('Location: OfferAShipmentList.php');
}
//--------------------------------------
//-- Display List of Offer a Shipment Data
//--------------------------------------        
$row = $res->fetch_assoc();
$notloggedinmsg = 'Visible for logged in users';
echo "<table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center' >";
echo "<thead><tr class='inputtableheader'>".
     "<th class='tbl' colspan='2' align=center>".
     "<h1>&nbsp;&nbsp; Record Details &nbsp;&nbsp;</h1>".
	 "</td></tr></thead><tbody>";
foreach ($row as $Col=>$Val){
   //Hide these coloums but update them with data later
   if(($Col =='PickUpLongitude')||($Col =='PickUpLatitude')||($Col =='DropOffLongitude')||($Col =='DropOffLatitude')){
     echo "<input type='hidden' id='$Col' name='$Col' value='$Val' />";
     continue;
   }
   //Dont update this here
   if(($Col =='AwardBidTo')||($Col =='AwardBidAmount')){
     continue;
   }
   echo '<tr>'; 
   echo "<td>".ColToLable($Col)."</td>";
   if($Col =='id'){
     echo "<td><input class='numformat' type='text' id='id' name='id' value='$Val' readonly /></td>";
   }
   else if($Col =='Username'){
     echo "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='Distance'){
     echo "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='DurationOfTrip'){
     echo "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='Directions'){
     echo "<td><input type='button' id='Directions' name='Directions' onclick='getDirections();' value='   On Google Maps   ' /></td>";
   }
   else if($Col=='PickUpPoint'){
     echo "<td width='400px'><textarea readonly wrap='soft' rows='4' id='PickUpPoint' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col =='PickUpDateFlexibleByXDays'){
     echo "<td><input readonly class='numformat' type='number' id='$Col' name='$Col' value='".$Val."'></input></td>";
   }
   else if($Col =='DropOffDateFlexibleByXDays'){
     echo "<td><input readonly class='numformat' type='number' id='$Col' name='$Col' value='".$Val."'></input></td>";
   }
   else if($Col=='DropOffPoint'){
     echo "<td><textarea readonly wrap='soft' rows='4' id='DropOffPoint' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col=='BiddingEndDate'){
     echo "<td><input readonly type='text' id='BiddingEndDate' name='BiddingEndDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col=='PickUpDate'){
     if(@$_SESSION['Username'] == ''){
         echo "<td><font color=red><lable>$notloggedinmsg</lable></font></td>";
     }else{
         echo "<td><input readonly type='text' id='PickUpDate' name='PickUpDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
     }
   }
   else if($Col=='DropOffDate'){
     if(@$_SESSION['Username'] == ''){
         echo "<td><font color=red><lable>$notloggedinmsg</lable></font></td>";
     }else{
         echo "<td><input readonly type='text' id='DropOffDate' name='DropOffDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
     }
   }
   else if($Col=='TransportWhat'){
     echo "<td><textarea readonly wrap='soft' rows='4' id='TransportWhat' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col=='TransportOfWhatPicture'){
     echo "<td><center>";
     if(file_exists($Val) == false){
     ?>
       <h2>No Image Available!</h2><br>&nbsp;
     <?php
	 }else{
	 ?>
       <img src="<?php echo $Val; ?>" />
	 <?php
	 }
	 echo "</center></td>";
   }
   else if($Col=='TypeOfTransport'){
     echo "<td><input readonly type='text' id='TypeOfTransport' name='TypeOfTransport' value='".$Val."'></input></td>";
   }
   else if($Col=='Tons'){
     echo "<td><input class='numformat' readonly type='text' id='Tons' name='Tons' value='".$Val."'></input></td>";
   }
   else if($Col=='CubicMeters'){
     echo "<td><input class='numformat' readonly type='text' id='CubicMeters' name='CubicMeters' value='".$Val."'></input></td>";
   }else{
     echo "<td>$Val</td>";
   }
   echo "</tr>";
}

//------------------------------------------------------------------------------
//-- Bottom of details table
//------------------------------------------------------------------------------
echo "<tr class='tbl' bgcolor='#FFBBFF'  style='height:40px;font-weight:bold'>".
     "<td class='tbl' colspan='2' align=right>";

//------------------------------------------------------------------------------
//-- Bidding info
//------------------------------------------------------------------------------
if((@$_REQUEST['type']==1)||(@$_REQUEST['type']==4)){
        
    //--------------------------------------------------------------------------
    //-- Check if this is a new bid and send out email if it is
    //--------------------------------------------------------------------------
    $sqlbids = "select o.id, o.Bid, o.Username, u.Rating, u.Verified, o.Selected, o.Watch ".
        "from OfferAShipmentBid o ".
        "left outer join users u on u.Username = o.Username ".
        "where o.OfferAShipmentID = ".$_REQUEST['id'].
        " order by o.Bid asc";

    $resbids = $mysqli->query($sqlbids);
    echo "List of Bids: ";
    if(!$resbids){
    ?>
           <select id="bids" name="bids">
               <option selected="true">Amount[None] Username[Nobody] Rating[0.00] Verified[Not]</option>";      
           </select>
    <?php    
    } else {
    ?>
           <select id="bids" name="bids">
    <?php
      $numrows = 0;
      while($rowbids = $resbids->fetch_assoc()){
        if ($rowbids['Bid'] == '')continue; //we dont want to show the lines for Watches without bids
        $numrows = $numrows + 1;
        echo "<option value='".$rowbids['id']."' ";
        if ($rowbids['Selected']== 1)echo " selected='true' ";
        echo ">Amount[".$rowbids['Bid']."] Username[".$rowbids['Username']."] Rating[".$rowbids['Rating']."] Verified[".$rowbids['Verified']."]"."</option>";      
      }  
      if( @$numrows == 0){
          ?>
               <option selected="true">Amount[None] Username[Nobody] Rating[0.00] Verified[Not]</option>";      
          <?php
      }
    ?>
           </select>
    
    <?php
      if($row['AwardBidTo'] == ''){
    ?>          
        <input type="button" id="AwardBid" name="AwardBid" onClick='<?php echo "AwardBidClick(".json_encode($_REQUEST).")"; ?>' value="  Award Bid  " />
    <?php
      }else{
    ?>
        <input type="button" id="UnawardBid" name="UnawardBid" onClick='<?php echo "UnawardBidClick(".json_encode($_REQUEST).")"; ?>' value="  Unaward Bid  " />
    <?php
       }
    ?>
      
    <?php
    }
} else if((@$_REQUEST['type']==2)||(@$_REQUEST['type']==5)){
    //--------------------------------------------------------------------------
    //-- Get and set this users bid info for the job (First call for default data only, second call later is after updates)
    //--------------------------------------------------------------------------
    $sqluserbid_t = "select o.id, o.Bid, o.Username, u.Rating, u.Verified ".
        "from OfferAShipmentBid o left outer join users u on u.Username = o.Username ".
        "where o.OfferAShipmentID = ".$_REQUEST['id'] ." and o.Username = '".@$_SESSION['Username']."'";
    
    $resuserbid_t = $mysqli->query($sqluserbid_t);
    $rowuserbid_t = $resuserbid_t->fetch_assoc();
    $watch = @$rowuserbid_t['Watch'];
    if($watch == '')$watch = 0;
    $userbid = $rowuserbid_t['Bid'];
    if($userbid == 0)$userbid = '';


    //--------------------------------------------------------------------------
    //-- Update db in case bid was updated
    //--------------------------------------------------------------------------
    if(@$_REQUEST['BidButton']=='  Bid  '){
        if (($_REQUEST['Bid'] == '') || ($_REQUEST['Bid'] == '0') || ($_REQUEST['Bid'] == '0.00')){
            $_REQUEST['Bid'] = '';

            $sqlbidupdate = 'INSERT INTO OfferAShipmentBid '.
                '(OfferAShipmentID, Username, Bid, Watch) VALUES('.$_REQUEST['id'].',"'.$_SESSION['Username'].'",NULL,0) '.
                'ON DUPLICATE KEY UPDATE OfferAShipmentID='.$_REQUEST['id'].', Username="'.$_SESSION['Username'].'", Bid=NULL, Watch=0';
            $ressqlbidupdate = $mysqli->query($sqlbidupdate);

            @$msg .= "You have bid nothing on the bid so we removed your bid and watch flag";
        }else{
            $sqlbidupdate = 'INSERT INTO OfferAShipmentBid '.
                '(OfferAShipmentID, Username, Bid, Watch) VALUES('.$_REQUEST['id'].',"'.$_SESSION['Username'].'", '.$_REQUEST['Bid'].',1) '.
                'ON DUPLICATE KEY UPDATE OfferAShipmentID='.$_REQUEST['id'].', Username="'.$_SESSION['Username'].'", Bid='.$_REQUEST['Bid'].', Watch=1';
            $ressqlbidupdate = $mysqli->query($sqlbidupdate);

            @$msg .= "You have placed your bid and we set you to automatically watch this job, good luck!";
        }
    }

    if(@$_REQUEST['setwatch']=='setwatch'){
        if($userbid =='')$userbid="NULL";
        $sqlwatchupdate = 'INSERT INTO OfferAShipmentBid '.
          '(OfferAShipmentID, Username, Bid, Watch) VALUES('.$_REQUEST['id'].',"'.$_SESSION['Username'].'", '.$userbid.','.$_REQUEST['Watch'].') '.
          'ON DUPLICATE KEY UPDATE OfferAShipmentID='.$_REQUEST['id'].', Username="'.$_SESSION['Username'].'", Bid='.$userbid.', Watch='.$_REQUEST['Watch'];
        $reswatchupdate = $mysqli->query($sqlwatchupdate);
        if (@$_REQUEST['Watch'] == 0) @$msg .= "You no longer on the watch list for this job";
        else @$msg .= "You are now on the watch list for this job";
    }
    
    //--------------------------------------------------------------------------
    //-- Get and set the lowest bid info
    //--------------------------------------------------------------------------
    $sqllowestbid = "select o.id, o.Bid, o.Username, u.Rating, u.Verified ".
        "from OfferAShipmentBid o inner join users u on u.Username = o.Username ".
        "where o.OfferAShipmentID = ".$_REQUEST['id'] ." and ".
        "o.Bid = (select min(ino.Bid) from OfferAShipmentBid ino ".
        "where ino.OfferAShipmentID = ".$_REQUEST['id'].") order by o.id asc";

    $reslowestbid = $mysqli->query($sqllowestbid);
    $rowlowestbid = $reslowestbid->fetch_assoc();
    $lowestbid = $rowlowestbid['Bid'];
    if($lowestbid == 0)$lowestbid = '';
    
    //--------------------------------------------------------------------------
    //-- Check if this is a new bid and send out email if it is
    //--------------------------------------------------------------------------
    if(@$_REQUEST['BidButton']=='  Bid  '){
        emailnewbid($_REQUEST['id'],$_SESSION['Username'],$_REQUEST['Bid'],1);        
    }
    if(@$_REQUEST['setwatch']=='setwatch'){
        if (@$_REQUEST['Watch'] == 0) emailwatchlist($_REQUEST['id'],false,$_SESSION['Username']);
        else emailwatchlist($_REQUEST['id'],true,$_SESSION['Username']);
    }

    //--------------------------------------------------------------------------
    //-- Get and set this users bid info for the job
    //--------------------------------------------------------------------------
    $sqluserbid = "select o.id, o.Bid, o.Username, u.Rating, u.Verified, o.Watch ".
        "from OfferAShipmentBid o inner join users u on u.Username = o.Username ".
        "where o.OfferAShipmentID = ".$_REQUEST['id'] ." and o.Username = '".@$_SESSION['Username']."'";
    
    $resuserbid = $mysqli->query($sqluserbid);
    $rowuserbid = $resuserbid->fetch_assoc();
    $watch = @$rowuserbid['Watch'];
    if($watch == '')$watch = 0;
    $userbid = $rowuserbid['Bid'];
    if($userbid == 0)$userbid = '';
?>
       Lowest Bid: <input type="text" class="numformat" size="8" readonly id="LowestBid" name="LowestBid" value="<?php echo $lowestbid; ?>" />
       Your Bid: <input type="text"  class="numformat" size="8" id="YourBid" name="YourBid" value="<?php echo $userbid; ?>" /> 
       <input type='button' onclick='<?php echo 'BidButtonClick('.$_REQUEST['id'].','.$_REQUEST['type'].',"'.
          trim($row['Username']).'","'.trim($_SESSION['Username']).'");' ?>' id='BidButton' name='BidButton' value='  Bid  ' /> &nbsp;
       <input type='button' onclick='<?php echo 'SetWatchClick('.$_REQUEST['id'].','.$_REQUEST['type'].',"'.
          $row['Username'].'","'.$_SESSION['Username'].'",'.$watch.');' ?>' name='SetWatch' id='SetWatch' value="  <?php if($watch == 1)echo 'Un-'; ?>Watch  " />
     <?php
} else if((@$_REQUEST['type']==3)){
   echo "<font color='darkred'>Bidding on shipment... Only available to logged in users...</font>";    
}
?>
       <input type='button' onclick='backtolistclick( <?php echo '"'.@$_SESSION['ReturnPage'].'"'; ?> );' id='backtolist' name='backtolist' value='  Go Back to List  ' /> &nbsp;&nbsp;
<?php
echo "</td></tr>";

echo "</tbody></table></form>";

//------------------------------------------------------------------------------
//-- Not logged in. Display login or register messages all over
//------------------------------------------------------------------------------
if(@$_REQUEST['type'] == 3){
    
}
//------------------------------------------------------------------------------
//-- Own record, get list of users who replied and send message to selected user
//------------------------------------------------------------------------------
if( (@$_REQUEST['type'] == 1) || (@$_REQUEST['type'] == 2) || (@$_REQUEST['type'] == 5) ){
  //----------------------------------------------------------------------------------------------------------
  //-- Get list of users who have replied to this advert ALSO ADD BIDS users so we can respond to all of them
  //----------------------------------------------------------------------------------------------------------
  $sqlcu = 'select distinct FromUsername from OfferAShipmentMessages where OfferAShipment='.$_REQUEST['id'].
           ' and SentOrReceived="Received" '.
           ' union select Username as FromUsername from OfferAShipmentBid where OfferAShipmentID='.$_REQUEST['id'].
           ' order by FromUsername ';
           
  $rescu = $mysqli->query($sqlcu);

  //------------------------------------------------------------------------
  //-- Get email address of user we replying to
  //------------------------------------------------------------------------
  if(@$_REQUEST['SendMessage'] == 'true'){
    $sqlea = 'select * from users where Username="'.$_REQUEST['ContactUser'].'"';
    $resea = $mysqli->query($sqlea);
    $rowea = $resea->fetch_assoc();
    
    $sqlrh = 'select * from users where Username="'.$_SESSION['Username'].'"';
    $resrh = $mysqli->query($sqlrh);
    $rowrh = $resrh->fetch_assoc();
  
    //-------------------------------------------
    //-- Send email
    //-------------------------------------------
    $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    'Reply-To: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/html; charset=ISO-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();

    $to = @$rowea['Email'];
    $subject = @$_SESSION['Username'].' has reponded to your message.';
    @$body .= 'Hi '.@$rowea['FirstName']."<br><br>";
    @$body .= @$_SESSION['Username']. ' has responded to your message'."<br>";
    @$body .= 'You can respond by using the following ';
     
    $reqid = @$_REQUEST['id'];
    $reqtype = @$_REQUEST['type'];
    $reqowner = @$_REQUEST['recowner'];
    $reqloggedin = @$_REQUEST['loggedin'];
    $hash = @$rowea['Hash'];
    
    //--------------------------------------------------------------------
    //-- Swap the request types for responding parameters
    //--------------------------------------------------------------------
    $rhash = '';
    if((@$reqtype == 1)||(@$reqtype == 4)){
        $reqtype = 5;
        $rhash = '';
    }else if((@$reqtype == 5)||(@$reqtype == 2)){
        $reqtype = 4;        
        $rhash = "&rhash=".@$rowrh['Hash'];
    }
    
    @$body .= "<a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$reqid&type=$reqtype&hash=$hash$rhash#backtolist'>link<a>"."<br>";
    @$body .= "<br><br>";
    @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

    //$headers  = 'MIME-Version: 1.0' . "\r\n";
    //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //$headers .= 'From: '.$_POST['Email']. "\r\n";

    if (mail($to, $subject, $body, $headers)) {
      @$msg .= "Email Sent!";
      //------------------------------------------------
      //-- Store message in db so we got a record
      //------------------------------------------------
      if(@$_REQUEST['type'] == 1){
        $SentOrReceived = 'Sent';  
        $FromUsername = @$_REQUEST['ContactUser'];
        $ToUsername = @$_SESSION['Username'];
      }else if (@$_REQUEST['type'] == 5){
        $SentOrReceived = 'Received';
        $FromUsername = @$_SESSION['Username'];
        $ToUsername = @$_REQUEST['ContactUser']; 
      }else if(@$_REQUEST['type'] == 2){
        $SentOrReceived = 'Received';  
        $FromUsername = @$_REQUEST['loggedin'];
        $ToUsername = @$_REQUEST['recowner'];
      }
      $sqlse = 'insert into OfferAShipmentMessages(OfferAShipment,Date,FromUsername,ToUsername,SentOrReceived,Message) ';
      $sqlse .= 'values('.@$_REQUEST['id'].',Now(),"'.$FromUsername.'","'.$ToUsername.'","'.$SentOrReceived.'","'.@$_REQUEST['Message'].'")';
      if(!$mysqli->query($sqlse)){
        @$errmsg .= "Failed to save msg to db...: MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;    
      }
    } else {
      @$errmsg .= "Email message delivery failed...";
    }
  }

  //-----------------------------------------------
  //-- Get the record owner
  //-----------------------------------------------
  $sqlcm = 'select * from OfferAShipment where id='.$_REQUEST['id'];
  $rescm = $mysqli->query($sqlcm);
  $rowcm = $rescm->fetch_assoc();
  $recowner = $rowcm['Username'];

  //------------------------------------------------------------------------
  //-- Get list of of message from selected user who replied to our advert - for type 1
  //------------------------------------------------------------------------
  $listforuser = '';
  if(@$_REQUEST['type'] == 1){
     $listforuser = @$_REQUEST['ContactUser'];
  }else if((@$_REQUEST['type'] == 5)||(@$_REQUEST['type'] == 2)){
     $listforuser = $_SESSION['Username'];
  }

  $sqlmess = 'select * from OfferAShipmentMessages where OfferAShipment='.$_REQUEST['id'];
  $sqlmess .= ' and FromUsername="'.$listforuser.'" order by ID desc';

  $resmess = $mysqli->query($sqlmess);
}

if(@$_REQUEST['type'] == 2){
    //-----------------------------------------------
    //-- TODO Get the message creator email
    //-----------------------------------------------
    $sqlro = 'select * from users where Username="'.$_REQUEST['recowner'].'"';
    $resro = $mysqli->query($sqlro);
    $rowro = $resro->fetch_assoc();
    $rowro['Email'];
}
?>
       <br>
       <center><a name='Messages'><h2>Messages</h2></a></center>
       <?php if((@msg != '')||(@errmsg != '')) echo '<center>'.@$msg.'<br><font color="red">'.@$errmsg.'</font></center><br>';?>
       <br>
       <table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center'width='900' >
           <thead>
               <tr>
                   <th colspan="2" class='tbl' style='text-align: right'>
                       <br>
                       <textarea <?php if(@$_REQUEST['type'] == 3)echo 'readonly'; ?> wrap='soft' rows='9' name='Message' id='Message' style='width:700px'><?php echo @$_REQUEST['Message']; ?> </textarea>&nbsp;&nbsp;&nbsp;&nbsp;
                       <br><br>
                            Contact 
                                <?php 
                                $vars = json_encode($_REQUEST);
                                if(@$_REQUEST['type'] == 3){
                                    echo "<strong>".@$_REQUEST['recowner']." </strong>"; 
                                }
                                if(@$_REQUEST['type'] == 1){
                                  if(!@$rescu){
                                      echo 'Nobody - because nobody has contacted you';
                                  }else{
                                    echo "<select onchange='contactuserchange($vars)' id='ContactUser' name='ContactUser' style='width: 200px' >";
                                    echo "<option value=''"; ?> <?php if('' == @$_REQUEST['ContactUser'])echo 'selected';echo " ></option>";
                                    while(@$rowcu = @$rescu->fetch_assoc()){
                                        echo "<option value='".@$rowcu['FromUsername']."'"; ?> <?php if(@$rowcu['FromUsername'] == @$_REQUEST['ContactUser'])echo 'selected';echo " >".@$rowcu['FromUsername']."</option>";
                                    }
                                    echo "</select>";
                                  }
                                }
                                if((@$_REQUEST['type'] == 5)||(@$_REQUEST['type'] == 2)){
                                      echo "<input type='text' readonly id='ContactUser' name='ContactUser' value='".$recowner."' />";
                                }
                                
                                ?>     
                       &nbsp;&nbsp;&nbsp;&nbsp;<input type='button' onclick='<?php 
                                                       if(@$_REQUEST['type'] == 3){echo 'logintocontact()';} 
                                                       else if((@$_REQUEST['type'] == 1)||(@$_REQUEST['type'] == 2)||(@$_REQUEST['type'] == 4)||(@$_REQUEST['type'] == 5)){echo "respondtouser(".json_encode($_REQUEST).")";}
                                                       else {echo 'contactadvert()';}
                                                     ?>'
                              id='updatebut' value='<?php if(@$_REQUEST['type'] == 3){echo '  Login to';}?>  Send Message  ' />&nbsp;&nbsp;&nbsp;&nbsp; 
                       <br>
                       &nbsp;&nbsp;
                   </th>
               </tr>
           </thead>
           <tbody>
               <?php
                 if(@$_REQUEST['type'] == 3){
                   echo "<tr><td></td><td align='right'>Please login or register to be able to contact advertiser.</td></tr>";
                 }  
                 if((@$_REQUEST['type'] == 1)||(@$_REQUEST['type'] == 2)||(@$_REQUEST['type'] == 5)){
                    if(!@$resmess){
                      if(!@$rescu){
                        echo "<tr><td></td><td align='right'>Nobody has contacted you so you cant respond to anybody</td></tr>";
                      }else{
                        echo "<tr><td></td><td align='right'>Select one of the users who contacted you</td></tr>";
                      }
                    }else{
                      $rowcount = 0;
                      while(@$rowmess = @$resmess->fetch_assoc()){
                        $rowcount +=1;
                        $ToUsername = @$rowmess['ToUsername'];
                        $FromUsername = @$rowmess['FromUsername'];
                        if (@$rowmess['SentOrReceived'] == 'Received'){
                            $Username = $FromUsername;
                        }else{
                            $Username = $ToUsername;
                        }
                        echo "<tr class='user_$Username' align='right'><td width='120px'>From: $Username<br>On: ".@$rowmess['Date']."</td>".
                             "<td><textarea readonly wrap='soft' rows='7' id='usermsglist' style='width:700px'>".@$rowmess['Message']."</textarea>&nbsp;&nbsp;&nbsp;&nbsp;";
                      }
                      if($rowcount == 0){
                        echo "<tr><td></td><td align=right>No messages to display</td></tr>";
                     
                      }
                    }
                 }
               ?>
           </tbody>
       </table>

<?php
echo "</div>";
?>
       <input type="hidden" id='msg' name='msg' value="<?php echo @$msg.@$errmsg; ?>">
       <script>
            function contactuserchange(args){
                var key = 'AwardBidTo';
                var val = '';
                args[key] = val;
                var key = 'AwardBidAmount';
                var val = '';
                args[key] = val;
                var key = 'UnawardBid';
                var val = 'False';
                args[key] = val;

                var key = 'BidButton';
                var val = 'Not a bid'
                args[key] = val;
                var key = 'setwatch';
                var val = 'dontset';
                args[key] = val;
                var key = 'SendMessage';
                var val = 'false';
                args[key] = val;
                var key = 'ContactUser';
                var val = $("#ContactUser").val();
                args[key] = val;
                var key = 'Message';
                var val = document.getElementById("Message").value;
                args[key] = val;
                post('OfferAShipmentView.php#backtolist',args);
                return false;
            }
           
            function respondtouser(args){
                if($("#ContactUser").val() == ''){
                   alert('You have not selected someone to respond to');
                   return false;
                }
                var key = 'AwardBidTo';
                var val = '';
                args[key] = val;
                var key = 'AwardBidAmount';
                var val = '';
                args[key] = val;
                var key = 'UnawardBid';
                var val = 'False';
                args[key] = val;

                var key = 'BidButton';
                var val = 'Not a bid'
                args[key] = val;
                var key = 'setwatch';
                var val = 'dontset';
                args[key] = val;
                var key = 'SendMessage';
                var val = 'true';
                args[key] = val;
                var key = 'Message';
                var val = document.getElementById("Message").value;
                if(val.trim() == ''){
                   alert('Your message is empty, please type in something to send');
                   return false;    
                }
                args[key] = val;
                var key = 'ContactUser';
                var val = $("#ContactUser").val();
                args[key] = val;
                post('OfferAShipmentView.php#backtolist',args);
                return false;            
            }
            
            function AwardBidClick(args){
                var Bids = document.getElementById("bids");
                var Bid = Bids.options[Bids.selectedIndex].text;
                var Amount = Bid.substr(Bid.indexOf('Amount[')+7,Bid.indexOf(']')-Bid.indexOf('Amount[')-7);
                Bid = Bid.substr(Bid.indexOf(']')+1,Bid.Length);
                var Username = Bid.substr(Bid.indexOf('Username[')+9,Bid.indexOf(']')-Bid.indexOf('Username[')-9);
                //alert('Amount[' + Amount + '] Username['+ Username+']');
                var key = 'AwardBidTo';
                var val = Username;
                args[key] = val;
                var key = 'AwardBidAmount';
                var val = Amount;
                args[key] = val;
                var key = 'UnawardBid';
                var val = 'False';
                args[key] = val;
                
                var key = 'BidButton';
                var val = 'Not a bid'
                args[key] = val;
                var key = 'setwatch';
                var val = 'dontset';
                args[key] = val;
                var key = 'SendMessage';
                var val = 'false';
                args[key] = val;
                var key = 'Message';
                var val = '';
                args[key] = val;
                var key = 'ContactUser';
                var val = '';
                args[key] = val;
                post('OfferAShipmentView.php#backtolist',args);
                return false;            
            }

            function UnawardBidClick(args){
                var key = 'AwardBidTo';
                var val = '';
                args[key] = val;
                var key = 'AwardBidAmount';
                var val = '';
                args[key] = val;
                var key = 'UnawardBid';
                var val = 'True';
                args[key] = val;
                
                var key = 'BidButton';
                var val = 'Not a bid'
                args[key] = val;
                var key = 'setwatch';
                var val = 'dontset';
                args[key] = val;
                var key = 'SendMessage';
                var val = 'false';
                args[key] = val;
                var key = 'Message';
                var val = '';
                args[key] = val;
                var key = 'ContactUser';
                var val = '';
                args[key] = val;
                post('OfferAShipmentView.php#backtolist',args);
                return false;            
            }
            
            //---------------------------------------------------
            //-- Popup user action result message
            //---------------------------------------------------
            if($("#msg").val() != ''){
              alert($("#msg").val());
            }
       </script>
       
<?php       
function AwardBidToUser($jobid,$AwardBidTo,$AwardBidAmount){
    global $mysqli;
    global $errmsg;
    global $msg;
    //------------------------------------------------------------------
    //-- Update the db with Awarded username and bid
    //------------------------------------------------------------------
    $sqlu ='update OfferAShipment set '.
            "AwardBidTo = '$AwardBidTo', AwardBidAmount = '$AwardBidAmount' ".
            "where id = $jobid ";
    $resu = $mysqli->query($sqlu);
    //echo "<h1>$sqlu</h1>";

    $sqlu ='update OfferAShipmentBid set '.
            "selected = 0 ".
            "where OfferAShipmentID = $jobid ";
    $resu = $mysqli->query($sqlu);
    //echo "<h1>$sqlu</h1>";

    $sqlu ='update OfferAShipmentBid set '.
            "selected = 1 ".
            "where OfferAShipmentID = $jobid and Username = '$AwardBidTo' ";
    $resu = $mysqli->query($sqlu);
    //echo "<h1>$sqlu</h1>";

    //------------------------------------------------------------------
    //-- Set Email Headers
    //------------------------------------------------------------------
    $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    'Reply-To: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/html; charset=ISO-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();

    $subject = "ShipmentID: $jobid has been awared to $AwardBidTo for $AwardBidAmount on www.My-Logistics.co.za";

    //------------------------------------------------------------------------
    //-- Get the list of email users to send email to. get thier hash key automatically log them in
    //------------------------------------------------------------------------
    $sqlbu ='select b.Username, u.Hash, u.Email, u.FirstName, b.Bid '.
            'from OfferAShipmentBid b '.
            'inner join OfferAShipment l on l.id = b.OfferAShipmentID '.
            'inner join users u on b.Username = u.Username '.
            'where b.OfferAShipmentID = '.$jobid;
    $resbu = $mysqli->query($sqlbu);

    $reqtype = 5; //Email to user that is not owner of job but has interest in it
    while($rowbu = $resbu->fetch_assoc()){
        $to = $rowbu['Email'];
        $key = $rowbu['Hash'];
        $rhash = '';

        @$body = 'Hi '.@$rowbu['FirstName']."<br><br>";
        @$body .= 'This is a notification triggered off by the watch you have on ShipmentID: '.$jobid."<br>";
        
        if($AwardBidTo == $rowbu['Username']){
            @$body .= "You have ";
        }else{
            @$body .= "User $AwardBidTo has ";
        }
        @$body .=  "been awared the ShipmentID: $jobid for a bid amount of $AwardBidAmount.";
        
        @$body .= "You can view this ShipmentID: <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here<a>"."<br><br>";
        @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

        if (mail($to, $subject, $body, $headers)) {
          @$msg .= "";
        } else {
          @$errmsg .= "Email notification delivery to $to failed...<br>";
        }
    }
    if(@$errmsg == '')$msg = "You have awarded this Shipment to user[$AwardBidTo] for the amount of[$AwardBidAmount].";
}            

function UnawardBid($jobid){
    global $mysqli;
    global $errmsg;
    global $msg;
    //------------------------------------------------------------------
    //-- Update the db with Awarded username and bid
    //------------------------------------------------------------------
    $sqlu ='update OfferAShipment set '.
            "AwardBidTo = NULL, AwardBidAmount = NULL ".
            "where id = $jobid ";
    $resu = $mysqli->query($sqlu);
    //echo "<h1>$sqlu</h1>";

    $sqlu ='update OfferAShipmentBid set '.
            "selected = 0 ".
            "where OfferAShipmentID = $jobid ";
    $resu = $mysqli->query($sqlu);
    //echo "<h1>$sqlu</h1>";

    //------------------------------------------------------------------
    //-- Set Email Headers
    //------------------------------------------------------------------
    $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    'Reply-To: ' .'no-reply@my.logistics.co.za'. "\r\n" .
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/html; charset=ISO-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();

    $subject = "ShipmentID: $jobid has been Unawared and you are in the tracking list on www.My-Logistics.co.za";

    //------------------------------------------------------------------------
    //-- Get the list of email users to send email to. get thier hash key automatically log them in
    //------------------------------------------------------------------------
    $sqlbu ='select b.Username, u.Hash, u.Email, u.FirstName, b.Bid '.
            'from OfferAShipmentBid b '.
            'inner join OfferAShipment l on l.id = b.OfferAShipmentID '.
            'inner join users u on b.Username = u.Username '.
            'where b.OfferAShipmentID = '.$jobid;
    $resbu = $mysqli->query($sqlbu);

    $reqtype = 5; //Email to user that is not owner of job but has interest in it
    while($rowbu = $resbu->fetch_assoc()){
        $to = $rowbu['Email'];
        $key = $rowbu['Hash'];
        $rhash = '';

        @$body = 'Hi '.@$rowbu['FirstName']."<br><br>";
        @$body .= 'This is a notification triggered off by the watch you have on ShipmentID: '.$jobid."<br>";
        
        @$body .=  "The ShipmentID: $jobid has been unawared and you cna now rebid on it";
        
        @$body .= "You can view this ShipmentID: <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here<a>"."<br><br>";
        @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

        if (mail($to, $subject, $body, $headers)) {
          @$msg .= "";
        } else {
          @$errmsg .= "Email notification delivery to $to failed...<br>";
        }
    }
    if(@$errmsg == '')$msg = "You have unawarded this Shipment, all user who were interested in the bid have been notified.";    
}            

function emailnewbid($jobid,$Username,$Bid,$Watch){
    global $mysqli;
    global $errmsg;
    global $msg;
    //------------------------------------------------------------------
    //-- Set Email Headers
    //------------------------------------------------------------------
    $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    'Reply-To: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/html; charset=ISO-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();

    $subject = "A new bid has been put in for ShipmentID: $jobid on www.My-Logistics.co.za";

    //------------------------------------------------------------------------
    //-- Get the list of email users to send email to. get thier hash key automatically log them in
    //------------------------------------------------------------------------
    $sqlbu ='select b.Username, u.Hash, u.Email, u.FirstName, b.Bid '.
            'from OfferAShipmentBid b '.
            'inner join OfferAShipment l on l.id = b.OfferAShipmentID '.
            'inner join users u on b.Username = u.Username '.
            'where b.OfferAShipmentID = '.$jobid;
    $resbu = $mysqli->query($sqlbu);

    $reqtype = 5; //Email to user that is not owner of job but has interest in it
    while($rowbu = $resbu->fetch_assoc()){
        $to = $rowbu['Email'];
        $key = $rowbu['Hash'];
        $rhash = '';

        @$body = 'Hi '.@$rowbu['FirstName']."<br><br>";
        @$body .= 'This is a notification triggered off by the watch you have on ShipmentID: '.$jobid."<br>";
        
        if($Username == $rowbu['Username']){
            @$body .= "You have ";
        }else{
            @$body .= "User $Username has ";
        }
        @$body .=  "put in a bid for $Bid on the ShipmentID.";
        
        @$body .= "You can view or turn off notifications from this ShipmentID: <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here<a>"."<br><br>";
        @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

        if (mail($to, $subject, $body, $headers)) {
          @$msg .= "";
        } else {
          @$errmsg .= "Email notification delivery to $to failed...<br>";
        }
    }
}            

function emailwatchlist($jobid, $flag, $Username){
    global $mysqli;
    global $errmsg;
    global $msg;
    //------------------------------------------------------------------
    //-- Set Email Headers
    //------------------------------------------------------------------
    $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    'Reply-To: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/html; charset=ISO-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();

    if ($flag == 0){
        $subject = "You are now off the watch list for ShipmentID: $jobid on www.My-Logistics.co.za";
    }else{
        $subject = "You are now on the watch list for ShipmentID: $jobid on www.My-Logistics.co.za";
    }
    //------------------------------------------------------------------------
    //-- Get the list of email users to send email to. get thier hash key automatically log them in
    //------------------------------------------------------------------------
    $sqlwl ='select b.Username, u.Hash, u.Email, u.FirstName, b.Bid '.
            'from OfferAShipmentBid b '.
            'inner join OfferAShipment l on l.id = b.OfferAShipmentID '.
            'inner join users u on b.Username = u.Username '.
            'where b.OfferAShipmentID = '.$jobid.' '.
            'and b.Username = "'.$Username.'"';
    $reswl = $mysqli->query($sqlwl);

    $reqtype = 5; //Email to user that is not owner of job but has interest in it
    
    while ($rowwl = $reswl->fetch_assoc()){
        $to = $rowwl['Email'];
        $key = $rowwl['Hash'];
        $rhash = '';

        @$body = 'Hi '.@$rowwl['FirstName']."<br><br>";
        @$body .= 'This is a notification triggered off the the watch you have or had on ShipmentID: '.$jobid."<br>";
        @$body .= "You can view or turn off notifications from this ShipmentID: <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here<a>"."<br><br>";
        @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

        if (mail($to, $subject, $body, $headers)) {
            @$msg .= "";
        } else {
            @$errmsg .= "Email notification delivery to $to failed...<br>";
        }  
    }
}

?>    
       
       
<?php include("closebody.php"); ?>
              
</html>
