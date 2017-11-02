<?php
	if(isset($_POST["username"])){		
		$hostname = "Localhost";
		$username = "pi_api";
		$password = "apipassword";
		$dbname = "pi_gradient";
		
		$link = mysqli_connect($hostname, $username, $password, $dbname);
		
		
		$stmt = $link->prepare("SELECT username, text, colorA, colorB FROM posts WHERE username = ? ORDER BY timestamp DESC LIMIT 1");	
			
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

		$stmt->store_result();
		$stmt->bind_result($username, $text, $colorA, $colorB);
		$stmt->fetch();
		$result = array("username" => $username, "text" => $text, "colorA" => $colorA, "colorB" => $colorB);
				
		echo(json_encode($result));
		
	}else{
		echo("Error: Missing Arguments");
	}
?>