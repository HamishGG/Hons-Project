<?php
//setup page for selecting the user you want to change 
session_start();
include("php/functions.php");
$username=checkUser($_SESSION['userid'],session_id(),2);
$currentuser=getUserLevel();
?>
<!doctype html>
<html lang="en-gb" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!--
Referenced from https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_button_elements&stacked=h 
-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/ieold.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 840px) and (max-width:999px)" href="css/medium.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 1000px)" href="css/wide.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-width: 640px) and (max-width:839px)" href="css/medium_narrow.css" />
<link rel="stylesheet" type="text/css" media="screen and (max-width:639px)" href="css/narrow.css" />
<link rel="stylesheet" type="text/css" media="print" href="css/print.css" />
	
	<!--[if (lte IE 8)&!(IEMobile)]>
		<script src="js/iefix.js"></script>

		<style>
			header, section, nav, footer {display:block;}
		</style>

<![endif]-->

	<title>Alba Cruises</title>
</head>
<body>
<header >
<h1>Alba Cruises</h1>
</header>
<nav>
	<div id="menubutton">Menu</div>
	<ul id="menu">
		<li><a href="index.php">Home</a></li>
		<?php if($currentuser['userlevel']>=1) { ?>
		<li><a href="Bookticket.php">Book Ticket</a></li>
			<?php } ?>	
		<li><a href="Trips.php">Our Trips</a></li>
		<?php if($currentuser['userlevel']==0) { ?>
		<li><a href="login.php">Login</a></li>
			<?php } ?>
		<?php if($currentuser['userlevel']==0) { ?>
		<li><a href="register.html">Register</a></li>
			<?php } ?>			
		<?php if($currentuser['userlevel']>=1) { ?>
		<li><a href="php/logout.php">Log Out</a></li>
			<?php } ?>
		<?php if($currentuser['userlevel']==1) { ?>
		<li><a href="admin.php">Admin</a></li>
			<?php } ?>
		<?php if($currentuser['userlevel']==2) { ?>
		<li><a href="user.php">User Panel</a></li>
			<?php } ?>

	</ul>
</nav>
<button onclick="topFunction()" id="myBtn" title="Go To Top">Top</button>
<body>
<section  class  = "main" id="main">
<div class="Main_Info">
<h1>Order Information</h1>
<?php

	$Booking_ID=$_POST['Booking_ID'];
	$db = createConnection();
	$sql = "select Booking_ID,SailingID,Children_2_Under, Children_3_10, Children_11_16,Children_2_under_Name,Children_3_10_Name,Children_11_16_Name,Adults_Name, Adults, Total_Price, Cancelled,Date from Booking where Booking_ID = ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param("i",$Booking_ID);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($Booking_ID,$SailingID,$Children_2_Under, $Children_3_10, $Children_11_16,$Children_2_under_Name,$Children_3_10_Name,$Children_11_16_Name,$Adults_Name,$Adults,$Total_Price,$Cancelled,$Date);
		while($stmt->fetch()) {
		}
		
	$sql = "select SailingID,Destination,Arrival_time,Leaving_Time,Leaving_From,Day,Price from Sailing where SailingID = ?";
	$stmt1 = $db->prepare($sql);
	$stmt1->bind_param("i",$SailingID);
	$stmt1->execute();
	$stmt1->store_result();
	$stmt1->bind_result($SailingID,$Destination,$Arrival_time, $Leaving_Time, $Leaving_From,$Day,$Price);
	while($stmt1->fetch()) {
		//displays the information grabbed
		echo "<form action='Order_Update.php' method='post'>
	<p>
	<p>SailingID : <input type='text' name='SailingID' id='SailingID' value = '$SailingID' readonly></p>
	<p>Destination : <input type='text' name='Destination' id='Destination'  value = '$Destination'readonly></p>
	<p>Arrival Time : <input type='text' name='Arrival_time' id='Arrival_time'  value = '$Arrival_time'readonly></p>
	<p>Leaving Time : <input type='text' name='Leaving_Time' id='Leaving_Time'  value = '$Leaving_Time'readonly></p>
	<p>Leaving From : <input type='text' name='Leaving_From' id='Leaving_From'  value = '$Leaving_From'readonly></p>
	<p>Day : <input type='text' name='Day' id='Day'  value = '$Day'readonly></p>
	<p>Price Per Trip Per Adult : <input type='text' name='Price' id='Price'  value = '$Price'readonly></p>
	<p>Adults : <input type='text' name='Adults' id='Adults'  value = '$Adults'readonly></p>
	<p>Adults Names : <input type='text' name='Adults_Name' id='Adults_Name'  value = '$Adults_Name'></p>
	<p>Children Between Age 2 And Under : <input type='text' name='Children_2_Under' id='Children_2_Under'  value = '$Children_2_Under'></p>
	<p>Children Between Age 2 And Under Name : (Will be empty if 0) : <input type='text' name='Children_2_under_Name' id='Children_2_under_Name'  value = '$Children_2_under_Name'></p>
	<p>Children Between Age 3 And 10 : <input type='text' name='Children_3_10' id='Children_3_10'  value = '$Children_3_10'></p>
	<p>Children Between Age 3 And 10 Name : (Will be empty if 0) : <input type='text' name='Children_3_10_Name' id='Children_3_10_Name'  value = '$Children_3_10_Name'></p>
	<p>Children Between Age 11 And 16 : <input type='text' name='Children_11_16' id='Children_11_16'  value = '$Children_11_16'></p>
	<p>Children Between Age 11 And 16 Name : (Will be empty if 0) : <input type='text' name='Children_11_16_Name' id='Children_11_16_Name'  value = '$Children_11_16_Name'></p>
	<p>Total_Price : <input type='text' name='Total_Price' id='Total_Price'  value = '$Total_Price'readonly></p>
	<p>Cancelled : <input type='text' name='Cancelled' id='Cancelled'  value = '$Cancelled'readonly></p>
	<p>Date : <input type='text' name='Date' id='Date' value = '$Date'readonly></p>
	<input type='hidden' name='Booking_ID' value='$Booking_ID'>
	<input type='submit' class='btn btn-success' value='Update'>";
	}

	$stmt->close();
	$db->close();
	

?>
</body>
<p>Return to the <a href="user.php">User</a> page.</p>
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script>
var userlevel=<?php echo $currentuser['userlevel']; ?>;
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		prepareTouch();
		prepareMenu();
	}
}
var Children_2_Under = document.getElementById('Children_2_Under').value;
var Children_3_10 = document.getElementById('Children_3_10').value;
var Children_11_16 = document.getElementById('Children_11_16').value;

if(Children_2_Under.substring(0, 1) == '0'){
    //display a DIV
    document.getElementById("Children_2_Under").readOnly = true;
    document.getElementById("Children_2_under_Name").readOnly = true;
}else{
        document.getElementById("Children_2_Under").readOnly = false;
		document.getElementById("Children_2_under_Name").readOnly = true;
}

if(Children_3_10.substring(0, 1) == '0'){
    //display a DIV
    document.getElementById("Children_3_10").readOnly = true;
    document.getElementById("Children_3_10_Name").readOnly = true;
}else{
        document.getElementById("Children_3_10").readOnly = false;
		document.getElementById("Children_3_10_Name").readOnly = true;
}

if(Children_11_16.substring(0, 1) == '0'){
    //display a DIV
    document.getElementById("Children_11_16").readOnly = true;
    document.getElementById("Children_11_16_Name").readOnly = true;
}else{
        document.getElementById("Children_11_16").readOnly = false;
		document.getElementById("Children_11_16_Name").readOnly = true;
}
</script>

</html>
