

<div class="signup">
<h1>Sign Up</h1>
<!-- register form -->
<form method="post" action="register.php" name="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
    
    <input id="login_input_username" placeholder="Username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" />

    <!-- the email input field uses a HTML5 email type check -->

    <input id="login_input_email" placeholder="Email" class="login_input" type="email" name="user_email" required />

    
    <input id="login_input_password_new" placeholder="Password" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

   
    <input id="login_input_password_repeat" placeholder="Password repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <input type="submit"  name="register" value="Register" />

</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>
