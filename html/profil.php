<?php
    require_once('db.php');
    include('fonctions.php');
    include('session.php');

    $id =isset($_GET['id']) ? $_GET['id']:0;
    $id= secure($id);
    $query= "SELECT * FROM utilisateur WHERE iduser=$id";
    $result= $pdo->query($query);
    $utilisateur = $result->fetch();

    $login =  $utilisateur['login'];
    $email =  $utilisateur['email'];
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du profil</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez modifier le profil ici...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="updateProfil.php">
                    <div class="form-group">
                        <label for="id"></label>
                                <input type="hidden" name="id" 
                                class="form-control"
                                value="<?php echo $id?>"/>
                    </div>

                    

                    <div class="form-group">
                        <label for="login">Login</label>
                                <input type="text" name="login" 
                                class="form-control"placeholder="login"
                                value="<?php echo $login?>"/>
                    </div>

                    <div class="form-group">
                        <label for="email">L'email:</label>
                                <input type="email" name="email" 
                                class="form-control" placeholder="email"
                                value="<?php echo $email?>"/>
                    </div>
                        

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                        </button>
                    </div>
                    &nbsp;&nbsp;
                        <a href="modifierPwd.php?idUser=<?php echo $id?>">Changer le mot de passe</a>
                </form>

            </div>
        </div>
    </div>
</body>
</html>