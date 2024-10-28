<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/ajax.js"></script>

</head>
<body class="container">
    <?php include "utils_inc/inc_navbar.php"; ?>
    <table class="table table-striped">
        <thead>
            <tr>
            <th>id </th>
            <th>nom </th>
            <th>pass </th>
            <th>droit </th>
            <th>contribs</th>
            <th>suppr</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($tabRes as $uneLigne) {
                    echo "<tr id='ligne_".$uneLigne["id"]."'>";  // L'ID de la ligne
                    echo "  <th>".$uneLigne["id"]."</th>";
                    echo "  <td>".$uneLigne["nom"]."</td>";
                    echo "  <td>".$uneLigne["password"]."</td>";
                    echo "  <td>".$uneLigne["droit"]."</td>";
                    echo "  <td><a href='../pages/listeContribsMembre.php?id=".$uneLigne["id"]."'><button class='btn btn-info'>voir</button></a></td>";
                    echo "<td><button class='btn btn-danger' onclick=\"supprimerMembre('".$uneLigne["id"]."')\">X</button></td>";
                    echo "</tr>";                   
                }
                              
            ?>
        </tbody>
    </table>   
</body>
</html>