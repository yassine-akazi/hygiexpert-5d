let currentSlide = 0;
  const slider = document.getElementById('heroSlider');
  const slides = slider.children;
  const totalSlides = slides.length;

  setInterval(() => {
    currentSlide = (currentSlide + 1) % totalSlides;
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
  }, 5000); // change every 5 seconds

  document.addEventListener('DOMContentLoaded', function () {
    // Coordonnées HYGIEXPERT 5D (exemple : Agadir, Maroc)
    var lat = 30.427755;
    var lon = -9.598107;

    var map = L.map('mapid').setView([lat, lon], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map)
      .bindPopup('HYGIEXPERT 5D - Notre siège')
      .openPopup();
  });

  document.getElementById('menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });