<?php
//setup page for selecting the user you want to change 
session_start();
include("php/functions.php");
$username=checkUser($_SESSION['userid'],session_id(),2);
$currentuser=getUserLevel();
	ini_set('display_startup_errors', true);
    error_reporting(E_ALL);
    ini_set('display_errors', true);
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
<section  class  = "main" id="main">
<div class="Main_Info">
<body>
<h1>Choose order you wish to edit</h1>
  <h1>Order Search</h1>
  <form action="Order_To_Update.php" method="post">
  <p>Choose Order:</p>
  <select name="Booking_ID">
	<?php
	$db = createConnection();
	$sql = "select SailingID,Booking_ID,userid,Children_2_under,Children_3_10,Children_11_16,Children_2_under_Name,Children_3_10_Name,Children_11_16_Name,Adults_Name,Adults,Total_Price,Cancelled,Date from Booking where userid = ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param("i",$currentuser['userid']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($SailingID,$Booking_ID,$userid,$Children_2_under,$Children_3_10,$Children_11_16,$Children_2_under_Name,$Children_3_10_Name,$Children_11_16_Name,$Adults_Name,$Adults,$Total_Price,$Cancelled,$Date);
	
	while($stmt->fetch()) {
		//shows all users that are being selected
		echo "<option value = ",$Booking_ID,">","Booking ID : ",$Booking_ID," Date of Order :  ",$Date," Price : £",$Total_Price," ",$SailingID,"</option>";
		echo "</br>";
	}
	$stmt->close();
	$db->close();
?> 
	<input type="hidden" name="SailingID" value="<?php echo $SailingID;?>">
	</select>
    </br>
	</br>
    <input class="btn btn-primary" type="submit" value="Search"><br>
	</br>
  </form>
</body>
<p>Return to the <a href="admin.php">Admin</a> page.</p>"
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script>
var userlevel=<?php echo $currentuser['userlevel']; ?>;
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		var addarticle=document.getElementById("addarticle");
		prepareTouch();
		prepareMenu();
	}
}

</html>
