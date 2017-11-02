<?php   
	session_start();
	$hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	$link = mysqli_connect($hostname, $username, $password, $dbname);
		
	#=========================================================================SWAP CODE
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
	
	#Currently set to 3 minutes for Demo purposes
	function swapped_in_past_24_hours($link, $usernameA, $usernameB){
		$stmt = $link->prepare("SELECT * FROM transactions WHERE usernameA = ? AND usernameB = ? AND timestamp >= DATE_SUB(NOW(), INTERVAL 3 MINUTE) ORDER BY timestamp DESC LIMIT 1");
			
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
	
	#=========================================================================GEO CODE
	if(isset($_POST["username"]) && isset($_POST["latitude"]) && isset($_POST["longitude"])){		

		$stmt = $link->prepare("UPDATE users SET latitude=?, longitude=? WHERE username = ?");
				
		if ( false===$stmt ) {
		  die('MN prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				

		$rc = $stmt->bind_param("dds", $_POST["latitude"], $_POST["longitude"], $_POST["username"]);
		if ( false===$rc ) {
		  die('MN bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('MN execute() failed: ' . htmlspecialchars($stmt->error));
		}


		#The 2 is choosen as to exclude the phone only finding itself
		$stmt = $link->prepare("SELECT username FROM users ORDER BY ABS(latitude - ?), ABS(longitude - ?) ASC LIMIT 1, 1");
				
		if ( false===$stmt ) {
		  die('MN prepare() failed: ' . htmlspecialchars($mysqli->error));
		}				

		$rc = $stmt->bind_param("dd", $_POST["latitude"], $_POST["longitude"]);
		if ( false===$rc ) {
		  die('MN bind_param() failed: ' . htmlspecialchars($stmt->error));
		}
		$rc= $stmt->execute();
		if ( false===$rc ) {
		  die('MN execute() failed: ' . htmlspecialchars($stmt->error));
		}
		
		$stmt->store_result();
		$stmt->bind_result($result);
		$stmt->fetch();
		
		swap($link, $result, $_POST["username"]);
	}else{
		echo("Missing arguments.");
	}
?>