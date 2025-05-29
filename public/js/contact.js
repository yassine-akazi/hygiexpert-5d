function updateCharCount() {
    const textarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const length = textarea.value.length;

    charCount.textContent = `${length} / 200 caractères`;

    if (length >= 200) {
      charCount.classList.remove('text-green-500');
      charCount.classList.add('text-red-500');
    } else {
      charCount.classList.remove('text-red-500');
      charCount.classList.add('text-green-500');
    }
  }

  // Appeler la fonction au chargement de la page
  document.addEventListener('DOMContentLoaded', updateCharCount);