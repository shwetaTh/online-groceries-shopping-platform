function redirectToHome() {
  window.location.href = '/home.php';
}

const banners = document.querySelectorAll('.banner');
let currentBannerIndex = 0;

function showBanner(index) {
  banners.forEach((banner, idx) => {
    if (idx === index) {
      banner.classList.add('active');
    } else {
      banner.classList.remove('active');
    }
  });
}

function nextBanner() {
  currentBannerIndex++;
  if (currentBannerIndex >= banners.length) {
    currentBannerIndex = 0;
  }
  showBanner(currentBannerIndex);
}
setInterval(nextBanner, 3000);
// var modal = document.getElementById("myModal");
// var loginButton = document.querySelector(".user-profile li:nth-child(1)");
// var signupButton = document.querySelector(".user-profile li:nth-child(2)");
// var closeButton = document.querySelector(".close");
// loginButton.addEventListener("click", function() {
//   openModal("login.php");
// });
// signupButton.addEventListener("click", function() {
//   openModal("signup.php");
// });


// function openModal(url) {
//   var iframe = document.querySelector("iframe");
//   iframe.src = url;
//   modal.style.display = "block";
// }
// closeButton.addEventListener("click", function() {
//   closeModal();
// });
// window.addEventListener("click", function(event) {
//   if (event.target == modal) {
//     closeModal();
//   }
// });
// function closeModal() {
//   var iframe = document.querySelector("iframe");
//   iframe.src = "";
//   modal.style.display = "none";
// }

// var loginForm = document.getElementById('login-form');
// var modal = document.getElementById('myModal');

// function closeModal() {
//     modal.style.display = 'none';
// }