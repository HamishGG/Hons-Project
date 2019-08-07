<!doctype html>
<html lang="en-gb" dir="ltr">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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
		<li><a href="contact.php">Contact</a></li>
	</ul>
</nav>
</head>
<body>
<section id="main">
<?php
//setup page for the register system
session_start();
include('php/functions.php');
$currentuser=getUserLevel();
$username=$_POST['username'];
$firstname=$_POST['firstname'];
$surname=$_POST['surname'];
$emailadd=$_POST['emailadd'];
$dayob=$_POST['dayob'];
$monthob=$_POST['monthob'];
$yearob=$_POST['yearob'];
$dob=$yearob."-".$monthob."-".$dayob;
$userpass=$_POST['userpass'];
$secondpass=$_POST['secondpass'];
$tnc=(isset($_POST['tnc'])?1:0);
$salt=getSalt(16);
$cryptpass=makeHash($userpass,$salt,50);
// Used to check that submitted user does not exist already
$userexists=false;
$emailexists=false;
// connect to database
$db = createConnection();
// check form details again in case javascript disabled and 
// bypassed javascript client side scripting
// check username and email do not already exist
$sql="select username,emailadd from WebAppLogin where username=? or emailadd=?;";
$stmt=$db->prepare($sql);
$stmt->bind_param("ss",$username,$emailadd);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($userresult,$emailresult);
while($row=$stmt->fetch()) {
	if($userresult==$username) {$userexists=true;}
	if($emailresult==$email) {$emailexists=true;}
}
// check user is old enough, in this example users must be 16
$latestbirthday=mktime(0, 0, 0,date("m"),date("d"),date("Y")-16); // the last value controls min age
$birthday=mktime(0, 0, 0, $monthob, $dayob, $yearob);
$validage=(($birthday-$latestbirthday)>0?false:true);
// Check submitted and calculated variables before storing
if(!$userexists && !$emailexists && $userpass==$secondpass && isset($userpass) && filter_var($emailadd, FILTER_VALIDATE_EMAIL) && $tnc && isset($firstname) && isset($surname) && $validage) {

// insert new user
	$insertquery="insert into WebAppLogin (username, firstname, surname, emailadd, dob, usertype, tnc, salt, userpass) values (?,?,?,?,?,2,?,?,?);";
	$inst=$db->prepare($insertquery);
	$inst->bind_param("sssssiss", $username, $firstname, $surname, $emailadd, $dob, $tnc, $salt, $cryptpass);
	$inst->execute();
// check user inserted, if so create login form
	if($inst->affected_rows==1) {
	
	?>
	<h1>Your Registration Details</h1>
	<p>Welcome <?php echo $firstname." ".$surname; ?></p>
	<p>You can now login with your username <em><?php echo $username; ?></em></p>
	<section>
	<form name="login" id="login" method="post" action="php/processlogin.php">
		<fieldset><legend>Login</legend>
		<p><label for="username">Username</label><input type="text" name="username" id="username" required value="<?php echo $username; ?>"/></p>
		<p><label for="userpass">Password</label><input type="password" name="userpass" id="userpass" required /></p>
		<button type="submit" id="submit">Login</button>
		</fieldset>
	</form>
	</section>
	</section>
<?php } else { 
		//feedback there was a problem adding the user
		echo "<p>There was a problem adding your details. Please contact the website administrators</p>"; 
		}
} else { 
// registration failed due to validation errors
?>
			<h1>Registration failed</h1>
		<?php 
		if($emailexists){ echo "<p>The email address $emailadd already exists.</p>"; }
		if($userexists){ echo "<p>The username $username already exists.</p>"; }
		if($userpass!=$secondpass){ echo "<p>The passwords do not match.</p>"; }
		if(!filter_var($emailadd, FILTER_VALIDATE_EMAIL)){ echo "<p>The email address is invalid.</p>"; }
		?>
		<p>You need to return to the registration page and try again</p>
<?php 
}
$stmt->close();
$inst->close();
$db->close(); 
?>
<p>Return to the <a href="index.php">home</a> page.</p>
</body>
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script>
var userlevel=<?php echo $currentuser['userlevel']; ?>;
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		prepareMenu();
		prepareTouch();
	}
}

</script>
</html>

