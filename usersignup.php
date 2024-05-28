<?php require 'header.php'?>
<div class="loginContainer">
  <div id="loginSignupCard">
        <div id="sideCard">
            <p>Have an account?</p>
            <a href="userlogin.php">Log in</a>
        </div>
        <div id="fields">
            <form action="" method="post">
                <div>
                    <label for="fname">First Name: </label>
                    <input type="text" name="fname" id="fname">
                </div>
                <div>
                    <label for="lname">Last Name: </label>
                    <input type="text" name="lname" id="lname">
                </div>
                <div>
                    <label for="contact">Email Address: </label>
                    <input type="text" name="contact" id="contact">
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <label for="confirmPass">Confirm Password: </label>
                    <input type="password" name="confirmPass" id="confirmPass">
                </div>
                <br>
                <button class="loginSignBtn" >Sign up</button> <br>
            </form>
            <?php
require 'includes/database.php';
require 'includes/url.php';
require 'includes/validate.php';
$conn=getDB();
$fname='';
$lname='';
$contact='';
$password='';
$confirmPass='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $contact = $_POST['contact'];
    $password=$_POST['password'];
    $confirmPass=$_POST['confirmPass'];

    if ($fname=='' || $lname=='' || $contact=='' || $password=='' || $confirmPass=='') {
        echo 'One or more fields are empty';
    }
    elseif(validateEmail($contact)==false){
        echo "invalid email address";
    }
    elseif ($password==$confirmPass) {
        $conn = getDB();
        $sql = "INSERT INTO login (fname, lname, contact, password) VALUES (?,?,?,?)";
        $stmt =  mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $contact, $password);
            if (mysqli_stmt_execute($stmt)) {
                redirect("/userlogin.php");
            } else {
                echo mysqli_stmt_error($stmt);
            }
        }
    }else{
        echo 'Passwords dont match';
    }
    
}
?>
        </div>
    </div>
</div>
    <?php require 'footer.php'; ?>

