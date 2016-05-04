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
<h2>Setup up your profile</h2>
<p>  Congrats! You are nearly done. Fill out your Address book for a <strong>secure shipping</strong> experience.</p>
</header>
</div>
<div class="6u"><div  class="sectionup">
<!-- register form -->
<form method="post" action="setup_profile" name="addressform">

   
   <fieldset>
<h4> Address Book </h4>
  
    
    <label for="address1">Address 1:</label>
    <input id="address1" class="user_input" type="text" name="address1" placeholder= "Address Line 1"  required />
    
    <label for="address2">Address 2: </label>
    <input id="address2" class="user_input" type="text" name="address2"   placeholder= "Optional Address 2" />
    
    <label for="address3">Address 3: </label>
    <input id="address3" class="user_input" type="text" name="address3"   placeholder= "Optional Address 3" />
    
    <label for="city">City: </label>
    <input id="city" class="user_input" type="text" name="city"   placeholder= "City" required />
     
    <label for="state">State: </label>
    <select name="state">
<option value='Andaman and Nicobar Islands'>Andaman and Nicobar Islands</option>
<option value='Andhra Pradesh'>Andhra Pradesh</option>
<option value='Arunachal Pradesh'>Arunachal Pradesh</option>
<option value='Assam'>Assam</option>
<option value='Bihar'>Bihar</option>
<option value='Chandigarh'>Chandigarh</option>
<option value='Chhattisgarh'>Chhattisgarh</option>
<option value='Dadra and Nagar Haveli'>Dadra and Nagar Haveli</option>
<option value='Daman and Diu'>Daman and Diu</option>
<option value='Delhi'>Delhi</option>
<option value='Goa'>Goa</option>
<option value='Gujarat'>Gujarat</option>
<option value='Haryana'>Haryana</option>
<option value='Himachal Pradesh'>Himachal Pradesh</option>
<option value='Jammu and Kashmir'>Jammu and Kashmir</option>
<option value='Jharkhand'>Jharkhand</option>
<option value='Karnataka'>Karnataka</option>
<option value='Kerala'>Kerala</option>
<option value='Lakshadweep'>Lakshadweep</option>
<option value='Madhya Pradesh'>Madhya Pradesh</option>
<option value='Maharashtra'>Maharashtra</option>
<option value='Manipur'>Manipur</option>
<option value='Meghalaya'>Meghalaya</option>
<option value='Mizoram'>Mizoram</option>
<option value='Nagaland'>Nagaland</option>
<option value='Odisha'>Odisha</option>
<option value='Puducherry'>Puducherry</option>
<option value='Punjab'>Punjab</option>
<option value='Rajasthan'>Rajasthan</option>
<option value='Sikkim'>Sikkim</option>
<option value='Tamil Nadu'>Tamil Nadu</option>
<option value='Telengana'>Telengana</option>
<option value='Tripura'>Tripura</option>
<option value='Uttar Pradesh'>Uttar Pradesh</option>
<option value='Uttarakhand'>Uttarakhand</option>
<option value='West Bengal'>West Bengal</option>
</select>
    <br><br>
    <label for="country">Country: </label>
    <input id="country" class="user_input" type="text" name="country"   value= "India" required />
    <input type="submit"  name="setup2" value="Next" />
</fieldset>
</form>