<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link rel="stylesheet" href="includes/loginSignup.css">
<link rel="stylesheet" type="text/css" href="style.css">
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
            echo '<div class="headerImgs">';
            // echo '<span id="cart-item-count"></span>';
            echo '<a class="cart" href="cart.php"><img src="cart.svg" alt="cart" id="cart"></a>';
            echo '<img src="user.svg" alt="user_prof" id="user_prof">';
            echo '</div>';
            echo '<div id="popup" class="popup">Added to cart successfully</div>';
        }
        else {
          echo '<a class="headerA" href="userlogin.php">Log In</a><a class="headerA" href="usersignup.php">Sign Up</a> ';
          // echo '<ul><li>Log In</li><li>Sign Up</li></ul>';
        } 
        ?>
        
      </div>
    </div>

  </header>
