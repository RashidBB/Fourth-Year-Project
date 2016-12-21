<?php


	$operation = $_GET['operation'];

	// mySQL test connection
	$mysqli = new mysqli('localhost','mydatabase');

/*
	//connect to sqlite database
		class MyDB extends SQLite3
		{
			function __construct()
			{
				$this->open('mydatabase.db');
			}
		}
		
		$db = new MyDB();
*/

	// Get Temperature Operation
	/*if($operation ==1 ){	

		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script1.sh");
		
		if($str($message) < 5)
		{
			// record the temperature value in database
			$totalSeconds = time();
			$day = date("d",$totalSeconds);

			$t = date("H:i");
			$time = str_replace(":", "", $t)

			//$db->exec("INSERT INTO temperature (date, time, temp) VALUES($day, $time, $message)");
			echo $message;
		}else{
			echo $message;
		}
		
	}*/
	
	// Get Battery Level operation
	if($operation ==2){
		
		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script2.sh");
		
		if($message)
		{
			// record battery level in the database
			$db->exec("INSERT INTO temperature (date, time, temp) VALUES(01, 345, '32')");
			echo $message;
		}else{
			echo "nothing";
		}
	}

	// Turn off fan operation
	if($operation ==3){
		
		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script2.sh");
		
		if($message)
		{
			echo $message;
		}else{
			echo "nothing";
		}
	}
	
	// Turn on fan operation
	if($operation ==4){
		
		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script4.sh");
		
		if($message)
		{
			echo $message;
		}else{
			echo "nothing";
		}
	}
	
	// Auto System Operation
	if($operation ==5){
		
		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script5.sh");
		
		if($message)
		{
			echo $message;
		}else{
			echo "nothing";
		}
	}
	
	// Turn off Lights oepration
	if($operation ==6){
		
		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script6.sh");
		
		if($message)
		{
			echo $message;
		}else{
			echo "nothing";
		}
	}
	
	// Turn on lights operation
	if($operation ==7){
		
		//execute python script
		$message = shell_exec("sudo /var/www/scripts/script7.sh");
		
		if($message)
		{
			echo $message;
		}else{
			echo "nothing";
		}
	}
	
	

/*
	if($operation ==8){

		//connect to sqlite database
		class MyDB extends SQLite3
		{
			function __construct()
			{
				$this->open('mydatabase.db');
			}
		}
		
		$db = new MyDB();
		
			
		$db->exec('CREATE TABLE temperature (date INT, time INT, temp STRING)');
		$db->exec("INSERT INTO temperature (date, time, temp) VALUES(01, 345, '32')");
		$db->exec("INSERT INTO temperature (date, time, temp) VALUES(02, 400, '25')");
		$db->exec("INSERT INTO temperature (date, time, temp) VALUES(03, 415, '23')");
		$resultquery = $db->query('SELECT * FROM temperature');
		
		
		while($row = $resultquery->fetchArray()){
			print_r("Date: ".$row[date]." Time: ".$row[time]." Temp: ".$row[temp]." \n");
		}
		
		
	}
*/
	// Check server
	if($operation ==99){
		
		//execute python script
		//$message = shell_exec("sudo /var/www/scripts/script7.sh");
		$message = "server looks like its working";

		$mysqli = new mysqli('localhost','root','','mydatabase');

		if ($mysqli->connect_error) {
    		die("Connection failed: " . $mysqli->connect_error);
		} 

		/*
		$sql = "INSERT INTO temperatures (date, time, temp) VALUES (35, 1010, 21)";


		if ($mysqli->query($sql) === TRUE) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $mysqli->error;
		}

		$mysqli->close();
		*/

		$sql = "SELECT temp FROM temperatures";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		
        		$myArray = array();

    			$tempValues = $row["temp"].match(/.{2}/g);
    			$timeValues = $row["time"].match(/.{3}/g);

    			for($i=0; $i< sizeof($tempValues); $i++){
    				array_push($myArray,$timeValues[$i],$tempValues[$i]);
    			}

        		echo $myArray."";
    		}
		} else {
    		echo "0 results";
		}
		$mysqli->close();

		
	}
	
?>
