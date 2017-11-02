<?php   
	session_start();
	$hostname = "Localhost";
	$username = "pi_api";
	$password = "apipassword";
	$dbname = "pi_gradient";
	$link = mysqli_connect($hostname, $username, $password, $dbname);
	
	
	$sql = "SELECT * FROM posts ORDER BY RAND() LIMIT 1";
	$result = mysqli_query($link, $sql); 
	$result= $result->fetch_assoc();
	
	echo($result["text"]);
?>

<!DOCTYPE HTML>
<html>
        <head>
            <title>Gradient</title>
            <style>
                body
                    {
                                background: -webkit-linear-gradient(<?php echo($result["colorA"]); ?> , <?php echo($result["colorB"]); ?>);
                                background: -moz-linear-gradient(<?php echo($result["colorA"]); ?>, <?php echo($result["colorB"]); ?>);
                                background: -o-linear-gradient(<?php echo($result["colorA"]); ?>, <?php echo($result["colorB"]); ?>);
                                background: linear-gradient(<?php echo($result["colorA"]); ?>, <?php echo($result["colorB"]); ?>);
                                margin:auto;
                                width: 100%;
                                height: 100%;
                                margin: auto;
                                background-repeat: no-repeat;
                                background-attachment: fixed;
				verticle-align: middle;
				width: 220px;
				height: 100px;
				position: absolute;
				top:0;
           			bottom: 0;
            			left: 0;
           			right: 0;
				font-size:20px;
                        
                    }

            </style> 
            <script>
                const express = require('express')
                const app = express()
            </script>

        </head>

        <body>
            <article>
                <form action="http://programminginitiative.com/gradient/main.php">
                    <input type="submit" name="insert" value="Next!" onclick="insert()" />
                </form>
                    <script>
                        $(document).ready(function(){
                            
                            $('#but').on('click', 
                            });
                        });
                        
                    </script>
            </article>
        </body>


        <!--
// Detect which browser prefix to use for the specified CSS value
// (e.g., background-image: -moz-linear-gradient(...);
//        background-image:   -o-linear-gradient(...); etc).
//
function getCssValuePrefix()
{
    var rtrnVal = '';//default to standard syntax
    var prefixes = ['-o-', '-ms-', '-moz-', '-webkit-'];
    // Create a temporary DOM object for testing
    var dom = document.createElement('div');
    for (var i = 0; i < prefixes.length; i++)
    {
        // Attempt to set the style
        dom.style.background = prefixes[i] + 'linear-gradient(#000000, #ffffff)';
        // Detect if the style was successfully set
        if (dom.style.background)
        {
            rtrnVal = prefixes[i];
        }
    }
    dom = null;
    delete dom;
    return rtrnVal;
}
// Setting the gradient with the proper prefix
dom.style.backgroundImage = getCssValuePrefix() + 'linear-gradient('
        + orientation + ', ' + colorOne + ', ' + colorTwo + ')';
    -->

</html>