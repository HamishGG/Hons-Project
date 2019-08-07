<?php
//setup page for selecting the user you want to change 
session_start();
include('php/functions.php');
$username=checkUser($_SESSION['userid'],session_id(),1);
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
		<?php if($currentuser['userlevel']==1) { 
		echo'<li><a href="admin.php">Admin</a></li>';
			} ?>
		<?php if($currentuser['userlevel']==2) { ?>
		<li><a href="user.php">User Panel</a></li>
			<?php } ?>
		<li><a href="php/logout.php">Log Out</a></li>
	</ul>
</nav>
<section  class  = "main" id="main">
<div class="Main_Info">
  <h1>Trip Search</h1>
  <form action="Admin_Trip_Info_No_Boarding.php" method="post">
  <p>Choose Sailing To view:</p>
    <select name="SailingID">
	<?php
	$db = createConnection();
	$sql = "SELECT SailingID,Destination,Arrival_Time,Leaving_Time,Leaving_From,Day,Price FROM Sailing";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($SailingID,$Destination,$Arrival_Time, $Leaving_Time, $Leaving_From,$Day,$Price);
	while($stmt->fetch()) {
		echo "<option value = ",$SailingID,">","SailingID : ",$SailingID," Destination :  ",$Destination,"</option>";
		echo "</br>";
	}
	$stmt->close();
	$db->close();
?> 
	</select>
	<br><br>
    <input class="btn btn-primary" type="submit" value="Search"><br>
	</br>
		<?php if($currentuser['userlevel']==2) { ?>
		<p><a href="user.php"class="btn btn-success" role="button">Go to User Page</a></p>
	<?php } ?>
	
	<?php if($currentuser['userlevel']==1) { ?>
		<p><a href="admin.php"class="btn btn-success" role="button">Go to Admin Page</a></p>
	<?php } ?>
  </form>
    </div>
  </section>

</body>
</html>
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