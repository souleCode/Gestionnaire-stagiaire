<?php
    require_once('db.php');
    include('fonctions.php');
    include('session.php');

    $id =isset($_GET['idUser']) ? $_GET['idUser']:0;
    $id= secure($id);
    $query= "SELECT * FROM utilisateur WHERE iduser=$id";
    $result= $pdo->query($query);
    $utilisateur = $result->fetch();

    $login =  $utilisateur['login'];
   
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du mot de passe</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/maicons.css">

 
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
    <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Changer le mot de passe...</div>
            <div class="panel-body">

            <form method="POST" class="form" action ="passwordConfirm.php">
                    <div class="form-group">
                        <label for="id"></label>
                                <input type="hidden" name="id" 
                                class="form-control"
                                value="<?php echo $id?>"/>
                    </div>
                    <div class="form-group">
                        <label for="login">Compte:
                            <span class="text-center"><?php echo $login?></span></label>
                                <input type="hidden" name="login" 
                                class="form-control"placeholder="login"
                                value="<?php echo $login?>"/>
                    </div>

                    <div class="form-group input-container oldpwd">
                        <label for="pwd1">L'ancien mot de passe:</label>
                                <input type="password" name="pwd1" 
                                class="form-control oldpwd" placeholder="votre ancien mot de passe" required/>
                                <span class="mai mai-eye show-old-pwd clickable"></span>
                    </div>

                    <div class="form-group input-container ">
                        <label for="pwd2">Le nouveau mot de passe:</label>
                                <input type="password" name="pwd2" 
                                class="form-control newpwd" placeholder="votre nouveau mot de passe"required/>
                                <span class="mai mai-eye show-new-pwd clickable"></span>
                    </div>      

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span>
                        Enregistrer
                        </button>
                    </div>
                    &nbsp;&nbsp;
                </form>

            </div>
        </div>
    </div>
</div>
</body>
<script src="../assets/js/jquery-3.3.1.js"></script>
<script src="../assets/js/monjs.js"></script>
    
</html>