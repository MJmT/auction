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
>
<!-- register form -->
<form method="post" action="setup_profile" name="addressform">

    Congrats! You are nearly done. Fill out your Address book for a secure shipping experience.
   <fieldset>
<h4> Address Book </h4>
  
    <br><br>
    <label for="address1">Email :</label>
    <input id="address1" class="user_input" type="email" name="user_email" value="<?php echo $_SESSION['user_email'];?>" required />
    <br><br>
    <label for="user_input_fname">First Name: </label>
    <input id="user_input_fname" class="user_input" type="text" name="user_fname"   placeholder= "First Name"  required />
    <br><br>
    <label for="user_input_lname">Last Name: </label>
    <input id="user_input_lname" class="user_input" type="text" name="user_lname"  placeholder= "Last Name"  required />
     <label for="user_input_mobile">Mobile Number: </label>
     <input id="user_input_mobile" class="user_input" type="text" name="user_mobile" pattern="[0-9]*" placeholder= "10 digit mobile number"  required />
    <input type="submit"  name="setup2" value="Next" />
</fieldset>
</form>