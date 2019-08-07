<?php
//setup page for selecting the user you want to change 
session_start();
include("php/functions.php");
$username=checkUser($_SESSION['userid'],session_id(),2);
$currentuser=getUserLevel();
$SailingID=$_POST['SailingID'];
$userid=$_SESSION['userid'];
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
	$sql = "select Booking_ID,SailingID,userid,Children_2_under, Children_3_10, Children_11_16,Children_2_under_Name,Children_3_10_Name,Children_11_16_Name,Adults_Name, Adults, Total_Price, Cancelled,Date from Booking where Booking_ID = ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param("i",$Booking_ID);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($Booking_ID,$SailingID,$userid,$Children_2_under, $Children_3_10, $Children_11_16,$Children_2_under_Name,$Children_3_10_Name,$Children_11_16_Name,$Adults_Name,$Adults,$Total_Price,$Cancelled,$Date);
		while($stmt->fetch()) {
		}
			$stmt->close();
	
	$sql = "select userid,username,firstname,surname,dob,emailadd from WebAppLogin WHERE userid = ?";
	$stmt1=$db->prepare($sql);
	$stmt1->bind_param("i",$userid);
	$stmt1->execute();
	$stmt1->store_result();
	$stmt1->bind_result($userid,$username,$firstname,$surname,$dob,$emailadd);	
	
		while($stmt1->fetch()) {
		}
		
		
	$Total_Price = "5";
	$Cancelled = "YES";
	$db = createConnection();
	$sql = "update Booking set SailingID = ?, Booking_ID = ?,userid = ?,Children_2_under = ?, Children_3_10 = ?, Children_11_16 = ?, Children_2_under_Name = ?, Children_3_10_Name = ?, Children_11_16_Name = ?,Adults_Name = ?, Adults = ?, Total_Price = ?,Cancelled = ? where Booking_ID  = ?;"; 
     $stmt2 = $db->prepare($sql);
    $stmt2->bind_param("iiiiiissssisss",$SailingID,$Booking_ID,$userid, $Children_2_under, $Children_3_10, $Children_11_16, $Children_2_under_Name, $Children_3_10_Name, $Children_11_16_Name, $Adults_Name,$Adults,$Total_Price,$Cancelled,$Booking_ID);
	$stmt2->execute();
            if ($stmt2)
               echo  "<h1>Your order has been cancelled Please return to the User Page!<br><a href='user.php'>click here to return to the User panel</a></h1>";
            else
               echo "<p>did not work Please try again. If still not working contact us</p>";
	$stmt2->close();
	$db->close();

?>
</body>
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
</script>
</html>