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
  animation-play-state: running;
}

.animate-slide:hover {
  animation-play-state: paused;
}
`;
document.head.appendChild(style);

function toggleContactSection() {
  const section = document.getElementById('contactSection');
  section.classList.toggle('hidden');
}

function sendWhatsApp() {
  const msg = document.getElementById('whatsappMessage').value.trim();
  const phone = "212677864237";

  if (msg) {
    const encoded = encodeURIComponent(msg);
    const url = `https://wa.me/${phone}?text=${encoded}`;

    // SweetAlert de confirmation avant envoi
    Swal.fire({
      title: 'Envoyer ce message via WhatsApp ?',
      text: `"${msg}"`,
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#10B981', // Vert
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, envoyer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        window.open(url, '_blank');
        document.getElementById('whatsappMessage').value = '';

        // Message de succès
        Swal.fire({
          icon: 'success',
          title: 'Message envoyé !',
          text: 'WhatsApp a été ouvert avec votre message.',
          timer: 2000,
          showConfirmButton: false
        });

        closeContactSection();
      }
    });

  } else {
    // Alerte d'erreur si message vide
    Swal.fire({
      icon: 'warning',
      title: 'Message vide',
      text: 'Écris un message avant d’envoyer.'
    });
  }
}

function closeContactSection() {
  document.getElementById('contactSection').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', function () {
    mobileMenu.classList.toggle('hidden');
  });
});