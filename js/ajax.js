function traiterAppelServeur(){
    $.get("getDelete.php", traiterReponseServeur);
}

function traiterReponseServeur(data){
    console.log(data);
}

function supprimerMembre(membreId) {
    // Vérifier les contributions d'abord
    const xhrCheck = new XMLHttpRequest();
    xhrCheck.open("GET", `chemin_vers_la_page_de_verification.php?id=${membreId}`, true);
    xhrCheck.onreadystatechange = function () {
        if (xhrCheck.readyState === 4 && xhrCheck.status === 200) {
            const response = JSON.parse(xhrCheck.responseText);
            
            if (response.contribution_count > 0) {
                alert("Le membre a des contributions et ne peut pas être supprimé.");
            } else {
                // Pas de contributions, donc on peut désactiver
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "index.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const updateResponse = JSON.parse(xhr.responseText);
                        if (updateResponse.status === 'OK') {
                            location.reload();  // Recharge la page après la désactivation
                        } else {
                            alert("Erreur lors de la désactivation du membre.");
                        }
                    }
                };

                xhr.send(`action=desactiverMembre&membre_id=${membreId}`);
            }
        }
    };
    xhrCheck.send();
}
