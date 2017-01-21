	<body>
            
<div id='cssmenu'>
<ul>
   <li><a href='index.php'>Home</a></li>
   <li><a href='#'>Shipments</a>
      <ul>
          <li><a href='OfferAShipmentList.php'>List Of All Shipments</a></li>
          <li><a href='OfferAShipmentUserList.php'>Manage My Shipments</a></li>
      </ul>
   </li>
<?php
  if(@$_SESSION['Username'] != ''){
?>
                <li><a onclick="userlogout()" title="Logout"><font style="color: aqua">Logout <?php echo $_SESSION['Username']; ?></font></a></li>
<?php
  }else{
?>
                <li><a href="Login.php" title="Login">Login Or Register</a></li>
<?php
  }
?>
   <li><a href='help.php'>Help</a></li>
</ul>
</div> 
<br/>
        <center><h1><?php echo $PageTitle; ?></h1></center>
    	<script>
            //-------------------------------------------------------
			//-- Post function to post webpage with buttons and links
			//-------------------------------------------------------			
			function post(path, params, method, newwindow) {
				method = method || "post"; // Set method to post by default if not specified.
			
				// The rest of this code assumes you are not using a library.
				// It can be made less wordy if you use one.
				var form = document.createElement("form");
				form.setAttribute("method", method);
				form.setAttribute("action", path);
                                if(newwindow)form.setAttribute("target", "_blank");
                                
			
				for(var key in params) {
					if(params.hasOwnProperty(key)) {
						var hiddenField = document.createElement("input");
						hiddenField.setAttribute("type", "hidden");
						hiddenField.setAttribute("name", key);
						hiddenField.setAttribute("value", params[key]);
			
						form.appendChild(hiddenField);
					 }
				}
			
				document.body.appendChild(form);
				form.submit();
			}


                        //-------------------------------------------------------
			//-- User logout function used in this file
			//-------------------------------------------------------			
			function userlogout(){
			   post("Login.php",{logout:true} ); 
			}
			
			
		</script>

<!--- GOOGLE ADD TO EVERY PAGE --->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72901157-1', 'auto');
  ga('send', 'pageview');

</script>



