<?php

    function estConnecte(){
        return isset($_SESSION["autorisations"]);
    }

    function aDroit($nomDroit){
        return isset($_SESSION["autorisations"]) &&$_SESSION["autorisations"]==$nomDroit;
    }

    function traiterLogin(){    
        global $pdo;
        $login = $_POST["login"];
        $pass = $_POST["pass"];

        // Vérification dans la base si le mot de passe et le login se trouvent dans la base
        // VERSION mot de passe en clair 
        $textR = "select autorisations, pass ";
        $textR.= "from utilisateur ";
        $textR.= "where id_user=:login";
        $req = $pdo->prepare($textR);
        $req->bindParam(":login", $login);
        $req->execute();
    
        // 2 possibilités : 1 ligne retournée ou 0 ligne retournée 
        $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);
        if (count($tabRes)!=1) {
            // pas trouvé => retour au formulaire de co
            // die("Erreur de co");
            header("Location:index.php"); // renvoie au form login
            exit();
        }
    
        // Si on arrive là : login/pass OK (count==1)
        // Stockage en session : 
        $_SESSION["login"] = $login;
        $_SESSION["autorisations"] = $tabRes[0]["autorisations"]; // TODO : EXPLIQUER (erreur en séance)
    
        // redirection vers accueil, éventuellement spécifique à l'utilisateur
        header("Location:index.php?route=accueil");
        exit(); 
          
    }