<?php
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
<header >
<h1>Alba Cruises</h1>
</header>
<nav>
	<div id="menubutton">Menu</div>
	<ul id="menu">
		<li><a href="index.php">Home</a></li>
		<?php if($currentuser['userlevel']==1) { ?>
		<li><a href="admin.php">Admin</a></li>
			<?php } ?>
		<?php if($currentuser['userlevel']==2) { ?>
		<li><a href="user.php">User Panel</a></li>
			<?php } ?>
		<li><a href="php/logout.php">Log Out</a></li>
	</ul>
</nav>
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
		
		//displays users information and allow it to be edited 
		 
		echo"<p>Order ID : ",$Booking_ID,'</br>';
		echo"<p>Total Price : £",$Total_Price;
		echo"<p>Date and Time of Order : ",$Date;
		echo"<p>Sailing ID : ",$SailingID;
		echo"<p>Destination : ",$Destination;
		echo"<p>Arrival Time : ",$Arrival_time;
		echo"<p>Departure Time : ",$Leaving_Time;
		echo"<p>Leaving From : ",$Leaving_From;
		echo"<p>Price for Trip(Per Adult) : ",$Price;   
		echo"<p>Number of Adults : ",$Adults;  
		echo"<p>Names of Adult/s : ",$Adults_Name;
		echo"<p>Number of Children under 2 (Will be empty if 0) : ",$Children_2_Under;
		echo"<p>Number of Children between 3 - 10 (Will be empty if 0) : ",$Children_3_10;
		echo"<p>Number of Children between 11 - 16 (Will be empty if 0) : ",$Children_11_16;
		echo"<p>Names of Children (Will be empty if 0) : ",$Children_2_under_Name;
		echo"<p>Names of Children (Will be empty if 0) : ",$Children_3_10_Name;
		echo"<p>Names of Children (Will be empty if 0) : ",$Children_11_16_Name;
		echo"<p>Has the trip been cancelled? : ",$Cancelled;
		
		
	}
	$db->close();
	

?>

	<?php if($currentuser['userlevel']==2) { ?>
		<p><a href="user.php"class="btn btn-success" role="button">Go to User Page</a></p>
	<?php } ?>
	
	<?php if($currentuser['userlevel']==1) { ?>
		<p><a href="admin.php"class="btn btn-success" role="button">Go to Admin Page</a></p>
	<?php } ?>
	</section>
	</div>
</body>
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script>
<!-- run the script and the prepared functions -->
var userlevel=<?php echo $currentuser['userlevel']; ?>;
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		prepareTouch();
		prepareMenu();
	}
}

</script>

</html>
