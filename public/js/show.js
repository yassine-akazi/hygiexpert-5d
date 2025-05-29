document.addEventListener('DOMContentLoaded', function() {
    const btnOpenConfirm = document.getElementById('btnOpenConfirm');
    const form = document.getElementById('delete-form');
    const selectAllGlobal = document.getElementById('select-all-global');
    const filesGroups = document.querySelectorAll('.files-group');

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
    document.querySelectorAll('.type-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg'));
            btn.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
            const type = btn.dataset.type || btn.getAttribute('data-type');
            showFilesByType(type || 'all');
            // Reset checkboxes
            selectAllGlobal.checked = false;
            document.querySelectorAll('.select-all-type').forEach(cb => cb.checked = false);
            document.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = false);
        });
    });

    // Checkbox globale "Tout sélectionner"
    selectAllGlobal.addEventListener('change', function() {
        const checked = this.checked;
        filesGroups.forEach(group => {
            if (group.style.display === 'block') {
                group.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = checked);
                const type = group.dataset.type;
                const selectAllTypeCheckbox = document.querySelector(`.select-all-type[data-type="${type}"]`);
                if (selectAllTypeCheckbox) selectAllTypeCheckbox.checked = checked;
            }
        });
    });

    // Checkbox "Tout sélectionner" par type
    document.querySelectorAll('.select-all-type').forEach(selectAllTypeCheckbox => {
        selectAllTypeCheckbox.addEventListener('change', function() {
            const type = this.dataset.type;
            const checked = this.checked;
            const group = document.querySelector(`.files-group[data-type="${type}"]`);
            if (group && group.style.display === 'block') {
                group.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = checked);
            }
            const allTypeChecked = Array.from(document.querySelectorAll('.select-all-type')).every(cb => cb.checked);
            selectAllGlobal.checked = allTypeChecked;
        });
    });

    // Mise à jour checkboxes individuelles
    form.querySelectorAll('input[name="documents[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(form.querySelectorAll('input[name="documents[]"]')).every(cb => cb.checked);
            selectAllGlobal.checked = allChecked;

            // Vérifier par type
            const types = [...new Set(Array.from(form.querySelectorAll('input[name="documents[]"]')).map(cb => {
                const match = cb.className.match(/type-checkbox-([^ ]+)/);
                return match ? match[1] : null;
            }).filter(Boolean))];

            types.forEach(type => {
                const typeCheckboxes = form.querySelectorAll(`.type-checkbox-${CSS.escape(type)}`);
                const allTypeChecked = Array.from(typeCheckboxes).every(cb => cb.checked);
                const selectAllTypeCheckbox = document.querySelector(`.select-all-type[data-type="${type}"]`);
                if (selectAllTypeCheckbox) selectAllTypeCheckbox.checked = allTypeChecked;
            });
        });
    });

    // Confirmation suppression avec SweetAlert2
    btnOpenConfirm.addEventListener('click', function() {
        const checkedCount = Array.from(form.querySelectorAll('input[name="documents[]"]:checked')).length;

        if (checkedCount === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Aucun fichier sélectionné',
                text: 'Veuillez sélectionner au moins un fichier à supprimer.',
            });
            return;
        }

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: `Vous allez supprimer ${checkedCount} fichier(s). Cette action est irréversible !`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
}); 