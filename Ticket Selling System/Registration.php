<?php
	$error = NULL;
	if(isset($_POST['login'])){
		header("location: LogIn.php");
	}

	

	if(isset($_POST['create'])){

		// transfer input into variable
		$email = $_POST['email'];
		$name = $_POST['name'];
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];

		$mySqli = NEW mySqli('localhost','root','','oopproject');
		$email = $mySqli->real_escape_string($email);

		# 1: validation for existed email
		# 2: validation matchhing password
		$checkEmail = $mySqli->query("SELECT * FROM account WHERE Email = '$email' LIMIT 1");

		if($checkEmail->num_rows != 0){
			$error = "<p>The email you entered already associated with an account.</p>";
		}
		elseif($password != $confirmpassword) {
			$error .= "<p>Passwords do not match.</p>";
			echo $error;
		}else{
			// Inputs are all value

			// Connect to our database
			

			
			$password = $mySqli->real_escape_string($password);
			$name = $mySqli->real_escape_string($name);
			// everything valid, begin create account process
			# 1: hash the password
			# 2: generate verification link
			# 3: store email, pass, name, verKey and initialize verStatus to 0 (not verified) in database
			# 4: send verification link via email
			# 5: if user click on the link via email, update verStatus to 1 (veridied)

			$password = md5($password);

			$vkey = md5(time().$email);

			// Insert attributes into database
			$insert = $mySqli->query("INSERT INTO account(Email,Name,Password,VerificationKey)
				VALUES('$email', '$name', '$password', '$vkey')");

			if($insert){
				//If insert success, send email with verification link
				$destEmail = $email;
				$subject = "Ticket Email Verification";
				$message = "<a href='http://localhost/learning/AccountVerified.php?vkey=$vkey'>Click here to verify your email address.</a>";
				$headers = "From: bvnguyen2249@gmail.com \r\n";
				$headers .= "MINE-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				mail($destEmail,$subject,$message,$headers);

				header('location:EmailSentPage.php');

			}else{
				echo $mySqli->error;
			}
			

		

		}


		# generate Verification Key

		
	}



?>
<html>
<head>
	<!-- <script type="text/javascript">
 	function myFunction() {
  		var x = document.getElementById("myDIV");
  		//if it is display and password 
  		if (x.style.display === "none") {
    		x.style.display = "block";
  		} else {
    		x.style.display = "none";
  	}
}
</script> -->
	<title>Account Registration</title>
</head>

<body>
	<form method="post" action="" >
		
		<table border="0" align="center" style="padding-top: 10px;" >
			<tr>
				<h1 align="center" style="padding-top: 200px;">Create an account</h1>
			</tr>
			<tr>
				<td align="left">Email:</td>
				<td><input type="text" name="email" ></td>
			</tr>
			<tr>
				<td align="left">Name:</td>
				<td><input type="text" name="name" ></td>
			</tr>
	
			<tr>
				<td align="left">Password:</td>
				<td><input type="password" name="password" ></td>
			</tr>
			<tr>
				<td align="left">Confirm Password:</td>
				<td><input type="password" name="confirmpassword" ></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="SUBMIT" name="create" value="Create" required/>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="SUBMIT" name="login" value="Log in" required/>
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