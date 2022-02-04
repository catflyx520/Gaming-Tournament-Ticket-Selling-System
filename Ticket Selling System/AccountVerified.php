<?php

	if(isset($_GET['vkey'])){
		//process verification
		$vkey = $_GET['vkey'];
		$mySqli = NEW mySqli('localhost','root','','oopproject');

		$verifyData = $mySqli->query("SELECT VerificationStatus, VerificationKey FROM account WHERE VerificationStatus = 0 AND VerificationKey = '$vkey' LIMIT 1");


		if ($verifyData->num_rows == 1){
			//Correct code, update status from 0 to 1
			$verUpdate = $mySqli->query("UPDATE account SET VerificationStatus = 1 WHERE VerificationKey = '$vkey' LIMIT 1");
			if ($verUpdate){
				echo "Your account has been verified.";
			}else{
				echo $mySqli->error;
			}

		}else{
			echo "You had verified your account.";
		}


	}
	else{
		die("Incorrect Code.");
	}



?>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>