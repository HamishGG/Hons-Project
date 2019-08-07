<?php
session_start();
include('php/functions.php');
$username=checkUser($_SESSION['userid'],session_id(),2);
$currentuser=getUserLevel();
$SailingID=$_POST['SailingID'];
$Adult=$_POST['Adult'];
$Children_2_under=$_POST['Children_2_under'];
$Children_3_10=$_POST['Children_3_10'];
$Children_11_16=$_POST['Children_11_16'];
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
		<form id="FinalOrderInformation" name="FinalOrderInformation" method="post" action="FinalOrderInformation.php">
		
	<?php
   $limit = $Adult;
   for ($i=1; $i<=$limit; $i++) {
	?>
   <p><?php echo $i; ?> : Please enter first and last name for Adult <input name="Adult_Name<?php echo $i; ?>" id="Adult_Name"  type="text" required/><br>
	<?php 
   } 
	?>
	
	<?php
   $limit = $Children_2_under;
   for ($i=1; $i<=$limit; $i++) {
	?>
   <p><?php echo $i; ?> : Please enter first and last name for Children 2 and under <input name="Children_2_Under_Name<?php echo $i; ?>" id="Children_2_Under_Name" type="text" required/><br>
	<?php 
   } 
	?>
	
	<?php
   $limit = $Children_3_10;
   for ($i=1; $i<=$limit; $i++) {
	?>
   <p><?php echo $i; ?> : Please enter first and last name for Children between the age of 3 and 10 <input name="Children_3_10_Name<?php echo $i; ?>" id="Children_3_10_Name" type="text" required/><br>
	<?php 
   } 
	?>
	
	<?php
   $limit = $Children_11_16;
   for ($i=1; $i<=$limit; $i++) {
	?>
   <p><?php echo $i; ?> : Please enter first and last name for Children between the age of 11 and 16 <input name="Children_11_16_Name<?php echo $i; ?>" id="Children_11_16_Name" type="text" required/><br>
	<?php 
   } 
	?>
	<input type="hidden" name="SailingID" value="<?php echo $SailingID;?>">
	<input type="hidden" name="Adult" value="<?php echo $Adult;?>">
	<input type="hidden" name="Children_2_under" value="<?php echo $Children_2_under;?>">
	<input type="hidden" name="Children_3_10" value="<?php echo $Children_3_10;?>">
	<input type="hidden" name="Children_11_16" value="<?php echo $Children_11_16;?>">
  	<input type="submit" class="btn btn-success" name="submit" value="Submit Order" />
</form>
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