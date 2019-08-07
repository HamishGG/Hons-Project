<?php
session_start();
include('php/functions.php');
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
</head>
<br>

<section  class  = "main" id="main">
<div class="Main_Info">
<body>
	<form id="Order" name="Order" onsubmit="return validateForm()" method="post" action="OrderUpdate.php">
	<fieldset><legend>Trip Location</legend>
		  <h1>Please Choose what trip you would like</h1>
		  <br>
		  
		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Monday" aria-expanded="false" aria-controls="Monday" >
			Monday
			  </button>
		  <div class="collapse indent" id="Monday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Monday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID' default /> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>
		  </div>
		</div>
		<br>

		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Tuesday" aria-expanded="false" aria-controls="Tuesday" >
			Tuesday
			  </button>
		  <div class="collapse indent" id="Tuesday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Tuesday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID'> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>
		  </div>
		</div>
		<br>
		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Wednesday" aria-expanded="false" aria-controls="Wednesday" >
			Wednesday
			  </button>
		  <div class="collapse indent" id="Wednesday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Wednesday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID'> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>
		  </div>
		</div>
		<br>

		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Thursday" aria-expanded="false" aria-controls="Thursday" >
			Thursday
			  </button>
		  <div class="collapse indent" id="Thursday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Thursday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID'> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>
		  </div>
		</div>
		<br>

		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Friday" aria-expanded="false" aria-controls="Friday" >
			Friday
			  </button>
		  <div class="collapse indent" id="Friday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Friday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID'> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>
		  </div>
		</div>
		<br>

		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Saturday" aria-expanded="false" aria-controls="Saturday" >
			Saturday
			  </button>
		  <div class="collapse indent" id="Saturday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Saturday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID'> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>
		  </div>
		</div>
		<br>

		   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#Sunday" aria-expanded="false" aria-controls="Sunday" >
			Sunday
			  </button>
		  <div class="collapse indent" id="Sunday">
		  <div class="card card-body">
		  </br>
		  <?php
			$db=createConnection();
			$sql = "select SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price from Sailing WHERE Day = 'Sunday'";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($SailingID,$Destination,$Arrival_Time,$Leaving_Time,$Leaving_From,$Day,$Price);

			while($stmt->fetch()) {
				
					echo "<input type='radio' name='Option' value='$SailingID'> To : ",$Destination," <br> Leaving From: ",$Leaving_From,"<br> Arrives at :  ", $Arrival_Time, " Leaves at: ",$Leaving_Time," </br> Cost : £",$Price,"</input>";
					echo "</br>";

				}		
			$stmt->close();

		?>	

		  </div>
		</div>
		<br>
		<br>
		<br>
		<input type="Submit" name="Submit" class="btn btn-success" value="Submit" />
	</fieldset>
</form>
	<?php $db->close(); ?>
<p>Return to the <a href="index.php">home</a> page.</p>
</section>
</div>
</body>
<script src="js/register.js"></script>
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script>
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		prepareMenu();
		prepareTouch();

	}
}

function validateForm() {
    var radios = document.getElementsByName("Option");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid) alert("Must check some option!");
    return formValid;
}
</script>
</html>
