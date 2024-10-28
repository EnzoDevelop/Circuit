<?php

    // $pdo est définie dans le routeur

    function listerToutesContribs(){    
        global $pdo;
        
        $textReq = "select contribution.id as numero, membre.nom as nom_membre, projet.nom as nom_projet, duree ";
        $textReq.= "from membre inner join contribution on membre.id = contribution.membre_id ";
        $textReq.= "            inner join projet on contribution.projet_id = projet.id ";
        $textReq.= "order by membre.nom, nom_projet ";
    
        $req = $pdo->prepare($textReq);
    
        $req->execute();
    
        $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);        

        require("vues/vueListerToutesContribs.php"); // chemin relatif, par rapport au routeur
    }