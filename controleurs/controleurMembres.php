<?php

    // $pdo est définie dans le routeur

    function listerTousMembres(){    
        global $pdo;
        
        $textReq = "select * From Membre";
    
        $req = $pdo->prepare($textReq);
    
        $req->execute();
    
        $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);        

        require("vues/vueListerTousMembres.php"); // chemin relatif, par rapport au routeur
    }

    function supprimerMembre($membre_id) {
        global $pdo;
    
        // Vérification de l'existence de contributions pour le membre
        $checkContributionQuery = "SELECT COUNT(*) AS contributions FROM contribution WHERE membre_id = :membre_id";
        $stmt = $pdo->prepare($checkContributionQuery);
        $stmt->execute(['membre_id' => $membre_id]);
        $result = $stmt->fetch();
    
        if ($result['contributions'] == 0) {
            // Suppression du membre s'il n'y a pas de contributions
            $deleteQuery = "DELETE FROM membre WHERE id = :membre_id";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->execute(['membre_id' => $membre_id]);
    
            // Envoi de la réponse avec l'ID du membre supprimé
            echo json_encode(['status' => 'OK', 'id' => $membre_id]);
        } else {
            // Envoi de la réponse "KO" si des contributions existent
            echo json_encode(['status' => 'KO']);
        }
    }
    