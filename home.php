<?php require 'header.php'?>

  <div class="slideshow">
    <div class="banner active">
      <img src="imgs/banner 1.png" alt="">
    </div>
    <div class="banner">
      <img src="imgs/banner 2.png" alt="">
    </div>
    <div class="banner">
      <img src="imgs/banner 3.png" alt="">
    </div>
  </div>
<?php
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
  echo "<p class='welcome'>We are happy to see you, ". $_SESSION['username'] . "!</p>";
}
?>
  <section class="browse-categories">
  <h2>Browse Categories</h2>
  <div class="container">
      
    <div class="category-box">
        
        <div class="category" onclick="navigateToCategory('pantry')">
          <img src="imgs/pantry.jpg" alt="Category 4">
          <p>Pantry</p>
        </div>
        <div class="category" onclick="navigateToCategory('produce')">
          <img src="imgs/fruits.jpg" alt="Category 3">
          <p>Produce</p>
        </div>
        <div class="category" onclick="navigateToCategory('bakery')">
          <img src="imgs/bakery.jpg" alt="Category 5">
          <p>Bakery</p>
        </div>
        <div class="category" onclick="navigateToCategory('snacks')">
          <img src="imgs/snacks.jpg" alt="Category 7">
          <p>Snacks</p>
        </div>
        <div class="category" onclick="navigateToCategory('dairyAndEggs')">
          <img src="imgs/dairy.jpg" alt="Category 9">
          <p>Dairy &amp; Eggs</p>
        </div>
        <div class="category" onclick="navigateToCategory('meatAndSeafood')">
          <img src="imgs/meat.jpg" alt="Category 2">
          <p>Meat &amp; Seafood</p>
        </div>
      </div>
      
    </div>
    <div>
          <a href="categories.php" class="seeall">All Categories</a>
    </div>
  </section>
  <?php require 'footer.php'; ?>

