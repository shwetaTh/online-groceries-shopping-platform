<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link rel="stylesheet" href="includes/loginSignup.css">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
        body {
            margin: 0;
            padding: 0;
            /* background: url(background-image.jpg) no-repeat center center fixed;
            background-size: cover; */
        }
        
        .userprofContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        
        .useredit {
            padding: 20px;
            border: 2px solid #000;
            background-color: #fff;
            max-width: 400px;
        }
        
        .useredit div {
            margin-bottom: 10px;
        }
        
        .useredit label {
            display: inline-block;
            width: 150px;
        }
        
        .useredit input[type="text"],
        .useredit input[type="password"] {
            width: 200px;
        }
        
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .save{
            border: none;
            background-color: #50a872;
            color: #ffffff;
            text-decoration: none;
            margin-left: 10px;
            padding: 10px;
            width: 30%;
        }

        .cancel{
            border: none;
            background-color: rgb(255, 137, 41);
            color: #ffffff;
            text-decoration: none;
            margin-left: 10px;
            padding: 10px;
            width: 30%;
        }
        .button-container-center {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.button-container-center a {
    border: none;
    background-color: #50a872;
    color: #ffffff;
    text-decoration: none;
    margin-left: 10px;
    padding: 10px;
    width: 30%;
    text-align: center;
}
    </style>
</head>
<body>
<header>
    <div class="container">
      <div class="logoburger">
        <div class="burger" >
          <img src="burger.svg" alt="burger" id="burger">
        </div>
        <div class="logo" id="logo">
          <img src="Group 1.svg" alt="logo">
        </div>
      </div>
      
      <div class="search-bar">
        <form action="search.php" method="get">
          <input type="text" name="search" placeholder="Search for products">
          <button type="submit" class="searchBtn">Search</button>
        </form>

      </div>
      <div class="user-profile">
        <?php
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            // User is logged in
            $username = $_SESSION['username'];
        
            // Display the user profile area
            // echo '<a href="/logout.php">Logout</a>';
            echo '<img src="user.svg" alt="user_prof" id="user_prof">';
        }
        else {
          echo '<a href="userlogin.php">Log In</a><a href="usersignup.php">Sign Up</a> ';
          // echo '<ul><li>Log In</li><li>Sign Up</li></ul>';
        } 
        
        ?>
        
      </div>
    </div>
  </header>
<?php
require 'includes/database.php';
require 'includes/validate.php';

$conn = getDB();
        $sql = 'SELECT * FROM login WHERE fname = ?';
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, 's', $_SESSION['username']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
        }
        

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['cancel'])) {
        header('Location: home.php');
    }

    if (isset($_POST['save'])) {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $contact = $_POST['contact'];
        $password=$_POST['password'];
        $confirmPass=$_POST['confirmPass'];
    
        if ($fname=='' || $lname=='' || $contact=='' || $password=='' || $confirmPass=='') {
            echo 'One or more fields are empty';
        }
    
        elseif(validateEmail($contact)==false){
            echo "invalid email";
        }elseif ($password==$confirmPass) {
            $conn = getDB();
            $sql = 'UPDATE login SET fname = ?, lname = ?, contact = ?, password = ? WHERE fname = ?';
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt === false) {
                echo mysqli_error($conn);
            } else {
                mysqli_stmt_bind_param($stmt, 'sssss', $fname, $lname, $contact,$password, $_SESSION['username']);
                mysqli_stmt_execute($stmt);
            }
            // session_destroy();
            // session_start();
            session_unset();
            $username = $_SESSION['username'];
            header("Location:home.php");
        }

    } 
}
//else {
//     if (isset($_GET['id'])) {
//         $product_id = $_GET['id'];
//         $conn = getDB();
//         $sql = 'SELECT * FROM products WHERE product_id = ?';
//         $stmt = mysqli_prepare($conn, $sql);
//         if ($stmt === false) {
//             echo mysqli_error($conn);
//         } else {
//             mysqli_stmt_bind_param($stmt, 'i', $product_id);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);
//             $product = mysqli_fetch_assoc($result);
//         }
//     }
// }
?>
    <div class="userprofContainer">
        <form action="" method="post" class="useredit">
            <div>
                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="<?php echo $user['fname'] ?? ''; ?>">
            </div>
            <div>
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="<?php echo $user['lname'] ?? ''; ?>">
            </div>
            <div>
                <label for="contact">Email:</label>
                <input type="text" name="contact" id="contact" value="<?php echo $user['contact'] ?? ''; ?>">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="<?php echo $user['password'] ?? ''; ?>">
            </div>
            <div>
                <label for="confirmPass">Confirm Password:</label>
                <input type="password" name="confirmPass" id="confirmPass" value="<?php echo $user['password'] ?? ''; ?>">
            </div>
            <br>
            <div class="button-container">
                <button class="save" name="save">Save</button>
                <button class="cancel" name="cancel">Cancel</button>
            </div>
        </form>
    </div>
    <div class="button-container-center">
    <a href="/logout.php">Logout</a>
    <a href="orderDetails.php">View my Order History</a>
</div>
<?php require 'footer.php'; ?>