<?php $checklogin=false;include_once('checklogin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('db.php'); ?>
<title><?php $PageTitle = 'List Of All Shipments'; echo $PageTitle; ?></title>
<META NAME="keywords" CONTENT="logistics, truck loads, shipments, transport, free" />
<META NAME="description" CONTENT="My-Logistics.co.za. The place where you can auction your shipment loads to the lowest price" />

<?php
require 'config.php';
require 'functions.php';
?>
</head>

<?php
include ('body.php');
if(@$_SESSION['Username'] == '') echo "<center><font color='red'><h2>Register for Free, or Login to view extra info and reply to listings</h2></font></center>";

echo "<table align='center' class='noformat'><tr class='noformat'><td class='noformat'>";
$map = 'map1';
include('maps.php');
echo "</td></tr></table>";

echo "<form method='post' action='#'><div>";
//@$_SESSION['iTransportWhat'] = @$_REQUEST['iTransportWhat'];
@$_SESSION['iDate'] = @$_REQUEST['iDate'];
if(@$_SESSION['iDate'] == ''){@$_SESSION['iDate'] = date('Y-m-d', strtotime("+0 hour"));}
echo "<table cellpadding=0 cellspacing=0 align='center'>";
echo "<thead><tr class='inputtableheader'>".
       "<th class='tbl' colspan='2' align='left'>".
	   "<a name='Sorting'>Enter search criteria below to get a list of shipments on the bottom table.<br><br>Please note that the map with its search box displays markers as you move around or type in an area on the map search.<br><br><font color='yellow'>(The map marker display is not linked to the search on the bottom and the bottom results)</font></a>".
	   "</th>".
	 "</tr></thead>";
echo "<tbody>";
echo "<tr>".
       "<td style='font-weight: bold;'>Pick Up Or Drop Off Point:</td>".
	   "<td><input type='text' size='130' placeholder='Type in the a short description of the pick up or drop off point you looking for' id='iLocation' name='iLocation' value='".@$_SESSION['iLocation']."'/></input></td>";
     "</tr>";
echo "<tr>".
       "<td style='font-weight: bold;'>Transport What:</td>".
	   "<td><input type='text' size='130' placeholder='Type in a short desciption of what will be tranported or leave blank for all' id='iTransportWhat' name='iTransportWhat' value='".@$_SESSION['iTransportWhat']."'/></input></td>";
     "</tr>";
echo "<tr>".
       "<td style='font-weight: bold;'>Bidding End Date Of Job:</td>".
	   "<td><input type='text'  size='130' id='iDate' name='iDate' placeholder='Type any date from today and into the future for bidding ending dates.' value='".@$_SESSION['iDate']."'></input>".
	 "</td>".
	 "</tr><tr class='tbl'><td colspan=2 class='tbl' align='right'>".
         '<input type="submit" name="submit" id="submit" value="  Search  " /></td></tr></tbody>';	 
echo "</table>";
echo "<br><br>";

$sql = "SELECT * FROM OfferAShipment ";

//--------------------------------------
//-- Get List of Offer where conditions
//--------------------------------------
$where = " where ((AwardBidTo = '') OR (AwardBidTo is NULL)) ";
if((@$_SESSION['iDate'] == '')||(@$_SESSION['iDate'] == null)){
  $where .= ' and BiddingEndDate >= "'.date('yy-mm-dd').'"';
}else{
  $where .= ' and BiddingEndDate >= "'.@$_SESSION['iDate'].'"';
}

if((@$_SESSION['iTransportWhat'] == '')||(@$_SESSION['iTransportWhat'] == null)){
  //dont filter this
}else{
  $where .= ' and ( TransportWhat like "%'.@$_SESSION['iTransportWhat'].'%" ) ';
}

if((@$_SESSION['iLocation'] == '')||(@$_SESSION['iLocation'] == null)){
  //dont filter this
}else{
  $where .= ' and ( PickUpPoint like "%'.@$_SESSION['iLocation'].'%" ';
  $where .= '       or DropOffPoint like "%'.@$_SESSION['iLocation'].'%" )';
}
//--------------------------------------
//-- Get List of Offer Sort Order
//--------------------------------------
if((@$_REQUEST['Sort'] == '')||(@$_REQUEST['Sort'] == null)){
  $_SESSION['Sort'] = 'id';
  $Order = " &or;";
  $ColSort = "id";  
  $Sort = $ColSort." Desc";
  $_SESSION['Order'] = 'Asc';
}else{
  if(@$_SESSION['Sort'] === @$_REQUEST['Sort']){
    if($_REQUEST['Order'] === 'Asc'){
	  $_SESSION['Order'] = 'Desc';
	  $Order = " &and;";
	}else{
	  $_SESSION['Order'] = 'Asc';
	  $Order = " &or;";
	}
  }else{
    if($_REQUEST['Order'] === 'Asc'){
	  $_SESSION['Order'] = 'Desc';
	  $Order = " &and;";
	}else{
	  $_SESSION['Order'] = 'Asc';
	  $Order = " &or;";
	}
  };
  $_SESSION['Sort'] = $_REQUEST['Sort'];
  $ColSort = $_SESSION['Sort'];
  $Sort = $ColSort." ".@$_REQUEST['Order'];
}  

//--------------------------------------
//-- Select user page
//--------------------------------------
if((@$_REQUEST['iRecs'] == '')||(@$_REQUEST['iRecs'] === '')||(@$_REQUEST['iRecs'] == null))@$_SESSION['iRecs']='10';
else @$_SESSION['iRecs']=@$_REQUEST['iRecs'];
$recs=@$_SESSION['iRecs'];
if((@$_REQUEST['iPage'] == '')||(@$_REQUEST['iPage'] === '')||(@$_REQUEST['iPage'] == null))@$_SESSION['iPage']=1;
else @$_SESSION['iPage']=@$_REQUEST['iPage'];
$page=@$_SESSION['iPage'];
$offset = ($page-1) * $recs;
$Limit = ' LIMIT '.$offset.','.$recs;
if(($recs == '')||($recs === '')||($recs == null)){
  $Limit = '';
  @$_SESSION['iRecs']='10';
  @$_SESSION['iPage']=1;
}
if($recs == 'All'){
  $Limit = '';
  @$_SESSION['iRecs']='All';
  @$_SESSION['iPage']=1;
}

$sqlcount = 'select count(*) as numrows from OfferAShipment '. $where;
$numrowsres = $mysqli->query($sqlcount);
@$row = @$numrowsres->fetch_assoc();
@$_SESSION['numrows']=@$row["numrows"]; 
$sql .= $where ." ORDER BY ".$Sort. $Limit;
$res = $mysqli->query($sql);
//--------------------------------------
//-- Display List of Offer a Shipment Data
//--------------------------------------
echo "<input type='hidden' name='numrows' id='numrows' value='".$_SESSION['numrows']."'/>";
$recs = @$_SESSION['iRecs'];
if (($recs == 0) || ($recs === '') || ($recs == ''))$recs = 1;
$numpages = @$_SESSION['numpages'];
if (($numpages == 0) || ($numpages === '') || ($numpages == ''))$numpages = 1;
@$_SESSION['numpages'] = ceil($_SESSION['numrows']/$recs);
echo "<table cellpadding=0 cellspacing=0 align='center'>";
echo "<thead><tr class='inputtableheader'>".
     "<th class='tbl' colspan='8' align='right'>".
     "Page: &nbsp;&nbsp; <input type='number' class='numformat' min=1 max='".$numpages."' size='3' width='20px' size=3 maxlength='20px' id='iPage' name='iPage'  onChange='javascript:updiPage()' value='".@$_SESSION['iPage']."' /> &nbsp;&nbsp;&nbsp;&nbsp; Number of Records Per Page: &nbsp;&nbsp; ";
echo "<select name='iRecs' id='iRecs' onChange='javascript:updiPage()' >";
echo "<option value='10' ";?><?php if(@$_SESSION['iRecs'] == '10')echo 'selected'; echo " >10</option>";
echo "<option value='20' ";?><?php if(@$_SESSION['iRecs'] == '20')echo 'selected'; echo ">20</option>";
echo "<option value='50' ";?><?php if(@$_SESSION['iRecs'] == '50')echo 'selected'; echo ">50</option>";
echo "<option value='100' ";?><?php if(@$_SESSION['iRecs'] == '100')echo 'selected'; echo ">100</option>";
echo "<option value='All' ";?><?php if(@$_SESSION['iRecs'] == 'All')echo 'selected'; echo ">All</option>";
echo "</select>".
	 "</th>".
     "</tr></thead>";
echo "<tbody><tr class='inputtableheader'>".
     "<td width='30px'><a href='OfferAShipmentList.php#Sorting' onclick=setsort('id','".@$_SESSION['Order']."','".@$_SESSION['iLocation']."','".@$_SESSION['iDate']."','".@$_SESSION['iTransportWhat']."');>ID:";?><?php if('id'===$ColSort)echo $Order; echo "</a></td>".
     "<td width='200px'><a href='OfferAShipmentList.php#Sorting' onclick=setsort('PickUpPoint','".@$_SESSION['Order']."','".@$_SESSION['iLocation']."','".@$_SESSION['iDate']."','".@$_SESSION['iTransportWhat']."');>Pick Up Point:";?><?php if('PickUpPoint'===$ColSort)echo $Order; 
echo "</a></td>".
	 "<td width='200px'><a href='OfferAShipmentList.php#Sorting' onclick=setsort('DropOffPoint','".@$_SESSION['Order']."','".@$_SESSION['iLocation']."','".@$_SESSION['iDate']."','".@$_SESSION['iTransportWhat']."');>Drop Off Point:";?><?php if('DropOffPoint'===$ColSort)echo $Order; echo "</a></td>".
	 "<td width='100px'><a href='OfferAShipmentList.php#Sorting' onclick=setsort('BiddingEndDate','".@$_SESSION['Order']."','".@$_SESSION['iLocation']."','".@$_SESSION['iDate']."','".@$_SESSION['iTransportWhat']."');>Bidding End Date:";?><?php if('BiddingEndDate'===$ColSort)echo $Order; echo "</a></td>".
	 "<td width='100px'><a href='OfferAShipmentList.php#Sorting' onclick=setsort('TransportWhat','".@$_SESSION['Order']."','".@$_SESSION['iLocation']."','".@$_SESSION['iDate']."','".@$_SESSION['iTransportWhat']."');>Transport What:";?><?php if('TransportWhat'===$ColSort)echo $Order; echo "</a></td>".
	 "<td width='60px'><a href='OfferAShipmentList.php#Sorting' onclick=setsort('TypeOfTransport','".@$_SESSION['Order']."','".@$_SESSION['iLocation']."','".@$_SESSION['iDate']."','".@$_SESSION['iTransportWhat']."');>Type Of Transport:";?><?php if('TypeOfTransport'===$ColSort)echo $Order; echo "</a></td>".
	 "<td width='30px'>Extra Info</td>".
	 "</tr>";
while($row = $res->fetch_assoc())
{
  echo "<tr>";

  $thisrowid = @$row['id'];
  
  echo "<td><input class='numformat' type='text' size='4' readonly id='id' value='$thisrowid' /></td>";
  echo "<td><textarea wrap='soft' rows='4' readonly id='PickUpPoint' style='width:240px'>".$row['PickUpPoint']."</textarea></td>";
  echo "<td><textarea wrap='soft' rows='4' readonly id='DropOffPoint' style='width:240px'>".$row['DropOffPoint']."</textarea></td>";
  echo "<td>".date_format(date_create(@$row['BiddingEndDate']),"Y-m-d")."</td>";
  echo "<td><textarea wrap='soft' rows='4' readonly id='TransportWhat' style='width:240px'>".$row['TransportWhat']."</textarea></td>";
  echo "<td>".$row['TypeOfTransport']."</td>";

  $recowner = @$row['Username'];
  $loggedin = @$_SESSION['Username'];

  if(@$loggedin == ''){
    @$type = 3;
  }else if(@$recowner == @$loggedin){
    @$type = 1;
  }else{
    @$type = 2;
  }
  ?>
    <td>
        <input type="button" value="  Details <?php if(@$_SESSION['Username'] != '') echo "Bid And Reply  ";?>" onClick="getdetailsclick(<?php echo @$thisrowid .",". @$type .",".  "'".@$recowner."'" .",".  "'".@$loggedin."'" ;?>);" />
    </td>
  <?php
  echo "</tr>";
}
if ($res->num_rows <= 0){
    echo "<tr class='tbl'><td class='tbl' colspan='7'><center><h2>There are no Shipments listed for your search. Please try simplifying your search terms.</h2></center></td></tr>";
}
echo "</tbody></table>";
?>

<script>

//---------------------------------------------------------
//-- Set search parameters
//---------------------------------------------------------
  
 $('#iDate').datepicker({
                 dateFormat: 'yy-mm-dd',
                 minDate: "-2d",
                 changeMonth: true,
                 changeYear: true,
                 onSelect: function(dateText, inst) { 
                       $.ajax({
                             url: "SetInputVal.php?DatePickerVal='" + dateText +"'&DatePickerValSet=1",
                               success: function(){
                                 $(this).addClass("done");
                               }
                             });
                }
             });


$('#iLocation').blur(function(){
  var thevalue = $(this).val();

 $.ajax({
    url: 'SetInputVal.php',
    type: 'POST',
    data: { LocationVal: thevalue, LocationValSet : "1"} ,
    success:function(data){
        console.log(data);
    } 
 });
});

$('#iTransportWhat').blur(function(){
  var thevalue = $(this).val();

 $.ajax({
    url: 'SetInputVal.php',
    type: 'POST',
    data: { TransportWhatVal: thevalue, TransportWhatValSet : "1"} ,
    success:function(data){
        console.log(data);
    } 
 });
});

$('#iRecs').blur(function(){
  var thevalue = $(this).val();

 $.ajax({
    url: 'SetInputVal.php',
    type: 'POST',
    data: { RecsVal: thevalue, RecsValSet : "1"} ,
    success:function(data){
        console.log(data);
    } 
 });
});

//---------------------------------------------------------
//-- Readonly code
//---------------------------------------------------------
// get all readonly inputs

// Function to fire when they're clicked
// We would use the focus handler but there is no focus event for readonly objects
function readOnlyClickHandler () {
    // make it not readonly
    this.removeAttribute('readonly');
}
// Function to run when they're blurred (no longer have a cursor
function readOnlyBlurHandler () {
    // make it readonly again
    this.setAttribute('readonly');
}
function readOnlyKeypressHandler (event) {
    // The user has just pressed a key, but we don't want the text to change
    // so we prevent the default action
    event.preventDefault();
}
// Now put it all together by attaching the functions to the events...

// We have to wrap the whole thing in a onload function.
// This is the simplest way of doing this...
document.addEventListener('load', function () {
    // First loop through the objects

        // add a class so that CSS can style it as readonly
        $('#PickUpPoint').classList.add('readonly');
        // Add the functions to the events
        $('#PickUpPoint').addEventListener('click', readOnlyClickHandler);
        $('#PickUpPoint').addEventListener('blur', readOnlyBlurHandler);
        $('#PickUpPoint').addEventListener('keypress', readOnlyKeypressHandler);

        // add a class so that CSS can style it as readonly
        $('#DropOffPoint').classList.add('readonly');
        // Add the functions to the events
        $('#DropOffPoint').addEventListener('click', readOnlyClickHandler);
        $('#DropOffPoint').addEventListener('blur', readOnlyBlurHandler);
        $('#DropOffPoint').addEventListener('keypress', readOnlyKeypressHandler);

});

function updiPage(){
  var recs = $('#iRecs').val();
  if(recs == 0) {
      recs = 1;
  }
  var numrows = $('#numrows').val();
  if (numrows == 0){
      numrows = 1;
  }
  var max = 1;
  
  //FORMULA ---> @$_SESSION['numpages'] = ceil($_SESSION['numrows']/@$_SESSION['iRecs']);
  
  if(recs == 10){
	if (Math.ceil(numrows/recs) < $("#iPage").val()) $("#iPage").val(1);
        if(Math.ceil(numrows/recs)>0)
            max = Math.ceil(numrows/recs);
    $("#iPage").attr({
   		"min" : 1,
   		"max" : max
    });
  }
  if(recs == 20){
	if (Math.ceil(numrows/recs) < $("#iPage").val()) $("#iPage").val(1);
        if(Math.ceil(numrows/recs)>0)
            max = Math.ceil(numrows/recs);
    $("#iPage").attr({
   		"min" : 1,
   		"max" : max
    });
  }
  if(recs == 50){
	if (Math.ceil(numrows/recs) < $("#iPage").val()) $("#iPage").val(1);
        if(Math.ceil(numrows/recs)>0)
            max = Math.ceil(numrows/recs);
    $("#iPage").attr({
   		"min" : 1,
   		"max" : max
    });
  }
  if(recs == 100){
	if (Math.ceil(numrows/recs) < $("#iPage").val()) $("#iPage").val(1);
        if(Math.ceil(numrows/recs)>0)
            max = Math.ceil(numrows/recs);
    $("#iPage").attr({
   		"min" : 1,
   		"max" : max
    });
  }
  if(recs == 'All'){
    $("#iPage").val(1);
    $("#iPage").attr({
   		"min" : 1,
   		"max" : 1
    });
  }
  $('#submit').trigger('click');
}
		
</script>

<?php
echo "</div></form>";
include("closebody.php");
?>
</html>
