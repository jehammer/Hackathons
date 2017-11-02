<?php
	session_start();
	$data = array(session_id  => session_id());
	header('Content-Type: application/json');

        $hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	$link = mysqli_connect($hostname, $username, $password, $dbname);
	
	function getUserID($link, $searchForName){
		$stmt = $link->prepare("SELECT userID FROM users WHERE username = ?");	
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $searchForName);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
				
		$stmt->store_result();
		$stmt->bind_result($user_id);
		$stmt->fetch();

		return $user_id;
	}
	
	function verify($link, $UserName, $PasswordAttempt){
		if(username_taken($link, $UserName)){
			$stmt = $link->prepare("SELECT password FROM users WHERE username = ?");	
		
			if ( false===$stmt ) {
			  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
			}				
			$rc = $stmt->bind_param("s", $UserName);
			if ( false===$rc ) {
			  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
			}
			$rc= $stmt->execute();
			if ( false===$rc ) {
			  die('execute() failed: ' . htmlspecialchars($stmt->error));
			}
			
			$stmt->store_result();
			$stmt->bind_result($hash);
			$stmt->fetch();
			
			if (password_verify($PasswordAttempt, $hash)) {
				return true;
			} else {
				return false;
			}
		}else{
			return false;
		}
	}
	
	function username_taken($link, $UserName){
		$stmt = $link->prepare("SELECT username FROM users WHERE username = ?");	
		
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $UserName);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
		
		$result;
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();

		if($stmt->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}
	
	if($link == false){
	        die("Connection failed: " . $link->connect_error);
	}
	
	if (isset($_POST["username"]) && isset($_POST["password"])){
		if(verify($link, ($_POST["username"]), ($_POST["password"]))){
			$_SESSION['username'] = $_POST["username"];
                 	$_SESSION['userID'] = getUserID($link, $_POST["username"]);
		
			echo(json_encode($data));
		}else{
			echo("Incorrect username/password");
			session_destroy();
		}
	}else{
		echo("Error: Missing arguments");

		if(!isset($_POST["username"])){
			echo("Missing username");
		}
		if(!isset($_POST["password"])){
			echo("Missing password");
		}
	}

	mysqli_close($link);
?>