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
                    <label for="contact">Email: </label> <br>
                    <input type="text" name="contact" id="contact">
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password">
                </div>
                <br>
                <button class="loginSignBtn" type="submit">Log In</button> <br>
            </form>
        </div>
    </div>
    </div>
<?php require 'footer.php'; ?>

