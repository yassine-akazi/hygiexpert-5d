document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('registerForm');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('password_confirmation');
  const errorMessage = document.getElementById('error-message');

  form.addEventListener('submit', function(event) {
    // Vérifier si les deux mots de passe sont identiques
    if (password.value !== confirmPassword.value) {
      event.preventDefault(); // Empêche la soumission du formulaire
      errorMessage.style.display = 'block'; // Affiche le message d'erreur
    } else {
      errorMessage.style.display = 'none'; // Cache le message d'erreur
    }
  });

  // Dès que l'utilisateur tape dans l'un des champs, cacher le message d'erreur
  password.addEventListener('input', () => errorMessage.style.display = 'none');
  confirmPassword.addEventListener('input', () => errorMessage.style.display = 'none');
});

// Fonction pour basculer l’affichage du mot de passe (texte / points)
window.togglePassword = function (inputId, button) {
  const input = document.getElementById(inputId);
  const isPassword = input.type === "password";

  // Changer le type d'input entre "password" et "text"
  input.type = isPassword ? "text" : "password";

  // Changer l'icône du bouton selon l’état (œil ouvert / œil fermé)
  button.innerHTML = isPassword
    ? `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-eye-closed-icon">
          <path d="m15 18-.722-3.25"/>
          <path d="M2 8a10.645 10.645 0 0 0 20 0"/>
          <path d="m20 15-1.726-2.05"/>
          <path d="m4 15 1.726-2.05"/>
          <path d="m9 18 .722-3.25"/>
      </svg>
    `
    : `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-eye-icon">
          <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696
          10.75 10.75 0 0 1-19.876 0" />
          <circle cx="12" cy="12" r="3" />
      </svg>`;
}
if (window.location.hash === '#errors') {
  const form = document.getElementById('registerForm');
  if (form) {
      form.scrollIntoView({ behavior: 'smooth' });
  }
}

