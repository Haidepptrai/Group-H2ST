  const carouselContainer = document.querySelector('.carousel-container');
  const carouselSlides = document.querySelectorAll('.carousel-slide');
  const slideWidth = carouselSlides[0].clientWidth; // Assumes all slides have the same width
  let slideIndex = 0;

  function showSlide(index) {
    carouselContainer.style.transform = `translateX(-${slideWidth * index}px)`;
  }

  function nextSlide() {
    slideIndex++;
    if (slideIndex >= carouselSlides.length) {
      slideIndex = 0;
    }
    showSlide(slideIndex);
  }

  function prevSlide() {
    slideIndex--;
    if (slideIndex < 0) {
      slideIndex = carouselSlides.length - 1;
    }
    showSlide(slideIndex);
  }

  setInterval(nextSlide, 3000); // Auto slide every 3 seconds
