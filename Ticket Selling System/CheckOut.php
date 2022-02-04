<?php
$error = NULL;
	if (isset($_GET['OrderNumber'])){
		$OrderNumber = $_GET['OrderNumber'];

		$mySqli = NEW mysqli('localhost','root','','oopproject');

			// get email and ordernumber from ordertable and compares it with the variable,
			// if match, then process, if not return to log in
		$checkDataSet = $mySqli->query("SELECT OrderNumber AS orderNum FROM ordertable WHERE OrderNumber = '$OrderNumber' LIMIT 1");
		$row = $checkDataSet->fetch_assoc();
		$orderNum = $row['orderNum'];

		if ($checkDataSet->num_rows == 1){

			$checkDataSet = $mySqli->query("SELECT email AS email FROM ordertable WHERE OrderNumber = '$orderNum' LIMIT 1");
			if ($checkDataSet->num_rows == 1){
				$row = $checkDataSet->fetch_assoc();
				$email = $row['email'];
			}


			if (isset($_POST['Buy'])){
				// read the value for banking information and store it in bank table. if user click save info.
				$cardNo = $_POST['cardNo'];
				$cardName = $_POST['cardName'];
				$secNo = $_POST['secNo'];
				$expDate = $_POST['expDate'];
				$checkDataSet = $mySqli->query("SELECT AccountNumber FROM bank account WHERE OrderNumber = '$cardNo' LIMIT 1");

				if ($checkDataSet->num_rows == 0){
					// add it to bank account	
				}

				// if the user click confirm purchase, Process payment and email the customer ticket info with order number, update ticket status to 'sold', update amount in order table to the total amount

				//Update ticket status with orderNum to sold 
				$insert = $mySqli->query("UPDATE ticket SET Status = 'sold' 
				WHERE OrderNumber = '$orderNum'");


				$total = 0.00;
				$result = $mySqli->query("SELECT TicketNumber, Tier, Price FROM ticket WHERE OrderNumber = '$OrderNumber'");
				if($result-> num_rows > 0){
					while ($row = $result-> fetch_assoc()){	
						$total = $total + $row["Price"];
					}
				}
				//Update amount in ordertable with $subtotal
				$insert = $mySqli->query("UPDATE ordertable SET Amount = '$total' 
				WHERE OrderNumber = '$orderNum'");

				# Send email with OrderNumber($orderNum), TicketNumber, total Price 
				if($insert){
					//If insert success, send email with Ticket info
					$destEmail = $email;
					$subject = "Ticket Order";
					$message = "This is the confirmation of your purchase. Please log in and view your profile to check if the tinkets have been linked.";
					$headers = "From: bvnguyen2249@gmail.com \r\n";
					$headers .= "MINE-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					mail($destEmail,$subject,$message,$headers);

					header('location:EmailSentPage.php');
				}else{
					echo $mySqli->error;
				}
				header("Location: Purchased.php?OrderNumber=$orderNum");

			}
			if (isset($_POST['Return'])){

				$update = $mySqli->query("UPDATE ticket SET Status = '', OrderNumber = 0 WHERE OrderNumber = '$orderNum'");

				//Get email of $orderNum to use for return, then delete row of orderNum
				$delete = $mySqli->query("DELETE FROM ordertable WHERE OrderNumber = '$orderNum'");

				// return to select ticket page with email in url
				header("Location: SelectTicket.php?email=$email");
			}
		}else{
			header('location:LogIn.php');
		}			
	}else{
		header('location:LogIn.php');
	}
?>


<html>
<head>
	<title>Check Out</title>
</head>
<body>
	<form method="post" action="" >
		<table border="0" align="center">
		<td style="padding: 30px;">
		<table border="0"  >
			<tr>
				<h1 align="center" style="padding-top: 100px;">Order Summary</h1>
			</tr>
			<tr>
				<td align="left">Items:</td>
			</tr>
			<tr>
				<td style="padding-left: 15%;"><?php     
					$subtotal = 0.00;
					$result = $mySqli->query("SELECT TicketNumber, Tier, Price FROM ticket WHERE OrderNumber = '$OrderNumber'");
					if($result-> num_rows > 0){
						while ($row = $result-> fetch_assoc()){
							echo "-Ticket Number: ". $row["TicketNumber"]."<br>  Tier: ". $row["Tier"]."Price: $". $row["Price"]."<br>";
							$subtotal = $subtotal + $row["Price"];
						}
					}

				  ?></td>
			</tr>
			<tr>
				<td align="left">Estimated tax to be collected:    </td>
				<td>$0.00</td>
			</tr>
			<tr>
				<td align="left" style="font-weight: bold; font-size: 20px;">Order total:</td>
				<td style="font-weight: bold; font-size: 18px;"><?php  echo "$".($subtotal);  ?></td>
			</tr>
			<hr style="width: 400px;">

		</table>
		</td>
		<td style="padding: 30px;">
		<table border="0"  >
			<tr>
				<h1 align="center" style="padding-top: 30px;">Payment Information</h1>
			</tr>
			<tr>
				<td align="left">Credit Card No.:</td>
				<td><input type="text" name="cardNo" ></td>
			</tr>
			<tr>
				<td align="left">Name on card:</td>
				<td><input type="text" name="cardName" ></td>
			</tr>
	
			<tr>
				<td align="left">Expiration date:</td>
				<td><input type="text" name="expDate" ></td>
			</tr>
			<tr>
				<td align="left">Security No.:</td>
				<td><input type="text" name="secNo"></td>
			</tr>

			<hr style="width: 400px;">
		</table>
		</td>
	</table>

		<table border="0" align="center" style="padding-top: 100px;" >
			<td colspan="2" align="center">
				<input type="SUBMIT" name="Return" value="Return" required/>
			</td>
			<td colspan="2" align="center">
				<input type="SUBMIT" name="Buy" value="Confirm Purchase" required/>
			</td>
		</table>
	</form>


	<center>
		<?php
		echo $error;
		?>
	</center>

</body>
</html>