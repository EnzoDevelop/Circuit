document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.abandon-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const participantId = this.getAttribute('data-id');
            const abandonStatus = this.checked ? 1 : 0;

            fetch('../controleurs/update_abandons_controleur.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${participantId}&abandon=${abandonStatus}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Statut mis à jour avec succès.');
                } else {
                    alert('Erreur lors de la mise à jour.');
                    this.checked = !abandonStatus;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de la connexion au serveur.');
                this.checked = !abandonStatus;
            });
        });
    });
});
