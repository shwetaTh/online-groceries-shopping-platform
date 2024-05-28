<?php require 'header.php'?>
<div class="loginContainer">
  <div id="loginSignupCard">
        <div id="sideCard">
            <p>Join gSmart today</p>
            <a href="usersignup.php">Sign up</a>
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
    $user= getUser($conn, $_POST['contact']);
    if ($user) {
        $user_id = $user['user_id'];
        $fname=$user['fname'];
        $lname=$user['lname'];
        $contact=$user['contact'];
        $password=$user['password'];
    }
    else{
        die("User not found");
    }
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $formContact=$_POST['contact'];
    $formPass=$_POST['password'];
    if ($formContact=='' || $formPass=='') {
        echo 'One or more fields are empty';
    }
    elseif ($formPass==$password) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $fname;
        $_SESSION['user_id'] = $user_id;
        // echo '<script>window.parent.redirectToHome();</script>';
        header("Location:home.php");
        // echo '<script src="home.js"></script>';
        exit;
    }else{
        echo 'invalid';
    }
}
?>
        </div>
    </div>
    </div>
<?php require 'footer.php'; ?>

