const carousel = document.getElementById("carousel");
const slides = carousel.querySelectorAll("img");
let currentIndex = 0;

function arrangeSlides() {
  slides.forEach((slide, index) => {
    slide.style.opacity = "0";
    slide.style.transform = "scale(0)";
    slide.style.zIndex = "0";
    slide.style.transition = "all 0.4s ease"; // smooth animation

    if (index === currentIndex) {
      // Center image
      slide.style.transform = "translateX(0) scale(1.5)";
      slide.style.opacity = "1";
      slide.style.zIndex = "3";
    } 
    else if (index === (currentIndex - 1 + slides.length) % slides.length) {
      // Previous image (left)
      slide.style.transform = "translateX(-370px) scale(0.7)"; // more space
      slide.style.opacity = "0.5";
      slide.style.zIndex = "2";
    } 
    else if (index === (currentIndex + 1) % slides.length) {
      // Next image (right)
      slide.style.transform = "translateX(320px) scale(0.7)"; // more space
      slide.style.opacity = "0.5";
      slide.style.zIndex = "1";
    }
  });
}


function nextSlide() {
  currentIndex = (currentIndex + 1) % slides.length;
  arrangeSlides();
}

function prevSlide() {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  arrangeSlides();
}

// Click logic
slides.forEach((slide, index) => {
  slide.addEventListener("click", () => {
    if (index === currentIndex) {
      // If clicking the center image → open modal
      openModal(slide);
    } else {
      // If clicking a side image → move it to center
      currentIndex = index;
      arrangeSlides();
    }
  });
});

// Modal functions
function openModal(img) {
  const modal = document.getElementById("modal");
  const modalImg = document.getElementById("modalImage");

  modalImg.src = img.src; // Set the clicked image
  modal.style.display = "flex";

  // Trigger animation
  setTimeout(() => {
    modal.classList.add("show");
  }, 10);
}
function closeModal() {
  const modal = document.getElementById("modal");
  modal.classList.remove("show");

  // Wait for transition, then hide completely
  setTimeout(() => {
    modal.style.display = "none";
  }, 300);
}

arrangeSlides();

/* --- Swipe Support for Mobile --- */
let startX = 0;
let endX = 0;

carousel.addEventListener("touchstart", (e) => {
  startX = e.touches[0].clientX;
});

carousel.addEventListener("touchend", (e) => {
  endX = e.changedTouches[0].clientX;
  handleSwipe();
});

function handleSwipe() {
  const swipeDistance = endX - startX;

  if (Math.abs(swipeDistance) > 50) { // minimum swipe threshold
    if (swipeDistance < 0) {
      nextSlide(); // Swipe left → next
    } else {
      prevSlide(); // Swipe right → previous
    }
  }
}


























// Service modal handling
document.querySelectorAll('.services-list-modal li').forEach(item => {
  item.addEventListener('click', () => {
    const file = item.getAttribute('data-file');
    fetch(file)
      .then(response => response.text())
      .then(data => {
        document.getElementById('modal-body').innerHTML = data;
        document.getElementById('serviceModal').style.display = 'flex';
      })
      .catch(() => {
        document.getElementById('modal-body').innerHTML = "<p>Error loading content.</p>";
        document.getElementById('serviceModal').style.display = 'flex';
      });
  });
});
document.querySelector('.service-modal-close').addEventListener('click', () => {
  document.getElementById('serviceModal').style.display = 'none';
});