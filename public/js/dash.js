document.addEventListener('DOMContentLoaded', () => {
    const selectAllGlobal = document.getElementById('select-all-global');
    const typeButtons = document.querySelectorAll('.type-btn');
    const filesGroups = document.querySelectorAll('.files-group');
    const btnDownloadZip = document.getElementById('btnDownloadZip');
    const form = document.getElementById('download-form');
  
    // Affiche tous les fichiers au départ
    function showFilesByType(type) {
      if (type === 'all') {
        filesGroups.forEach(group => group.style.display = 'block');
      } else {
        filesGroups.forEach(group => {
          group.style.display = group.dataset.type === type ? 'block' : 'none';
        });
      }
    }
    showFilesByType('all');
  
    // Gestion des boutons de filtre par type
    typeButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        typeButtons.forEach(b => b.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg'));
        btn.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
        const type = btn.dataset.type || btn.getAttribute('data-type');
        showFilesByType(type || 'all');
  
        selectAllGlobal.checked = false;
        document.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = false);
      });
    });
  
    // Checkbox globale "Tout sélectionner"
    selectAllGlobal.addEventListener('change', function () {
      const checked = this.checked;
      filesGroups.forEach(group => {
        if (group.style.display === 'block') {
          group.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = checked);
        }
      });
    });
  
    // Gestion du clic sur Télécharger ZIP avec SweetAlert2
    btnDownloadZip.addEventListener('click', (e) => {
      e.preventDefault();
  
      const checkedBoxes = form.querySelectorAll('input[name="documents[]"]:checked');
      if (checkedBoxes.length === 0) {
        Swal.fire({
          icon: 'warning',
          title: 'Aucun fichier sélectionné',
          confirmButtonColor: 'gray',
          text: 'Veuillez sélectionner au moins un fichier à télécharger.',
        });
        return;
      }
  
      Swal.fire({
        title: `Télécharger ${checkedBoxes.length} fichier(s) ?`,
        text: "Voulez-vous vraiment télécharger les fichiers sélectionnés en ZIP ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        confirmButtonText: 'Oui, télécharger',
        cancelButtonText: 'Annuler',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });