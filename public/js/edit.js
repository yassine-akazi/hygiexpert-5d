function confirmUpdate() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;

    if (password && password !== confirm) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Les mots de passe ne correspondent pas.'
        });
        return;
    }

    Swal.fire({
        title: 'Confirmer la modification',
        text: 'Voulez-vous vraiment enregistrer les modifications de ce client ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Oui, enregistrer',
        cancelButtonText: 'Annuler',
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('editClientForm').submit();
        }
    });
}

function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);

    const showIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-eye-icon">
            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696
            10.75 10.75 0 0 1-19.876 0" />
            <circle cx="12" cy="12" r="3" />
        </svg>`;

    const hideIcon = `
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

    if (input.type === 'password') {
        input.type = 'text';
        button.innerHTML = hideIcon;
    } else {
        input.type = 'password';
        button.innerHTML = showIcon;
    }
}