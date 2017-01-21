<?php
    
// function to get an address
function get_lat_long($address){

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
    $json = json_decode(@$json);

    $lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $lat.','.$long;
}

function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $kilometers = $miles * 1.609344;
    return round($kilometers,3);
}

function GetDrivingDistance($lat1,$long1,$lat2,$long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en-UK";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = @$response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = @$response_a['rows'][0]['elements'][0]['duration']['text'];

    if(@$dist != ''){
      return array('Distance' => $dist, 'Time' => $time);
    }else{
      return array('Distance' => getDistanceBetweenPoints($lat1, $long1, $lat2, $long2), 'Time' => 'Contains Flight or Ship Trip');
    }
}

function nl2br2($string) {
  //$string = str_replace(array("\r\n", "\r", "\n"), '<br />', $string); 
  //return htmlspecialchars($string); 
  return $string; 
} 
 
function br2nl2($string) { 
  //$string = str_replace(array('<br>', '<br/>','<br />'), "\r\n", $string); 
  //return htmlspecialchars_decode($string); 
  return $string; 
} 

function ColToLable($str)
{
    return preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]|[0-9]{1,}/', ' $0', $str).':';
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createThumbnail($filename, $p_thumbnail) {
    require 'config.php';
    if(preg_match('/[.](jpg)$/', strtolower($filename))) {
        $im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if (preg_match('/[.](gif)$/', strtolower($filename))) {
        $im = imagecreatefromgif($path_to_image_directory . $filename);
    } else if (preg_match('/[.](png)$/', strtolower($filename))) {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    }
     
    $ox = imagesx($im);
    $oy = imagesy($im);
    
	//------------------------------------------------------------------------------------
	//-- Check if width or height is biggest then only resize bigger images than thumnail
	//------------------------------------------------------------------------------------
	if($ox > $oy){
	  if($final_width_of_image >= $ox){
	    $nx = $ox;
	    $ny = $oy;
	  }else{
        $nx = $final_width_of_image;
        $ny = floor($oy * ($final_width_of_image / $ox));
      } 
	}else{
	  if($final_height_of_image >= $oy){
	    $nx = $ox;
	    $ny = $oy;
	  }else{
        $nx = floor($ox * ($final_height_of_image / $oy));
        $ny = $final_height_of_image;
      } 	
	}
	
	$nm = imagecreatetruecolor($nx, $ny);
     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
     
    if(!file_exists($path_to_thumbs_directory)) {
      if(!mkdir($path_to_thumbs_directory)) {
           die("There was a problem. Please try again!");
      } 
       }
 
    imagejpeg($nm, $p_thumbnail);
    $picturemsg = '<img src="' . $p_thumbnail . '" alt="image" />';
    $picturemsg .= '<br />Congratulations. Your file has been successfully uploaded, and a thumbnail has been created.';
}
?>
<script>
var globalnoprompt = true;

function setsort(pCol,pOrd,pLoc,pDate,pTransportWhat){
    topage = window.location.href;
    if ((topage.indexOf('#') > 1)&&(topage.indexOf('Sorting') < 1))topage = topage + 'Sorting';
    else if (topage.indexOf('#Sorting') < 1)topage = topage + '#Sorting';
    post(topage,{Sort : pCol, Order : pOrd, iLoction : pLoc, iDate : pDate, iTransportWhat : pTransportWhat});
    return false;
}  
</script>