<?php
require __DIR__.'/../utils_inc./inc_pdo.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Affectation des Dossards et Puces</title>
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
        <li  class="active">
          <a href="../vues/affectation.php">
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
        <li>
          <a href="#">
            <span class="icon"><i class="fa-solid fa-gear"></i></span>
          </a>
        </li>
        <div class="indicator"><span></span></div>
    </ul>
</div>
<br><br><br><br>
<!-- Contenu de la page -->
<div class="container mt-5">
    <h2>Affectation des Dossards et Puces</h2>
    
    <!-- Formulaire d'affectation des dossards et puces RFID -->
    <form method="post" action="../affectation_action.php">
        <div class="form-group">
            <label for="id_equipe">Sélectionnez l'équipe :</label>
            <select class="form-control" name="id_equipe" id="id_equipe" required>
                <option value="">-- Choisir une équipe --</option>
                <?php
                // Récupérer les noms et identifiants des équipes depuis la BDD
                $stmt = $pdo->query("SELECT id_equipe, nom FROM equipe");

                // Boucler sur les résultats pour créer une option par équipe
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['id_equipe']}\">{$row['nom']}</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="dossard">Numéro de Dossard :</label>
            <input type="text" class="form-control" name="dossard" id="dossard" required>
        </div>

        <h4>Affectation des Puces RFID pour chaque Participant</h4>
        <div id="participants-list">
            <?php
            // Récupère les participants sans puces et les affiche
            $participants = $pdo->query("SELECT id_participant, nom, prenom FROM participant WHERE rfid IS NULL");
            while ($participant = $participants->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='form-group'>";
                echo "<label for='rfid_{$participant['id_participant']}'>RFID pour {$participant['prenom']} {$participant['nom']} :</label>";
                echo "<input type='text' class='form-control' name='rfid[{$participant['id_participant']}]' id='rfid_{$participant['id_participant']}' required>";
                echo "</div>";
            }
            ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Attribuer les Dossards et Puces</button>
    </form>
</div>

<!-- Script pour la navigation -->
<script>
    let list = document.querySelectorAll('.navigation li');
    function activeLink(){
        list.forEach((item) =>
        item.classList.remove('active'));
        this.classList.add('active')
    }

    list.forEach((item) =>
    item.addEventListener('click', activeLink))
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
