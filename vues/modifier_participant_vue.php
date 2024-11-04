<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le statut d'abandon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <?php if (isset($participant)): ?>
        <h2>Modifier le statut d'abandon pour <?php echo htmlspecialchars($participant['nom']) . " " . htmlspecialchars($participant['prenom']); ?></h2>
        <form method="post">
            <label>
                Abandon :
                <select name="abandon">
                    <option value="0" <?php echo $participant['abandon'] == 0 ? 'selected' : ''; ?>>Non</option>
                    <option value="1" <?php echo $participant['abandon'] == 1 ? 'selected' : ''; ?>>Oui</option>
                </select>
            </label>
            <br><br>
            <button type="submit" class="btn">Enregistrer</button>
        </form>
        <a href="import_vue.php" class="btn" style="background-color: #6c757d; margin-top: 10px;">Annuler</a>
    <?php else: ?>
        <p>Participant introuvable.</p>
        <a href="import_vue.php" class="btn" style="background-color: #6c757d; margin-top: 10px;">Retour</a>
    <?php endif; ?>
</div>

</body>
</html>
