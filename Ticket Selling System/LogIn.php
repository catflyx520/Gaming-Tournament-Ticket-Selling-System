<?php
$error = NULL;
	session_start();
	$email = "";
   	$_SESSION['email'] = Null;
	if(isset($_POST['submit'])){
		# Connect to the database
		$mySqli = NEW mySqli('localhost','root','','oopproject');

		# Scan and store input
		$email = $mySqli->real_escape_string($_POST['email']);
		$password = $mySqli->real_escape_string($_POST['password']);

		# hash the password and compare with database data
		$password = md5($password);

		#Query to retrieve data
		$checkDataSet = $mySqli->query("SELECT * FROM account WHERE Email = '$email' AND Password = '$password' LIMIT 1");

		# process log in if checkDataSet does not = 0,
		# which mean the inputted data exists in the database
		if ($checkDataSet->num_rows != 0){
			// process log in
			$row = $checkDataSet->fetch_assoc();
			#retrieve the verification status of this account
			$verified = $row['VerificationStatus'];	
			$email = $row['Email'];	

			if ($verified == 1){

				session_start();
   				$_SESSION['email'] = $email;
   				$_SESSION['test'] = "Funtest";

				
				# Go to home with account ID
				header("Location: home.php?email=".$_POST['email']);
			}else{
				$error = "This account has not yet been verified. Please check your email and verify this account.";
			}

		}else{
			$error = "The email and/or password you entered is incorrect.";
		}

	}
	if(isset($_POST['signup'])){
		header("Location: Registration.php");
	}
	

?>


<html>
<head>
	<title>Log In</title>
</head>
<body>
	<form method="post" action=""> 
	<table border="0" align="center" style="padding-top: 10px;" >
	
		<tr>
			<h1 align="center" style="padding-top: 200px;">Log In</h1>
		</tr>
		
		<tr>
			<td align="left">Email:</td>
			<td><input type="text" name="email"></td>
		</tr>
		<tr>
			<td align="left">Password:</td>
			<td><input type="password" name="password" ></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="SUBMIT" name="submit" value="Log in"required/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="SUBMIT" name="signup" value="Sign up"required/>
			</td>
		</tr>
		
	</table>
	</form>
	<center>
		<?php
		echo $error;
		?>
	</center>
</body>
</html>