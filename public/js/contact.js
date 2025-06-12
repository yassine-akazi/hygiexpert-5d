function updateCharCount() {
  const textarea = document.getElementById('message');
  const charCount = document.getElementById('charCount');
  const maxLength = 200;
  const length = textarea.value.length;

  charCount.textContent = `${length} / ${maxLength} caractères`;

  if (length >= maxLength) {
    charCount.classList.remove('text-green-500');
    charCount.classList.add('text-red-500');
  } else {
    charCount.classList.remove('text-red-500');
    charCount.classList.add('text-green-500');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const textarea = document.getElementById('message');
  textarea.addEventListener('input', updateCharCount);
  updateCharCount(); // Initialiser le compteur au chargement
});