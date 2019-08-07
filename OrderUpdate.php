<?php
session_start();
include('php/functions.php');
$username=checkUser($_SESSION['userid'],session_id(),2);
$currentuser=getUserLevel();
$SailingID=$_POST['Option'];

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
<body>
<button onclick="topFunction()" id="myBtn" title="Go To Top">Top</button>
	</div>
<section  class  = "main" id="main">
<div class="Main_Info">
	<?php if($currentuser['userlevel']>=1) { ?>
	<h1>Welcome back <?php echo $currentuser['username']; ?>!</h1>
	<?php } ?>
	<br>
	<h4>Here is the trip you have selected:</h2>
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
	?>
	<br>
	<form id="UsersInformation" name="UsersInformation" method="post" action="UsersInformation.php">
	<fieldset><legend>Trip Location</legend>
		<h3>Plase select how many people are traveling</h3>
	<p>Please pick how many adults</p>
	<select name="Adult">
		<option id="Adult" name="Adult" value="1">1 Adult</option>
		<option id="Adult" name="Adult" value="2">2 Adult</option>
		<option id="Adult" name="Adult" value="3">3 Adult</option>
		<option id="Adult" name="Adult" value="4">4 Adult</option>
		<option id="Adult" name="Adult" value="5">5 Adult</option>
	</select>
	<p>Please pick how many Children between the age of 2 and Under</p>
	<p>FREE FARES FOR 2 AND UNDER</p>
	<select name="Children_2_under">
		<option id="Children_2_under" name="Children_2_under" value="0">0 Children</option>
		<option id="Children_2_under" name="Children_2_under" value="1">1 Children</option>
		<option id="Children_2_under" name="Children_2_under" value="2">2 Children</option>
		<option id="Children_2_under" name="Children_2_under" value="3">3 Children</option>
		<option id="Children_2_under" name="Children_2_under" value="4">4 Children</option>
		<option id="Children_2_under" name="Children_2_under" value="5">5 Children</option>
	</select>	
	<p>Please pick how many Children between the age of 3 and 10</p>
	<p>£10 for Children age 3 to 10</p>
	<select name="Children_3_10">
		<option id="Children_3_10" name="Children_3_10" value="0">0 Children</option>
		<option id="Children_3_10" name="Children_3_10" value="1">1 Children</option>
		<option id="Children_3_10" name="Children_3_10" value="2">2 Children</option>
		<option id="Children_3_10" name="Children_3_10" value="3">3 Children</option>
		<option id="Children_3_10" name="Children_3_10" value="4">4 Children</option>
		<option id="Children_3_10" name="Children_3_10" value="5">5 Children</option>
	</select>		
	<p>Please pick how many Children between the age of 11 and 16</p>
	<p>£13 for Children age 11 to 16</p>
	<select name="Children_11_16">
		<option id="Children_11_16" name="Children_11_16" value="0">0 Children</option>
		<option id="Children_11_16" name="Children_11_16" value="1">1 Children</option>
		<option id="Children_11_16" name="Children_11_16" value="2">2 Children</option>
		<option id="Children_11_16" name="Children_11_16" value="3">3 Children</option>
		<option id="Children_11_16" name="Children_11_16" value="4">4 Children</option>
		<option id="Children_11_16" name="Children_11_16" value="5">5 Children</option>
	</select>	
	</br></br>
	<input type="hidden" name="SailingID" value="<?php echo $SailingID;?>">
  	<input type="submit" class="btn btn-success" name="submit" value="Submit Order" />
	
	</form>
	
	<?php $db->close(); ?>
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
</html>