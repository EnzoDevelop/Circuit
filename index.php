<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="css/navBar.css">
</head>
<body>
</body>
<html>

<?php
    session_start();
    require_once "utils_inc/inc_pdo.php"; // $pdo est désormais définie
    require_once "controleurs/controleurContribs.php";
    require_once "controleurs/controleurLogin.php";
    require_once "controleurs/controleurMembres.php";




    // Syntaxe : index.php?route=maRoute&param1=valeurA&param2=valeurB ...

    // Pas de route => login


    // index.php
    if (!isset($_GET['route'])){
        require "vues/vueLogin.php"; // Copier le code de la vue ici
        exit();
    }

    // index.php?route=accueil
    if ($_GET['route']=='accueil'){
        require __DIR__ . "/vues/accueil.html";
        // normalement : on passe toujours par un controleur
        exit();
    }

    // index.php?route=listerContribs
    // Retourne toutes les contributions
    if ($_GET['route']=='listerContribs'){
        // appel du contrôleur : il faut l'inclure
        // il faut être admin
        if (!estConnecte()){
            header("location:index.php");
            exit();
        }

        if (!aDroit("admin")){
            header("location:index.php?route=accueil");
            exit();
        }
        listerToutesContribs(); // le controleur fait le traitement puis "trasnmet les données" à la vue

        exit();
    }

    if ($_GET['route']=='listerMembres'){
        // appel du contrôleur : il faut l'inclure
        // il faut être admin
        if (!estConnecte()){
            header("location:index.php");
            exit();
        }

        if (!aDroit("admin")){
            header("location:index.php?route=accueil");
            exit();
        }
        listerTousMembres(); // le controleur fait le traitement puis "trasnmet les données" à la vue

        exit();
    }

    if ($_GET['route']=='importation'){
        // appel du contrôleur : il faut l'inclure
        // il faut être admin
        if (!estConnecte()){
            header("location:index.php");
            exit();
        }

        if (!aDroit("admin")){
            header("location:index.php?route=accueil");
            exit();
        }
        require "vues/import_vue.php"; // le controleur fait le traitement puis "trasnmet les données" à la vue

        exit();
    }

    if (isset($_POST['action']) && $_POST['action'] == 'supprimerMembre' && isset($_POST['membre_id'])) {
        supprimerMembre($_POST['membre_id']);
        exit;  // Envoie la réponse sans rechargement de page
    }



    if ($_GET["route"]=='traiterLogin'){
        traiterLogin();
        exit();
    }


    echo "Route inconnue...";