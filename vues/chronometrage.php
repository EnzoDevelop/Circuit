<?php
require __DIR__.'/../controleurs/controleurChronometrage.php';

if (!isset($_GET['id_etape'])) {
    header("Location: selection_etape.php");
    exit();
}

$id_etape = $_GET['id_etape']; // Récupère l'étape sélectionnée
$etapeInfo = fetchEtapeById($pdo, $id_etape); // Fonction pour récupérer les détails de l'étape sélectionnée

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chronométrage des Concurrents - Étape <?= htmlspecialchars($etapeInfo['nom']); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navBar.css">
</head>
<body>
      <!-- Barre de navigation -->
      <div class="navigation">
        <ul>
            <li><a href="accueil.html"><span class="icon"><i class="fa-solid fa-house"></i></span></a></li>
            <li><a href="affectation.php"><span class="icon"><i class="fa-regular fa-user"></i></span></a></li>
            <li><a href="import_vue.php"><span class="icon"><i class="fa-solid fa-ranking-star"></i></span></a></li>
            <li class="active"><a href="import_vue.php"><span class="icon"><i class="fa-solid fa-stopwatch"></i></span></a></li>
            <li><a href="classement.php"><span class="icon"><i class="fa-solid fa-ranking-star"></i></span></a></li>
            <li><a href="historique.php"><span class="icon"><i class="fa-solid fa-gear"></i></span></a></li>
            <div class="indicator"><span></span></div>
        </ul>
    </div>
    <br><br><br><br>
<div class="container mt-5">
    <h2>Chronométrage des Concurrents - Étape : <?= htmlspecialchars($etapeInfo['nom']); ?></h2>
    
    <!-- Formulaire de Chronométrage -->
    <form method="post" action="chronometrage.php?id_etape=<?= $id_etape ?>" id="chronometrage-form">
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
    event.preventDefault();

    const participantId = document.getElementById('id_participant').value;
    const mode = document.querySelector('input[name="mode"]:checked').value;
    const now = new Date().toLocaleString();
    const etapeNom = <?= json_encode($etapeInfo['nom']); ?>;

    let message = `Participant ID: ${participantId}\nÉtape: ${etapeNom}\n`;
    message += `Mode: ${mode === 'auto' ? 'Automatique' : 'Manuel'}\n`;
    message += `Temps enregistré : ${now}`;

    alert(message);

    this.submit();
});
</script>
</body>
</html>
