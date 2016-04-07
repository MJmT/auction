<?php
// show potential errors / feedback (from user object)
if (isset($user)) {
    if ($user->errors) {
        foreach ($user->errors as $error) {
            echo $error;
        }
    }
    if ($user->messages) {
        foreach ($user->messages as $message) {
            echo $message;
        }
    }
}

?>
<!-- register form -->
<form method="post" action="setup_profile" name="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
    Hey <?php echo $_SESSION['user_name'] ?>, please take a moment to verify and complete your profile data.
   <label for="input_username">Username : </label><?php echo $_SESSION['user_name'];?>
    <!-- the email input field uses a HTML5 email type check -->
    <br><br>
    <label for="user_input_email">Email :</label>
    <input id="user_input_email" class="user_input" type="email" name="user_email" value="<?php echo $_SESSION['user_email'];?>" required />
    <br><br>
    <label for="user_input_fname">First Name: </label>
    <input id="user_input_fname" class="user_input" type="text" name="user_fname" pattern="[a-zA-Z ]{2,64}" placeholder= "First Name"  required />
    <br><br>
    <label for="user_input_lname">Last Name: </label>
    <input id="user_input_lname" class="user_input" type="text" name="user_lname" pattern="[a-zA-Z ]{2,64}" placeholder= "Last Name"  required />
     <label for="user_input_mobile">Mobile Number: </label>
     <input id="user_input_mobile" class="user_input" type="text" name="user_mobile" pattern="[0-9]*" placeholder= "10 digit mobile number"  required />
    <input type="submit"  name="setup" value="Next" />

</form>
