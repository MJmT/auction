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
<p>You've successfully completed this one time setup!! </p>
</header>
</div>