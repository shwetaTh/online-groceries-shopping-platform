<?php?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="includes/loginSignup.css">
<div class="loginContainer">
  <div id="loginSignupCard">
        <div id="sideCard">
            <p>Admin Login</p>
        </div>
        <div id="fields">
            <form action="" method="post" id="login-form">
                <div>
                    <label for="contact">Email: </label>
                    <input type="text" name="contact" id="contact">
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password">
                </div>
                <br>
                <button class="loginSignBtn" type="submit">Log In</button> <br>
            </form>
            <?php
require 'includes/database.php';
require 'includes/validate.php';
require 'includes/url.php';
$conn=getDB();
if (isset($_POST['contact'])) {
    $admin= getAdmin($conn, $_POST['contact']);
    if ($admin) {
        $contact=$admin['email'];
        $password=$admin['password'];
    }
    else{
        die("admin not found");
    }
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $formContact=$_POST['contact'];
    $formPass=$_POST['password'];
    if ($formContact=='' || $formPass=='') {
        echo 'One or more fields are empty';
    }
    elseif ($formPass==$password) {
        // echo '<script>window.parent.redirectToHome();</script>';
        header("Location:adminHome.php");
        // echo '<script src="home.js"></script>';
        exit;
    }else{
        echo 'invalid login';
    }
}
?>
        </div>
    </div>
    </div>