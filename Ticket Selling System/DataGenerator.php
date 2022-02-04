<?php 
$error = NULL;
	$mySqli = NEW mysqli('localhost','root','','oopproject');

	// query to get number of ticket in ticket table
	$sql = "SELECT COUNT(*) AS total FROM ticket";
	$result = mysqli_query($mySqli,$sql);
	

	if(mysqli_num_rows == 0){
		$ticketNum = 0;
	}else{
		echo "in else";
		$values = msqli_fetch_assoc($result);
		$ticketNum = $values['total'];
		echo ($ticketNum);
	}

	$getDataSet = $mySqli->query("SELECT * FROM event WHERE EventName = 'Final 2020' LIMIT 1");


	if ($getDataSet->num_rows != 0){

			
		$row = $getDataSet->fetch_assoc();

		// number of ticket for the registered event
		$numTicket = $row['NumberOfTicket'];
		$eventName = $row['EventName'];	
		$price = 50.00;


		echo($numTicket)."<br>";
		echo($eventName)."<br>";

		
		//Create Loop and insert tickets into ticket table
		//10 tickets for each tier
		for ($x = 1; $x <= 6; $x++){
			if($x == 1){
				$price = 80.00;
			}if($x == 2){
				$price = 100.00;
			}if($x == 3){
				$price = 80.00;
			}if($x == 4){
				$price = 40.00;
			}if($x == 5){
				$price = 60.00;
			}if($x == 6){
				$price = 40.00;
			}

			echo ("<br>").$x.("  ");
			for ($y = $ticketNum + 1; $y <= $ticketNum + 10; $y++) {

				// $x is tier value
				// $y is TicketNumber value
				// $eventName is EventName

				$insert = $mySqli->query("INSERT INTO ticket(TicketNumber,EventName,Tier,Price)
				VALUES('$y', '$eventName', '$x', '$price')");

				echo ($y)."      ";
   				if($insert){
   					echo "insert successfully";
   				}else{
   					echo "unsuccessfully";
   				}
			}
			$ticketNum = $ticketNum + 10;
		}

	}else{
		echo $mySqli->error;
	}

 ?>