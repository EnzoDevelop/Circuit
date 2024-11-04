<?php
require_once "../utils_inc/inc_pdo.php"; // Connexion à la base de données

// Récupérer les données des participants
$query = $pdo->query("SELECT * FROM participant"); // Remplacez "participant" par le nom de votre table si différent
$participants = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation des données d'équipes et participants depuis CSV</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e9ecef;
            color: #212529;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            margin-bottom: 20px;
        }

        h2 {
            color: #343a40;
            font-weight: 500;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="file"] {
            border: 2px solid #dee2e6;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit, .btn-back, .btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-submit:hover, .btn-back:hover, .btn:hover {
            background-color: #0056b3;
        }

        .table-container {
            overflow-x: auto;
            max-width: 800px;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
        }

        td {
            padding: 10px;
            color: #495057;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Importer un fichier CSV pour ajouter des équipes et participants</h2>
    <form action='./controleurs/import_controleur.php' method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit" name="import_csv" class="btn-submit">Importer</button>
    </form>
    <a href="index.php?route=accueil" class="btn-back">Retour à l'accueil</a>
</div>

<div class="container table-container">
    <h2>Liste des Participants</h2>
    <table>
        <thead>
            <tr>
                <th>ID Participant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Genre</th>
                <th>Rfid</th>
                <th>Abandon</th>
                <th>ID Équipe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($participants as $participant): ?>
            <tr>
                <td><?php echo htmlspecialchars($participant['id_participant']); ?></td>
                <td><?php echo htmlspecialchars($participant['nom']); ?></td>
                <td><?php echo htmlspecialchars($participant['prenom']); ?></td>
                <td><?php echo htmlspecialchars($participant['genre']); ?></td>
                <td><?php echo htmlspecialchars($participant['rfid']); ?></td>
                <td><?php echo htmlspecialchars($participant['abandon']); ?></td>
                <td><?php echo htmlspecialchars($participant['id_equipe']); ?></td>
                <td>
                    <a href="modifier_participant_vue.php?id=<?php echo $participant['id_participant']; ?>" class="btn">Modifier</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
