<?php
// Inclure la connexion PDO
require __DIR__.'/../utils_inc/inc_pdo.php';
global $pdo;

if (isset($_POST['import_csv'])) {
    if (is_uploaded_file($_FILES['csv_file']['tmp_name'])) {
        $file = fopen($_FILES['csv_file']['tmp_name'], "r");
        
        // Ignorer la première ligne (en-tête)
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
            $id_equipe = $row[0];
            $genre = $row[1];
            $nom_circuit = $row[2];
            $nom = $row[3];
            $prenom = $row[4];
            $nom_equipe = $row[5];

            // Rechercher l'id du circuit
            $circuit_query = $pdo->prepare("SELECT id_circuit FROM circuit WHERE nom_circuit = :nom_circuit LIMIT 1");
            $circuit_query->execute(['nom_circuit' => $nom_circuit]);
            $circuit_row = $circuit_query->fetch();

            if ($circuit_row) {
                $id_circuit = $circuit_row['id_circuit'];

                // Insertion dans `equipe`
                $sql_equipe = "INSERT INTO equipe (id_equipe, nom_equipe, id_circuit) 
                               VALUES (:id_equipe, :nom_equipe, :id_circuit)
                               ON DUPLICATE KEY UPDATE id_equipe=id_equipe";
                $stmt_equipe = $pdo->prepare($sql_equipe);
                $stmt_equipe->execute([
                    'id_equipe' => $id_equipe,
                    'nom_equipe' => $nom_equipe,
                    'id_circuit' => $id_circuit
                ]);

                // Insertion dans `participant`
                $sql_participant = "INSERT INTO participant (nom, prenom, genre, id_equipe) 
                                    VALUES (:nom, :prenom, :genre, :id_equipe)";
                $stmt_participant = $pdo->prepare($sql_participant);
                $stmt_participant->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'id_equipe' => $id_equipe,
                    'genre' => $genre
                ]);

                echo "<p>Équipe et participant ajoutés : $nom_equipe - $prenom $nom</p>";
            } else {
                echo "<p>Erreur : Le circuit '$nom_circuit' n'existe pas dans la base de données.</p>";
            }
            
        }
        fclose($file); // Redirection JavaScript après 3 secondes
        echo "<p>Redirection vers la page d'accueil dans 3 secondes...</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href ='../index.php?route=accueil';
                }, 3000);
              </script>";
    } else {
        echo "<p>Erreur : Aucun fichier n'a été uploadé.</p>";
    }
}
?>
