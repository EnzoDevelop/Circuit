<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation des données d'équipes et participants depuis CSV</title>
</head>
<body>

<h2>Importer un fichier CSV pour ajouter des équipes et participants</h2>
<form action='./controleurs/import_controleur.php' method="post" enctype="multipart/form-data">
    <input type="file" name="csv_file" accept=".csv" required>
    <button type="submit" name="import_csv">Importer</button>
</form>

</body>
</html>
