# Backend

API: Make any HTTP Calls to the following files (input/output shown)
Note: The URL is currently: http://programminginitiative.com/gradient/*
(i.e. http://programminginitiative.com/gradient/upload_post.php)
Subject to change

//==================================================================ACCOUNTS
- new_account.php   (Expects 'username' and 'password' through POST)
- login.php (Expects 'username' and 'password' through POST, echos 'session_id' in JSON)

//==================================================================POSTS
- upload_post.php (Expects 'session_id', 'text' through POST)
- get_most_recent_post.php (Expects 'username' through POST, echos JSON in the following format: {"username":"Kyle","text":"This is from the database!","colorA":"#AB024FE","colorB":"#FF00FF"}
- swap.php (Expects 'usernameA', 'usernameB' through POST)
- get_feed.php (Expects 'username' through POST, echos JSON in the following format: {arr:[{"postID":"4","timestamp":"2017-10-28 22:54:04","username":"Test","text":"This is from a test account!","colorA":"#555333","colorB":"#A0A0A0"},{"postID":"5","timestamp":"2017-10-28 23:31:35","username":"Test","text":"fefefe","colorA":"#ae59f3","colorB":"#00db00"}]}
