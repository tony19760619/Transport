<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$host     = "localhost";
$username = 'cheap_trans_user'; 
$password = 'Tiago!23';
$database = 'cheapfli_transport_db';
$port = '3306';

$mysqli = new mysqli($host, $username, $password, $database, $port);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
date_default_timezone_set('Africa/Johannesburg');
?>

<?php if(@$dont_include_headers == true){return;} ?>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/resources/demos/style.css" />
<link rel="stylesheet" href="styles.css" />
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZx1KtLqWh-V0-TJYoth0oYXxnzE1tOUU&libraries=places" async defer></script>         
<script src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclusterer/1.0.1/src/markerclusterer.js"></script>
<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js"></script>
<script src="scripts.js"></script>
<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">









