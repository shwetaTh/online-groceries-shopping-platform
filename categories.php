<?php require 'header.php'?>
  
  <section class="browse-categories">
  <h2>Browse Categories</h2>
  <div class="container">
      
    <div class="category-box">
        <div class="category" onclick="navigateToCategory('pantry')">
          <img src="imgs/pantry.jpg" alt="Category 4">
          <p>Pantry</p>
          <p class="category-description">Essential items for your pantry</p>
        </div>   
        <div class="category" onclick="navigateToCategory('produce')">
          <img src="imgs/fruits.jpg" alt="Category 3">
          <p>Produce</p>
          <p class="category-description">Fresh fruits and vegetables</p>
        </div>
        <div class="category" onclick="navigateToCategory('bakery')">
          <img src="imgs/bakery.jpg" alt="Category 5">
          <p>Bakery</p>
          <p class="category-description">Freshly baked goodies</p>
        </div> 
        <div class="category" onclick="navigateToCategory('snacks')">
          <img src="imgs/snacks.jpg" alt="Category 7">
          <p>Snacks</p>
          <p class="category-description">Tasty and satisfying snack options</p>
        </div>
        <div class="category" onclick="navigateToCategory('dairyAndEggs')">
          <img src="imgs/dairy.jpg" alt="Category 9">
          <p>Dairy &amp; Eggs</p>
          <p class="category-description">Fresh dairy products and eggs</p>
        </div> 
        <div class="category" onclick="navigateToCategory('meatAndSeafood')">
          <img src="imgs/meat.jpg" alt="Category 2">
          <p>Meat &amp; Seafood</p>
          <p class="category-description">Quality meats and seafood</p>
        </div> 
        <div class="category" onclick="navigateToCategory('beverages')">
          <img src="imgs/beverages.jpg" alt="Category 6">
          <p>Beverages</p>
          <p class="category-description">A wide range of refreshing beverages</p>
        </div>
        <div class="category" onclick="navigateToCategory('frozenSection')">
          <img src="imgs/frozen.jpg" alt="Category 8">
          <p>Frozen Section</p>
          <p class="category-description">Convenient and frozen food choices</p>
        </div>
        <div class="category" onclick="navigateToCategory('toiletries')">
          <img src="imgs/Toiletries.jpg" alt="Category 2">
          <p>Toiletries</p>
          <p class="category-description">Personal care and cleaning items</p>
        </div>  
      </div>
      
    </div>
    <!-- <div>
          <a href="categories.php" class="seeall">All Categories</a>
    </div> -->
  </section>
  


<?php require 'footer.php'; ?>
