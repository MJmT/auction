<?php
// show potential errors / feedback (from user object)
 include_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/layout/layout_header.php');
 include_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/user/views/profile_template.php');
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
<h2>Setup up your profile</h2>
<p> Fill in the below data <strong>to get started</strong>.</p>
</header>
</div>
<div class="6u"><div  class="sectionup">
                                           
<form method="post" action="setup_profile" name="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
   
   <fieldset>
   <label for="input_username">Username : </label><?php echo $_SESSION['user_name'];?>
    <!-- the email input field uses a HTML5 email type check -->
   
    <label for="user_input_email">Email :</label>
    <input id="user_input_email" class="user_input" type="email" name="user_email" value="<?php echo $_SESSION['user_email'];?>" required />
   
    
    <input id="user_input_fname" class="user_input" type="text" name="user_fname"   placeholder= "First Name"  required />
    
    
    <input id="user_input_lname" class="user_input" type="text" name="user_lname"  placeholder= "Last Name"  required />
    
     <input id="user_input_mobile" class="user_input" type="text" name="user_mobile" pattern="[0-9]*" placeholder= "10 digit mobile number"  required />
    <input type="submit"  name="setup" value="Next" />
</fieldset>
</form>
