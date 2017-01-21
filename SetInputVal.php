<?php
  @session_start();
  if(@$_REQUEST['DatePickerValSet'] !='')@$_SESSION['iDate'] = @$_REQUEST['DatePickerVal'];
  if(@$_REQUEST['TransportWhatValSet'] !='')@$_SESSION['iTransportWhat'] = @$_REQUEST['TransportWhatVal'];
  if(@$_REQUEST['LocationValSet'] !='')@$_SESSION['iLocation'] = @$_REQUEST['LocationVal'];
  if(@$_REQUEST['PageValSet'] !='')@$_SESSION['iPage'] = @$_REQUEST['PageVal'];
  if(@$_REQUEST['RecsValSet'] !='')@$_SESSION['iRecs'] = @$_REQUEST['RecsVal'];
  if(@$_REQUEST['DelThumbnail']==true){
  	unlink(@$_REQUEST['oldfilename']);
  }
?>