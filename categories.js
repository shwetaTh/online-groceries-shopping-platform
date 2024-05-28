function redirectToHome() {
    window.location.href = '/home.php';
}

document.getElementById('test').addEventListener("click", function(){
  window.location.href = '/categories.php';
})

document.getElementById('home').addEventListener("click", function(){
  redirectToHome();
})