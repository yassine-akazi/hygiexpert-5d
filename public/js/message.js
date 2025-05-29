function confirmDelete() {
    const checkedCount = document.querySelectorAll('.message-checkbox:checked').length;
  
    if (checkedCount === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Aucun message sélectionné',
        text: 'Veuillez sélectionner au moins un message à supprimer.',
      });
      return;
    }
  
    Swal.fire({
      title: 'Êtes-vous sûr ?',
      text: `Vous allez supprimer ${checkedCount} message(s). Cette action est irréversible !`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Oui, supprimer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('deleteMessagesForm').submit();
      }
    });
  }