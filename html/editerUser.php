<?php
    require_once('db.php');
    include('fonctions.php');
    $idu =isset($_GET['idU']) ? $_GET['idU']:0;
    $idu= secure($idu);
    $queryU= "SELECT * FROM utilisateur WHERE iduser=$idu";
    $resultU= $pdo->query($queryU);
    $utilisateur = $resultU->fetch();

    $login =  strtoupper($utilisateur['login']);
    $email =  $utilisateur['email'];
    $role =  strtoupper($utilisateur['role']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un utilisateur</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez modifier l'utilisateur ici...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="updateUser.php">
                    <div class="form-group">
                        <label for="idU">ID de l'utilisateur:<?php echo $idu?></label>
                                <input type="hidden" name="idU" 
                                class="form-control"
                                value="<?php echo $idu?>"/>
                    </div>

                    

                    <div class="form-group">
                        <label for="login">Login</label>
                                <input type="text" name="login" 
                                class="form-control"placeholder="login"
                                value="<?php echo $login?>"/>
                    </div>

                    <div class="form-group">
                        <label for="email">L'email de l'utilisateur</label>
                                <input type="text" name="email" 
                                class="form-control" placeholder="email"
                                value="<?php echo $email?>"/>
                    </div>
                        <div class="form-group">
                            <select name="role" class="form-control">
                                <option <?php if($role=='ADMIN') echo 'selected' ?> value="ADMIN">Administrateur</option>
                                <option  <?php if($role=='VISITEUR') echo 'selected' ?>  value="VISITEUR">Visiteur</option>
                            </select>
                        </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                        </button>
                    </div>
                    &nbsp;&nbsp;
                        <a href="modifierPwd.php?idUser=<?php echo $idu?>">Changer le mot de passe</a>
                </form>

            </div>
        </div>
    </div>
</body>
</html>