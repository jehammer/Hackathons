<?php
	session_start();
	$hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	
	$link = mysqli_connect($hostname, $username, $password, $dbname);
		
	if(isset($_POST["username"])){
		$stmt = $link->prepare("SELECT postID FROM feed WHERE username = ? ORDER BY postID DESC");	
			
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $_POST["username"]);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}

		$stmt->bind_result($ids);
		while($stmt->fetch()){
		  	$rows[]=$ids; #List of post id's
		}
			
		$scanFor= join("','",$rows);   
		$sql= "SELECT * FROM posts WHERE postID IN ('$scanFor')";	
		$result = $link->query($sql);
		
		while($row = $result->fetch_assoc()) {
			$output[] = $row;
    		}
		
		echo("{arr:".json_encode($output)."}");
	}
?>