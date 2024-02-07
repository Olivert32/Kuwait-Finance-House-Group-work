let burger = document.querySelector(".burger");
let nav = document.querySelector("nav");
let isOpen = 0;

burger.addEventListener("click", toggleMenu);

function toggleMenu() {
  if (isOpen == 0) {
    nav.classList.add("active");
    isOpen = 1;
  } else {
    nav.classList.remove("active");
    isOpen = 0;
  }
}

// Get the carousel element
const carousel = document.querySelector(".carousel");
// Get all the images in the carousel
const images = carousel.querySelectorAll("img");
// Set the current image index to 0
let currentIndex = 0;

// Define a function to show the next image
function showNextImage() {
  // Hide the current image
  images[currentIndex].classList.remove("active");
  // Increment the index, wrapping around if necessary
  currentIndex = (currentIndex + 1) % images.length;
  // Show the next image
  images[currentIndex].classList.add("active");
}

// Add the "active" class to the first image
images[currentIndex].classList.add("active");

// Call the showNextImage function every 3 seconds
setInterval(showNextImage, 3000);