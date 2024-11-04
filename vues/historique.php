<?php
require __DIR__.'/../utils_inc./inc_pdo.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Chronos</title>
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
          <a href="affectation.php">
            <span class="icon"><i class="fa-regular fa-user"></i></span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><i class="fa-solid fa-ranking-star"></i></span>
          </a>
        </li>
        <li>
          <a href="chronometrage.php">
            <span class="icon"><i class="fa-solid fa-stopwatch"></i></span>
          </a>
        </li>
        <li class="active">
          <a href="#">
            <span class="icon"><i class="fa-solid fa-gear"></i></span>
          </a>
        </li>
        <div class="indicator"><span></span></div>
    </ul>
</div>
<br><br><br><br>
<div class="container mt-5">
    <h2>Historique des Chronos</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Participant</th>
                <th>Étape</th>
                <th>Début Passage</th>
                <th>Fin Passage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $pdo->query("SELECT p.nom AS participant_nom, e.nom AS etape_nom, c.debut_passage, c.fin_passage 
                                   FROM chronometre c
                                   JOIN participant p ON c.id_participant = p.id_participant
                                   JOIN etape e ON c.id_etape = e.id_etape");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['participant_nom']}</td>";
                echo "<td>{$row['etape_nom']}</td>";
                echo "<td>{$row['debut_passage']}</td>";
                echo "<td>{$row['fin_passage']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
