<?php require 'header.php';?>
<div id="login-form">


<div id="fields">

<?php
  if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    echo '<div class="checkout-form">';
    echo '<h2>Checkout</h2>';
    echo '<form action="processOrder.php" method="post">';
    
    echo '<div>';

    echo '<label for="full_name">Full Name:</label> <br>';
    echo '<input type="text" class="inp" id="full_name" name="full_name" required><br>';

    echo '</div>';


    echo '<div>';

    echo '<label for="city">City: </label> <br>';
    echo ' <input type="text" name="city" class="inp" id="city" required> <br>';

    echo '</div>';

    echo '<div>';

    echo '<label for="street_address">Street Address: </label> <br>';
    echo ' <input type="text" name="street_address" class="inp" id="street_address" required> <br>';

    echo '</div>';

    echo '<div>';

    echo '<label for="contact">Contact: </label> <br>';
    echo ' <input type="text" name="contact" class="inp" id="contact" required> <br>';

    echo '</div>';

    echo '<div>';

    echo '<label for="nearest_landmark">Nearest Landmark: </label> <br>';
    echo ' <input type="text" name="nearest_landmark" class="inp" id="nearest_landmark" required> <br>';

    echo '</div>';

    echo '<div>';

    echo '<label for="additional_message">Additional Message: </label> <br>';
    echo ' <input type="text" name="additional_message" class="inp" id="additional_message"> <br> <br>';

    echo '</div>';

    echo '<button type="submit" class="loginSignBtn">Proceed</button>';
    echo '</form>';
    echo '</div>';
  } else {
    echo '<p>Please log in or sign up to proceed with the checkout.</p>';
  }
  ?>
</div> 
</div>
<?php require 'footer.php';?>