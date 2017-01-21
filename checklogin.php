<?php
session_start();
@$errmsg ='';
@$msg='';
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(@$_REQUEST['logout'] == true){
  $_SESSION['Username'] = '';
}

if($checklogin==true){
  if((@$_SESSION['Username'] === '')||(@$_SESSION['Username'] == '')||(@$_SESSION['Username'] == NULL)){
    header('Location: Login.php');  
  }
}
//-------------------------------------------------------------------
//-- Check if page is changing
//-------------------------------------------------------------------
  $_SESSION['CallingPage'] = basename(@$_SERVER['HTTP_REFERER']);    
  $_SESSION['CurrentPage'] = basename(@$_SERVER['PHP_SELF']);    
  
  if(@$_SESSION['CallingPage'] != @$_SESSION['CurrentPage']){
    @$_SESSION['ReturnPage'] = @$_SESSION['CallingPage'];
  }else if(@$_SESSION['ReturnPage'] == ''){
    @$_SESSION['ReturnPage'] = 'OfferAShipmentList.php';  
  }

?>