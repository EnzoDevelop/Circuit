<?php
  require __DIR__.'/../controleurs/controleurChronometrage.php';
  $participantInfo = handleChronometrageRequest($pdo); 
  $etapes = fetchEtapes($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chronométrage des Concurrents</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- Barre de navigation -->
    <div class="navigation">
        <ul>
            <li><a href="accueil.html"><span class="icon"><i class="fa-solid fa-house"></i></span></a></li>
            <li><a href="../vues/affectation.php"><span class="icon"><i class="fa-regular fa-user"></i></span></a></li>
            <li><a href="affectation.php"><span class="icon"><i class="fa-solid fa-ranking-star"></i></span></a></li>
            <li class="active"><a href="#"><span class="icon"><i class="fa-solid fa-stopwatch"></i></span></a></li>
            <li><a href="historique.php"><span class="icon"><i class="fa-solid fa-gear"></i></span></a></li>
            <div class="indicator"><span></span></div>
        </ul>
    </div>
    <br><br><br><br>
    <div class="container mt-5">
    <h2>Chronométrage des Concurrents</h2>
    
    <!-- Formulaire de Chronométrage -->
    <form method="post" action="chronometrage.php" id="chronometrage-form">
        <div class="form-group">
            <label for="id_etape">Sélectionnez l'Étape :</label>
            <select class="form-control" name="id_etape" id="id_etape" required>
                <option value="">-- Choisir une étape --</option>
                <?php
                foreach ($etapes as $etape) {
                    echo "<option value=\"{$etape['id_etape']}\">{$etape['nom']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_participant">Numéro de Puce (ID Participant) :</label>
            <input type="text" class="form-control" name="id_participant" id="id_participant" required>
        </div>
        
        <div class="form-group">
            <label for="mode">Mode de Chronométrage :</label><br>
            <input type="radio" name="mode" value="auto" id="auto" checked>
            <label for="auto">Automatique</label>
            <input type="radio" name="mode" value="manual" id="manual">
            <label for="manual">Manuel</label>
        </div>
        
        <div class="form-group" id="manual-time-group" style="display: none;">
            <label for="manual_time">Saisissez l'Heure Manuellement :</label>
            <input type="datetime-local" class="form-control" name="manual_time" id="manual_time">
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer le Temps</button>
    </form>
</div>

<script>
document.getElementById('manual').addEventListener('click', function() {
    document.getElementById('manual-time-group').style.display = 'block';
});

document.getElementById('auto').addEventListener('click', function() {
    document.getElementById('manual-time-group').style.display = 'none';
});

document.getElementById('chronometrage-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi immédiat pour afficher les données dans pop up

    // Récupérer les infos du participant et l'étape
    const participantId = document.getElementById('id_participant').value;
    const etapeSelect = document.getElementById('id_etape');
    const etapeNom = etapeSelect.options[etapeSelect.selectedIndex].text;
    const mode = document.querySelector('input[name="mode"]:checked').value;
    const now = new Date().toLocaleString();

    // Générer le message d'information
    let message = `Participant ID: ${participantId}\nÉtape: ${etapeNom}\n`;
    message += `Mode: ${mode === 'auto' ? 'Automatique' : 'Manuel'}\n`;
    message += `Temps enregistré : ${now}`;

    // Affiche pop-up
    alert(message);

    // Envoyer formulaire
    this.submit();
});
</script>
</body>
</html>
