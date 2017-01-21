//** CheckField and screen loading funtions form laserliposa ************
//-- Google script for tracking ------------
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11818535-1']);
  _gaq.push(['_setDomainName', 'laserliposa.co.za']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
//-----------------------------------------  
function CheckField(field,alerttxt) {
  with (field) {
    if (value==null||value==""){
			alert(alerttxt);
			return false;
		} else {
			return true;
		}
  }
}
function CheckEmailField(field,alerttxt) {
  with (field) {
    if (value==null||value==""||value.indexOf("@")==-1){
			alert(alerttxt);
			return false;
		} else {
			return true;
		}
  }
}


function CheckForm(thisform) {
	with (thisform) {
	  if (CheckEmailField(Email,"Please enter your email address")==false){
			Email.focus();
			return false;
		}
	  if (CheckField(Contact1,"Please enter in a contact number.")==false){
			Contact1.focus();
			return false;
		}
	  if (CheckField(Message1,"Please enter in a message.")==false){
			Message1.focus();
			return false;
		}
	}
}

function CheckForm2(thisform) {
	with (thisform) {
	  if (CheckField(Name1,"Please enter in your name.")==false){
			Name1.focus();
			return false;
		}		
	  if (CheckEmailField(Email,"Please enter your email address")==false){
			Email.focus();
			return false;
		}
	  if (CheckField(Contact1,"Please enter in a contact number.")==false){
			Contact1.focus();
			return false;
		}
	  if (CheckField(Message1,"Please enter in a message.")==false){
			Message1.focus();
			return false;
		}
	  if (CheckField(City1,"Please select a city.")==false){
			City1.focus();
			return false;
		}
	  if (CheckField(Suburb1,"Please enter in a suburb.")==false){
			Suburb1.focus();
			return false;
		} 
	  if (CheckField(captcha,"Please enter in the security code on the screen.")==false){
			captcha.focus();
			return false;
		}
	}
}

var popupWindow = null;
function centeredPopup(url,winName){
var w = 500;
var h = 500;
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars=yes,resizable=no,toolbar=no,menubar=no,location=no,directories=no,status=no'
popupWindow = window.open(url,winName,settings)
}
//*****************************************************

function centeredPopup(page) {

            var left = (screen.width - 880)/2,
                top = (screen.height - 400)/2,
                settings = 'height=400,width=880,top=' + top + ',left=' + left;

            window.open(page,'popUp',settings); 
        } 

function getdetailsclick(thisrowid, type, recowner, loggedin){ 
  post("OfferAShipmentView.php",{id:thisrowid,type:type,recowner:recowner,loggedin:loggedin},"POST");
}

function removeNewLines(s, replace) 
{
    return s.replace(/[ \n\r]/g, replace);
} 
function showNewLines(str){
    return str.replace(/<br\s*\/?>/mg,"\n");
}
function getDirections(){
  var pup = $("#PickUpPoint").val();
  var dop = $("#DropOffPoint").val();
  pup = removeNewLines(pup,"+");
  dop = removeNewLines(dop,"+");
  post('http://www.google.com/maps/dir/'+pup+'/'+dop, {}, 'GET',true);
  return false;
}

function clearmessages(){
    $('.messinput').remove();
}

function BidButtonClick(id,type,recowner,loggedin){

    var Bid = $('#YourBid').val();
    var BidButton = $('#BidButton').val();
    post('OfferAShipmentView.php',{id: id, type: type, recowner: recowner, loggedin: loggedin, Bid: Bid, BidButton: BidButton},'POST');
}
     
function SetWatchClick(id,type,recowner,loggedin,Watch){
    if (Watch == 0)Watch = 1;
    else Watch = 0;
    post('OfferAShipmentView.php',{id: id, type: type, recowner: recowner, loggedin: loggedin, Watch: Watch, setwatch: 'setwatch' },'POST');
}
     
function backtolistclick(page){
   post(page,{id:0});
}

function logintocontact(){
    alert("Login or Register to our site to be able to contact people!");
    return false;
}   

function checkUsername(){
    var Username = $('#Username').val();
    var illegalChars = /\W/; // allow letters, numbers, and underscores
    
    if (illegalChars.test(Username)) {
      alert("Usernames can only contain letters and numbers!");
      Username = Username.substr(0, Username.length - 1);
      $('#Username').val(Username);
      return false;
    }
    return true;
}

function checkmypassword(){            
    
    var ret;
    
    //-----------------------------------------------------------
    //-- Do Password checks
    //-----------------------------------------------------------
    var PasswordPic = document.getElementById("PasswordPic");
    var PasswordMsg = document.getElementById("PasswordMsg");
    var Password = $('#Password').val();
    
    if (Password.search(/[a-z]/) == -1) {
        PasswordMsg.innerHTML = "Password must contain lower case characters";
        PasswordPic.src = "images/cross.png";
        ret = false;
    }else{
        PasswordPic.src = "images/maybee.png"; 
        ret = true;
    }

    if (ret == true){
        if (Password.search(/[A-Z]/) == -1) {
            PasswordMsg.innerHTML = "Password must contain capitals";
            PasswordPic.src = "images/cross.png";
            ret = false;
        }else{
            PasswordPic.src = "images/maybee.png"; 
            ret = true;
        }
    }
    
    if (ret == true){
        if (Password.search(/\d/) == -1) {
            PasswordMsg.innerHTML = "Password must contain numbers";
            PasswordPic.src = "images/cross.png"; 
            ret = false;
        }else{
            PasswordPic.src = "images/maybee.png"; 
            ret = true;

        }
    }
    
    if (Password.length > 30) {
        PasswordMsg.innerHTML = "Password can not be longer than 30 characters";
        PasswordPic.src = "images/cross.png"; 
        ret = false;
    } 

    if (Password.length < 6) { 
        PasswordMsg.innerHTML = "Password must be longer than 6 characters";
        PasswordPic.src = "images/cross.png"; 
        ret = false;
    } 
        
    if(ret == true){
        PasswordMsg.innerHTML = "Password passes necessary checks";
        PasswordPic.src = "images/check.png"; 
    }
    
    //-----------------------------------------------------------
    //-- Do Password Double checks
    //-----------------------------------------------------------
    var PasswordCheckPic = document.getElementById("PasswordCheckPic");
    var PasswordCheck = $('#PasswordCheck').val();
    var PasswordCheckMsg = document.getElementById("PasswordCheckMsg");
    if(Password != PasswordCheck){
        PasswordCheckMsg.innerHTML = "Password Double check does not match";
        PasswordCheckPic.src = "images/cross.png";
        ret = false;    
    }
    if(Password == PasswordCheck){
        PasswordCheckMsg.innerHTML = "Password and Double check password match";
        PasswordCheckPic.src = "images/check.png";
    }
    if((Password == PasswordCheck) &&(ret == true)){
         ret = true;
    }
        
    return ret;
}

function checkregisterform(){            
    var Val;
    //-----------------------------------------------------------
    //-- Do Registration form checks
    //-----------------------------------------------------------
    Val = $('#Username').val();
    if ((Val == '') || (Val === '')) {
        alert('Please enter a Username');
        return false;
    }
    Val = $('#Email').val();
    if ((Val == '') || (Val === '')) {
        alert('Please enter a Email');
        return false;
    }
    if (Val.indexOf('@') < 1) {
        alert('Please enter a valid Email');
        return false;
    }
    Val = $('#UserType').val();
    if ((Val == '') || (Val === '')) {
        alert('Please select a User Type');
        return false;
    }
    Val = $('#Address').val().trim();
    if ((Val == '') || (Val === '')) {
        alert('Please enter a Address');
        return false;
    }
    Val = $('#FirstName').val();
    if ((Val == '') || (Val === '')) {
        alert('Please enter your First Name');
        return false;
    }
    Val = $('#Surname').val();
    if ((Val == '') || (Val === '')) {
        alert('Please enter your Surname');
        return false;
    }
    Val = $('#DateOfBirth').val();
    if ((Val == '') || (Val === '')) {
        alert('Please enter your Date Of Birth');
        return false;
    }
    Val = $('#PersonalIdentificationDocumentType').val();
    if ((Val == '') || (Val === '')) {
        alert('Please select a Personal Indentification Document Type');
        return false;
    }
    Val = $('#Country').val();
    if ((Val == '') || (Val === '')) {
        alert('Please select the Country you from');
        return false;
    }

    return true;
}

$(function() {
    //$(".datagrid").width($(".datatable").width());
    // Loop through each element with the class name of slidePanel
    var dg = document.querySelectorAll('div.datagrid');
    var dt = document.querySelectorAll('table.datatable');

    // Iterate through each element in the array
    for (i = 0; i < dg.length; i++) {
        dg[i].setAttribute("style","width:300px;text-align:center");
        alert(dg[i].style.height);
        //dg[i].style.height = dt[i].style.height; 
       //g[i].width(dt[i].width());
        
        
     //var allG=document.getElementsByClassName('.datagrid'), allGR=[], i=0, a;
     //var allT=document.getElementsByClassName('.datatable'), allTB=[], j=0, b;
     //while(a=allGR[i++]) {
     //       a.width(b.width());
        }
       
})

var _isDirty = false;

(function($) {

  $.fn.menumaker = function(options) {
      
      var cssmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
        cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        cssmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          cssmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else cssmenu.addClass('dropdown');

        if (settings.sticky === true) cssmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {
            cssmenu.find('ul').show();
          }

          if ($(window).width() <= 768) {
            cssmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
$(document).ready(function(){

$("#cssmenu").menumaker({
   title: "Menu",
   format: "multitoggle"
});


});
})(jQuery);
