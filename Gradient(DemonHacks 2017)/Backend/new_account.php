<?php
	print_r($_POST);
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
	
	function add_account($link,  $UserName, $PassWord){
		if(username_taken($link, $UserName)){
			return false;
	        }else{
			
			
			$color1 = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
			$color2 = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
     			$hash = password_hash($PassWord, PASSWORD_DEFAULT);
	        	$stmt = $link->prepare("INSERT INTO users (username, password, oldercolor, newercolor) VALUES (?, ?, ?, ?)");
			$stmt-> bind_param("ssss", $UserName, $hash, $color1, $color2);
			$stmt-> execute();
 			if($stmt){

 				return true;
 			}else{
 			 	echo $stmt->error;
 				return false;
 			}		
 			
 			
 			
		}
	}
	
	function password_is_valid($password){		
		if(strlen($password) > 2){
			$result = true;
		}else{
			$result = false;
		}
		
		return $result;
	}
	
	
	#======================================================================================= Core Logic
	$hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	
	$link = mysqli_connect($hostname, $username, $password, $dbname);
	
	if($link == false){
	        die("Connection failed: " . $link->connect_error);
	}	
	if(isset($_POST["username"]) && isset($_POST["password"])){
		if(username_taken($link, $_POST["username"])){
			echo("Username taken!");
		}else{			
			if(password_is_valid($_POST["password"])){	
				add_account($link, $_POST["username"], $_POST["password"]);
				echo("Your account has been added <a href=\"http://www.programminginitiative.com/gradient/login_form.html\"> Login here </a>");
			}else{
				echo("You can make a better password than that! <a href=\"http://www.programminginitiative.com/gradient/new_account.php\"> Try Again! </a>"");
			}
		}
	}else{
		echo("You done goofeda.");
	}
?>