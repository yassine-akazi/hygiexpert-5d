document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function(event) {
      if (password.value !== confirmPassword.value) {
        event.preventDefault(); // Empêche l'envoi du formulaire
        errorMessage.style.display = 'block';
      } else {
        errorMessage.style.display = 'none';
      }
    });

    // Cacher l'erreur quand l'utilisateur tape dans les champs password
    password.addEventListener('input', () => errorMessage.style.display = 'none');
    confirmPassword.addEventListener('input', () => errorMessage.style.display = 'none');
  });

    window.togglePassword = function (inputId, button) {
      const input = document.getElementById(inputId);
      const isPassword = input.type === "password";
  
      input.type = isPassword ? "text" : "password";
  
      // Optionnel : changer l’icône si tu veux
      button.innerHTML = isPassword
          ? `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-eye-icon">
                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696
                10.75 10.75 0 0 1-19.876 0" />
                <circle cx="12" cy="12" r="3" />
            </svg>`
          : `
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-eye-closed-icon">
                <path d="m15 18-.722-3.25"/>
                <path d="M2 8a10.645 10.645 0 0 0 20 0"/>
                <path d="m20 15-1.726-2.05"/>
                <path d="m4 15 1.726-2.05"/>
                <path d="m9 18 .722-3.25"/>
            </svg>`;
  }