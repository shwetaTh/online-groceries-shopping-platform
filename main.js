
const burgerIcon = document.querySelector('#burger');
const menu = document.querySelector('.menu');
const close = document.querySelector('.close-button');

burgerIcon.addEventListener('click', () => {
  menu.classList.toggle('active');
});

close.addEventListener('click', () => {
  menu.classList.remove('active');
});
window.addEventListener('click', (event) => {
    if (!menu.contains(event.target) && !burgerIcon.contains(event.target)) {
      menu.classList.remove('active');
    }
  });
document.querySelector('#logo').addEventListener('click', function(){
  window.location.href="/home.php";
})

function navigateToCategory(category) {
  window.location.href = 'category.php?category=' + category;
}

document.getElementById('user_prof').addEventListener('click', function(){
  window.location.href= 'user.php';
})

function showPopup() {
  var popup = document.getElementById("popup");
  popup.style.display = "block";
  setTimeout(function() {
    popup.style.display = "none";
  }, 2000); // 2000ms = 2 seconds
}