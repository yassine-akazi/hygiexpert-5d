document.addEventListener('DOMContentLoaded', function () {
  const slider = document.getElementById('heroSlider');
  const slides = slider.children;
  const totalSlides = slides.length;
  const buttons = document.querySelectorAll('.slider-btn');

  let currentSlide = 0;
  let interval = setInterval(nextSlide, 5000);

  function updateSlider() {
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
    buttons.forEach((btn, index) => {
      btn.classList.toggle('bg-indigo-500', index === currentSlide);
      btn.classList.toggle('text-white', index === currentSlide);
      btn.classList.toggle('bg-white/80', index !== currentSlide);
      btn.classList.toggle('text-gray-700', index !== currentSlide);
    });
  }

  function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateSlider();
  }

  buttons.forEach(button => {
    button.addEventListener('click', () => {
      currentSlide = parseInt(button.getAttribute('data-slide'));
      updateSlider();
      resetInterval();
    });
  });

  function resetInterval() {
    clearInterval(interval);
    interval = setInterval(nextSlide, 5000);
  }

  updateSlider(); // initial
});

  const style = document.createElement('style');
style.textContent = `
@keyframes slide {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

.animate-slide {
  animation: slide 10s linear infinite;
}
`;
document.head.appendChild(style);