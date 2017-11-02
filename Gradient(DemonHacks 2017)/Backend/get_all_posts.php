<?php
	$hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	$link = mysqli_connect($hostname, $username, $password, $dbname);
	
	$myArray = array();
	if ($result = $link->query("SELECT * FROM posts ORDER BY timestamp DESC")) {
	    while($row = $result->fetch_array(MYSQL_ASSOC)) {
	            $myArray[] = $row;
    		}	

    		echo("{arr:".json_encode($myArray)."}");
	}
?>