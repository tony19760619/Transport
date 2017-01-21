<?php
session_start();

$d = $_REQUEST['bottomLeftLng'];
$c = $_REQUEST['bottomLeftLat'];
$b = $_REQUEST['topRightLng'];
$a = $_REQUEST['topRightLat'];

//require("phpsqlajax_dbinfo.php");
$dont_include_headers = true;
require('db.php');

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
$xmlStr=str_replace("\r\n","&lt;br/&gt;",$xmlStr); 
return $xmlStr; 
} 
// Select all the rows in the markers table
$sql = "SELECT * FROM OfferAShipment where ((AwardBidTo = '') OR (AwardBidTo is NULL)) and ".
"((CASE WHEN CAST($a AS DECIMAL(10,6)) < CAST($c AS DECIMAL(10,6)) ".
        "THEN PickUpLatitude BETWEEN CAST($a AS DECIMAL(10,6)) AND CAST($c AS DECIMAL(10,6)) ".
        "ELSE PickUpLatitude BETWEEN CAST($c AS DECIMAL(10,6)) AND CAST($a AS DECIMAL(10,6)) ".
"END) ". 
"AND ".
"(CASE WHEN CAST($b AS DECIMAL(10,6)) < CAST($d AS DECIMAL(10,6)) ".
        "THEN PickUpLongitude BETWEEN CAST($b AS DECIMAL(10,6)) AND CAST($d AS DECIMAL(10,6)) ".
        "ELSE PickUpLongitude BETWEEN CAST($d AS DECIMAL(10,6)) AND CAST($b AS DECIMAL(10,6)) ".
"END)) OR ".
"((CASE WHEN CAST($a AS DECIMAL(10,6)) < CAST($c AS DECIMAL(10,6)) ".
        "THEN DropOffLatitude BETWEEN CAST($a AS DECIMAL(10,6)) AND CAST($c AS DECIMAL(10,6)) ".
        "ELSE DropOffLatitude BETWEEN CAST($c AS DECIMAL(10,6)) AND CAST($a AS DECIMAL(10,6)) ".
"END) ". 
"AND ".
"(CASE WHEN CAST($b AS DECIMAL(10,6)) < CAST($d AS DECIMAL(10,6)) ".
        "THEN DropOffLongitude BETWEEN CAST($b AS DECIMAL(10,6)) AND CAST($d AS DECIMAL(10,6)) ".
        "ELSE DropOffLongitude BETWEEN CAST($d AS DECIMAL(10,6)) AND CAST($b AS DECIMAL(10,6)) ".
"END)) ";

//echo $sql;

$result = $mysqli->query($sql);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");
// Start XML file, echo parent node
echo '<markers>';
// Iterate through the rows, printing XML nodes for each
while ($row = $result->fetch_assoc()){
  // ADD PickUpPoint TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'ID="' . parseToXML($row['id']) . '" ';
  echo 'recowner="' . parseToXML($row['Username']) . '" ';
  echo 'loggedin="' . parseToXML(@$_SESSION['Username']) . '" ';
  echo 'PickUpPoint="' . parseToXML($row['PickUpPoint']) . '" ';
  echo 'DropOffPoint="' . parseToXML($row['DropOffPoint']) . '" ';
  echo 'Distance="' . parseToXML($row['Distance']) . '" ';
  echo 'Type="PickUp" ';
  echo 'Lat="' . parseToXML($row['PickUpLatitude']) . '" ';
  echo 'Lng="' . parseToXML($row['PickUpLongitude']) . '" ';
  echo '/>';

  // ADD DropOffPoint TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'ID="' . parseToXML($row['id']) . '" ';
  echo 'recowner="' . parseToXML($row['Username']) . '" ';
  echo 'loggedin="' . parseToXML(@$_SESSION['Username']) . '" ';
  echo 'PickUpPoint="' . parseToXML($row['PickUpPoint']) . '" ';
  echo 'DropOffPoint="' . parseToXML($row['DropOffPoint']) . '" ';
  echo 'Distance="' . parseToXML($row['Distance']) . '" ';
  echo 'Type="DropOff" ';
  echo 'Lat="' . parseToXML($row['DropOffLatitude']) . '" ';
  echo 'Lng="' . parseToXML($row['DropOffLongitude']) . '" ';
  echo '/>';
}
// End XML file
echo '</markers>';
?>