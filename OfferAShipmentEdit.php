<?php $checklogin=true;include('checklogin.php'); 

if(!strrchr(@$_SERVER['PHP_SELF'],@$_SERVER['HTTP_REFERER'])){
  //$pos1 = strrchr(@$_SERVER['HTTP_REFERER'],'/');
  //$pos2 = strrchr(@$_SERVER['HTTP_REFERER'],'.');
  //@$_SESSION['ReturnPage'] = substr(@$_SERVER['HTTP_REFERER'],$pos1,$pos2-$pos1);    
  @$_SESSION['ReturnPage'] = @$_SERVER['HTTP_REFERER'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('db.php'); ?>
<title><?php $PageTitle = 'Submit a Shipment'; echo $PageTitle; ?></title>
<META NAME="keywords" CONTENT="logistics, truck loads, shipments, transport, free" />
<META NAME="description" CONTENT="My-Logistics.co.za. The place where you can auction your shipment loads to the lowest price" />

<?php
require 'config.php';
require 'functions.php';
if (isset($_FILES['TransportOfWhatPicture'])){
    if(preg_match('/[.](jpg)|(gif)|(png)$/', strtolower($_FILES['TransportOfWhatPicture']['name']))) {
         
        $filename = $_FILES['TransportOfWhatPicture']['name'];
        $source = $_FILES['TransportOfWhatPicture']['tmp_name'];   
        $target = @$path_to_image_directory . $filename;
        $thumbnail = @$filename;
        
		$exp = explode('.',$thumbnail);
		
		$randomfile = '';
		$i=0;
		while(true){
		  $i++;
		  //echo "<h1>".$exp[$i-1]."</h1>";
		  $randomfile .= $exp[$i-1].'.';
		  if($i >= (count($exp)-1))break;
		}
		$randomfile = substr($randomfile,0,strlen($randomfile)-1);
		$thumbnail = @$path_to_thumbs_directory . @$randomfile. "_" . generateRandomString(6).".".$exp[count($exp)-1];
		 
        move_uploaded_file($source, $target);
        if (@$_REQUEST['oldthumbnail'] != ''){
		  unlink(@$_REQUEST['oldthumbnail']);
		}
        createThumbnail($filename,$thumbnail);
		unlink($target);
    	$picturemsg = "Image Submited!";
    }
	else
	{
		if (($_FILES['TransportOfWhatPicture']['name'] =='')&&(isset($_FILES['TransportOfWhatPicture']))){
			$picturemsg = "You did not select a file to upload!";
		}else{
			$picturemsg = "<font color='red'>The file you submited is not a recognised image!</font>";
		}
	}

    $sqlu = "update OfferAShipment set ";
    $sqlu .=  "TransportOfWhatPicture = '". @$thumbnail."' ";
    $sqlu .=  "where id = ". @$_REQUEST['id'];
    
    $res = $mysqli->query($sqlu);
}
?>
</head>
<?php
include('body.php');


if(@$_REQUEST['id'] == '')return;

$_SESSION['id'] = @$_REQUEST['id'];

//-------------------------------------
//-- do the update
//-------------------------------------
if (@$_REQUEST['updatesubmit'] == true){
  $_REQUEST['updatesubmit'] = "";

  $FromLoc = $_REQUEST['PickUpPoint'];
  $FromLoc=implode('+',explode(",",$FromLoc));
  $FromLoc=implode('+',explode(" ",$FromLoc));
  $FromLoc=implode('+',explode("\n",$FromLoc));
  $FromLoc=implode('+',explode("\r",$FromLoc));
  $FromLoc=implode('+',explode("<br>",$FromLoc));
  $FromLoc=implode('+',explode("<br/>",$FromLoc));
  $FromLoc=implode('+',explode("<br />",$FromLoc));

  $ToLoc = @$_REQUEST['DropOffPoint'];
  $ToLoc=implode('+',explode(",",$ToLoc));
  $ToLoc=implode('+',explode(" ",$ToLoc));
  $ToLoc=implode('+',explode("\n",$ToLoc));
  $ToLoc=implode('+',explode("\r",$ToLoc));
  $ToLoc=implode('+',explode("<br>",$ToLoc));
  $ToLoc=implode('+',explode("<br/>",$ToLoc));
  $ToLoc=implode('+',explode("<br />",$ToLoc));

  $Directions = 'http://www.google.com/maps/dir/'.$FromLoc.'/'.$ToLoc;
  $PickUpPoint = br2nl2(@$_REQUEST['PickUpPoint']);
  $DropOffPoint = br2nl2(@$_REQUEST['DropOffPoint']);
  
  $mapFrom = explode(',' ,get_lat_long($FromLoc));
  $mapTo = explode(',' ,get_lat_long($ToLoc));
  $kms = GetDrivingDistance($mapFrom[0],$mapFrom[1],$mapTo[0],$mapTo[1]);
  
  $sqlu = "update OfferAShipment set ";
  $sqlu .=  "Username = '". @$_SESSION['Username']."' ";
  if (@$_REQUEST['BiddingEndDate'] == '')@$_REQUEST['BiddingEndDate'] = date('Y-m-d',strtotime("+14 day"));$sqlu .=  ",BiddingEndDate = '".@$_REQUEST['BiddingEndDate']."' ";
  $sqlu .=  ",PickUpPoint = '$PickUpPoint' ";
  $sqlu .=  ",PickUpLongitude = '".$mapFrom[1]."' ";
  $sqlu .=  ",PickUpLatitude = '".$mapFrom[0]."' ";
  if (@$_REQUEST['PickUpDate'] == '')@$_REQUEST['PickUpDate'] = date('Y-m-d',strtotime("+15 day"));$sqlu .=  ",PickUpDate = '".@$_REQUEST['PickUpDate']."' ";
  if (@$_REQUEST['PickUpDateFlexibleByXDays'] == '')@$_REQUEST['PickUpDateFlexibleByXDays'] = '0';$sqlu .=  ",PickUpDateFlexibleByXDays = ".@$_REQUEST['PickUpDateFlexibleByXDays']." ";
  $sqlu .=  ",DropOffPoint = '$DropOffPoint' ";
  $sqlu .=  ",DropOffLongitude = '".$mapTo[1]."' ";
  $sqlu .=  ",DropOffLatitude = '".$mapTo[0]."' ";
  if (@$_REQUEST['DropOffDate'] == '')@$_REQUEST['DropOffDate'] = date('Y-m-d',strtotime("+16 day"));$sqlu .=  ",DropOffDate = '".@$_REQUEST['DropOffDate']."' ";
  if (@$_REQUEST['DropOffDateFlexibleByXDays'] == '')@$_REQUEST['DropOffDateFlexibleByXDays'] = '0';$sqlu .=  ",DropOffDateFlexibleByXDays = ".@$_REQUEST['DropOffDateFlexibleByXDays']." ";
  $sqlu .=  ",Distance = '".$kms['Distance']."' ";
  $sqlu .=  ",DurationOfTrip = '".$kms['Time']."' ";
  $sqlu .=  ",Directions = '$Directions' ";
  $sqlu .=  ",TransportWhat = '". @$_REQUEST['TransportWhat']."' ";
  $sqlu .=  ",TypeOfTransport = '". @$_REQUEST['TypeOfTransport']."' ";
  if(isset($_REQUEST['TransportOfWhatPictureTemp']))$sqlu .=  ",TransportOfWhatPicture = '". @$_REQUEST['TransportOfWhatPictureTemp']."' ";
  if (@$_REQUEST['Tons'] == '')@$_REQUEST['Tons'] = '0'; $sqlu .=  ",Tons = ". @$_REQUEST['Tons'] ." ";
  if (@$_REQUEST['CubicMeters'] == '')@$_REQUEST['CubicMeters'] = '0'; $sqlu .=  ",CubicMeters = ". @$_REQUEST['CubicMeters'] ." ";
  $sqlu .=  "where id = ". @$_REQUEST['id'];
  
  if(!$res = $mysqli->query($sqlu) )$errmsg = mysqli_error($mysqli);
  
  echo "<center><font color=blue><h2>Record updated succesfully</h2></font></center>";
  emailnotifyupdatewatchlist($_SESSION['id']);
  $recupdok = 'Record updated succesfully';
}

echo "<form enctype='multipart/form-data' method='post' action='#' id='pform' name='pform' ><div>";

 
//--------------------------------------
//-- Get the passed record
//--------------------------------------
$sql = "SELECT * FROM OfferAShipment where id =".$_SESSION['id'];

//---------------------------------------------------
//-- If passed rec not exists add one and link to it
//---------------------------------------------------
$res = $mysqli->query($sql);
if(@$res->num_rows == 0){
  $sqli = 'insert into OfferAShipment(Directions,PickUpDate,DropOffDate) values("http://www.google.com/maps/dir/","'.date_format(new DateTime, 'Y-m-d').'","'.date_format(new DateTime, 'Y-m-d').'")';
  $mysqli->query($sqli);
  $_SESSION['id'] = $mysqli->insert_id;
  $sql = "SELECT * FROM OfferAShipment where id =".$_SESSION['id'];
  $mysqli->query($sql);
  $res = $mysqli->query($sql);
}
//--------------------------------------
//-- Display List of Offer a Shipment Data
//--------------------------------------
$row = @$res->fetch_assoc();

  //--------------------------------------------
  //-- Add hidden fields before display table
  //---------------------------------------------
//echo "<input type='hidden' id='id' name='id' value='".$row['id']."' />";
  
echo "<table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center' >";
echo "<thead><tr class='inputtableheader'>".
     "<th class='tbl' colspan='2' align=center>".
     "<h1>&nbsp;&nbsp; Record Details &nbsp;&nbsp;</h1>".
	 "</th></tr></thead><tbody>";
$highlight = 1;
foreach ($row as $Col=>$Val){
  if(($Col =='PickUpLongitude')||($Col =='PickUpLatitude')||($Col =='DropOffLongitude')||($Col =='DropOffLatitude')){
    echo "<input type='hidden' id='$Col' name='$Col' value='$Val' />";
	continue;
  }
  //Dont update this here
  if(($Col =='AwardBidTo')||($Col =='AwardBidAmount')){
    continue;
  }
   
  echo "<tr>";
  
   echo "<td>".ColToLable($Col)."</td>";
   if($Col =='id'){
     echo "<td><input class='numformat' type='text' id='id' name='id' value='$Val' readonly /></td>";
   }
   else if($Col =='Directions'){
     echo "<td><font color='red'>Check that your Pick Up and Drop Off Points are correct!</font><br><input type='button' id='Directions' name='Directions' onclick='getDirections();' value='   On Google Maps   ' /></td>";
   }
   else if($Col =='Distance'){
     echo "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='DurationOfTrip'){
     echo "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='Username'){
     echo "<td><input type='text' id='$Col' name='$Col' readonly value='".@$_SESSION['Username']."'></input></td>";
   }
   else if($Col=='PickUpPoint'){
     echo "<td width='400px'><textarea wrap='soft' rows='4' id='PickUpPoint' name='PickUpPoint' style='width:400px'>".$Val."</textarea></td>";
   }   
   else if($Col=='DropOffPoint'){
     echo "<td><textarea wrap='soft' rows='4' id='DropOffPoint' name='DropOffPoint' style='width:400px'>".$Val."</textarea></td>";
   }   
   else if($Col=='BiddingEndDate'){
     echo "<td><input type='text' id='BiddingEndDate' name='BiddingEndDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col=='PickUpDate'){
     echo "<td><input type='text' id='PickUpDate' name='PickUpDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col=='DropOffDate'){
     echo "<td><input type='text' id='DropOffDate' name='DropOffDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col =='PickUpDateFlexibleByXDays'){
     echo "<td><input class='numformat' type='number' id='$Col' name='$Col' value='".$Val."'></input></td>";
   }
   else if($Col =='DropOffDateFlexibleByXDays'){
     echo "<td><input class='numformat' type='number' id='$Col' name='$Col' value='".$Val."'></input></td>";
   }
   else if($Col=='TransportWhat'){
     echo "<td><textarea wrap='soft' rows='4' id='TransportWhat' name='TransportWhat' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col=='TransportOfWhatPicture'){
     if(file_exists($Val) == false){
       ?>
         <td>
           <h2>Upload a single image to load</h2>
           <?php echo "<h2>$picturemsg</h2>"; ?>
           <input type="file" id="TransportOfWhatPicture" name="TransportOfWhatPicture"  accept="image/*" onChange="globalnoprompt=false;" />
           <input type="hidden" id="oldthumbnail" name="oldthumbnail" value="<?php echo $thumbnail; ?>" />
           <input type="button" onClick="uploadimgclicked();" id="uploadimg" value="    Upload!    "  />
           <input type="submit" style="display:none" id="pformsubmit" value="NotVisible"  />
         </td>
       <?php
	 }else{
	 ?>
	   <td>		   
		   <img src="<?php echo "$Val"; ?>" /><br>&nbsp;
		   <input type='button' id='delbut' onclick='delbutclicked();' value='   Delete this picture!   ' />
		   <input type="hidden" id="oldthumbnail" value="<?php echo $Val; ?>" />
	   </td>
	 <?php
	 }
   }
   else if($Col=='TypeOfTransport'){
     echo "<td><input type='text' id='TypeOfTransport' name='TypeOfTransport' value='".$Val."'></input></td>";
   }
   else if($Col=='Tons'){
     echo "<td><input class='numformat' type='text' id='Tons' name='Tons' value='".$Val."'></input></td>";
   }
   else if($Col=='CubicMeters'){
     echo "<td><input class='numformat' type='text' id='CubicMeters' name='CubicMeters' value='".$Val."'></input></td>";
   }else{
     echo "<td>$Val</td>";
   }
   echo "</tr>";
}

echo "<tr class='tbl' bgcolor='#FFBBFF'  style='height:40px;font-weight:bold'>".
     "<td class='tbl' colspan='2' align=right>".
     "<input type='button' onclick='updatebutclicked(false)' id='updatebut' value='  Submit  ' /> &nbsp;&nbsp;";
?>
      <input type='button' onclick='backtolistclick( <?php echo '"'.@$_SESSION['ReturnPage'].'"'; ?> );' id='backtolist' value='  Go Back to List  ' /> &nbsp;&nbsp;
<?php
echo "</td></tr>";

echo "</tbody></table></div>";
?>
<input type="hidden" id='msg' name="msg" value="<?php echo @$recupdok; ?>"/>

<?php
function emailnotifyupdatewatchlist($jobid){
    global $mysqli;
    global $errmsg;
    global $msg;


    
    //--------------------------------------
    //-- Get the passed record
    //--------------------------------------
    $esql = "SELECT * FROM OfferAShipment where id =".$jobid;

    $eres = $mysqli->query($esql);

    //--------------------------------------
    //-- Display List of Offer a Shipment Data
    //--------------------------------------        
    $erow = $eres->fetch_assoc();
    @$datatable .= "<table cellpadding=0 cellspacing=0 border=0 bordercolor='blue' align='center' >";
    $datatable .= "<thead><tr class='inputtableheader'>".
         "<th class='tbl' colspan='2' align=center>".
         "<h1>&nbsp;&nbsp; Record Details &nbsp;&nbsp;</h1>".
	 "</td></tr></thead><tbody>";
foreach ($erow as $Col=>$Val){
   //Hide these coloums but update them with data later
   if(($Col =='PickUpLongitude')||($Col =='PickUpLatitude')||($Col =='DropOffLongitude')
                                ||($Col =='DropOffLatitude')||($Col =='TransportOfWhatPicture)')){
     continue;
   }
   //Dont update this here
   if(($Col =='AwardBidTo')||($Col =='AwardBidAmount')){
     continue;
   }
   $datatable .= '<tr>'; 
   $datatable .= "<td>".ColToLable($Col)."</td>";
   if($Col =='id'){
     $datatable .= "<td><input class='numformat' type='text' id='id' name='id' value='$Val' readonly /></td>";
   }
   else if($Col =='Username'){
     $datatable .= "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='Distance'){
     $datatable .= "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='DurationOfTrip'){
     $datatable .= "<td><input type='text' id='$Col' name='$Col' value='$Val' readonly /></td>";
   }
   else if($Col =='Directions'){
     $datatable .= "<td><input type='button' id='Directions' name='Directions' onclick='getDirections();' value='   On Google Maps   ' /></td>";
   }
   else if($Col=='PickUpPoint'){
     $datatable .= "<td width='400px'><textarea readonly wrap='soft' rows='4' id='PickUpPoint' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col =='PickUpDateFlexibleByXDays'){
     $datatable .= "<td><input readonly class='numformat' type='number' id='$Col' name='$Col' value='".$Val."'></input></td>";
   }
   else if($Col =='DropOffDateFlexibleByXDays'){
     $datatable .= "<td><input readonly class='numformat' type='number' id='$Col' name='$Col' value='".$Val."'></input></td>";
   }
   else if($Col=='DropOffPoint'){
     $datatable .= "<td><textarea readonly wrap='soft' rows='4' id='DropOffPoint' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col=='BiddingEndDate'){
     $datatable .= "<td><input readonly type='text' id='BiddingEndDate' name='BiddingEndDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col=='PickUpDate'){
     $datatable .= "<td><input readonly type='text' id='PickUpDate' name='PickUpDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col=='DropOffDate'){
     $datatable .= "<td><input readonly type='text' id='DropOffDate' name='DropOffDate' value='".date_format(date_create($Val),"Y-m-d")."'></input></td>";
   }
   else if($Col=='TransportWhat'){
     $datatable .= "<td><textarea readonly wrap='soft' rows='4' id='TransportWhat' style='width:400px'>$Val</textarea></td>";
   }   
   else if($Col=='TypeOfTransport'){
     $datatable .= "<td><input readonly type='text' id='TypeOfTransport' name='TypeOfTransport' value='".$Val."'></input></td>";
   }
   else if($Col=='Tons'){
     $datatable .= "<td><input class='numformat' readonly type='text' id='Tons' name='Tons' value='".$Val."'></input></td>";
   }
   else if($Col=='CubicMeters'){
     $datatable .= "<td><input class='numformat' readonly type='text' id='CubicMeters' name='CubicMeters' value='".$Val."'></input></td>";
   }else{
     $datatable .= "<td>$Val</td>";
   }
   $datatable .= "</tr>";
}  
$datatable .= "<tbody></table>";

    //------------------------------------------------------------------
    //-- Set Email Headers
    //------------------------------------------------------------------
    $headers = 'From: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    'Reply-To: ' .'no-reply@my-logistics.co.za'. "\r\n" .
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/html; charset=ISO-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
  
    $subject = 'Your ShipmentID['.$jobid.'] has been modified.';
    $reqtype = 4; //Email to owner of job
     
    //------------------------------------------------------------------
    //-- Get owner of record details
    //------------------------------------------------------------------
    $sqlo ='select l.Username, u.Hash, u.Email, u.FirstName '.
            'from OfferAShipment l '.
            'inner join users u on l.Username = u.Username '.
            'where l.id = '.$jobid;
    $reso = $mysqli->query($sqlo);
    $rowo = $reso->fetch_assoc();
    
    $subject = 'ShipmentID['.$jobid.'] has been modified, you getting this mail because you on the watch list';

    $to = $rowo['Email'];
    $key = $rowo['Hash'];
    $rhash = '';

    @$body = 'Hi '.@$rowo['FirstName']."<br><br>";
    @$body .= 'This is a notification from your ShipmentID: '.$jobid." that was modified on our site.<br>";
    @$body .= "You can view this ShipmentID: <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here</a> on our site."."<br><br>";
    @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

    if (mail($to, $subject, $body, $headers)) {
        @$msg .= "";
    } else {
        @$errmsg .= "Email notification delivery to $to failed...<br>";
    }  
   
    //------------------------------------------------------------------------
    //-- Get the list of email users to send email to. get thier hash key automatically log them in
    //------------------------------------------------------------------------
    $sqlwl ='select b.Username, u.Hash, u.Email, u.FirstName, b.Bid '.
            'from OfferAShipmentBid b '.
            'inner join OfferAShipment l on l.id = b.OfferAShipmentID '.
            'inner join users u on b.Username = u.Username '.
            'where b.OfferAShipmentID = '.$jobid;
    //echo '<h1>'.$sqlwl.'</h1><br/>';
    $reswl = $mysqli->query($sqlwl);

    $reqtype = 5; //Email to user that is not owner of job but has interest in it
    
    $InterestedUsers = 0;
    while ($rowwl = $reswl->fetch_assoc()){
        $InterestedUsers += 1;
        $to = $rowwl['Email'];
        $key = $rowwl['Hash'];
        $rhash = '';

        @$body = 'Hi '.@$rowwl['FirstName']."<br><br>";
        @$body .= 'This is a notification triggered off by the watch you have on ShipmentID: '.$jobid."<br>";
        @$body .= "You can view or turn off notifications from this ShipmentID: <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here<a>"."<br><br>";
        @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

        if (mail($to, $subject, $body, $headers)) {
            @$msg .= "";
        } else {
            @$errmsg .= "Email notification delivery to $to failed...<br>";
        }  
    }
    if($InterestedUsers == 0){

        $sqlgu = 'select u.Username, u.Hash, u.Email, u.FirstName from users u where u.UserType in ("All of the above","I Have A Vehicle for Load Shipments")';
        //echo '<h1>'.$sqlwl.'</h1><br/>';
        $resgu = $mysqli->query($sqlgu);

        $reqtype = 5; //Email to user that is not owner of job but has interest in it

        while ($rowgu = $resgu->fetch_assoc()){
            $to = $rowgu['Email'];
            $key = $rowgu['Hash'];
            $rhash = '';

            @$body = 'Hi '.@$rowuu['FirstName']."<br><br>";
            @$body .= 'This is a notification triggered off by the new Shipment global notification service of www.my-logistics.co.za. Shipment no: '.$jobid." is fresh and has no interested shippers...<br>";
            @$body .= "You can go check it out <a href='http://www.my-logistics.co.za/OfferAShipmentView.php?id=$jobid&type=$reqtype&hash=$key$rhash#backtolist'>here<a>"."<br><br>";
            @$body .= 'Thank you'."<br>www.My-Logistics.co.za<br>";

            if (mail($to, $subject, $body, $headers)) {
                @$msg .= "";
            } else {
                @$errmsg .= "Email notification delivery to $to failed...<br>";
            }  
        }
    }
}
?>
<script>

if( ($('#msg').val() !== '') || ($('#msg').val() != ''))alert($('#msg').val());

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

function delbutclicked(){ 
 var oldfile = $('#oldthumbnail').val();
 if (confirm('Are you sure you want to delete this picture!') == true){
   $.ajax({
    url: 'SetInputVal.php',
    type: 'POST',
    data: { DelThumbnail: true, oldfilename : oldfile } ,
    success:function(data){
        console.log(data);
    } 
   });

/*   
   sleep(1000);
   
   var newloc = window.location.href.replace('#','');

   if(newloc.indexOf('?') >= 0){
     newloc += "&deletedpic=true";
   }else{
     newloc += "?deletedpic=true";
   }

   window.location.assign(newloc);
*/
   globalnoprompt = true;
   updatebutclicked();
  }
}

function updatebutclicked(){ 
  if(globalnoprompt == false){
    if (confirm("'Upload!' the image first, or else it will not be saved. Click cancel to go back ") == false){
      return false;
    }
  }

  form  = document.createElement("form");
  input = document.createElement("input");input.setAttribute("name", "id");input.setAttribute("value", $('#id').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "Username");input.setAttribute("value", $('#Username').val());form.appendChild(input);
  x = document.createElement("TEXTAREA");x.setAttribute("name", "PickUpPoint");x.value = $('#PickUpPoint').val();form.appendChild(x);
  x = document.createElement("TEXTAREA");x.setAttribute("name", "DropOffPoint");x.value = $('#DropOffPoint').val();form.appendChild(x);
  x = document.createElement("TEXTAREA");x.setAttribute("name", "Directions");x.value = $('#Directions').val();form.appendChild(x);
  input = document.createElement("input");input.setAttribute("name", "BiddingEndDate");input.setAttribute("value", $('#BiddingEndDate').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "PickUpDate");input.setAttribute("value", $('#PickUpDate').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "DropOffDate");input.setAttribute("value", $('#DropOffDate').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "PickUpDateFlexibleByXDays");input.setAttribute("value", $('#PickUpDateFlexibleByXDays').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "DropOffDateFlexibleByXDays");input.setAttribute("value", $('#DropOffDateFlexibleByXDays').val());form.appendChild(input);
  x = document.createElement("TEXTAREA");x.setAttribute("name", "TransportWhat");x.value = $('#TransportWhat').val();form.appendChild(x);

  //upload an empty picture path??or the current path
  //alert('TransportOfWhatPicture into temp:' + $('#TransportOfWhatPicture').val());
  //input = document.createElement("input");input.setAttribute("name", "TransportOfWhatPictureTemp");input.setAttribute("value", $('#TransportOfWhatPicture').val());form.appendChild(input);
  
  input = document.createElement("input");input.setAttribute("name", "TypeOfTransport");input.setAttribute("value", $('#TypeOfTransport').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "Tons");input.setAttribute("value", $('#Tons').val());form.appendChild(input);
  input = document.createElement("input");input.setAttribute("name", "CubicMeters");input.setAttribute("value", $('#CubicMeters').val());form.appendChild(input);

  input = document.createElement("input");input.setAttribute("name", "updatesubmit");input.setAttribute("value", "true");form.appendChild(input);
  form.setAttribute("method", "post");
  form.submit();
}

function uploadimgclicked(){
  
  if (_isDirty)if(!confirm('Only the picture will be uploaded, you will lose any other changes to the form, do you want to continue?'))return false;
  
  form = document.getElementById('pform');
  
  if(!form.elements["TransportOfWhatPicture"]){input = document.createElement("input");input.setAttribute("name", "TransportOfWhatPicture");input.setAttribute("value", $('#TransportOfWhatPicture').val());form.appendChild(input);}

  if(!form.elements["TransportOfWhatPictureTemp"]){input = document.createElement("input");input.setAttribute("name", "TransportOfWhatPictureTemp");input.setAttribute("value", $('#TransportOfWhatPicture').val());form.appendChild(input);}

  if(!form.elements["id"]){input = document.createElement("input");input.setAttribute("name", "id");input.setAttribute("value", $('#id').val());form.appendChild(input);}
  
  if(!form.elements["Username"]){input = document.createElement("input");input.setAttribute("name", "Username");input.setAttribute("value", $('#Username').val());form.appendChild(input);}
  if(!form.elements["PickUpPoint"]){x = document.createElement("TEXTAREA");x.setAttribute("name", "PickUpPoint");x.value = $('#PickUpPoint').val();form.appendChild(x);}
  if(!form.elements["DropOffPoint"]){x = document.createElement("TEXTAREA");x.setAttribute("name", "DropOffPoint");x.value = $('#DropOffPoint').val();form.appendChild(x);}
  if(!form.elements["Directions"]){x = document.createElement("TEXTAREA");x.setAttribute("name", "Directions");x.value = $('#Directions').val();form.appendChild(x);}
  if(!form.elements["BiddingEndDate"]){input = document.createElement("input");input.setAttribute("name", "BiddingEndDate");input.setAttribute("value", $('#BiddingEndDate').val());form.appendChild(input);}
  if(!form.elements["PickUpDate"]){input = document.createElement("input");input.setAttribute("name", "PickUpDate");input.setAttribute("value", $('#PickUpDate').val());form.appendChild(input);}
  if(!form.elements["DropOffDate"]){input = document.createElement("input");input.setAttribute("name", "DropOffDate");input.setAttribute("value", $('#DropOffDate').val());form.appendChild(input);}
  if(!form.elements["PickUpDateFlexibleByXDays"]){input = document.createElement("input");input.setAttribute("name", "PickUpDateFlexibleByXDays");input.setAttribute("value", $('#PickUpDateFlexibleByXDays').val());form.appendChild(input);}
  if(!form.elements["DropOffDateFlexibleByXDays"]){input = document.createElement("input");input.setAttribute("name", "DropOffDateFlexibleByXDays");input.setAttribute("value", $('#DropOffDateFlexibleByXDays').val());form.appendChild(input);}
  if(!form.elements["TransportWhat"]){x = document.createElement("TEXTAREA");x.setAttribute("name", "TransportWhat");x.value = $('#TransportWhat').val();form.appendChild(x);}
  //input TransportOfWhatPicture
  var pic = $('#TransportOfWhatPicture').val();
  if(pic.lastIndexOf("\\") >= 0){
    //remove till last folder we dont need
    pic = pic.substr(pic.lastIndexOf("\\")|+1, pic.length);
  }else if(pic.lastIndexOf("/") <= 0){
    //romove till last folder we dont need
    pic = pic.substr(pic.lastIndexOf('/')+1, pic.length);
  }else{
    //Do nothing with string
    //pic = pic;
  }
  pic = "images/thumbs/"+pic;
  input = document.createElement("input");input.setAttribute("name", "TransportOfWhatPictureTemp");input.setAttribute("value", pic);form.appendChild(input);
  
  if(!form.elements["TypeOfTransport"]){input = document.createElement("input");input.setAttribute("name", "TypeOfTransport");input.setAttribute("value", $('#TypeOfTransport').val());form.appendChild(input);}
  if(!form.elements["Tons"]){input = document.createElement("input");input.setAttribute("name", "Tons");input.setAttribute("value", $('#Tons').val());form.appendChild(input);}
  if(!form.elements["CubicMeters"]){input = document.createElement("input");input.setAttribute("name", "CubicMeters");input.setAttribute("value", $('#CubicMeters').val());form.appendChild(input);}
    
  $('#pformsubmit').trigger('click');
}

//---------------------------------------------------------
//-- Set search parameters
//---------------------------------------------------------
 
 $('#BiddingEndDate').datepicker({
                 dateFormat: 'yy-mm-dd'
                });
 $('#PickUpDate').datepicker({
                 dateFormat: 'yy-mm-dd'
                });
 $('#DropOffDate').datepicker({
                 dateFormat: 'yy-mm-dd'
                });

</script>
</form>
<?php include("closebody.php"); ?>
</html>
