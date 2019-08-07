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
<section  class  = "main" id="main">
<div class="Main_Info">
<body>
		<?php if($currentuser['userlevel']==0) { ?>
	<h1>Please Login to see the Menu</h1></br>
	<a href="login.php"class="btn btn-success" role="button">Login</a>
	<a href="register.html"class="btn btn-primary" role="button">Register</a>
	<?php } ?>
	</br></br>
	<h1>Welcome back <?php echo $currentuser['username']; ?>!</h1>
	<h2> Here is a timetable of all avaiable trips!</h2>
	<h4>This will be hidden for mobile viewers sorry :)</h4>
<table class="ShippingTimeTable">
			<thead>
				<tr>
					<th>
						<p>Monday</p>
						<p>Eigg &amp; Muck</p>
						<p>20th May - 21st Oct</p>
					</th>
					<th>
						<p>Tuesday</p>
						<p>Eigg &amp; Rum</p>
						<p>20th May - 21st Oct</p>
					</th>
					<th>
						<p>Wednesday</p>
						<p>Eigg &amp; Muck</p>
						<p>20th May - 21st Oct</p>
					</th>
					<th>
						<p>Thursday</p>
						<p>Rum</p>
						<p>20th May - 21st Oct</p>
					</th>
					<th>
						<p>Friday</p>
						<p>Eigg &amp; Muck</p>
						<p>20th May - 21st Oct</p>
					</th>
					<th>
						<p>Saturday</p>
						<p>Eigg &amp; Rum</p>
						<p>Jun, Jul &amp; Aug Only</p>
					</th>
					<th>
						<p>Sunday</p>
						<p>Eigg &amp; Muck</p>
						<p>Jun, Jul &amp; Aug Only</p>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Eigg Arr (12:00)</p>
						<p>Eigg Dep (12:30)</p>
						<p>Muck Arr (13:30)</p>
						<p>Muck Dep (15:30)</p>
						<p>Eigg Arr (16:00)</p>
						<p>Eigg Dep (16:30)</p>
						<p>Morar Arr (17:30)</p>
					</td>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Eigg Arr (12:00)</p>
						<p>Eigg Dep (12:30)</p>
						<p>Muck Arr (13:30)</p>
						<p>Muck Dep (15:30)</p>
						<p>Eigg Arr (16:00)</p>
						<p>Eigg Dep (16:30)</p>
						<p>Morar Arr (17:30)</p>
					</td>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Eigg Arr (12:00)</p>
						<p>Eigg Dep (12:30)</p>
						<p>Muck Arr (13:30)</p>
						<p>Muck Dep (15:30)</p>
						<p>Eigg Arr (16:00)</p>
						<p>Eigg Dep (16:30)</p>
						<p>Morar Arr (17:30)</p>
					</td>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Rum Arr (12:45)</p>
						<p>Rum Dep (15:45)</p>
						<p>Morar Arr (17:30)</p>
					</td>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Eigg Arr (12:00)</p>
						<p>Eigg Dep (12:30)</p>
						<p>Muck Arr (13:30)</p>
						<p>Muck Dep (15:30)</p>
						<p>Eigg Arr (16:00)</p>
						<p>Eigg Dep (16:30)</p>
						<p>Morar Arr (17:30)</p>
					</td>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Eigg Arr (12:00)</p>
						<p>Eigg Dep (12:30)</p>
						<p>Muck Arr (13:30)</p>
						<p>Muck Dep (15:30)</p>
						<p>Eigg Arr (16:00)</p>
						<p>Eigg Dep (16:30)</p>
						<p>Morar Arr (17:30)</p>
					</td>
					<td>
						<p>Morar Dep (11:00)</p>
						<p>Eigg Arr (12:00)</p>
						<p>Eigg Dep (12:30)</p>
						<p>Muck Arr (13:30)</p>
						<p>Muck Dep (15:30)</p>
						<p>Eigg Arr (16:00)</p>
						<p>Eigg Dep (16:30)</p>
						<p>Morar Arr (17:30)</p>
					</td>
				</tr>
				<tr>
					<td>
						<p><strong>Time Ashore</strong></p>
						<p>4.5 Hours on Eigg</p>
						<p>OR</p>
						<p>2.5 Hours on Muck</p>
					</td>
					<td><p><strong>Time Ashore</strong></p>
						<p>5 Hours on Eigg</p>
						<p>OR</p>
						<p>2 Hours on Muck</p>
					</td>
					<td>
						<p><span style="font-weight: bolder;">Time Ashore</span></p>
						<p>4.5 Hours on Eigg</p>
						<p>OR</p>
						<p>2.5 Hours on Muck</p>
					</td>
					<td>
						<p><span style="font-weight: bolder;">Time Ashore</span></p>
						<p>3 Hours on Rum</p>
					</td>
					<td>
						<p><span style="font-weight: bolder;">Time Ashore</span></p>
						<p>4.5 Hours on Eigg</p>
						<p>OR</p>
						<p>2.5 Hours on Muck</p>
					</td>
					<td>
						<p><span style="font-weight: bolder;">Time Ashore</span></p>
						<p>5 Hours on Eigg</p>
						<p>OR</p>
						<p>2 Hours on Muck</p>
					</td>
					<td>
						<p><span style="font-weight: bolder;">Time Ashore</span></p>
						<p>4.5 Hours on Eigg</p>
						<p>OR</p>
						<p>2.5 Hours on Muck</p>
					</td>
				</tr>
			</tbody>
		</table>
    </div>
</section>
</body>
<script src="js/functions.js"></script>
<script src="js/touch.js"></script>
<script src="js/Topbutton.js"></script>
<script>
document.onreadystatechange = function(){
	if(document.readyState=="complete") {
		prepareTouch();
		prepareMenu();
	}
}

</script>
</html>
