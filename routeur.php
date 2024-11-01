<?php
    session_start();
    require_once "utils_inc/inc_pdo.php"; // $pdo est désormais définie
    require_once "controleurs/controleurContribs.php";
    require_once "controleurs/controleurLogin.php";
    require_once "controleurs/controleurMembres.php";




    // Syntaxe : routeur.php?route=maRoute&param1=valeurA&param2=valeurB ...

    // Pas de route => login


    // routeur.php
    if (!isset($_GET['route'])){
        require "vues/vueLogin.php"; // Copier le code de la vue ici
        exit();
    }

    // routeur.php?route=accueil
    if ($_GET['route']=='accueil'){
        require "vues/vueAccueil.php"; // normalement : on passe toujours par un controleur
        exit();
    }

    // routeur.php?route=listerContribs
    // Retourne toutes les contributions
    if ($_GET['route']=='listerContribs'){
        // appel du contrôleur : il faut l'inclure
        // il faut être admin
        if (!estConnecte()){
            header("location:routeur.php");
            exit();
        }

        if (!aDroit("admin")){
            header("location:routeur.php?route=accueil");
            exit();
        }
        listerToutesContribs(); // le controleur fait le traitement puis "trasnmet les données" à la vue

        exit();
    }

    if ($_GET['route']=='listerMembres'){
        // appel du contrôleur : il faut l'inclure
        // il faut être admin
        if (!estConnecte()){
            header("location:routeur.php");
            exit();
        }

        if (!aDroit("admin")){
            header("location:routeur.php?route=accueil");
            exit();
        }
        listerTousMembres(); // le controleur fait le traitement puis "trasnmet les données" à la vue

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