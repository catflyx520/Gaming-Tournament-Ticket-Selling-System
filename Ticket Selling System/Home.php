<?php 
	$email = "";

	
	session_start();
   	$email = $_SESSION['email'];
   	$test = $_SESSION['test'];

if (isset($_SESSION['email'])) : ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  			<a class="navbar-brand" href="#">Ticket Subsystem</a>
  			<form class="form-inline my-2 my-lg-0">
      				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    		</form>

    		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  			<span class="navbar-toggler-icon"></span>
  			</button>

  			<div class="collapse navbar-collapse" id="navbarSupportedContent">
   				<ul class="navbar-nav ml-auto">
   					<form action="" method="POST">
    				<input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="profile" value="Profile"></input>
    				<input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="logout" value="Log Out"></input>
    				</form>
    			</ul>
  			</div>
		</nav>
<?php
else : ?> 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  			<a class="navbar-brand" href="#">Ticket Subsystem</a>
  			
  
  			<form class="form-inline my-2 my-lg-0">
      				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    		</form>

    		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  			<span class="navbar-toggler-icon"></span>
  			</button>

  			<div class="collapse navbar-collapse" id="navbarSupportedContent">
   				<ul class="navbar-nav ml-auto">
   					<form action="" method="POST">
   					<input class="btn btn-outline-success mr-sm-2 my-2 my-sm-0" type="submit" name="login" value="Log In"></input>
    				<input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="signup" value="Sign Up"></input>
    				</form>
    			</ul>
  			</div>
		</nav>
<?php endif ?>


<?php

$error = NULL;
	if(isset($_POST['logout'])){
		header("location: LogIn.php");
	}
	if(isset($_POST['signup'])){
		header("location: Registration.php");
	}
	if(isset($_POST['login'])){
		header("location: LogIn.php");
	}
	if(isset($_POST['profile'])){
		header("location: profile.php");
	}

	// if 'buy ticket' is clicked, run the following code
	if (isset($_POST['buyticket'])) {
		// if log in, go to select ticket page, else go to log in page.
		if (isset($_GET['email'])) {
			header("location: SelectTicket.php?email=".$_GET['email']);
		}
		else{
			header("Location: LogIn.php");
		}
	}
?>


<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" href="fontawesome/css/all.css">

	<title>Ticket</title>

</head>

	<body>

		<form action="" method="POST">
		<div class = "container">
			<div class="row">
				<div class="col-3" style="background-color: lightgreen;">

				</div>
				<div class="col-7">
					<h5>Final 2020</h5>
					<p>The League of Legends World Championship is the annual professional video game competition hosted by Riot Games and is the culmination of each season. Team compete for the champion title, the 70-pound Summoner's Cup, and a multi-million dollar championship prize. In 2018, the finals were watched by 99.6 million people, breaking viewer record for all gaming. This is, the event will be hosted at Elbridge Center.</p>
				</div>
				<div class="col-2">
					<input class="btn btn-outline-success my-2 my-sm-0" input type="SUBMIT" name="buyticket" value="Buy Ticket"></input>
					<h6>Date: 05/24/2020</h6>
					<h6>Location: Elbridge Center</h6>

				</div>
			</div>
		</div>
		<div class = "container">
			<div class="row">
				<div class="col-3" style="background-color: lightgreen;">
				</div>
				<div class="col-7">		
					<h5>Dota 2 ESL One Los Angeles 2020 </h5>
					<p>Fifteen Teams from Regional Qualifiers, Three teams each from Europe, China and Southeast Asia, Two teams each from CIS, North and South AmericaOne team as champion of StarLadder ImbaTV Minor S3. The prize pool for the tournament would have been $1,000,000 USD and 15,000 Pro Circuit Points.</p>
				</div>
				<div class="col-2">
					<input class="btn btn-outline-success my-2 my-sm-0" type="SUBMIT" name="buyticket" value="Buy Ticket"></input>
					<h6>Date: 4/20/2020</h6>
					<h6>Location: Honda Center</h6>
				</div>
			</div>
		</div>
		<div class = "container">
			<div class="row">
				<div class="col-3" style="background-color: lightgreen;">
				</div>
				<div class="col-7">		
					<h5>Random Event</h5>
					<p>The International 2020 (TI10) was the ninth iteration of The International, an annual Dota 2 world championship esports tournament. Hosted by Valve, the game's developer, the tournament followed a year-long series of awarding qualifying points, known as the Dota Pro Circuit (DPC), with the top 12 ranking teams being directly invited to the tournament, which took place in August 2020 at the Mercedes-Benz Arena in Shanghai.</p>
				</div>
				<div class="col-2">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buy Ticket</button>
					<h6>Date: 4/20/2020</h6>
					<h6>Location: Staple Center</h6>
				</div>
			</div>
		</div>
		<div class = "container">
			<div class="row">
				<div class="col-3" style="background-color: lightgreen;">
				</div>
				<div class="col-7">		
					<h5>Counter-Strike: Global Offensive Major Championships</h5>
					<p>The Counter-Strike: Global Offensive Major Championships, commonly known as Majors, are Counter-Strike: Global Offensive (CS:GO) esports tournaments sponsored by Valve, the game's developer. The Majors were first introduced in 2013 and took place in Jönköping, Sweden and was hosted by DreamHack with a total prize pool of US$250,000. Six teams were directly invited, six teams were </p>
				</div>
				<div class="col-2">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buy Ticket</button>
					<h6>Date: 4/20/2020</h6>
					<h6>Location: Honda Center</h6>
				</div>
			</div>
		</div>
	

		</form>
	<center>
		<?php
		echo $error;
		?>
	</center>

	</body>
</html>