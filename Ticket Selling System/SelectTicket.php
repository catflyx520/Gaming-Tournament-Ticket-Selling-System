<?php 
	$error = NULL;
	if (isset($_GET['email'])){
		$email = $_GET['email'];
	}else{
		//go to log in
		echo"user is not log in";
	}
	session_start();
   	$_SESSION['email'] = $email;



	if (isset($_POST['checkout'])){
		// insert new order and insert email to that order
		$mySqli = NEW mysqli('localhost','root','','oopproject');

		$checkDataSet = $mySqli->query("SELECT COUNT(*) AS total FROM ordertable");
		



		if($checkDataSet->num_rows == 0){
			$num_orders = 1;
		}else{
			$row = $checkDataSet->fetch_assoc();
			$num_orders = $row['total'];	
			echo ($num_orders);						# total number of order in the table
			$num_orders = $num_orders + 1;
		}

		$insert = $mySqli->query("INSERT INTO ordertable(OrderNumber,Email)
				VALUES('$num_orders', '$email')");
		 


	

		// set the new order number to all the select ticket and update status to 'hold'
		$value1 = $_POST['tier1'];
		$value2 = $_POST['tier2'];
		$value3 = $_POST['tier3'];
		$value4 = $_POST['tier4'];
		$value5 = $_POST['tier5'];
		$value6 = $_POST['tier6'];

		if ($value1 != 0) {
			$update = $mySqli->query("UPDATE ticket SET OrderNumber = '$num_orders', Status = 'hold'
				WHERE Tier = 1 AND Status ='' LIMIT $value1");
			echo $mySqli->error;
		}if ($value2 != 0) {
			$update = $mySqli->query("UPDATE ticket SET OrderNumber = '$num_orders', Status = 'hold'
				WHERE Tier = 2 AND Status ='' LIMIT $value2");

		}if ($value3 != 0) {
			$update = $mySqli->query("UPDATE ticket SET OrderNumber = '$num_orders', Status = 'hold'
				WHERE Tier = 3 AND Status ='' LIMIT $value3");

		}
		if ($value4 != 0) {
			$update = $mySqli->query("UPDATE ticket SET OrderNumber = '$num_orders', Status = 'hold'
				WHERE Tier = 4 AND Status ='' LIMIT $value4");

		}
		if ($value5 != 0) {
			$update = $mySqli->query("UPDATE ticket SET OrderNumber = '$num_orders', Status = 'hold'
				WHERE Tier = 5 AND Status ='' LIMIT $value5");

		}
		if ($value6 != 0) {
			$update = $mySqli->query("UPDATE ticket SET OrderNumber = '$num_orders', Status = 'hold'
				WHERE Tier = 6 AND Status ='' LIMIT $value6");
		}

		header("Location: CheckOut.php?OrderNumber=$num_orders");

		// once confirm check out, update ticket status to 'sold'
	}


	//get price value of event name
	if(isset($_POST['checkout'])){
		
		echo $value1;
		echo $value2;
		echo $value3;
		echo $value4;
		echo $value5;
		echo $value6;
	}else{

	}
 ?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/SelectTicketStyle.css">
	<link rel="stylesheet" href="fontawesome/css/all.css">
	<title>Select Ticket</title>
</head>
<body>

	



	

	<div class = "container" style="background-color:#F4F4F4;"> 
	
	

		<!-- Event informations -->
		<div class="row eventname" style="border-style: solid;">
			<p><b>League of Legends Final 2020</b><br/>
			Venue: Elbridge Center<br/>
			Address: 4646 Trymore Blvd, ELBRIDGE, NY 13060<br/>
			Date: 05/24/2020</p>
		</div>

		<!--Stage diagram and cart -->
		<div class="row">
			<!--Stage diagram-->
			<div class="col-7" style="border-style: solid;">
				<div class="row">
					<div class="stage">Stage</div>
				</div>
				<div class="row">
					<div class="col-4 blocks" >
						<div class="box">Tier 1</div>
					</div>
					<div class="col-4 blocks">
						<div class="box">Tier 2</div>
					</div>
					<div class="col-4 blocks">
						<div class="box">Tier 3</div>
					</div>
				</div>
				<div class="row">
					<div class="col-4 blocks" >
						<div class="box">Tier 4</div>
					</div>
					<div class="col-4 blocks">
						<div class="box">Tier 5</div>
					</div>
					<div class="col-4 blocks">
						<div class="box">Tier 6</div>
					</div>
				</div>
			</div>

			<!--Cart with input spinner-->
			<div class="col-5" style="border-style: solid;">
				<div class="cart">Cart</div>

				<form method="post" action=""> 
				<table border="0" align="center" style="padding-top: 10px;" >
					<tr>
						<td align="left" style="padding: 15px;">Tier 1:</td>
						<td><input data-prefix= "$" type="number" value="0" min="0" max="100" step="1" name="tier1"></td>
						<td>

						</td>
					</tr>
					<tr>
						<td align="left" style="padding: 15px;">Tier 2:</td>
						<td><input id="spinner" type="number" value="0" min="0" max="100" step="1" name="tier2"></td>
					</tr>
	
					<tr>
						<td align="left" style="padding: 15px;">Tier 3:</td>
						<td><input type="number" value="0" min="0" max="100" step="1" name="tier3"></td>
					</tr>
					<tr>
						<td align="left" style="padding: 15px;">Tier 4:</td>
						<td><input type="number" value="0" min="0" max="100" step="1" name="tier4"></td>
					</tr>
					<tr>
						<td align="left" style="padding: 15px;">Tier 5:</td>
						<td><input type="number" value="0" min="0" max="100" step="1" name="tier5"></td>
					</tr>
					<tr>
						<td align="left" style="padding: 15px;">Tier 6:</td>
						<td><input type="number" value="0" min="0" max="100" step="1" name="tier6"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="SUBMIT" name="checkout" value="Check Out" required/>
						</td>
					</tr>
					
						
					
		
				</table>
				</form>
				
			</div>

		</div>
	</div>

	<script src="http://code.jquery.com/jquery-3.5.0.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<script src="bootstrap-input-spinner.js"></script>

	<!-- <script>
		$('#spinner').inputSpinner();

		$('#spinner').on('input', function (e) {
			$('#minput').html($(this).val())
		})


	</script> -->
<center>
		<?php
		echo $error;
		?>
</center>
	

</body>
</html>

