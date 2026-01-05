//ey active kaj koranor jnno ancor tag e active class add korate hbe

// eta thik silo
document.addEventListener("DOMContentLoaded", () => {
  const currentPage = window.location.pathname.split("/").pop();
  const navLinks = document.querySelectorAll(".navlink");

  navLinks.forEach((link) => {
    if (link.getAttribute("href") === currentPage) {
      link.classList.add("active");
    }
  });
});

// JavaScript Code (to Show Modal on Page Load)

document.addEventListener("DOMContentLoaded", function () {
  var myModal = new bootstrap.Modal(document.getElementById("myModal"));
  myModal.show();
});

//request slider script home page

let items = document.querySelectorAll(".request-slider .request-slider-item");
let next = document.getElementById("next");
let prev = document.getElementById("prev");

let active = 0;
function loadShow() {
  let stt = 0;
  items[active].style.transform = `none`;
  items[active].style.zIndex = 1;
  items[active].style.filter = "none";
  items[active].style.opacity = 1;
  for (var i = active + 1; i < items.length; i++) {
    stt++;
    items[i].style.transform = `translateX(${240 * stt}px) scale(${
      1 - 0.1 * stt
    }) perspective(16px) rotateY(-1deg)`;
    items[i].style.zIndex = -stt;
    items[i].style.filter = "blur(0px)";
    items[i].style.opacity = stt > 2 ? 0 : 0.6;
  }
  stt = 0;
  for (var i = active - 1; i >= 0; i--) {
    stt++;
    items[i].style.transform = `translateX(${-240 * stt}px) scale(${
      1 - 0.1 * stt
    }) perspective(16px) rotateY(1deg)`;
    items[i].style.zIndex = -stt;
    items[i].style.filter = "blur(0px)";
    items[i].style.opacity = stt > 2 ? 0 : 0.6;
  }
}
loadShow();
next.onclick = function () {
  active = active + 1 < items.length ? active + 1 : active;
  loadShow();
};
prev.onclick = function () {
  active = active - 1 >= 0 ? active - 1 : active;
  loadShow();
};
let direction = "next"; // To track which direction the slider should move
setInterval(function () {
  if (direction === "next") {
    if (active + 1 < items.length) {
      next.click(); // Click next2 if active2 is not the last item
    } else {
      direction = "prev"; // Switch direction if at the end
    }
  } else {
    if (active - 1 >= 0) {
      prev.click(); // Click prev2 if active2 is not the first item
    } else {
      direction = "next"; // Switch direction if at the start
    }
  }
}, 5000); // 5 seconds interval

//request slider script home page starting

let items2 = document.querySelectorAll(".review-slider .review-slider-item");
let next2 = document.getElementById("next2");
let prev2 = document.getElementById("prev2");

let active2 = 0;
function loadShow2() {
  let stt2 = 0;
  items2[active2].style.transform = `none`;
  items2[active2].style.zIndex = 1;
  items2[active2].style.filter = "none";
  items2[active2].style.opacity = 1;
  for (var i = active2 + 1; i < items2.length; i++) {
    stt2++;
    items2[i].style.transform = `translateX(${390 * stt2}px) scale(${
      1 - 0.2 * stt2
    }) perspective(16px) rotateY(.2deg)`;
    items2[i].style.zIndex = -stt2;
    items2[i].style.filter = "blur(0px)";
    items2[i].style.opacity = stt2 > 2 ? 0 : 0.8;
  }
  stt2 = 0;
  for (var i = active2 - 1; i >= 0; i--) {
    stt2++;
    items2[i].style.transform = `translateX(${-390 * stt2}px) scale(${
      1 - 0.2 * stt2
    }) perspective(16px) rotateY(-.2deg)`;
    items2[i].style.zIndex = -stt2;
    items2[i].style.filter = "blur(0px)";
    items2[i].style.opacity = stt2 > 2 ? 0 : 0.8;
  }
}
loadShow2();
next2.onclick = function () {
  active2 = active2 + 1 < items2.length ? active2 + 1 : active2;
  loadShow2();
};
prev2.onclick = function () {
  active2 = active2 - 1 >= 0 ? active2 - 1 : active2;
  loadShow2();
};

// ekhan theke play pause auto next and prev
let direction2 = "next2";
let autoSlideInterval2;
let isPaused2 = false;
function startAutoSlide2() {
  autoSlideInterval2 = setInterval(function () {
    if (direction2 === "next2") {
      if (active2 + 1 < items2.length) {
        next2.click();
      } else {
        direction2 = "prev2";
      }
    } else {
      if (active2 - 1 >= 0) {
        prev2.click();
      } else {
        direction2 = "next2";
      }
    }
  }, 5000);
}
function stopAutoSlide() {
  clearInterval(autoSlideInterval2);
}
pause2.onclick = function () {
  if (isPaused2) {
    startAutoSlide2();
    pause2.innerHTML = '<i class="fa-solid fa-pause"></i>';
  } else {
    stopAutoSlide();
    pause2.innerHTML = '<i class="fa-solid fa-play"></i>';
  }
  isPaused2 = !isPaused2;
};

// Start auto-sliding on load
startAutoSlide2();

// setInterval(function() {
//     if (direction2 === 'next2') {
//         if (active2 + 1 < items2.length) {
//             next2.click();
//         } else {
//             direction2 = 'prev2';
//         }
//     } else {
//         if (active2 - 1 >= 0) {
//             prev2.click();
//         } else {
//             direction2 = 'next2';
//         }
//     }
// }, 5000);

//request slider script home page ending
