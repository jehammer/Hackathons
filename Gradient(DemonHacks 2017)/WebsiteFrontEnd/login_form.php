<!DOCTYPE HTML>
<html>
<head>
<title>Gradient Login</title>
<style>
        body
                {
                            
                 background: -webkit-linear-gradient(#FC466B, #3F5EFB);
                 background: -moz-linear-gradient(#FC466B, #3F5EFB);
                 background: -o-linear-gradient(#FC466B, #3F5EFB);
                 background: linear-gradient(#FC466B, #3F5EFB);
                 margin:auto;
                 width: 100%;
                 height: 100%;
                 background-repeat: no-repeat;
                 background-attachment: fixed;
                 font-size: 20px;
                 vertical-align: middle
        
                }
        html 
            {
                height: 100%;
            }
        #cen
        {
            width: 220px;
            height: 100px;
            position: absolute;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
        form 
        {
            margin:0 auto;
            width:300px
        }
        input 
        {
            margin-bottom:3px;
            padding:10px;
            width: 100%;
            border:1px solid #CCC
        }
        button 
        {
            padding:10px
        }
        label 
        {
            cursor:pointer
        }
        #form-switch 
        {
            display:none
        }
        #register-form 
        {
            display:none
        }
        #form-switch:checked~#register-form 
        {
            display:block
        }
        #form-switch:checked~#login-form 
        {
            display:none
        }
</style>

<script src="jquery-3.2.1.js"></script>
</head>
<body>
<div id="cen">
<input type='checkbox' id='form-switch'>
<form id='login-form' action="http://programminginitiative.com/gradient/login.php" method='post'>
  <input type="text" placeholder="Username" id="username" name="username" required>
  <input type="password" placeholder="Password" id="password" name="password" required>
  <button type='submit'>Login</button>
  <label for='form-switch'><span>Register</span></label>
  
</form>

<form id='register-form' action="http://programminginitiative.com/gradient/new_account.php" method='post'>
  <input type="text" placeholder="Username" id="username" name="username" required>
  <input type="password" placeholder="Password" id="password" name="password" required>
  <button type='submit'>Register</button>
  <label for='form-switch'>Already Member ? Sign In!</label>
</form>
</div>

<script>
    $(document).ready(function(){
        $('#cen').hide().fadeIn(1000);
    });
</script>
</body>
</html>