<?php
	function get_older_color($link, $username){
		$stmt = $link->prepare("SELECT oldercolor FROM users WHERE username = ?");	
		if ( false===$stmt ) {
		  die('OC prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $username);
		if ( false===$rc ) {
		  die('OC bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('OC execute() failed: ' . htmlspecialchars($stmt->error));
		}
		
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		
		return $result;
	}
	
	function get_newer_color($link, $username){
		$stmt = $link->prepare("SELECT newercolor FROM users WHERE username = ?");	
		if ( false===$stmt ) {
		  die('NC prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $username);
		if ( false===$rc ) {
		  die('NC bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('NC execute() failed: ' . htmlspecialchars($stmt->error));
		}
		
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		
		return $result;
	}
	
	if(isset($_POST["session_id"])){
		session_id($_POST["session_id"]);
		session_start();
		
		$hostname = "Localhost";
		$username = "pi_api";
		$password = "apipassword";
		$dbname = "pi_gradient";
		
		$link = mysqli_connect($hostname, $username, $password, $dbname);
		
		if(isset($_POST["text"])){
			$stmt = $link->prepare("INSERT INTO posts(username, text, colorA, colorB) VALUES (?, ?, ? ,?)");	
				
			if ( false===$stmt ) {
			  die('IN prepare() failed: ' . htmlspecialchars($mysqli->error));
			}
			
			$newer_color = get_newer_color($link, $_SESSION["username"]);
			$older_color = get_older_color($link, $_SESSION["username"]);

			$rc = $stmt->bind_param("ssss", $_SESSION["username"], $_POST["text"], $older_color, $newer_color);
			if ( false===$rc ) {
			  die('IN bind_param() failed: ' . htmlspecialchars($stmt->error));
			}

			$rc= $stmt->execute();
			if ( false===$rc ) {
			  die('IN execute() failed: ' . htmlspecialchars($stmt->error));
			}
		}
		
	}else{
		echo("Error: Incorrect Session ID");
		print_r($_REQUEST);
	}
?>