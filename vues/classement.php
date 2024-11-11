<?php
require __DIR__.'/../utils_inc./inc_pdo.php';


$query = "
    SELECT e.nom AS equipe_nom, c.nom AS circuit_nom, 
           SUM(TIME_TO_SEC(te.heure_passage_retenu)) AS total_seconds
    FROM temps_equipe te
    JOIN equipe e ON te.id_equipe = e.id_equipe
    JOIN circuit c ON e.id_circuit = c.id_circuit
    GROUP BY e.id_equipe, c.id_circuit
    ORDER BY c.nom, total_seconds ASC
";

$result = $pdo->query($query);

$classements = [];
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $classements[$row['circuit_nom']][] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement des Équipes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navBar.css"></head>
<body>
        <!-- Barre de navigation -->
        <div class="navigation">
        <ul>
            <li> 
              <a href="accueil.html">
                <span class="icon"><i class="fa-solid fa-house"></i></span>
              </a>
            </li>
            <li >
              <a href="affectation.php">
                <span class="icon"><i class="fa-regular fa-user"></i></span>
              </a>
            </li>
            <li>
              <a href="import_vue.php">
                <span class="icon"><i class="fa-solid fa-people-group"></i></span>
              </a>
            </li>
            <li>
              <a href="selection_etape.php">
                <span class="icon"><i class="fa-solid fa-stopwatch"></i></span>
              </a>
            </li>
            <li class="active">
              <a href="#">
                <span class="icon"><i class="fa-solid fa-ranking-star"></i></span>
              </a>
            </li>
            <li>
              <a href="historique.php">
                <span class="icon"><i class="fa-solid fa-gear"></i></span>
              </a>
            </li>
            <div class="indicator"><span></span></div>
        </ul>
    </div>
    <br><br><br><br>
    <div class="container my-5">
        <h2 class="text-center">Classement des Équipes</h2>

        <?php foreach ($classements as $circuit_nom => $equipes) : ?>
            <h3 class="mt-4">Circuit : <?= htmlspecialchars($circuit_nom) ?></h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Équipe</th>
                        <th>Temps Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($equipes as $index => $equipe) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($equipe['equipe_nom']) ?></td>
                            <td><?= gmdate("H:i:s", $equipe['total_seconds']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Chronométrage App. Tous droits réservés.</p>
    </footer>
</body>
</html>
