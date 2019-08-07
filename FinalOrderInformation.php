<?php
session_start();
include("php/functions.php");
$username=checkUser($_SESSION['userid'],session_id(),2);
$currentuser=getUserLevel();
$SailingID=$_POST['SailingID'];
$userid=$_SESSION['userid'];	

$Adult=$_POST['Adult'];
$Children_2_under=$_POST['Children_2_under'];
$Children_3_10=$_POST['Children_3_10'];
$Children_11_16=$_POST['Children_11_16'];



$Adult_Name1=$_POST['Adult_Name1'];
$Adult_Name2=$_POST['Adult_Name2'];
$Adult_Name3=$_POST['Adult_Name3'];
$Adult_Name4=$_POST['Adult_Name4'];
$Adult_Name5=$_POST['Adult_Name5'];

$Children_2_Under_Name1=$_POST['Children_2_Under_Name1'];
$Children_2_Under_Name2=$_POST['Children_2_Under_Name2'];
$Children_2_Under_Name3=$_POST['Children_2_Under_Name3'];
$Children_2_Under_Name4=$_POST['Children_2_Under_Name4'];
$Children_2_Under_Name5=$_POST['Children_2_Under_Name5'];

$Children_3_10_Name1=$_POST['Children_3_10_Name1'];
$Children_3_10_Name2=$_POST['Children_3_10_Name2'];
$Children_3_10_Name3=$_POST['Children_3_10_Name3'];
$Children_3_10_Name4=$_POST['Children_3_10_Name4'];
$Children_3_10_Name5=$_POST['Children_3_10_Name5'];

$Children_11_16_Name1=$_POST['Children_11_16_Name1'];
$Children_11_16_Name2=$_POST['Children_11_16_Name2'];
$Children_11_16_Name3=$_POST['Children_11_16_Name3'];
$Children_11_16_Name4=$_POST['Children_11_16_Name4'];
$Children_11_16_Name5=$_POST['Children_11_16_Name5'];

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
<div class = "print" id="print">
	<title>Alba Cruises</title>
	</head>
<header >
<h1>Alba Cruises</h1>
</header>
</div>
<nav>
	<div id="menubutton">Menu</div>
	<ul id="menu">
		<li><a href="index.php">Home</a></li>
		<li><a href="Bookticket.php">Book Ticket</a></li>
		<li><a href="Trips.html">Our Trips</a></li>
		
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
<body>
<button onclick="topFunction()" id="myBtn" title="Go To Top">Top</button>

<section  class  = "main" id="main">
	<div class="Main_Info" id="print">
		<div class = "print" id="print">
		<br>
	<h3>Here is the trip you have selected:</h3>
	<?php
	$db = createConnection();
	$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE SailingID = ?";
	$stmt=$db->prepare($sql);
	$stmt->bind_param("i",$SailingID);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
					echo "Destination : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " <br> Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();
			
			
	$db = createConnection();
	$sql = "select userid,username,firstname,surname,dob,emailadd from WebAppLogin WHERE userid = ?";
	$stmt=$db->prepare($sql);
	$stmt->bind_param("i",$userid);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($userid,$username,$firstname,$surname,$dob,$emailadd);		
	
				while($stmt->fetch()) {
					echo "<h3>Your Information :</h3> Firstname :  ", $firstname, " <br> Surname: ",$surname," <br> Date-Of-Birth: ",$dob," <br> EmailAddress: ",$emailadd,"</input>";
				}		
			$stmt->close();
	
	$Full_Adult_String = $Adult_Name1."  ";
	$Full_Adult_String .= $Adult_Name2."  ".$Adult_Name3."  ".$Adult_Name4."  ".$Adult_Name5." ";
	
	$Full_Children_2_Under_Name_String = $Children_2_Under_Name1."  ";
	$Full_Children_2_Under_Name_String .= $Children_2_Under_Name2."  ".$Children_2_Under_Name3."  ".$Children_2_Under_Name4."  ".$Children_2_Under_Name5." ";

	$Full_Children_3_10_Name_String = $Children_3_10_Name1."  ";
	$Full_Children_3_10_Name_String .= $Children_3_10_Name2."  ".$Children_3_10_Name3."  ".$Children_3_10_Name4."  ".$Children_3_10_Name5." ";
	
	$Full_Children_11_16_Name_String = $Children_11_16_Name1."  ";
	$Full_Children_11_16_Name_String .= $Children_11_16_Name2."  ".$Children_11_16_Name3."  ".$Children_11_16_Name4."  ".$Children_11_16_Name5." ";
	
					echo "<h3>Your Extra passengers : </h3>";
					echo "Adults : ", $Full_Adult_String, "</br>";
					echo "Children 2 or Under : ",$Full_Children_2_Under_Name_String, "</br>";
					echo "Children between the age of 3 and 10 : ",$Full_Children_3_10_Name_String, "</br>";
					echo "Children between the age of 11 and 16 : ",$Full_Children_11_16_Name_String, "</br>";		
					
					$Adult_Price = $Price*$Adult;
					$Children_2_Under_Price = 0;
					$Children_3_10_Price = 10;
					$Children_11_16_Price = 13;
					
					$Children_2_Under_Price_Total_Price = $Children_2_Under_Price*$Children_2_under;
					$Children_3_10_Price_Total_Price = $Children_3_10_Price*$Children_3_10;
					$Children_11_16_Price_Total_Price = $Children_11_16_Price*$Children_11_16;
					
					$Total_Price = $Adult_Price+$Children_2_Under_Price_Total_Price+$Children_3_10_Price_Total_Price+$Children_11_16_Price_Total_Price;
					echo "Your Total Price : £",$Total_Price;
	?>
	
	<?php
	$db = createConnection();
	$insertquery="insert into Booking (SailingID, userid, Children_2_under, Children_3_10, Children_11_16,Children_2_under_Name,Children_3_10_Name,Children_11_16_Name,Adults_Name, Adults, Total_Price, Cancelled) values (?,?,?,?,?,?,?,?,?,?,?,?);";
	$inst=$db->prepare($insertquery);
	$Cancelled = NO;
	$inst->bind_param("iiiisssssiss", $SailingID,$userid, $Children_2_under, $Children_3_10, $Children_11_16,$Full_Children_2_Under_Name_String,$Full_Children_3_10_Name_String,$Full_Children_11_16_Name_String,$Full_Adult_String,$Adult,$Total_Price,$Cancelled);
	$inst->execute();
	?>	
	<?php $db->close(); ?>
		</div>
	<a class="btn btn-primary" href="index.php" role="button">Home Page</a>
	<a class="btn btn-primary" href="user.php" role="button">User Page</a>
	<button type="button" class="btn btn-info" onclick="window.print();return false;">Print</button>
	</div>
</section>
	
</body>
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script src="js/Topbutton.js"></script>
<script>
var userlevel=<?php echo $currentuser['userlevel']; ?>;
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		prepareTouch();
		prepareMenu();
	}
}

</script>
<script>
function myFunction() {
    window.print();
}
</script>

</html>