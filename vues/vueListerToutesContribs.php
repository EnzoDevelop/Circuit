<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body class="container">
    <?php include "utils_inc/inc_navbar.php"; ?>
    <table class="table table-striped">
        <thead>
            <tr>
            <th>Numéro </th>
            <th>Membre </th>
            <th>Projet </th>
            <th>Durée </th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($tabRes as $uneLigne){
                    echo "<tr>";
                    echo "  <th>".$uneLigne["numero"]."</th>";
                    echo "  <td>".$uneLigne["nom_membre"]."</td>";
                    echo "  <td>".$uneLigne["nom_projet"]."</td>";
                    echo "  <td>".$uneLigne["duree"]."</td>";
                    echo "</tr>";                   
                }
            ?>
        </tbody>
    </table>   
</body>
</html>
