<?php
require __DIR__.'/../utils_inc./inc_pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_participant = $_POST['id_participant'];
    $id_etape = $_POST['id_etape'];
    $mode = $_POST['mode'];
    $current_time = date("Y-m-d H:i:s");

    if ($mode === "auto") {
        // Sauvegarde du temps en mode automatique
        $stmt = $pdo->prepare("INSERT INTO chronometre (id_participant, id_etape, debut_passage) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE fin_passage = ?");
        $stmt->execute([$id_participant, $id_etape, $current_time, $current_time]);
    } elseif ($mode === "manual") {
        // Saisie manuelle du temps
        $manual_time = $_POST['manual_time'];
        $stmt = $pdo->prepare("UPDATE chronometre SET fin_passage = ? WHERE id_participant = ? AND id_etape = ?");
        $stmt->execute([$manual_time, $id_participant, $id_etape]);
    }
}
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
        <li> 
          <a href="accueil.html">
            <span class="icon"><i class="fa-solid fa-house"></i></span>
          </a>
        </li>
        <li>
          <a href="../vues/affectation.php">
            <span class="icon"><i class="fa-regular fa-user"></i></span>
          </a>
        </li>
        <li>
          <a href="affectation.php">
            <span class="icon"><i class="fa-solid fa-ranking-star"></i></span>
          </a>
        </li>
        <li class="active">
          <a href="#">
            <span class="icon"><i class="fa-solid fa-stopwatch"></i></span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><i class="fa-solid fa-gear"></i></span>
          </a>
        </li>
        <div class="indicator"><span></span></div>
    </ul>
</div>
<br><br><br><br>
<div class="container mt-5">
    <h2>Chronométrage des Concurrents</h2>
    
    <!-- Formulaire de Chronométrage -->
    <form method="post" action="chronometrage.php">
        <div class="form-group">
            <label for="id_etape">Sélectionnez l'Étape :</label>
            <select class="form-control" name="id_etape" id="id_etape" required>
                <option value="">-- Choisir une étape --</option>
                <?php
                // Récupération des étapes depuis la BDD
                $stmt = $pdo->query("SELECT id_etape, nom FROM etape ORDER BY rang");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['id_etape']}\">{$row['nom']}</option>";
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
</script>
</body>
</html>
