<?php

    $user = "root";
    $mdp = "FwerTc-XcxK0B8l*";
    $serveur = "localhost";
    $bd = "bdd_circuit";
    $dns = "mysql:host=$serveur;dbname=$bd";

    try{
        $pdo = new PDO($dns, $user, $mdp);
    }

    catch (PDOException $e){
        echo"Erreur de connexion à la base de donnée : " .$e->getMessage();
    }