<?php   
	session_start();
	$hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	$link = mysqli_connect($hostname, $username, $password, $dbname);
	
	function set_older_color($link, $username, $newValue){
		$stmt = $link->prepare("UPDATE users SET oldercolor = ? WHERE username = ?");	
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("ss", $newValue, $username);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
	}
	function set_newer_color($link, $username, $newValue){
		$stmt = $link->prepare("UPDATE users SET newercolor = ? WHERE username = ?");	
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("ss", $newValue, $username);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
	}
	
	function get_older_color($link, $username){
		$stmt = $link->prepare("SELECT oldercolor FROM users WHERE username = ?");	
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $username);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
		
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		
		return $result;
	
	}
	
	function get_newer_color($link, $username){
		$stmt = $link->prepare("SELECT newercolor FROM users WHERE username = ?");	
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $username);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
		
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		
		return $result;
	}
	
	function swap_colors($link, $usernameA, $usernameB){
		set_older_color($link, $usernameA, get_newer_color($link, $usernameA));
		set_newer_color($link, $usernameA, get_newer_color($link, $usernameB));
		set_older_color($link, $usernameB, get_newer_color($link, $usernameA));
		set_newer_color($link, $usernameB, get_older_color($link, $usernameA));
	}
	
	function get_most_recent_postID($link, $username){
		$stmt = $link->prepare("SELECT postID FROM posts WHERE username = ? ORDER BY timestamp DESC LIMIT 1");	
			
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("s", $username);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}

		$stmt->store_result();
		$stmt->bind_result($postID);
		$stmt->fetch();
		
		return $postID;
	}
	
	function add_to_feed($link, $feedOwnerUsername, $postID){
		$stmt = $link->prepare("INSERT INTO feed (postID, username) VALUES (?, ?)");
			
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("ss", $postID, $feedOwnerUsername);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
	}
	
	function add_transaction($link, $usernameA, $usernameB){
		$stmt = $link->prepare("INSERT INTO transactions (usernameA, usernameB) VALUES (?, ?)");
			
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("ss", $usernameA, $usernameB);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
	}

	function swapped_in_past_24_hours($link, $usernameA, $usernameB){
		$stmt = $link->prepare("SELECT * FROM transactions WHERE usernameA = ? AND usernameB = ? AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY timestamp DESC LIMIT 1");
			
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("ss", $usernameA, $usernameB);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
				
		$stmt->store_result();
		
		$rowsFoundInOrder1 = mysqli_stmt_num_rows($stmt);
		
		$stmt = $link->prepare("SELECT * FROM transactions WHERE usernameA = ? AND usernameB = ? AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY timestamp DESC LIMIT 1");
			
		if ( false===$stmt ) {
		  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				
		$rc = $stmt->bind_param("ss", $usernameB, $usernameA);
		if ( false===$rc ) {
		  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('execute() failed: ' . htmlspecialchars($stmt->error));
		}
				
		$stmt->store_result();
		$rowsFoundInOrder2 = mysqli_stmt_num_rows($stmt);

		if($rowsFoundInOrder1 + $rowsFoundInOrder2 > 0){
			return true;
		}else{
			return false;
		}
	}
  	
	function swap($link, $usernameA, $usernameB){
		if(swapped_in_past_24_hours($link, $usernameA,$usernameB)){
			echo($usernameA." and ".$usernameB." have swapped in the past 24 hours!");
		}else{
			add_transaction($link, $usernameA, $usernameB);
			add_to_feed($link, $usernameA, get_most_recent_postID($link, $usernameB));
			add_to_feed($link, $usernameB, get_most_recent_postID($link, $usernameA));
			swap_colors($link, $usernameA, $usernameB);
		}

	
	}
	
	
	$sql = "SELECT username FROM users ORDER BY RAND() LIMIT 1";
	$result = mysqli_query($link, $sql); 
	$result= $result->fetch_assoc();
	$username1 = $result["username"];
	
	$sql = "SELECT username FROM users ORDER BY RAND() LIMIT 1";
	$result = mysqli_query($link, $sql); 
	$result= $result->fetch_assoc();
	$username2 = $result["username"];

	if($username1 != $username2){
		swap($link, $username1, $username2);
	}
?>