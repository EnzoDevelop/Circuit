<?php
require __DIR__.'/../controleurs/controleurChronometrage.php';
$etapes = fetchEtapes($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection de l'Étape</title>
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
    <h2>Sélectionnez une Étape</h2>
    <form action="chronometrage.php" method="get">
        <div class="form-group">
            <label for="id_etape">Étape :</label>
            <select class="form-control" name="id_etape" id="id_etape" required>
                <option value="">-- Choisir une étape --</option>
                <?php
                foreach ($etapes as $etape) {
                    echo "<option value=\"{$etape['id_etape']}\">{$etape['nom']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Continuer vers Chronométrage</button>
    </form>
</div>
</body>
</html>
