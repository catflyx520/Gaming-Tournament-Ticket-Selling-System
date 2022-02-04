<?php 
	
	$mySqli = NEW mysqli('localhost','root','','oopproject');

	$email = "";

	
	session_start();
   	$email = $_SESSION['email'];



 ?>


 <html>
 <head>
 	<title>Profile</title>
 </head>
 <body>
 			
 		<form method="post" action=""> 
			<table border="0" align="center" style="padding-top: 10px;" >
				<tr>
					<h3 align="center" style="padding-top: 50px;">Your Ticket</h3>
				</tr>
				
					
					<?php   

					$count = 0;
					$checkDataSet = $mySqli->query("SELECT OrderNumber AS orderNum FROM ordertable WHERE Email = '$email'");
					if($checkDataSet-> num_rows > 0){
						
						while($row1 = $checkDataSet->fetch_assoc()) {

							$orderNum = $row1['orderNum'];
							

							$result = $mySqli->query("SELECT TicketNumber, Tier, Price, EventName FROM ticket WHERE OrderNumber = '$orderNum'");


							if($result-> num_rows > 0){
								while ($row = $result-> fetch_assoc()){
								$eventName = $row['EventName'];
								$eventInfo = $mySqli->query("SELECT VenueName, Date, Location,VenueName FROM event WHERE EventName = '$eventName'");

								$row2 = $eventInfo-> fetch_assoc();

								$count = $count+1;

								?><tr><td style="padding: 10px;"><?php
								echo "-Event: ". $row["EventName"]."<br>"."Venue: ". $row2["VenueName"]."<br>"."Date: ". $row2["Date"]."<br>"."Address: ". $row2["Location"]."<br>"."Ticket Number: ". $row["TicketNumber"]."<br>  Tier: ". $row["Tier"]." Price: $". $row["Price"]."<br>";

								?></td>
								<!-- html create button here-->
								<td><input type="radio" name="radio" value=<?php echo($row["TicketNumber"]); ?> ></td>
								</tr>
							


								<?php
									

								}
							}

						}

					}
					?>
					<tr>
						<td style="text-align: center;"><input type="SUBMIT" name="confirmreturn" value=<?php echo("return"); ?> required/></td>
					</tr>
				</tr>

 			</table>
 		</form>	 
 </body>
 </html>

 <?php 

 	


 	if(isset($_POST['confirmreturn'])){

 		if(isset($_POST['radio'])){
 			$tickNum = $_POST['radio'];

 			// set status of ticket numer $tickNum to "";
 			$update = $mySqli->query("UPDATE ticket SET Status = 'returned' WHERE TicketNumber = '$tickNum'");

 			

 		

 		}
		
	}
	
	
	

?>







