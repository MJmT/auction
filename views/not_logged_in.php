
<?php
// show potential errors / feedback (from login object)
 
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
          echo "<div class=\"alert alert-danger\">" .$error . "</div>";
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo "<div class=\"alert alert-success\">" .$message . "</div>";
        }
    }
}


// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo "<div class=\"alert alert-danger\">" .$error . "</div>";
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo "<div class=\"alert alert-success\">" .$message . "</div>";
        }
    }
}
?>

<div id="banner">
                                <div class="content">
                                <h2 class="heading"><strong>Auctionaire</strong></h2>
                                <div class="para"> Where the world comes to Auction! 
                            </div></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>

                    

<?php
include('login.php');
include('register.php');


?>
