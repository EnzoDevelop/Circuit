<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Connexion</title>
</head>

<body class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form id="formLogin" action="routeur.php?route=traiterLogin" method="post">
                <h3 class="text-center">Identifiez-vous</h3>
                <div class="form-group">
                    <label for="id">Login :</label><br>
                    <input type="text" name="login" id="id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mdp">Pass :</label><br>
                    <input type="password" name="pass" id="mdp" class="form-control">
                </div>
                <br>
                <div class="form-group text-end">
                    <input type="submit" name="submit" class="btn btn-primary btn-md" value="Valider">
                </div>
            </form>
        </div>
    </div>
</body>
   
</html>